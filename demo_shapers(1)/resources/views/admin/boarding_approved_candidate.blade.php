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
                            <li class="breadcrumb-item active" aria-current="page">OnBoarding
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">OnBoarded Candidates
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
                                <label for="form_category" class="form-label mb-0">Reg-Type :</label>
                                <select class="select2" name="form_category" id="form_category">
                                    <option value="">Select Category</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 mt-1 col-12">
                            <div class="form-group">
                                <label for="venue_id" class="form-label mb-0">Venue :</label>
                                <select class="select2" name="venue_id" id="venue_id">
                                    <option value="">Select Venue</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <label for="from_date">Interview From Date :</label>
                                <input type="date" name="start_date" id="from_date" class="form-control">
                            </div>
                        </div>
    
                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <label for="end_date">Interview To Date :</label>
                                <input type="date" name="end_date" id="end_date" class="form-control">
                            </div>
                        </div>
    
                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <label for="onboarding_date">Onboarding To Date :</label>
                                <input type="date" name="onboarding_date" id="onboarding_date" class="form-control">
                            </div>
                        </div>
    
                        <div class="col-lg-3 col-md-3 mt-2">
                            <div class="form-group">
                                <label >Onboarding Status :</label>
                                    <select name="status" class="select2" id="status" >
                                        <option value="">Select Status</option>
                                        <option value="Joined Onboarded">Joined/Onboarded</option>
                                        <option value="Absent">Absent</option>
                                        <option value="Fake Document">Fake Document</option>
                                        <option value="Medical Unfit">Medical Unfit</option>
                                    </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-12 mt-2">
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
                        <div class="col-md-3  col-12 mt-2">
                            <div class="form-group">
                                <label for="permanent_district" class="form-label mb-0">Permanent District:</label>
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
                $("#form_category").html('<option value="">Select Category</option>');
                $("#venue_id").html('<option value="">Select Venue</option>');
                if (id != '') {
                    $("#filter_iti_trade").html('<option value="">Fetching Trade...</option>');
                    $("#form_category").html('<option value="">Fetching Category...</option>');
                    $("#venue_id").html('<option value="">Fetching Venue...</option>');
                    $.ajax({
                        url: "{{ url('admin/get_rg_category') }}/" + id,
                        type: "GET",
                        dataType: 'json',
                        success: function(res) {
                            $('#filter_iti_trade').html(
                                '<option value="">Select Trade</option>');
                                $("#form_category").html('<option value="">Select Category</option>');
                                $("#venue_id").html('<option value="">Select Venue</option>');
                            $.each(res.trade, function(key, value) {
                                $("#filter_iti_trade").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                            $.each(res.data, function(key, value) {
                                $("#form_category").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });

                            $.each(res.venue, function(key, value) {
                                $("#venue_id").append('<option value="' + value
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

         
            $('#clear_filter').on('click', function() {
                $('.js-datatable-filter-form').trigger("reset");
                $('#filter_iti_trade').val('').change();
                $('#form_category').val('').change();
                $('#permanent_state').val('').change();
                $('#venue_id').val('').change();
                $('#permanent_district').val('').change();
                $('#present_state').val('').change();
                $('#present_district').val('').change();
                $('#status').val('').change();
                $('#unique_id').val('');
                window.LaravelDataTables["onboardingapprovedcandidatesdatatable-table"].draw();
            });
            $("#Filter_btn").click(() => {
                window.LaravelDataTables["onboardingapprovedcandidatesdatatable-table"].draw();
            });
            $('#onboardingapprovedcandidatesdatatable-table').on('draw.dt', function() {
                $('.dt_searching_wrapper').html('');
                $('.dt_searching_wrapper').html(`${$('.dataTables_info').html()}`);
            });

            $('#onboardingapprovedcandidatesdatatable-table').on('preXhr.dt', function(e, settings, data) {
                $('.js-datatable-filter-form :input').each(function() {
                    data[$(this).prop('name')] = $(this).val();
                });
            });
            @if (in_array(28,auth()->user()->get_allowed_menus()['download']))
                $('.dataTables_length').prepend(
                    '<button  class=" btn btn-outline-success mr-2 btn-sm"  onclick="exportToExcel();">Export To Excel  <i class="bx bx-file-blank"></i></button>'
                );
            @endif

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
    </script>
@endsection
