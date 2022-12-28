<?php

namespace App\DataTables;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MenuDataTable extends DataTable
{
    
    public function dataTable(QueryBuilder $query)
    {
            return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action',function ($row) {
                    $html='';
                    if(in_array(1, auth()->user()->get_allowed_menus()['edit'])){
                    $html.='<button class="btn btn-outline-success btn-sm "  onClick="editMenuModal(event)"><i class="bx bx-pencil bx-2x"></i></button>'; 
                    }
                    if(in_array(1, auth()->user()->get_allowed_menus()['delete'])){
                    $html.='<button class="btn btn-outline-danger btn-sm ms-2" onClick="deleteMenu('.$row->id.')"><i class="bx bx-trash bx-2x"></i></button>';
                    }
                    return $html;
              }) 
              ->rawColumns(['action']);
            ;


    }

    public function query(Menu $model): QueryBuilder
    {
        return $model->newQuery();
    }

    
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('menudatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->orderBy(1)
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        $return_array[]=Column::make('DT_RowIndex')->title('Sr. no.')->searchable(false)->orderable(false);
        $return_array[]=Column::make('menu_name')->title('Menu Name')->class('text-start');
        $return_array[]=Column::make('id')->title('Menu ID')->class('text-start');
        $return_array[]=Column::make('add')->title('Add')->class('text-center');
        $return_array[]=Column::make('edit')->title('Edit')->class('text-center');
        $return_array[]=Column::make('view')->title('View')->class('text-center');
        $return_array[]=Column::make('delete')->title('Delete')->class('text-center');
        $return_array[]=Column::make('download')->title('Download')->class('text-center');
        $return_array[]=Column::make('submit_btn')->title('Submit Button')->class('text-center');
        $return_array[]=Column::make('action')->addClass('text-center')->searchable(false)->printable(false)->exportable(false)->orderable(false);
        return $return_array;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Menu_' . date('YmdHis');
    }
}
