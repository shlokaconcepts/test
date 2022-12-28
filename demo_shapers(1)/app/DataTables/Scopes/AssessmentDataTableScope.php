<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class AssessmentDataTableScope implements DataTableScope
{
    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        if (auth()->user()->type == 0) {
            $query->where('users.company', auth()->user()->company);
        } else {
            if ($company = request('company_id')) {
                $query->where('users.company', $company);
            }
        }
        if ($assessment_date = request('assessment_date')) {
            $query->whereDate('user_assessments.assessment_date',$assessment_date);
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

        if ($category = request('reg_cat')) {
            $query->where('users.form_category',$category);
        }

        if ($assessment_status = request('assessment_status')) {
            $query->where('user_assessments.assessment_status',$assessment_status);
        }
        if ($result = request('result')) {
            $query->where('user_assessments.result',$result);
        }
      
        if ($iti_trade = request('iti_trade')) {
            $query->where('users.iti_trade',$iti_trade);
        }

        $query->where([['users.assessment','1'],['users.interview','0'],['users.on_boarding','0']]);
        return $query;
    }
}
