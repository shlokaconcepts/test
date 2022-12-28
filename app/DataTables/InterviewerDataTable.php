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

class InterviewerDataTable extends DataTable
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
                if (in_array(6, auth()->user()->get_allowed_menus()['edit'])) {
                    $html .= '<a target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="btn btn-outline-success btn-sm"  onClick="editInterviewerModal(this,' . $row->id . ')"><i class="bx bx-pencil bx-2x"></i></a>';
                }
                if (in_array(6, auth()->user()->get_allowed_menus()['delete'])) {
                    $html .= '<a class="btn btn-outline-danger ms-2 btn-sm" onClick="DeleteRecord(this,' . $row->id . ')"><i class="bx bx-trash bx-2x"></i></a>';
                }
                return $html;
            })


            ->addColumn('status', function ($row) {

                $checked = '';
                if ($row->status == '1') {
                    $checked = 'checked';
                }

                return '<label class="switch btn-sm "><input type="checkbox"' . $checked . '><span class="slider round"  onclick="ChangeStatus(this,' . $row->id . ')"></span></label>';
            })


            ->addColumn('interviewer_type', function ($row) {
                if ($row->interviewer_type && $row->interviewer_type != null) {
                    if ($row->interviewer_type == 'hr') {
                        return "HR";
                    } elseif ($row->interviewer_type == 'technical') {
                        return "Technical";
                    }
                }
            })

            ->addColumn('company_name', function ($row) {
                return $row->company_name.','.$row->prefix;
            })

            ->rawColumns(['action', 'status']);
    }


    public function query(Admin $model): QueryBuilder
    {
        $query = Admin::leftJoin('companies', 'companies.id', 'admins.company')
            ->leftJoin('interviewer_panels', 'admins.panel', 'interviewer_panels.id')
            ->select(
                'admins.id',
                'admins.username',
                'admins.employee_id',
                'admins.name',
                'admins.email',
                'admins.username',
                'admins.interviewer_type',
                'admins.created_at',
                'admins.status',
                'companies.name as company_name',
                'admins.image as full_image',
                'interviewer_panels.name as panel_name',
                'companies.prefix',
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
            ->setTableId('interviewerdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->ScrollX(true)
            ->ScrollY(300)
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
        $return_array[] = Column::make('DT_RowIndex')->title('Sr. no.')->searchable(false)->orderable(false);
        $return_array[] = Column::make('username')->title('Username');
        $return_array[] = Column::make('employee_id')->title('Employee ID');
        $return_array[] = Column::make('name')->title('Name');
        $return_array[] = Column::make('email')->title('Email');
        $return_array[] = Column::make('panel_name')->title('Panel');
        $return_array[] = Column::make('interviewer_type')->title('Post');
        $return_array[] = Column::make('created_at')->title('Created At');
        $return_array[] = Column::make('company_name')->title('Company');
        $return_array[] = Column::make('status')->title('Status')->printable(false)->exportable(false);
        if (in_array(23, auth()->user()->get_allowed_menus()['delete']) || in_array(23, auth()->user()->get_allowed_menus()['edit'])) {
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
        return 'Interviewer_' . date('YmdHis');
    }
}
