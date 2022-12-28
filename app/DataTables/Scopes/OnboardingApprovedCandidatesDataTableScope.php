<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class OnboardingApprovedCandidatesDataTableScope implements DataTableScope
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
            if ($company = request('company')) {
                $query->where('users.company', $company);
            }
        }

        if ($start_date = request('start_date')) {
            $query->whereDate('candidate_interviews.interview_date','>=',$start_date);
        }

        if ($end_date = request('end_date')) {
            $query->whereDate('candidate_interviews.interview_date','<=',$end_date);
        }

        if ($onboarding_date = request('onboarding_date')) {
            $query->whereDate('onboardings.onboarding_date',$onboarding_date);
        }

        if ($form_category = request('form_category')) {
            $query->where('form_category',$form_category);
        }

        if ($candidate_status = request('status')) {
            $query->where('onboardings.status',$candidate_status);
        }

        if ($iti_trade = request('iti_trade')) {
            $query->where('users.iti_trade',$iti_trade);
        }       

        if ($permanent_state = request('permanent_state')) {
            $query->where('users.permanent_state',$permanent_state);
        }

        if ($venue_id = request('venue_id')) {
            $query->where('onboardings.venue_id',$venue_id);
        }

        if ($unique_id = request('unique_id')) {
            $query->where('users.unique_id',$unique_id);
        }

        if ($permanent_district = request('permanent_district')) {
            $query->where('users.permanent_district',$permanent_district);
        }

        $query->where([['users.interview','1'],['users.assessment','1'],['users.on_boarding','1']]);
        return $query;
    }
}
