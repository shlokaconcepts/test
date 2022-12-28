<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class UserDocumentStatusDataTableScope implements DataTableScope
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
        }else if ($company = request('company_id')) {
            $query->where('users.company',$company);
        }

        if ($exam_id = request('exam')) {
            $query->where('users.exam_id',$exam_id);
        }

        if ($iti_trade = request('iti_trade')) {
            $query->where('users.iti_trade',$iti_trade);
        }

        if ($exam_batch = request('exam_batch')) {
            $query->where('users.exam_batch',$exam_batch);
        }
        if ($unique_id = request('unique_id')) {
            $query->where('users.unique_id',$unique_id);
        }

        if ($candidate_status = request('candidate_status')) {
            $query->where('user_document_statuses.status',$candidate_status);
        }
       
        if(datatables()->getRequest()->status=='view-candidate'){
            $query->where('user_document_statuses.status','!=','Absent'); 
            $query->where([['users.assessment','0'],['users.interview','0'],['users.on_boarding','0']]);
        }else{
            $query->where([['users.eligibility','Eligible'],['users.exam_id','!=',NULL],['users.exam_link_status','0'],['users.assessment','0'],['users.interview','0'],['users.on_boarding','0'],['user_document_statuses.status','!=','Absent']]);
        }

        if(datatables()->getRequest()->status=='un-approve'){
            $query->where('users.document_verify_status','0');
        }

        
        return $query;
    }
}
