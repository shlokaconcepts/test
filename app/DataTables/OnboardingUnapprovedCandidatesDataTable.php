<?php

namespace App\DataTables;

use App\Models\CandidateInterview;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OnboardingUnapprovedCandidatesDataTable extends DataTable
{
    
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<a href="' . route('admin.candidate-onboard-now', Crypt::encrypt($row->id)) . '" >Click Here</a>';
            })

            ->rawColumns(['action']);
    }

   
    public function query(CandidateInterview $model): QueryBuilder
    {
        $query = CandidateInterview::join('users', 'users.id', 'candidate_interviews.user_id')
        ->leftJoin('states', 'states.id', 'users.permanent_state')
        ->leftJoin('districts', 'districts.id', 'users.permanent_district')
        ->leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
        ->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
            ->select(
                'users.id',
                'users.unique_id',
                'users.full_name',
                'users.phone_number',
                'users.email',
                'trades.name as iti_trade',
                'registration_categories.name as cat_name',
                'states.name as state_name',
                'districts.name as district_name',
                'candidate_interviews.interview_date',
                'candidate_interviews.created_at'
            )->latest();
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
            ->setTableId('onboardingunapprovedcandidatesdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->ScrollX(true)
                    ->ScrollY(250)
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
        $return_array[] = Column::make('DT_RowIndex')->title('Sno')->searchable(false)->orderable(false);
        if (in_array(27, auth()->user()->get_allowed_menus()['submit_btn'])) {
            $return_array[] = Column::make('action')->printable(false)->searchable(false)->title('Click to Onboard');
        }
        $return_array[] = Column::make('unique_id')->title('Reg. No.');
        $return_array[] = Column::make('full_name')->title('Name');
        $return_array[] = Column::make('phone_number')->title('Mobile No');
        $return_array[] = Column::make('email')->title('Email');
        $return_array[] = Column::make('iti_trade')->title('Trade');
        $return_array[] = Column::make('cat_name')->title('Registration Type');
        $return_array[] = Column::make('state_name')->title('State');
        $return_array[] = Column::make('district_name')->title('District');
        $return_array[] = Column::make('interview_date')->title('Interview Date');
        return $return_array;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'OnboardingUnapprovedCandidates_' . date('YmdHis');
    }
}
