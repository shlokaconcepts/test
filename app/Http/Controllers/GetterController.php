<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamSet;
use App\Models\Exam;
use App\Models\Trade;
use App\Models\District;
use App\Models\User;
use App\Models\RegistrationCategory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use App\models\CandidateInterview;
use App\Models\ExamBatch;
use App\Models\InterviewerPanel;
use App\Models\OnboardingVenue;
use App\Models\UserOtherInfo;
use App\Models\UserOtherInterview;

class GetterController extends Controller
{
    protected $site_settings;

    public function __construct()
    {
        $this->site_settings = Setting::first();
        View::share('setting', $this->site_settings);
    }
    public function getRegistrationCategory($id = null)
    {
        $find = RegistrationCategory::where('company', $id)->get(['id', 'name']);
        $trade = Trade::where('company', $id)->get(['id', 'name']);
        $exam_set = ExamSet::where('company', $id)->get(['id', 'name']);
        $exam = Exam::where('company', $id)->get(['id', 'name']);
        $panel = InterviewerPanel::where('company', $id)->select('name', 'id')->get();
        $venue=OnboardingVenue::where('company',$id)->get(['id','name']);
        if ($find) {
            return response()->json(['status' => true, 'data' => $find, 'trade' => $trade, 'exam_set' => $exam_set, 'exam' => $exam,'panel'=>$panel,'venue'=>$venue]);
        } else {
            return response()->json(['status' => false, 'msg' => 'Record not found!']);
        }
    }

    public function getDistricts($id = null)
    {
        $find = District::where('state_id', $id)->get(['id', 'name']);
        if ($find) {
            return response()->json(['status' => true, 'data' => $find]);
        } else {
            return response()->json(['status' => false, 'msg' => 'Record not found!']);
        }
    }

    public function print_caf_form($id = null)
    {
        try {
            $id = Crypt::decrypt($id);
            $user = User::select(
                'users.*',
                'trades.name as trade_name',
                'state_1.name as permanent_state_name',
                'state_2.name as present_state_name',
                'dis_2.name as present_district_name',
                'dis_1.name as permanent_district_name',
                'registration_categories.name as reg_cat_name',
            )
                ->leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
                ->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
                ->leftJoin('states as state_1', 'state_1.id', '=', 'users.permanent_state')
                ->leftJoin('districts as dis_1', 'dis_1.id', '=', 'users.permanent_district')
                ->leftJoin('states as state_2', 'state_2.id', '=', 'users.present_state')
                ->leftJoin('districts as dis_2', 'dis_2.id', '=', 'users.present_district')
                ->where('users.id', $id)
                ->first();
            if ($user) {
                $other=UserOtherInfo::where('user_id',$user->id)->first();
                $prefix=strtolower($user->getCompany->prefix);
                return view("company.$prefix.caf_form", compact('user','other'));
            } else {
                return abort(404);
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404);
        }
    }

    public function printAssessmentReport($id = null)
    {
        try {
            $id = Crypt::decrypt($id);
            $user = User::select(
                'users.*',
                'trades.name as trade_name',
                'state_1.name as permanent_state_name',
                'registration_categories.name as reg_cat_name',
            )
                ->leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
                ->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
                ->leftJoin('states as state_1', 'state_1.id', '=', 'users.permanent_state')
                ->where('users.id', $id)
                ->first();
                $title='Assessment Report';
            if ($user) {
                return view('form.assesment_report', compact('user','title'));
            } else {
                return abort(404);
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404);
        }
    }

    public function printInterviewReport($id = null)
    {
        try {
            $id = Crypt::decrypt($id);
            $interview = CandidateInterview::leftJoin('admins','admins.id','=','candidate_interviews.interviewer_id')
            ->where('candidate_interviews.user_id',$id)
            ->orderBy('candidate_interviews.id','DESC')
            ->select('candidate_interviews.*','admins.location')
            ->first();
            $user = User::select(
                'users.*',
                'trades.name as trade_name',
                'state_1.name as permanent_state_name',
                'registration_categories.name as reg_cat_name',)
                ->leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
                ->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
                ->leftJoin('states as state_1', 'state_1.id', '=', 'users.permanent_state')
                ->where('users.id', $id)
                ->first();

             $other_int=UserOtherInterview::where('user_id',$id)->first();   
            if (!isset($interview) || !isset($user)) {
                return abort(404);
                die();
            }

            
            $title='Assessment Report';
            return view('form.interview_report',compact('title','user','interview','other_int'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404);
        }
    }
    


    public function fetch_exam_batch($id=null)
    {
        $data = ExamBatch::where('exam', $id)->get();
        if ($data) {
            return response()->json(['status' => true, 'data' => $data]);
        } else {
            return response()->json(['status' => false, 'msg' => 'Failed to find']);
        }
    }
}
