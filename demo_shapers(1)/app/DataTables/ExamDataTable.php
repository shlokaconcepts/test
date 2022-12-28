<?php

namespace App\DataTables;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExamDataTable extends DataTable
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
        ->addColumn('action',function ($row) {
            $html='';
            if(in_array(6,auth()->user()->get_allowed_menus()['edit']) ){
                $html.='<a  data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="btn btn-outline-success btn-sm"  href="'.route('admin.get-exam-detail', $row->id).'"><i class="bx bx-pencil bx-2x"></i></a>';
            }
            if(in_array(6,auth()->user()->get_allowed_menus()['delete']) ){
                $html.='<a class="btn btn-outline-danger btn-sm ms-2" onClick="deleteExam('.$row->id.')"><i class="bx bx-trash bx-2x"></i></a>';
            }
                return $html;
          })

        ->addColumn('status',function ($row) {
            $checked='';
            if($row->status=='active'){
              $checked='checked';
        }
         return '<label class="switch"><input type="checkbox"'.$checked.'><span class="slider round"  onclick="ChangeStatus(this,'.$row->id.')"></span></label>';
        })

        ->addColumn('duration',function ($row) {
            return explode(':',$row->duration)[0].' hour :'.explode(':',$row->duration)[1].' minutes';
        })

        ->addColumn('venue',function ($row) {
            return strip_tags($row->venue);
        })
        ->addColumn('center',function ($row) {
            return strip_tags($row->venue);
        })

        ->addColumn('date',function ($row) {
            return date('d M Y',strtotime($row->date));
        })

        ->editColumn('aptitude',function ($row) {
            return getExamSetTotalQuestions($row->id,1);
        })
        ->editColumn('technical',function ($row) {
            return getExamSetTotalQuestions($row->id,3);
        })
        ->editColumn('behavior',function ($row) {
            return getExamSetTotalQuestions($row->id,2);
        })

        ->rawColumns(['action','status','venue','center']);
    }


    public function query(Exam $model): QueryBuilder
    {
        return $model->newQuery();
    }

    
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('examdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->ScrollX(true)
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

    
    public function getColumns(): array
    {
        $return_array[]=Column::make('DT_RowIndex')->title('Sno')->searchable(false)->orderable(false);
        $return_array[]=Column::make('name')->title('Exam Title');
        $return_array[]=Column::make('date')->title('Exam Date');
        $return_array[]=Column::make('duration')->title('Time Duration');
        $return_array[]= Column::make('center')->title('Exam Center');
        $return_array[]= Column::make('venue')->title('Exam Address');
        $return_array[]= Column::make('aptitude')->title('Aptitude')->searchable(false)->orderable(false);
        $return_array[]= Column::make('behavior')->title('Behavior')->searchable(false)->orderable(false);
        $return_array[]= Column::make('technical')->title('Technical')->searchable(false)->orderable(false);
        $return_array[]= Column::make('total_question')->title('No.Of Questions');
        $return_array[]= Column::make('status')->title('Status');
        if (in_array(6,auth()->user()->get_allowed_menus()['edit']) || in_array(6,auth()->user()->get_allowed_menus()['delete'])){
            $return_array[]=Column::make('action')->addClass('text-center')->searchable(false)->printable(false)->exportable(false)->orderable(false);  
        }
        return $return_array;
    }

   
    protected function filename(): string
    {
        return 'Exam_' . date('YmdHis');
    }
}
