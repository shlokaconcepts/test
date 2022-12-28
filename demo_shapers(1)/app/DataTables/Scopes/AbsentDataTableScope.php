<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class AbsentDataTableScope implements DataTableScope
{
    public function apply($query)
    {


        if(empty(request('absent_type')) && empty(request('exam')) && empty(request('unique_id')) && empty(request('exam_batch')) && request('search')['value']==null){
            $query->where('users.created_at',null);
        }else{
            
            if (auth()->user()->type == 0) {
                $query->where('users.company', auth()->user()->company);
            }else if($company=request('company_id')){
                $query->where('users.company', $company);
            }
         

             
            if($absent_type = request('absent_type')){
                if($absent_type=='absent_in_interview'){
                    if ($intr_start_date = request('intr_start_date')) {
                        $query->whereDate('candidate_interviews.interview_date', '>=', $intr_start_date);
                    }
                    if ($intr_end_date = request('intr_end_date')) {
                        $query->whereDate('candidate_interviews.interview_date', '<=', $intr_end_date);
                    }

                    $query->where('candidate_interviews.status','absent');

                }elseif($absent_type=='absent_in_assessment'){

                    if ($ass_start_date = request('ass_start_date')) {
                        $query->whereDate('exams.date', '>=', $ass_start_date);
                    }
                    if ($ass_end_date = request('ass_end_date')) {
                        $query->whereDate('exams.date', '<=', $ass_end_date);
                    }

                    $query->where('user_assessments.assessment_status','=','Absent')->where('users.exam_id','!=',null);
                
                }elseif($absent_type=='not_attempt_in_assessment'){
                    $query->where('user_assessments.assessment_status','Not Attempt');

                }elseif($absent_type=='absent_in_document_verification'){
                    $query->where('user_document_statuses.status','Absent');
                }
    
            }
    

            if ($exam_id = request('exam')) {
                $query->where('users.exam_id',$exam_id);
            }
            if ($exam_batch = request('exam_batch')) {
                $query->where('users.exam_batch',$exam_batch);
            }
    

            if ($unique_id = request('unique_id')) {
                $query->where('users.unique_id', $unique_id);
            }
            
            if ($iti_trade = request('iti_trade')) {
                $query->where('users.iti_trade',$iti_trade);
            }
            if ($permanent_state = request('permanent_state')) {
                $query->where('users.permanent_state',$permanent_state);
            }
    
            if ($permanent_district = request('permanent_district')) {
                $query->where('users.permanent_district',$permanent_district);
            }

            if ($form_category = request('form_category')) {
                $query->where('users.form_category',$form_category);
            }

            $query->where('users.form_complete_status', 'Complete');
        }

        return $query;
    }
}
