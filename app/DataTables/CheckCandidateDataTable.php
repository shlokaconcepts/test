<?php

namespace App\DataTables;

use App\Models\ExamStartLink;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CheckCandidateDataTable extends DataTable
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

            ->addColumn('exam_date', function ($row) {
                return date('d F, Y', strtotime($row->exam_date));
            })


            ->addColumn('device', function ($row) {
                if ($row->user_logged_in_device) {
                    $device = json_decode($row->user_logged_in_device);
                    return $device->device;
                } else {
                    return '';
                }
            })

            ->addColumn('browser', function ($row) {
                if ($row->user_logged_in_device) {
                    $browser = json_decode($row->user_logged_in_device);
                    return $browser->browser;
                } else {
                    return '';
                }
            })

            ->addColumn('platform', function ($row) {
                if ($row->user_logged_in_device) {
                    $platform = json_decode($row->user_logged_in_device);
                    return $platform->platform;
                } else {
                    return '';
                }
            })

            ->addColumn('is_desktop_Mobile', function ($row) {
                if ($row->user_logged_in_device) {
                    $is_desktop_Mobile = json_decode($row->user_logged_in_device);
                    return $is_desktop_Mobile->is_desktop_Mobile;
                } else {
                    return '';
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CheckCandidateDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ExamStartLink $model): QueryBuilder
    {
        $query = ExamStartLink::Join('users', 'users.id', '=', 'exam_start_links.user_id')
            ->leftJoin('states', 'states.id', 'users.permanent_state')
            ->leftJoin('districts', 'districts.id', 'users.permanent_district')
            ->leftJoin('exams', 'exams.id', 'exam_start_links.exam_id')
            ->leftJoin('exam_batches', 'exam_batches.id', 'users.exam_batch')
            ->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
            ->leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
            ->leftJoin('user_assessments','user_assessments.user_id','exam_start_links.user_id')
            ->select(
                'exam_start_links.user_logged_ip',
                'exam_start_links.user_logged_in_device',
                'users.unique_id',
                'users.full_name',
                'users.phone_number',
                'users.email',
                'users.aadhar_card',
                'users.father_name',
                'states.name as state_name',
                'districts.name as dis_name',
                'exam_batches.name as batch_name',
                'exams.name as exam_name',
                'trades.name as iti_trade',
                'exam_start_links.exam_date',
                'registration_categories.name as cat_name',
                'user_assessments.result',
            )->orderBy('users.id', 'DESC');
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
            ->setTableId('checkcandidatedatatable-table')
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
        $return_array[] = Column::make('unique_id')->title('Reg. No.');
        $return_array[] = Column::make('full_name')->title('Name');    
        $return_array[] = Column::make('phone_number')->title('Mobile No');
        $return_array[] = Column::make('aadhar_card')->title('Aadhar');
        $return_array[] = Column::make('father_name')->title('Father Name');
        $return_array[] = Column::make('state_name')->title('State');
        $return_array[] = Column::make('dis_name')->title('District');
        $return_array[] = Column::make('cat_name')->title('Category');
        $return_array[] = Column::make('iti_trade')->title('Trade');
        $return_array[] = Column::make('exam_name')->title('Exam');
        $return_array[] = Column::make('batch_name')->title('Exam Batch');
        $return_array[] = Column::make('exam_date')->title('Exam Date');
        $return_array[] = Column::make('result')->title('Result');
       
        $return_array[] = Column::make('user_logged_ip')->title('IP Address');
        $return_array[] = Column::make('browser')->title('Browser')->searchable(false)->orderable(false);
        $return_array[] = Column::make('platform')->title('Platform')->searchable(false)->orderable(false);
        $return_array[] = Column::make('is_desktop_Mobile')->title('Device Type')->searchable(false)->orderable(false);
        
    
        
        return $return_array;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'CheckCandidate_' . date('YmdHis');
    }
}
