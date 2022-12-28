<?php

namespace App\DataTables;

use App\Models\RegistrationLink;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RegistrationLinkDataTable extends DataTable
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
                if(in_array(5,auth()->user()->get_allowed_menus()['edit'])){
                    $html.='<button title="Edit" class="btn btn-outline-success btn-sm" onclick="editLinkModal(event)" ><i class="bx bx-pencil"></i></button>';
                }
                if(in_array(5,auth()->user()->get_allowed_menus()['delete'])){
                    $html.='<button class="btn btn-outline-danger ms-2 btn-sm" onClick="deleteLink('.$row->id.')"><i class="bx bx-trash"></i></button>';
                }
                return $html;
          })

         ->addColumn('closed_time',function ($row) {
            return date('d-m-Y',strtotime($row->closed_time));
        })
        ->editColumn('closed_times',function ($row) {
            return date('H:i A',strtotime($row->closed_time));
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

  
    public function query(RegistrationLink $model): QueryBuilder
    {
        $data =RegistrationLink::leftJoin('registration_categories','registration_categories.id','=','registration_links.form_category')
        ->leftJoin('companies','registration_links.company','=','companies.id')
        ->select('registration_links.*','registration_categories.name as cat_name',DB::raw("CONCAT(companies.name, ', ' ,companies.prefix) AS company_name"));
        if(auth()->user()->type=='0'){
          $data->where('registration_categories.company',auth()->user()->company);
        }
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
                    ->setTableId('registrationlinkdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->ScrollX(true)
                    ->ScrollY(250)
                    ->orderBy(1)->lengthMenu([10, 25, 50, 100, 500])
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
        $return_array[]=Column::make('full_url')->title('Full URL');
        $return_array[]=Column::make('cat_name')->title('Category')->name('registration_categories.name');
        $return_array[]=Column::make('company_name')->title('Company')->name('companies.name');
        $return_array[]=Column::make('closed_time')->title('Reg. Link Close Date');
        $return_array[]=Column::make('status')->title('Status');
        if(in_array(5,auth()->user()->get_allowed_menus()['delete']) || in_array(5,auth()->user()->get_allowed_menus()['edit'])){
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
        return 'RegistrationLink_' . date('YmdHis');
    }
}
