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
                            <li class="breadcrumb-item active" aria-current="page">Ready For Assessment
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
                        url: "{{ url('admin/get_rg_category')}}/" + id,
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
                $('#unique_id').val('');
                window.LaravelDataTables["readyforassessmentdatatable-table"].draw();
            });

            $("#Filter_btn").click(() => {
                window.LaravelDataTables["readyforassessmentdatatable-table"].draw();
            });

            $('#readyforassessmentdatatable-table').on('draw.dt', function() {
                $('.dt_searching_wrapper').html('');
                $('.dt_searching_wrapper').html(`${$('.dataTables_info').html()}`);
            });

            $('#readyforassessmentdatatable-table').on('preXhr.dt', function(e, settings, data) {
                $('.js-datatable-filter-form :input').each(function() {
                    data[$(this).prop('name')] = $(this).val();
                });
            });


            @if (in_array(15,auth()->user()->get_allowed_menus()['download']))
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
                        _token: "{{ csrf_token() }}",
                        data: send_data,
                    },

                    beforeSend: function() {
                        $("body").addClass("loading");
                        $('.submit_btn').prop('disabled', true);
                    },

                    complete: function() {
                        $("body").removeClass("loading");
                        $('.submit_btn').prop('disabled', false);
                        $('#confirm_button').html('Submit');
                    },



                    success: function(response) {
                        if (response.status == true) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.msg,
                                showConfirmButton: true,
                            }).then(() => {
                                $('#addRemarkModal').modal('hide');
                                window.LaravelDataTables["eligiblecandidate-table"]
                                    .draw();
                            });


                        } else if (response.status == false) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: response.msg,
                                showConfirmButton: true,
                            })
                        }
                    },
                    error: function() {

                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: "Something went wrong..",
                            showConfirmButton: true,
                        })
                    }

                });
            });
        });


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
    </script>
@endsection
