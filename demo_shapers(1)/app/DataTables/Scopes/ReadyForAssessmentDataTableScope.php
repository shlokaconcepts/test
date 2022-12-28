<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class ReadyForAssessmentDataTableScope implements DataTableScope
{
    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        if(auth()->user()->type==0){
            $query->where('users.company',auth()->user()->company);
        }else if($company = request('company_id')){
            $query->where('users.company',$company);
        }

        if ($exam = request('exam')) {
            $query->where('users.exam_id',$exam);
        }
        if ($exam_batch = request('exam_batch')) {
            $query->where('users.exam_batch',$exam_batch);
        }
        if ($iti_trade = request('iti_trade')) {
            $query->where('users.iti_trade',$iti_trade);
        }
        
        if ($unique_id = request('unique_id')) {
            $query->where('users.unique_id',$unique_id);
        }
        $query->where([['users.eligibility','eligible'],['users.exam_id','!=',NULL],['users.assessment','0'],['users.interview','0'],['users.on_boarding','0'],['user_document_statuses.status','Pending']]);
        return $query;
    }
}
