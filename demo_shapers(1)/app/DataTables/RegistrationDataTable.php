<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Crypt;

class RegistrationDataTable extends DataTable
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
            return '<a href="' . route('admin.candidate-detail', Crypt::encrypt($row->id)) . '">Edit</a>';
        })
        ->addColumn('print_caf', function ($row) {
            return '<a href="' . route('admin.print-caf-form', Crypt::encrypt($row->id)) . '">Print CAF</a>';
        })
        ->addColumn('registration_date', function ($row) {
            return date('d M Y', strtotime($row->registration_date));
        })
        ->rawColumns(['action', 'print_caf']);
    }

    public function query(User $model): QueryBuilder
    {
        // return $model->newQuery();
        $users = User::leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
            ->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
            ->leftJoin('states', 'states.id', '=', 'users.permanent_state')
            ->leftJoin('districts', 'districts.id', '=', 'users.permanent_district')
            ->select(
                'users.id',
                'users.eligibility',
                'users.eligibility',
                'users.unique_id',
                'users.full_name',
                'users.phone_number',
                'users.email',
                'users.dob',
                'users.aadhar_card',
                'users.father_name',
                'districts.name as district_name',
                'states.name as state_name',
                'registration_categories.name as reg_name',
                'trades.name as trade_name',
                'users.iti_college_name',
                'users.iti_passing_year',
                'users.registration_date',
            );
            
        return $this->applyScopes($users);

        
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('registrationdatatable-table')
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
        $return_array[] = Column::make('print_caf')->searchable(false)->orderable(false)->title('Print CAF');
        if (in_array(11, auth()->user()->get_allowed_menus()['edit'])) {
            $return_array[] = Column::make('action')->addClass('text-center')->searchable(false)->orderable(false);
        }

        $return_array[] = Column::make('DT_RowIndex')->title('S.No')->searchable(false)->orderable(false);
        $return_array[] = Column::make('eligibility')->title('Eligibility Status');
        $return_array[] = Column::make('unique_id')->title('Reg. No');
        $return_array[] = Column::make('full_name')->title('Full Name');
        $return_array[] = Column::make('phone_number')->title('Mobile No');
        $return_array[] = Column::make('email')->title('Email');
        $return_array[] = Column::make('dob')->title('DOB');
        $return_array[] = Column::make('aadhar_card')->title('Aadhaar');
        $return_array[] = Column::make('father_name')->title('Father Name');
        $return_array[] = Column::make('state_name')->name('states.name')->title('State');
        $return_array[] = Column::make('district_name')->name('districts.name')->title('District');
        $return_array[] = Column::make('reg_name')->name('registration_categories.name')->title('Registration Type');
        $return_array[] = Column::make('trade_name')->name('trades.name')->title('Trade');
        $return_array[] = Column::make('iti_college_name')->title('ITI College');
        $return_array[] = Column::make('iti_passing_year')->title('Passing Year');
        $return_array[] = Column::make('registration_date')->title('Reg. Date');

        return $return_array;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Registration_' . date('YmdHis');
    }
}
