@extends('layouts.admin_app')

@section('style')
    <link href="{{ asset('public/assets/plugins/datetimepicker/css/classic.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/datetimepicker/css/classic.time.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/datetimepicker/css/classic.date.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        .num-block {
            float: left;
            width: 100%;
            padding: 8px 0px;
            cursor: pointer;
        }

        /* skin 2 */
        .skin-2 .num-in {
            background: #FFFFFF;
            box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.15);
            float: left;
        }

        .skin-2 .num-in span {
            width: 32%;
            display: block;
            height: 40px;
            float: left;
            position: relative;
        }

        .skin-2 .num-in span:before,
        .skin-2 .num-in span:after {
            content: '';
            position: absolute;
            background-color: whitesmoke;
            height: 2px;
            width: 10px;
            top: 50%;
            left: 50%;
            margin-top: -1px;
            margin-left: -5px;
        }

        .skin-2 .num-in span.plus:after {
            transform: rotate(90deg);
        }

        .skin-2 .num-in input {
            float: left;
            width: 35%;
            height: 40px;
            border: none;
            text-align: center;
        }

        .minus {
            background: #362998;
        }

        .plus {
            background: #362998;
            margin-left: 1px;
        }

        .select_q_p {
            background: #362998;
        }
    </style>
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
                            <li class="breadcrumb-item active" aria-current="page">Exam List</li>
                        </ol>
                    </nav>
                </div>
                @if (in_array(6,
                    auth()->user()->get_allowed_menus()['add']))
                    <div class="ms-auto">
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm add_exam">
                            <i class="bx bx-plus" aria-hidden="true"></i>Add Exam
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
                                    <label for="date" class="form-label">Exam Date:</label>
                                    <input type="date" name="date" id="date" class="form-control">
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


    <div class="modal fade" id="addExamModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m_title"></h6>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                        <i class=" bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row " id="addExamForm" enctype="multipart/form-data">
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
                            <label for="state" class="form-label mb-0"><strong>Exam Category<span
                                        class="text-danger">*</span></strong></label>
                            <select class="single-select select2" name="category" id="category">
                                <option value="">Select Category</option>
                            </select>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="exam_title" class="form-label mb-0"><strong>Exam Title<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="exam_title" class="form-control" name="name" id="name" />
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="exam_date" class="form-label mb-0"><strong>Exam Date<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="exam_date" class="form-control datepicker" name="date"
                                id="date" />
                        </div>

                        <div class="col-md-6 mt-2">
                            <label class="form-label mb-0"><strong>Exam Center<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control" name="center" id="center" />
                        </div>

                        <div class="col-md-3 mt-2">
                            <label for="exam_date" class="form-label mb-0"><strong>Hours<span
                                        class="text-danger">*</span></strong></label>
                            <select class="single-select select2" name="hour" id="hour">
                                <option value="">Select Hour</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor

                            </select>
                        </div>

                        <div class="col-md-3 mt-2">
                            <label for="exam_date" class="form-label mb-0"><strong>Minute<span
                                        class="text-danger">*</span></strong></label>
                            <select class="single-select select2" name="minute" id="minute">
                                <option value="">Select Minute</option>
                                @for ($i = 0; $i <= 59; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor

                            </select>
                        </div>



                        <div class="col-md-12 col-12 mt-3">
                            <label class="form-label mb-0"><strong>Exam Center Address<span
                                        class="text-danger">*</span></strong></label>
                            <textarea class="form-control" name="venue" id="venue"></textarea>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label class="form-label mb-0"><strong>Instruction<span
                                        class="text-danger">*</span></strong></label>
                            <textarea class="form-control" name="instruction" id="instruction"></textarea>
                        </div>



                        <div class="col-md-6 mt-2">
                            <label class="form-label mb-0"><strong>Total Questions<span
                                        class="text-danger">*</span></strong></label>
                            <div class="num-block skin-2">
                                <div class="num-in">
                                    <span class="minus dis"></span>
                                    <input type="text" class="in-num border" value="1" name="total_question"
                                        id="total_question" readonly="">
                                    <span class="plus"></span>
                                </div>
                            </div>
                        </div>

                        <section class="container-fluid border px-2 ps-2">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <p class=" mb-0 select_q_p text-white p-2"> <strong>Select Question Bank</strong></p>
                                </div>

                                @foreach ($exam_sets as $set)
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label mb-0"><strong>{{ $set->name }}</strong></label>
                                        <div class="num-block skin-2">
                                            <div class="num-in">
                                                <span class="minus dis"></span>
                                                <input type="text" class=" second in-num border" value="0"
                                                    min="0" id="inputid_{{ $loop->iteration }}"
                                                    name="set_question[{{ $set->id }}]"
                                                    onchange="calculateSum(this,'{{ $set->id }}','{{ count($exam_sets) }}')"
                                                    readonly="">
                                                <span class="plus"></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>


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
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/legacy.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/picker.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/picker.time.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/picker.date.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    {!! $dataTable->scripts() !!}


    <script>
        $(function() {
            $(".datepicker").pickadate({
                selectMonths: true,
                selectYears: true,
                format: 'dd-mm-yyyy',
            });

            $('.timepicker').pickatime();
            $('#instruction').summernote({
                placeholder: 'Instruction...',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                focus: true
            });

            $('#venue').summernote({
                placeholder: 'Address...',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                focus: true
            });

            $('.note-image-input').remove();
            $('.add_exam').click(function() {
                resetForm();
                $('#op_type').val('add');
                $('.m_title').html('Add New Exam');
                $('#instruction').summernote('code', "");
                $('#venue').summernote('code', "");
                $('#addExamModal').modal('show');
            });

            $('#addExamForm').on('submit', function(e) {
                e.preventDefault();
                var postData = new FormData(this);
                var url = '';
                var op_type = $('#op_type').val();
                if (op_type == 'add') {
                    url = "{{ route('admin.add-exam') }}";
                } else if (op_type == 'edit') {
                    url = "{{ route('admin.edit-exam') }}";
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
                                $('#examdatatable-table').DataTable().ajax
                                    .reload();
                                document.getElementById('addExamForm').reset();
                                $('#addExamModal').modal('hide');
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


            $('.num-in span').click(function() {
                var $input = $(this).parents('.num-block').find('input.in-num');
                if ($(this).hasClass('minus')) {
                    var count = parseFloat($input.val()) - 1;
                    count = count < 1 ? 1 : count;
                    if (count < 2) {
                        $(this).addClass('dis');
                    } else {
                        $(this).removeClass('dis');
                    }
                    $input.val(count);
                } else {
                    var count = parseFloat($input.val()) + 1
                    $input.val(count);
                    if (count > 1) {
                        $(this).parents('.num-block').find(('.minus')).removeClass('dis');
                    }
                }

                $input.change();
                return false;
            });

            $('#company').on('change', function() {
                var id = this.value;
                $("#category").html('<option value="">Select category</option>');
                if (id != '') {
                    $("#category").html('<option value="">Fetching category...</option>');
                    $.ajax({
                        url: "{{ url('admin/get_rg_category') }}/" + id,
                        type: "GET",
                        dataType: 'json',
                        success: function(res) {
                            $('#category').html('<option value="">Select Category</option>');
                            $.each(res.data, function(key, value) {
                                $("#category").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });

            $('#clear_filter').on('click', function() {
                $('.js-datatable-filter-form').trigger("reset");
                $('.select2').val('').change();
                window.LaravelDataTables["examdatatable-table"].draw();
            });
            $("#Filter_btn").click(() => {
                window.LaravelDataTables["examdatatable-table"].draw();
            });
            $('#examdatatable-table').on('preXhr.dt', function(e, settings, data) {
                $('.js-datatable-filter-form :input').each(function() {
                    data[$(this).prop('name')] = $(this).val();
                });
            });
        });

        function calculateSum(selector, id, array_count) {
            var total_limit = $('#total_question').val();
            var current_value = $(selector).val();
            var total_sum = 0;
            for (let i = 1; i <= array_count; i++) {
                total_sum = parseInt($('#inputid_' + i).val()) + total_sum;
            }
            if (total_sum > total_limit) {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    text: "The number of questions cannot be more than " + total_limit,
                    title: "Warning",
                    showConfirmButton: true,
                }).then(() => {
                    $('#inputid_' + id).val($('#inputid_' + id).val() - 1);
                });
            }

        }

        $('#total_question').on('change', function() {
            calculateSum();
        });

        function editLinkModal(event) {
            resetForm();
            var oTable = $('#examdatatable-table').dataTable();
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
            $('#close_date').val(oTable.fnGetData(row)['closed_time']);
            $('#close_time').val(oTable.fnGetData(row)['closed_times']);
            $('#category').val(oTable.fnGetData(row)['form_category']).change();
            $('#company').val(oTable.fnGetData(row)['company']).change();
            $('#description').summernote('code', oTable.fnGetData(row)['description']);
            $('.m_title').html('Edit Link');
            $('#addExamModal').modal('show');
        }

        function deleteExam(id) {
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
                            url: "{{ route('admin.delete-exam') }}",
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
                                        $('#examdatatable-table').DataTable().ajax
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
            document.getElementById('addExamForm').reset();
            $('#op_type').val('add');
            $('button[type="submit"]').html(`Submit`);
            $('.select2').val('').change();
            $('.img-box').addClass('d-none');
        }



        function ChangeStatus(selector, id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.exam-change-status') }}",
                data: {
                    id: id
                },
                datatype: 'json',
                success: function(response) {
                    if (response.status == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: "Success",
                            text: response.msg,
                            showConfirmButton: true,
                        }).then(() => {
                            $('#examdatatable-table').DataTable().ajax.reload();
                        });
                    } else if (response.status == false) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: "Error",
                            text: response.msg,
                            showConfirmButton: true,
                        }).then(() => {
                            $('#examdatatable-table').DataTable().ajax.reload();
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: "Error",
                        text: "Something went wrong..",
                        showConfirmButton: true,
                    });
                }

            });
        }
    </script>
@endsection
