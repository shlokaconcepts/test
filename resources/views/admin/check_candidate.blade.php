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
                            <li class="breadcrumb-item active" aria-current="page">Assessment
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Assessment Result
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

                        <div class="col-md-3 mt-1">
                            <div class="form-group">
                                <label for="assessment_date_form">Assessment Date From:</label>
                                <input type="date" name="assessment_date_form" id="assessment_date_form" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 mt-1">
                            <div class="form-group">
                                <label for="assessment_date_to">Assessment Date To:</label>
                                <input type="date" name="assessment_date_to" id="assessment_date_to" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3 mt-1 col-12">
                            <div class="form-group">
                                <label for="reg_cat" class="form-label mb-0">Reg-Type :</label>
                                <select class="select2" name="reg_cat" id="reg_cat">
                                    <option value="">Select Catgeory</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 mt-2 col-12">
                            <div class="form-group">
                                <label for="iti_trade" class="form-label mb-0">Trade :</label>
                                <select class="select2" name="iti_trade" id="filter_iti_trade">
                                    <option value="">Select Trade</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 mt-2 col-12">
                            <div class="form-group">
                                <label for="exam" class="form-label mb-0">Exam :</label>
                                <select class="select2" name="exam" id="exam">
                                    <option value="">Select Exam</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 mt-2 col-12">
                            <div class="form-group">
                                <label for="exam_batch" class="form-label mb-0">Exam Batch:</label>
                                <select class="select2" name="exam_batch" id="exam_batch">
                                    <option value="">Select Batch</option>
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

                        <div class="col-md-2 col-12 mt-4">
                            <button type="button" class="btn btn-success clear_btn btn-sm mt-2" id="Filter_btn"> <i
                                    class="fadeIn animated bx bx-filter-alt"></i> </button>
                            <button type="button" class="btn btn-danger clear_btn btn-sm mt-2" id="clear_filter"><i
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
        <div class="modal-dialog modal-md modal-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="submit_exam">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group mt-1">
                                <div class=" d-flex ">
                                    <span><b>Total Selected Candidates</b> :</span>
                                    <span class=" mx-3 text-success total_candidate text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mt-2">
                                <label for="">Interview Date</label>
                                <input type="date" name="int_date" id="int_date" class=" form-control" required>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editMarkModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Marks</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row" id="editMark">
                        <input type="hidden" name="id" id="id">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_category" class="form-label mb-0">Aptitude :</label>
                                <input type="number" class="form-control" id="aptitude" name="aptitude">
                                <div class="form-text">Passing Mark (<strong class="aptitude_passing_mark"></strong>)
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_category" class="form-label mb-0">Technical :</label>
                                <input type="number" class="form-control" id="technical" name="technical">
                                <div class="form-text">Passing Mark (<strong class="technical_passing_mark"></strong>)
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label for="form_category" class="form-label mb-0">Behavior :</label>
                                <input type="number" class="form-control" id="behavior" name="behavior">
                                <div class="form-text">Passing Mark (<strong class="behavior_passing_mark"></strong>)
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label for="result" class="form-label mb-0">Result :</label>
                                <select class="select2" name="results" id="results">
                                    <option value="">Select Result</option>
                                    <option value="FAIL">Fail</option>
                                    <option value="PASS">Pass</option>
                                </select>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    <button type="button" class="btn btn-success submit_btn">Submit</button>
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
                $("#reg_cat").html('<option value="">Select Category</option>');
                if (id != '') {
                    $("#filter_iti_trade").html('<option value="">Fetching Trade...</option>');
                    $("#exam").html('<option value="">Fetching Exam...</option>');
                    $("#reg_cat").html('<option value="">Fetching Category...</option>');
                    $.ajax({
                        url: "{{ url('admin/get_rg_category') }}/" + id,
                        type: "GET",
                        dataType: 'json',
                        success: function(res) {
                            $('#filter_iti_trade').html(
                                '<option value="">Select Trade</option>');
                            $('#exam').html('<option value="">Select Exam</option>');
                            $("#reg_cat").html('<option value="">Select Category</option>');
                            $.each(res.trade, function(key, value) {
                                $("#filter_iti_trade").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                            $.each(res.exam, function(key, value) {
                                $("#exam").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                            $.each(res.data, function(key, value) {
                                $("#reg_cat").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            }).change();


            $('#clear_filter').on('click', function() {
                $('.js-datatable-filter-form').trigger("reset");
                $('.select2').val('').trigger('change');
                $('.single-select').val('').trigger('change');
                @if (auth()->user()->type == 0)
                    $('#company_id').val("{{ auth()->user()->company }}").change();
                @endif
                window.LaravelDataTables["checkcandidatedatatable-table"].draw();
            });

            $("#Filter_btn").click(() => {
                window.LaravelDataTables["checkcandidatedatatable-table"].draw();
            });

            $('#checkcandidatedatatable-table').on('draw.dt', function() {
                $('.dt_searching_wrapper').html('');
                $('.dt_searching_wrapper').html(`${$('.dataTables_info').html()}`);
            });

            $('#checkcandidatedatatable-table').on('preXhr.dt', function(e, settings, data) {
                $('.js-datatable-filter-form :input').each(function() {
                    data[$(this).prop('name')] = $(this).val();
                });
            });


            @if (in_array(22,
                auth()->user()->get_allowed_menus()['download']))
                $('.dataTables_length').prepend(
                    '<button  class=" btn btn-outline-success mr-2 btn-sm"  onclick="exportToExcel();">Export To Excel  <i class="bx bx-file-blank"></i></button>'
                );
            @endif

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

        });


        function exportToExcel() {
            $('.loader-wrapper').removeClass('d-none');
            let ful_url = "{{ url('admin/export_to_excel_check_candidate') }}";
            var fileName = "check_candidate.xlsx";
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
