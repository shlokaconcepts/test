<?php

namespace App\DataTables;

use App\Models\Onboarding;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OnboardingApprovedCandidatesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('company_name', function ($row) {
               return $row->company_name.' / '.$row->prefix;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OnboardingApprovedCandidatesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Onboarding $model): QueryBuilder
    {
        $query = Onboarding::join('users', 'users.id','onboardings.user_id')
        ->leftJoin('registration_categories', 'registration_categories.id','users.form_category')
        ->leftJoin('companies', 'companies.id','users.company')
        ->leftJoin('states', 'states.id', 'users.permanent_state')
        ->leftJoin('candidate_interviews', 'candidate_interviews.user_id', 'users.id')
        ->leftJoin('districts', 'districts.id', 'users.permanent_district')
        ->leftJoin('onboarding_venues', 'onboarding_venues.id', 'onboardings.venue_id')
        ->leftJoin('trades', 'trades.id','users.iti_trade')
            ->select(
                'users.unique_id',
                'users.employee_id',
                'users.full_name',
                'onboardings.status',
                'onboarding_venues.name as venue_name',
                'users.phone_number',
                'users.email',
                'users.aadhar_card',
                'trades.name as iti_trade',
                'registration_categories.name as cat_name',
                'states.name as state_name',
                'districts.name as district_name',
                'candidate_interviews.interview_date',
                'onboardings.onboarding_date',
                'onboardings.created_at',
                'companies.name as company_name',
                'companies.prefix',
            )->latest();
        return  $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('onboardingapprovedcandidatesdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->ScrollX(true)
            ->ScrollY(185)
            ->orderBy(1)
            ->searching(false)
            ->lengthMenu([10, 25, 50, 100, 500])
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('Sno')->searchable(false)->orderable(false),
            Column::make('unique_id')->title('Reg. No.'),
            Column::make('employee_id')->title('Employee Id')->searchable(false),
            Column::make('full_name')->title('Name'),
            Column::make('status')->searchable(false),
            Column::make('venue_name')->title('Venue Name'),
            Column::make('phone_number')->title('Mobile No'),
            Column::make('email')->title('Email'),
            Column::make('aadhar_card')->title('Aadhar'),
            Column::make('iti_trade')->title('Trade'),
            Column::make('cat_name')->title('Registration Type'),
            Column::make('state_name')->title('State'),
            Column::make('district_name')->title('District'),
            Column::make('interview_date')->title('Interview Date'),
            Column::make('onboarding_date')->title('Onboarding Date'),
            Column::make('company_name')->title('Company'),
            //Column::make('admin_name')->name('admins.name')->title('Created By'), 
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'OnboardingApprovedCandidates_' . date('YmdHis');
    }
}
