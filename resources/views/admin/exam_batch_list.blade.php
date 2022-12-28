@extends('layouts.admin_app')

@section('style')
@endsection
@section('wrapper')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Exam Batch List</li>
                        </ol>
                    </nav>
                </div>
                @if (in_array(6,
                    auth()->user()->get_allowed_menus()['add']))
                    <div class="ms-auto">
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm add_batch">
                            <i class="bx bx-plus" aria-hidden="true"></i>Add Batch
                        </a>
                    </div>
                @endif
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">

                    @if (auth()->user()->type == 1)
                        <form method="get" class="js-datatable-filter-form row mb-3">

                            <div class="col-md-3 col-12">
                                <label for="company_id" class="form-label">Company:</label>
                                <select name="company_id" id="company_id" class="select2">
                                    <option value="">Select Comapny</option>
                                    @foreach (companies() as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 col-12">
                                <label for="exam_id" class="form-label">Exam:</label>
                                <select name="exam_id" id="exam_id"  class="select2">
                                    <option value="">Select Exam</option>
                                </select>
                            </div>

                            <div class="col-md-3 mt-4">
                                <button type="button" class="btn btn-success clear_btn btn-sm" id="Filter_btn"> <i
                                        class="fadeIn animated bx bx-filter-alt"></i> </button>
                                <button type="button" class="btn btn-danger clear_btn btn-sm" id="clear_filter"><i
                                        class="fadeIn animated bx bx-x"></i></button>
                            </div>
                        </form>
                        <hr>
                    @endif

                    <div class="table-responsive">
                        {!! $dataTable->table([
                            'class' => 'table dataTable no-footer w-100 no-wrap table-bordered table-striped',
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addExamBatchModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m_title"></h6>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                        <i class=" bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row " id="addExamBatchForm" enctype="multipart/form-data">
                        <input type="hidden" name="op_type" id="op_type" value="add">
                        <input type="hidden" name="id" id="id" value="" />

                        <div class="col-md-6">
                            <label for="company" class="form-label mb-0"><strong>Company<span
                                        class="text-danger">*</span></strong></label>
                            <select class="single-select select2" name="company" id="company">
                                <option value="">Select Company</option>
                                @foreach (companies() as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 col-12">
                            <label for="exam" class="form-label mb-0"><strong>Exam<span
                                        class="text-danger">*</span></strong></label>
                            <select class="single-select select2" name="exam" id="exam">
                                <option value="">Select Exam</option>
                            </select>
                        </div>

                        <div class="col-md-6 col-12 mt-2">
                            <label for="title" class="form-label mb-0"><strong>Title<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" name="title" id="title" class=" form-control" required>
                        </div>

                        <div class="col-md-6 col-12 mt-2">
                            <label for="start_time" class="form-label mb-0"><strong>Start Time<span
                                        class="text-danger">*</span></strong> , <span >Old Time: <span class="end_time"></span> </span></label>
                            <input type="time" id="start_time" class="form-control" name="start_time" />
                        </div>

                        <div class="col-md-6 col-12 mt-2">
                            <label for="end_time" class="form-label mb-0 d-flex"><strong>End Time<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="end_time" class="form-control" readonly name="end_time" />
                        </div>

                        <div class="col-md-6 col-12 mt-2">
                            <label for="password" class="form-label mb-0"><strong>Center Password<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="password" class="form-control"
                                name="password" />
                        </div>



                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    {!! $dataTable->scripts() !!}


    <script>
        $(function() {
            $('.add_batch').click(function() {
                resetForm();
                $('#op_type').val('add');
                $('.m_title').html('Add New Batch');
                $('#addExamBatchModal').modal('show');
            });

            $('#addExamBatchForm').on('submit', function(e) {
                e.preventDefault();
                var postData = new FormData(this);
                var url = '';
                var op_type = $('#op_type').val();
                if (op_type == 'add') {
                    url = "{{ route('admin.add-exam-batch') }}";
                } else if (op_type == 'edit') {
                    url = "{{ route('admin.edit-exam-batch') }}";
                }
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: postData,
                    async: true,
                    contentType: false,
                    processData: false,
                    datatype: 'json',
                    beforeSend: function() {
                        $('button[type="submit"]').prop("disabled", true);
                        $('button[type="submit"]').html(
                            `<span class="fadeIn animated bx bx-loader-circle bx-spin"></span>`
                        );
                    },

                    complete: function() {
                        $('button[type="submit"]').prop("disabled", false);
                        $('button[type="submit"]').html(`Save`);
                    },
                    success: function(response) {
                        if (response.status == true) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                text: response.msg,
                                title: 'Success',
                                showConfirmButton: true,
                            }).then(() => {
                                $('#exambatchdatatable-table').DataTable().ajax
                                    .reload();
                                document.getElementById('addExamBatchForm').reset();
                                $('#addExamBatchModal').modal('hide');
                            });


                        } else if (response.status == false) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Error',
                                text: response.msg,
                                showConfirmButton: true,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Error',
                            text: "Something went wrong..",
                            showConfirmButton: true,
                        })
                    }

                });
            });


            $('#company').on('change', function() {
                var id = this.value;
                $("#exam").html('<option value="">Select Exam</option>');
                if (id != '') {
                    $("#exam").html('<option value="">Fetching Exam...</option>');
                    $.ajax({
                        url: "{{ url('admin/get_rg_category') }}/" + id,
                        type: "GET",
                        dataType: 'json',
                        success: function(res) {
                            $("#exam").html('<option value="">Select Exam</option>');
                            $.each(res.exam, function(key, value) {
                                $("#exam").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });

            $('#clear_filter').on('click', function() {
                $('.js-datatable-filter-form').trigger("reset");
                $('.select2').val('').change();
                window.LaravelDataTables["exambatchdatatable-table"].draw();
            });
            $("#Filter_btn").click(() => {
                window.LaravelDataTables["exambatchdatatable-table"].draw();
            });
            $('#exambatchdatatable-table').on('preXhr.dt', function(e, settings, data) {
                $('.js-datatable-filter-form :input').each(function() {
                    data[$(this).prop('name')] = $(this).val();
                });
            });


            $('#start_time').change(function(e) {
                if ($('#exam').val() != '') {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('admin.get-exam-duration') }}",
                        data: {
                            exam_id: $('#exam').val(),
                            start_time: $('#start_time').val(),
                        },
                        datatype: 'json',
                        success: function(response) {
                            if (response.status == true) {
                                console.log(response.duration);
                                $('#end_time').val(response.duration);
                            }
                        },
                        error: function() {
                            notify_to_user('error', 'Something went wrong..');
                        }

                    });
                }
            });

            $('#company_id').on('change', function() {
                var id = this.value;
                $("#exam_id").html('<option value="">Select Exam</option>');
                if (id != '') {
                    $("#exam_id").html('<option value="">Fetching Exam...</option>');
                    $.ajax({
                        url: "{{ url('admin/get_rg_category') }}/" + id,
                        type: "GET",
                        dataType: 'json',
                        success: function(res) {
                            $("#exam_id").html('<option value="">Select Exam</option>');
                            $.each(res.exam, function(key, value) {
                                $("#exam_id").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });
        });



        function editExamBatchModal(event) {
            resetForm();
            var oTable = $('#exambatchdatatable-table').dataTable();
            var row;
            if (event.target.tagName == "BUTTON")
                row = event.target.parentNode.parentNode;
            else if (event.target.tagName == "I")
                row = event.target.parentNode.parentNode.parentNode;
            else if (event.target.tagName == "SPAN")
                row = event.target.parentNode.parentNode.parentNode;
            $('#op_type').val('edit');
            $('#id').val(oTable.fnGetData(row)['id']);
            $('button[type="submit"]').html(`Update`);

            companyFun(oTable.fnGetData(row)['company']);
            setTimeout(() => {
                examFun(oTable.fnGetData(row)['exam']);
            }, 2000);

            $('.end_time').html('');
            $('.end_time').html(oTable.fnGetData(row)['start_time']);
            $('#password').val(oTable.fnGetData(row)['password']);
            $('#title').val(oTable.fnGetData(row)['name']);
            $('#end_time').val(oTable.fnGetData(row)['end_time']);
            $('#start_time').val(oTable.fnGetData(row)['start_time']);

            $('.m_title').html('Edit Link');
            $('#addExamBatchModal').modal('show');
        }

        function deleteExamBatch(id) {
            Swal.fire({
                    title: "Are you sure?",
                    text: "You want to delete record!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((willDelete) => {
                    if (willDelete.isConfirmed) {
                        $.ajax({
                            type: 'post',
                            url: "{{ route('admin.delete-exam-batch') }}",
                            data: {
                                id: id,
                                _method: 'DELETE',
                            },
                            datatype: 'json',
                            success: function(response) {
                                if (response.status == true) {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        text: response.msg,
                                        title: 'Success',
                                        showConfirmButton: true,
                                    }).then(() => {
                                        $('#exambatchdatatable-table').DataTable().ajax
                                            .reload();
                                    });
                                } else if (response.status == false) {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: 'Error',
                                        text: response.msg,
                                        showConfirmButton: true,
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Error',
                                    text: "Something went wrong..",
                                    showConfirmButton: true,
                                })
                            }
                        });
                    }
                });
        }

        function resetForm() {
            document.getElementById('addExamBatchForm').reset();
            $('#op_type').val('add');
            $('button[type="submit"]').html(`Submit`);
            $('.select2').val('').change();
        }
        function companyFun(value) {
            $('#company').val(value).change();
        }

        function examFun(value) {
            $('#exam').val(value).change();
        }
    </script>
@endsection
