<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EligibleCandidateDataTable extends DataTable
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
        ->addColumn('exam_id',function ($row) {
            if($row->exam_id){
                return 'Assigned';
            }else{
                 return 'Not Assigned';
            }
        })
        ->addColumn('check_column',function ($row) {
            return '<input type="checkbox" class="single_rows_check   form-check-input  check_column_'.$row->id.'" name="checked_ids[]" id="check_columnId_'.$row->id.'" value="'.$row->id.'">';
        })
        ->rawColumns(['check_column']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\EligibleCandidateDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {

        // return $model->newQuery();
        $users = User::leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
        ->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
        ->leftJoin('states', 'states.id', '=', 'users.permanent_state')
        ->leftJoin('districts', 'districts.id', '=', 'users.permanent_district')
            ->select(
                'users.id',
                'users.unique_id',
                'users.exam_id',
                'users.eligibility',
                'users.full_name',
                'users.email',
                'users.phone_number',
                'users.aadhar_card',
                'trades.name as trade_name',
                'registration_categories.name as reg_name',
                'districts.name as district_name',
                'states.name as state_name',
            );
        return $this->applyScopes($users);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('eligiblecandidatedatatable-table')
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
            Column::make('check_column')->title('<input type="checkbox" class="form-check-input" onChange="checkAll(this)">')->searchable(false)->orderable(false)->printable(false)->exportable(false)->addClass('table_bg_color '),
            Column::make('DT_RowIndex')->title('Sno')->searchable(false)->orderable(false),
            Column::make('unique_id')->title('Reg. No.'),
            Column::make('exam_id')->title('Exam Assign Status')->searchable(false),
            Column::make('eligibility')->title('Eligible Status'),
            Column::make('reg_name')->name('registration_categories.name')->title('Registration Type')->searchable(false),
            Column::make('trade_name')->name('trades.name')->title('Trade')->searchable(false),
            Column::make('full_name')->title('Name'),
            Column::make('email')->title('Email'),
            Column::make('phone_number')->title('Mobile No'),
            Column::make('aadhar_card')->title('Aadhar No'),
            Column::make('state_name')->title('State')->searchable(false),
            Column::make('district_name')->title('District')->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'EligibleCandidate_' . date('YmdHis');
    }
}
