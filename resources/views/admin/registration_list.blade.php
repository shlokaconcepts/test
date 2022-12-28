@extends('layouts.admin_app')
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
                            <li class="breadcrumb-item active" aria-current="page">Registrations List
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="card">
                <div class="card-body">
                    <form method="get" class="js-datatable-filter-form row mb-3">
                        <div class="col-md-3 col-12">
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

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="form_category" class="form-label mb-0">Registration Type:</label>
                                <select class="select2" name="form_category" id="form_category">
                                    <option value="">Select Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="eligibility" class="form-label mb-0">Eligibility:</label>
                                <select class="select2" name="eligibility" id="eligibility">
                                    <option value="">Select</option>
                                    <option value="Eligible">Eligible </option>
                                    <option value="Not Eligible">Not Eligible</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="permanent_state" class="form-label mb-0">State:</label>
                                <select class="select2" name="permanent_state" id="permanent_state">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3  col-12 mt-2">
                            <div class="form-group">
                                <label for="permanent_district" class="form-label mb-0">District:</label>
                                <select class="select2" name="permanent_district" id="permanent_district">
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
                        <div class="col-md-2 col-12 mt-2">
                            <div class="form-group">
                                <label for="from_date">From Date:</label>
                                <input type="date" name="start_date" id="from_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 col-12 mt-2">
                            <div class="form-group">
                                <label for="end_date">To Date:</label>
                                <input type="date" name="end_date" id="end_date" class="form-control">
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
@endsection

@section('script')
    {!! $dataTable->scripts() !!}
    <script>
        $(function() {
            getCategory();
            $('#company_id').on('change', function() {
                getCategory();
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
                $("#form_category").val('').trigger("change");
                $("#eligibility").val('').trigger("change");
                $("#permanent_district").val('').trigger("change");
                $("#permanent_state").val('').trigger("change");
                $('#end_date').val('');
                $('#from_date').val('');
                $('#unique_id').val('');
                window.LaravelDataTables["registrationdatatable-table"].draw();
            });

            $("#Filter_btn").click(() => {
                window.LaravelDataTables["registrationdatatable-table"].draw();
            });

            $('#registrationdatatable-table').on('preXhr.dt', function(e, settings, data) {
                $('.js-datatable-filter-form :input').each(function() {
                    data[$(this).prop('name')] = $(this).val();
                });
            });
             @if (in_array(11,auth()->user()->get_allowed_menus()['download']))
                $('.dataTables_length').prepend('<button  class=" btn btn-outline-success mr-2"  onclick="exportToExcel();">Export To Excel  <i class="bx bx-file-blank"></i></button>');
             @endif
        });

        function exportToExcel() {

            $('.success_message').html('Exporting to excel');
            $('.loader-wrapper').removeClass('d-none');
            let url = "#" + $('#from_date').val() + "#" + $('#end_date').val() + "#" + $(
                '#form_category').val() + "#" + $('#eligibility').val() + "#" + $(
                '#permanent_state').val() + "#" + $('#permanent_district').val() + "#" + $('#unique_id').val()+"#"+$('#company_id').val();
            let ful_url = "{{url('admin/export_to_excel_registrations')}}/"+encodeURIComponent(btoa(url));
            var fileName = "users.xlsx";
            $.ajax({
                url: ful_url,
                cache: false,
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
