<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class ExamBatchScope implements DataTableScope
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
            $query->where('exam_batches.company',auth()->user()->company);
        }
        if ($company = request('company_id')) {
            $query->where('exam_batches.company',$company);
        }
        if ($exam_id = request('exam_id')) {
            $query->where('exam_batches.exam',$exam_id);
        }
        
        return $query;
    }
}
