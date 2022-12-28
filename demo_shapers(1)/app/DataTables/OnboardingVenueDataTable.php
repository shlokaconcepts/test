<?php

namespace App\DataTables;

use App\Models\OnboardingVenue;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OnboardingVenueDataTable extends DataTable
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
                if (in_array(26, auth()->user()->get_allowed_menus()['edit'])) {
                    $html .= '<button  class="btn btn-outline-success btn-sm" onclick="editModal(event)" ><i class="bx bx-pencil bx-2x"></i></button>';
                }
                if (in_array(26, auth()->user()->get_allowed_menus()['delete'])) {
                    $html .= '<button class="btn btn-outline-danger ms-2 btn-sm" onclick="deleteRecord(this,' . $row->id . ')"><i class="bx bx-trash bx-2x"></i></button>';
                }
                return $html;
            })

            ->addColumn('company_name', function ($row) {
               return $row->company_name.','.$row->prefix;
            })


            ->addColumn('status', function ($row) {

                $checked = '';
                if ($row->status == '1') {
                    $checked = 'checked';
                }

                return '<label class="switch"><input type="checkbox"' . $checked . '><span class="slider round"  onclick="ChangeStatus(this,' . $row->id . ')"></span></label>';
            })


            ->rawColumns(['action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OnboardingVenueDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OnboardingVenue $model): QueryBuilder
    {
        $query = OnboardingVenue::leftJoin('companies', 'companies.id', '=', 'onboarding_venues.company')
            ->select(
                'onboarding_venues.id',
                'onboarding_venues.name',
                'onboarding_venues.location',
                'onboarding_venues.status',
                'onboarding_venues.company',
                'companies.name as company_name',
                'companies.prefix'
            );
        return  $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('onboardingvenuedatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
        $return_array[] = Column::make('DT_RowIndex')->title('Sr. no.')->searchable(false)->orderable(false);
        $return_array[] = Column::make('name')->title('Venue Title');
        $return_array[] = Column::make('location')->title('Venue Location');
        $return_array[] = Column::make('company_name')->name('companies.name')->title('Company');
        $return_array[] = Column::make('status')->title('Status');
        if (in_array(26, auth()->user()->get_allowed_menus()['delete']) || in_array(26, auth()->user()->get_allowed_menus()['edit'])) {
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
        return 'OnboardingVenue_' . date('YmdHis');
    }
}
