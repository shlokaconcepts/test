<?php

namespace App\DataTables;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminDataTable extends DataTable
{

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()

            ->addColumn('action', function ($row) {
                $html = '';
                if (in_array(4, auth()->user()->get_allowed_menus()['edit'])) {
                    $html .= '<button onClick="editAdminModal(event)" class="btn btn-outline-success btn-sm"><i class="bx bx-pencil bx-2x"></i></button>';
                }
                if (in_array(4, auth()->user()->get_allowed_menus()['delete'])) {
                    $html .= '<button class="btn btn-outline-danger btn-sm ms-2" onClick="deleteAdmin(' . $row->id . ')"><i class="bx bx-trash bx-2x"></i></button>';
                }
                return $html;
            })
            ->addColumn('image', function ($row) {
                return "<img src='" . $row->image . "' class='img-circle' width='50' height='50'>";
            })
            ->addColumn('company_name', function ($row) {
                return $row->company_name.','.$row->prefix;
            })
            ->rawColumns(['action', 'address', 'image']);
    }


    public function query(Admin $model): QueryBuilder
    {
        $query = Admin::leftJoin('companies', 'companies.id', 'admins.company')
            ->where('admins.type', '0')
            ->where('interviewer_type',NULL)->orWhere('interviewer_type','')
            ->select('admins.*', 'companies.name as company_name','admins.image as full_image','companies.prefix')
            ->latest();
        return $this->applyScopes($query);
    }


    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('admindatatable-table')
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

    public function getColumns(): array
    {
        $return_array[] = Column::make('DT_RowIndex')->title('Sr. no.')->searchable(false)->orderable(false);
        $return_array[] = Column::make('image')->printable(false)->title('Profile Image')->searchable(false);
        $return_array[] = Column::make('name')->title('Name')->searchable(true);
        $return_array[] = Column::make('phone')->title('Mobile')->addClass('text-center');
        $return_array[] = Column::make('email')->title('Email');
        $return_array[] = Column::make('company_name')->name('companies.name')->title('Company');
        if (in_array(4, auth()->user()->get_allowed_menus()['delete']) || in_array(4, auth()->user()->get_allowed_menus()['edit'])) {
            $return_array[] = Column::make('action')->addClass('text-center')->searchable(false)->printable(false)->exportable(false)->orderable(false);
        }
        return $return_array;
    }


    protected function filename(): string
    {
        return 'Admin_' . date('YmdHis');
    }
}
