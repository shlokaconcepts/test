<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class PendingAssessmentDataTableScope implements DataTableScope
{
    public function apply($query)
    {
        if (auth()->user()->type == 0) {
            $query->where('users.company', auth()->user()->company);
        } else {
            if ($company = request('company_id')) {
                $query->where('users.company', $company);
            }
        }

        if ($exam_id = request('exam_id')) {
            $query->where('users.exam_id',$exam_id);
        }
        if ($exam_batch = request('exam_batch')) {
            $query->where('users.exam_batch',$exam_batch);
        }
        if ($unique_id = request('unique_id')) {
            $query->where('users.unique_id',$unique_id);
        }

        if ($assessment_status = request('assessment_status')) {
            $query->where('user_assessments.assessment_status',$assessment_status);
        }else{
            $query->whereIn('user_assessments.assessment_status',['Not Attempt','Pending']);
        }
        return $query;
    }
}
