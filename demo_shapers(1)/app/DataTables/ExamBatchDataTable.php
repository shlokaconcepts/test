<?php

namespace App\DataTables;

use App\Models\ExamBatch;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExamBatchDataTable extends DataTable
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
                $html .= '<button  class="btn btn-outline-success btn-sm"  onClick="editExamBatchModal(event)"><i class="bx bx-pencil bx-2x"></i></button>';
            }
            if (in_array(9, auth()->user()->get_allowed_menus()['delete'])) {
                $html.='<button class="btn btn-outline-danger btn-sm ms-2" onClick="deleteExamBatch('.$row->id.')"><i class="bx bx-trash bx-2x"></i></button>';
            }
            return $html;
        })
        ->rawColumns(['action']);
    }

  
    public function query(ExamBatch $model): QueryBuilder
    {
        $query = ExamBatch::leftJoin('exams', 'exams.id', 'exam_batches.exam')
        ->leftJoin('companies', 'companies.id', 'exam_batches.company')
        ->select('exam_batches.*', 'exams.name as exam_name', 'companies.name as company_name')
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
                    ->setTableId('exambatchdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
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
        $return_array[]=Column::make('DT_RowIndex')->title('Sr. no.')->searchable(false)->orderable(false);
        $return_array[]=Column::make('company_name')->title('Company')->name('companies.name');
        $return_array[]=Column::make('exam_name')->title('Exam Name')->name('exams.name');
        $return_array[]=Column::make('name')->title('Batch Title');
        $return_array[]=Column::make('start_time')->title('Exam Start Time');
        $return_array[]=Column::make('end_time')->title('Exam End Time');
        if (in_array(10,auth()->user()->get_allowed_menus()['edit']) || in_array(10,auth()->user()->get_allowed_menus()['delete'])){
        $return_array[]=Column::make('action')->addClass('text-center')->searchable(false)->printable(false)->exportable(false)->orderable(false);
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
        return 'ExamBatch_' . date('YmdHis');
    }
}
