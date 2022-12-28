<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class ExamQuestionScope implements DataTableScope
{
    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        if(auth()->user()->type!='1'){
            $query->where('exam_questions.company',auth()->user()->company);
        }
        if ($company = request('company_id')) {
            $query->where('exam_questions.company',$company);
        }
        if ($trade = request('trade_id')) {
            $query->where('exam_questions.trade',$trade);
        }

        if ($category_id = request('category_id')) {
            $query->where('exam_questions.category',$category_id);
        }

        if ($set_id = request('set_id')) {
            $query->where('exam_questions.exam_set',$set_id);
        }

        return $query;
    }
}
