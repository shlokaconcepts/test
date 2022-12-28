<?php

namespace App\DataTables;

use App\Models\CandidateInterview;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InterviewResultDataTable extends DataTable
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
            ->addColumn('action', function ($row) {
                return '<a href="'.route('admin.candidate-interview-ass-sheet',Crypt::encrypt($row->user_id)).'"  class="" >View Interview Result</a>';
            })


            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\InterviewResultDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CandidateInterview $model): QueryBuilder
    {
        $query = CandidateInterview::leftJoin('users', 'users.id', 'candidate_interviews.user_id')->leftJoin('states', 'states.id', 'users.permanent_state')->leftJoin('districts', 'districts.id', 'users.permanent_district')->leftJoin('admins', 'admins.id', 'candidate_interviews.interviewer_id')->leftJoin('interviewer_panels', 'admins.panel', 'interviewer_panels.id')->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')->leftJoin('trades', 'trades.id', '=', 'users.iti_trade')

            ->select(
                'candidate_interviews.user_id',
                'users.unique_id',
                'users.full_name',
                'registration_categories.name as cat_name',
                'candidate_interviews.status',
                'users.phone_number',
                'users.email',
                'users.aadhar_card',
                'trades.name as iti_trade',
                'users.exam_link_status',
                'states.name as state_name',
                'districts.name as district_name',
                'interviewer_panels.name as panel_name',
                'admins.name as admin_name',
                'candidate_interviews.interview_date',
                'candidate_interviews.created_at'

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
            ->setTableId('interviewresultdatatable-table')
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
        $return_array[] = Column::make('DT_RowIndex')->title('Sno')->searchable(false)->orderable(false);
        $return_array[] = Column::make('action')->printable(false)->searchable(false)->title('Interview Assessment Sheet');
        $return_array[] = Column::make('unique_id')->title('Reg. No.');
        $return_array[] = Column::make('full_name')->title('Name');
        $return_array[] = Column::make('cat_name')->title('Registration Type');
        $return_array[] = Column::make('status')->title('Interview Status');
        $return_array[] = Column::make('phone_number')->name('users.phone_number')->title('Mobile No');
        $return_array[] = Column::make('email')->name('users.email')->title('Email');
        $return_array[] = Column::make('state_name')->name('states.name')->title('State');
        $return_array[] = Column::make('district_name')->name('districts.name')->title('District');
        $return_array[] = Column::make('iti_trade')->title('Trade');
        $return_array[] = Column::make('interview_date')->title('Interview Date');
        $return_array[] = Column::make('admin_name')->name('admins.name')->title('Interview Taken By');
        $return_array[] = Column::make('panel_name')->name('interviewer_panels.name')->title('Interview Panel');
        return $return_array;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'InterviewResult_' . date('YmdHis');
    }
}
