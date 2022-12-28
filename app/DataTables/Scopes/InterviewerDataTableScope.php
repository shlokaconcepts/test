<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class InterviewerDataTableScope implements DataTableScope
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
            $query->where('admins.company', auth()->user()->company);
        } else {
            if ($company = request('company_id')) {
                $query->where('admins.company', $company);
            }
        }

        if ($panel = request('panel_id')) {
            $query->where('admins.panel',$panel);
        }
        if ($post = request('post')) {
            $query->where('admins.interviewer_type',$post);
        }

        if ($employee_id = request('employee_id')) {
            $query->where('admins.employee_id',$employee_id);
        }

        return $query->whereIn('interviewer_type',['hr','technical']);
    }
}
