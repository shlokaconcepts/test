<?php

namespace App\Http\Controllers;

use App\Mail\SuccessMail;
use App\Mail\OtpMail;
use App\Models\CandidateStatus;
use App\Models\Company;
use App\Models\RegistrationCategory;
use App\Models\RegistrationLink;
use App\Models\Setting;
use App\Models\State;
use App\Models\Trade;
use App\Models\User;
use App\Models\UserOtherInfo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use PhpParser\Node\Stmt\Switch_;

class RegistrationFormController extends Controller
{
    protected $url;
    protected $site_settings;
    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
        $this->site_settings = Setting::first();
        View::share('setting', $this->site_settings);
    }

    public function register_with_my_email($prefix = null, $cat = null)
    {
        $data = RegistrationLink::Join('companies', 'companies.id', '=', 'registration_links.company')
            ->Join('registration_categories', 'registration_links.form_category', '=', 'registration_categories.id')
            ->where([
                ['companies.prefix', '=', $prefix],
                ['registration_links.status', '=', '1'],
                ['registration_categories.title', '=', $cat]
            ])->select([
                'registration_links.id',
                'registration_links.closed_time',
                'registration_links.company',
                'registration_categories.name as reg_cat_name',
                'registration_links.description',
                'companies.logo as company_logo'
            ])
            ->first();
        if ($data) {
            if (date('Y-m-d h:i:s', strtotime($data->closed_time)) >= date('Y-m-d h:i:s', strtotime(now()))) {
                $title = $prefix . ' | Registration';
                Session::put(['form_id' => $data->id]);
                return view('form.register_with_email', compact('data', 'title'));
            } else {
                return abort(419);
            }
        } else {
            return abort(404);
        }
    }

    // otp verification 
    public function send_otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            die();
        }


        $domain = substr($request->email, strpos($request->email, '@') + 1);
        $domains = ['gmail.com', 'yahoo.com', 'outlook.com', 'icloud.com', 'hotmail.com'];

        if (in_array($domain, $domains) == false) {
            return response()->json(['status' => false, 'msg' => "Please enter a valid email address."]);
            die();
        }


        $user = User::where([['email', $request->email], ['form_complete_status', 'Complete'], ['next_registration_date', '>', date('Y-m-d')]])->select('next_registration_date')->first();
        if ($user) {
            $message = 'You have completed your previous registration. You can proceed after ' . date('d M', strtotime($user->next_registration_date));
            return response()->json(['status' => false, 'msg' => $message]);
            die();
        }

        $otp = rand(100000, 999999);
        $expire_date = date("Y-m-d H:i", strtotime("5 minutes", strtotime(date('Y-m-d H:i'))));
        $details = [
            'subject' => 'OTP for your ' . env('APP_NAME') . ' sign-in',
            'otp' => $otp,
            'site_name' => env('APP_NAME'),
            'contact' => env('CONTACT_US_MAIL'),
            'otp_expire_time' => $expire_date,
        ];

        try {
            // Mail::to($request->email)->send(new OtpMail($details));
            Session::put(['otp' => $otp]);
            Session::put(['email' => $request->email]);
            $message = 'OTP Sent Successfully. Valid Till 5 minutes';
            $response = ['status' => true, 'msg' => $message, 'input' => $request->email];
        } catch (Exception $ex) {
            $message = $ex->getMessage();
            $response = ['status' => false, 'msg' => $message];
        }
        return response()->json($response);
    }

    public function resend_otp(Request $request)
    {
        $otp = rand(100000, 999999);
        Session::put(['otp' => $otp]);
        $email = Session::get('email');
        $expire_date = date("Y-m-d H:i", strtotime("5 minutes", strtotime(date('Y-m-d H:i'))));
        $details = [
            'subject' => 'OTP for your ' . env('APP_NAME') . ' sign-in',
            'otp' => $otp,
            'site_name' => env('APP_NAME'),
            'contact' => env('CONTACT_US_MAIL'),
            'otp_expire_time' => $expire_date
        ];

        Mail::to($email)->send(new OtpMail($details));
        if ($otp) {
            return response()->json(['status' => true, 'msg' => 'OTP Sent Successfully. Valid Till 5 minutes']);
        } else {
            return response()->json(['status' => false, 'msg' => 'Something went wrong!']);
        }
    }

    public  function verify_code(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp'   => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            die();
        }
        $message = '';
        $otp = Session::get('otp');
        if ($otp == $request->otp) {
            Session::forget('otp');
            $response = ['status' => true, 'msg' => 'Success', 'redirect_url' => $this->url->to('my-form/')];
            return response()->json($response);
        } else {
            $response = ['status' => false, 'msg' => 'OTP did not match: Please try again...'];
            return response()->json($response);
        }
    }

    // end otp verification 
    public function store_user_details(Request $request)
    {
        $form_id = Session::get('form_id');
        $user_id = Session::get('user_id');

        if (!$form_id || !$user_id) {
            return response()->json(['status' => false, 'msg' => 'Your session has expired. Please close this window and re-open the form using the link.']);
            die;
        }






        $validation_array = [
            'first_name' => 'required',
            'phone_number' => 'required|digits:10',
            'gender' => 'required',
            'marital_status' => 'required',
            'category' => 'required',
            'present_house_number' => 'required',
            'present_house_street_village' => 'required',
            'present_state' => 'required',
            'present_district' => 'required',
            'present_pincode' => 'required|digits:6',
            'permanent_house_number' => 'required',
            'permanent_house_street_village' => 'required',
            'permanent_state' => 'required',
            'permanent_district' => 'required',
            'permanent_pincode' => 'required|digits:6',
            'tenth_college_name' => 'required',
            'tenth_education_type' => 'required',
            'tenth_start_year' => 'required',
            'tenth_passing_year' => 'required',
            'tenth_score' => 'required',
            'tenth_board' => 'required',
            'iti_college_name' => 'required',
            'iti_college_location' => 'required',
            'iti_college_type' => 'required',
            'iti_board_type' => 'required',
            'iti_trade' => 'required',
            'iti_passing_year' => 'required',
            'iti_score' => 'required',
            'i_agree' => 'required',
            'previous_company_work' => 'required',
            'already_worked' => 'required',
            'already_know' => 'required',
            'aadhar_card' => 'required|digits:12',
            'father_name' => 'required',
            'dob' => 'required',
        ];
        $validator = Validator::make($request->all(), $validation_array);
        $domain = substr($request->email, strpos($request->email, '@') + 1);
        $domains = ['gmail.com', 'yahoo.com', 'outlook.com', 'icloud.com', 'hotmail.com', 'maruti.co.in'];
        if (in_array($domain, $domains) == false) {
            $validator->after(function ($validator) {
                $validator->errors()->add('email', 'You have Entered a Wrong Email Address. Please enter a valid Email Address to Proceed.');
            });
        }
        if ($validator->fails()) {
            $my_array = array_keys($validation_array);
            $to_remove = $validator->errors()->keys();
            $result_array = array_diff($my_array, $to_remove);
            return response()->json(['status' => false, 'errors' => $validator->errors(), 'msg' => "Field Error!", 'first_error' => $validator->errors()->keys()[0], 'success_input' => $result_array]);
        }



        $find = RegistrationLink::find($form_id);
        $cat_name = RegistrationCategory::select('title', 'name')->where('id', $find->form_category)->first();
        if (empty($cat_name)) {
            return response()->json(['status' => false, 'msg' => 'Category not found']);
            die;
        }

        $user = User::find($user_id);
        if (!$user) {
            $user = new User();
        }



        $user->full_name = strtoupper($request->first_name) . ' ' . strtoupper($request->middle_name) . ' ' . strtoupper($request->last_name);
        $user->first_name = strtoupper($request->first_name);
        $user->middle_name = strtoupper($request->middle_name);
        $user->last_name = strtoupper($request->last_name);
        $user->dob = date('d-m-Y', strtotime($request->dob));
        $user->phone_number = $request->phone_number;
        $user->alternative_number = $request->alternative_number;
        $user->whats_app_number = $request->phone_number;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->marital_status = $request->marital_status;
        $user->category = $request->category;
        $user->aadhar_card = $request->aadhar_card;
        $user->pan_card = $request->pan_card;
        $user->blood_group = $request->blood_group;
        $user->present_house_number = $request->present_house_number;
        $user->present_house_street_village = $request->present_house_street_village;
        $user->present_state = $request->present_state;
        $user->present_district = $request->present_district;
        $user->present_pincode = $request->present_pincode;
        $user->permanent_house_number = $request->permanent_house_number;
        $user->permanent_house_street_village = $request->permanent_house_street_village;
        $user->permanent_state = $request->permanent_state;
        $user->permanent_district = $request->permanent_district;
        $user->permanent_pincode = $request->permanent_pincode;
        $user->father_name = strtoupper($request->father_name);
        $user->father_age = $request->father_age;
        $user->father_occupation = $request->father_occupation;
        $user->father_annual_income = $request->father_annual_income;
        $user->mother_name = strtoupper($request->mother_name);
        $user->mother_age = $request->mother_age;
        $user->mother_occupation = $request->mother_occupation;
        $user->mother_annual_income = $request->mother_annual_income;
        $user->wife_name = strtoupper($request->wife_name);
        $user->wife_age = $request->wife_age;
        $user->wife_occupation = $request->wife_occupation;
        $user->wife_annual_income = $request->wife_annual_income;
        $user->s1name = strtoupper($request->s1name);
        $user->s1sage = $request->s1sage;
        $user->s1soccupation = $request->s1soccupation;
        $user->s1sannualincome = $request->s1sannualincome;
        $user->s2name = strtoupper($request->s2name);
        $user->s2sage = $request->s2sage;
        $user->s2soccupation = $request->s2soccupation;
        $user->s2sannualincome = $request->s2sannualincome;
        $user->s3name = strtoupper($request->s3name);
        $user->s3sage = $request->s3sage;
        $user->s3soccupation = $request->s3soccupation;
        $user->s3sannualincome = $request->s3sannualincome;
        $user->child1name = strtoupper($request->child1name);
        $user->child1sage = $request->child1sage;
        $user->child2name = strtoupper($request->child2name);
        $user->child2sage = $request->child2sage;
        $user->child3name = strtoupper($request->child3name);
        $user->child3sage = $request->child3sage;
        $user->tenth_college_name = $request->tenth_college_name;
        $user->tenth_education_type = $request->tenth_education_type;
        $user->tenth_start_year = $request->tenth_start_year;
        $user->tenth_passing_year = $request->tenth_passing_year;
        $user->tenth_score = $request->tenth_score;
        $user->twelve_college_name = $request->twelve_college_name;
        $user->twelve_education_type = $request->twelve_education_type;
        $user->twelve_start_year = $request->twelve_start_year;
        $user->twelve_passing_year = $request->twelve_passing_year;
        $user->twelve_score = $request->twelve_score;
        $user->other_college_name = $request->other_college_name;
        $user->other_education_type = $request->other_education_type;
        $user->other_start_year = $request->other_start_year;
        $user->other_passing_year = $request->other_passing_year;
        $user->other_score = $request->other_score;
        $user->iti_college_name = $request->iti_college_name;
        $user->iti_college_location = $request->iti_college_location;
        $user->iti_college_type = $request->iti_college_type;
        $user->iti_board_type = $request->iti_board_type;
        $user->iti_trade = $request->iti_trade;
        $user->other_trade = $request->other_trade;
        $user->iti_passing_year = $request->iti_passing_year;
        $user->iti_score = $request->iti_score;
        $user->apprentice = $request->apprentice;
        $user->apprentice_company_name = $request->apprentice_company_name;
        $user->apprentice_start_date = ($request->apprentice_start_date) ? date('Y-m-d', strtotime($request->apprentice_start_date)) : null;
        $user->apprentice_end_date = ($request->apprentice_end_date) ? date('Y-m-d', strtotime($request->apprentice_end_date)) : null;
        $user->apprentice_location = $request->apprentice_location;
        $user->apprentice_division = $request->apprentice_division;
        $user->apprentice_salary = $request->apprentice_salary;
        $user->previous_company_name = $request->previous_company_name;
        $user->previous_company_work = $request->previous_company_work;
        $user->previous_company_start_date = $request->previous_company_start_date;
        $user->previous_company_end_date = $request->previous_company_end_date;
        $user->previous_company_location = $request->previous_company_location;
        $user->previous_company_type = $request->previous_company_type;
        $user->previous_company_division = $request->previous_company_division;
        $user->previous_company_salary = $request->previous_company_salary;
        $user->previous_company_name_two = $request->previous_company_name_two;
        $user->previous_company_start_date_two = $request->previous_company_start_date_two;
        $user->previous_company_end_date_two = $request->previous_company_end_date_two;
        $user->previous_company_location_two = $request->previous_company_location_two;
        $user->previous_company_type_two = $request->previous_company_type_two;
        $user->previous_company_division_two = $request->previous_company_division_two;
        $user->previous_company_salary_two = $request->previous_company_salary_two;
        $user->previous_company_name_three = $request->previous_company_name_three;
        $user->previous_company_start_date_three = $request->previous_company_start_date_three;
        $user->previous_company_end_date_three = $request->previous_company_end_date_three;
        $user->previous_company_location_three = $request->previous_company_location_three;
        $user->previous_company_type_three = $request->previous_company_type_three;
        $user->previous_company_division_three = $request->previous_company_division_three;
        $user->previous_company_salary_three = $request->previous_company_salary_three;

        $user->msword = ($request->msword) ? 'YES' : 'NO';
        $user->msexcel = ($request->msexcel) ? 'YES' : 'NO';
        $user->internet = ($request->internet) ? 'YES' : 'NO';
        $user->basic = ($request->basic) ? 'YES' : 'NO';
        $user->nil = ($request->nil) ? 'YES' : 'NO';

        $user->physically_handicapped = $request->physically_handicapped;
        $user->physically_handicap_information = $request->physically_handicap_information;
        $user->car_driving = $request->car_driving;
        $user->epilepsy = $request->epilepsy;
        $user->driving_license = $request->driving_license;
        $user->detail_of_past_surgery = $request->detail_of_past_surgery;
        $user->medically_unfit = $request->medically_unfit;
        $user->applied_before = $request->applied_before;
        $user->already_worked = $request->already_worked;
        $user->already_worked_category = $request->already_worked_category;
        $user->already_worked_staff_id = $request->already_worked_staff_id;
        $user->already_worked_time_period = $request->already_worked_time_period;
        $user->already_worked_shop_location = $request->already_worked_shop_location;
        $user->already_know = $request->already_know;
        $user->already_know_full_name = $request->already_know_full_name;
        $user->already_know_department = $request->already_know_department;
        $user->already_know_location = $request->already_know_location;
        $user->already_know_mobile = $request->already_know_mobile;
        $user->already_know_relation = $request->already_know_relation;
        $user->tenth_board = $request->tenth_board;
        $user->twelve_board = $request->twelve_board;
        $user->have_you_applied = $request->have_you_applied;
        $user->form_category = $find->form_category;
        $user->registration_date = date("Y-m-d");
        $user->next_registration_date = date("Y-m-d", strtotime("+3 months", strtotime(now())));
        $user->form_complete_status = 'Complete';
        $user->company = $find->company;


       

        if (date('Y-m-d', strtotime('25 years 9 months ago')) > date('Y-m-d', strtotime($request->dob)) || $request->epilepsy == 'YES' || $request->physically_handicapped == 'YES' ||  $request->gender == 'OTHER' ||  $request->gender == 'FEMALE') {
            $user->eligibility = "Not Eligible";
        } else {
            $user->eligibility = "Eligible";
        };





        $disk = Storage::disk('gcs');


        if ($request->file('passport_photo')) {
            $file = $request->file('passport_photo');
            $fnn = rand() . '.' . $file->getClientOriginalExtension();
            if ($file->getMimeType() == 'image/jpeg') {
                $source_image = imagecreatefromjpeg($file->path());
                imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
            } elseif ($file->getMimeType()  == 'image/png') {
                $source_image = imagecreatefrompng($file->path());
                imagepng($source_image, $file->path(), 3);
            }
            $disk->put($fnn, File::get($file));
            $disk->setVisibility($fnn, 'public');
            $user->passport_photo = $fnn;
        }
        if ($request->file('tenth_certificate')) {
            $file = $request->file('tenth_certificate');
            $fnn = rand() . '.' . $file->getClientOriginalExtension();
            if ($file->getMimeType() == 'image/jpeg') {
                $source_image = imagecreatefromjpeg($file->path());
                imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
            } elseif ($file->getMimeType()  == 'image/png') {
                $source_image = imagecreatefrompng($file->path());
                imagepng($source_image, $file->path(), 3);
            }
            $disk->put($fnn, File::get($file));
            $disk->setVisibility($fnn, 'public');
            $user->tenth_certificate = $fnn;
        }
        if ($request->file('twelve_certificate')) {
            $file = $request->file('twelve_certificate');
            $fnn = rand() . '.' . $file->getClientOriginalExtension();
            if ($file->getMimeType() == 'image/jpeg') {
                $source_image = imagecreatefromjpeg($file->path());
                imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
            } elseif ($file->getMimeType()  == 'image/png') {
                $source_image = imagecreatefrompng($file->path());
                imagepng($source_image, $file->path(), 3);
            }
            $disk->put($fnn, File::get($file));
            $disk->setVisibility($fnn, 'public');
            $user->twelve_certificate = $fnn;
        }
        if ($request->file('iti_certificate')) {
            $file = $request->file('iti_certificate');
            $fnn = rand() . '.' . $file->getClientOriginalExtension();
            if ($file->getMimeType() == 'image/jpeg') {
                $source_image = imagecreatefromjpeg($file->path());
                imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
            } elseif ($file->getMimeType()  == 'image/png') {
                $source_image = imagecreatefrompng($file->path());
                imagepng($source_image, $file->path(), 3);
            }
            $disk->put($fnn, File::get($file));
            $disk->setVisibility($fnn, 'public');
            $user->iti_certificate = $fnn;
        }
        if ($request->file('aadhar_card_front')) {
            $file = $request->file('aadhar_card_front');
            $fnn = rand() . '.' . $file->getClientOriginalExtension();
            if ($file->getMimeType() == 'image/jpeg') {
                $source_image = imagecreatefromjpeg($file->path());
                imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
            } elseif ($file->getMimeType()  == 'image/png') {
                $source_image = imagecreatefrompng($file->path());
                imagepng($source_image, $file->path(), 3);
            }
            $disk->put($fnn, File::get($file));
            $disk->setVisibility($fnn, 'public');
            $user->aadhar_card_front = $fnn;
        }
        if ($request->file('aadhar_card_back')) {
            $file = $request->file('aadhar_card_back');
            $fnn = rand() . '.' . $file->getClientOriginalExtension();
            if ($file->getMimeType() == 'image/jpeg') {
                $source_image = imagecreatefromjpeg($file->path());
                imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
            } elseif ($file->getMimeType()  == 'image/png') {
                $source_image = imagecreatefrompng($file->path());
                imagepng($source_image, $file->path(), 3);
            }
            $disk->put($fnn, File::get($file));
            $disk->setVisibility($fnn, 'public');
            $user->aadhar_card_back = $fnn;
        }
        if ($request->file('pancard')) {
            $file = $request->file('pancard');
            $fnn = rand() . '.' . $file->getClientOriginalExtension();
            if ($file->getMimeType() == 'image/jpeg') {
                $source_image = imagecreatefromjpeg($file->path());
                imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
            } elseif ($file->getMimeType()  == 'image/png') {
                $source_image = imagecreatefrompng($file->path());
                imagepng($source_image, $file->path(), 3);
            }
            $disk->put($fnn, File::get($file));
            $disk->setVisibility($fnn, 'public');
            $user->pancard = $fnn;
        }


        if ($request->i_agree == 'on') {
            $user->agreed = 'YES';
        } else {
            $user->agreed = 'NO';
        }





        $unique_start_string = ($cat_name->title == 'Apprentice') ? 'AP' : $cat_name->title;
        $unique_start_string = 'SH' . $unique_start_string;
        $unique_id = $unique_start_string . '00000000';
        $string_length = strlen((string)$user->id);
        $user->unique_id = substr($unique_id, 0, '-' . $string_length) . (string)$user->id;
        $user->save();

        $company = Company::find($user->company, ['name']);
        CandidateStatus::where('user_id', $user->id)->delete();
        $status = new CandidateStatus();
        $status->user_id = $user->id;
        $status->save();

        Session::flush();
        Session::put(['unique_id' => $user->unique_id]);
        try {
            $details = [
                'subject' => 'Successfully Registered',
                'site_name' => env('APP_NAME'),
                'name' => $user->full_name,
                'company_name' => ($company && $company->name) ? $company->name : '',
                'category' => $cat_name->title,
                'unique_id' => $user->unique_id,
            ];
            // Mail::to($user->email)->send(new SuccessMail($details));
        } catch (Exception $e) {
            return response()->json(['status' => false, 'msg' => 'Successfully registration completed, message not be sent', 'email_error' => $e]);
        }
        return response()->json(['status' => true, 'msg' => 'Success', 'redirect_url' => url('confirm-form')]);
    }





    public function update_candidate_detail(Request $request)
    {
        $validation_array = [
            'first_name' => 'required',
            'phone_number' => 'required|digits:10',
            'gender' => 'required',
            'marital_status' => 'required',
            'category' => 'required',
            'present_house_number' => 'required',
            'present_house_street_village' => 'required',
            'present_state' => 'required',
            'present_district' => 'required',
            'present_pincode' => 'required|digits:6',
            'permanent_house_number' => 'required',
            'permanent_house_street_village' => 'required',
            'permanent_state' => 'required',
            'permanent_district' => 'required',
            'permanent_pincode' => 'required|digits:6',
            'tenth_college_name' => 'required',
            'tenth_education_type' => 'required',
            'tenth_start_year' => 'required',
            'tenth_passing_year' => 'required',
            'tenth_score' => 'required',
            'tenth_board' => 'required',
            'iti_college_name' => 'required',
            'iti_college_location' => 'required',
            'iti_college_type' => 'required',
            'iti_board_type' => 'required',
            'iti_trade' => 'required',
            'iti_passing_year' => 'required',
            'iti_score' => 'required',
            'i_agree' => 'required',
            'previous_company_work' => 'required',
            'already_worked' => 'required',
            'already_know' => 'required',
            'email' => 'email|unique:users,email,' . $request->user_id,
            'aadhar_card' => 'required|digits:12|unique:users,aadhar_card,' . $request->user_id,
            'father_name' => 'required',
            'dob' => 'required',
            "passport_photo" => "image|mimes:jpeg,png,jpg",
            "pancard" => "image|mimes:jpeg,png,jpg",
            "aadhar_card_back" => "image|mimes:jpeg,png,jpg",
            "aadhar_card_front" => "image|mimes:jpeg,png,jpg",
            "iti_certificate" => "image|mimes:jpeg,png,jpg",
            "twelve_certificate" => "image|mimes:jpeg,png,jpg",
            "tenth_certificate" => "image|mimes:jpeg,png,jpg",


        ];
        $validator = Validator::make($request->all(), $validation_array);
        $domain = substr($request->email, strpos($request->email, '@') + 1);
        $domains = ['gmail.com', 'yahoo.com', 'outlook.com', 'icloud.com', 'hotmail.com', 'maruti.co.in'];
        if (in_array($domain, $domains) == false) {
            $validator->after(function ($validator) {
                $validator->errors()->add('email', 'You have Entered a Wrong Email Address. Please enter a valid Email Address to Proceed.');
            });
        }
        if ($validator->fails()) {
            $my_array = array_keys($validation_array);
            $to_remove = $validator->errors()->keys();
            $result_array = array_diff($my_array, $to_remove);
            return response()->json(['status' => false, 'errors' => $validator->errors(), 'msg' => "Field Error!", 'first_error' => $validator->errors()->keys()[0], 'success_input' => $result_array]);
        }



        $user = User::find($request->user_id);
        $user->first_name = strtoupper($request->first_name);
        $user->middle_name = strtoupper($request->middle_name);
        $user->last_name = strtoupper($request->last_name);
        $user->full_name = strtoupper($request->first_name) . ' ' . strtoupper($request->middle_name) . ' ' . strtoupper($request->first_name);

        $user->dob = date('d-m-Y', strtotime($request->dob));
        $user->phone_number = $request->phone_number;
        $user->alternative_number = $request->alternative_number;
        $user->whats_app_number = $request->phone_number;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->marital_status = $request->marital_status;
        $user->category = $request->category;
        $user->aadhar_card = $request->aadhar_card;
        $user->pan_card = $request->pan_card;
        $user->blood_group = $request->blood_group;
        $user->present_house_number = $request->present_house_number;
        $user->present_house_street_village = $request->present_house_street_village;
        $user->present_state = $request->present_state;
        $user->present_district = $request->present_district;
        $user->present_pincode = $request->present_pincode;
        $user->permanent_house_number = $request->permanent_house_number;
        $user->permanent_house_street_village = $request->permanent_house_street_village;
        $user->permanent_state = $request->permanent_state;
        $user->permanent_district = $request->permanent_district;
        $user->permanent_pincode = $request->permanent_pincode;

        $user->father_name = strtoupper($request->father_name);
        $user->father_age = $request->father_age;
        $user->father_occupation = $request->father_occupation;
        $user->father_annual_income = $request->father_annual_income;
        $user->mother_name = strtoupper($request->mother_name);
        $user->mother_age = $request->mother_age;
        $user->mother_occupation = $request->mother_occupation;
        $user->mother_annual_income = $request->mother_annual_income;
        $user->wife_name = strtoupper($request->wife_name);
        $user->wife_age = $request->wife_age;
        $user->wife_occupation = $request->wife_occupation;
        $user->wife_annual_income = $request->wife_annual_income;
        $user->s1name = strtoupper($request->s1name);
        $user->s1sage = $request->s1sage;
        $user->s1soccupation = $request->s1soccupation;
        $user->s1sannualincome = $request->s1sannualincome;
        $user->s2name = strtoupper($request->s2name);
        $user->s2sage = $request->s2sage;
        $user->s2soccupation = $request->s2soccupation;
        $user->s2sannualincome = $request->s2sannualincome;
        $user->s3name = strtoupper($request->s3name);
        $user->s3sage = $request->s3sage;
        $user->s3soccupation = $request->s3soccupation;
        $user->s3sannualincome = $request->s3sannualincome;
        $user->child1name = strtoupper($request->child1name);
        $user->child1sage = $request->child1sage;
        $user->child2name = strtoupper($request->child2name);
        $user->child2sage = $request->child2sage;
        $user->child3name = strtoupper($request->child3name);
        $user->child3sage = $request->child3sage;


        $user->tenth_college_name = $request->tenth_college_name;
        $user->tenth_board = $request->tenth_board;
        $user->tenth_education_type = $request->tenth_education_type;
        $user->tenth_start_year = $request->tenth_start_year;
        $user->tenth_passing_year = $request->tenth_passing_year;
        $user->tenth_score = $request->tenth_score;





        $user->twelve_college_name = $request->twelve_college_name;
        $user->twelve_board = $request->twelve_board;
        $user->twelve_education_type = $request->twelve_education_type;
        $user->twelve_start_year = $request->twelve_start_year;
        $user->twelve_passing_year = $request->twelve_passing_year;
        $user->twelve_score = $request->twelve_score;


        $user->other_college_name = $request->other_college_name;
        $user->other_education_type = $request->other_education_type;
        $user->other_start_year = $request->other_start_year;
        $user->other_passing_year = $request->other_passing_year;
        $user->other_score = $request->other_score;

        $user->iti_college_name = $request->iti_college_name;
        $user->iti_college_location = $request->iti_college_location;
        $user->iti_college_type = $request->iti_college_type;
        $user->iti_board_type = $request->iti_board_type;
        $user->iti_trade = $request->iti_trade;
        $user->other_trade = $request->other_trade;
        $user->iti_passing_year = $request->iti_passing_year;
        $user->iti_score = $request->iti_score;


        $user->apprentice = $request->apprentice;
        $user->apprentice_company_name = $request->apprentice_company_name;
        $user->apprentice_start_date = ($request->apprentice_start_date) ? date('Y-m-d', strtotime($request->apprentice_start_date)) : null;
        $user->apprentice_end_date = ($request->apprentice_end_date) ? date('Y-m-d', strtotime($request->apprentice_end_date)) : null;
        $user->apprentice_location = $request->apprentice_location;
        $user->apprentice_division = $request->apprentice_division;
        $user->apprentice_salary = $request->apprentice_salary;
        $user->previous_company_name = $request->previous_company_name;
        $user->previous_company_work = $request->previous_company_work;
        $user->previous_company_start_date = $request->previous_company_start_date;
        $user->previous_company_end_date = $request->previous_company_end_date;
        $user->previous_company_location = $request->previous_company_location;
        $user->previous_company_type = $request->previous_company_type;
        $user->previous_company_division = $request->previous_company_division;
        $user->previous_company_salary = $request->previous_company_salary;
        $user->previous_company_name_two = $request->previous_company_name_two;
        $user->previous_company_start_date_two = $request->previous_company_start_date_two;
        $user->previous_company_end_date_two = $request->previous_company_end_date_two;
        $user->previous_company_location_two = $request->previous_company_location_two;
        $user->previous_company_type_two = $request->previous_company_type_two;
        $user->previous_company_division_two = $request->previous_company_division_two;
        $user->previous_company_salary_two = $request->previous_company_salary_two;
        $user->previous_company_name_three = $request->previous_company_name_three;
        $user->previous_company_start_date_three = $request->previous_company_start_date_three;
        $user->previous_company_end_date_three = $request->previous_company_end_date_three;
        $user->previous_company_location_three = $request->previous_company_location_three;
        $user->previous_company_type_three = $request->previous_company_type_three;
        $user->previous_company_division_three = $request->previous_company_division_three;
        $user->previous_company_salary_three = $request->previous_company_salary_three;

        $user->msword = ($request->msword) ? $request->msword : "NO";
        $user->msexcel = ($request->msexcel) ? $request->msexcel : "NO";
        $user->internet = ($request->internet) ? $request->internet : "NO";
        $user->basic = ($request->basic) ? $request->basic : "NO";
        $user->nil = ($request->nil) ? $request->nil : "NO";

        $user->physically_handicapped = $request->physically_handicapped;
        $user->physically_handicap_information = $request->physically_handicap_information;
        $user->car_driving = $request->car_driving;
        $user->driving_license = $request->driving_license;

        $user->epilepsy = $request->epilepsy;
        $user->detail_of_past_surgery = $request->detail_of_past_surgery;
        $user->medically_unfit = $request->medically_unfit;

        $user->applied_before = $request->applied_before;
        $user->already_worked = $request->already_worked;
        $user->already_worked_category = $request->already_worked_category;
        $user->already_worked_staff_id = $request->already_worked_staff_id;
        $user->already_worked_time_period = $request->already_worked_time_period;
        $user->already_worked_shop_location = $request->already_worked_shop_location;

        $user->already_know = $request->already_know;
        $user->already_know_full_name = $request->already_know_full_name;
        $user->already_know_department = $request->already_know_department;
        $user->already_know_location = $request->already_know_location;
        $user->already_know_mobile = $request->already_know_mobile;
        $user->already_know_relation = $request->already_know_relation;

        $user->have_you_applied = $request->have_you_applied;
        $user->eligibility = $request->eligibility;
        $user->not_eligibility = $request->not_eligibility;

        $disk = Storage::disk('gcs');
        if ($request->file('passport_photo')) {
            $file = $request->file('passport_photo');
            $fnn = rand() . '.' . $file->getClientOriginalExtension();
            if ($file->getMimeType() == 'image/jpeg') {
                $source_image = imagecreatefromjpeg($file->path());
                imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
            } elseif ($file->getMimeType()  == 'image/png') {
                $source_image = imagecreatefrompng($file->path());
                imagepng($source_image, $file->path(), 3);
            }
            $disk->put($fnn, File::get($file));
            $disk->setVisibility($fnn, 'public');
            $user->passport_photo = $fnn;
        }
        if ($request->file('tenth_certificate')) {
            $file = $request->file('tenth_certificate');
            $fnn = rand() . '.' . $file->getClientOriginalExtension();
            if ($file->getMimeType() == 'image/jpeg') {
                $source_image = imagecreatefromjpeg($file->path());
                imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
            } elseif ($file->getMimeType()  == 'image/png') {
                $source_image = imagecreatefrompng($file->path());
                imagepng($source_image, $file->path(), 3);
            }
            $disk->put($fnn, File::get($file));
            $disk->setVisibility($fnn, 'public');
            $user->tenth_certificate = $fnn;
        }
        if ($request->file('twelve_certificate')) {
            $file = $request->file('twelve_certificate');
            $fnn = rand() . '.' . $file->getClientOriginalExtension();
            if ($file->getMimeType() == 'image/jpeg') {
                $source_image = imagecreatefromjpeg($file->path());
                imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
            } elseif ($file->getMimeType()  == 'image/png') {
                $source_image = imagecreatefrompng($file->path());
                imagepng($source_image, $file->path(), 3);
            }
            $disk->put($fnn, File::get($file));
            $disk->setVisibility($fnn, 'public');
            $user->twelve_certificate = $fnn;
        }
        if ($request->file('iti_certificate')) {
            $file = $request->file('iti_certificate');
            $fnn = rand() . '.' . $file->getClientOriginalExtension();
            if ($file->getMimeType() == 'image/jpeg') {
                $source_image = imagecreatefromjpeg($file->path());
                imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
            } elseif ($file->getMimeType()  == 'image/png') {
                $source_image = imagecreatefrompng($file->path());
                imagepng($source_image, $file->path(), 3);
            }
            $disk->put($fnn, File::get($file));
            $disk->setVisibility($fnn, 'public');
            $user->iti_certificate = $fnn;
        }
        if ($request->file('aadhar_card_front')) {
            $file = $request->file('aadhar_card_front');
            $fnn = rand() . '.' . $file->getClientOriginalExtension();
            if ($file->getMimeType() == 'image/jpeg') {
                $source_image = imagecreatefromjpeg($file->path());
                imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
            } elseif ($file->getMimeType()  == 'image/png') {
                $source_image = imagecreatefrompng($file->path());
                imagepng($source_image, $file->path(), 3);
            }
            $disk->put($fnn, File::get($file));
            $disk->setVisibility($fnn, 'public');
            $user->aadhar_card_front = $fnn;
        }
        if ($request->file('aadhar_card_back')) {
            $file = $request->file('aadhar_card_back');
            $fnn = rand() . '.' . $file->getClientOriginalExtension();
            if ($file->getMimeType() == 'image/jpeg') {
                $source_image = imagecreatefromjpeg($file->path());
                imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
            } elseif ($file->getMimeType()  == 'image/png') {
                $source_image = imagecreatefrompng($file->path());
                imagepng($source_image, $file->path(), 3);
            }
            $disk->put($fnn, File::get($file));
            $disk->setVisibility($fnn, 'public');
            $user->aadhar_card_back = $fnn;
        }
        if ($request->file('pancard')) {
            $file = $request->file('pancard');
            $fnn = rand() . '.' . $file->getClientOriginalExtension();
            if ($file->getMimeType() == 'image/jpeg') {
                $source_image = imagecreatefromjpeg($file->path());
                imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
            } elseif ($file->getMimeType()  == 'image/png') {
                $source_image = imagecreatefrompng($file->path());
                imagepng($source_image, $file->path(), 3);
            }
            $disk->put($fnn, File::get($file));
            $disk->setVisibility($fnn, 'public');
            $user->pancard = $fnn;
        }

        $user->save();

        if (!isset($request->user_id)) {
            try {
                $details = [
                    'subject' => 'Successfully Registered',
                    'site_name' => env('APP_NAME'),
                    'name' => $user->full_name,
                    'company_name' => $user->getCompany->name,
                    'category' => $user->getFormCategory->title,
                    'unique_id' => $user->unique_id,
                ];
                Mail::to($user->email)->send(new SuccessMail($details));
            } catch (Exception $e) {
                return response()->json(['status' => false, 'msg' => 'Successfully registration completed, message not be sent', 'email_error' => $e]);
            }
        }
        return response()->json(['status' => true, 'msg' => 'Success', 'redirect_url' => url('confirm-form')]);
    }

    public function registration_form()
    {
        $form_id = Session::get('form_id');
        $email = Session::get('email');
        $find = RegistrationLink::find($form_id, ['company', 'state', 'form_category', 'description', 'closed_time']);



        if ($find && $email) {
            $states = State::select(['id', 'name'])->get();
            $pr_state = State::select(['id', 'name'])->whereIn('id', explode(',', $find->state))->get();
            $company = Company::select('logo', 'prefix','id')->find($find->company);
            $user = User::where('email', $email)->first();
            $trades=Trade::where('company',$company->id)->get(['id','name']);


            if ($user) {
                $other = UserOtherInfo::where('user_id', $user->id)->first();
                if (!$other) {
                    $other = new UserOtherInfo();
                    $other->user_id = $user->id;
                    $other->save();
                }

                Session::put(['user_id' => $user->id]);
                return view('company.' . strtolower($company->prefix) . '.reg_form', compact('states', 'user', 'company', 'pr_state', 'form_id', 'find', 'other','trades'));
            } else {
                $user = new User();
                $user->email = $email;
                $user->form_complete_status == 'Incomplete';
                $user->company = $find->company;
                $user->save();

                $other = UserOtherInfo::where('user_id', $user->id)->first();
                if (!$other) {
                    $other = new UserOtherInfo();
                    $other->user_id = $user->id;
                    $other->save();
                }

                Session::put(['user_id' => $user->id]);
                return view('company.' . strtolower($company->prefix) . '.reg_form', compact('states', 'user', 'company', 'pr_state', 'form_id', 'find', 'other','trades'));
            }
        } else {
            return abort(419);
        }
    }


    // step 1
    public function store_personal_detail(Request $request)
    {
        $email_id = '';
        $user_id = '';
        if ($request->op_type && $request->op_type == 'EDIT') {
            $email_id = $request->email_id;
            $user_id = $request->user_id;
        } else {
            $email_id = Session::get('email');
            $user_id =  Session::get('user_id');
        }

        if ($email_id && $user_id) {
            $validation_array = [
                'form_category' => 'required',
                'iti_college_name' => 'required|max:100',
                'iti_trade' => 'required',
                'full_name' => 'required|max:40',
                'gender' => 'required|max:20',
                'father_name' => 'required|max:40',
                'dob' => 'required',
                'age' => 'numeric|max:99|nullable',
                'birth_place' => 'max:30|nullable',
                'religion' => 'string|max:20|nullable',
                'category' => 'required|max:8',
                'mother_tongue' => 'required|max:20',
                'domicile' => 'required|max:20',
                'blood_group' => 'max:5|nullable',
                'height' => 'max:20|nullable',
                'weight' => 'required|numeric|max:120',
                'marital_status' => 'required|max:9',
                'marriage_date' => 'date|nullable',
                'aadhar_card' => 'required|digits:12|unique:users,aadhar_card,' . $user_id, 'id',
                'pancard' => 'string|max:14|nullable',
                'email' => 'email:rfc,dns|unique:users,email,' . $user_id, 'id',
            ];


            $validator = Validator::make($request->all(), $validation_array);
            $domain = substr($request->email, strpos($request->email, '@') + 1);
            $domains = ['gmail.com', 'yahoo.com', 'outlook.com', 'icloud.com', 'hotmail.com', 'maruti.co.in'];
            if (in_array($domain, $domains) == false) {
                $validator->after(function ($validator) {
                    $validator->errors()->add('email', 'You have Entered a Wrong Email Address. Please enter a valid Email Address to Proceed.');
                });
            }
            if ($validator->fails()) {
                $my_array = array_keys($validation_array);
                $to_remove = $validator->errors()->keys();
                $result_array = array_diff($my_array, $to_remove);
                return response()->json(['status' => false, 'errors' => $validator->errors(), 'msg' => "Field Error!", 'first_error' => $validator->errors()->keys()[0], 'success_input' => $result_array]);
            }

            DB::beginTransaction();
            try {
                $user = User::find($user_id);
                $other = UserOtherInfo::where('user_id', $user_id)->first();
                if ($user && $other) {
                    $user->form_category = $request->form_category;
                    $user->iti_college_name = $request->iti_college_name;
                    $user->iti_trade = $request->iti_trade;
                    $user->full_name = $request->full_name;
                    $user->gender = $request->gender;
                    $user->dob = $request->dob;
                    $user->father_name = $request->father_name;
                    $user->category = $request->category;
                    $user->blood_group = $request->blood_group;
                    $user->marital_status = $request->marital_status;
                    $user->aadhar_card = $request->aadhar_card;
                    $user->pancard = $request->pancard;
                    $user->email = $request->email;
                    $other->age = $request->age;
                    $other->birth_place = $request->birth_place;
                    $other->religion = $request->religion;
                    $other->mother_tongue = $request->mother_tongue;
                    $other->domicile = $request->domicile;
                    $other->height = $request->height;
                    $other->weight = $request->weight;
                    $other->marriage_date = $request->marriage_date;
                    if ($user->save() && $other->save()) {
                        DB::commit();
                        return response()->json(['status' => true]);
                    } else {
                        DB::rollback();
                        return response()->json(['status' => false]);
                    }
                } else {
                    return response()->json(['status' => false, 'msg' => "Something went wrong!"]);
                }
            } catch (\Throwable $e) {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => $e]);
            }
        } else {
            return response()->json(['status' => false, 'msg' => "Your session has expired"]);
        }
    }

    // step 2
    public function store_family_detail(Request $request)
    {
        $email_id = '';
        $user_id = '';
        if ($request->op_type && $request->op_type == 'EDIT') {
            $email_id = $request->email_id;
            $user_id = $request->user_id;
        } else {
            $email_id = Session::get('email');
            $user_id =  Session::get('user_id');
        }
        if ($email_id && $user_id) {
            $validation_array = [
                'grandpa_name' => 'max:30|nullable',
                'grandpa_education' => 'max:30|nullable',
                'grandpa_age' => 'numeric|max:120|nullable',
                'grandpa_profession' => 'max:30|nullable',
                'grandpa_income' => 'max:30|nullable',
                'grandpa_property' => 'max:30|nullable',
                'grandpa_other_income' => 'max:30|nullable',
                'grandpa_contact_no' => 'max:30|nullable',

                'grandmother_name' => 'max:30|nullable',
                'grandmother_education' => 'max:30|nullable',
                'grandmother_age' => 'numeric|max:120|nullable',
                'grandmother_profession' => 'max:30|nullable',
                'grandmother_income' => 'max:30|nullable',
                'grandmother_property' => 'max:30|nullable',
                'grandmother_other_income' => 'max:30|nullable',
                'grandmother_contact_no' => 'max:30|nullable',

                'father_education' => 'max:30|nullable',
                'father_age' => 'required|numeric|max:120|nullable',
                'father_occupation' => 'required|max:40|nullable',
                'father_annual_income' => 'required|numeric',
                'father_property' => 'max:30|nullable',
                'father_other_income' => 'max:30|nullable',
                'father_contact_no' => 'max:30|nullable',

                'mother_name' => 'max:30|nullable',
                'mother_education' => 'max:30|nullable',
                'mother_age' => 'numeric|max:120|nullable',
                'mother_occupation' => 'max:40|nullable',
                'mother_annual_income' => 'numeric|nullable',
                'mother_property' => 'max:30|nullable',
                'mother_other_income' => 'max:30|nullable',
                'mother_contact_no' => 'max:30|nullable',


                'guardian_name' => 'max:30|nullable',
                'guardian_education' => 'max:30|nullable',
                'guardian_age' => 'numeric|max:120|nullable',
                'guardian_profession' => 'max:40|nullable',
                'guardian_annual_income' => 'numeric|nullable',
                'guardian_property' => 'max:30|nullable',
                'guardian_income' => 'max:30|nullable',
                'guardian_contact_no' => 'max:30|nullable',

                'uncle1_name' => 'max:30|nullable',
                'uncle1_education' => 'max:30|nullable',
                'uncle1_age' => 'numeric|max:120|nullable',
                'uncle1_profession' => 'max:40|nullable',
                'uncle1_income' => 'numeric|nullable',
                'uncle1_property' => 'max:30|nullable',
                'uncle1_other_income' => 'max:30|nullable',
                'uncle1_contact_no' => 'max:30|nullable',


                'uncle2_name' => 'max:30|nullable',
                'uncle2_education' => 'max:30|nullable',
                'uncle2_age' => 'numeric|max:120|nullable',
                'uncle2_profession' => 'max:40|nullable',
                'uncle2_income' => 'numeric|nullable',
                'uncle2_property' => 'max:30|nullable',
                'uncle2_other_income' => 'max:30|nullable',
                'uncle2_contact_no' => 'max:30|nullable',


                'wife_name' => 'max:30|nullable',
                'wife_education' => 'max:30|nullable',
                'wife_age' => 'numeric|max:120|nullable',
                'wife_occupation' => 'max:40|nullable',
                'wife_annual_income' => 'numeric|nullable',
                'wife_property' => 'max:30|nullable',
                'wife_other_income' => 'max:30|nullable',
                'wife_contact_no' => 'max:30|nullable',


                'child1name' => 'max:30|nullable',
                'child1_education' => 'max:30|nullable',
                'child1sage' => 'numeric|max:120|nullable',
                'child1_profession' => 'max:40|nullable',
                'child1_income' => 'numeric|nullable',
                'child1_property' => 'max:30|nullable',
                'child1_other_income' => 'max:30|nullable',
                'child1_contact_no' => 'max:30|nullable',

                'child2name' => 'max:30|nullable',
                'child2_education' => 'max:30|nullable',
                'child2sage' => 'numeric|max:120|nullable',
                'child2_profession' => 'max:40|nullable',
                'child2_income' => 'numeric|nullable',
                'child2_property' => 'max:30|nullable',
                'child2_other_income' => 'max:30|nullable',
                'child2_contact_no' => 'max:30|nullable',


                's1name' => 'max:30|nullable',
                's1_education' => 'max:30|nullable',
                's1sage' => 'numeric|max:120|nullable',
                's1soccupation' => 'max:40|nullable',
                's1sannualincome' => 'numeric|nullable',
                's1_property' => 'max:30|nullable',
                's1_other_income' => 'max:30|nullable',
                's1_contact_no' => 'max:30|nullable',

                's2name' => 'max:30|nullable',
                's2_education' => 'max:30|nullable',
                's2sage' => 'numeric|max:120|nullable',
                's2soccupation' => 'max:40|nullable',
                's2sannualincome' => 'numeric|nullable',
                's2_property' => 'max:30|nullable',
                's2_other_income' => 'max:30|nullable',
                's2_contact_no' => 'max:30|nullable',

                'mother_in_law_name' => 'max:30|nullable',
                'mother_in_law_education' => 'max:30|nullable',
                'mother_in_law_age' => 'numeric|max:120|nullable',
                'mother_in_law_profession' => 'max:40|nullable',
                'mother_in_law_income' => 'numeric|nullable',
                'mother_in_law_property' => 'max:30|nullable',
                'mother_in_law_other_income' => 'max:30|nullable',
                'mother_in_law_contact_no' => 'max:30|nullable',


                'father_in_law_name' => 'max:30|nullable',
                'father_in_law_education' => 'max:30|nullable',
                'father_in_law_age' => 'numeric|max:120|nullable',
                'father_in_law_profession' => 'max:40|nullable',
                'father_in_law_income' => 'numeric|nullable',
                'father_in_law_property' => 'max:30|nullable',
                'father_in_law_other_income' => 'max:30|nullable',
                'father_in_law_contact_no' => 'max:30|nullable',

                'brother_in_law_name' => 'max:30|nullable',
                'brother_in_law_education' => 'max:30|nullable',
                'brother_in_law_age' => 'numeric|max:120|nullable',
                'brother_in_law_profession' => 'max:40|nullable',
                'brother_in_law_income' => 'numeric|nullable',
                'brother_in_law_property' => 'max:30|nullable',
                'brother_in_law_other_income' => 'max:30|nullable',
                'brother_in_law_contact_no' => 'max:30|nullable',

                'sister_in_law_name' => 'max:30|nullable',
                'sister_in_law_education' => 'max:30|nullable',
                'sister_in_law_age' => 'numeric|max:120|nullable',
                'sister_in_law_profession' => 'max:40|nullable',
                'sister_in_law_income' => 'numeric|nullable',
                'sister_in_law_property' => 'max:30|nullable',
                'sister_in_law_other_income' => 'max:30|nullable',
                'sister_in_law_contact_no' => 'max:30|nullable',

                'fam_any_loan_lability' => 'max:30|nullable',
                'relative_government_employed' => 'max:3|nullable',
                'rel_name_gov_emp' => 'max:30|nullable',
                'rel_relation_gov_emp' => 'max:30|nullable',
                'rel_buss_gov_emp' => 'max:30|nullable',
            ];


            $validator = Validator::make($request->all(), $validation_array);
            if ($validator->fails()) {
                $my_array = array_keys($validation_array);
                $to_remove = $validator->errors()->keys();
                $result_array = array_diff($my_array, $to_remove);
                return response()->json(['status' => false, 'errors' => $validator->errors(), 'msg' => "Field Error!", 'first_error' => $validator->errors()->keys()[0], 'success_input' => $result_array]);
            }

            DB::beginTransaction();
            try {
                $user = User::find($user_id);
                $other = UserOtherInfo::where('user_id', $user_id)->first();

                if ($user && $other) {
                    $other->grandpa_name = $request->grandpa_name;
                    $other->grandpa_education = $request->grandpa_education;
                    $other->grandpa_age = $request->grandpa_age;
                    $other->grandpa_profession = $request->grandpa_profession;
                    $other->grandpa_income = $request->grandpa_income;
                    $other->grandpa_property = $request->grandpa_property;
                    $other->grandpa_other_income = $request->grandpa_other_income;
                    $other->grandpa_contact_no = $request->grandpa_contact_no;
                    $other->grandmother_name = $request->grandmother_name;
                    $other->grandmother_education = $request->grandmother_education;
                    $other->grandmother_age = $request->grandmother_age;
                    $other->grandmother_profession = $request->grandmother_profession;
                    $other->grandmother_income = $request->grandmother_income;
                    $other->grandmother_property = $request->grandmother_property;
                    $other->grandmother_other_income = $request->grandmother_other_income;
                    $other->grandmother_contact_no = $request->grandmother_contact_no;

                    $other->father_education = $request->father_education;
                    $user->father_age = $request->father_age;
                    $user->father_occupation = $request->father_occupation;
                    $user->father_annual_income = $request->father_annual_income;
                    $other->father_property = $request->father_property;
                    $other->father_other_income = $request->father_other_income;
                    $other->father_contact_no = $request->father_contact_no;
                    $user->mother_name = $request->mother_name;
                    $other->mother_education = $request->mother_education;
                    $user->mother_age = $request->mother_age;
                    $user->mother_occupation = $request->mother_occupation;
                    $user->mother_annual_income = $request->mother_annual_income;
                    $other->mother_property = $request->mother_property;
                    $other->mother_other_income = $request->mother_other_income;
                    $other->mother_contact_no = $request->mother_contact_no;
                    $other->guardian_name = $request->guardian_name;
                    $other->guardian_education = $request->guardian_education;
                    $other->guardian_age = $request->guardian_age;
                    $other->guardian_profession = $request->guardian_profession;
                    $other->guardian_income = $request->guardian_income;
                    $other->guardian_property = $request->guardian_property;
                    $other->guardian_other_income = $request->guardian_other_income;
                    $other->guardian_contact_no = $request->guardian_contact_no;
                    $other->uncle1_name = $request->uncle1_name;
                    $other->uncle1_education = $request->uncle1_education;
                    $other->uncle1_age = $request->uncle1_age;
                    $other->uncle1_profession = $request->uncle1_profession;
                    $other->uncle1_income = $request->uncle1_income;
                    $other->uncle1_property = $request->uncle1_property;
                    $other->uncle1_other_income = $request->uncle1_other_income;
                    $other->uncle1_contact_no = $request->uncle1_contact_no;
                    $other->uncle2_name = $request->uncle2_name;
                    $other->uncle2_education = $request->uncle2_education;
                    $other->uncle2_age = $request->uncle2_age;
                    $other->uncle2_profession = $request->uncle2_profession;
                    $other->uncle2_income = $request->uncle2_income;
                    $other->uncle2_property = $request->uncle2_property;
                    $other->uncle2_other_income = $request->uncle2_other_income;
                    $other->uncle2_contact_no = $request->uncle2_contact_no;
                    $user->wife_name = $request->wife_name;
                    $other->wife_education = $request->wife_education;
                    $user->wife_age = $request->wife_age;
                    $user->wife_occupation = $request->wife_occupation;
                    $user->wife_annual_income = $request->wife_annual_income;
                    $other->wife_property = $request->wife_property;
                    $other->wife_other_income = $request->wife_other_income;
                    $other->wife_contact_no = $request->wife_contact_no;
                    $user->child1name = $request->child1name;
                    $other->child1_education = $request->child1_education;
                    $user->child1sage = $request->child1sage;
                    $other->child1_profession = $request->child1_profession;
                    $other->child1_income = $request->child1_income;
                    $other->child1_property = $request->child1_property;
                    $other->child1_other_income = $request->child1_other_income;
                    $other->child1_contact_no = $request->child1_contact_no;
                    $user->child2name = $request->child2name;
                    $other->child2_education = $request->child2_education;
                    $user->child2sage = $request->child2sage;
                    $other->child2_profession = $request->child2_profession;
                    $other->child2_income = $request->child2_income;
                    $other->child2_property = $request->child2_property;
                    $other->child2_other_income = $request->child2_other_income;
                    $other->child2_contact_no = $request->child2_contact_no;
                    $user->s1name = $request->s1name;
                    $other->s1_education = $request->s1_education;
                    $user->s1sage = $request->s1sage;
                    $user->s1soccupation = $request->s1soccupation;
                    $user->s1sannualincome = $request->s1sannualincome;
                    $other->s1_property = $request->s1_property;
                    $other->s1_other_income = $request->s1_other_income;
                    $other->s1_contact_no = $request->s1_contact_no;
                    $user->s2name = $request->s2name;
                    $other->s2_education = $request->s2_education;
                    $user->s2sage = $request->s2sage;
                    $user->s2soccupation = $request->s2soccupation;
                    $user->s2sannualincome = $request->s2sannualincome;
                    $other->s2_property = $request->s2_property;
                    $other->s2_other_income = $request->s2_other_income;
                    $other->s2_contact_no = $request->s2_contact_no;
                    $other->mother_in_law_name = $request->mother_in_law_name;
                    $other->mother_in_law_education = $request->mother_in_law_education;
                    $other->mother_in_law_age = $request->mother_in_law_age;
                    $other->mother_in_law_profession = $request->mother_in_law_profession;
                    $other->mother_in_law_income = $request->mother_in_law_income;
                    $other->mother_in_law_property = $request->mother_in_law_property;
                    $other->mother_in_law_other_income = $request->mother_in_law_other_income;
                    $other->mother_in_law_contact_no = $request->mother_in_law_contact_no;
                    $other->father_in_law_name = $request->father_in_law_name;
                    $other->father_in_law_education = $request->father_in_law_education;
                    $other->father_in_law_age = $request->father_in_law_age;
                    $other->father_in_law_profession = $request->father_in_law_profession;
                    $other->father_in_law_income = $request->father_in_law_income;
                    $other->father_in_law_property = $request->father_in_law_property;
                    $other->father_in_law_other_income = $request->father_in_law_other_income;
                    $other->father_in_law_contact_no = $request->father_in_law_contact_no;
                    $other->brother_in_law_name = $request->brother_in_law_name;
                    $other->brother_in_law_education = $request->brother_in_law_education;
                    $other->brother_in_law_age = $request->brother_in_law_age;
                    $other->brother_in_law_profession = $request->brother_in_law_profession;
                    $other->brother_in_law_income = $request->brother_in_law_income;
                    $other->brother_in_law_property = $request->brother_in_law_property;
                    $other->brother_in_law_other_income = $request->brother_in_law_other_income;
                    $other->brother_in_law_contact_no = $request->brother_in_law_contact_no;
                    $other->sister_in_law_name = $request->sister_in_law_name;
                    $other->sister_in_law_education = $request->sister_in_law_education;
                    $other->sister_in_law_age = $request->sister_in_law_age;
                    $other->sister_in_law_profession = $request->sister_in_law_profession;
                    $other->sister_in_law_income = $request->sister_in_law_income;
                    $other->sister_in_law_property = $request->sister_in_law_property;
                    $other->sister_in_law_other_income = $request->sister_in_law_other_income;
                    $other->sister_in_law_contact_no = $request->sister_in_law_contact_no;
                    $other->fam_any_loan_lability = $request->fam_any_loan_lability;
                    $other->relative_government_employed = $request->relative_government_employed;
                    $other->rel_name_gov_emp = $request->rel_name_gov_emp;
                    $other->rel_relation_gov_emp = $request->rel_relation_gov_emp;
                    $other->rel_buss_gov_emp = $request->rel_buss_gov_emp;

                    if ($user->save() && $other->save()) {
                        DB::commit();
                        return response()->json(['status' => true]);
                    } else {
                        DB::rollback();
                        return response()->json(['status' => false]);
                    }
                } else {
                    return response()->json(['status' => false, 'msg' => "Something went wrong!"]);
                }
            } catch (\Throwable $e) {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => $e]);
            }
        } else {
            return response()->json(['status' => false, 'msg' => "Your session has expired"]);
        }
    }

    // step 3
    public function store_address_detail(Request $request)
    {
        $email_id = '';
        $user_id = '';
        if ($request->op_type && $request->op_type == 'EDIT') {
            $email_id = $request->email_id;
            $user_id = $request->user_id;
        } else {
            $email_id = Session::get('email');
            $user_id =  Session::get('user_id');
        }
        if ($email_id && $user_id) {
            $validation_array = [
                'permanent_house_number' => 'required',
                'permanent_house_street_village' => 'required|max:200',
                'permanent_post_office_tehsil' => 'max:100|nullable',
                'permanent_state' => 'required',
                'permanent_district' => 'required',
                'permanent_pincode' => 'required|numeric',
                'permanent_landline_mobile' => 'max:12|nullable',
                'permanent_stay_from' => 'max:99|nullable',
                'permanent_stay_to' => 'max:100|nullable',
                'present_house_number' => 'max:200|nullable',
                'present_house_street_village' => 'max:200|nullable',
                'present_post_office_tehsil' => 'max:100|nullable',
                'present_state' => 'nullable',
                'present_district' => 'nullable',
                'present_pincode' => 'numeric|nullable',
                'present_landline_mobile' => 'max:12|nullable',
                'present_stay_from' => 'max:99|nullable',
                'present_stay_to' => 'max:100|nullable',
                'year_spent_family' => 'max:99|nullable',
                'year_spent_relative' => 'max:100|nullable',
            ];

            $validator = Validator::make($request->all(), $validation_array);

            if ($validator->fails()) {
                $my_array = array_keys($validation_array);
                $to_remove = $validator->errors()->keys();
                $result_array = array_diff($my_array, $to_remove);
                return response()->json(['status' => false, 'errors' => $validator->errors(), 'msg' => "Field Error!", 'first_error' => $validator->errors()->keys()[0], 'success_input' => $result_array]);
            }

            DB::beginTransaction();
            try {
                $user = User::find($user_id);
                $other = UserOtherInfo::where('user_id', $user_id)->first();
                if ($user && $other) {
                    $user->permanent_house_number = $request->permanent_house_number;
                    $user->permanent_house_street_village = $request->permanent_house_street_village;
                    $other->permanent_post_office_tehsil = $request->permanent_post_office_tehsil;
                    $user->permanent_state = $request->permanent_state;
                    $user->permanent_district = $request->permanent_district;
                    $user->permanent_pincode = $request->permanent_pincode;
                    $other->permanent_landline_mobile = $request->permanent_landline_mobile;
                    $other->permanent_stay_from = $request->permanent_stay_from;
                    $other->permanent_stay_to = $request->permanent_stay_to;
                    $user->present_house_number = $request->present_house_number;
                    $user->present_house_street_village = $request->present_house_street_village;
                    $other->present_post_office_tehsil = $request->present_post_office_tehsil;
                    $user->present_state = $request->present_state;
                    $user->present_district = $request->present_district;
                    $user->present_pincode = $request->present_pincode;
                    $other->present_landline_mobile = $request->present_landline_mobile;
                    $other->present_stay_from = $request->present_stay_from;
                    $other->present_stay_to = $request->present_stay_to;
                    $other->year_spent_family = $request->year_spent_family;
                    $other->year_spent_relative = $request->year_spent_relative;
                    $user->phone_number=$request->permanent_landline_mobile;
                    $user->alternative_number=($request->present_landline_mobile)?$request->present_landline_mobile:$request->permanent_landline_mobile;

                    if ($user->save() && $other->save()) {
                        DB::commit();
                        return response()->json(['status' => true]);
                    } else {
                        DB::rollback();
                        return response()->json(['status' => false]);
                    }
                } else {
                    return response()->json(['status' => false, 'msg' => "Something went wrong!"]);
                }
            } catch (\Throwable $e) {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => $e]);
            }
        } else {
            return response()->json(['status' => false, 'msg' => "Your session has expired"]);
        }
    }

    // step 5
    public function store_education_detail(Request $request)
    {
        $email_id = '';
        $user_id = '';
        if ($request->op_type && $request->op_type == 'EDIT') {
            $email_id = $request->email_id;
            $user_id = $request->user_id;
        } else {
            $email_id = Session::get('email');
            $user_id =  Session::get('user_id');
        }
        if ($email_id && $user_id) {
            $validation_array = [
                'tenth_college_name' => 'required|string|max:100',
                'tenth_board' => 'required|max:200',
                'tenth_passing_year' => 'required',
                'tenth_obtain_mark' => 'required',
                'tenth_max_mark' => 'required',
                'tenth_score' => 'required|numeric',
                'tenth_education_type' => 'required',
                'twelve_college_name' => 'string|max:100|nullable',
                'twelve_board' => 'max:200|nullable',
                'twelve_passing_year' => 'nullable|string',
                'twelve_obtain_mark' => 'nullable|string',
                'twelve_max_mark' => 'numeric|nullable',
                'twelve_score' => 'numeric|nullable',
                'twelve_education_type' => 'string|nullable',
                'any_other_graduation' => 'string|nullable',
                'other_college_name' => 'max:200|nullable',
                'other_board' => 'nullable|string|max:100',
                'other_passing_year' => 'nullable|string',
                'other_obtain_mark' => 'numeric|nullable',
                'other_max_mark' => 'numeric|nullable',
                'other_score' => 'numeric|nullable',
                'other_education_type' => 'string|nullable',
                'institution_name' => 'string|nullable',
                'institution_address' => 'string|nullable',
                'ot_grad_uni_na_adr' => 'string|nullable|max:200',
                'other_grad_from' => 'string|nullable',
                'other_grad_to' => 'string|nullable',
                'other_grad_passed' => 'string|nullable',
                'other_grad_program' => 'string|nullable',
                'other_grad_enrol_no' => 'string|nullable',
                'other_grad_deg_type' => 'string|nullable',
                'other_grad_date' => 'date|nullable',
                'other_grad_branch' => 'string|nullable',
                'iti_start_from' => 'required',
                'iti_start_to' => 'required|max:20',
                'iti_obtain_mark' => 'string|nullable',
                'iti_gap_paper' => 'string|nullable',
                'iti_attendance' => 'string|nullable',
                'iti_attendance_reason' => 'string|nullable',
                'apprentice' => 'string|nullable',
                'apprentice_company_name' => 'string|nullable',
                'apprentice_start_date' => 'string|nullable',
                'apprentice_end_date' => 'string|nullable',
                'apprentice_division' => 'string|nullable',
                'any_diploma' => 'string|nullable',
                'diploma_college_name' => 'string|nullable',
                'diploma_start_from' => 'string|nullable',
                'diploma_start_to' => 'string|nullable',
                'diploma_trade_branch' => 'string|nullable',
                'diploma_obtain_mark' => 'string|nullable',
                'diploma_gap_paper' => 'string|nullable',
                'reas_gap_any_edu' => 'string|nullable',
                'ext_act_college' => 'string|nullable',
                'comp_know' => 'string|nullable',
                'other_lang' => 'string|nullable|max:200',
            ];

            $validator = Validator::make($request->all(), $validation_array);
            if ($validator->fails()) {
                $my_array = array_keys($validation_array);
                $to_remove = $validator->errors()->keys();
                $result_array = array_diff($my_array, $to_remove);
                return response()->json(['status' => false, 'errors' => $validator->errors(), 'msg' => "Field Error!", 'first_error' => $validator->errors()->keys()[0], 'success_input' => $result_array]);
            }

            DB::beginTransaction();
            try {
                $user = User::find($user_id);
                $other = UserOtherInfo::where('user_id', $user_id)->first();
                if ($user && $other) {
                    $user->tenth_college_name = $request->tenth_college_name;
                    $user->tenth_board = $request->tenth_board;
                    $user->tenth_passing_year = $request->tenth_passing_year;
                    $other->tenth_obtain_mark = $request->tenth_obtain_mark;
                    $other->tenth_max_mark = $request->tenth_max_mark;
                    $user->tenth_score = $request->tenth_score;
                    $user->tenth_education_type = $request->tenth_education_type;
                    $user->twelve_college_name = $request->twelve_college_name;
                    $user->twelve_board = $request->twelve_board;
                    $user->twelve_passing_year = $request->twelve_passing_year;
                    $other->twelve_obtain_mark = $request->twelve_obtain_mark;
                    $other->twelve_max_mark = $request->twelve_max_mark;
                    $user->twelve_score = $request->twelve_score;
                    $user->twelve_education_type = $request->twelve_education_type;
                    $other->any_other_graduation = $request->any_other_graduation;
                    $user->other_college_name = $request->other_college_name;
                    $other->other_board = $request->other_board;
                    $user->other_passing_year = $request->other_passing_year;
                    $other->other_obtain_mark = $request->other_obtain_mark;
                    $other->other_max_mark = $request->other_max_mark;
                    $user->other_score = $request->other_score;
                    $user->other_education_type = $request->other_education_type;
                    $other->institution_name = $request->institution_name;
                    $other->institution_address = $request->institution_address;
                    $other->ot_grad_uni_na_adr = $request->ot_grad_uni_na_adr;
                    $other->other_grad_from = $request->other_grad_from;
                    $other->other_grad_to = $request->other_grad_to;
                    $other->other_grad_passed = $request->other_grad_passed;
                    $other->other_grad_program = $request->other_grad_program;
                    $other->other_grad_enrol_no = $request->other_grad_enrol_no;
                    $other->other_grad_deg_type = $request->other_grad_deg_type;
                    $other->other_grad_date = $request->other_grad_date;
                    $other->other_grad_branch = $request->other_grad_branch;
                    $other->iti_start_from = $request->iti_start_from;
                    $other->iti_start_to = $request->iti_start_to;
                    $other->iti_obtain_mark = $request->iti_obtain_mark;
                    $other->iti_gap_paper = $request->iti_gap_paper;
                    $other->iti_attendance = $request->iti_attendance;
                    $other->iti_attendance_reason = $request->iti_attendance_reason;
                    $user->apprentice = $request->apprentice;
                    $user->apprentice_company_name = $request->apprentice_company_name;
                    $user->apprentice_start_date = $request->apprentice_start_date;
                    $user->apprentice_end_date = $request->apprentice_end_date;
                    $user->apprentice_division = $request->apprentice_division;
                    $other->any_diploma = $request->any_diploma;
                    $other->diploma_college_name = $request->diploma_college_name;
                    $other->diploma_start_from = $request->diploma_start_from;
                    $other->diploma_start_to = $request->diploma_start_to;
                    $other->diploma_trade_branch = $request->diploma_trade_branch;
                    $other->diploma_obtain_mark = $request->diploma_obtain_mark;
                    $other->diploma_gap_paper = $request->diploma_gap_paper;
                    $other->reas_gap_any_edu = $request->reas_gap_any_edu;
                    $other->ext_act_college = $request->ext_act_college;
                    $other->comp_know = $request->comp_know;
                    $other->eng_read = ($request->eng_read) ? "YES" : "NO";
                    $other->eng_Write = ($request->eng_Write) ? "YES" : "NO";
                    $other->eng_speak = ($request->eng_speak) ? "YES" : "NO";
                    $other->hin_read = ($request->hin_read) ? "YES" : "NO";
                    $other->hin_Write = ($request->hin_Write) ? "YES" : "NO";
                    $other->hin_speak = ($request->hin_speak) ? "YES" : "NO";
                    $other->guj_read = ($request->guj_read) ? "YES" : "NO";
                    $other->guj_Write = ($request->guj_Write) ? "YES" : "NO";
                    $other->guj_speak = ($request->guj_speak) ? "YES" : "NO";
                    $other->other_lang = $request->other_lang;
                    $other->other_read = ($request->other_read) ? "YES" : "NO";
                    $other->other_Write = ($request->other_Write) ? "YES" : "NO";
                    $other->other_speak = ($request->other_speak) ? "YES" : "NO";
                    if ($user->save() && $other->save()) {
                        DB::commit();
                        return response()->json(['status' => true]);
                    } else {
                        DB::rollback();
                        return response()->json(['status' => false]);
                    }
                } else {
                    return response()->json(['status' => false, 'msg' => "Something went wrong!"]);
                }
            } catch (\Throwable $e) {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => $e]);
            }
        } else {
            return response()->json(['status' => false, 'msg' => "Your session has expired"]);
        }
    }

    // step 6
    public function store_work_experience_detail(Request $request)
    {
        $email_id = '';
        $user_id = '';
        if ($request->op_type && $request->op_type == 'EDIT') {
            $email_id = $request->email_id;
            $user_id = $request->user_id;
        } else {
            $email_id = Session::get('email');
            $user_id =  Session::get('user_id');
        }
        if ($email_id && $user_id) {
            $validation_array = [
                'previous_company_work' => 'max:5|nullable',
                'previous_company_name' => 'string|max:200|nullable',
                'previous_company_start_date' => 'date|nullable',
                'previous_company_end_date' => 'date|nullable',
                'previous_company_salary' => 'string|max:200|nullable',
                'previous_company_division' => 'string|max:200|nullable',
                'previous_company_res_living' => 'string|max:200|nullable',
                'previous_com_cert' => 'string|max:8|nullable',
                'previous_company_name_two' => 'string|max:200|nullable',
                'previous_company_start_date_two' => 'date|nullable',
                'previous_company_end_date_two' => 'date|nullable',
                'previous_company_salary_two' => 'string|max:200|nullable',
                'previous_company_division_two' => 'string|max:200|nullable',
                'previous_company_res_living_two' => 'string|max:200|nullable',
                'previous_com_cert_two' => 'string|max:8|nullable',
                'previous_company_name_three' => 'string|max:200|nullable',
                'previous_company_start_date_three' => 'date|nullable',
                'previous_company_end_date_three' => 'date|nullable',
                'previous_company_salary_three' => 'string|max:200|nullable',
                'previous_company_division_three' => 'string|max:200|nullable',
                'previous_company_res_living_three' => 'string|max:200|nullable',
                'previous_com_cert_three' => 'string|max:8|nullable',
            ];

            $validator = Validator::make($request->all(), $validation_array);

            if ($validator->fails()) {
                $my_array = array_keys($validation_array);
                $to_remove = $validator->errors()->keys();
                $result_array = array_diff($my_array, $to_remove);
                return response()->json(['status' => false, 'errors' => $validator->errors(), 'msg' => "Field Error!", 'first_error' => $validator->errors()->keys()[0], 'success_input' => $result_array]);
            }

            DB::beginTransaction();
            try {
                $user = User::find($user_id);
                $other = UserOtherInfo::where('user_id', $user_id)->first();
                if ($user && $other) {
                    $user->previous_company_work = $request->previous_company_work;
                    $user->previous_company_name = $request->previous_company_name;
                    $user->previous_company_start_date = $request->previous_company_start_date;
                    $user->previous_company_end_date = $request->previous_company_end_date;
                    $user->previous_company_salary = $request->previous_company_salary;
                    $user->previous_company_division = $request->previous_company_division;
                    $other->previous_company_res_living = $request->previous_company_res_living;
                    $other->previous_com_cert = $request->previous_com_cert;
                    $user->previous_company_name_two = $request->previous_company_name_two;
                    $user->previous_company_start_date_two = $request->previous_company_start_date_two;
                    $user->previous_company_end_date_two = $request->previous_company_end_date_two;
                    $user->previous_company_salary_two = $request->previous_company_salary_two;
                    $user->previous_company_division_two = $request->previous_company_division_two;
                    $other->previous_company_res_living_two = $request->previous_company_res_living_two;
                    $other->previous_com_cert_two = $request->previous_com_cert_two;
                    $user->previous_company_name_three = $request->previous_company_name_three;
                    $user->previous_company_start_date_three = $request->previous_company_start_date_three;
                    $user->previous_company_end_date_three = $request->previous_company_end_date_three;
                    $user->previous_company_salary_three = $request->previous_company_salary_three;
                    $user->previous_company_division_three = $request->previous_company_division_three;
                    $other->previous_company_res_living_three = $request->previous_company_res_living_three;
                    $other->previous_com_cert_three = $request->previous_com_cert_three;

                    if ($user->save() && $other->save()) {
                        DB::commit();
                        return response()->json(['status' => true]);
                    } else {
                        DB::rollback();
                        return response()->json(['status' => false]);
                    }
                } else {
                    return response()->json(['status' => false, 'msg' => "Something went wrong!"]);
                }
            } catch (\Throwable $e) {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => $e]);
            }
        } else {
            return response()->json(['status' => false, 'msg' => "Your session has expired"]);
        }
    }

    // step 7
    public function store_other_info_detail(Request $request)
    {
        $email_id = '';
        $user_id = '';
        if ($request->op_type && $request->op_type == 'EDIT') {
            $email_id = $request->email_id;
            $user_id = $request->user_id;
        } else {
            $email_id = Session::get('email');
            $user_id =  Session::get('user_id');
        }
        if ($email_id && $user_id) {
            DB::beginTransaction();
            try {
                $user = User::find($user_id);
                $other = UserOtherInfo::where('user_id', $user_id)->first();
                if ($user && $other) {
                    $other->your_major_achievement = $request->your_major_achievement;
                    $other->your_hobbies = $request->your_hobbies;
                    $user->car_driving = $request->car_driving;
                    $user->driving_license = $request->driving_license;
                    $other->mobile_necessary = $request->mobile_necessary;
                    $other->how_many_mobile = $request->how_many_mobile;
                    $other->internet_connection = $request->internet_connection;
                    $other->mobile_uses = $request->mobile_uses;
                    $other->what_you_use_net = $request->what_you_use_net;
                    $other->want_to_associate = $request->want_to_associate;
                    $other->relative_work_with_company = $request->relative_work_with_company;
                    $user->detail_of_past_surgery = $request->detail_of_past_surgery;
                    $other->are_you_ready_work_in_plc = $request->are_you_ready_work_in_plc;
                    $other->are_you_ready_rel_anyw = $request->are_you_ready_rel_anyw;
                    $user->physically_handicapped = $request->physically_handicapped;
                    $user->physically_handicap_information = $request->physically_handicap_information;
                    $other->gov_action = $request->gov_action;
                    $other->gov_action_detail = $request->gov_action_detail;
                    $other->have_you_appeared_this_com = $request->have_you_appeared_this_com;
                    $other->have_you_appeared_this_com_detail = $request->have_you_appeared_this_com_detail;
                    $user->already_worked = $request->already_worked;
                    $other->already_worked_detail = $request->already_worked_detail;
                    $other->resp_per_name_one = $request->resp_per_name_one;
                    $other->resp_per_address_one = $request->resp_per_address_one;
                    $other->resp_per_cont_one = $request->resp_per_cont_one;
                    $other->resp_per_since_know_one = $request->resp_per_since_know_one;
                    $other->resp_per_name_two = $request->resp_per_name_two;
                    $other->resp_per_address_two = $request->resp_per_address_two;
                    $other->resp_per_cont_two = $request->resp_per_cont_two;
                    $other->resp_per_since_know_two = $request->resp_per_since_know_two;
                    $other->addit_info_back_stay_from_one = $request->addit_info_back_stay_from_one;
                    $other->addit_info_back_stay_to_one = $request->addit_info_back_stay_to_one;
                    $other->addit_info_address_one = $request->addit_info_address_one;
                    $other->addit_info_state_one = $request->addit_info_state_one;
                    $other->addit_info_country_one = $request->addit_info_country_one;
                    $other->addit_info_zip_code_one = $request->addit_info_zip_code_one;
                    $other->addit_info_back_stay_from_two = $request->addit_info_back_stay_from_two;
                    $other->addit_info_back_stay_to_two = $request->addit_info_back_stay_to_two;
                    $other->addit_info_address_two = $request->addit_info_address_two;
                    $other->addit_info_state_two = $request->addit_info_state_two;
                    $other->addit_info_country_two = $request->addit_info_country_two;
                    $other->addit_info_zip_code_two = $request->addit_info_zip_code_two;
                    $other->addit_info_back_stay_from_three = $request->addit_info_back_stay_from_three;
                    $other->addit_info_back_stay_to_three = $request->addit_info_back_stay_to_three;
                    $other->addit_info_address_three = $request->addit_info_address_three;
                    $other->addit_info_state_three = $request->addit_info_state_three;
                    $other->addit_info_country_three = $request->addit_info_country_three;
                    $other->addit_info_zip_code_three = $request->addit_info_zip_code_three;
                    $other->addit_info_back_stay_from_four = $request->addit_info_back_stay_from_four;
                    $other->addit_info_back_stay_to_four = $request->addit_info_back_stay_to_four;
                    $other->addit_info_address_four = $request->addit_info_address_four;
                    $other->addit_info_state_four = $request->addit_info_state_four;
                    $other->addit_info_country_four = $request->addit_info_country_four;
                    $other->addit_info_zip_code_four = $request->addit_info_zip_code_four;
                    $other->addit_info_back_stay_from_five = $request->addit_info_back_stay_from_five;
                    $other->addit_info_back_stay_to_five = $request->addit_info_back_stay_to_five;
                    $other->addit_info_address_five = $request->addit_info_address_five;
                    $other->addit_info_state_five = $request->addit_info_state_five;
                    $other->addit_info_country_five = $request->addit_info_country_five;
                    $other->addit_info_zip_code_five = $request->addit_info_zip_code_five;
                    if ($user->save() && $other->save()) {
                        DB::commit();
                        return response()->json(['status' => true]);
                    } else {
                        DB::rollback();
                        return response()->json(['status' => false]);
                    }
                } else {
                    return response()->json(['status' => false, 'msg' => "Something went wrong!"]);
                }
            } catch (\Throwable $e) {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => $e]);
            }
        } else {
            return response()->json(['status' => false, 'msg' => "Your session has expired"]);
        }
    }

    // step 8 final submit 
    public function store_document_detail(Request $request)
    {
        $email_id = '';
        $user_id = '';
        if ($request->op_type && $request->op_type == 'EDIT') {
            $email_id = $request->email_id;
            $user_id = $request->user_id;
        } else {
            $email_id = Session::get('email');
            $user_id =  Session::get('user_id');
        }
        if ($email_id && $user_id) {
            DB::beginTransaction();
            try {
                $user = User::find($user_id);
                $other = UserOtherInfo::where('user_id', $user_id)->first();
                if ($user && $other) {
                    $validation_array = [
                        "passport_photo" => "image|mimes:jpeg,png,jpg",
                        "pancard" => "image|mimes:jpeg,png,jpg",
                        "aadhar_card_back" => "image|mimes:jpeg,png,jpg",
                        "aadhar_card_front" => "image|mimes:jpeg,png,jpg",
                        "iti_certificate" => "image|mimes:jpeg,png,jpg",
                        "twelve_certificate" => "image|mimes:jpeg,png,jpg",
                        "tenth_certificate" => "image|mimes:jpeg,png,jpg",
                        "other_graduation_file" => "image|mimes:jpeg,png,jpg",
                    ];

                    $validator = Validator::make($request->all(), $validation_array);
                    if ($validator->fails()) {
                        $my_array = array_keys($validation_array);
                        $to_remove = $validator->errors()->keys();
                        $result_array = array_diff($my_array, $to_remove);
                        return response()->json(['status' => false, 'errors' => $validator->errors(), 'msg' => "Field Error!", 'first_error' => $validator->errors()->keys()[0], 'success_input' => $result_array]);
                    }

                    $disk = Storage::disk('gcs');
                    if ($request->file('passport_photo')) {
                        $file = $request->file('passport_photo');
                        $fnn = rand() . '.' . $file->getClientOriginalExtension();
                        if ($file->getMimeType() == 'image/jpeg') {
                            $source_image = imagecreatefromjpeg($file->path());
                            imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
                        } elseif ($file->getMimeType()  == 'image/png') {
                            $source_image = imagecreatefrompng($file->path());
                            imagepng($source_image, $file->path(), 3);
                        }
                        $disk->put($fnn, File::get($file));
                        $disk->setVisibility($fnn, 'public');
                        $user->passport_photo = $fnn;
                    }
                    if ($request->file('tenth_certificate')) {
                        $file = $request->file('tenth_certificate');
                        $fnn = rand() . '.' . $file->getClientOriginalExtension();
                        if ($file->getMimeType() == 'image/jpeg') {
                            $source_image = imagecreatefromjpeg($file->path());
                            imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
                        } elseif ($file->getMimeType()  == 'image/png') {
                            $source_image = imagecreatefrompng($file->path());
                            imagepng($source_image, $file->path(), 3);
                        }
                        $disk->put($fnn, File::get($file));
                        $disk->setVisibility($fnn, 'public');
                        $user->tenth_certificate = $fnn;
                    }
                    if ($request->file('twelve_certificate')) {
                        $file = $request->file('twelve_certificate');
                        $fnn = rand() . '.' . $file->getClientOriginalExtension();
                        if ($file->getMimeType() == 'image/jpeg') {
                            $source_image = imagecreatefromjpeg($file->path());
                            imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
                        } elseif ($file->getMimeType()  == 'image/png') {
                            $source_image = imagecreatefrompng($file->path());
                            imagepng($source_image, $file->path(), 3);
                        }
                        $disk->put($fnn, File::get($file));
                        $disk->setVisibility($fnn, 'public');
                        $user->twelve_certificate = $fnn;
                    }
                    if ($request->file('iti_certificate')) {
                        $file = $request->file('iti_certificate');
                        $fnn = rand() . '.' . $file->getClientOriginalExtension();
                        if ($file->getMimeType() == 'image/jpeg') {
                            $source_image = imagecreatefromjpeg($file->path());
                            imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
                        } elseif ($file->getMimeType()  == 'image/png') {
                            $source_image = imagecreatefrompng($file->path());
                            imagepng($source_image, $file->path(), 3);
                        }
                        $disk->put($fnn, File::get($file));
                        $disk->setVisibility($fnn, 'public');
                        $user->iti_certificate = $fnn;
                    }
                    if ($request->file('aadhar_card_front')) {
                        $file = $request->file('aadhar_card_front');
                        $fnn = rand() . '.' . $file->getClientOriginalExtension();
                        if ($file->getMimeType() == 'image/jpeg') {
                            $source_image = imagecreatefromjpeg($file->path());
                            imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
                        } elseif ($file->getMimeType()  == 'image/png') {
                            $source_image = imagecreatefrompng($file->path());
                            imagepng($source_image, $file->path(), 3);
                        }
                        $disk->put($fnn, File::get($file));
                        $disk->setVisibility($fnn, 'public');
                        $user->aadhar_card_front = $fnn;
                    }
                    if ($request->file('aadhar_card_back')) {
                        $file = $request->file('aadhar_card_back');
                        $fnn = rand() . '.' . $file->getClientOriginalExtension();
                        if ($file->getMimeType() == 'image/jpeg') {
                            $source_image = imagecreatefromjpeg($file->path());
                            imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
                        } elseif ($file->getMimeType()  == 'image/png') {
                            $source_image = imagecreatefrompng($file->path());
                            imagepng($source_image, $file->path(), 3);
                        }
                        $disk->put($fnn, File::get($file));
                        $disk->setVisibility($fnn, 'public');
                        $user->aadhar_card_back = $fnn;
                    }
                    if ($request->file('pancard')) {
                        $file = $request->file('pancard');
                        $fnn = rand() . '.' . $file->getClientOriginalExtension();
                        if ($file->getMimeType() == 'image/jpeg') {
                            $source_image = imagecreatefromjpeg($file->path());
                            imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
                        } elseif ($file->getMimeType()  == 'image/png') {
                            $source_image = imagecreatefrompng($file->path());
                            imagepng($source_image, $file->path(), 3);
                        }
                        $disk->put($fnn, File::get($file));
                        $disk->setVisibility($fnn, 'public');
                        $user->pancard = $fnn;
                    }

                    if ($request->file('other_graduation_file')) {
                        $file = $request->file('other_graduation_file');
                        $fnn = rand() . '.' . $file->getClientOriginalExtension();
                        if ($file->getMimeType() == 'image/jpeg') {
                            $source_image = imagecreatefromjpeg($file->path());
                            imagejpeg($source_image, $file->path(), 20);             //for jpeg or gif, it should be 0-100
                        } elseif ($file->getMimeType()  == 'image/png') {
                            $source_image = imagecreatefrompng($file->path());
                            imagepng($source_image, $file->path(), 3);
                        }
                        $disk->put($fnn, File::get($file));
                        $disk->setVisibility($fnn, 'public');
                        $other->other_graduation_file = $fnn;
                    }

                    $user->eligibility = "eligible";
                    $user->form_complete_status = 'Complete';
                    $user->agreed = 'NO';
                    if ($request->i_agree == 'on') {
                        $user->agreed = 'YES';
                    }

                    $user->registration_date = date("Y-m-d");
                    $user->next_registration_date = date("Y-m-d", strtotime("+3 months", strtotime(now())));
                    $find = RegistrationCategory::find($user->form_category);
                    $unique_start_string = ($find->title == 'Apprentice') ? 'AP' : $find->title;
                    $unique_start_string = 'SH' . $unique_start_string;
                    $unique_id = $unique_start_string . '00000000';
                    $string_length = strlen((string)$user->id);
                    $user->unique_id = substr($unique_id, 0, '-' . $string_length) . (string)$user->id;


                    CandidateStatus::where('user_id', $user->id)->delete();
                    $status = new CandidateStatus();
                    $status->user_id = $user->id;

                    if ($user->save() && $other->save() && $status->save()) {
                        DB::commit();
                        if (!$request->op_type) {
                            Session::flush();
                            Session::put(['unique_id' => $user->unique_id]);
                            try {
                                $details = [
                                    'subject' => 'Successfully Registered',
                                    'site_name' => env('APP_NAME'),
                                    'name' => $user->full_name,
                                    'company_name' => $user->getCompany->name,
                                    'category' => $user->getFormCategory->title,
                                    'unique_id' => $user->unique_id,
                                ];
                                Mail::to($user->email)->send(new SuccessMail($details));
                            } catch (Exception $e) {
                                return response()->json(['status' => false, 'msg' => 'Successfully registration completed, message not be sent', 'email_error' => $e]);
                            }
                            return response()->json(['status' => true, 'redirect_url' => url('confirm-form')]);
                        } else {
                            return response()->json(['status' => true, 'msg' => 'Updated successfully']);
                        }
                    } else {
                        DB::rollback();
                        return response()->json(['status' => false]);
                    }
                } else {
                    return response()->json(['status' => false, 'msg' => "Something went wrong!"]);
                }
            } catch (\Throwable $e) {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => $e]);
            }
        } else {
            return response()->json(['status' => false, 'msg' => "Your session has expired"]);
        }
    }

    public function confirm_page()
    {
        if (Session::get('unique_id')) {
            return view('confirm');
        } else {
            return abort(404);
        }
    }

    public function update_eligibility(Request $request)
    {
        $user = User::find($request->user_id);
        $user->eligibility = $request->eligibility;
        $user->not_eligibility = $request->not_eligibility;
        if ($user->save()) {
            return response()->json(['status' => true, 'msg' => 'Successfully Update']);
        } else {
            return response()->json(['status' => true, 'msg' => 'Failed to update!']);
        }
    }
}
