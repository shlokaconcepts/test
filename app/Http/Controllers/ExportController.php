<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\LazyCollection;
use Spatie\SimpleExcel\SimpleExcelWriter;
use App\Models\CandidateStatus;
use App\Models\ExamStartLink;

class ExportController extends Controller
{
    public function exportRegistrations($data = null)
    {
        $decode_id          = $data;
        $smth                 = preg_replace("/%u([0-9a-f]{3,4})/i", "&#x\\1;", urldecode($decode_id));
        $smth_id             = html_entity_decode($smth, null, 'UTF-8');
        $explode_data         = base64_decode($smth_id);
        $explode_data = explode('#', $explode_data);
        $writer = SimpleExcelWriter::streamDownload('users.xlsx');
        $query = User::leftJoin('states as state_1', 'state_1.id', '=', 'users.present_state')
            ->leftJoin('states as state_2', 'state_2.id', '=', 'users.permanent_state')
            ->leftJoin('districts as disc_1', 'disc_1.id', '=', 'users.present_district')
            ->leftJoin('districts as disc_2', 'disc_2.id', '=', 'users.permanent_district')
            ->leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
            ->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
            ->select(
                'users.*',
                'registration_categories.name as reg_name',
                'trades.name as trade_name',
                'state_1.name as present_state_name',
                'state_2.name as permanent_state_name',
                'disc_2.name as permanent_district_name',
                'disc_1.name as present_district_name',
            );

        if ($explode_data[4] != '') {
            $query->where('users.eligibility', $explode_data[4]);
        }

        if ($explode_data[1] != '') {
            $query->whereDate('users.registration_date', '>=', $explode_data[1]);
        }

        if ($explode_data[2] != '') {
            $query->whereDate('users.registration_date', '<=', $explode_data[2]);
        }

        if ($explode_data[3] != '') {
            $query->where('users.form_category', $explode_data[3]);
        }

        if ($explode_data[5] != '') {
            $query->where('users.permanent_state', $explode_data[5]);
        }

        if ($explode_data[6] != '') {
            $query->where('users.permanent_district', $explode_data[6]);
        }

        if ($explode_data[7] != '') {
            $query->where('users.unique_id', $explode_data[7]);
        }

        if ($explode_data[8] != '') {
            $query->where('users.company', $explode_data[8]);
        }

        $user = $query->get();

        foreach ($user as $key => $value) {
            $writer->addRow([
                'Sl No.' => $key + 1,
                'Reg. No' => $value->unique_id,
                'Registration Type' => $value->reg_name,
                'First Name' => $value->first_name,
                'Middle Name' => $value->middle_name,
                'Last Name' => $value->last_name,
                'Full Name' => $value->full_name,
                'DOB' => $value->dob,
                'Phone Number' => $value->phone_number,
                'Alternative Number' => $value->alternative_number,
                'Gmail' => $value->email,
                'Gender' => $value->gender,
                'Marital Status' => $value->marital_status,
                'Category' => $value->category,
                'Aadhar Card' => $value->aadhar_card,
                'Pan Card' => $value->pan_card,
                'Blood Group' => $value->blood_group,
                'Present House Number"' => $value->present_house_number,
                'Present House Street Village' => $value->present_house_street_village,
                'Present State' => $value->present_state_name,
                'Present District' => $value->present_district_name,
                'Present Pin code' => $value->present_pincode,
                'Permanent House Number"' => $value->permanent_house_number,
                'Permanent House Street Village' => $value->permanent_house_street_village,
                'Permanent State' => $value->permanent_state_name,
                'Permanent District' => $value->permanent_district_name,
                'Permanent Pin code' => $value->permanent_pincode,
                'Father Name' => $value->father_name,
                'Father Age' => $value->father_age,
                'Father Occupation' => $value->father_occupation,
                'Father Annual Income' => $value->father_annual_income,
                'Mother Name' => $value->mother_name,
                'Mother Age' => $value->mother_age,
                'Mother Occupation' => $value->mother_occupation,
                'Mother Annual Income' => $value->mother_annual_income,
                'Wife Name' => $value->wife_name,
                'Wife Age' => $value->wife_age,
                'Wife Occupation' => $value->wife_occupation,
                'Wife Annual Income' => $value->wife_annual_income,
                'Sibling 1 Name' => $value->s1name,
                'Sibling 1 Age' => $value->s1sage,
                'Sibling 1 Occupation' => $value->s1soccupation,
                'Sibling 1 Annual Income' => $value->s1sannualincome,
                'Sibling 2 Name' => $value->s2name,
                'Sibling 2 Age' => $value->s2sage,
                'Sibling 2 Occupation' => $value->s2soccupation,
                'Sibling 2 Annual Income' => $value->s2sannualincome,
                'Sibling 3 Name' => $value->s3name,
                'Sibling 3 Age' => $value->s3sage,
                'Sibling 3 Occupation' => $value->s3soccupation,
                'Sibling 3 Annual Income' => $value->s3sannualincome,
                'Children 1 Name' => $value->child1name,
                'Children 1 Age' => $value->child1sage,
                'Children 2 Name' => $value->child2name,
                'Children 2 Age' => $value->child2sage,
                'Children 3 Name' => $value->child3name,
                'Children 3 Age' => $value->child3sage,
                '10th School Name' => $value->tenth_college_name,
                '10th Reg/ Correspondence' => $value->tenth_education_type,
                '10th Board' => $value->tenth_board,
                '10th Starting Year' => $value->tenth_start_year,
                '10th Passing Year' => $value->tenth_passing_year,
                '10th Percent' => $value->tenth_score,
                '12th School Name' => $value->twelve_college_name,
                '12th Reg/ Correspondence' => $value->twelve_education_type,
                '12th Board' => $value->twelve_board,
                '12th Starting Year' => $value->twelve_start_year,
                '12th Passing Year' => $value->twelve_passing_year,
                '12th Percent' => $value->twelve_score,
                'Other College Institution' => $value->other_college_name,
                'Other Reg/ Correspondence' => $value->other_education_type,
                'Other Starting Year' => $value->other_start_year,
                'Other Passing Year' => $value->other_passing_year,
                'Other Percent' => $value->other_score,
                'ITI College' => $value->iti_college_name,
                'ITI Location' => $value->iti_college_location,
                'ITI Type' => $value->iti_college_type,
                'ITI Council' => $value->iti_board_type,
                'ITI Trade' => $value->trade_name,
                'ITI Passing Year' => $value->iti_passing_year,
                'ITI Percent' => $value->iti_score,
                'Apprenticeship Company Name' => $value->apprentice_company_name,
                'Apprenticeship Start Date' => $value->apprentice_start_date,
                'Apprenticeship End Date' => $value->apprentice_end_date,
                'Apprenticeship Location' => $value->apprentice_location,
                'Apprentice Job Area/Shop' => $value->apprentice_division,
                'Apprentice Salary per month' => $value->apprentice_salary,
                'Previous Company Name' => $value->previous_company_name,
                'Previous Start Date' => $value->previous_company_start_date,
                'Previous End Date' => $value->previous_company_end_date,
                'Previous Location' => $value->previous_company_location,
                'Previous Type' => $value->previous_company_type,
                'Previous Job Area/Shop' => $value->previous_company_division,
                'Previous Salary per month' => $value->previous_company_salary,
                'Previous Company Name Two' => $value->previous_company_name_two,
                'Previous Start Date Two' => $value->previous_company_start_date_two,
                'Previous End Date Two' => $value->previous_company_end_date_two,
                'Previous Location Two' => $value->previous_company_location_two,
                'Previous Type Two' => $value->previous_company_type_two,
                'Previous Job Area/Shop Two' => $value->previous_company_division_two,
                'Previous Salary per month Two' => $value->previous_company_salary_two,
                'Previous Company Name Three' => $value->previous_company_name_three,
                'Previous Start Date Three' => $value->previous_company_start_date_three,
                'Previous End Date Three' => $value->previous_company_end_date_three,
                'Previous Location Three' => $value->previous_company_location_three,
                'Previous Type Three' => $value->previous_company_type_three,
                'Previous Job Area/Shop Three' => $value->previous_company_division_three,
                'Previous Salary per month Three' => $value->previous_company_salary_three,
                'Computer Knowledge / Ms Word' => $value->msword,
                'Computer Knowledge / Ms Excel' => $value->msexcel,
                'Computer Knowledge / Internet' => $value->internet,
                'Computer Knowledge / Basic' => $value->basic,
                'Computer Knowledge / Nil' => $value->nil,
                'Physically Handicapped' => $value->physically_handicapped,
                'Physically Handicap Information' => $value->physically_handicap_information,
                'Car Driving' => $value->car_driving,
                'Driving License' => $value->driving_license,
                'Past Surgery Details' => $value->detail_of_past_surgery,
                'Medically Unfit' => $value->medically_unfit,
                'Patient of Epilepsy' => $value->epilepsy,
                'Have You Applied' => $value->have_you_applied,
                'Applied Before' => $value->applied_before,
                'Already Worked Category' => $value->already_worked_category,
                'Already Worked Staff ID' => $value->already_worked_staff_id,
                'Already Worked Time Period' => $value->already_worked_time_period,
                'Already Worked Location' => $value->already_worked_shop_location,
                'Already Know Full Name' => $value->already_know_full_name,
                'Already Know Department' => $value->already_know_department,
                'Already Know Location' => $value->already_know_location,
                'Already Know Mobile Number' => $value->already_know_mobile,
                'Already Know Relation' => $value->already_know_relation,
            ]);
            if ($key === count($user)) {
                flush();
            }
        }
        return $writer->toBrowser();
        exit;
    }

    public function exportCandidateStatus(Request $request)
    {
        $writer = SimpleExcelWriter::streamDownload('candidate_status.xlsx');
        $query = CandidateStatus::leftJoin('users', 'users.id', '=', 'candidate_statuses.user_id')
            ->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
            ->leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
            ->leftJoin('states', 'states.id', '=', 'users.permanent_state')
            ->leftJoin('districts', 'districts.id', '=', 'users.permanent_district')
            ->select(
                'users.id as user_id',
                'users.registration_date',
                'registration_categories.name as cat_name',
                'trades.name as trade_name',
                'districts.name as district_name',
                'states.name as state_name',
                'users.full_name',
                'users.unique_id',
                'users.phone_number',
                'users.eligibility',
                'candidate_statuses.admit_card_status',
                'candidate_statuses.document_status',
                'candidate_statuses.document_result',
                'candidate_statuses.assessment_date',
                'candidate_statuses.assessment_status',
                'candidate_statuses.assessment_result',
                'candidate_statuses.interview_date',
                'candidate_statuses.interview_status',
                'candidate_statuses.interview_result',
                'candidate_statuses.onboarding_date',
                'candidate_statuses.onboarding_status',
            );

        if (auth()->user()->type == 0) {
            $query->where('users.company', auth()->user()->company);
        } else {
            if ($company = $request->company_id) {
                $query->where('users.company', $company);
            }
        }

        if ($eligibility = $request->eligibility) {
            $query->where('users.eligibility', $eligibility);
        }

        if ($request->date_type) {
            $date_type = $request->date_type;
            if ($date_type == 'registration_date') {
                if ($start_date = $request->start_date) {
                    $query->whereDate('users.registration_date', '>=', $start_date);
                }
                if ($end_date = $request->end_date) {
                    $query->whereDate('users.registration_date', '<=', $end_date);
                }
            } elseif ($date_type == 'assessment_date') {
                if ($start_date = $request->start_date) {
                    $query->whereDate('candidate_statuses.assessment_date', '>=', $start_date);
                }
                if ($end_date = $request->end_date) {
                    $query->whereDate('candidate_statuses.assessment_date', '<=', $end_date);
                }
            } elseif ($date_type == 'interview_date') {
                if ($start_date = $request->start_date) {
                    $query->whereDate('candidate_statuses.interview_date', '>=', $start_date);
                }
                if ($end_date = $request->end_date) {
                    $query->whereDate('candidate_statuses.interview_date', '<=', $end_date);
                }
            } elseif ($date_type == 'onboarding_date') {
                if ($start_date = $request->start_date) {
                    $query->whereDate('candidate_statuses.onboarding_date', '>=', $start_date);
                }
                if ($end_date = $request->end_date) {
                    $query->whereDate('candidate_statuses.onboarding_date', '<=', $end_date);
                }
            }
        }
        if ($assessment_status = $request->assessment_status) {
            $query->where('candidate_statuses.assessment_status', $assessment_status);
        }
        if ($assessment_result = $request->assessment_result) {
            $query->where('candidate_statuses.assessment_result', $assessment_result);
        }
        if ($interview_status = $request->interview_status) {
            $query->where('candidate_statuses.interview_status', $interview_status);
        }
        if ($interview_result = $request->interview_result) {
            $query->where('candidate_statuses.interview_result', $interview_result);
        }
        if ($onboarding_status = $request->onboarding_status) {
            if ($onboarding_status == 'Joined Onboarded') {
                $query->where('candidate_statuses.onboarding_result', $onboarding_status);
            } else {
                $query->where('candidate_statuses.onboarding_status', $onboarding_status);
            }
        }
        if ($form_category = $request->form_category) {
            $query->where('users.form_category', $form_category);
        }
        if ($permanent_state = $request->permanent_state) {
            $query->where('users.permanent_state', $permanent_state);
        }
        if ($permanent_district = $request->permanent_district) {
            $query->where('users.permanent_district', $permanent_district);
        }
        if ($unique_id = $request->unique_id) {
            $query->where('users.unique_id', $unique_id);
        }

        if ($trade = $request->iti_trade) {
            $query->where('users.iti_trade', $trade);
        }
        $query->where('users.form_complete_status', 'Complete');
        $user = $query->get();
        foreach ($user as $key => $value) {
            $writer->addRow([
                'Sl No.' => $key + 1,
                'Registration Type' => $value->cat_name,
                'Reg. No' => $value->unique_id,
                'Full Name' => $value->full_name,
                'Phone Number' => $value->phone_number,
                'Eligibility' => $value->eligibility,
                'Registration Date' => $value->registration_date,
                'State' => $value->state_name,
                'District' => $value->district_name,
                'Trade' => $value->trade_name,
                'Admit Card' => $value->admit_card_status,
                'Document' => $value->document_status,
                'Document Status' => $value->document_result,
                'Assessment Date"' => $value->assessment_date,
                'Assessment Status' => $value->assessment_status,
                'Assessment Result' => $value->assessment_result,
                'Interview Date' => $value->interview_date,
                'Interview Status' => $value->interview_status,
                'Interview Result"' => $value->interview_result,
                'Onboarding Status' => $value->onboarding_status,
                'Onboarding Date' => $value->onboarding_date
            ]);
            if ($key === count($user)) {
                flush();
            }
        }
        return $writer->toBrowser();
        exit;
    }


    public function exportEligibleCandidate(Request $request)
    {
        $writer = SimpleExcelWriter::streamDownload('eligible_candidate.xlsx');

        $query = User::leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
            ->leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
            ->leftJoin('states', 'states.id', '=', 'users.permanent_state')
            ->leftJoin('districts', 'districts.id', '=', 'users.permanent_district')
            ->select(
                'users.registration_date',
                'registration_categories.name as cat_name',
                'users.full_name',
                'users.unique_id',
                'users.exam_id',
                'users.eligibility',
                'users.email',
                'users.phone_number',
                'users.aadhar_card',
                'districts.name as district_name',
                'states.name as state_name',
                'trades.name as iti_trade'
            );

        if (auth()->user()->type == 0) {
            $query->where('users.company', auth()->user()->company);
        } else {
            if ($company = $request->company_id) {
                $query->where('users.company', $company);
            }
        }

        if ($unique_id = $request->unique_id) {
            $query->where('users.unique_id', $unique_id);
        }



        if ($iti_trade = $request->iti_trade) {
            $query->where('users.iti_trade', $iti_trade);
        }


        if ($permanent_state = $request->permanent_state) {
            $query->where('users.permanent_state', $permanent_state);
        }

        if ($permanent_district = $request->permanent_district) {
            $query->where('users.permanent_district', $permanent_district);
        }

        if ($present_state = $request->present_state) {
            $query->where('users.present_state', $present_state);
        }

        if ($present_district = $request->present_district) {
            $query->where('users.present_district', $present_district);
        }


        $query->where([['users.eligibility', 'Eligible'], ['users.exam_id', '!=', null], ['users.assessment', '0'], ['users.interview', '0'], ['users.on_boarding', '0']]);
        $user = $query->get();
        foreach ($user as $key => $value) {
            $writer->addRow([
                'Sl No.' => $key + 1,
                'Reg. No' => $value->unique_id,
                'Exam Assign Status' => ($value->exam_id != null && $value->exam_id != 0) ? 'Assigned' : 'Not Assigned',
                'Eligible Status' => $value->eligibility,
                'Registration Type' => $value->cat_name,
                'ITI Trade' => $value->iti_trade,
                'Name' => $value->full_name,
                'Email' => $value->email,
                'Phone Number' => $value->phone_number,
                'Admit Card' => $value->aadhar_card,
                'State' => $value->state_name,
                'District' => $value->district_name,
            ]);
            if ($key === count($user)) {
                flush();
            }
        }
        return $writer->toBrowser();
        exit;
    }

    public function exportReadyAssessment(Request $request)
    {
        $writer = SimpleExcelWriter::streamDownload('ready_for_assessment.xlsx');
        $query = User::query()
            ->leftJoin('user_document_statuses', 'users.id', 'user_document_statuses.user_id')
            ->leftJoin('registration_categories', 'users.form_category', '=', 'registration_categories.id')
            ->leftJoin('trades', 'users.iti_trade', '=', 'trades.id')
            ->leftJoin('states', 'users.permanent_state', '=', 'states.id')
            ->leftJoin('districts',  'users.permanent_district', '=', 'districts.id')
            ->leftJoin('exams', 'users.exam_id', '=', 'exams.id')
            ->leftJoin('exam_batches', 'users.exam_batch', '=', 'exam_batches.id')
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
                'states.name as state_name',
                'districts.name as district_name',
                'exams.name as exam_name',
                'exam_batches.name as exam_batch'
            );

        if (auth()->user()->type == 0) {
            $query->where('users.company', auth()->user()->company);
        } else {
            if ($company = $request->company_id) {
                $query->where('users.company', $company);
            }
        }

        if ($unique_id = $request->unique_id) {
            $query->where('users.unique_id', $unique_id);
        }

        if ($iti_trade = $request->iti_trade) {
            $query->where('users.iti_trade', $iti_trade);
        }

        if ($exam = $request->exam) {
            $query->where('users.exam_id', $exam);
        }
        if ($exam_batch = $request->exam_batch) {
            $query->where('users.exam_batch', $exam_batch);
        }


        $query->where([['users.eligibility', 'eligible'], ['users.exam_id', '!=', NULL], ['users.assessment', '0'], ['users.interview', '0'], ['users.on_boarding', '0'], ['user_document_statuses.status', 'Pending']]);
        $user = $query->get();

        foreach ($user as $key => $value) {
            $writer->addRow([
                'Sl No.' => $key + 1,
                'Reg. No' => $value->unique_id,
                'Eligible Status' => $value->eligibility,
                'Registration Type' => $value->cat_name,
                'ITI Trade' => $value->trade_name,
                'Name' => $value->full_name,
                'Email' => $value->email,
                'Phone Number' => $value->phone_number,
                'Admit Card' => $value->aadhar_card,
                'State' => $value->state_name,
                'District' => $value->district_name,
                'Exam Name' => $value->exam_name,
                'Batch Name' => $value->exam_batch,
            ]);
            if ($key === count($user)) {
                flush();
            }
        }
        return $writer->toBrowser();
        exit;
    }

    public function exportCheckCandidate(Request $request)
    {
        $writer = SimpleExcelWriter::streamDownload('ready_for_assessment.xlsx');
        $query = ExamStartLink::Join('users', 'users.id', '=', 'exam_start_links.user_id')
            ->leftJoin('states', 'states.id', 'users.permanent_state')
            ->leftJoin('districts', 'districts.id', 'users.permanent_district')
            ->leftJoin('exams', 'exams.id', 'exam_start_links.exam_id')
            ->leftJoin('exam_batches', 'exam_batches.id', 'users.exam_batch')
            ->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
            ->leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
            ->leftJoin('user_assessments', 'user_assessments.user_id', 'exam_start_links.user_id')
            ->select(
                'exam_start_links.user_logged_ip',
                'exam_start_links.user_logged_in_device',
                'users.unique_id',
                'users.full_name',
                'users.phone_number',
                'users.email',
                'users.aadhar_card',
                'users.father_name',
                'states.name as state_name',
                'districts.name as dis_name',
                'exam_batches.name as batch_name',
                'exams.name as exam_name',
                'trades.name as iti_trade',
                'exam_start_links.exam_date',
                'registration_categories.name as cat_name',
                'user_assessments.result',
            )->orderBy('users.id', 'DESC');

        if (auth()->user()->type == 0) {
            $query->where('users.company', auth()->user()->company);
        } else {
            if ($company = $request->company_id) {
                $query->where('users.company', $company);
            }
        }

        if ($unique_id = $request->unique_id) {
            $query->where('users.unique_id', $unique_id);
        }

        if ($iti_trade = $request->iti_trade) {
            $query->where('users.iti_trade', $iti_trade);
        }

        if ($exam = $request->exam) {
            $query->where('users.exam_id', $exam);
        }
        if ($exam_batch = $request->exam_batch) {
            $query->where('users.exam_batch', $exam_batch);
        }


        if ($reg_cat = $request->reg_cat) {
            $query->where('users.form_category', $reg_cat);
        }
        if ($start_date = $request->assessment_date_form) {
            $query->whereDate('users_assessments.assessment_date', '>=', $start_date);
        }
        if ($end_date = $request->assessment_date_to) {
            $query->whereDate('users_assessments.assessment_date', '<=', $end_date);
        }

        $user = $query->get();
        foreach ($user as $key => $value) {

            $device = '';
            if ($value->user_logged_in_device) {
                $device = json_decode($value->user_logged_in_device);
                $device = $device->device;
            }
            $browser = '';
            if ($value->user_logged_in_device) {
                $browser = json_decode($value->user_logged_in_device);
                $browser = $browser->browser;
            }
            $platform = '';
            if ($value->user_logged_in_device) {
                $platform = json_decode($value->user_logged_in_device);
                $platform = $platform->platform;
            }
            $is_desktop_Mobile = '';
            if ($value->user_logged_in_device) {
                $is_desktop_Mobile = json_decode($value->user_logged_in_device);
                $is_desktop_Mobile = $is_desktop_Mobile->is_desktop_Mobile;
            }

            $writer->addRow([
                'Sl No.' => $key + 1,
                'Reg. No' => $value->unique_id,
                'Name' => $value->full_name,
                'Phone Number' => $value->phone_number,
                'Admit Card' => $value->aadhar_card,
                'Father Name' => $value->father_name,
                'State' => $value->state_name,
                'District' => $value->dis_name,
                'Reg-Type' => $value->cat_name,
                'ITI Trade' => $value->iti_trade,
                'Exam Name' => $value->exam_name,
                'Batch Name' => $value->batch_name,
                'Exam Date' => $value->exam_date,
                'Result' => $value->result,
                'IP Address' => $value->user_logged_ip,
                'Browser' => $browser,
                'Platform' => $platform,
                'Device Type' => $is_desktop_Mobile,
            ]);
            if ($key === count($user)) {
                flush();
            }
        }
        return $writer->toBrowser();
        exit;
    }

    public function exportInterviewer(Request $request)
    {
        $writer = SimpleExcelWriter::streamDownload('interviewer_list.xlsx');
        $query = Admin::leftJoin('companies', 'companies.id', 'admins.company')
        ->leftJoin('interviewer_panels', 'admins.panel', 'interviewer_panels.id')
        ->select(
            'admins.id',
            'admins.username',
            'admins.employee_id',
            'admins.name',
            'admins.email',
            'admins.username',
            'admins.interviewer_type',
            'admins.created_at',
            'admins.status',
            'companies.name as company_name',
            'admins.image as full_image',
            'interviewer_panels.name as panel_name',
            'companies.prefix',
        );

        if (auth()->user()->type == 0) {
            $query->where('admins.company', auth()->user()->company);
        } else {
            if ($company = $request->company_id) {
                $query->where('admins.company', $company);
            }
        }

        if ($panel = $request->panel_id) {
            $query->where('admins.panel',$panel);
        }
        if ($post = $request->post) {
            $query->where('admins.interviewer_type',$post);
        }

        if ($employee_id = $request->employee_id) {
            $query->where('admins.employee_id',$employee_id);
        }
        $user = $query->whereIn('interviewer_type',['hr','technical'])->get();

        foreach ($user as $key => $value) {
            $writer->addRow([
                'Sl No.' => $key + 1,
                'Username' => $value->username,
                'Employee ID' => $value->employee_id,
                'Name' => $value->name,
                'Email' => $value->email,
                'Panel' => $value->panel_name,
                'Post' => $value->interviewer_type,
                'Created At' => $value->created_at,
                'Company' => $value->company_name.','.$value->prefix
            ]);
            if ($key === count($user)) {
                flush();
            }
        }
        return $writer->toBrowser();
        exit;
    }
}
