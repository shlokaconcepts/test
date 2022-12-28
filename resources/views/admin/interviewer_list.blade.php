@extends('layouts.admin_app')
@section('style')
    <style>
        .instruction_text p {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 0px;
            margin-bottom: 0px;
            margin-right: 21px;
            color: red;
            font-size: 17px;
            font-weight: 500;
            font-family: monospace;
            font-style: italic;
        }

        fieldset {
            border: 1px solid #008cff;
            margin-bottom: 5px;
            padding: 11px 10px 15px 10px;
            border-radius: 6px;
        }

        legend {
            float: unset;
            width: auto;
            margin-bottom: 0 !important;
        }

        legend p {
            font-size: 11pt;
            border: transparent;
            width: auto !important;
            border: 1px solid #008cff;
            box-shadow: 3px 3px 15px #ccc;
            padding: 5px 10px;
            background: #008cff;
            color: white;
            border-radius: 4px;
            margin: 0 auto;
            display: block;
        }
    </style>
@endsection

@section('wrapper')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->

            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Interviewer</li>
                        </ol>
                    </nav>
                </div>
                @if (in_array(23,
                    auth()->user()->get_allowed_menus()['add']))
                    <div class="ms-auto">
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm add_form">
                            <i class="bx bx-plus" aria-hidden="true"></i>Add Interviewer
                        </a>
                    </div>
                @endif
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                    <form method="get" class="js-datatable-filter-form row mb-3">
                        <div class="col-md-3 col-12 mt-1">
                            <div class="form-group">
                                <label for="company_id" class="form-label mb-0">Company:</label>
                                <select name="company_id" id="company_id" class="select2" @disabled(auth()->user()->type == '0')>
                                    <option value="">Select Comapny</option>
                                    @foreach (companies() as $company)
                                        <option value="{{ $company->id }}" @selected(auth()->user()->company == $company->id)>
                                            {{ $company->name }} {{ $company->prefix }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-2 mt-1 col-12">
                            <div class="form-group">
                                <label for="panel" class="form-label mb-0">Panel :</label>
                                <select class="select2" name="panel_id" id="panel_id">
                                    <option value="">Select Panel</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2 mt-1 col-12">
                            <div class="form-group">
                                <label for="post" class="form-label mb-0">Post :</label>
                                <select class="select2" name="post" id="post">
                                    <option value="">Select Post</option>
                                    <option value="technical">Technical</option>
                                    <option value="hr">HR</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-3 col-12 mt-1">
                            <div class="form-group">
                                <label for="employee_id">Registration No:</label>
                                <input type="text" name="employee_id" id="employee_id" placeholder="Employee id.."
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-md-2 col-12 mt-4">
                            <button type="button" class="btn btn-success clear_btn btn-sm mt-1" id="Filter_btn"> <i
                                    class="fadeIn animated bx bx-filter-alt"></i> </button>
                            <button type="button" class="btn btn-danger clear_btn btn-sm mt-1" id="clear_filter"><i
                                    class="fadeIn animated bx bx-x"></i></button>
                        </div>
                    </form>
                    <hr>

                    <div class="table-responsive ">
                        {!! $dataTable->table([
                            'class' => 'table dataTable no-footer w-100 no-wrap table-bordered border table-striped',
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->

    <!-- Create Modal -->
    <div class="modal fade" id="addInterviewerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-muted int_title">Add New Interviewer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addNew" enctype="multipart/form-data">
                        <input type="hidden" id="hr_id" name="hr_id">
                        <input type="hidden" id="tech_id" name="tech_id">
                        <input type="hidden" id="op_type" value="ADD" name="op_type">
                        <fieldset>
                            <legend>
                                <p>Other Information</p>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="company" class="form-label mb-0"><strong> Company <span
                                                    class="text-danger">*</span></strong></label>
                                        <select name="company" id="company" class="form-select"
                                            @disabled(auth()->user()->type == '0')>
                                            <option value="">Select Comapny</option>
                                            @foreach (companies() as $company)
                                                <option value="{{ $company->id }}" @selected(auth()->user()->company == $company->id)>
                                                    {{ $company->name }} {{ $company->prefix }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="panel" class="form-label mb-0"><strong>Panel<span
                                                    class="text-danger">*</span></strong></label>
                                        <select class="select2" name="panel" id="panel" required>
                                            <option value="">Select Panel</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12 mt-1">
                                    <label for="username" class="form-label mb-0"><strong>Username<span
                                                class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        required />
                                </div>

                                <div class="col-md-6 col-12 mt-1">
                                    <label for="password" class="form-label mb-0"><strong>Password<span
                                                class="text-danger">*</span></strong></label>
                                    <input type="text" class="form-control" name="password" id="password"
                                        required />
                                </div>

                                <div class="col-12 mt-1">
                                    <label for="location" class="form-label mb-0"><strong>Location<span
                                                class="text-danger">*</span></strong></label>
                                    <input type="text" id="location" class="form-control" name="location"
                                        required />
                                </div>
                            </div>
                        </fieldset>

                        <div class="row mt-1">
                            <div class="col-md-6 col-12">
                                <fieldset>
                                    <legend>
                                        <p>Technical</p>
                                    </legend>
                                    <div class="col-md-12 mt-1">
                                        <label for="tech_name" class="form-label mb-0"><strong>Name<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="text" id="tech_name" class="form-control" name="tech_name"
                                            required />
                                    </div>


                                    <div class="col-md-12 col-12 mt-1">
                                        <label for="tech_email" class="form-label mb-0"><strong>Email<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="email" id="tech_email" class="form-control" name="tech_email"
                                            required />
                                    </div>

                                    <div class="col-md-12 mt-2">
                                        <label for="tech_employee_id" class="form-label mb-0"><strong>Employee ID<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="number" id="tech_employee_id" class="form-control"
                                            name="tech_employee_id" required />
                                    </div>

                                    <div class="col-md-12 mt-2">
                                        <label for="tech_designation" class="form-label mb-0"><strong>Designation<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="text" id="tech_designation" class="form-control"
                                            name="tech_designation" required />
                                    </div>

                                    <div class="col-md-12 mt-2">
                                        <label class="form-label mb-0" for="tech_signature"><strong>Uploade Signature<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="file" class="form-control" name="tech_signature"
                                            id="tech_signature">
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-md-6 col-12">
                                <fieldset>
                                    <legend>
                                        <p>HR (Human resources)</p>
                                    </legend>
                                    <div class="col-md-12 mt-1">
                                        <label for="hr_name" class="form-label mb-0"><strong>Name<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="text" id="hr_name" class="form-control" name="hr_name"
                                            required />
                                    </div>


                                    <div class="col-md-12 col-12 mt-1">
                                        <label class="form-label mb-0"><strong>Email<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="email" id="hr_email" class="form-control" name="hr_email"
                                            required />
                                    </div>

                                    <div class="col-md-12 mt-2">
                                        <label for="hr_employee_id" class="form-label mb-0"><strong>Employee ID<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="number" id="hr_employee_id" class="form-control"
                                            name="hr_employee_id" required />
                                    </div>

                                    <div class="col-md-12 mt-2">
                                        <label for="hr_designation" class="form-label mb-0"><strong>Designation<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="text" id="hr_designation" class="form-control"
                                            name="hr_designation" required />
                                    </div>

                                    <div class="col-md-12 mt-2">
                                        <label class="form-label mb-0" for="hr_signature"><strong>Uploade Signature<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="file" class="form-control" name="hr_signature"
                                            id="hr_signature" />
                                    </div>
                                </fieldset>
                            </div>
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
    <!-- end  -->
@endsection

@section('script')
    {!! $dataTable->scripts() !!}


    <script>
        $(() => {

            $('#company_id').on('change', function() {
                var id = this.value;
                $("#panel_id").html('<option value="">Select Panel</option>');
                if (id != '') {
                    $("#panel_id").html('<option value="">Fetching Panel...</option>');
                    $.ajax({
                        url: "{{ url('admin/get_rg_category') }}/" + id,
                        type: "GET",
                        dataType: 'json',
                        success: function(res) {
                            $("#panel_id").html('<option value="">Select Panel</option>');
                            $.each(res.panel, function(key, value) {
                                $("#panel_id").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            }).change();

            $('#company').on('change', function() {
                var id = this.value;
                $("#panel").html('<option value="">Select Panel</option>');
                if (id != '') {
                    $("#panel").html('<option value="">Fetching Panel...</option>');
                    $.ajax({
                        url: "{{ url('admin/get_rg_category') }}/" + id,
                        type: "GET",
                        dataType: 'json',
                        success: function(res) {
                            $("#panel").html('<option value="">Select Panel</option>');
                            $.each(res.panel, function(key, value) {
                                $("#panel").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            }).change();

            $("#Filter_btn").click(() => {
                window.LaravelDataTables["interviewerdatatable-table"].draw();
            });

            $('#clear_filter').on('click', function() {
                $('#panel_id').val('').trigger('change');
                $('#post').val('').trigger('change');
                $('#employee_id').val('');
                window.LaravelDataTables["interviewerdatatable-table"].draw();
            });

            $('#interviewerdatatable-table').on('preXhr.dt', function(e, settings, data) {
                $('.js-datatable-filter-form :input').each(function() {
                    data[$(this).prop('name')] = $(this).val();
                });
            });

            $('#interviewerdatatable-table').on('draw.dt', function() {
                let instruction =
                    `<div class="instruction_text"><p><i class="fadeIn animated bx bx-message-alt-detail"></i> Please use unique username </p></div>`;
                $('.dt_searching_wrapper').html('');
                $('.dt_searching_wrapper').html(`${instruction} ${$('.dataTables_info').html()}`);
            });

            $('.add_form').click(function() {
                document.getElementById('addNew').reset();
                $('#tech_signature').prop('required', true);
                $('#hr_signature').prop('required', true);
                $('#op_type').val('ADD');
                $('.int_title').html('Add new interviewer');
                $('#addInterviewerModal').modal('show');
            });

            $('#addNew').on('submit', function(e) {
                e.preventDefault();
                var postData = new FormData(this);
                postData.append('company', $('#company').val());
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.add-new-interviewer') }}",
                    data: postData,
                    async: true,
                    contentType: false,
                    processData: false,
                    datatype: 'json',
                    beforeSend: function() {
                        $(".loader-wrapper").removeClass("d-none");
                        $("#confirm_button").prop('disabled', true);
                        $("#confirm_button").html(
                            `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>`
                        );
                    },

                    complete: function() {
                        $(".loader-wrapper").addClass("d-none");
                        $("#confirm_button").prop('disabled', false);
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
                                $('#interviewerdatatable-table').DataTable().ajax
                                    .reload();
                                document.getElementById('addNew').reset();
                                $('#addInterviewerModal').modal('hide');
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

            @if (in_array(15,
                auth()->user()->get_allowed_menus()['download']))
                $('.dataTables_length').prepend(
                    '<button  class=" btn btn-outline-success mr-2 btn-sm"  onclick="exportToExcel();">Export To Excel  <i class="bx bx-file-blank"></i></button>'
                );
            @endif

        });



        function ChangeStatus(selector, id) {
            if (id) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.interviewer-change-status') }}",
                    data: {
                        id: id
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
                                $('#interviewerdatatable-table').DataTable().ajax.reload();
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
        }


        function editInterviewerModal(selector, id) {
            if (id) {
                $.ajax({
                    type: 'get',
                    url: "{{ url('admin/get-interviewer-detail') }}/" + id,
                    datatype: 'json',
                    success: function(response) {
                        if (response.status == true) {
                            var data = response.data;
                            console.log(data);
                            $('#company').val(data.company).change();
                            $('#username').val(data.username);

                            var interval = setInterval(() => {
                                $('#panel').val(data.panel).change();
                                clearInterval(interval);
                            }, 1000);

                            $('#password').val(data.password);
                            $('#location').val(data.location);
                            $('#tech_name').val(data.tech_name);
                            $('#tech_email').val(data.tech_email);
                            $('#tech_employee_id').val(data.tech_employee_id);
                            $('#tech_designation').val(data.tech_designation);


                            $('#hr_name').val(data.hr_name);
                            $('#hr_email').val(data.hr_email);
                            $('#hr_employee_id').val(data.hr_employee_id);
                            $('#hr_designation').val(data.hr_designation);

                            $('#hr_id').val(data.hr_id);
                            $('#tech_id').val(data.tech_id);

                            $('#tech_signature').prop('required', false);
                            $('#hr_signature').prop('required', false);
                            $('#op_type').val('EDIT');
                            $('.int_title').html('Edit interviewer');
                            $('#addInterviewerModal').modal('show');

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
                            text: "server not responding!",
                            showConfirmButton: true,
                        });
                    }

                });
            }
        }

        function DeleteRecord(selector, id) {
            if (id) {
                var result = confirm("Are you sure you want to delete?");
                if (result == true) {
                    $.ajax({
                        type: 'post',
                        url: "{{ url('admin/delete-interviewer') }}",
                        data: {
                            id: id
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
                                    $('#interviewerdatatable-table').DataTable().ajax.reload();
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
            }
        }

        function exportToExcel() {
            $('.loader-wrapper').removeClass('d-none');
            let ful_url = "{{ url('admin/export_to_excel_interviewer') }}";
            var fileName = "interviewer_list.xlsx";
            var formData = new FormData(document.getElementsByClassName('js-datatable-filter-form')[0]);
            formData.append('company_id', $('#company_id').val());
            $.ajax({
                type: "POST",
                url: ful_url,
                cache: false,
                data: formData,
                processData: false,
                contentType: false,
                xhr: function() {
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 2) {
                            if (xhr.status == 200) {
                                xhr.responseType = "blob";
                                $('.loader-wrapper').addClass('d-none');
                            } else {
                                xhr.responseType = "text";
                            }
                        }
                    };
                    return xhr;
                },
                success: function(data) {
                    $('.loader-wrapper').addClass('d-none');
                    //Convert the Byte Data to BLOB object.
                    var blob = new Blob([data], {
                        type: "application/octetstream"
                    });

                    //Check the Browser type and download the File.
                    var isIE = false || !!document.documentMode;
                    if (isIE) {
                        window.navigator.msSaveBlob(blob, fileName);
                    } else {
                        var url = window.URL || window.webkitURL;
                        link = url.createObjectURL(blob);
                        var a = $("<a />");
                        a.attr("download", fileName);
                        a.attr("href", link);
                        $("body").append(a);
                        a[0].click();
                        $("body").remove(a);
                    }
                }
            });
        }
    </script>
@endsection
