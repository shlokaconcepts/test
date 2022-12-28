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

class AbsentDataTable extends DataTable
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

            ->addColumn('print_caf', function ($row) {
                return '<a href="' . route('admin.print-caf-form', Crypt::encrypt($row->id)) . '">Print CAF</a>';
            })


            ->addColumn('check_column', function ($row) {
                return '<input type="checkbox" class="single_rows_check   form-check-input  check_column_' . $row->id . '" name="checked_ids[]" id="check_columnId_' . $row->id . '" value="' . $row->id . '">';
            })
            ->rawColumns(['check_column', 'print_caf']);
    }


    public function query(User $model): QueryBuilder
    {
        $users = User::leftJoin('candidate_interviews', 'users.id', 'candidate_interviews.user_id')
            ->leftJoin('user_assessments', 'users.id', 'user_assessments.user_id')
            ->leftJoin('exams', 'exams.id', 'users.exam_id')
            ->leftJoin('user_document_statuses', 'users.id', 'user_document_statuses.user_id')
            ->leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
            ->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
            ->leftJoin('states', 'states.id', '=', 'users.permanent_state')
            ->leftJoin('districts', 'districts.id', '=', 'users.permanent_district')

            ->select(
                'users.id',
                'users.registration_date',
                'users.iti_trade',
                'states.name as permanent_state',
                'districts.name as permanent_district',
                'users.full_name',
                'registration_categories.name as form_category',
                'users.unique_id',
                'users.company',
                'users.phone_number',
                'users.eligibility',
                'candidate_interviews.status as candidate_interview_status',
                'user_assessments.assessment_status as assessment_status',
                'trades.name as iti_trade'
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
            ->setTableId('absentdatatable-table')
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
            Column::make('check_column')->title('<input type="checkbox" class="form-check-input" id="check_all" onChange="checkAll(this)">')->searchable(false)->orderable(false)->printable(false)->exportable(false)->addClass('table_bg_color '),
            Column::make('print_caf')->printable(false)->title('Print CAF'),
            Column::make('DT_RowIndex')->title('Sno')->orderable(false),
            Column::make('form_category')->title('Registration Type'),
            Column::make('unique_id')->title('Reg. No.'),
            Column::make('full_name')->title('Name'),
            Column::make('phone_number')->title('Mobile No'),
            Column::make('eligibility')->title('Eligibility Status'),
            Column::make('registration_date')->title('Registration Date'),
            Column::make('permanent_state')->title('State'),
            Column::make('permanent_district')->title('District'),
            Column::make('iti_trade')->title('Trade'),
            Column::make('assessment_status')->title('Assessment Status'),
            Column::make('candidate_interview_status')->title('Interview Status'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Absent_' . date('YmdHis');
    }
}
