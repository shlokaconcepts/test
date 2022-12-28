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
                            <li class="breadcrumb-item active" aria-current="page">Question List</li>
                        </ol>
                    </nav>
                </div>
                @if (in_array(6,
                    auth()->user()->get_allowed_menus()['add']))
                    <div class="ms-auto">
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm add_exam">
                            <i class="bx bx-plus" aria-hidden="true"></i>Add Question
                        </a>
                    </div>
                @endif
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">

                    @if (auth()->user()->type == 1)
                        <form method="get" class="js-datatable-filter-form row mb-3">

                            <div class="col-md-2 col-12">
                                <label for="company_id" class="form-label">Company:</label>
                                <select name="company_id" id="company_id" class="select2">
                                    <option value="">Select Comapny</option>
                                    @foreach (companies() as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label for="form_category" class="form-label mb-0"> Category:</label>
                                    <select class="single-select select2" name="category_id" id="category_id">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label for="form_category" class="form-label mb-0">Exam Section:</label>
                                    <select class="single-select select2" name="set_id" id="set_id">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="form_category" class="form-label mb-0">Trade:</label>
                                    <select class="single-select select2" name="trade_id" id="trade_id">
                                        <option value="">Select Trade</option>
                                    </select>
                                </div>
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
                            <label for="english_question" class="form-label mb-0"><strong>English Question<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="english_question" class="form-control" name="english_question"
                                required />
                        </div>

                        <div class="col-md-6">
                            <label for="hindi_question" class="form-label mb-0"><strong>Hindi Question<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="hindi_question" class="form-control" name="hindi_question"
                                required />
                        </div>
                        <div class="col-md-6 mt-1">
                            <label for="english_option_one" class="form-label mb-0"><strong>English Option One<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="english_option_one" class="form-control"
                                name="english_option_one"required />
                        </div>

                        <div class="col-md-6 mt-1">
                            <label for="hindi_option_one" class="form-label mb-0"><strong>Hindi Option One<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="hindi_option_one" class="form-control" name="hindi_option_one"
                                required />
                        </div>

                        <div class="col-md-6 mt-1">
                            <label for="english_option_two" class="form-label mb-0"><strong>English Option Two<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="english_option_two" class="form-control"
                                name="english_option_two"required />
                        </div>

                        <div class="col-md-6 mt-1">
                            <label for="hindi_option_two" class="form-label mb-0"><strong>Hindi Option Two<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="hindi_option_two" class="form-control" name="hindi_option_two"
                                required />
                        </div>

                        <div class="col-md-6 mt-1">
                            <label for="english_option_three" class="form-label mb-0"><strong>English Option Three<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="english_option_three" class="form-control"
                                name="english_option_three" required />
                        </div>

                        <div class="col-md-6 mt-1">
                            <label for="hindi_option_three" class="form-label mb-0"><strong>Hindi Option Three<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="hindi_option_three" class="form-control" name="hindi_option_three"
                                required />
                        </div>


                        <div class="col-md-6 mt-1">
                            <label for="english_option_four" class="form-label mb-0"><strong>English Option Four<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="english_option_four" class="form-control"
                                name="english_option_four" required />
                        </div>

                        <div class="col-md-6 mt-1">
                            <label for="hindi_option_four" class="form-label mb-0"><strong>Hindi Option Four<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="hindi_option_four" class="form-control" name="hindi_option_four"
                                required />
                        </div>


                        <div class="col-md-6 col-12 mt-1">
                            <label for="answer" class="form-label mb-0"><strong>Answer<span
                                        class="text-danger">*</span></strong></label>
                            <select class="single-select select2" name="answer" id="answer" required>
                                <option value="">Select Answer</option>
                                <option value="1">Option One</option>
                                <option value="2">Option Two</option>
                                <option value="3">Option Three</option>
                                <option value="4">Option Four</option>
                            </select>
                        </div>

                        <div class="col-md-6 col-12 mt-1">
                            <label for="company" class="form-label mb-0"><strong>Company<span
                                        class="text-danger">*</span></strong></label>
                            <select class="single-select select2" name="company" id="company">
                                <option value="">Select Company</option>
                                @foreach (companies() as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 col-12 mt-1">
                            <label for="exam_set" class="form-label mb-0"><strong>Set<span
                                        class="text-danger">*</span></strong></label>
                            <select class="single-select select2" name="exam_set" id="exam_set">
                                <option value="">Select Company</option>
                                @foreach ($exam_sets as $set)
                                    <option value="{{$set->id }}">{{$set->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 col-12 mt-1">
                            <label for="category" class="form-label mb-0"><strong>Exam Category<span
                                        class="text-danger">*</span></strong></label>
                            <select class="single-select select2" name="category" id="category">
                                <option value="">Select Category</option>
                            </select>
                        </div>

                        <div class="col-md-6 col-12 mt-1">
                            <label for="trade" class="form-label mb-0"><strong>Trade<span
                                        class="text-danger">*</span></strong></label>
                            <select class="single-select select2" name="trade" id="trade">
                                <option value="">Select Category</option>
                            </select>
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
            $('.add_exam').click(function() {
                resetForm();
                $('#op_type').val('add');
                $('.m_title').html('Add New Question');
                $('#addExamModal').modal('show');
            });

            $('#addExamForm').on('submit', function(e) {
                e.preventDefault();
                var postData = new FormData(this);
                var url = '';
                var op_type = $('#op_type').val();
                if (op_type == 'add') {
                    url = "{{ route('admin.add-exam-question') }}";
                } else if (op_type == 'edit') {
                    url = "{{ route('admin.edit-exam-question') }}";
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
                                $('#examquestiondatatable-table').DataTable().ajax
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

            $('#company').on('change', function() {
                var id = this.value;
                $("#category").html('<option value="">Select category</option>');
                $('#trade').html('<option value="">Select Trade</option>');
               
                if (id != '') {
                    $("#category").html('<option value="">Fetching category...</option>');
                    $('#trade').html('<option value="">Fetching Trade...</option>');
                   
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

                            $('#trade').html('<option value="">Select Trade</option>');
                            $.each(res.trade, function(key, value) {
                                $("#trade").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });

                           
                        }
                    });
                }
            });

            $('#clear_filter').on('click', function() {
                $('.js-datatable-filter-form').trigger("reset");
                $('.select2').val('').change();
                window.LaravelDataTables["examquestiondatatable-table"].draw();
            });

            $("#Filter_btn").click(() => {
                window.LaravelDataTables["examquestiondatatable-table"].draw();
            });

            $('#examquestiondatatable-table').on('preXhr.dt', function(e, settings, data) {
                $('.js-datatable-filter-form :input').each(function() {
                    data[$(this).prop('name')] = $(this).val();
                });
            });


            $('#company_id').on('change', function() {
                var id = this.value;
                $("#category_id").html('<option value="">Select Category</option>');
                $('#trade_id').html('<option value="">Select Trade</option>');
                $('#set_id').html('<option value="">Select Set</option>');

                if (id != '') {
                    $("#category_id").html('<option value="">Fetching category...</option>');
                    $('#trade_id').html('<option value="">Fetching Trade...</option>');
                    $('#set_id').html('<option value="">Fetching Set...</option>');
                    $.ajax({
                        url: "{{ url('admin/get_rg_category') }}/" + id,
                        type: "GET",
                        dataType: 'json',
                        success: function(res) {
                            $('#category_id').html('<option value="">Select Category</option>');
                            $.each(res.data, function(key, value) {
                                $("#category_id").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });

                            $('#trade_id').html('<option value="">Select Trade</option>');
                            $.each(res.trade, function(key, value) {
                                $("#trade_id").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });

                            $('#set_id').html('<option value="">Select Set</option>');
                            $.each(res.exam_set, function(key, value) {
                                $("#set_id").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });
        });




        function editQuestionModal(event) {
            resetForm();
            var oTable = $('#examquestiondatatable-table').dataTable();
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


            $('#english_question').val(oTable.fnGetData(row)['english_question']);
            $('#hindi_question').val(oTable.fnGetData(row)['hindi_question']);
            $('#english_option_one').val(oTable.fnGetData(row)['english_option_one']);
            $('#hindi_option_one').val(oTable.fnGetData(row)['hindi_option_one']);
            $('#english_option_two').val(oTable.fnGetData(row)['english_option_two']);
            $('#hindi_option_two').val(oTable.fnGetData(row)['hindi_option_two']);
            $('#english_option_three').val(oTable.fnGetData(row)['english_option_three']);
            $('#hindi_option_three').val(oTable.fnGetData(row)['hindi_option_three']);
            $('#english_option_four').val(oTable.fnGetData(row)['english_option_four']);
            $('#hindi_option_four').val(oTable.fnGetData(row)['hindi_option_four']);
            $('#answer').val(oTable.fnGetData(row)['answer']).change();
            companyFun(oTable.fnGetData(row)['company']);
            setTimeout(() => {
                tradeFun(oTable.fnGetData(row)['trade']);
                exam_setFun(oTable.fnGetData(row)['exam_set']);
                categoryFun(oTable.fnGetData(row)['category']);
            }, 2000);

            $('.m_title').html('Edit Question');
            $('#addExamModal').modal('show');
        }

        function deleteQuestion(id) {
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
                            url: "{{ route('admin.delete-exam-question') }}",
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
                                        $('#examquestiondatatable-table').DataTable().ajax
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
                url: "{{ route('admin.exam-question-change-status') }}",
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
                            $('#examquestiondatatable-table').DataTable().ajax.reload();
                        });
                    } else if (response.status == false) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: "Error",
                            text: response.msg,
                            showConfirmButton: true,
                        }).then(() => {
                            $('#examquestiondatatable-table').DataTable().ajax.reload();
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

        function companyFun(value) {
            $('#company').val(value).change();
        }

        function tradeFun(value) {
            $('#trade').val(value).change();
        }

        // function exam_setFun(value) {
        //     $('#exam_set').val(value).change();
        // }

        function categoryFun(value) {
            $('#category').val(value).change();
        }
    </script>
@endsection
