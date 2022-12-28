<?php

namespace App\DataTables;

use App\Models\ExamQuestion;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExamQuestionDataTable extends DataTable
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
                $html = '';
                if (in_array(9, auth()->user()->get_allowed_menus()['edit'])) {
                    $html .= '<button  class="btn btn-outline-success btn-sm"  onClick="editQuestionModal(event)"><i class="bx bx-pencil bx-2x"></i></button>';
                }
                if (in_array(9, auth()->user()->get_allowed_menus()['delete'])) {
                    $html.='<button class="btn btn-outline-danger btn-sm ms-2" onClick="deleteQuestion('.$row->id.')"><i class="bx bx-trash bx-2x"></i></button>';
                }
                return $html;
            })


            ->addColumn('status', function ($row) {

                $checked = '';
                if ($row->status == 'active') {
                    $checked = 'checked';
                }

                return '<label class="switch"><input type="checkbox"' . $checked . '><span class="slider round"  onclick="ChangeStatus(this,' . $row->id . ')"></span></label>';
            })
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ExamQuestionDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ExamQuestion $model): QueryBuilder
    {
        // return $model->newQuery();
        $query = ExamQuestion::leftJoin('exam_sets', 'exam_questions.exam_set', 'exam_sets.id')
            ->leftJoin('registration_categories', 'exam_questions.category', 'registration_categories.id')
            ->leftJoin('trades', 'exam_questions.trade', 'trades.id')
            ->select('exam_questions.*', 'registration_categories.name as cat_name', 'exam_sets.name as exam_set_name', 'trades.name as trade_name')
            ->latest();
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
            ->setTableId('examquestiondatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->ScrollX(true)
            ->orderBy(1)
            //->dom('Bfrtip')
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        $return_array[] = Column::make('DT_RowIndex')->title('Sr. no.')->searchable(false)->orderable(false);
        $return_array[] = Column::make('english_question')->title('Question');
        $return_array[] = Column::make('english_option_one')->title('Option One');
        $return_array[] = Column::make('english_option_two')->title('Option Two');
        $return_array[] = Column::make('english_option_three')->title('Option Three');
        $return_array[] = Column::make('english_option_four')->title('Option Four');
        $return_array[] = Column::make('answer')->title('Answer');
        $return_array[] = Column::make('exam_set_name')->title('Exam Section')->name('exam_sets.name');
        $return_array[] = Column::make('cat_name')->title('Category')->name('registration_categories.name');
        $return_array[] = Column::make('trade_name')->title('Trade')->name('trades.name');
        $return_array[] = Column::make('status')->title('Status')->printable(false)->exportable(false);
        if (in_array(9, auth()->user()->get_allowed_menus()['edit']) || in_array(9, auth()->user()->get_allowed_menus()['delete'])) {
            $return_array[] = Column::make('action')->addClass('text-center')->searchable(false)->printable(false)->exportable(false)->orderable(false);
        }
        return $return_array;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'ExamQuestion_' . date('YmdHis');
    }
}
