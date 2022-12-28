<?php

namespace App\DataTables;

use App\Models\Company;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\File;
use Str;

class CompanyDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()

            ->addColumn('action',function ($row) {
                $html='';
                if(in_array(3,auth()->user()->get_allowed_menus()['edit'])){
                    $html.='<button  class="btn btn-outline-success btn-sm"  onClick="editCompanyModal(event)"><i class="bx bx-pencil bx-2x"></i></button>'; 
                }
                // if(in_array(3,auth()->user()->get_allowed_menus()['delete'])){
                //     $html.='<button class="btn btn-outline-danger btn-sm ms-2" onClick="deleteCompany('.$row->id.')"><i class="bx bx-trash bx-2x"></i></button>';
                // }
                    
                return $html;
              })

              ->addColumn('description',function ($row) {
                  return Str::words(strip_tags($row->description), 8, ' ...');
              })

              ->addColumn('logo',function ($row) {
                    return "<img src='".getImage($row->logo)."' class='img-circle' width='50' height='50'>";
               })
        //        ->editColumn('full_description',function ($row) {
        //         return strip_tags($row->full_description);
        //    })

            ->rawColumns(['action','description','logo']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CompanyDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Company $model): QueryBuilder
    {
        // return $model->newQuery();
        $query=Company::leftJoin('company_categories','companies.category','company_categories.id')
        ->select('company_categories.name as cat_name','companies.*','companies.logo as full_logo','companies.description as full_description')->latest();

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
                    ->setTableId('companydatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
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
             $return_array[]=Column::make('logo')->printable(false)->title('Logo')->searchable(false);
             $return_array[]=Column::make('name')->title('Name')->searchable(true);
             $return_array[]=Column::make('prefix')->title('Company Code');
             $return_array[]=Column::make('description')->title('Description');
             $return_array[]=Column::make('cat_name')->name('company_categories.name')->title('Category');
             if(in_array(3,auth()->user()->get_allowed_menus()['delete']) || in_array(3,auth()->user()->get_allowed_menus()['edit'])){
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
        return 'Company_' . date('YmdHis');
    }
}
