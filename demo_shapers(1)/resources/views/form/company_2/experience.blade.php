@extends('form.layout')
@section('content')
    <div class="container">
        <ul class="nav nav-pills mb-5 mt-2" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link  btn " id="pills-personal-detail-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-personal-detail" type="button" role="tab"
                    aria-controls="pills-personal-detail" disabled aria-selected="true">Personal Details (व्यक्तिगत
                    विवरण)</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link btn  " id="pills-education-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-education" type="button" disabled role="tab" aria-controls="pills-education"
                    aria-selected="false">Education Details
                    शिक्षा विवरण</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link btn active " id="pills-work-experience-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-work-experience" type="button" role="tab"
                    aria-controls="pills-work-experience" aria-selected="false">Work Experience
                    (कार्य
                    अनुभव)</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link btn " disabled id="pills-other-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-other" type="button" role="tab" aria-controls="pills-other"
                    aria-selected="false">Other Information
                    (अतिरिक्त सूचना)</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link btn " disabled id="pills-document-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-document" type="button" role="tab" aria-controls="pills-document"
                    aria-selected="false">Documents & Final
                    Submit</button>
            </li>

        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-work-experience" role="tabpanel"
                aria-labelledby="pills-work-experience-tab">
                <form action="javascript:void(0);">
                    {{ csrf_field() }}
                    <input type="hidden" name="form_id" value="{{ $form_id }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <fieldset class="mt-4">
                        <legend class="apprenticeship_legend">Work Experience (कार्य अनुभव)
                        </legend>
                        <div class="row mt-2">
                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label>Have You Work Experience?<span class="requiredt">*</span></label><br>
                                    <select class="form-select" name="previous_company_work" id="previous_company_work"
                                        required="">
                                        <option value="0" @if (isset($user->previous_company_work) && $user->previous_company_work == '0') selected @endif>
                                            NO
                                        </option>
                                        <option value="1" @if (isset($user->previous_company_work) && $user->previous_company_work == '1') selected @endif>YES
                                        </option>
                                    </select>
                                    <span class="invalid-feedback d-none previous_company_work" role="alert">
                                        <strong class="previous_company_work_msg"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class=" row mt-2" id="Work_Experience_Wrapper" style="display: none;">
                                <div class="col-12 table-responsive">
                                    <table class="table  table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Company Name <br>/ संस्था का नाम</th>
                                                <th>Start Date <br>/शुरू तिथि</th>
                                                <th>End Date <br>/समाप्त तिथि</th>
                                                <th>Location <br>/स्थान</th>
                                                <th>Regular / Contract <br>/नियमित या अनुबंध</th>
                                                <th>Job Area <br>/विभाग</th>
                                                <th>Salary per month <br>/वेतन प्रति माह</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" name="previous_company_name"
                                                        value="{{ isset($user->previous_company_name) ? $user->previous_company_name : old('previous_company_name') }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_start_date"
                                                        value="{{ isset($user->previous_company_start_date) ? $user->previous_company_start_date : old('previous_company_start_date') }}"
                                                        class="form-control datepicker">
                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_end_date"
                                                        value="{{ isset($user->previous_company_end_date) ? $user->previous_company_end_date : old('previous_company_end_date') }}"
                                                        class="form-control datepicker">
                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_location"
                                                        value="{{ isset($user->previous_company_location) ? $user->previous_company_location : old('previous_company_location') }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <select class="form-select" name="previous_company_type">
                                                        <option value="">Select Type</option>
                                                        <option value="Regular"
                                                            @if (isset($user->previous_company_type) && $user->previous_company_type == 'Regular') selected @endif>
                                                            Regular
                                                        </option>
                                                        <option value="Contract"
                                                            @if (isset($user->previous_company_type) && $user->previous_company_type == 'Contract') selected @endif>
                                                            Contract
                                                        </option>
                                                    </select>

                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_division"
                                                        value="{{ isset($user->previous_company_division) ? $user->previous_company_division : old('previous_company_division') }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <input type="number"
                                                        name="previous_company_salary"value="{{ isset($user->previous_company_salary) ? $user->previous_company_salary : old('previous_company_salary') }}"
                                                        class="form-control">
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>
                                                    <input type="text" name="previous_company_name_two"
                                                        value="{{ isset($user->previous_company_name_two) ? $user->previous_company_name_two : old('previous_company_name_two') }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_start_date_two"
                                                        value="{{ isset($user->previous_company_start_date_two) ? $user->previous_company_start_date_two : old('previous_company_start_date_two') }}"
                                                        class="form-control datepicker">
                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_end_date_two"
                                                        value="{{ isset($user->previous_company_end_date_two) ? $user->previous_company_end_date_two : old('previous_company_end_date_two') }}"
                                                        class="form-control datepicker">
                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_location_two"
                                                        value="{{ isset($user->previous_company_location_two) ? $user->previous_company_location_two : old('previous_company_location_two') }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <select class="form-select" name="previous_company_type_two">
                                                        <option value="">Select Type</option>
                                                        <option value="Regular"
                                                            @if (isset($user->previous_company_type_two) && $user->previous_company_type_two == 'Regular') selected @endif>
                                                            Regular
                                                        </option>
                                                        <option value="Contract"
                                                            @if (isset($user->previous_company_type_two) && $user->previous_company_type_two == 'Contract') selected @endif>
                                                            Contract
                                                        </option>
                                                    </select>

                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_division_two"
                                                        value="{{ isset($user->previous_company_division_two) ? $user->previous_company_division_two : old('previous_company_division_two') }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <input type="number"
                                                        name="previous_company_salary_two"value="{{ isset($user->previous_company_salary_two) ? $user->previous_company_salary_two : old('previous_company_salary_two') }}"
                                                        class="form-control">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <input type="text" name="previous_company_name_three"
                                                        value="{{ isset($user->previous_company_name_three) ? $user->previous_company_name_three : old('previous_company_name_three') }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_start_date_three"
                                                        value="{{ isset($user->previous_company_start_date_three) ? $user->previous_company_start_date_three : old('previous_company_start_date_three') }}"
                                                        class="form-control datepicker">
                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_end_date_three"
                                                        value="{{ isset($user->previous_company_end_date_three) ? $user->previous_company_end_date_three : old('previous_company_end_date_three') }}"
                                                        class="form-control datepicker">
                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_location_three"
                                                        value="{{ isset($user->previous_company_location_three) ? $user->previous_company_location_three : old('previous_company_location_three') }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <select class="form-select" name="previous_company_type_three">
                                                        <option value="">Select Type
                                                        </option>
                                                        <option value="Regular"
                                                            @if (isset($user->previous_company_type_three) && $user->previous_company_type_three == 'Regular') selected @endif>
                                                            Regular
                                                        </option>
                                                        <option value="Contract"
                                                            @if (isset($user->previous_company_type_three) && $user->previous_company_type_three == 'Contract') selected @endif>
                                                            Contract
                                                        </option>
                                                    </select>

                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_division_three"
                                                        value="{{ isset($user->previous_company_division_three) ? $user->previous_company_division_three : old('previous_company_division_three') }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <input type="number"
                                                        name="previous_company_salary_three"value="{{ isset($user->previous_company_salary_three) ? $user->previous_company_salary_three : old('previous_company_salary_three') }}"
                                                        class="form-control">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="col-md-12 next-btn-wrapper">
                        <a href="{{ url('education_detail') }}" class=" btn btn-next "><i
                                class="fadeIn animated bx bx-skip-previous"></i>
                            <span>Previous</span></a>
                        <button type="submit" class=" btn btn-next"> <span>Next</span> <i
                                class="fadeIn animated bx bx-skip-next"></i> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(() => {

            $(".datepicker").pickadate({
                today: 'Today',
                clear: 'Clear',
                close: 'Close',
                format: 'dd-mm-yyyy',
                selectMonths: true,
                selectYears: true,
                max: new Date("{{ date('Y') }}", "{{ date('m') }}", "{{ date('d') }}"),
                selectYears: 40,
                selectMonths: true,
            });

            $('#previous_company_work').change(function() {
                if ($(this).val() == '1') {
                    $('#Work_Experience_Wrapper').show();
                } else {
                    $('#Work_Experience_Wrapper').hide();
                }
            });


            $('form').validate({
                submitHandler: function(form, event) {
                    event.preventDefault();

                    var formData = new FormData(form);
                    $.ajax({
                        url: "{{ route('store-work-experience') }}",
                        type: "POST",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $(".loader-wrapper").removeClass("d-none");
                            $('#save_detail').prop("disabled", true);
                            $('#save_detail').html(
                                `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>`
                            );
                        },

                        complete: function() {
                            $(".loader-wrapper").addClass("d-none");
                            $('.add_remark_status_btn').prop('disabled', false);
                            $('#save_detail').prop("disabled", false);
                            $('#save_detail').html('Save And Continue Later');
                        },

                        success: function(response) {

                            if (response.status == true) {
                                if (response.success_input) {
                                    $.each(response.success_input, function(key,
                                        value) {
                                        $('#' + value).removeClass(
                                            'is-invalid');
                                        $('.' + value).addClass('d-none');
                                        $('.' + value + '_msg').html('');
                                    });
                                }

                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    text: response.msg,
                                    title: "Success",
                                    showConfirmButton: true,
                                }).then(() => {
                                    if (response.redirect_url) {
                                        window.location.replace(response
                                            .redirect_url);
                                    }
                                });

                            } else if (response.status == false) {
                                if (response.first_error) {
                                    $('#' + response.first_error).focus();
                                }
                                if (response.errors) {
                                    $.each(response.errors, function(key, value) {
                                        $('#' + key).addClass('is-invalid');
                                        $('.' + key).removeClass('d-none');
                                        $('.' + key + '_msg').html(value);
                                    });

                                } else {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        text: response.msg,
                                        title: "Error",
                                        showConfirmButton: true,
                                    });
                                }
                                if (response.success_input) {
                                    $.each(response.success_input, function(key,
                                        value) {
                                        $('#' + value).removeClass(
                                            'is-invalid');
                                        $('.' + value).addClass('d-none');
                                        $('.' + value + '_msg').html('');
                                    });
                                }
                            }
                        },
                        error: function() {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                text: "Something went wrong..",
                                title: "Error",
                                showConfirmButton: true,
                            }).then(() => {
                                location.relode();
                            });
                        }
                    });


                },
                highlight: function(element) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element) {
                    $(element).removeClass("is-invalid");
                },

            });

            $('#previous_company_work').change();
        });
    </script>
@endsection
