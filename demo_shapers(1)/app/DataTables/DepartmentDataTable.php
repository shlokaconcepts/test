<?php

namespace App\DataTables;

use App\Models\Department;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DepartmentDataTable extends DataTable
{
    
    public function dataTable(QueryBuilder $query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action',function ($row) {
                    $html='';
                    if(in_array(2, auth()->user()->get_allowed_menus()['edit'])){
                    $html.='<a href='.route("admin.edit-department",$row->id).' class="btn btn-outline-success btn-sm"><i class="bx bx-pencil bx-2x"></i></a>';
                    }
                    if(in_array(2, auth()->user()->get_allowed_menus()['delete'])){ 
                    $html.='<button class="btn btn-outline-danger btn-sm ms-2" onClick="deleteDepartment('.$row->id.')"><i class="bx bx-trash bx-2x"></i></button>';
                    }
                    return $html;
              }) 
              ->rawColumns(['action']);
            
    }

   
    public function query(Department $model): QueryBuilder
    {
        return $model->newQuery();
    }

  
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('departmentdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        $return_array[]=Column::make('DT_RowIndex')->title('Sr. no.')->searchable(false)->orderable(false);
        $return_array[]=Column::make('name')->title('Department')->class('text-start');
        $return_array[]=Column::make('action')->addClass('text-center')->searchable(false)->printable(false)->exportable(false)->orderable(false);
        return $return_array;
    }
   
    protected function filename(): string
    {
        return 'Department_' . date('YmdHis');
    }
}
