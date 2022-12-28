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
                            <li class="breadcrumb-item active" aria-current="page">Documentation
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <span class=" text-capitalize">
                                    @if ($status == 'un-approve')
                                        Documents Verification
                                    @elseif($status == 'final-status')
                                        Send Exam Link
                                    @else
                                        View Candidate
                                    @endif
    
                                </span>
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

                        <div class="col-md-3 mt-1 col-12">
                            <div class="form-group">
                                <label for="exam" class="form-label mb-0">Exam :</label>
                                <select class="select2" name="exam" id="exam">
                                    <option value="">Select Exam</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 mt-1 col-12">
                            <div class="form-group">
                                <label for="exam_batch" class="form-label mb-0">Exam Batch:</label>
                                <select class="select2" name="exam_batch" id="exam_batch">
                                    <option value="">Select Batch</option>
                                </select>
                            </div>
                        </div>

                        @if ($status == 'view-candidate')
                            <div class="col-md-3 mt-1">
                                <div class="form-group ">
                                    <label class="form-label mb-0">Status :</label>
                                    <select class="select2" name="candidate_status" id="status">
                                        <option value="">Select Status</option>
                                        <option value="Hold">Hold</option>
                                        <option value="Doc Ok">Doc Ok</option>
                                        <option value="Doc Mismatch">Doc Mismatch</option>
                                        <option value="Fake Document">Fake Document</option>
                                        <option value="Document Not Available">Document Not Available</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                </div>
                            </div>
                        @endif

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
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div>
                                    Selected Candidate
                                </div>
                            </div>
                            <span class="badge  rounded-pill text-dark total_candidate" style="font-size: 22px;">5000</span>
                        </li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    <button type="button" class="btn btn-success submit_btn" id="confirm_button">Send Exam
                        Link</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addAbsentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-7 mb-3">
                        <div class="form-group">
                            <h6 class=" d-flex ">
                                <span>Total Selected Candidates :</span>
                                <span class=" mx-3 text-success absent_total_candidate"></span>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    <button type="button" class="btn btn-success submit_btn_abset">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="generateQr" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">Exam Qr: <span class=" qr_code_modal_header text-success"></span>
                        Candidate </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class=" qr_code_wrapper">

                    </div>
                    <div class=" mt-3">
                        <p class="qr_code_link text-primary">

                        <p>
                    </div>
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
                $("#exam").html('<option value="">Select Exam</option>');
                if (id != '') {
                    $("#filter_iti_trade").html('<option value="">Fetching Trade...</option>');
                    $("#exam").html('<option value="">Fetching Exam...</option>');
                    $.ajax({
                        url: "{{ url('admin/get_rg_category') }}/" + id,
                        type: "GET",
                        dataType: 'json',
                        success: function(res) {
                            $('#filter_iti_trade').html(
                                '<option value="">Select Trade</option>');
                            $('#exam').html('<option value="">Select Exam</option>');
                            $.each(res.trade, function(key, value) {
                                $("#filter_iti_trade").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                            $.each(res.exam, function(key, value) {
                                $("#exam").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            }).change();





            $('#clear_filter').on('click', function() {
                $('.js-datatable-filter-form').trigger("reset");
                $('#filter_iti_trade').val('').change();
                $('#exam').val('').change();
                $('#exam_batch').val('').change();
                $('#status').val('').change();
                $('#unique_id').val('');
                window.LaravelDataTables["userdocumentstatusdatatable-table"].draw();
            });

            $("#Filter_btn").click(() => {
                window.LaravelDataTables["userdocumentstatusdatatable-table"].draw();
            });

            $('#userdocumentstatusdatatable-table').on('draw.dt', function() {
                $('.dt_searching_wrapper').html('');
                $('.dt_searching_wrapper').html(`${$('.dataTables_info').html()}`);
            });

            $('#userdocumentstatusdatatable-table').on('preXhr.dt', function(e, settings, data) {
                $('.js-datatable-filter-form :input').each(function() {
                    data[$(this).prop('name')] = $(this).val();
                });
            });


            @if (in_array(15,
                auth()->user()->get_allowed_menus()['download']))
                $('.dataTables_length').prepend(
                    '<button  class=" btn btn-outline-success mr-2 btn-sm"  onclick="exportToExcel();">Export To Excel  <i class="bx bx-file-blank"></i></button>'
                );
            @endif


            $('#userdocumentstatusdatatable-table').on('draw.dt', function() {
                $('.dt_searching_wrapper').html('');
                $('.dt_searching_wrapper').html(`${$('.dataTables_info').html()}`);
                @if ($status == 'un-approve' &&
                    in_array(
                        16,
                        auth()->user()->get_allowed_menus()['submit_btn']))
                    var btn =
                        `&nbsp&nbsp<button class="btn btn-primary btn-sm" onclick="absent_detail()">Mark To Absent</button>`
                    $('.dt_searching_wrapper').html(` ${$('.dataTables_info').html()} ${btn}`);
                @endif

                @if (in_array(
                    $status == 'final-status' && 17,
                    auth()->user()->get_allowed_menus()['submit_btn']))
                    var btn =
                        `&nbsp&nbsp<button class="btn btn-primary btn-sm" onclick="save_detail()">Send Exam Link</button>`
                    $('.dt_searching_wrapper').html(` ${$('.dataTables_info').html()} ${btn}`);
                @endif
            });


            $('#exam').on('change', function() {
                var id = this.value;
                $("#exam_batch").html('<option value="">Select Batch</option>');
                if (id) {
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
                    url: "{{ route('admin.send-exam-link') }}",
                    data: {
                        data: send_data,
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
                        $("#confirm_button").html('Submit');
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
                                $('input[type=checkbox]').prop('checked', false);
                                $('#addRemarkModal').modal('hide');
                                window.LaravelDataTables[
                                    "userdocumentstatusdatatable-table"].draw();
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
                            title: 'Error',
                            text: "Something went wrong..",
                            showConfirmButton: true,
                        })
                    }

                });
            });


            $('.submit_btn_abset').click(function() {
                var send_data = [];
                $('input[name="checked_ids[]"]:checked').each(function() {
                    send_data.push({
                        id: $(this).val(),
                    });
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.mark-to-absent-document') }}",
                    data: {
                        data: send_data,
                    },

                    beforeSend: function() {
                        $(".loader-wrapper").removeClass("d-none");
                        $(this).prop('disabled', true);
                        $(this).html(
                            `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>`
                        );
                    },

                    complete: function() {
                        $(".loader-wrapper").addClass("d-none");
                        $(this).prop('disabled', false);
                        $(this).html('Submit');
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
                                $('input[type=checkbox]').prop('checked', false);
                                $('#addAbsentModal').modal('hide');
                                window.LaravelDataTables[
                                    "userdocumentstatusdatatable-table"].draw();
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
                            title: 'Error',
                            text: "Something went wrong..",
                            showConfirmButton: true,
                        })
                    }

                });
            });


        });

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
                    icon: 'info',
                    text: "Select Atleast One Candidate?",
                    showConfirmButton: true,
                });
            }
        }

        function absent_detail(selector) {
            $('.absent_total_candidate').html($('input[name="checked_ids[]"]:checked').length);
            if ($('input[name="checked_ids[]"]:checked').length > 0) {
                $('#addAbsentModal').modal('show');
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    text: "Select Atleast One Candidate?",
                    showConfirmButton: true,
                });
            }
        }

        function exportToExcel() {
            $('.loader-wrapper').removeClass('d-none');
            let ful_url = "{{ url('admin/export_to_excel_ready_for_assessment') }}";
            var fileName = "ready_for_assessment.xlsx";
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

        function generateQr(selector) {
            $.ajax({
                url: "{{ route('admin.get-candidate-exam-link-qr-code') }}",
                type: "POST",
                data: {
                    exam_link: $(selector).data('value'),
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        $('.qr_code_modal_header').html($(selector).data('name'));
                        $('.qr_code_wrapper').html(response.html);
                        $('.qr_code_link').html($(selector).data('value'));
                        $('#generateQr').modal('show');
                    }
                }
            });

        }
    </script>
@endsection
