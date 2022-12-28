<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class EligibleCandidateDataTableScope implements DataTableScope
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
        }

        if ($company_id = request('company_id')) {
            $query->where('users.company',$company_id);
        }

        if ($unique_id = request('unique_id')) {
            $query->where('users.unique_id',$unique_id);
        }

        if ($iti_trade = request('iti_trade')) {
            $query->where('users.iti_trade',$iti_trade);
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

        if ($present_state = request('present_state')) {
            $query->where('users.present_state',$present_state);
        }

        if ($present_district = request('present_district')) {
            $query->where('users.present_district',$present_district);
        }

        $query->where([['users.eligibility','Eligible'],['users.exam_id',NULL],['users.admit_card','0'],['users.exam_link_status','0'],['users.document_verify_status','0'],['users.assessment','0'],['users.interview','0'],['users.on_boarding','0']]);
       
       return $query;
    }
}
