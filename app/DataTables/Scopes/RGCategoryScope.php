<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class RGCategoryScope implements DataTableScope
{
   
    public function apply($query)
    {
        if(auth()->user()->type!='1'){
            $query->where('registration_categories.company',auth()->user()->company);
        }
        if ($company = request('company_id')) {
            $query->where('registration_categories.company',$company);
        }
        return $query;
    }
}
