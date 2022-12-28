<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReadyForAssessmentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable($query)
    {
        return datatables()
        ->eloquent($query)
        ->addIndexColumn()
        ->addColumn('print_admit_card',function ($row) {
            return '<a href="'.route('admin.admit-card', Crypt::encrypt($row->id)).'" target="_blank" class="" ><i class="lni lni-printer"></i> Print</a>';

        })
        ->rawColumns(['print_admit_card']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ReadyForAssessmentDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        $users = User::query()
        ->leftJoin('user_document_statuses', 'users.id', 'user_document_statuses.user_id')
        ->leftJoin('registration_categories', 'users.form_category','=','registration_categories.id')
        ->leftJoin('trades', 'users.iti_trade','=','trades.id')
        ->leftJoin('states', 'users.permanent_state','=','states.id')
        ->leftJoin('districts',  'users.permanent_district','=','districts.id')
        ->leftJoin('exams', 'users.exam_id','=','exams.id')
        ->leftJoin('exam_batches', 'users.exam_batch','=','exam_batches.id')
            ->select(
            'users.id',
            'users.unique_id',
            'users.eligibility',
            'registration_categories.name as cat_name',
            'trades.name as trade_name',
            'users.full_name',
            'users.email',
            'users.phone_number',
            'users.aadhar_card',
            'states.name as state_name',
            'districts.name as district_name',
            'exams.name as exam_name',
            'exam_batches.name as exam_batch'
            );



        return  $this->applyScopes($users);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('readyforassessmentdatatable-table')
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
            Column::make('DT_RowIndex')->title('Sno')->searchable(false)->orderable(false),
            Column::make('print_admit_card')->printable(false)->searchable(false)->title('Print Admit Card'),
            Column::make('unique_id')->title('Reg. No.'),

            Column::make('eligibility')->title('Eligible Status'),
            Column::make('cat_name')->title('Registration Type'),
            Column::make('trade_name')->title('Trade'),
            Column::make('full_name')->title('Name'),
            Column::make('email')->title('Email'),
            Column::make('phone_number')->title('Mobile No'),
            Column::make('aadhar_card')->title('Aadhar No'),
            
            Column::make('state_name')->title('State')->searchable(false),
            Column::make('district_name')->title('District')->searchable(false),
            Column::make('exam_name')->title('Exam Name')->searchable(false),
            Column::make('exam_batch')->title('Batch Name')->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'ReadyForAssessment_' . date('YmdHis');
    }
}
