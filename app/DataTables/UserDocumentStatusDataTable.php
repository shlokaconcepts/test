<?php

namespace App\DataTables;

use App\Models\ExamStartLink;
use App\Models\UserDocumentStatus;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDocumentStatusDataTable extends DataTable
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

            ->addColumn('check_column',function ($row) {
                return '<input type="checkbox" class="single_rows_check form-check-input  check_column_'.$row->user_id.'" name="checked_ids[]" id="check_columnId_'.$row->user_id.'" value="'.$row->user_id.'">';
            })
    
            ->addColumn('check_for_absent_column',function ($row) {
                return '<input type="checkbox" class="single_rows_check   form-check-input  check_column_'.$row->user_id.'" name="checked_ids[]" id="check_columnId_'.$row->user_id.'" value="'.$row->user_id.'">';
            })

            ->addColumn('exam_link_status', function ($row) {
                if ($row->exam_link_status == '0') {
                    return 'Not Send';
                } elseif ($row->exam_link_status == '1') {
                    return 'Send';
                }
            })

            ->addColumn('exam_qr', function ($row) {
                $exam_link = ExamStartLink::where('user_id', $row->user_id)->orderBy('id', 'DESC')->first();
                if ($exam_link) {
                    return '<a href="javascript:void(0)" data-name="' . $row->full_name. '" data-value="' . $exam_link->full_url . '" onClick="generateQr(this)" >Generate now</a>';
                } else {
                    return '--';
                }
            })

           

            ->addColumn('action', function ($row) {
                return '<a href="'.route('admin.document-verification',Crypt::encrypt($row->user_id)).'" class="" >Click Here</a>';
            })


            ->addColumn('tenth_image', function ($row) {
                return '<a href="javascript:void(0);" src="' . getImage($row->tenth_image) . '" onclick="image_preview(this)" class="" >View</a>';
            })

            ->addColumn('twelve_image', function ($row) {
                return '<a href="javascript:void(0);" src="' . getImage($row->twelve_image) . '" onclick="image_preview(this)" class="" >View</a>';
            })

            ->addColumn('iti_image', function ($row) {
                return '<a href="javascript:void(0);" src="' . getImage($row->iti_image) . '" onclick="image_preview(this)" class="" >View</a>';
            })

            ->addColumn('pan_image', function ($row) {
                return '<a href="javascript:void(0);" src="' . getImage($row->pan_image) . '" onclick="image_preview(this)" class="" >View</a>';
            })

            ->addColumn('aadhar_back_image', function ($row) {
                return '<a href="javascript:void(0);" src="' . getImage($row->aadhar_back_image) . '" onclick="image_preview(this)" class="" >View</a>';
            })

            ->addColumn('aadhar_front_image', function ($row) {
                return '<a href="javascript:void(0);" src="' . getImage($row->aadhar_front_image) . '" onclick="image_preview(this)" class="" >View</a>';
            })

            ->addColumn('passport_photo_image', function ($row) {
                return '<a href="javascript:void(0);" src="' . getImage($row->passport_photo_image) . '" onclick="image_preview(this)" class="" >View</a>';
            })

            ->rawColumns(['action', 'check_column', 'exam_qr', 'check_for_absent_column', 'tenth_image', 'twelve_image', 'pan_image', 'iti_image', 'aadhar_back_image', 'aadhar_front_image', 'passport_photo_image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\UserDocumentStatusDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserDocumentStatus $model): QueryBuilder
    {

        $users = UserDocumentStatus::leftJoin('users', 'user_document_statuses.user_id', '=', 'users.id')
            ->leftJoin('trades', 'trades.id', '=', 'users.iti_trade')
            ->leftJoin('registration_categories', 'registration_categories.id', '=', 'users.form_category')
            ->select(
                'user_document_statuses.*',
                'users.unique_id',
                'users.full_name',
                'users.phone_number',
                'users.email',
                'users.aadhar_card',
                'trades.name as iti_trade',
                'users.exam_link_status',
                'users.tenth_certificate as tenth_image',
                'users.twelve_certificate as twelve_image',
                'users.iti_certificate as iti_image',
                'users.pancard as pan_image',
                'users.aadhar_card_front as aadhar_front_image',
                'users.aadhar_card_back as aadhar_back_image',
                'users.passport_photo as passport_photo_image',
                'registration_categories.name as reg_cat'
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
            ->setTableId('userdocumentstatusdatatable-table')
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
        if (datatables()->getRequest()->status == 'final-status') {
            $return_array[] = Column::make('check_column')->title('<input type="checkbox" class="form-check-input" onChange="checkAll(this)">')->searchable(false)->orderable(false)->printable(false)->exportable(false)->addClass('table_bg_color ');
        }

        if (datatables()->getRequest()->status == 'un-approve') {
            $return_array[] = Column::make('check_for_absent_column')->title('<input type="checkbox" class="form-check-input" onChange="checkAll(this)">')->searchable(false)->orderable(false)->printable(false)->exportable(false)->addClass('table_bg_color');
        }
        $return_array[] = Column::make('DT_RowIndex')->title('Sno')->searchable(false)->orderable(false);
        if (datatables()->getRequest()->status == 'un-approve') {
            $return_array[] = Column::make('action')->printable(false)->searchable(false)->title('Approve/Reject');
        }
        if (datatables()->getRequest()->status == 'final-status'  || datatables()->getRequest()->status == 'view-candidate') {
            $return_array[] = Column::make('exam_link_status')->searchable(false)->orderable(false)->title('Email Status');
            $return_array[] = Column::make('exam_qr')->searchable(false)->orderable(false)->title('Exam Qr');
            $return_array[] = Column::make('status')->title('Final Status');
        }
        $return_array[] = Column::make('unique_id')->title('Reg. No.');
        $return_array[] = Column::make('full_name')->title('Name ');
        $return_array[] = Column::make('phone_number')->title('Mobile No');
        $return_array[] = Column::make('email')->title('Email');
        $return_array[] = Column::make('aadhar_card')->title('Aadhar');
        $return_array[] = Column::make('reg_cat')->title('Category');

        $return_array[] = Column::make('tenth_certificate')->title('10th Status');
        if (datatables()->getRequest()->status == 'view-candidate') {
            $return_array[] = Column::make('tenth_image')->title('10th Certificate')->searchable(false)->orderable(false)->printable(false)->exportable(false);
        }
        $return_array[] = Column::make('twelve_certificate')->title('12th Status');
        if (datatables()->getRequest()->status == 'view-candidate') {
            $return_array[] = Column::make('twelve_image')->title('12th Certificate')->searchable(false)->orderable(false)->printable(false)->exportable(false);
        }
        $return_array[] = Column::make('iti_certificate')->title('ITI Certificate Status');
        if (datatables()->getRequest()->status == 'view-candidate') {
            $return_array[] = Column::make('iti_image')->title('ITI Certificate')->searchable(false)->orderable(false)->printable(false)->exportable(false);
        }
        $return_array[] = Column::make('pan_card')->title('Pan Card Status');
        if (datatables()->getRequest()->status == 'view-candidate') {
            $return_array[] = Column::make('pan_image')->title('Pan Card')->searchable(false)->orderable(false)->printable(false)->exportable(false);
        }
        $return_array[] = Column::make('aadhar_card_front')->title('Aadhar (Front) Status');
        if (datatables()->getRequest()->status == 'view-candidate') {
            $return_array[] = Column::make('aadhar_front_image')->title('Aadhar (Front)')->searchable(false)->orderable(false)->printable(false)->exportable(false);
        }
        $return_array[] = Column::make('aadhar_card_back')->title('Aadhar (Back) Status');
        if (datatables()->getRequest()->status == 'view-candidate') {
            $return_array[] = Column::make('aadhar_back_image')->title('Aadhar (Back)')->searchable(false)->orderable(false)->printable(false)->exportable(false);
        }
        $return_array[] = Column::make('profile_image')->title('Profile Image Status');
        if (datatables()->getRequest()->status == 'view-candidate') {
            $return_array[] = Column::make('passport_photo_image')->title('Profile Image')->searchable(false)->orderable(false)->printable(false)->exportable(false);
        }
        $return_array[] = Column::make('verified_by')->title('Verified By');
        $return_array[] = Column::make('verify_date')->title('Verification Date');
       
        return $return_array;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'UserDocumentStatus_' . date('YmdHis');
    }
}
