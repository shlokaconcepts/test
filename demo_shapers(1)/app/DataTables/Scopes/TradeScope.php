<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class TradeScope implements DataTableScope
{
  
    public function apply($query)
    {
        if(auth()->user()->type!='1'){
            $query->where('trades.company',auth()->user()->company);
        }
        if ($company = request('company_id')) {
            $query->where('trades.company',$company);
        }
        return $query;
    }
}
