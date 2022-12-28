<?php

use Jenssegers\Agent\Agent;
use App\Models\Admin;
use App\Models\Trade;

if (!function_exists('getImage')) {
    function getImage($file)
    {
        return  "https://storage.googleapis.com/shapers-hr-portal-upload/" . $file;
    }

    function getTotalQuestions($id)
    {
        return \App\Models\NoOfExam::where('exam_id', $id)->get()->sum('total_question');
    }

    function getExamSetTotalQuestions($id, $exam_set)
    {
        return \App\Models\NoOfExam::where([['exam_id', $id], ['exam_set_id', $exam_set]])->get()->sum('total_question');
    }

    if (!function_exists('get_no_of_exam_question')) {
        function get_no_of_exam_question($exam_id, $no_of_exam_id)
        {
            $no_of_question =  \App\Models\NoOfExam::where([['exam_id', $exam_id], ['exam_set_id', $no_of_exam_id]])->first();
            if ($no_of_question) {
                return (int)$no_of_question->total_question;
            } else {
                return 0;
            }
        }
    }

    if (!function_exists('companies')) {
        function companies()
        {
            $company =  \App\Models\Company::select('id', 'name','prefix');
            if (auth()->user()->type != '1') {
                $company->where('id', auth()->user()->company);
            }
            return $company->get();
        }
    }

    if (!function_exists('departments')) {
        function departments()
        {
            $department =  \App\Models\Department::select('id', 'name');
            $department->where('id', '!=', 2);
            return $department->get();
        }
    }

    if (!function_exists('rgCategories')) {
        function rgCategories()
        {
            $cat =  \App\Models\RegistrationCategory::select('id', 'name');
            if (auth()->user()->type != '1') {
                $cat->where('company', auth()->user()->company);
            }
            return $cat->get();
        }
    }

    if (!function_exists('examSet')) {
        function examSet()
        {
            $cat =  \App\Models\ExamSet::select('id', 'name');
            if (auth()->user()->type != '1') {
                $cat->where('company', auth()->user()->company);
            }
            return $cat->get();
        }
    }

    if (!function_exists('ageCalculatorYear')) {
        function ageCalculatorYear($dob)
        {
            if (!empty($dob)) {
                $birthdate = new \DateTime($dob);
                $today   = new \DateTime('today');
                $age = $birthdate->diff($today)->y;
                return $age;
            } else {
                return 0;
            }
        }
    }
    if (!function_exists('ageCalculatorMonth')) {
        function ageCalculatorMonth($dob)
        {
            if (!empty($dob)) {
                $birthdate = new \DateTime(date('Y-m-d', strtotime($dob)));
                $today   = new \DateTime('today');
                $age = $birthdate->diff($today)->m;
                return $age;
            } else {
                return 0;
            }
        }
    }

    if (!function_exists('getAssessmentDetail')) {
        function getAssessmentDetail($id)
        {
            return \App\Models\UserAssessment::where('user_id', $id)->first();
        }
    }

    if (!function_exists('getAssBehaviour')) {
        function getAssBehaviour($mark)
        {
            $message = '';
            if ($mark >= 0 && $mark <= 7) {
                $message = 'Low';
            } elseif ($mark >= 8 && $mark <= 13) {
                $message = 'Moderate';
            } elseif ($mark >= 14 && $mark <= 20) {
                $message = 'High';
            }
            return $message;
        }
    }


    if (!function_exists('getInterviewersHR')) {
        function getInterviewersHR($username)
        {
            $data = Admin::where('username', $username)->where('interviewer_type', 'hr')->first();
            if ($data) {
                return $data;
            } else {
                return '';
            }
        }
    }

    if (!function_exists('getInterviewersTechnical')) {
        function getInterviewersTechnical($username)
        {
            $data = Admin::where('username', $username)->where('interviewer_type', 'technical')->first();
            if ($data) {
                return $data;
            } else {
                return '';
            }
        }
    }

    if (!function_exists('getInterviewersTechnical')) {
        function getInterviewersTechnical($username)
        {
            $data = Admin::where('username', $username)->where('interviewer_type', 'technical')->first();
            if ($data) {
                return $data;
            } else {
                return '';
            }
        }
    }

    if (!function_exists('getInterviewerUsername')) {
        function getInterviewerUsername($id)
        {
            return  \App\Models\Admin::where('id', $id)->first();
        }
    }

    if (!function_exists('companyTrades')) {
        function companyTrades($company_id)
        {
            return  Trade::where('company', $company_id)->select('name', 'id')->get();
        }
    }

    if (!function_exists('getCompanyRgCategories')) {
        function getCompanyRgCategories($company_id)
        {
            $cat =  \App\Models\RegistrationCategory::select('id', 'name','title');
            $cat->where('company', $company_id);
            return $cat->get();
        }
    }

    if (!function_exists('getStateName')) {
        function getStateName($state_id)
        {
            $state =  \App\Models\State::find($state_id,['name']);
            if($state){
                return $state->name;
            }else{
                return $state_id;
            }
        }
    }

    if(!function_exists('getTotalCurrentEligible')){
        function getTotalCurrentEligible(){
            return \App\Models\User::where([['form_complete_status', 'Complete'],['Eligibility','eligible'],['exam_id',NULL],['admit_card','0'],['exam_link_status','0'],['document_verify_status','0'],['assessment','0'],['interview','0'],['on_boarding','0'],['company',auth()->user()->company]])->count();
        }
    }

    if(!function_exists('getUserIpAddr')){
    function getUserIpAddr(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = '127.0.0.1';
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
}
