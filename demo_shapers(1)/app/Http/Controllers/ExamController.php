<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamSet;
use App\Models\NoOfExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use App\DataTables\ExamDataTable;
use App\DataTables\Scopes\ExamScope;
use App\Models\CandidateStatus;
use App\Models\ExamBatch;
use App\Models\ExamStartLink;
use App\Models\RegistrationCategory;
use App\Models\User;
use App\Models\UserAssessment;
use App\Models\UserExam;
use App\Models\UserLogInStatus;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;

class ExamController extends Controller
{
    protected $site_settings;

    public function __construct()
    {
        $this->site_settings = Setting::first();
        View::share('setting', $this->site_settings);
        // $this->middleware('auth');
    }


    public function index(ExamDataTable $dataTable)
    {
        $title = 'Exam List';
        $exam_sets = ExamSet::all();
        return $dataTable->addScope(new ExamScope)->render('admin.exam_list', compact('title', 'exam_sets'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'instruction' => 'required',
            'venue' => 'required',
            'category' => 'required',
            'hour' => 'required',
            'minute' => 'required',
            'set_question.*' => 'required',
            'name' => 'required|unique:exams,name',
            'company' => 'required|numeric'
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        DB::beginTransaction();
        try {
            $exam = new Exam();
            $exam->name = $request->name;
            $exam->date = date('Y-m-d', strtotime($request->date));
            $exam->instruction = $request->instruction;
            $exam->venue = $request->venue;
            $exam->center = $request->center;
            $exam->category = $request->category;
            $exam->total_question = (int)$request->total_question;
            $new_time = $request->hour . ':' . $request->minute;
            $exam->company = $request->company;
            $exam->duration =  $new_time;
            $exam->created_by = auth()->user()->name . ' | ' . date('d M Y H:i', strtotime(now()));

            if ($exam->save()) {
                if (count($request->set_question) > 0) {
                    foreach ($request->set_question as $key => $val) {
                        $no_of_question = new NoOfExam();
                        $no_of_question->created_by = $exam->created_by;
                        $no_of_question->exam_id = $exam->id;
                        $no_of_question->exam_set_id = (int)$key;
                        $no_of_question->total_question = (int)$val;
                        $no_of_question->created_by = auth()->user()->name . ' | ' . date('d M Y H:i', strtotime(now()));
                        if ($no_of_question->save()) {
                            DB::commit();
                        } else {
                            DB::rollback();
                        }
                    }
                }
                return response()->json(['status' => true, 'msg' => 'New Exam added.']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to add.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }


    public function edit(Exam $exam, $id = null)
    {
        $title = 'Exam List';
        $companies = \App\Models\Company::all();
        $exam_sets = ExamSet::all();
        $exam = Exam::find($id);
        $categories =  \App\Models\RegistrationCategory::select('id', 'name')->where('company', $exam->company)->get();
        return view('form.edit_exam', compact('title', 'companies', 'categories', 'exam_sets', 'exam'));
    }

    public function update(Request $request, Exam $exam)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'instruction' => 'required',
            'venue' => 'required',
            'category' => 'required',
            'hour' => 'required',
            'minute' => 'required',
            'set_question.*' => 'required',
            'name' => "required|unique:exams,name,$request->id,id",
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        DB::beginTransaction();
        try {
            $exam = Exam::find($request->id);
            $exam->name = $request->name;
            $exam->date = date('Y-m-d', strtotime($request->date));
            $exam->instruction = $request->instruction;
            $exam->venue = $request->venue;
            $exam->center = $request->center;
            $exam->category = $request->category;
            $exam->total_question = (int)$request->total_question;
            $new_time = $request->hour . ':' . $request->minute;
            $exam->duration =  $new_time;
            $exam->updated_by = auth()->user()->name . ' | ' . date('d M Y H:i', strtotime(now()));
            if ($exam->save()) {
                if (count($request->set_question) > 0) {
                    foreach ($request->set_question as $key => $val) {
                        $no_of_question = NoOfExam::where([['exam_id', $exam->id], ['exam_set_id', (int)$key]])->first();
                        $no_of_question->exam_id = $exam->id;
                        $no_of_question->exam_set_id = (int)$key;
                        $no_of_question->total_question = (int)$val;
                        $no_of_question->created_by = auth()->user()->name . ' | ' . date('d M Y H:i', strtotime(now()));
                        if ($no_of_question->save()) {
                            DB::commit();
                        } else {
                            DB::rollback();
                        }
                    }
                }
                return response()->json(['status' => true, 'msg' => 'Exam updated successfully.']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to add.']);
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
            if (Exam::find($request->id)->delete() && NoOfExam::where('exam_id', $request->id)->delete()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Deleted Successfully!']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to delete!']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function update_status(Request $request)
    {
        DB::beginTransaction();
        try {
            $find = Exam::find($request->id);
            $find->status = ($find->status == 'inactive') ? 'active' : 'inactive';
            if ($find->save()) {
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Successfully change!']);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'msg' => 'Failed to create!']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }


    public function candidateLogin(Request $request)
    {

        $this->validate($request, [
            'aadhar_card' => 'required|exists:users,aadhar_card',
            'password' => 'required|exists:exam_batches,password'
        ]);
        $user = User::where('aadhar_card', $request->aadhar_card)->first();

        if ($user) {
            $find = ExamStartLink::where([['exam_start_links.exam_id', '=', $user->exam_id], ['exam_start_links.user_id', '=', $user->id]])->first();

            if (!isset($find)) {
                return back()->with('error', 'Dear Candidate,
                The Exam Link has not been shared with you. Please contact the exam invigilator for more information.');
                die();
            }

            $exam_batch = ExamBatch::find($user->exam_batch);
            if (!isset($exam_batch)) {
                return back()->with('error', 'Dear Candidate,
                You have not been assigned any batch. Please contact the exam invigilator for more information.');
                die();
            }

            if ($find->user_logged_in_device != null) {
                $logged_device = json_decode($find->user_logged_in_device);
                $agent = new Agent();
                $platform = $agent->platform();
                $device = '';

                if ($agent->isDesktop()) {
                    $device = 'Desktop';
                } elseif ($agent->isPhone()) {
                    $device = 'SmartPhone';
                }

                if ($logged_device->device != $agent->device()  || $logged_device->platform != $platform || $logged_device->is_desktop_Mobile != $device || $find->user_logged_ip != getUserIpAddr()) {
                    return back()->with('error', 'you are logged in from another device');
                    die();
                }
            }

            $second_t = explode(':', $exam_batch->end_time);
            $second_time = $exam_batch->end_time;
            if ($second_t[0] < 10) {
                $second_time = ltrim($second_t[0], '0') . ':' . $second_t[1];
            }

            $exam_batch_start_time = $exam_batch->start_time;
            $exam_batch_end_time = $second_time;

            $exam_find = Exam::find($exam_batch->exam);
            if (date('Y-m-d', strtotime($exam_find->date)) != date('Y-m-d')) {
                return back()->with('error', 'Dear Candidate,
            Invalid Exam Start Date.No exam is currently going on. Please contact the exam invigilator for more information.');
                die();
            }




            // validate all ready submitted or not 

            $find_assessment = UserAssessment::where('user_id', $user->id)->first();
            if (isset($find_assessment) && $find_assessment->assessment_status == 'Attempt') {
                return back()->with('error', 'Dear Candidate, Your all exams successfully submitted');
                die();
            }


            $today_check_in = \Carbon\Carbon::parse(date('g:i A'));
            $check_out = \Carbon\Carbon::parse($exam_batch_end_time);
            $db_start_time = \Carbon\Carbon::parse($exam_batch_start_time);



            // $current_time >= $exam_batch_start_time && $current_time < $exam_batch_end_time
            if ($today_check_in >= $db_start_time && $today_check_in < $check_out) {
                Session::put(['StartExamLink' => $find->id]);
                Session::put(['StartExamUserId' => $user->id]);
                Session::put(['user_id' => $user->id]);
                return redirect()->route('assessment');
            } else {
                return back()->with('error', 'Dear Candidate,
                Invalid Exam Time .No Current Exam going on . Please contact the exam invigilator for more information.');
                die();
            }
        }
    }

    public function assessment(Request $request)
    {
        $StartExamLink = Session::get('StartExamLink');
        $id = Session::get('user_id');

        if ($StartExamLink && $id) {
            $user = User::find($id);
            $find = ExamStartLink::where('id', $StartExamLink)->first();



            $agent = new Agent();
            $browser = $agent->browser();
            $platform = $agent->platform();
            $device = '';
            if ($agent->isDesktop()) {
                $device = 'Desktop';
            } elseif ($agent->isPhone()) {
                $device = 'SmartPhone';
            }

            $find->user_logged_in_device = json_encode([
                'browser' => $browser,
                'device' => $agent->device(),
                'platform' => $platform,
                'browser' => $browser,
                'is_desktop_Mobile' => $device
            ]);
            $find->user_logged_ip = getUserIpAddr();
            $find->logged_in_status = '1';

            // if exists
            $UserLogInStatus_find = UserLogInStatus::where('exam_id', $user->exam_id)->where('user_id', $user->id)->first();
            if ($UserLogInStatus_find) {
                $logged_in = $UserLogInStatus_find;
            } else {
                $logged_in = new UserLogInStatus();
            }

            $logged_in->user_id = $user->id;
            $logged_in->exam_id = $user->exam_id;
            $logged_in->first_logged_in_time = now();
            $logged_in->last_logged_in_time = now();
            $logged_in->current_date = date('Y-m-d', strtotime(now()));


            $find->save();
            $logged_in->save();


            $questions = UserExam::where('exam_id', $user->exam_id)->where('user_id', $user->id)->get();

            $exam_batch = ExamBatch::find($user->exam_batch);
            if (!isset($exam_batch)) {
                return abort(404);
            }

            $current_time = date('g:i A', strtotime(now()));
            $second_t = explode(':', $exam_batch->end_time);
            $second_time = $exam_batch->end_time;
            if ($second_t[0] < 10) {
                $second_time = ltrim($second_t[0], '0') . ':' . $second_t[1];
            }


            $exam_batch_start_time = $exam_batch->start_time;
            $exam_batch_end_time = $second_time;

            Session::put(['user_logged_in' => $user->id]);
            Session::put(['start_time' => $exam_batch_start_time]);
            Session::put(['end_time' => $exam_batch_end_time]);


            $today_check_in = \Carbon\Carbon::parse(date('g:i:s A'));
            $check_out = \Carbon\Carbon::parse($exam_batch_end_time);
            $duration = $today_check_in->diff($check_out)->format('%H:%i:%s');


            $category = RegistrationCategory::find($user->form_category,['name']);

            $exam = \App\Models\Exam::find($user->exam_id);
            if ($exam) {
                $exam->duration = $duration;
            }

            $total_answered = \App\Models\UserExam::where('user_id', $user->id)->where('attempt', '1')->get()->sum('attempt');
            $user_id = $user->id;
            $title = $user->full_name . ' | Assessment';
            return view('pages.exam', compact('questions', 'category', 'exam', 'total_answered', 'user_id', 'user', 'title'));
        } else {
            $error = "Your session has expired please login again";
            return view('error_404')->with($error);
        }
    }
    public function post_submit_exam(Request $request)
    {
        $user = User::find($request->user_id);
        $questions = UserExam::where('exam_id', $user->exam_id)->where('user_id', $user->id)->get();

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
                // aptitude answer 
                $aptitude_total += 1;
                if ($question->getQuestion->getExamSetName->id == 1 && $question->getQuestion->answer == $question->user_option) {
                    $aptitude_right_answer += 1;
                } elseif ($question->getQuestion->getExamSetName->id == 1 && $question->getQuestion->answer != $question->user_option) {
                    $aptitude_wrong_answer += 1;
                }
            } elseif ($question->getQuestion->getExamSetName->id == 2) {
                // Behavior answer 

                $behavior_total += 1;
                if ($question->getQuestion->getExamSetName->id == 2 && $question->getQuestion->answer == $question->user_option) {
                    $behavior_right_answer += 1;
                } elseif ($question->getQuestion->getExamSetName->id == 2 && $question->getQuestion->answer != $question->user_option) {
                    $behavior_wrong_answer += 1;
                }
            } elseif ($question->getQuestion->getExamSetName->id == 3) {
                // Technical answer
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
            $status->assessment_date = date('Y-m-d');
            $status->save();
        }
        $request->session()->flush();
        return response()->json(['status' => true, 'msg' => "Successfully Submit Exam.."]);
    }

    public function assessment_submitted()
    {
        $title = 'Assessment Submit successfully';
        return view('pages.exam_submitted', compact('title'));
    }
    public function submit_question_answer(Request $request)
    {
        if (Session::get('user_logged_in')) {
            $find = UserExam::find($request->id);
            if($find){
                $find->user_option = $request->option;
                $find->attempt = '1';
                $find->save();
            }
        }
        return response()->json(['status' => true]);
    }
}
