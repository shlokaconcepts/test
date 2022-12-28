<?php

namespace App\DataTables;

use App\Models\RegistrationCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RegistrationCategoryDataTable extends DataTable
{
 
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
        ->eloquent($query)
        ->addIndexColumn()

        ->addColumn('action',function ($row) {
                $html='';
                if(in_array(8,auth()->user()->get_allowed_menus()['edit'])){
                    $html.='<button title="Edit" class="btn btn-outline-success btn-sm" onclick="editRGModal(event)" ><i class="bx bx-pencil"></i></button>';
                }
                if(in_array(8,auth()->user()->get_allowed_menus()['delete'])){
                    $html.='<button class="btn btn-outline-danger ms-2 btn-sm" onClick="deleteRG('.$row->id.')"><i class="bx bx-trash"></i></button>';
                }
                return $html;
          })
        ->addColumn('status',function ($row) {
            $checked='';
            if($row->status=='1'){
              $checked='checked';
        }
         return '<label class="switch"><input type="checkbox"'.$checked.'><span class="slider round"  onclick="ChangeStatus(this,'.$row->id.')"></span></label>';

        })
        ->rawColumns(['action','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RegistrationCategoryDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RegistrationCategory $model): QueryBuilder
    {
        $data =RegistrationCategory::leftJoin('companies','registration_categories.company','=','companies.id')
        ->select('registration_categories.*',DB::raw("CONCAT(companies.name, ', ' ,companies.prefix) AS company_name"));
        return $this->applyScopes($data);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('registrationcategorydatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('lBfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
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
        $return_array[]=Column::make('title')->title('Title');
        $return_array[]=Column::make('name')->title('Name');
        $return_array[]=Column::make('company_name')->title('Company')->name('companies.name');
        $return_array[]=Column::make('created_by')->title('Created By');
        $return_array[]=Column::make('status')->title('Status');
        if(in_array(8,auth()->user()->get_allowed_menus()['delete']) || in_array(8,auth()->user()->get_allowed_menus()['edit'])){
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
        return 'RegistrationCategory_' . date('YmdHis');
    }
}
