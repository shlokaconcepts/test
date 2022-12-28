<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class OnboardingVenueDataTableScope implements DataTableScope
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
            $query->where('onboarding_venues.company', auth()->user()->company);
        } else {
            if ($company = request('company')) {
                $query->where('onboarding_venues.company', $company);
            }
        }
        return $query;
    }
}
