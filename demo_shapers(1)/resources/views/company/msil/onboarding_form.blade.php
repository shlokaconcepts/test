@extends('layouts.admin_app')
@section('style')
    <style>
        .intermainbody {
            width: 100%;
            font-size: 12px;
            line-height: 23px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            color: #171717;
        }

        .interinner {
            border: 1px solid #333;
            width: 100%;
        }

        .interinner table {
            width: 100%;
        }

        .ratcol {
            width: 25%;
            border-bottom: 1px solid #333;
            padding-left: 5px;
            text-align: center;
            font-size: 13px;
        }

        .card-header {
            margin-top: -1px;
        }

        .required {
            color: rgba(255, 0, 0, 0.789);
        }

        body {
            /* text-transform: capitalize !important; */
        }

        .submit_btn {
            margin-top: 27px;
            padding: 7px 30px !important;
        }
    </style>
@endsection

@section('wrapper')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item " aria-current="page">
                                {{ $user->full_name }}: {{ $user->prefix }}
                            </li>
                            <li class="breadcrumb-item " aria-current="page">
                                {{ 'Onboarding form' }}
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class="ms-auto">
                    <a href="{{ url('admin/boarding-unapproved-candidates') }}" class="btn btn-primary btn-sm add_exam">
                        <i class="fadeIn animated bx bx-arrow-back" aria-hidden="true"></i>Back
                    </a>
                </div>
            </div>
            <!--end breadcrumb-->



            <div class="card border border-primary">
                <div class="card-header bg-primary bg-gradient text-white ">
                    <i class="icon fa fa-user"></i> Candidate Details
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label class="form-label ">Registraion ID : <span class="required">*</span></label>
                                <div class="form-control-wrapper">
                                    <input name="ctl00$ContentPlaceHolder1$TxtCandidateRegNo" type="text"
                                        value="{{ $user->unique_id }}" id="ctl00_ContentPlaceHolder1_TxtCandidateRegNo"
                                        disabled="disabled" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label class="form-label ">Candidate Name :<span class="required">*</span> </label>
                                <input name="ctl00$ContentPlaceHolder1$TxtCandidateRegNo" type="text"
                                    value="{{ $user->full_name }} " id="ctl00_ContentPlaceHolder1_TxtCandidateRegNo"
                                    disabled="disabled" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label class="form-label">Mobile No. : <span class="required">*</span></label>
                                <div class="form-control-wrapper">
                                    <input name="ctl00$ContentPlaceHolder1$TxtCandidateMobile" type="text"
                                        value="{{ $user->phone_number }}" id="ctl00_ContentPlaceHolder1_TxtCandidateMobile"
                                        disabled="disabled" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label class="form-label">Email : <span class="required">*</span></label>
                                <div class="form-control-wrapper">
                                    <input name="ctl00$ContentPlaceHolder1$TxtCandidateEmail" type="text"
                                        value="{{ $user->email }}" id="ctl00_ContentPlaceHolder1_TxtCandidateEmail"
                                        disabled="disabled" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 mt-3">
                            <div class="form-group">
                                <label class="form-label">Aadhaar : <span class="required">*</span></label>
                                <div class="form-control-wrapper">
                                    <input name="ctl00$ContentPlaceHolder1$TxtCandidateAadhaar" type="text"
                                        value="{{ $user->aadhar_card }}" id="ctl00_ContentPlaceHolder1_TxtCandidateAadhaar"
                                        disabled="disabled" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 mt-3">
                            <div class="form-group">
                                <label class="form-label">Father's Name : <span class="required">*</span></label>
                                <div class="form-control-wrapper">
                                    <input name="ctl00$ContentPlaceHolder1$TxtFatherName" type="text"
                                        value="{{ $user->father_name }}" id="ctl00_ContentPlaceHolder1_TxtFatherName"
                                        disabled="disabled" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 mt-3">
                            <div class="form-group">
                                <label class="form-label">Date Of Birth : <span class="required">*</span></label>
                                <div class="form-control-wrapper">
                                    <input name="ctl00$ContentPlaceHolder1$TxtDOB" type="text"
                                        value="{{ date('d/m/Y', strtotime($user->dob)) }}"
                                        id="ctl00_ContentPlaceHolder1_TxtDOB" disabled="disabled" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 mt-3">
                            <div class="form-group">
                                <label class="form-label">Age : <span class="required">*</span></label>
                                <div class="form-control-wrapper">
                                    <input name="ctl00$ContentPlaceHolder1$TxtAgeYear" type="text"
                                        value="{{ \Carbon\Carbon::parse(date('Y-m-d', strtotime($user->dob)))->diff(\Carbon\Carbon::now())->format('%y') }}"
                                        id="ctl00_ContentPlaceHolder1_TxtAgeYear" disabled="disabled"
                                        class="form-control" style="width:47%; float:left; margin-right:10px">
                                    <input name="ctl00$ContentPlaceHolder1$TxtAgeMonth" type="text"
                                        value="{{ \Carbon\Carbon::parse(date('Y-m-d', strtotime($user->dob)))->diff(\Carbon\Carbon::now())->format('%m') }}"
                                        id="ctl00_ContentPlaceHolder1_TxtAgeMonth" disabled="disabled"
                                        class="form-control" style="width:47%; float:left">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <form class="card border border-success" id="interview_submit_form">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="card-header bg-success text-white ">
                    <i class="icon fa fa-briefcase"></i> Candidate Onboarding Details
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-md-3">
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

                        <div class="col-lg-3 col-md-4">
                            <div class="form-group">
                                <label class="form-label ">Employee ID :
                                </label>
                                <div class="form-control-wrapper">
                                    <input name="employee_id" type="text"
                                        value="{{ isset($user) && $user->employee_id ? $user->employee_id : '' }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4">
                            <div class="form-group">
                                <label class="form-label ">Onboarding Status <span class="required">*</span>
                                    :</label>
                                <div class="form-control-wrapper">
                                    <select name="status" class="select2" required>
                                        <option value="">Select Status</option>
                                        <option value="Joined Onboarded">Joined/Onboarded</option>
                                        <option value="Absent">Absent</option>
                                        <option value="Fake Document">Fake Document</option>
                                        <option value="Medical Unfit">Medical Unfit</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4">
                            <div class="form-group">
                                <label class="form-label ">Venues<span class="required">*</span>
                                    :</label>
                                <div class="form-control-wrapper">
                                    <select name="venue_id" id="venue_id" class="select2">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-3 col-md-4 mt-3">
                            <div class="form-group">
                                <label class="form-label ">Onboarding Date
                                    :</label>
                                <div class="form-control-wrapper">
                                    <input name="date" type="date" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 mt-3">
                            <div class="form-group">
                                <label class="form-label ">Remarks
                                    :</label>
                                <div class="form-control-wrapper">
                                    <textarea name="remark" rows="1" cols="20" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-center col-md-4 mt-1">
                            <button type="submit" class="btn btn-success submit_btn">Submit</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!--end page wrapper -->
@endsection

@section('script')
    <script>
        $(() => {

            $('#company_id').on('change', function() {
                var id = this.value;
                $("#venue_id").html('<option value="">Select Vanue</option>');
                if (id != '') {
                    $("#venue_id").html('<option value="">Fetching Vanue...</option>');
                    $.ajax({
                        url: "{{ url('admin/get_rg_category') }}/" + id,
                        type: "GET",
                        dataType: 'json',
                        success: function(res) {
                            $('#venue_id').html(
                                '<option value="">Select Venue</option>');
                            $.each(res.venue, function(key, value) {
                                $("#venue_id").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            }).change();




            $('#interview_submit_form').on('submit', function(e) {
                e.preventDefault();
                var postData = new FormData(document.getElementById('interview_submit_form'));
                $.ajax({
                    type: 'POST',
                    data: postData,
                    contentType: false,
                    processData: false,
                    url: "{{ route('admin.onboard_now') }}",
                    success: function(response) {
                        if (response.status == true) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                text: response.msg,
                                title: 'Success',
                                showConfirmButton: true,
                            }).then(() => {
                                window.location.replace(
                                    "{{ url('admin/boarding-approved-candidates') }}"
                                );
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
        });
    </script>
@endsection
