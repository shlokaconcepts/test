<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class RegistrationDataTableScope implements DataTableScope
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
            $query->where('users.company', auth()->user()->company);
        } else {
            if ($company = request('company_id')) {
                $query->where('users.company', $company);
            }
        }
        if ($eligibility = request('eligibility')) {
            $query->where('users.eligibility', $eligibility);
        }

        if ($start_date = request('start_date')) {
            $query->whereDate('users.registration_date', '>=', $start_date);
        }

        if ($end_date = request('end_date')) {
            $query->whereDate('users.registration_date', '<=', $end_date);
        }

        if ($form_category = request('form_category')) {
            $query->where('users.form_category', $form_category);
        }
        if ($permanent_state = request('permanent_state')) {
            $query->where('users.permanent_state', $permanent_state);
        }

        if ($permanent_district = request('permanent_district')) {
            $query->where('users.permanent_district', $permanent_district);
        }

        if ($unique_id = request('unique_id')) {
            $query->where('users.unique_id', $unique_id);
        }
        $query->where('users.form_complete_status', 'Complete');
        return $query;
    }
}
