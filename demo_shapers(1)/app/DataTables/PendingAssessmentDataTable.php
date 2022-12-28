<?php

namespace App\DataTables;

use App\Models\UserAssessment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PendingAssessmentDataTable extends DataTable
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
            ->addColumn('check_column', function ($row) {
                return '<input type="checkbox" class="single_rows_check   form-check-input  check_column_' . $row->id . '" name="checked_ids[]" id="check_columnId_' . $row->id . '" value="' . $row->id . '">';
            })
            ->rawColumns(['check_column']);
    }

    public function query(UserAssessment $model): QueryBuilder
    {
        $query = UserAssessment::Join('users', 'users.id', 'user_assessments.user_id')
            ->leftJoin('registration_categories', 'users.form_category', '=', 'registration_categories.id')
            ->leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
            ->leftJoin('states', 'states.id', 'users.permanent_state')
            ->leftJoin('districts', 'districts.id', 'users.permanent_district')
            ->leftJoin('exams', 'exams.id', 'users.exam_id')
            ->leftJoin('exam_batches', 'exam_batches.id', 'users.exam_batch')
            ->select(
                'users.id',
                'users.unique_id',
                'users.full_name',
                'user_assessments.assessment_status',
                'users.phone_number',
                'users.aadhar_card',
                'users.father_name',
                'states.name as state_name',
                'districts.name as dis_name',
                'registration_categories.name as cat_name',
                'trades.name as iti_trade',
                'exams.name as exam_name',
                'exam_batches.name as batch_name',
                'user_assessments.result'
            );
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pendingassessmentdatatable-table')
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
        if (in_array(20, auth()->user()->get_allowed_menus()['submit_btn'])) {
            $return_array[] = Column::make('check_column')->title('<input type="checkbox" class="form-check-input" id="check_all" onChange="checkAll(this)">')->searchable(false)->orderable(false)->printable(false)->exportable(false)->addClass('table_bg_color ');
        }

        $return_array[] = Column::make('DT_RowIndex')->title('Sno')->searchable(false)->orderable(false);
        $return_array[] = Column::make('unique_id')->title('Reg. No.');
        $return_array[] = Column::make('full_name')->title('Name ');
        $return_array[] = Column::make('assessment_status')->title('Assessment Status')->searchable(false);
        $return_array[] = Column::make('phone_number')->name('users.phone_number')->title('Mobile No');
        $return_array[] = Column::make('aadhar_card')->name('users.aadhar_card')->title('Aadhar');
        $return_array[] = Column::make('father_name')->name('users.father_name')->title('Father Name');
        $return_array[] = Column::make('state_name')->title('State');
        $return_array[] = Column::make('dis_name')->title('District');
        $return_array[] = Column::make('cat_name')->title('Category');
        $return_array[] = Column::make('iti_trade')->title('Trade');
        $return_array[] = Column::make('exam_name')->title('Exam Name')->searchable(false);
        $return_array[] = Column::make('batch_name')->title('Batch Name')->searchable(false);
        $return_array[] = Column::make('result')->title('Assessment Result')->searchable(false);
        return $return_array;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'PendingAssessment_' . date('YmdHis');
    }
}
