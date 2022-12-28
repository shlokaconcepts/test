<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\DataTables\AdminDataTable;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\DataTables\EligibleCandidateDataTable;
use App\DataTables\Scopes\EligibleCandidateDataTableScope;

use App\DataTables\ReadyForAssessmentDataTable;
use App\DataTables\Scopes\ReadyForAssessmentDataTableScope;

use App\DataTables\RegistrationDataTable;
use App\DataTables\Scopes\RegistrationDataTableScope;
use App\DataTables\CandidateStatusDataTable;
use App\DataTables\AbsentDataTable;
use App\DataTables\Scopes\AbsentDataTableScope;
use App\DataTables\Scopes\CandidateStatusDataTableScope;

use App\DataTables\PendingAssessmentDataTable;
use App\DataTables\Scopes\PendingAssessmentDataTableScope;
use App\DataTables\AssessmentDataTable;
use App\DataTables\Scopes\AssessmentDataTableScope;
use App\DataTables\Scopes\UserDocumentStatusDataTableScope;
use App\DataTables\CheckCandidateDataTable;
use App\DataTables\InterviewerCandidateDataTables;
use App\DataTables\InterviewerDataTable;
use App\DataTables\InterviewResultDataTable;
use App\DataTables\OnboardingApprovedCandidatesDataTable;
use App\DataTables\OnboardingUnapprovedCandidatesDataTable;
use App\DataTables\OnboardingVenueDataTable;
use App\DataTables\Scopes\CheckCandidateDataTableScope;
use App\DataTables\Scopes\InterviewerCandidateDataTablesScope;
use App\DataTables\Scopes\InterviewerDataTableScope;
use App\DataTables\Scopes\InterviewResultDataTableScope;
use App\DataTables\Scopes\OnboardingApprovedCandidatesDataTableScope;
use App\DataTables\Scopes\OnboardingUnapprovedCandidatesDataTableScope;
use App\DataTables\Scopes\OnboardingVenueDataTableScope;
use App\DataTables\UserDocumentStatusDataTable;
use App\Models\State;
use App\Models\Trade;
use App\Models\CandidateStatus;
use App\Models\User;
use App\Models\UserDocumentStatus;
use App\Models\UserAssessment;
use App\Models\CandidateInterview;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamStartLink;
use App\Models\NoOfExam;
use App\Models\Onboarding;
use App\Models\OnboardingVenue;
use App\Models\SendMailJob;
use App\Models\UserExam;
use App\Models\UserLogInStatus;
use App\Models\UserOtherInfo;
use App\Models\UserOtherInterview;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $site_settings;

    public function __construct()
    {
        $this->site_settings = Setting::first();
        View::share('setting', $this->site_settings);
        $this->middleware('auth');
    }

    public function dashboard()
    {
        // $client = new \GuzzleHttp\Client();
        // $response = $client->get('http://localhost/shapper_old/api/get_state');
        // $dis_data = json_decode($response->getBody()->getContents())->users;




        if (auth()->user()->type == 1) {
            $admins = Admin::where([['department', 1], ['type', 1]])->count();
            $inter = Admin::where('department', 3)->count();
            $company = Company::count();
            $user = User::count();
            $title = "Super admin dashboard";
            return view('admin.super_dashboard', compact('admins', 'company', 'inter', 'user', 'title'));
        } else {

            $company = auth()->user()->company;
            // dd(getCompanyRgCategories($company));

            $status = array();
            $l_screen_array = array();
            $admit_card_array = array();
            $assessment_array = array();
            $interview_array = array();
            $on_boarding_array = array();
            $on_boarding_count = 0;

            $interviews_count = 0;
            $assessment_count = 0;
            $total_admit_card = 0;
            $total_reg_count = 0;
            $total_l1_screen = 0;

            foreach (getCompanyRgCategories($company) as $cat) {
                $t_reg_query = User::where([['form_complete_status', 'Complete'], ['form_category', $cat->id], ['company', $company]])->count();
                $total_reg_count += $t_reg_query;
                $status[$cat->title] = $t_reg_query;

                // l one screening 
                $l_screen_eligible_query = User::where('form_complete_status', 'Complete')->where([['form_category', $cat->id], ['eligibility', 'Eligible'], ['company', $company]])->count();
                $l_screen_not_eligible_query = User::where('form_complete_status', 'Complete')->where([['form_category', $cat->id], ['eligibility', 'Not Eligible'], ['company', $company]])->count();
                $l_screen_array[$cat->title] = ['eligibles' => $l_screen_eligible_query, 'not_eligible' => $l_screen_not_eligible_query];
                $total_l1_screen += $l_screen_eligible_query;
                // end l one screening 


                // admit card
                $admit_card_query = User::where([['admit_card', '1'], ['form_category', $cat->id], ['company', $company]])->count();
                $total_admit_card += $admit_card_query;
                $admit_card_array[$cat->title] = $admit_card_query;
                // end admit card 

                // assessment 
                $fail_assessment = User::join('user_assessments', 'users.id', '=', 'user_assessments.user_id')->where([['users.company', $company], ['users.assessment', '=', '1'], ['users.form_category', $cat->id], ['user_assessments.result', 'PASS'], ['users.exam_id', '!=', null]])->count();
                $pass_assessment =  User::join('user_assessments', 'users.id', '=', 'user_assessments.user_id')->where([['users.company', $company], ['users.assessment', '=', '1'], ['users.form_category', $cat->id], ['user_assessments.result', 'FAIL'], ['users.exam_id', '!=', null]])->count();
                $absent_assessment = User::join('user_assessments', 'users.id', '=', 'user_assessments.user_id')->where([['users.company', $company], ['users.assessment', '=', '1'], ['users.form_category', $cat->id], ['user_assessments.assessment_status', 'Absent'], ['users.exam_id', '!=', null]])->count();
                $assessment_array[$cat->title] = ['fail' => $fail_assessment, 'pass' => $pass_assessment, 'absent' => $absent_assessment];
                $assessment_count += ($fail_assessment + $pass_assessment);
                // end assessment 


                // interview 
                $interviews_ok =     CandidateInterview::join('users', 'users.id', '=', 'candidate_interviews.user_id')->where([['users.assessment', '1'], ['users.form_category', $cat->id], ['candidate_interviews.status', 'Selected'], ['users.interview', '1']])->count();
                $interviews_not_ok = CandidateInterview::join('users', 'users.id', '=', 'candidate_interviews.user_id')->where([['users.assessment', '1'], ['users.form_category', $cat->id], ['candidate_interviews.status', 'Rejected'], ['users.interview', '1']])->count();
                $interviews_hold =   CandidateInterview::join('users', 'users.id', '=', 'candidate_interviews.user_id')->where([['users.assessment', '1'], ['users.form_category', $cat->id], ['candidate_interviews.status', 'Hold'], ['users.interview', '1']])->count();
                $interviews_absent =    CandidateInterview::join('users', 'users.id', '=', 'candidate_interviews.user_id')->where('users.form_complete_status', 'Complete')->where([['users.form_category', $cat->id], ['candidate_interviews.status', 'Absent']])->count();
                $interviews_count += ($interviews_ok + $interviews_not_ok) + $interviews_hold;
                $interview_array[$cat->title] = ['ok' => $interviews_ok, 'not_ok' => $interviews_not_ok, 'hold' => $interviews_hold, 'absent' => $interviews_absent];
                // end interview

                // interview 
                $onboarding_onboarded =     User::leftJoin('onboardings', 'onboardings.user_id', '=', 'users.id')->where('users.form_complete_status', 'Complete')->where('users.on_boarding', '1')->where([['users.form_category', $cat->id], ['users.company', $company], ['onboardings.status', 'Joined Onboarded']])->count();
                $onboarding_absent =        User::leftJoin('onboardings', 'onboardings.user_id', '=', 'users.id')->where('users.form_complete_status', 'Complete')->where('users.on_boarding', '1')->where([['users.form_category', $cat->id], ['users.company', $company], ['onboardings.status', 'Absent']])->count();
                $onboarding_medical_unfit = User::leftJoin('onboardings', 'onboardings.user_id', '=', 'users.id')->where('users.form_complete_status', 'Complete')->where('users.on_boarding', '1')->where([['users.form_category', $cat->id], ['users.company', $company], ['onboardings.status', 'Medical Unfit']])->count();

                $on_boarding_count += ($onboarding_onboarded + $onboarding_absent) + $onboarding_medical_unfit;
                $on_boarding_array[$cat->title] = ['onboarded' => $onboarding_onboarded, 'medical' => $onboarding_medical_unfit, 'absent' => $onboarding_absent];
                // end interview 
            }


            $data['total_reg_reg'] = ['lists' => $status, 'total' => $total_reg_count];
            $data['l_one_screen'] = ['lists' => $l_screen_array, 'total' => $total_l1_screen];
            $data['admit_card'] = ['lists' => $admit_card_array, 'total' => $total_admit_card];
            $data['assessment'] = ['lists' => $assessment_array, 'total' => $assessment_count];
            $data['interview'] = ['lists' => $interview_array, 'total' => $interviews_count];
            $data['on_boarding'] = ['lists' => $on_boarding_array, 'total' => $on_boarding_count];

            $data['title'] = "Admin dashboard";
            return view('admin.dashboard')->with($data);;
        }
    }


    public function profile()
    {
        $title = 'Admin | Profile';
        return view('form.admin_profile', compact('title'));
    }


    public function change_profile(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'email' => 'required|email',
        ]);
        $data = array(
            'name' => $request->name,
            'updated_at' => Carbon::now(),
            'email' => $request->email
        );

        if (Admin::where('id', auth()->user()->id)->update($data)) {
            return back()->with('success', 'Profile Updated Successfully');
        } else {
            return back()->with('error', 'Having Some Error in Update');
        }
    }

    public function change_password(Request $request)
    {
        $this->validate($request, [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6',
            'reenter_password' => 'required|same:new-password',
        ]);
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return back()->with('error', 'Your current password does not matches with the password you provided. Please try again.');
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            return back()->with('error', 'New Password cannot be same as your current password. Please choose a different password.');
        }

        $data['password'] = bcrypt($request->get('new-password'));
        if (Admin::where('id', auth()->user()->id)->update($data)) {
            return back()->with('success', 'Password changed successfully');
        } else {
            return back()->with('error', 'Having Some Error!');
        }
    }


    public function index(AdminDataTable $dataTable)
    {
        $companies = Company::all();
        $departments = Department::all();
        $title = 'Employee List';
        return $dataTable->render('admin.company_admin', compact('title', 'companies', 'departments'));
    }



    public function registration_list(RegistrationDataTable $dataTable)
    {
        $states = State::all();
        $title = 'Registrations';
        return $dataTable->addScope(new RegistrationDataTableScope)->render('admin.registration_list', compact('title', 'states'));
    }

    public function trackingSystem(CandidateStatusDataTable $dataTable)
    {
        $states = State::all();
        $title = 'candidate tracking system';
        return $dataTable->addScope(new CandidateStatusDataTableScope)->render('admin.candidate_status', compact('title', 'states'));
    }


    public function eligible_candidate(EligibleCandidateDataTable $dataTable)
    {
        $title = 'L1 Screening | Candidate List';
        $states = State::all(['id', 'name']);
        return $dataTable->addScope(new EligibleCandidateDataTableScope)->render('admin.eligible_candidate_list', compact('title', 'states'));
    }

    public function candidate_assign_exam(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exam'   => 'required',
            'exam_batch' => 'required',
            'data.*' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }
        $company = Company::find($request->company, ['id', 'question_type']);
        if (count($request->data) > 0  && $company) {
            foreach ($request->data as $key => $value) {
                $user = User::find($value['id']);
                $user->exam_id = $request->exam;
                $user->exam_batch = $request->exam_batch;
                $user->admit_card = '1';
                $user->save();


                UserDocumentStatus::where('user_id', $user->id)->delete();
                $doc_status = new UserDocumentStatus();
                $doc_status->user_id = $user->id;
                $doc_status->save();

                $status = CandidateStatus::where('user_id', $user->id)->first();
                $status->admit_card_status = "Generated";
                $status->save();

                UserExam::where('user_id', $user->id)->delete();
                $exam_detail = Exam::find($request->exam);
                $exam_category = $exam_detail->category;
                $no_of_exams = NoOfExam::where('exam_id', $request->exam)->get();
                if (count($no_of_exams) > 0) {
                    foreach ($no_of_exams as $no_of_exam) {
                        $questions_query = ExamQuestion::where([['category', $exam_category], ['exam_set', $no_of_exam->exam_set_id], ['company', $company->id]]);
                        $questions = $questions_query->inRandomOrder()->limit($no_of_exam->total_question)->get();
                        if ($company->question_type == 1) {
                            $questions_query->where('trade', $user->iti_trade);
                        }

                        if (count($questions) > 0) {
                            foreach ($questions as $question) {
                                $user_exam = new UserExam();
                                $user_exam->user_id = $user->id;
                                $user_exam->exam_id = $user->exam_id;
                                $user_exam->question_id = $question->id;
                                $user_exam->save();
                            }
                        }
                    }
                }

                $details = [
                    'subject' => 'Admit Card Generated',
                    'site_name' => env('APP_NAME'),
                    'name' => $user->first_name . ' ' . $user->last_name,
                    'company_name' => $user->getCompany->name,
                    'category' => ($user->getFormCategory) ? $user->getFormCategory->name : '',
                    'unique_id' => $user->unique_id,
                ];

                SendMailJob::where('email', $user->email)->delete();
                $job = new SendMailJob();
                $job->email = $user->email;
                $job->mail_type = 'admit_card';
                $job->data = json_encode($details);
                $job->save();
            }
            return response()->json(['status' => true, 'msg' => 'Exam Assigned Successfully!']);
        }
    }


    public function ready_for_assessment(ReadyForAssessmentDataTable $dataTable)
    {
        $title = 'L1 Screening | Candidate List';
        $states = State::all(['id', 'name']);
        return $dataTable->addScope(new ReadyForAssessmentDataTableScope)->render('admin.ready_for_assessment_list', compact('title', 'states'));
    }


    public function candidate_document_status_list(UserDocumentStatusDataTable $dataTable, $states = null)
    {

        $title = 'Admin  | Candidate Document Status';
        $status = $states;
        return $dataTable->addScope(new UserDocumentStatusDataTableScope)->render('admin.candidate-document-status', compact('title', 'status'));
    }

    public function change_document_status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "status" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        $find = UserDocumentStatus::find($request->id);
        if ($request->iti_certificate) {
            $find->iti_certificate = (string)$request->iti_certificate;
        }

        if ($request->tenth_certificate) {
            $find->tenth_certificate = (string)$request->tenth_certificate;
        }

        if ($request->twelve_certificate) {
            $find->twelve_certificate = (string)$request->twelve_certificate;
        }

        if ($request->profile_image) {
            $find->profile_image = (string)$request->profile_image;
        }

        if ($request->pan_card) {
            $find->pan_card = (string)$request->pan_card;
        }

        if ($request->aadhar_card_front) {
            $find->aadhar_card_front = (string)$request->aadhar_card_front;
        }
        if ($request->aadhar_card_back) {
            $find->aadhar_card_back = (string)$request->aadhar_card_back;
        }

        if ($request->other_graduation_file) {
            $find->other_graduation_file = (string)$request->other_graduation_file;
        }
        $find->verify_date = date('d-m-Y');
        $find->verified_by = auth()->user()->name;

        $find->remark = $request->remark;
        $find->status = $request->status;
        $find->updated_at = now();

        if ($find->save()) {
            $user = User::find($find->user_id);
            if ($user) {
                if ($find->status == 'Doc Ok') {
                    $user->document_verify_status = '1';
                    $user->save();
                }
            }
            $status = CandidateStatus::where('user_id', $find->user_id)->first();
            if ($status) {
                if ($request->status == 'Doc Ok') {
                    $status->document_status = "Verified";
                } elseif ($request->status == 'Rejected') {
                    $status->document_status = "Rejected";
                }
                $status->document_result = $request->status;
                $status->document_verify_by = auth()->user()->name;
                $status->save();
            }
            return response()->json(['status' => true, 'msg' => 'Status Change Successfully']);
        } else {
            return response()->json(['status' => false, 'msg' => 'Something went wrong!']);
        }
    }




    public function docAbsent(Request $request)
    {
        if (count($request->data) > 0) {
            foreach ($request->data as $key => $value) {
                $user = User::where('id', $value['id'])->select('id')->first();
                if ($user) {
                    DB::beginTransaction();
                    try {
                        $doc_status = UserDocumentStatus::where('user_id', $user->id)->first();
                        $doc_status->profile_image = 'UnVerified';
                        $doc_status->tenth_certificate = 'UnVerified';
                        $doc_status->twelve_certificate = 'UnVerified';
                        $doc_status->iti_certificate = 'UnVerified';
                        $doc_status->aadhar_card_front = 'UnVerified';
                        $doc_status->aadhar_card_back = 'UnVerified';
                        $doc_status->pan_card = 'UnVerified';
                        $doc_status->other_graduation_file = 'UnVerified';
                        $doc_status->remark = NULL;
                        $doc_status->verify_date = NULL;
                        $doc_status->verified_by = NULL;
                        $doc_status->profile_image = 'UnVerified';
                        $doc_status->status = 'Absent';


                        $status = CandidateStatus::where('user_id', $user->id)->first();
                        $status->document_status = 'Absent';
                        $status->document_result = '';
                        $status->doc_veri_absent = (int)$status->doc_veri_absent + 1;
                        $status->assessment_status = "Absent";
                        $status->ases_absent = (int)$status->ases_absent + 1;

                        $ass = UserAssessment::where('user_id', $user->id)->first();
                        if (!$ass) {
                            $ass = new UserAssessment();
                        }
                        $ass->user_id = $user->id;
                        $ass->assessment_status = 'Absent';
                        $user->document_verify_status = '0';

                        if ($user->save() && $ass->save() && $status->save() && $doc_status->save()) {
                            DB::commit();
                            return response()->json(['status' => true]);
                        } else {
                            DB::rollback();
                            return response()->json(['status' => false]);
                        }
                    } catch (\Exception $e) {
                        DB::rollback();
                        return response()->json(['status' => false, 'msg' => json_encode($e->getMessage(), true)]);
                        die;
                        break;
                    }
                }
            }
            return response()->json(['status' => true, 'msg' => 'Successfully Absent Mark!']);
        }
    }

    public function absent_candidate(AbsentDataTable $dataTable, Request $request)
    {

        if (in_array(19, auth()->user()->get_allowed_menus()['view'])) {
            $states = State::all();
            $title = 'Absent Candidate lists';
            return $dataTable->addScope(new AbsentDataTableScope)->render('admin.absent_candidate', compact('states', 'title'));
        } else {
            return view('forbidden');
        }
    }

    public function mark_as_eligible(Request $request)
    {
        if (count($request->data) > 0) {
            foreach ($request->data as $key => $value) {
                DB::beginTransaction();
                try {
                    UserDocumentStatus::where("user_id", $value['id'])->delete();
                    UserAssessment::where("user_id", $value['id'])->delete();
                    CandidateInterview::where("user_id", $value['id'])->delete();
                    UserExam::where("user_id", $value['id'])->delete();
                    ExamStartLink::where("user_id", $value['id'])->delete();
                    Onboarding::where("user_id", $value['id'])->delete();
                    UserOtherInterview::where('user_id', $value['id'])->delete();
                    UserLogInStatus::where('user_id', $value['id'])->delete();

                    $user = User::find($value['id']);
                    $user->exam_id = NULL;
                    $user->exam_batch = NULL;
                    $user->admit_card = '0';
                    $user->exam_link_status = '0';
                    $user->document_verify_status = '0';
                    $user->assessment = '0';
                    $user->Interview = '0';
                    $user->on_boarding = '0';


                    $status = CandidateStatus::where('user_id', $value['id'])->first();
                    $status->admit_card_status = "Not Generated";
                    $status->document_status = "Pending";
                    $status->document_result = NULL;
                    $status->document_verify_by = NULL;
                    $status->assessment_status = "Not Assigned";
                    $status->assessment_result = "Pending";
                    $status->assessment_assign_by = NULL;
                    $status->assessment_date = NULL;
                    $status->interview_status = "Pending";
                    $status->interview_result = NULL;
                    $status->interview_date = NULL;
                    $status->onboarding_status = "Pending";
                    $status->onboarding_result = NULL;
                    $status->onboarding_date = NULL;
                    if ($status->save() && $user->save()) {
                        DB::commit();
                        return response()->json(['status' => true]);
                    } else {
                        DB::rollback();
                        return response()->json(['status' => false]);
                    }
                } catch (\Throwable $e) {
                    DB::rollback();
                    return response()->json(['status' => false, 'msg' => $e]);
                    die;
                }
            }
            return response()->json(['status' => true, 'msg' => 'Successfully mark as eligible!']);
        }
    }



    // assessment module 
    public function pending_assessment_list(PendingAssessmentDataTable $dataTable)
    {
        $title = "Pending Assessment";
        return $dataTable->addScope(new PendingAssessmentDataTableScope)->render('admin.pending_ass', compact('title'));
    }

    public function assessment_list(AssessmentDataTable $dataTable)
    {
        if (in_array(21, auth()->user()->get_allowed_menus()['view'])) {
            $title = 'Admin  | Candidate Assessment';
            return $dataTable->addScope(new AssessmentDataTableScope)->render('admin.assessment_result', compact('title'));
        } else {
            return view('forbidden');
        }
    }

    public function update_passing_mark(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "aptitude" => "required",
            "behavior" => "required",
            "technical" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }
        $find = UserAssessment::find($request->id);
        $find->mark_updated_by = auth()->user()->name . ' ' . now();
        $find->aptitude = $request->aptitude;
        $find->behavior = $request->behavior;
        $find->technical = $request->technical;
        $find->total_mark = $find->aptitude + $find->behavior + $find->technical;
        $find->save();
        if ($find->aptitude >= $find->aptitude_passing_mark && $find->behavior >= $find->behavior_passing_mark && $find->technical >= $find->aptitude_passing_mark) {
            $find->result = 'PASS';
        } else {
            $find->result = 'FAIL';
        }

        if ($request->results != '') {
            $find->result = $request->results;
        }
        $find->save();
        return response()->json(['status' => true, 'msg' => 'Mark Updated Successfully']);
    }

    public function mark_absent_for_interview(Request $request)
    {
        if (count($request->data) > 0) {
            foreach ($request->data as $key => $value) {
                $find = CandidateInterview::where('user_id', $value['id'])->first();
                $user = User::find($value['id']);
                if ($user) {
                    $user->interview = '1';
                    $user->save();
                }
                if ($find) {
                    $find->status = "Absent";
                    $find->save();
                } else {
                    $find_new = new CandidateInterview();
                    $find_new->user_id = (int)$value['id'];
                    $find_new->status = "Absent";
                    $find_new->interview_date = $value['date'];
                    $find_new->save();
                }
            }
            return response()->json(['status' => true, 'msg' => 'Absent Marked Successfully!']);
        }
    }


    public function submit_exam_manually(Request $request)
    {
        if (count($request->data) > 0) {
            foreach ($request->data as $key => $value) {
                $user = User::find($value['id']);
                $questions = UserExam::where('user_id', $user->id)->get();

                $aptitude_total = 0;
                $aptitude_right_answer = 0;
                $aptitude_wrong_answer = 0;

                $behavior_total = 0;
                $behavior_right_answer = 0;
                $behavior_wrong_answer = 0;

                $technical_total = 0;
                $technical_right_answer = 0;
                $technical_wrong_answer = 0;

                foreach ($questions as $question) {
                    if ($question->getQuestion->getExamSetName->id == 1) {
                        $aptitude_total += 1;
                        if ($question->getQuestion->getExamSetName->id == 1 && $question->getQuestion->answer == $question->user_option) {
                            $aptitude_right_answer += 1;
                        } elseif ($question->getQuestion->getExamSetName->id == 1 && $question->getQuestion->answer != $question->user_option) {
                            $aptitude_wrong_answer += 1;
                        }
                    } elseif ($question->getQuestion->getExamSetName->id == 2) {
                        $behavior_total += 1;
                        if ($question->getQuestion->getExamSetName->id == 2 && $question->getQuestion->answer == $question->user_option) {
                            $behavior_right_answer += 1;
                        } elseif ($question->getQuestion->getExamSetName->id == 2 && $question->getQuestion->answer != $question->user_option) {
                            $behavior_wrong_answer += 1;
                        }
                    } elseif ($question->getQuestion->getExamSetName->id == 3) {
                        $technical_total += 1;
                        if ($question->getQuestion->getExamSetName->id == 3 && $question->getQuestion->answer == $question->user_option) {
                            $technical_right_answer += 1;
                        } elseif ($question->getQuestion->getExamSetName->id == 3 && $question->getQuestion->answer != $question->user_option) {
                            $technical_wrong_answer += 1;
                        }
                    }
                }


                $aptitude_percent = (int)str_replace('.0', '', (40 / 100) * $aptitude_total);
                $technical_percent = (int)str_replace('.0', '', (40 / 100) * $technical_total);
                $behavior_percent = (int)str_replace('.0', '', (40 / 100) * $behavior_total);


                $find_assessment = UserAssessment::where('user_id', $user->id)->first();
                if ($find_assessment) {
                    $assessment = $find_assessment;
                    $assessment->updated_at = now();
                } else {
                    $assessment = new UserAssessment();
                }

                $assessment->user_id = $user->id;
                $assessment->assessment_date = date('Y-m-d');
                $assessment->aptitude = $aptitude_right_answer;
                $assessment->behavior = $behavior_right_answer;
                $assessment->technical = $technical_right_answer;

                $assessment->aptitude_passing_mark = $aptitude_percent;
                $assessment->behavior_passing_mark = $behavior_percent;
                $assessment->technical_passing_mark = $technical_percent;

                $assessment->total_mark = $aptitude_right_answer + $behavior_right_answer + $technical_right_answer;
                $assessment->assessment_status = 'Attempt';

                if ($aptitude_right_answer >= $aptitude_percent && $technical_right_answer >= $technical_percent && $behavior_right_answer >= $behavior_percent) {
                    $assessment->result = 'PASS';
                } elseif ($aptitude_percent != $aptitude_right_answer || $technical_percent != $technical_right_answer || $behavior_percent != $behavior_right_answer) {
                    $assessment->result = 'FAIL';
                }

                $assessment->save();
                $user->assessment = '1';
                $user->save();
                $status = CandidateStatus::where('user_id', $user->id)->first();
                if ($status) {
                    $status->assessment_status = "Completed";
                    $status->assessment_result = $assessment->result;
                    $status->save();
                }
            }
            return response()->json(['status' => true, 'msg' => 'Exam Submitted Successfully!']);
        }
    }


    public function check_candidate(CheckCandidateDataTable $dataTable, Request $request)
    {
        if (in_array(22, auth()->user()->get_allowed_menus()['view'])) {
            $title = 'Admin |  Check Candidate';
            return $dataTable->addScope(new CheckCandidateDataTableScope)->render('admin.check_candidate', compact('title'));
        } else {
            return view('forbidden');
        }
    }


    public function interviewer_list(InterviewerDataTable $dataTable, Request $request)
    {
        $title = 'Admin | Interviewers';
        return $dataTable->addScope(new InterviewerDataTableScope)->render('admin.interviewer_list', compact('title'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required|unique:admins,name',
            'email' => 'required|unique:admins,email',
            'phone'   => 'required|unique:admins,phone',
            'image' => 'image|mimes:jpeg,jpg,png',
            'department' => 'required|integer',
            'company' => 'required|integer',
            'password' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        DB::beginTransaction();
        try {
            $disk = Storage::disk('gcs');
            $admin = new Admin();
            if ($request->file('image')) {
                $file = $request->file('image');
                $fnn = rand() . '.' . $file->getClientOriginalExtension();
                $disk->put($fnn, File::get($file));
                $disk->setVisibility($fnn, 'public');
                $admin->image = $fnn;
            }
            $admin->name = $request->name;
            $admin->phone = $request->phone;
            $admin->email = $request->email;
            $admin->company = $request->company;
            $admin->department = $request->department;
            $admin->password = bcrypt($request->password);
            if ($admin->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'New Employee added.']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to add.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function update(Request $request, Admin $admin)
    {
        $validator = Validator::make($request->all(), [
            'name'   => "required|unique:admins,name,$request->id,id",
            'email' => "required|unique:admins,email,$request->id,id",
            'phone'   => "required|unique:admins,phone,$request->id,id",
            'image' => 'image|mimes:jpeg,jpg,png',
            'department' => 'required|integer',
            'company' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        DB::beginTransaction();
        try {
            $disk = Storage::disk('gcs');
            $admin = Admin::find($request->id);
            $old_image = $admin->image;
            if ($request->file('image')) {
                $file = $request->file('image');
                $fnn = rand() . '.' . $file->getClientOriginalExtension();
                $disk->put($fnn, File::get($file));
                $disk->setVisibility($fnn, 'public');
                $admin->image = $fnn;
                Storage::disk('gcs')->delete($old_image);
            }
            $admin->name = $request->name;
            $admin->phone = $request->phone;
            $admin->email = $request->email;
            $admin->company = $request->company;
            $admin->department = $request->department;
            $admin->password = bcrypt($request->password);
            if ($admin->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Employee Updated.']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to update.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $admin = Admin::select('image as full_image')->where('id', $request->id)->first();
            $image = $admin->full_image;
            if ($admin && Admin::find($request->id)->delete()) {
                Storage::disk('gcs')->delete($image);
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Employee deleted successfully']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Record not deleted!']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }


    // inter 

    public function storeInterviewer(Request $request)
    {
        $disk = Storage::disk('gcs');
        if ($request->op_type == 'ADD') {

            $validator = Validator::make($request->all(), [
                'panel'   => 'required',
                'username'   => 'required|unique:admins,username',
                'password' => 'required',
                'location' => 'required',

                'tech_name' => 'required',
                'tech_email' => 'required|email',
                'tech_employee_id' => 'required',
                'tech_designation' => 'required',
                'tech_signature' => 'image|mimes:jpeg,jpg,png',

                'hr_name' => 'required',
                'hr_email' => 'required|email',
                'hr_employee_id' => 'required',
                'hr_designation' => 'required',
                'hr_signature' => 'image|mimes:jpeg,jpg,png',


            ]);


            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }

            $tech = new Admin();
            $hr = new Admin();
            if ($request->file('tech_signature')) {
                $file = $request->file('tech_signature');
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
                $tech->sig = $fnn;
            }
            $tech->username = $request->username;
            $tech->password = bcrypt($request->password);
            $tech->location = $request->location;
            $tech->company = $request->company;
            $tech->panel = $request->panel;


            $tech->name = $request->tech_name;
            $tech->email = $request->tech_email;
            $tech->employee_id = $request->tech_employee_id;
            $tech->department = 3;
            $tech->interviewer_type = 'technical';
            $tech->designation = $request->tech_designation;
            $tech->crypt_pass = Crypt::encrypt($request->password);

            if ($request->file('hr_signature')) {
                $file = $request->file('hr_signature');
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
                $hr->sig = $fnn;
            }
            $hr->username = $request->username;
            $hr->password = bcrypt($request->password);
            $hr->location = $request->location;
            $hr->company = $request->company;
            $hr->panel = $request->panel;


            $hr->name = $request->hr_name;
            $hr->email = $request->hr_email;
            $hr->employee_id = $request->hr_employee_id;
            $hr->department = 4;
            $hr->interviewer_type = 'hr';
            $hr->designation = $request->hr_designation;
            $hr->crypt_pass = Crypt::encrypt($request->password);

            if ($tech->save() && $hr->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'New Employee added.']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to add.']);
            }
        } else if ($request->op_type == 'EDIT') {
            $validator = Validator::make($request->all(), [
                'panel'   => 'required',
                'username'   => "required|unique:admins,username," . $request->username . ",username",
                'password' => 'required',
                'location' => 'required',
                'tech_name' => 'required',
                'tech_email' => 'required|email',
                'tech_employee_id' => 'required',
                'tech_designation' => 'required',
                'tech_signature' => 'image|mimes:jpeg,jpg,png',
                'hr_name' => 'required',
                'hr_email' => 'required|email',
                'hr_employee_id' => 'required',
                'hr_designation' => 'required',
                'hr_signature' => 'image|mimes:jpeg,jpg,png',
            ]);


            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }


            $tech = Admin::find($request->tech_id);
            $hr = Admin::find($request->hr_id);

            if ($tech) {
                if ($request->file('tech_signature')) {
                    $file = $request->file('tech_signature');
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
                    $tech->sig = $fnn;
                }
                $tech->username = $request->username;
                $tech->password = bcrypt($request->password);
                $tech->location = $request->location;
                $tech->company = $request->company;
                $tech->panel = $request->panel;
                $tech->name = $request->tech_name;
                $tech->email = $request->tech_email;
                $tech->employee_id = $request->tech_employee_id;
                $tech->department = 3;
                $tech->interviewer_type = 'technical';
                $tech->designation = $request->tech_designation;
                $tech->crypt_pass = Crypt::encrypt($request->password);
                $tech->save();
            }

            if ($hr) {
                if ($request->file('hr_signature')) {
                    $file = $request->file('hr_signature');
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
                    $hr->sig = $fnn;
                }
                $hr->username = $request->username;
                $hr->password = bcrypt($request->password);
                $hr->location = $request->location;
                $hr->company = $request->company;
                $hr->panel = $request->panel;
                $hr->name = $request->hr_name;
                $hr->email = $request->hr_email;
                $hr->employee_id = $request->hr_employee_id;
                $hr->department = 4;
                $hr->interviewer_type = 'hr';
                $hr->designation = $request->hr_designation;
                $hr->crypt_pass = Crypt::encrypt($request->password);
                $hr->save();
            }
            return response()->json(['status' => true, 'msg' => 'Updated successfully.']);
        } else {
            return response()->json(['status' => false, 'msg' => 'Something went wrong!']);
        }
    }


    public function delete_interviewer_detail(Request $request)
    {
        if ($request->id) {
            if (Admin::destroy($request->id)) {
                return response()->json(['status' => true, 'msg' => 'Record delete successfully']);
            } else {
                return response()->json(['status' => false, 'msg' => 'Something went wrong!']);
            }
        }
    }

    public function get_interviewer_detail($id)
    {
        if ($id) {
            $data = Admin::find($id);
            if ($data) {
                $return_array = [
                    "username" => $data->username,
                    "company" => $data->company,
                    "panel" => $data->panel,
                    "password" => ($data->crypt_pass) ? Crypt::decrypt($data->crypt_pass) : '',
                    "location" => $data->location,
                ];

                $hr_data = Admin::where([['username', $data->username], ['interviewer_type', 'hr']])
                    ->select('id', 'name', 'email', 'employee_id', 'designation')
                    ->first();

                $tech_data = Admin::where([['username', $data->username], ['interviewer_type', 'technical']])
                    ->select('id', 'name', 'email', 'employee_id', 'designation')
                    ->first();
                if ($hr_data) {
                    $return_array['hr_name'] = $hr_data->name;
                    $return_array['hr_id'] = $hr_data->id;
                    $return_array['hr_email'] = $hr_data->email;
                    $return_array['hr_employee_id'] = $hr_data->employee_id;
                    $return_array['hr_designation'] = $hr_data->designation;
                }

                if ($tech_data) {
                    $return_array['tech_name'] = $tech_data->name;
                    $return_array['tech_id'] = $tech_data->id;
                    $return_array['tech_email'] = $tech_data->email;
                    $return_array['tech_employee_id'] = $tech_data->employee_id;
                    $return_array['tech_designation'] = $tech_data->designation;
                }
                return response()->json(['status' => true, 'data' => $return_array]);
            } else {
                return response()->json(['status' => false, 'msg' => 'Something went wrong!']);
            }
        } else {
            return response()->json(['status' => false, 'msg' => 'Something went wrong!']);
        }
    }

    public function interviewer_status_change(Request $request)
    {
        $find = Admin::find($request->id);
        if ($find) {
            $find->status = ($find->status == '0') ? '1' : '0';
            $find->save();
            return response()->json(['status' => true, 'msg' => 'Successfully change!']);
        } else {
            return response()->json(['status' => false, 'msg' => 'Something went wrong!']);
        }
    }

    public function initiate_interview(InterviewerCandidateDataTables $dataTable)
    {
        if (in_array(24, auth()->user()->get_allowed_menus()['view'])) {
            $title = 'Interviewer Candidate Search';
            return $dataTable->addScope(new InterviewerCandidateDataTablesScope)->render('admin.initiate_interview', compact('title'));
        } else {
            return view('forbidden');
        }
    }

    public function take_interview($id)
    {
        if (in_array(24, auth()->user()->get_allowed_menus()['submit_btn'])) {
            try {
                $id = Crypt::decrypt($id);
                if ($id) {
                    $user = User::leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
                        ->leftJoin('companies', 'users.company', '=', 'companies.id')
                        ->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
                        ->where([['users.id', $id], ['users.company', auth()->user()->company]])
                        ->select(
                            'users.id',
                            'users.unique_id',
                            'users.full_name',
                            'users.phone_number',
                            'users.email',
                            'users.aadhar_card',
                            'users.father_name',
                            'users.dob',
                            'users.iti_passing_year',
                            'users.passport_photo',
                            'trades.name as iti_trade',
                            'companies.prefix',
                            'registration_categories.name as cat_name',
                        )
                        ->first();
                    // $find = CandidateInterview::where('user_id', $id)->first();
                    // if (!isset($find)) {
                    //     $find_new = new CandidateInterview();
                    //     $find_new->user_id = $id;
                    //     $find_new->interview_start_time = date('h:i:s');
                    //     $find_new->interviewer_id = auth()->user()->id;
                    //     $find_new->save();
                    // } else {
                    //     if ($find->interview_start_time == '' && $find->interview_start_time == null) {
                    //         $find->interview_start_time = date('h:i:s');
                    //         $find->save();
                    //     }
                    // }
                    if ($user) {
                        // $other = UserOtherInfo::where('user_id', $user->id)->select('iti_start_to')->first();
                        $title = 'Interviewer Candidate Detail';
                        return view('company.' . strtolower($user->prefix) . '.take_interview', compact('user', 'title'));
                    } else {
                        return abort(404);
                    }
                } else {
                    return abort(404);
                }
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                return abort(404);
            }
        } else {
            return view('forbidden');
        }
    }

    public function store_interview_detail(Request $request)
    {

        if ($request->status == '' || $request->status == null || $request->remark == ''  || $request->int_type == '') {
            return response()->json(['status' => false, 'msg' => "Please enter interview status & remark"]);
            die();
        }
        DB::beginTransaction();
        try {
            $find = CandidateInterview::where('user_id', $request->user_id)->first();
            if (!isset($find)) {
                $find = new CandidateInterview();
                $find->user_id =  $request->user_id;
                $find->interview_start_time = date('h:i:s');
                $find->interviewer_id = auth()->user()->id;
            }





            if ($request->int_type == 'other_interview') {
                $other = UserOtherInterview::where('user_id', $request->user_id)->first();
                if (!$other) {
                    $other = new UserOtherInterview();
                    $other->user_id = $request->user_id;
                }
                $other->psychometric_test = $request->psychometric_test;
                $other->family_details = $request->family_details;
                $other->general_view = $request->general_view;
                $other->social_media = $request->social_media;
                $other->tech_know = $request->tech_know;
                $other->communication = $request->communication;
                $other->rule_consciousness = $request->rule_consciousness;
                $other->openness_to_change = $request->openness_to_change;
                $other->team_player = $request->team_player;
                $other->enthusiasm = $request->enthusiasm;
                $other->personality = $request->personality;
                $other->hr_status = $request->status;
                $other->tech_status = $request->status;
                $other->save();
            } else {
                $find->physical_appearance = $request->physical_appearance;
                $find->communication = $request->communication;
                $find->subject_knowledge = $request->subject_knowledge;
                $find->discipline = $request->discipline;
                $find->positive_attitude = $request->positive_attitude;
                $find->family_background = $request->family_background;
                $find->need_for_job = $request->need_for_job;
                $find->previous_experience = $request->previous_experience;
            }

            $find->remark = $request->remark;
            $find->status = $request->status;
            $find->interview_taking_time = date('h:i:s');
            $find->interview_date = date('Y-m-d');

            $user = User::find($request->user_id);
            $user->interview = '1';
            $user->save();

            $status = CandidateStatus::where('user_id', $request->user_id)->first();
            $status->interview_status = 'Completed';
            $status->interview_result = $request->status;
            $status->interview_date = date('Y-m-d');
            $status->save();

            if ($find->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Successfully Submitted.']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to add.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function candidate_interview_result(InterviewResultDataTable $dataTable)
    {
        if (in_array(19, auth()->user()->get_allowed_menus()['view'])) {
            $title = 'Interview Result';
            $states = State::all(['id', 'name']);
            return $dataTable->addScope(new InterviewResultDataTableScope)->render('admin.interview_result', compact('title', 'states'));
        } else {
            return view('forbidden');
        }
    }


    // onboarding venue module
    public function onboarding_venue_list(OnboardingVenueDataTable $dataTable)
    {
        if (in_array(26, auth()->user()->get_allowed_menus()['view'])) {
            $title = 'Admin | Onboarding Venue List';
            return $dataTable->addScope(new OnboardingVenueDataTableScope)->render('admin.onboarding_venue', compact('title'));
        } else {
            return view('forbidden');
        }
    }

    public function operation_onboarding_venue(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'location' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        if ($request->op_type == 'EDIT') {
            $new = OnboardingVenue::where('id', $request->id)->first();
        } else {
            $new = new OnboardingVenue();
            $new->created_by = auth()->user()->name . ' | ' . date('d M Y H:i', strtotime(now()));
        }

        $new->name = $request->name;
        $new->location = $request->location;
        $new->company = $request->company;
        $new->status = 1;

        if ($new->save()) {
            if ($request->op_type == 'EDIT') {
                return response()->json(['status' => true, 'msg' => 'Update Successfully']);
            } else {
                return response()->json(['status' => true, 'msg' => 'Add Successfully']);
            }
        } else {
            return response()->json(['status' => false, 'msg' => 'Failed to process!']);
        }
    }

    public function onboarding_venue_status_change(Request $request, $id)
    {
        $find = OnboardingVenue::find($id);

        if ($find) {
            $find->status = ($find->status == '0') ? '1' : '0';
            $find->save();
            return response()->json(['status' => true, 'msg' => 'Successfully change!']);
        } else {
            return response()->json(['status' => false, 'msg' => 'Something went wrong!']);
        }
    }

    public function delete_onboarding_venue(Request $request, $id)
    {
        if ($id) {
            if (OnboardingVenue::destroy($id)) {
                return response()->json(['status' => true, 'msg' => 'Record delete successfully']);
            } else {
                return response()->json(['status' => false, 'msg' => 'Something went wrong!']);
            }
        }
    }



    public function onboarding_unapproved_candidate(OnboardingUnapprovedCandidatesDataTable $dataTable)
    {
        if (in_array(27, auth()->user()->get_allowed_menus()['view'])) {
            $title = 'Admin | Onboarding Unapproved Candidate';
            $states = State::all();
            return $dataTable->addScope(new OnboardingUnapprovedCandidatesDataTableScope)->render('admin.on_unapproved_list', compact('title', 'states'));
        } else {
            return view('forbidden');
        }
    }



    public function onboard_now(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'employee_id'   => 'required',
            'status'   => 'required',
            'venue_id'   => 'required',
            'date'   => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        $user = Onboarding::where('user_id', $request->user_id)->first();
        if (isset($user)) {
            $find_new = $user;
        } else {
            $find_new = new Onboarding();
        }

        $find_new->user_id = $request->user_id;
        $find_new->venue_id = $request->venue_id;
        $find_new->remark = $request->remark;
        $find_new->onboarding_by = auth()->user()->id;
        $find_new->status = $request->status;
        $find_new->onboarding_date = $request->date;

        if ($find_new->save()) {
            $status = CandidateStatus::where('user_id', $request->user_id)->first();
            if ($status) {
                $status->onboarding_date = $request->date;
                $status->onboarding_status = ($request->status == 'Absent') ? 'Absent' : 'Completed';
                $status->onboarding_result = $request->status;
                $status->onboarding_result = ($request->status == 'Absent') ? +1 : 0;
                $status->save();
            }
            $users = User::find($request->user_id);
            $users->on_boarding = '1';
            $users->employee_id = $request->employee_id;
            $users->save();

            return response()->json(['status' => true, 'msg' => 'Add Successfully']);
        } else {
            return response()->json(['status' => false, 'msg' => 'Failed to process!']);
        }
    }

    public function onboarding_approved_candidate(OnboardingApprovedCandidatesDataTable $dataTable)
    {
        $title = 'Admin | Onboarding Approved Candidate';
        $states = State::all();
        return $dataTable->addScope(new OnboardingApprovedCandidatesDataTableScope)->render('admin.boarding_approved_candidate', compact('title', 'states'));
    }
}
