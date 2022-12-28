<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class CheckCandidateDataTableScope implements DataTableScope
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
        }elseif($company=request('company_id')){
            $query->where('users.company', $company);
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
        if ($iti_trade = request('iti_trade')) {
            $query->where('users.iti_trade',$iti_trade);
        }
        if ($reg_cat = request('reg_cat')) {
            $query->where('users.form_category',$reg_cat);
        }
        if ($start_date = request('assessment_date_form')) {
            $query->whereDate('users_assessments.assessment_date', '>=', $start_date);
        }
        if ($end_date = request('assessment_date_to')) {
            $query->whereDate('users_assessments.assessment_date', '<=', $end_date);
        }
    }
}
