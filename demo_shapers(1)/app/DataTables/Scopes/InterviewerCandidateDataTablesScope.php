<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class InterviewerCandidateDataTablesScope implements DataTableScope
{
    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
    
        if($search=request('unique_id')){
            $query->where('users.unique_id',$search);
          
        }else{
            $query->where('users.created_at','');
        }
        return $query->where('users.company',auth()->user()->company)->where('users.assessment','1')->where('users.interview','0');
    }
}
