<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class ExamScope implements DataTableScope
{
    
    public function apply($query)
    {
        if(auth()->user()->type!='1'){
            $query->where('exams.company',auth()->user()->company);
        }
        if ($company = request('company_id')) {
            $query->where('exams.company',$company);
        }
        if ($date = request('date')) {
            $query->whereDate('date',$date);
        }
        return $query;
    }
}
