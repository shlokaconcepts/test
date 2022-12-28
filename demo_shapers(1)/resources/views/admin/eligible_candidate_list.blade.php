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
                            <li class="breadcrumb-item active" aria-current="page">Level One Screening
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Eligible Candidates
                            </li>
                        </ol>
                    </nav>
                </div>
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
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 mt-1 col-12">
                            <div class="form-group">
                                <label for="iti_trade" class="form-label mb-0">Trade :</label>
                                <select class="select2" name="iti_trade" id="filter_iti_trade">
                                    <option value="">Select Trade</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-12 mt-1">
                            <div class="form-group">
                                <label for="permanent_state" class="form-label mb-0">Permanent State:</label>
                                <select class="select2" name="permanent_state" id="permanent_state">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3  col-12 mt-1">
                            <div class="form-group">
                                <label for="permanent_district" class="form-label mb-0">Permanent District:</label>
                                <select class="select2" name="permanent_district" id="permanent_district">
                                    <option value="">Select District</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-3 col-12 mt-2">
                            <div class="form-group">
                                <label for="present_state" class="form-label mb-0">Present State:</label>
                                <select class="select2" name="present_state" id="present_state">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3  col-12 mt-2">
                            <div class="form-group">
                                <label for="present_district" class="form-label mb-0">Present District:</label>
                                <select class="select2" name="present_district" id="present_district">
                                    <option value="">Select District</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-12 mt-2">
                            <div class="form-group">
                                <label for="unique_id">Registration No:</label>
                                <input type="text" name="unique_id" id="unique_id" placeholder="Registration id.."
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-md-2 col-12 mt-3">
                            <button type="button" class="btn btn-success clear_btn btn-sm mt-3" id="Filter_btn"> <i
                                    class="fadeIn animated bx bx-filter-alt"></i> </button>
                            <button type="button" class="btn btn-danger clear_btn btn-sm mt-3" id="clear_filter"><i
                                    class="fadeIn animated bx bx-x"></i></button>
                        </div>
                    </form>
                    <hr>

                    <div class="table-responsive">
                        {!! $dataTable->table([
                            'class' => 'table dataTable no-footer w-100 no-wrap table-bordered table-striped',
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addRemarkModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row" id="assign_exam_form">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="company" class="form-label mb-0">Company:</label>
                                <select name="company" id="company" class="select2" @disabled(auth()->user()->type == '0')>
                                    <option value="">Select Comapny</option>
                                    @foreach (companies() as $company)
                                        <option value="{{ $company->id }}" @selected(auth()->user()->company == $company->id)>
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-4">
                                <div class=" d-flex ">
                                    <span><b>Total Selected Candidates</b> :</span>
                                    <span class=" mx-3 text-success total_candidate text-danger"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-1">
                            <div class="form-group">
                                <label for="form_category" class="form-label mb-0">Exam :</label>
                                <select class="select2" name="exam" id="exam">
                                    <option value="">Select Exam</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mt-1">
                            <div class="form-group">
                                <label for="form_category" class="form-label mb-0">Exam Batch:</label>
                                <select class="select2" name="exam_batch" id="exam_batch">
                                    <option value="">Select Exam Batch</option>
                                </select>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    <button type="button" class="btn btn-success" id="confirm_button">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('script')
    {!! $dataTable->scripts() !!}
    <script>
        $(function() {
            $('#company_id').on('change', function() {
                var id = this.value;
                $("#filter_iti_trade").html('<option value="">Select Trade</option>');
                if (id != '') {
                    $("#filter_iti_trade").html('<option value="">Fetching Trade...</option>');
                    $.ajax({
                        url: "{{ url('admin/get_rg_category') }}/" + id,
                        type: "GET",
                        dataType: 'json',
                        success: function(res) {
                            $('#filter_iti_trade').html(
                                '<option value="">Select Trade</option>');
                            $.each(res.trade, function(key, value) {
                                $("#filter_iti_trade").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            }).change();

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
                            console.log(res);
                            $('#exam').html(
                                '<option value="">Select Exam</option>');
                            $.each(res.exam, function(key, value) {
                                $("#exam").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            }).change();



            $('#present_state').on('change', function() {
                var idState = this.value;
                if (idState) {
                    $("#present_district").html('<option value="">Fetching Districts</option>');
                    $.ajax({
                        url: "{{ url('fetch-districts') }}/" + idState,
                        type: "get",
                        dataType: 'json',
                        success: function(res) {
                            $('#present_district').html(
                                '<option value="">Select District</option>');
                            $.each(res.data, function(key, value) {
                                $("#present_district").append('<option value="' +
                                    value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });

            $('#permanent_state').on('change', function() {
                var idState = this.value;
                if (idState) {
                    $("#permanent_district").html('<option value="">Fetching Districts</option>');
                    $.ajax({
                        url: "{{ url('fetch-districts') }}/" + idState,
                        type: "get",
                        dataType: 'json',
                        success: function(res) {
                            $('#permanent_district').html(
                                '<option value="">Select District</option>');
                            $.each(res.data, function(key, value) {
                                $("#permanent_district").append('<option value="' +
                                    value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });

            $('#clear_filter').on('click', function() {
                $('.js-datatable-filter-form').trigger("reset");
                $('#filter_iti_trade').val('').change();
                $('#permanent_state').val('').change();
                $('#permanent_district').val('').change();
                $('#present_state').val('').change();
                $('#present_district').val('').change();
                $('#unique_id').val('');
                window.LaravelDataTables["eligiblecandidatedatatable-table"].draw();
            });
            $("#Filter_btn").click(() => {
                window.LaravelDataTables["eligiblecandidatedatatable-table"].draw();
            });
            $('#eligiblecandidatedatatable-table').on('draw.dt', function() {
                $('.dt_searching_wrapper').html('');
                $('.dt_searching_wrapper').html(`${$('.dataTables_info').html()}`);
                @if (in_array(13,
                    auth()->user()->get_allowed_menus()['view']))
                    var btn =
                        `&nbsp&nbsp<button class="btn btn-primary btn-sm send_link" onclick="save_detail();">Assign Exam</button>`

                    $('.dt_searching_wrapper').html(` ${$('.dataTables_info').html()} ${btn}`);
                @endif
            });

            $('#eligiblecandidatedatatable-table').on('preXhr.dt', function(e, settings, data) {
                $('.js-datatable-filter-form :input').each(function() {
                    data[$(this).prop('name')] = $(this).val();
                });
            });


            @if (in_array(13,
                auth()->user()->get_allowed_menus()['download']))
                $('.dataTables_length').prepend(
                    '<button  class=" btn btn-outline-success mr-2 btn-sm"  onclick="exportToExcel();">Export To Excel  <i class="bx bx-file-blank"></i></button>'
                );
            @endif

            $('#exam').on('change', function() {
                var id = this.value;
                if (id) {
                    $("#exam_batch").empty();
                    $("#exam_batch").html('<option value="">Fetching Batches</option>');
                    $.ajax({
                        url: "{{ url('admin/fetch-exam-batch') }}/" + id,
                        type: "get",
                        dataType: 'json',
                        success: function(res) {
                            if (res.data) {
                                $("#exam_batch").html('');
                                var option = `<option value="">Select Batch</option>`;
                                $.each(res.data, function(key, value) {
                                    option +=
                                        `<option value="${value.id}">${value.name}</option>`;
                                });
                                $("#exam_batch").append(option);
                            }

                        }
                    });
                }

            });


            $('#confirm_button').click(function() {
                var send_data = [];
                $('input[name="checked_ids[]"]:checked').each(function() {
                    send_data.push({
                        id: $(this).val(),
                    });
                });


                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.candidate-assign-exam') }}",
                    data: {
                        data: send_data,
                        exam: $('#exam').val(),
                        exam_batch: $('#exam_batch').val(),
                        company: $('#company').val(),
                    },

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
                        $('#confirm_button').html('Submit');
                    },

                    success: function(response) {
                        if (response.status == true) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Success',
                                text: response.msg,
                                showConfirmButton: true,
                            }).then(() => {
                                $('#exam').val('').trigger("change");
                                $('#exam_batch').val('').trigger("change");
                                $('#addRemarkModal').modal('hide');
                                $('input[type="checkbox"]:checked').prop('checked',false);
                                window.LaravelDataTables["eligiblecandidatedatatable-table"].draw();
                            });


                        } else if (response.status == false) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Error',
                                text: response.msg,
                                showConfirmButton: true,
                            })
                        }
                    },
                    error: function() {

                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            totle: 'Error',
                            text: "Something went wrong..",
                            showConfirmButton: true,
                        })
                    }


                });
            });
        });


        function exportToExcel() {
            $('.loader-wrapper').removeClass('d-none');
            let ful_url = "{{ url('admin/export_to_excel_eligible_candidate') }}";
            var fileName = "eligible_candidate_list.xlsx";
            var formData = new FormData(document.getElementsByClassName('js-datatable-filter-form')[0]);
            formData.append('company_id', $('#company_id').val());
            $.ajax({
                type: "POST",
                url: ful_url,
                cache: false,
                data:formData,
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


        function checkAll(selector) {
            if ($(selector).is(':checked')) {

                $(".single_rows_check").each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $(".single_rows_check").each(function() {
                    $(this).prop('checked', false);
                });
            }
        }

        function save_detail(selector) {
            $('.total_candidate').html($('input[name="checked_ids[]"]:checked').length);
            if ($('input[name="checked_ids[]"]:checked').length > 0) {
                $('#addRemarkModal').modal('show');
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: "Select atleast One candidate",
                    showConfirmButton: true,
                })
            }
        }
    </script>
@endsection
