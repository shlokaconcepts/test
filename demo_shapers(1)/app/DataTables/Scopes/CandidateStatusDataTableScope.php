<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class CandidateStatusDataTableScope implements DataTableScope
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
        if ($eligibility = request('eligibility')) {
            $query->where('users.eligibility', $eligibility);
        }



        if (request('date_type')) {
            $date_type=request('date_type');
            if ($date_type == 'registration_date') {
                if ($start_date = request('start_date')) {
                    $query->whereDate('users.registration_date', '>=', $start_date);
                }
                if ($end_date = request('end_date')) {
                    $query->whereDate('users.registration_date', '<=', $end_date);
                }
            } elseif ($date_type == 'assessment_date') {
                if ($start_date = request('start_date')) {
                    $query->whereDate('candidate_statuses.assessment_date', '>=', $start_date);
                }
                if ($end_date = request('end_date')) {
                    $query->whereDate('candidate_statuses.assessment_date', '<=', $end_date);
                }
            } elseif ($date_type == 'interview_date') {
                if ($start_date = request('start_date')) {
                    $query->whereDate('candidate_statuses.interview_date', '>=', $start_date);
                }
                if ($end_date = request('end_date')) {
                    $query->whereDate('candidate_statuses.interview_date', '<=', $end_date);
                }
            } elseif ($date_type == 'onboarding_date') {
                if ($start_date = request('start_date')) {
                    $query->whereDate('candidate_statuses.onboarding_date', '>=', $start_date);
                }
                if ($end_date = request('end_date')) {
                    $query->whereDate('candidate_statuses.onboarding_date', '<=', $end_date);
                }
            }
        }


        if ($assessment_status = request('assessment_status')) {
            $query->where('candidate_statuses.assessment_status', $assessment_status);
        }

        if ($assessment_result = request('assessment_result')) {
            $query->where('candidate_statuses.assessment_result', $assessment_result);
        }



        if ($interview_status = request('interview_status')) {
            $query->where('candidate_statuses.interview_status', $interview_status);
        }

        if ($interview_result = request('interview_result')) {
            $query->where('candidate_statuses.interview_result', $interview_result);
        }


        if ($onboarding_status = request('onboarding_status')) {
            if($onboarding_status=='Joined Onboarded'){
                $query->where('candidate_statuses.onboarding_result', $onboarding_status);
            }else{
                $query->where('candidate_statuses.onboarding_status', $onboarding_status);
            }
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

        if ($iti_trade = request('iti_trade')) {
            $query->where('users.iti_trade', $iti_trade);
        }
        $query->where('users.form_complete_status', 'Complete');
        return $query;
    }
}
