<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\CandidateStatus;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Crypt;

class CandidateStatusDataTable extends DataTable
{
   
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
        ->eloquent($query)
        ->addIndexColumn()

        ->addColumn('print_caf', function ($row) {
            return '<a href="' . route('admin.print-caf-form', Crypt::encrypt($row->user_id)) . '" target="_blank" class="" >Print CAF</a>';
        })
        ->addColumn('int_assessment_report', function ($row) {
            if($row->interview_date!='' || $row->interview_date!=null){
                return '<a href="' . route('admin.candidate-interview-ass-sheet', Crypt::encrypt($row->user_id)) . '" target="_blank" class="" >Print</a>';
            }
        })
        ->addColumn('assessment_report', function ($row) {
            if($row->assessment_status=='Completed'){
                return '<a href="' . route('admin.print-assessment-report', Crypt::encrypt($row->user_id)) . '" target="_blank" class="" >Print</a>';
            }
        })
        ->rawColumns(['print_caf','int_assessment_report','assessment_report']);
    }

    public function query(CandidateStatus $model): QueryBuilder
    {
        $query = CandidateStatus::leftJoin('users', 'users.id', '=', 'candidate_statuses.user_id')
        ->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
        ->leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
        ->leftJoin('states', 'states.id', '=', 'users.permanent_state')
        ->leftJoin('districts', 'districts.id', '=', 'users.permanent_district')
        ->leftJoin('companies', 'companies.id', '=', 'users.company')
            ->select(
                'candidate_statuses.user_id',
                'users.registration_date',
                'registration_categories.name as cat_name',
                'trades.name as trade_name',
                'districts.name as district_name',
                'states.name as state_name',
                'users.full_name',
                'users.unique_id',
                'users.phone_number',
                'users.eligibility',
                'candidate_statuses.admit_card_status',
                'candidate_statuses.document_status',
                'candidate_statuses.document_result',
                'candidate_statuses.assessment_date',
                'candidate_statuses.assessment_status',
                'candidate_statuses.assessment_result',
                'candidate_statuses.interview_date',
                'candidate_statuses.interview_status',
                'candidate_statuses.interview_result',
                'candidate_statuses.onboarding_date',
                'candidate_statuses.onboarding_status',
                'companies.name as company_name'
            );
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
                    ->setTableId('candidatestatusdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->ScrollX(true)
                    ->ScrollY(250)
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
            
            Column::make('print_caf')->printable(false)->searchable(false)->title('Print CAF'),
            Column::make('DT_RowIndex')->title('Sno')->searchable(false)->orderable(false),
            Column::make('cat_name')->name('registration_categories.name')->title('Registration Type'),
            Column::make('unique_id')->name('users.unique_id')->title('Reg. No.'),
            Column::make('full_name')->name('users.full_name')->title('Name'),
            Column::make('company_name')->name('companies.name')->title('Company'),
            Column::make('phone_number')->name('users.phone_number')->title('Mobile No'),
            Column::make('eligibility')->name('users.eligibility')->title('Eligibility Status'),
            Column::make('registration_date')->name('users.registration_date')->title('Registration Date'),
            Column::make('state_name')->name('states.name')->title('State'),
            Column::make('district_name')->name('districts.name')->title('District'),
            Column::make('trade_name')->name('trades.name')->title('Trade')->searchable(false),
            Column::make('admit_card_status')->title('Admit Card')->searchable(false),
            Column::make('document_status')->title('Document')->searchable(false),
            Column::make('document_result')->title('Document Status')->searchable(false),
            Column::make('assessment_date')->title('Assessment Date')->searchable(false),
            Column::make('assessment_status')->title('Assessment Status')->searchable(false),
            Column::make('assessment_result')->title('Assessment Result')->searchable(false),

            Column::make('assessment_report')->title('Assessment Report')->searchable(false)->orderable(false),
            Column::make('interview_date')->title('Interview Date')->searchable(false),
            Column::make('interview_status')->title('Interview Status')->searchable(false),
            Column::make('interview_result')->title('Interview Result')->searchable(false),
            Column::make('int_assessment_report')->title('Interview Assessment Report')->searchable(false)->orderable(false),
            Column::make('onboarding_status')->title('Onboarding Status')->searchable(false),
            Column::make('onboarding_date')->title('Onboarding Date')->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'CandidateStatus_' . date('YmdHis');
    }
}
