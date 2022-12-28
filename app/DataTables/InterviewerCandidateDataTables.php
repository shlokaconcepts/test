<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InterviewerCandidateDataTables extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
        ->eloquent($query)
        ->addIndexColumn()

        ->addColumn('company_name',function ($row) {
            return $row->company_name.','.$row->prefix;
        })


        ->addColumn('print_caf',function ($row) {
            return '<a href="' . route('admin.print-caf-form', Crypt::encrypt($row->id)) . '" target="_blank" class="" >Print CAF</a>';

        })

        ->addColumn('take_interview',function ($row) {
            return '<a href="'.route('admin.take-interview',Crypt::encrypt($row->id)).'" class="" ><i class="lni lni-printer"></i>Take Interview</a>';
        })


        ->rawColumns(['print_caf','take_interview']);
    }

   
    public function query(User $model): QueryBuilder
    {
        $users= User::leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
        ->leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
        ->leftJoin('states', 'states.id', '=', 'users.permanent_state')
        ->leftJoin('districts', 'districts.id', '=', 'users.permanent_district')
        ->leftJoin('companies', 'companies.id', '=', 'users.company')
            ->select(
                'users.id',
                'users.registration_date',
                'registration_categories.name as cat_name',
                'trades.name as trade_name',
                'districts.name as district_name',
                'states.name as state_name',
                'users.full_name',
                'users.unique_id',
                'users.email',
                'users.phone_number',
                'users.aadhar_card',
                'users.eligibility',
                'companies.name as company_name',
                'companies.prefix'
            );
        return  $this->applyScopes($users);
    }

  
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('interviewercandidatedatatables-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->ScrollX(true)
                    ->orderBy(1)
                    ->searching(false)
                    ->lengthMenu([10, 25, 50, 100, 500])
                    ->selectStyleSingle();
    }

  
    public function getColumns(): array
    {
       
        $return_array[]=Column::make('DT_RowIndex')->title('Sno')->searchable(false)->orderable(false);
            $return_array[]=Column::make('print_caf')->printable(false)->searchable(false)->title('View CAF');
            if (in_array(24,auth()->user()->get_allowed_menus()['submit_btn'])){
              $return_array[]=Column::make('take_interview')->title('Assessment Form')->searchable(false)->orderable(false);
            }

            $return_array[]=Column::make('eligibility')->title('Eligible Status');
            $return_array[]=Column::make('cat_name')->title('Registration Type');
            $return_array[]=Column::make('unique_id')->title('Regd. No.');
            $return_array[]=Column::make('full_name')->printable(false)->searchable(true)->title('Candidate Name');
            $return_array[]=Column::make('email')->title('Email');
            $return_array[]=Column::make('phone_number')->title('Mobile No');
            $return_array[]=Column::make('aadhar_card')->title('Aadhar No');
            $return_array[]=Column::make('state_name')->title('State')->searchable(false);
            $return_array[]=Column::make('district_name')->title('District')->searchable(false);
            $return_array[]=Column::make('trade_name')->title('ITI Trade');
            $return_array[]=Column::make('company_name')->title('Company');
       
        return $return_array;
    }

    protected function filename(): string
    {
        return 'InterviewerCandidateDataTables_' . date('YmdHis');
    }
}
