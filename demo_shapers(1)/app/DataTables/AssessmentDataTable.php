<?php

namespace App\DataTables;

use App\Models\UserAssessment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AssessmentDataTable extends DataTable
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

                return '<a href="' . route('admin.print-assessment-report', Crypt::encrypt($row->id)) . '" target="_blank" class="" >View Report</a>';
            })
            ->addColumn('edit_mark', function ($row) {

                return '<a href="javascript:void(0);" class="" onclick="EditMarkModal(this,' . $row->ass_id . ')" >Edit Now</a>';
            })
            ->addColumn('check_column', function ($row) {
                return '<input type="checkbox" class="single_rows_check form-check-input  check_column_' . $row->id . '" name="checked_ids[]" id="check_columnId_' . $row->id . '" value="' . $row->id . '">';
            })
            ->rawColumns(['check_column', 'action', 'edit_mark']);
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
                'user_assessments.id as ass_id',
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
                'user_assessments.result',
                'user_assessments.assessment_date',
                'user_assessments.technical',
                'user_assessments.aptitude',
                'user_assessments.behavior',
                'user_assessments.total_mark',
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
            ->setTableId('assessmentdatatable-table')
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

        if (in_array(21, auth()->user()->get_allowed_menus()['submit_btn'])) {
            $return_array[] = Column::make('check_column')->title('<input type="checkbox" class="form-check-input" id="check_all" onChange="checkAll(this)">')->searchable(false)->orderable(false)->printable(false)->exportable(false)->addClass('table_bg_color ');
        }
        $return_array[] = Column::make('action')->printable(false)->searchable(false)->title('Assessment Report');
        // if (in_array(21, auth()->user()->get_allowed_menus()['submit_btn'])) {
        //     $return_array[] = Column::make('edit_mark')->printable(false)->searchable(false)->title('Edit Marks');
        // }
        $return_array[] = Column::make('DT_RowIndex')->title('Sno')->searchable(false)->orderable(false);


        $return_array[] = Column::make('unique_id')->title('Reg. No.');
        $return_array[] = Column::make('full_name')->title('Name ');
        $return_array[] = Column::make('phone_number')->name('users.phone_number')->title('Mobile No');
        $return_array[] = Column::make('aadhar_card')->name('users.aadhar_card')->title('Aadhar');
        $return_array[] = Column::make('father_name')->name('users.father_name')->title('Father Name');
        $return_array[] = Column::make('state_name')->title('State');
        $return_array[] = Column::make('dis_name')->title('District');
        $return_array[] = Column::make('cat_name')->title('Category');
        $return_array[] = Column::make('iti_trade')->title('Trade');
        $return_array[] = Column::make('exam_name')->title('Exam Name')->searchable(false);
        $return_array[] = Column::make('batch_name')->title('Batch Name')->searchable(false);

        $return_array[] = Column::make('assessment_date')->title('Assessment Date');
        $return_array[] = Column::make('assessment_status')->title('Assessment Status');
        $return_array[] = Column::make('technical')->title('Technical');
        $return_array[] = Column::make('aptitude')->title('Aptitude');
        $return_array[] = Column::make('behavior')->title('Behavior');
        $return_array[] = Column::make('total_mark')->title('Total Marks');
        $return_array[] = Column::make('result')->title('Result');
        return $return_array;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Assessment_' . date('YmdHis');
    }
}
