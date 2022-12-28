<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CandidateInterview;
use App\Models\District;
use App\Models\Onboarding;
use App\Models\RegistrationLink;
use App\Models\Setting;
use App\Models\State;
use App\Models\User;
use App\Models\UserAssessment;
use App\Models\UserDocumentStatus;
use App\Models\UserOtherInfo;
use App\Models\UserOtherInterview;
use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    protected $site_settings;

    public function __construct()
    {
        $this->site_settings = Setting::first();
        View::share('setting', $this->site_settings);
        // $this->middleware('auth');
    }
    public function viewCandidateDetail($id = null)
    {
        try {
            $id = Crypt::decrypt($id);
            $user = User::select('users.*', 'registration_categories.name as reg_cat_name')
                ->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
                ->where('users.id', $id)
                ->first();

            $prefix = strtolower($user->getCompany->prefix);
            $other = UserOtherInfo::where('user_id', $id)->first();

            if ($user) {
                $states = State::all();
                $districts = District::all();
                $title = $user->full_name . ' | Candidate Detail';
                return view("company.$prefix.edit_candidate", compact('user', 'states', 'title', 'districts', 'other'));
            } else {
                return abort('404');
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404);
        }
    }


    public function viewAdmitCard($id = null)
    {
        try {
            $id = Crypt::decrypt($id);
            $user = User::query()
                ->leftJoin('registration_categories', 'users.form_category', '=', 'registration_categories.id')
                ->leftJoin('trades', 'users.iti_trade', '=', 'trades.id')
                ->leftJoin('states', 'users.permanent_state', '=', 'states.id')
                ->leftJoin('districts',  'users.permanent_district', '=', 'districts.id')
                ->leftJoin('exams', 'users.exam_id', '=', 'exams.id')
                ->leftJoin('exam_batches', 'users.exam_batch', '=', 'exam_batches.id')
                ->leftJoin('companies', 'users.company', '=', 'companies.id')
                ->select(
                    'users.id',
                    'users.unique_id',
                    'users.eligibility',
                    'registration_categories.name as cat_name',
                    'trades.name as trade_name',
                    'users.full_name',
                    'users.email',
                    'users.phone_number',
                    'users.aadhar_card',
                    'users.dob',
                    'users.mother_name',
                    'users.father_name',
                    'states.name as state_name',
                    'districts.name as district_name',
                    'exams.name as exam_name',
                    'exam_batches.name as exam_batch',
                    'companies.prefix',
                    'exams.date as exam_date',
                    'exams.venue',
                    'exams.center',
                    'exam_batches.start_time',
                    'exam_batches.end_time',
                    'exams.instruction',
                    'users.present_house_number',
                    'users.present_house_street_village',
                    'users.present_pincode',
                    'users.passport_photo',
                )
                ->where('users.id', $id)
                ->first();

            $prefix = strtolower($user->prefix);
            $other = UserOtherInfo::where('user_id', $id)->first();

            if ($user) {
                return view("company.$prefix.admit_card", compact('user', 'other'));
            } else {
                return abort('404');
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404);
        }
    }

    public function viewDocVerification($id = null)
    {
        try {
            $id = Crypt::decrypt($id);
            $user = User::query()
                ->leftJoin('registration_categories', 'users.form_category', '=', 'registration_categories.id')
                ->leftJoin('trades', 'users.iti_trade', '=', 'trades.id')
                ->leftJoin('states', 'users.permanent_state', '=', 'states.id')
                ->leftJoin('districts',  'users.permanent_district', '=', 'districts.id')
                ->leftJoin('exams', 'users.exam_id', '=', 'exams.id')
                ->leftJoin('exam_batches', 'users.exam_batch', '=', 'exam_batches.id')
                ->leftJoin('companies', 'users.company', '=', 'companies.id')
                ->leftJoin('user_other_infos', 'users.id', '=', 'user_other_infos.user_id')
                ->select(
                    'users.id',
                    'users.unique_id',
                    'users.eligibility',
                    'registration_categories.name as cat_name',
                    'trades.name as trade_name',
                    'users.full_name',
                    'users.email',
                    'users.phone_number',
                    'users.aadhar_card',
                    'users.dob',
                    'users.mother_name',
                    'users.father_name',
                    'states.name as state_name',
                    'districts.name as district_name',
                    'exams.name as exam_name',
                    'exam_batches.name as exam_batch',
                    'companies.prefix',
                    'exams.date as exam_date',
                    'exams.venue',
                    'exams.center',
                    'exam_batches.start_time',
                    'exam_batches.end_time',
                    'exams.instruction',
                    'users.present_house_number',
                    'users.present_house_street_village',
                    'users.present_pincode',
                    'users.passport_photo',
                    'user_other_infos.other_graduation_file',
                    'users.pancard',
                    'users.passport_photo',
                    'users.tenth_certificate',
                    'users.twelve_certificate',
                    'users.iti_certificate',
                    'users.aadhar_card_front',
                    'users.aadhar_card_back'

                )
                ->where('users.id', $id)
                ->first();

            $prefix = strtolower($user->prefix);
            $other = UserOtherInfo::where('user_id', $id)->first();

            if ($user) {
                $data = UserDocumentStatus::where('user_id', $user->id)->first();
                if (!$data) {
                    return abort('404');
                    die;
                }
                $title = 'Doc Verification';
                return view("company.$prefix.doc_verification", compact('user', 'other', 'data', 'title'));
            } else {
                return abort('404');
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404);
        }
    }

    public function getExamLinkQr(Request $request)
    {
        if ($request->exam_link) {
            $result = view('admin.user-exam-link-qr')->with('link', $request->exam_link)->render();
            return response()->json(['status' => true, 'html' => $result]);
        }
    }

    public function examLogin()
    {
        return view('exam-login');
    }

    public function fetch_assessment_details(Request $request, $id)
    {
        return response()->json(['status' => true, 'data' => UserAssessment::find($id)]);
    }




    public function candidate_interview_result_detail($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $user = User::join('candidate_interviews', 'users.id', '=', 'candidate_interviews.user_id')
                ->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
                ->leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
                ->leftJoin('states', 'states.id', '=', 'users.permanent_state')
                ->leftJoin('districts', 'districts.id', '=', 'users.permanent_district')
                ->leftJoin('companies', 'companies.id', '=', 'users.company')
                ->leftJoin('admins', 'candidate_interviews.interviewer_id','admins.id')
                ->leftJoin('interviewer_panels', 'admins.panel','interviewer_panels.id')

                ->select(
                    'users.id',
                    'candidate_interviews.status',
                    'candidate_interviews.user_id',
                    'candidate_interviews.interview_date',
                    'users.registration_date',
                    'registration_categories.name as cat_name',
                    'trades.name as trade_name',
                    'districts.name as district_name',
                    'states.name as state_name',
                    'users.father_name',
                    'users.full_name',
                    'users.unique_id',
                    'users.phone_number',
                    'users.email',
                    'users.eligibility',
                    'companies.name as company_name',
                    'companies.prefix',
                    'companies.logo',
                    'users.aadhar_card',
                    'users.father_name',
                    'users.dob',
                    'users.mother_name',
                    'users.category',
                    'users.marital_status',
                    'users.blood_group',
                    'users.pan_card',
                    'users.alternative_number',
                    'users.passport_photo',
                    'users.iti_passing_year',
                    'users.already_worked_staff_id',
                    'admins.username','interviewer_panels.name as panel_name',
                    
                    'candidate_interviews.physical_appearance',
                    'candidate_interviews.communication',
                    'candidate_interviews.family_background',
                    'candidate_interviews.subject_knowledge',
                    'candidate_interviews.previous_experience',
                    'candidate_interviews.discipline',


                    'candidate_interviews.positive_attitude',
                    'candidate_interviews.need_for_job',
                    'candidate_interviews.remark',
                    'candidate_interviews.interviewer_id',
                    )
                ->where('users.id', $id)
                ->first();


                $hr=Admin::where('username',$user->username)->where('interviewer_type','hr')->select('name','sig','location','designation')->first();
                $teach = Admin::where('username',$user->username)->where('interviewer_type','technical')->select('name','sig','location','designation')->first();
                
                $admin['hr_name']=($hr && $hr->name)?$hr->name:'';
                $admin['hr_sig']=($hr && $hr->sig)?$hr->sig:'';
                $admin['hr_location']=($hr && $hr->location)?$hr->location:'';
                $admin['hr_designation']=($hr && $hr->designation)?$hr->designation:'';

                $admin['tech_name']=($teach && $teach->name)?$teach->name:'';
                $admin['tech_sig']=($teach && $teach->sig)?$teach->sig:'';
                $admin['tech_location']=($teach && $teach->location)?$teach->location:'';
                $admin['tech_designation']=($teach && $teach->designation)?$teach->designation:'';

                $other_int=UserOtherInterview::where('user_id',$id)->first();  
            $title = "Candidate Interview Assessment Sheet";
            return view('company.' . strtolower($user->prefix) . '.interview_ass_sheet', compact('user', 'title','other_int','admin'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404);
        }
    }


    public function candidate_onboard_now($id)
    {
        if (in_array(27, auth()->user()->get_allowed_menus()['submit_btn'])) {
            try {
                $id = Crypt::decrypt($id);
                $user = User::leftJoin('companies','users.company','companies.id')
                ->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
                ->select('users.unique_id','users.full_name','users.phone_number','users.email','users.aadhar_card','users.father_name','users.dob','companies.prefix','companies.name as company_name','registration_categories.name as cat_name','users.id')
                ->where('users.id',$id)->first();
                $title = "Admin | Onboarding Detail";
                $onboarding = Onboarding::where('user_id', $id)->first();
                return view('company.'.strtolower($user->prefix).'.onboarding_form', compact('user', 'title'));
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                return abort(404);
            }
        } else {
            return view('forbidden');
        }
    }
}
