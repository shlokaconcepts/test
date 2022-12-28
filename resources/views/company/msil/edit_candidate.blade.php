@extends('layouts.admin_app')
@section('style')
    <link href="{{ asset('public/assets/plugins/datetimepicker/css/classic.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/datetimepicker/css/classic.date.css') }}" rel="stylesheet" />
    <style>
        .btn--dark.btn--shadow {
            box-shadow: 0 5px 10px 0 rgb(16 22 58 / 35%);
        }

        .toggle-off.btn {
            padding-left: 10px;
        }

        .form-wrapper {
            background-color: white;
            border-radius: 2px;
            padding: 20px 4px;
        }

        input,
        select {
            border-radius: 0px !important;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        .form-check-input {
            cursor: pointer;
        }

        .requiredt {
            color: red;
        }

        h1,
        h4,
        h3,
        h5,
        h6 {
            color: rgb(52, 38, 164) !important;
        }

        footer {
            background-color: #595959;
        }

        .field-heading {
            border-radius: 5px;
            padding: 10px 10px;
            font-size: 18px !important;
            background: rgb(35 135 223 / 43%);
            color: rgb(52, 38, 164) !important;
        }

        .heading-color {
            color: #03102b !important;
            font-weight: 500;
        }

        @media screen (min-width: 768) {
            .field-heading {
                width: 100%;
            }
        }

        .sub_heading {
            font-size: 17px;
        }

        .filed_sub_heading {
            font-size: 15px;
        }

        .form_type_heading {
            font-size: 24px;
            color: rgb(52, 38, 164) !important;
            text-align: center;
        }

        embed {
            height: 100vh !important;
            overflow: hidden;
        }

        fieldset {
            border: 1px solid rgb(52, 38, 164);
            margin-bottom: 15px;
            padding: 20px 10px 15px 10px;
            border-radius: 6px;
            position: relative;
        }

        legend {
            position: absolute;
            top: -4%;
            font-size: 11pt;
            margin-bottom: 0;
            border: transparent;
            width: auto;
            margin-left: 10px;
            border: 1px solid rgb(52, 38, 164);
            box-shadow: 3px 3px 15px #ccc;
            padding: 5px 10px;
            background: rgb(52, 38, 164);
            color: white;
            border-radius: 6px;
            margin: 0 auto;
            display: block;
        }

        .legend_2 {
            top: -9%;
        }

        .legend_family {
            top: -2%;
        }

        .other_information {
            top: -2%;
        }

        .educations {
            top: -7%;
        }

        .iti_legend {
            top: -6%;
        }

        @media only screen and (max-width: 600px) {
            .legend_2 {
                top: -4% !important;
            }

            .legend_family {
                top: -0.7% !important;
            }

            .other_information {
                top: -1.2%;
            }

            .document legend {
                top: -1.3% !important;
            }

            .document {
                top: -1.8%;
            }

            .presonal_information {
                top: -1.6%;
            }

            .educations {
                top: -3.1%;
            }

            .iti_legend {
                top: -3%;
            }

            .agree_legend {
                top: -2%;
            }
        }

        .error {
            color: red;
            font-size: smaller;
        }
    </style>
@endsection
@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Users Profile</li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $user->full_name }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('admin.registration-list') }}" class="btn btn-primary btn-sm add_exam">
                        <i class="fadeIn animated bx bx-arrow-back" aria-hidden="true"></i>Back
                    </a>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row mb-none-30">
                <div class="col-12">
                    <div class="form-wrapper border-0  shadow-sm mt-2 mb-5">
                        <form action="javascript:void(0);" class="container-fluid" id="userForm"
                            enctype="multipart/form-data">
                            <input type="hidden" name="user_id" value="{{ isset($user->id) ? $user->id : '' }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class=" form_type_heading">Candidate Registration Form ({{ $user->reg_cat_name }})
                                    </h3>
                                </div>
                                <fieldset class=" mt-4">
                                    <legend class="presonal_information">Personal Information (व्यक्तिगत विवरण)</legend>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>First Name (पहला नाम):<span class="requiredt">*</span></label>
                                                <input type="text" name="first_name"
                                                    value="{{ isset($user->first_name) ? $user->first_name : old('first_name') }}"
                                                    class="form-control" id="first_name" required>
                                                <span class="invalid-feedback first_name d-none" role="alert">
                                                    <strong class="first_name_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label> Middle Name (मध्य नाम)</label>
                                                <input type="text" name="middle_name"
                                                    value="{{ isset($user->middle_name) ? $user->middle_name : old('middle_name') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Last Name (अंतिम नाम)</label>
                                                <input type="text" name="last_name" id="last_name"
                                                    value="{{ isset($user->last_name) ? $user->last_name : old('last_name') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>Date of Birth <br>(जन्म की तारीख) <span class="requiredt">*</span>
                                                </label>
                                                <input type="text" name="dob" id="dob"
                                                    class="form-control datepicker" value="{{ $user->dob }}"
                                                    required="">
                                                <span class="invalid-feedback dob d-none" role="alert">
                                                    <strong class="dob_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>Phone Number (10 digit) / फ़ोन नंबर (10 अंक) <br> <b> Note: Enter
                                                        without
                                                        country code </b> <span class="requiredt">*</span> </label>
                                                <input type="number" name="phone_number"
                                                    value="{{ isset($user->phone_number) ? $user->phone_number : old('phone_number') }}"
                                                    class="form-control" id="phone_number" required="">
                                                <span class="invalid-feedback phone_number d-none" role="alert">
                                                    <strong class="phone_number_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>Alternative Mobile Number (वैकल्पिक मोबाइल नंबर) <br> <b> Note: Enter
                                                        without
                                                        country code </b></label>
                                                <input type="number" name="alternative_number"
                                                    value="{{ isset($user->alternative_number) ? $user->alternative_number : old('alternative_number') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>Email ID (ईमेल आईडी)</label>
                                                <input type="email" id="email" name="email"
                                                    value="{{ $user->email }}" readonly class="form-control">
                                                <span class="invalid-feedback d-none email" role="alert">
                                                    <strong class="email_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>Gender (लिंग) <span class="requiredt">*</span></label><br>
                                                <select class="form-select" name="gender" id="gender">
                                                    <option value="MALE"
                                                        @if (isset($user->gender) && $user->gender == 'MALE') selected @endif>Male /
                                                        पुरुष
                                                    </option>
                                                    <option value="FEMALE"
                                                        @if (isset($user->gender) && $user->gender == 'FEMALE') selected @endif>Female
                                                        /
                                                        महिला</option>
                                                    <option value="OTHER"
                                                        @if (isset($user->gender) && $user->gender == 'OTHER') selected @endif>Other
                                                        /
                                                        अन्य</option>
                                                </select>
                                                <span class="invalid-feedback d-none gender" role="alert">
                                                    <strong class="gender_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>Marital Status (वैवाहिक स्थिति) <span
                                                        class="requiredt">*</span></label><br>
                                                <select class="form-select" name="marital_status" id="marital_status"
                                                    required="">
                                                    <option value="Single"
                                                        @if (isset($user->marital_status) && $user->marital_status == 'Single') selected @endif>
                                                        Single / अविवाहित</option>
                                                    <option value="Married"
                                                        @if (isset($user->marital_status) && $user->marital_status == 'Married') selected @endif>
                                                        Married / विवाहित</option>
                                                </select>
                                                <span class="invalid-feedback d-none marital_status" role="alert">
                                                    <strong class="marital_status_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>Category / वर्ग <span class="requiredt">*</span></label><br>
                                                <select class="form-select" name="category" id="category"
                                                    required="">
                                                    <option value="GENERAL"
                                                        @if (isset($user->category) && $user->category == 'GENERAL') selected @endif>
                                                        General
                                                    </option>
                                                    <option value="OBC"
                                                        @if (isset($user->category) && $user->category == 'OBC') selected @endif>OBC
                                                    </option>
                                                    <option value="SC"
                                                        @if (isset($user->category) && $user->category == 'SC') selected @endif>SC
                                                    </option>
                                                    <option value="ST"
                                                        @if (isset($user->category) && $user->category == 'ST') selected @endif>ST
                                                    </option>
                                                    <option value="OTHER"
                                                        @if (isset($user->category) && $user->category == 'OTHER') selected @endif>OTHER
                                                    </option>
                                                </select>
                                                <span class="invalid-feedback d-none category" role="alert">
                                                    <strong class="category_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>Aadhar Number / आधार संख्या <span class="requiredt">*</span></label>
                                                <input type="number" name="aadhar_card" id="aadhar_card"
                                                    value="{{ isset($user->aadhar_card) ? $user->aadhar_card : old('aadhar_card') }}"
                                                    class="form-control" required="">
                                                <span class="invalid-feedback aadhar_card d-none" role="alert">
                                                    <strong class="aadhar_card_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>PAN Number/ पैन नंबर </label>
                                                <input type="text" name="pancard" id="pancard"
                                                    onkeyup="ValidatePAN();"
                                                    value="{{ isset($user->pancard) ? $user->pancard : old('pancard') }}"
                                                    class="form-control" style="text-transform: uppercase;">
                                                <span class="invalid-feedback pancard d-none" role="alert">
                                                    <strong class="pancard_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>Blood group / ब्लड ग्रुप </label><br>
                                                <select class="form-select" name="blood_group" id="blood_group">
                                                    <option value="">Select Blood Group</option>
                                                    <option value="O+"
                                                        @if (isset($user->blood_group) && $user->blood_group == 'O+') selected @endif>O+
                                                    </option>
                                                    <option value="A+"
                                                        @if (isset($user->blood_group) && $user->blood_group == 'A+') selected @endif>A+
                                                    </option>
                                                    <option value="B+"
                                                        @if (isset($user->blood_group) && $user->blood_group == 'B+') selected @endif>B+
                                                    </option>
                                                    <option value="O-"
                                                        @if (isset($user->blood_group) && $user->blood_group == 'O-') selected @endif>O-
                                                    </option>
                                                    <option value="A-"
                                                        @if (isset($user->blood_group) && $user->blood_group == 'A-') selected @endif>A-
                                                    </option>
                                                    <option
                                                        value="AB+"@if (isset($user->blood_group) && $user->blood_group == 'AB+') selected @endif>
                                                        AB+
                                                    </option>
                                                    <option value="B-"
                                                        @if (isset($user->blood_group) && $user->blood_group == 'B-') selected @endif>B-
                                                    </option>
                                                    <option
                                                        value="AB-"@if (isset($user->blood_group) && $user->blood_group == 'AB-') selected @endif>
                                                        AB-
                                                    </option>
                                                </select>
                                                <span class="invalid-feedback blood_group d-none" role="alert">
                                                    <strong class="blood_group_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-4">
                                    <legend class="legend_2">Permanent Address (स्थायी पता )</legend>
                                    <div class="row mt-2">
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>House / Flat No (मकान संख्या)<span
                                                        class="requiredt">*</span></label>
                                                <input type="text" id="permanent_house_number"
                                                    name="permanent_house_number" class="form-control" required
                                                    value="{{ isset($user->permanent_house_number) ? $user->permanent_house_number : old('permanent_house_number') }}">
                                                <span class="invalid-feedback permanent_house_number d-none"
                                                    role="alert">
                                                    <strong class="permanent_house_number_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Street / Village (गली/गााँव)<span class="requiredt">*</span></label>
                                                <input type="text" name="permanent_house_street_village"
                                                    id="permanent_house_street_village" class="form-control" required
                                                    value="{{ isset($user->permanent_house_street_village) ? $user->permanent_house_street_village : old('permanent_house_street_village') }}">
                                                <span class="invalid-feedback permanent_house_street_village d-none"
                                                    role="alert">
                                                    <strong class="permanent_house_street_village_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>State / राज्य <span class="requiredt">*</span></label><br>
                                                <select
                                                    class="form-select  @error('permanent_state') is-invalid @enderror"
                                                    name="permanent_state" id="permanent_state" required="">
                                                    <option value="">Select State</option>
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->id }}"
                                                            @if (isset($user->permanent_state) && $user->permanent_state == $state->id) selected @endif>
                                                            {{ $state->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="invalid-feedback permanent_state d-none" role="alert">
                                                    <strong class="permanent_state_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>District (जिला)<span class="requiredt">*</span></label><br>
                                                <select class="form-select" name="permanent_district"
                                                    id="permanent_district" required="">
                                                    <option value="">Select District</option>
                                                </select>
                                                <span class="invalid-feedback permanent_district d-none" role="alert">
                                                    <strong class="permanent_district_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>Pin Code / पिन कोड <span class="requiredt">*</span></label>
                                                <input type="number" id="permanent_pincode" name="permanent_pincode"
                                                    value="{{ isset($user->permanent_pincode) ? $user->permanent_pincode : old('permanent_pincode') }}"
                                                    class="form-control " required="">
                                                <span class="invalid-feedback d-none permanent_pincode" role="alert">
                                                    <strong class="permanent_pincode_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-4">
                                    <legend class="legend_2">Present Address (वर्तमान पता)</legend>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label>
                                                <input class="form-check-input me-1" type="checkbox" id="same_address">
                                                Is your present address same as permanent address ?
                                            </label>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>House / Flat No (मकान संख्या)<span
                                                        class="requiredt">*</span></label>
                                                <input type="text" name="present_house_number" class="form-control"
                                                    id="present_house_number" required
                                                    value="{{ isset($user->present_house_number) ? $user->present_house_number : old('present_house_number') }}">
                                                <span class="invalid-feedback present_house_number d-none" role="alert">
                                                    <strong class="present_house_number_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Street / Village (गली/गााँव)<span class="requiredt">*</span></label>
                                                <input type="text" name="present_house_street_village"
                                                    id="present_house_street_village" class="form-control" required
                                                    value="{{ isset($user->present_house_street_village) ? $user->present_house_street_village : old('present_house_street_village') }}">
                                                <span class="invalid-feedback present_house_street_village d-none"
                                                    role="alert">
                                                    <strong class="present_house_street_village_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>State / राज्य <span class="requiredt">*</span></label><br>
                                                <select class="form-select" name="present_state" id="present_state"
                                                    required="">
                                                    <option value="">Select State</option>
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->id }}"
                                                            @if (isset($user->present_state) && $user->present_state == $state->id) selected @endif>
                                                            {{ $state->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="invalid-feedback present_state d-none" role="alert">
                                                    <strong class="present_state_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>District (जिला)<span class="requiredt">*</span></label><br>
                                                <select class="form-select" name="present_district" id="present_district"
                                                    required="">
                                                    <option value="">Select District</option>
                                                </select>
                                                <span class="invalid-feedback present_state d-none" role="alert">
                                                    <strong class="present_state_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>Pin Code / पिन कोड <span class="requiredt">*</span></label>
                                                <input type="number" name="present_pincode" id="present_pincode"
                                                    value="{{ isset($user->present_pincode) ? $user->present_pincode : old('present_pincode') }}"
                                                    class="form-control" required="">
                                                <span class="invalid-feedback present_pincode d-none" role="alert">
                                                    <strong class="present_pincode_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-4">
                                    <legend class="legend_family">Family Details</legend>
                                    <div class="row mt-2">
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Father's Name / <br>पिता का नाम <span
                                                        class="requiredt">*</span></label>
                                                <input type="text" name="father_name" id="father_name"
                                                    class="form-control"
                                                    value="{{ isset($user->father_name) ? $user->father_name : old('father_name') }}"
                                                    required="">
                                                <span class="invalid-feedback d-none father_name" role="alert">
                                                    <strong class="father_name_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Father's Age / <br>पिता की उम्र</label>
                                                <input type="number" name="father_age"
                                                    value="{{ isset($user->father_age) ? $user->father_age : old('father_age') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Father's Occupation / <br> पिता का व्यवसाय</label>
                                                <input type="text" name="father_occupation"
                                                    value="{{ isset($user->father_occupation) ? $user->father_occupation : old('father_occupation') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Father's Annual Income in Rupees / <br> रुपए में पिता की वार्षिक
                                                    आय</label>
                                                <input type="number" name="father_annual_income"
                                                    value="{{ isset($user->father_annual_income) ? $user->father_annual_income : old('father_annual_income') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Mother's Name / <br>मां का नाम</label>
                                                <input type="text" name="mother_name"
                                                    value="{{ isset($user->mother_name) ? $user->mother_name : old('mother_name') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Mother's Age / <br>माँ की उम्र</label>
                                                <input type="number" name="mother_age"
                                                    value="{{ isset($user->mother_age) ? $user->mother_age : old('mother_age') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Mother's Occupation / <br>मां का व्यवसाय</label>
                                                <input type="text" name="mother_occupation"
                                                    value="{{ isset($user->mother_occupation) ? $user->mother_occupation : old('mother_occupation') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Mother's Annual Income in Rupees / <br> रुपए में मां की वार्षिक
                                                    आय</label>
                                                <input type="number" name="mother_annual_income"
                                                    value="{{ isset($user->mother_annual_income) ? $user->mother_annual_income : old('mother_annual_income') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Wife's Name / <br> पत्नी का नाम</label>
                                                <input type="text" name="wife_name"
                                                    value="{{ isset($user->wife_name) ? $user->wife_name : old('wife_name') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Wife's Age / <br> पत्नी की उम्र</label>
                                                <input type="number" name="wife_age"
                                                    value="{{ isset($user->wife_age) ? $user->wife_age : old('wife_age') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Wife's Occupation / <br> पत्नी का व्यवसाय</label>
                                                <input type="text" name="wife_occupation"
                                                    value="{{ isset($user->wife_occupation) ? $user->wife_occupation : old('wife_occupation') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Wife's Annual Income in Rupees / <br> रुपए में पत्नी की वार्षिक
                                                    आय</label>
                                                <input type="number" name="wife_annual_income"
                                                    value="{{ isset($user->wife_annual_income) ? $user->wife_annual_income : old('wife_annual_income') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Sibling 1 's Name / <br> भाई/बहन 1 का नाम</label>
                                                <input type="text" name="s1name"
                                                    value="{{ isset($user->s1name) ? $user->s1name : old('s1name') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Sibling 1 's Age / <br> भाई/बहन 1 की उम्र</label>
                                                <input type="number" name="s1sage"
                                                    value="{{ isset($user->s1sage) ? $user->s1sage : old('s1sage') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Sibling 1 's Occupation / <br> भाई/बहन 1 का व्यवसाय</label>
                                                <input type="text" name="s1soccupation"
                                                    value="{{ isset($user->s1soccupation) ? $user->s1soccupation : old('s1soccupation') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Sibling 1 's Annual Income in Rupees / <br> रुपए में भाई/बहन 1 की
                                                    वार्षिक
                                                    आय</label>
                                                <input type="number" name="s1sannualincome"
                                                    value="{{ isset($user->s1sannualincome) ? $user->s1sannualincome : old('s1sannualincome') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Sibling 2 's Name / <br> भाई/बहन 2 का नाम</label>
                                                <input type="text" name="s2name"
                                                    value="{{ isset($user->s2name) ? $user->s2name : old('s2name') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Sibling 2 's Age / <br> भाई/बहन 2 की उम्र</label>
                                                <input type="number" name="s2sage"
                                                    value="{{ isset($user->s2sage) ? $user->s2sage : old('s2sage') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Sibling 2 's Occupation / <br> भाई/बहन 2 का व्यवसाय</label>
                                                <input type="text" name="s2soccupation"
                                                    value="{{ isset($user->s2soccupation) ? $user->s2soccupation : old('s2soccupation') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Sibling 2 's Annual Income in Rupees / <br>रुपए में भाई/बहन 2 की
                                                    वार्षिक
                                                    आय</label>
                                                <input type="number" name="s2sannualincome"
                                                    value="{{ isset($user->s2sannualincome) ? $user->s2sannualincome : old('s2sannualincome') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Sibling 3 's Name / <br> भाई/बहन 3 का नाम</label>
                                                <input type="text" name="s3name"
                                                    value="{{ isset($user->s3name) ? $user->s3name : old('s3name') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Sibling 3 's Age / <br> भाई/बहन 3 की उम्र</label>
                                                <input type="number" name="s3sage"
                                                    value="{{ isset($user->s3sage) ? $user->s3sage : old('s3sage') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Sibling 3 's Occupation / <br> भाई/बहन 3 का व्यवसाय</label>
                                                <input type="text" name="s3soccupation"
                                                    value="{{ isset($user->s3soccupation) ? $user->s3soccupation : old('s3soccupation') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Sibling 3 's Annual Income in Rupees / <br> रुपए में भाई/बहन 3 की
                                                    वार्षिक
                                                    आय</label>
                                                <input type="number" name="s3sannualincome"
                                                    value="{{ isset($user->s3sannualincome) ? $user->s3sannualincome : old('s3sannualincome') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Children 1 's Name / <br> संतान 1 का नाम</label>
                                                <input type="text" name="child1name"
                                                    value="{{ isset($user->child1name) ? $user->child1name : old('child1name') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Children 1 's Age / <br> संतान 1 की उम्र</label>
                                                <input type="number" name="child1sage"
                                                    value="{{ isset($user->child1sage) ? $user->child1sage : old('child1sage') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Children 2 's Name / <br> संतान 2 का नाम</label>
                                                <input type="text" name="child2name"
                                                    value="{{ isset($user->child2name) ? $user->child2name : old('child2name') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Children 2 's Age / <br> संतान 2 की उम्र</label>
                                                <input type="number" name="child2sage"
                                                    value="{{ isset($user->child2sage) ? $user->child2sage : old('child2sage') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Children 3 's Name / <br> संतान 3 का नाम</label>
                                                <input type="text" name="child3name"
                                                    value="{{ isset($user->child3name) ? $user->child3name : old('child3name') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Children 3 's Age / <br> संतान 3 की उम्र</label>
                                                <input type="number" name="child3sage"
                                                    value="{{ isset($user->child3sage) ? $user->child3sage : old('child3sage') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-4">
                                    <legend class="legend_family">Education Details</legend>
                                    <fieldset class="mt-4">
                                        <legend class="educations">10th(दसवीं कक्षा)</legend>
                                        <div class="row mt-2">
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>School /Institution <br> (स्कूल/विश्वविद्यालय) <span
                                                            class="requiredt">*</span></label>
                                                    <input type="text" name="tenth_college_name"
                                                        id="tenth_college_name"
                                                        value="{{ isset($user->tenth_college_name) ? $user->tenth_college_name : old('tenth_college_name') }}"
                                                        class="form-control" required="">
                                                    <span class="invalid-feedback d-none tenth_college_name"
                                                        role="alert">
                                                        <strong class="tenth_college_name_msg"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>Board<br> (बोर्ड)<span class="requiredt">*</span>
                                                    </label>
                                                    <input type="text" required name="tenth_board" id="tenth_board"
                                                        value="{{ isset($user->tenth_board) ? $user->tenth_board : old('tenth_board') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>Reg/ Correspondence <br> (व्यवसायिक व पत्राचार)<span
                                                            class="requiredt">*</span></label>
                                                    <select class="form-select" name="tenth_education_type"
                                                        id="tenth_education_type" required="">
                                                        <option value="">Select</option>
                                                        <option value="Regular"
                                                            @if (isset($user->tenth_education_type) && $user->tenth_education_type == 'Regular') selected @endif>
                                                            {{ 'Regular' }}</option>
                                                        <option value="Correspondence"
                                                            @if (isset($user->tenth_education_type) && $user->tenth_education_type == 'Correspondence') selected @endif>
                                                            {{ 'Correspondence' }}
                                                        </option>
                                                    </select>
                                                    <span class="invalid-feedback d-none tenth_education_type"
                                                        role="alert">
                                                        <strong class="tenth_education_type_msg"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>Starting Year <br> (शुरू वर्ष) <span
                                                            class="requiredt">*</span></label>
                                                    <select class="form-select" name="tenth_start_year"
                                                        id="tenth_start_year" required="">
                                                        <option value="">Select Start Year</option>
                                                        @for ($i = date('Y'); $i >= 1980; $i--)
                                                            <option value="{{ $i }}"
                                                                @if (isset($user->tenth_start_year) && $user->tenth_start_year == $i) selected @endif>
                                                                {{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                    <span class="invalid-feedback d-none tenth_start_year" role="alert">
                                                        <strong class="tenth_start_year_msg"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>Passing Year <br> (उत्तीर्ण वर्ष)<span
                                                            class="requiredt">*</span></label>
                                                    <select class="form-select" name="tenth_passing_year"
                                                        id="tenth_passing_year" required="">
                                                        <option value="">Select Start Year</option>
                                                        @for ($i = date('Y'); $i >= 1980; $i--)
                                                            <option value="{{ $i }}"
                                                                @if (isset($user->tenth_passing_year) && $user->tenth_passing_year == $i) selected @endif>
                                                                {{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                    <span class="invalid-feedback d-none tenth_passing_year"
                                                        role="alert">
                                                        <strong class="tenth_passing_year_msg"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>%Percent <br> (प्रतिशत)<span class="requiredt">*</span></label>
                                                    <input type="number" name="tenth_score" id="tenth_score"
                                                        value="{{ isset($user->tenth_score) ? $user->tenth_score : old('tenth_score') }}"
                                                        class="form-control" required="">
                                                    <span class="invalid-feedback d-none tenth_score" role="alert">
                                                        <strong class="tenth_score_msg"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="mt-4">
                                        <legend class="educations">12th(बारहवीं कक्षा)</legend>
                                        <div class="row mt-2">
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>School/Institution <br> (स्कूल/विश्वविद्यालय)</label>
                                                    <input type="text" name="twelve_college_name"
                                                        value="{{ isset($user->twelve_college_name) ? $user->twelve_college_name : old('twelve_college_name') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>Board<br> (बोर्ड) </label>
                                                    <input type="text" name="twelve_board" id="twelve_board"
                                                        value="{{ isset($user->twelve_board) ? $user->twelve_board : old('twelve_board') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>Reg/ Correspondence <br> (व्यवसायिक व पत्राचार)</label>
                                                    <select class="form-select" name="twelve_education_type">
                                                        <option value="">Select</option>
                                                        <option value="Regular"
                                                            @if (isset($user->twelve_education_type) && $user->twelve_education_type == 'Regular') selected @endif>
                                                            {{ 'Regular' }}</option>
                                                        <option value="Correspondence"
                                                            @if (isset($user->twelve_education_type) && $user->twelve_education_type == 'Correspondence') selected @endif>
                                                            {{ 'Correspondence' }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>Starting Year <br> (शुरू वर्ष)</label>
                                                    <select class="form-select" name="twelve_start_year">
                                                        <option value="">Select Start Year</option>
                                                        @for ($i = date('Y'); $i >= 1980; $i--)
                                                            <option value="{{ $i }}"
                                                                @if (isset($user->twelve_start_year) && $user->twelve_start_year == $i) selected @endif>
                                                                {{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>Passing Year <br> (उत्तीर्ण वर्ष)</label>
                                                    <select class="form-select" name="twelve_passing_year">
                                                        <option value="">Select Start Year</option>
                                                        @for ($i = date('Y'); $i >= 1980; $i--)
                                                            <option value="{{ $i }}"
                                                                @if (isset($user->twelve_passing_year) && $user->twelve_passing_year == $i) selected @endif>
                                                                {{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>%Percent <br> (प्रतिशत)</label>
                                                    <input type="number" name="twelve_score" id="twelve_score"
                                                        value="{{ isset($user->twelve_score) ? $user->twelve_score : old('twelve_score') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="mt-4">
                                        <legend class="educations">Any Other(Graduation)</legend>
                                        <div class="row mt-2">
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>College/Institution <br> (कॉलेज/विश्वविद्यालय) </label>
                                                    <input type="text" name="other_college_name"
                                                        value="{{ isset($user->other_college_name) ? $user->other_college_name : old('other_college_name') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>Reg/ Correspondence <br> (व्यवसायिक व पत्राचार)</label>
                                                    <select class="form-select" name="other_education_type">
                                                        <option value="">Select</option>
                                                        <option value="Regular"
                                                            @if (isset($user->other_education_type) && $user->other_education_type == 'Regular') selected @endif>
                                                            {{ 'Regular' }}</option>
                                                        <option value="Correspondence"
                                                            @if (isset($user->other_education_type) && $user->other_education_type == 'Correspondence') selected @endif>
                                                            {{ 'Correspondence' }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>Starting Year <br> (शुरू वर्ष)</label>
                                                    <select class="form-select" name="other_start_year">
                                                        <option value="">Select Start Year</option>
                                                        @for ($i = date('Y'); $i >= 1980; $i--)
                                                            <option value="{{ $i }}"
                                                                @if (isset($user->other_start_year) && $user->other_start_year == $i) selected @endif>
                                                                {{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>Passing Year <br> (उत्तीर्ण वर्ष)</label>
                                                    <select class="form-select" name="other_passing_year">
                                                        <option value="">Select Start Year</option>
                                                        @for ($i = date('Y'); $i >= 1980; $i--)
                                                            <option value="{{ $i }}"
                                                                @if (isset($user->other_passing_year) && $user->other_passing_year == $i) selected @endif>
                                                                {{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>%Percent <br> (प्रतिशत)</label>
                                                    <input type="number" name="other_score" id="other_score"
                                                        value="{{ isset($user->other_score) ? $user->other_score : old('other_score') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </fieldset>
                                <fieldset class="mt-4">
                                    <legend class="iti_legend">ITI Details (आई. टी. आई. विवरण)</legend>
                                    <div class="row mt-2">
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>ITI College (आई. टी. आई. कॉलेज)<span
                                                        class="requiredt">*</span></label>
                                                <input type="text" name="iti_college_name" id="iti_college_name"
                                                    value="{{ isset($user->iti_college_name) ? $user->iti_college_name : old('iti_college_name') }}"
                                                    class="form-control" required="">
                                                <span class="invalid-feedback d-none iti_college_name" role="alert">
                                                    <strong class="iti_college_name_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>ITI Location (स्थान)<span class="requiredt">*</span></label>
                                                <input type="text" name="iti_college_location"
                                                    value="{{ isset($user->iti_college_location) ? $user->iti_college_location : old('iti_college_location') }}"
                                                    id="iti_college_location" class="form-control" required="">
                                                <span class="invalid-feedback d-none iti_college_location" role="alert">
                                                    <strong class="iti_college_location_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>ITI Type (संस्थान)<span class="requiredt">*</span></label><br>
                                                <select class="form-select" name="iti_college_type" id="iti_college_type"
                                                    required="">
                                                    <option value="Private"
                                                        @if (isset($user->iti_college_type) && $user->iti_college_type == 'Private') selected @endif>
                                                        Private</option>
                                                    <option value="Government"
                                                        @if (isset($user->iti_college_type) && $user->iti_college_type == 'Government') selected @endif>
                                                        Government</option>
                                                </select>
                                                <span class="invalid-feedback d-none iti_college_type" role="alert">
                                                    <strong class="iti_college_type_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>ITI Council/ आईटीआई परिषद<span
                                                        class="requiredt">*</span></label><br>
                                                <select class="form-select" name="iti_board_type" id="iti_board_type"
                                                    required="">
                                                    <option value="NCVT"
                                                        @if (isset($user->iti_board_type) && $user->iti_board_type == 'NCVT') selected @endif>NCVT
                                                    </option>
                                                    <option value="SCVT"
                                                        @if (isset($user->iti_board_type) && $user->iti_board_type == 'SCVT') selected @endif>SCVT
                                                    </option>
                                                    <option value="SCVT tO NCVT"
                                                        @if (isset($user->iti_board_type) && $user->iti_board_type == 'SCVT tO NCVT') selected @endif>SCVT to NCVT
                                                    </option>
                                                </select>
                                                <span class="invalid-feedback d-none iti_board_type" role="alert">
                                                    <strong class="iti_board_type_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>Trade (ट्रेड)<span class="requiredt">*</span></label><br>
                                                <select class="form-select" name="iti_trade" id="iti_trade"
                                                    required="">
                                                    <option value="">Select Trade</option>
                                                    @foreach (companyTrades($user->company) as $trade)
                                                        <option value="{{ $trade->id }}"
                                                            @if ((isset($user->iti_trade) && $user->iti_trade == $trade->id) || $user->iti_trade == $trade->name) selected @endif>
                                                            {{ $trade->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="invalid-feedback d-none iti_trade" role="alert">
                                                    <strong class="iti_trade_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3 other_trade_wrapper" style="display: none;">
                                            <div class="form-group">
                                                <label>Other Trade <span class="requiredt">*</span></label>
                                                <input type="text" name="other_trade"
                                                    value="{{ isset($user->other_trade) ? $user->other_trade : old('other_trade') }}"
                                                    class="form-control other_trade">
                                                <span class="invalid-feedback d-none other_trade" role="alert">
                                                    <strong class="other_trade_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>ITI Passing Year/ आईटीआई पासिंग वर्ष <span
                                                        class="requiredt">*</span></label>
                                                <select class="form-select" required name="iti_passing_year"
                                                    id="iti_passing_year" class="form-control">
                                                    <option value="">Select Year</option>
                                                    @for ($i = date('Y'); $i >= 1980; $i--)
                                                        <option value="{{ $i }}"
                                                            @if (isset($user->iti_passing_year) && $user->iti_passing_year == $i) selected @endif>
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                                <span class="invalid-feedback d-none iti_passing_year" role="alert">
                                                    <strong class="iti_passing_year_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label>Percentage Score in ITI/ आईटीआई में प्रतिशत अंक <span
                                                        class="requiredt">*</span></label>
                                                <input type="number" name="iti_score" id="iti_score"
                                                    value="{{ isset($user->iti_score) ? $user->iti_score : old('iti_score') }}"
                                                    class="form-control" required="">
                                                <span class="invalid-feedback d-none iti_score" role="alert">
                                                    <strong class="iti_score_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-4">
                                    <legend style="    margin-top: -11px;">Apprenticeship (प्रशिक्षु)</legend>
                                    <div class="row mt-2">
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Apprenticeship<span class="requiredt">*</span></label><br>
                                                <select class="form-select" name="apprentice" id="apprentice"
                                                    required="">
                                                    <option value="NO"
                                                        @if (isset($user->apprentice) && $user->apprentice == 'NO') selected @endif>
                                                        NO
                                                    </option>
                                                    <option value="YES"
                                                        @if (isset($user->apprentice) && $user->apprentice == 'YES') selected @endif>
                                                        YES
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" id="apprentice_Wrapper" style="display: none;">
                                            <div class="col-md-4 mt-3">
                                                <div class="form-group">
                                                    <label>Company Name (संस्था का नाम)</label>
                                                    <input type="text" name="apprentice_company_name"
                                                        value="{{ isset($user->apprentice_company_name) ? $user->apprentice_company_name : old('apprentice_company_name') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <div class="form-group">
                                                    <label>Apprenticeship Start Date/ आरंभ तिथि</label>
                                                    <input type="text" name="apprentice_start_date"
                                                        value="{{ isset($user->apprentice_start_date) ? $user->apprentice_start_date : old('apprentice_start_date') }}"
                                                        class="form-control datepicker">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <div class="form-group">
                                                    <label>Apprenticeship End Date/ अंतिम तिथि</label>
                                                    <input type="text" name="apprentice_end_date"
                                                        value="{{ isset($user->apprentice_end_date) ? $user->apprentice_end_date : old('apprentice_end_date') }}"
                                                        class="form-control datepicker">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <div class="form-group">
                                                    <label>Location (स्थान)</label>
                                                    <input type="test" name="apprentice_location"
                                                        value="{{ isset($user->apprentice_location) ? $user->apprentice_location : old('apprentice_location') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <div class="form-group">
                                                    <label>Job Area/Shop (विभाग)</label>
                                                    <input type="text" name="apprentice_division"
                                                        value="{{ isset($user->apprentice_division) ? $user->apprentice_division : old('apprentice_division') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <div class="form-group">
                                                    <label>Salary per month /निर्धारित राशि प्रति मास</label>
                                                    <input type="number" name="apprentice_salary"
                                                        value="{{ isset($user->apprentice_salary) ? $user->apprentice_salary : old('apprentice_salary') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-4">
                                    <legend style="    margin-top: -11px;">Work Experience (कार्य अनुभव)</legend>
                                    <div class="row mt-2">
                                        <div class="col-md-3 mt-3">
                                            <div class="form-group">
                                                <label>Have You Work Experience?<span
                                                        class="requiredt">*</span></label><br>
                                                <select class="form-select" name="previous_company_work"
                                                    id="previous_company_work" required="">
                                                    <option value="0"
                                                        @if (isset($user->previous_company_work) && $user->previous_company_work == '0') selected @endif>
                                                        NO
                                                    </option>
                                                    <option value="1"
                                                        @if (isset($user->previous_company_work) && $user->previous_company_work == '1') selected @endif>YES
                                                    </option>
                                                </select>
                                                <span class="invalid-feedback d-none previous_company_work"
                                                    role="alert">
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
                                                                <input type="text"
                                                                    name="previous_company_start_date_two"
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
                                                                <select class="form-select"
                                                                    name="previous_company_type_two">
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
                                                                <input type="text"
                                                                    name="previous_company_start_date_three"
                                                                    value="{{ isset($user->previous_company_start_date_three) ? $user->previous_company_start_date_three : old('previous_company_start_date_three') }}"
                                                                    class="form-control datepicker">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                    name="previous_company_end_date_three"
                                                                    value="{{ isset($user->previous_company_end_date_three) ? $user->previous_company_end_date_three : old('previous_company_end_date_three') }}"
                                                                    class="form-control datepicker">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                    name="previous_company_location_three"
                                                                    value="{{ isset($user->previous_company_location_three) ? $user->previous_company_location_three : old('previous_company_location_three') }}"
                                                                    class="form-control">
                                                            </td>
                                                            <td>
                                                                <select class="form-select"
                                                                    name="previous_company_type_three">
                                                                    <option value="">Select Type</option>
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
                                                                <input type="text"
                                                                    name="previous_company_division_three"
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
                                {{-- Other Information --}}
                                <fieldset class="mt-4">
                                    <legend class=" other_information">Other Information (अतिरिक्त सूचना)</legend>
                                    <div class="row mt-2">
                                        <div class="row">
                                            <div class="col-md-4 ">
                                                <h4 class="filed_sub_heading">Computer Knowledge / (कंप्यूटर ज्ञान) : <span
                                                        class=" text-danger">*</span></h4>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="form-check-input"
                                                                {{ isset($user->msword) && $user->msword == 'YES' ? 'checked' : '' }}
                                                                id="msword" name="msword" value="YES">
                                                            <label for="msword" class="form-check-label">MS
                                                                Word</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="msexcel"
                                                                {{ isset($user->msexcel) && $user->msexcel == 'YES' ? 'checked' : '' }}
                                                                class="form-check-input" name="msexcel" value="YES">
                                                            <label for="msexcel" class="form-check-label">MS
                                                                Excel</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="internet"
                                                                {{ isset($user->internet) && $user->internet == 'YES' ? 'checked' : '' }}
                                                                class="form-check-input" name="internet" value="YES">
                                                            <label for="internet"
                                                                class="form-check-label">Internet</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="basic"
                                                                {{ isset($user->basic) && $user->basic == 'YES' ? 'checked' : '' }}
                                                                class="form-check-input" name="basic" value="YES">
                                                            <label for="basic"
                                                                class="form-check-label">Basic</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="nil"
                                                                {{ isset($user->nil) && $user->nil == 'YES' ? 'checked' : '' }}
                                                                class="form-check-input" name="nil" value="YES">
                                                            <label for="nil" class="form-check-label">Nil</label><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label>Are you physically
                                                    handicapped/&nbsp;क्या आप
                                                    शारीरिक
                                                    रूप से विकलांग हैंा? </label><br>
                                                <select class="form-select" name="physically_handicapped"
                                                    id="physically_handicapped">
                                                    <option value="NO"
                                                        @if (isset($user->physically_handicapped) && $user->physically_handicapped == 'NO') selected @endif>NO
                                                        (ना)</option>
                                                    <option value="YES"
                                                        @if (isset($user->physically_handicapped) && $user->physically_handicapped == 'YES') selected @endif>
                                                        YES (हाँ)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label>Do you know four wheeler driving? / क्या आप चार पहिये वाली गाड़ी चलाना
                                                    जानते
                                                    हैं : </label>
                                                <select class="form-select" name="car_driving" id="car_driving">
                                                    <option value="NO"
                                                        @if (isset($user->car_driving) && $user->car_driving == 'NO') selected @endif>NO
                                                        (ना)
                                                    </option>
                                                    <option value="YES"
                                                        @if (isset($user->car_driving) && $user->car_driving == 'YES') selected @endif>YES
                                                        (हाँ)
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3 physically_handicapped_detail" style="display: none;">
                                            <div class="form-group">
                                                <label>If you are handicapped, then give further information /अगर आप विकलांग
                                                    हैं तो
                                                    और
                                                    जानकारी दें </label>
                                                <input type="text" name="physically_handicap_information"
                                                    value="{{ isset($user->physically_handicap_information) ? $user->physically_handicap_information : old('physically_handicap_information') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3 car_driving_detail" style="display: none;">
                                            <div class="form-group">
                                                <label>Driving Licence No / लाइसेंस नंबर:</label><br>
                                                <input type="text" name="driving_license"
                                                    value="{{ isset($user->driving_license) ? $user->driving_license : old('driving_license') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label> Are you a patient of epilepsy/or taking medicine related to
                                                    epilepsy? क्या
                                                    आप मिर्गी के रोगी हैं/या मिर्गी से संबंधित कोई दवाई ले रहे हैं?
                                                    (Yes/No)? <span class=" text-danger">*</span></label>
                                                <select class="form-select" name="epilepsy" id="epilepsy">
                                                    <option value="NO"
                                                        @if (isset($user->epilepsy) && $user->epilepsy == 'NO') selected @endif>NO
                                                        (ना)</option>
                                                    <option value="YES"
                                                        @if (isset($user->epilepsy) && $user->epilepsy == 'YES') selected @endif>
                                                        YES (हाँ)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <div class="form-group">
                                                <label>Details of any past major surgery / illness requiring hospitalisation
                                                    or long
                                                    treatment /किसी भी पिछली बड़ी सर्जरी / बीमारी का विवरण जिसमें अस्पताल
                                                    में भर्ती
                                                    या
                                                    लंबे उपचार की आवश्यकता होती है</label>
                                                <input type="text" name="detail_of_past_surgery"
                                                    value="{{ isset($user->detail_of_past_surgery) ? $user->detail_of_past_surgery : old('detail_of_past_surgery') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="form-group">
                                                <label>Have you ever been declared Medically Unfit? / क्या आपको कभी
                                                    चिकित्सकीय रूप
                                                    से अनफिट घोषित किया गया है? </label>
                                                <input type="text" name="medically_unfit"
                                                    value="{{ isset($user->medically_unfit) ? $user->medically_unfit : old('medically_unfit') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <hr class="">
                                            <h4 class="sub_heading">Have you applied to MSIL earlier / क्या आपने पहले MSIL
                                                में
                                                आवेदन किया है? <span class="text-danger">*</span></h4>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-select" name="have_you_applied"
                                                    id="have_you_applied">
                                                    <option value="NO"
                                                        @if (isset($user->have_you_applied) && $user->have_you_applied == 'NO') selected @endif>
                                                        NO
                                                    </option>
                                                    <option value="YES"
                                                        @if (isset($user->have_you_applied) && $user->have_you_applied == 'YES') selected @endif>YES
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3 have_you_applied_wrapper d-none">
                                            <p class=" mb-0 pb-0 heading-color">When and where have you applied to this
                                                company?/
                                                तो कब और कहाँ?</p>
                                            <input type="text" name="applied_before"
                                                value="{{ isset($user->applied_before) ? $user->applied_before : old('applied_before') }}"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <hr class="">
                                            <h4 class="sub_heading">Have you worked with MSIL earlier /क्या आपने पहले
                                                मारुति
                                                सुजुकी/एसएमजी
                                                के साथ काम किया है? यदि हां, तो कृपया अपना विवरण दें। <span
                                                    class="text-danger">*</span></h4>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select class="form-select" name="already_worked" id="already_worked"
                                                    required="">
                                                    <option value="NO"
                                                        @if (isset($user->already_worked) && $user->already_worked == 'NO') selected @endif>
                                                        NO
                                                    </option>
                                                    <option value="YES"
                                                        @if (isset($user->already_worked) && $user->already_worked == 'YES') selected @endif>YES
                                                    </option>
                                                </select>
                                                <span class="invalid-feedback d-none already_worked" role="alert">
                                                    <strong class="already_worked_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row mt-3" id="already_worked_wrapper" style="display: none;">
                                            <div class="col-md-3 mt-1">
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <select class="form-select" name="already_worked_category"
                                                        id="already_worked_category">
                                                        <option value="">Select Category</option>
                                                        <option value="TW- Temporary Worker"
                                                            @if (isset($user->already_worked_category) && $user->already_worked_category == 'TW- Temporary Worker') selected @endif>
                                                            TW- Temporary Worker
                                                        </option>
                                                        <option value="CW- Contract Worker"
                                                            @if (isset($user->already_worked_category) && $user->already_worked_category == 'CW- Contract Worker') selected @endif>
                                                            CW- Contract Worker
                                                        </option>
                                                        <option value="Fixed Term Employee"
                                                            @if (isset($user->already_worked_category) && $user->already_worked_category == 'Fixed Term Employee') selected @endif>
                                                            Fixed Term Employee
                                                        </option>
                                                        <option value="Apprenticeship"
                                                            @if (isset($user->already_worked_category) && $user->already_worked_category == 'Apprenticeship') selected @endif>
                                                            Apprenticeship
                                                        </option>
                                                        <option value="ST- Student Trainee"
                                                            @if (isset($user->already_worked_category) && $user->already_worked_category == 'ST- Student Trainee') selected @endif>
                                                            ST- Student Trainee
                                                        </option>
                                                    </select>
                                                    <span class="invalid-feedback d-none already_worked" role="alert">
                                                        <strong class="already_worked_msg"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-1">
                                                <div class="form-group">
                                                    <label>Staff ID</label>
                                                    <input type="text" name="already_worked_staff_id"
                                                        value="{{ isset($user->already_worked_staff_id) ? $user->already_worked_staff_id : old('already_worked_staff_id') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-1">
                                                <div class="form-group">
                                                    <label>Time Period</label>
                                                    <input type="text" name="already_worked_time_period"
                                                        value="{{ isset($user->already_worked_time_period) ? $user->already_worked_time_period : old('already_worked_time_period') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-1">
                                                <div class="form-group">
                                                    <label>Shop & Location</label>
                                                    <input type="text" name="already_worked_shop_location"
                                                        value="{{ isset($user->already_worked_shop_location) ? $user->already_worked_shop_location : old('already_worked_shop_location') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <hr class="">
                                            <h4 class="sub_heading">Do you know anyone in Maruti Suzuki? Please give
                                                details. / यदि आप मारुति सुज़ूकी कंपनी में किसी को पहले से जानते है तो उस
                                                व्यक्ति
                                                का विवरण दीजिये <span class="text-danger">*</span></h4>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select class="form-select" name="already_know" id="already_know"
                                                    required="">
                                                    <option value="NO"
                                                        @if (isset($user->already_know) && $user->already_know == 'NO') selected @endif>
                                                        NO
                                                    </option>
                                                    <option value="YES"
                                                        @if (isset($user->already_know) && $user->already_know == 'YES') selected @endif>YES
                                                    </option>
                                                </select>
                                                <span class="invalid-feedback d-none already_know" role="alert">
                                                    <strong class="already_know_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row mt-4 mb-3 " id="already_know_wrapper" style="display: none;">
                                            <div class="col-md-3 mt-1">
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input type="text" name="already_know_full_name"
                                                        value="{{ isset($user->already_know_full_name) ? $user->already_know_full_name : old('already_know_full_name') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-1">
                                                <div class="form-group">
                                                    <label>Department</label>
                                                    <input type="text" name="already_know_department"
                                                        value="{{ isset($user->already_know_department) ? $user->already_know_department : old('already_know_department') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2 mt-1">
                                                <div class="form-group">
                                                    <label>Work Location</label>
                                                    <input type="text" name="already_know_location"
                                                        value="{{ isset($user->already_know_location) ? $user->already_know_location : old('already_know_location') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2 mt-1">
                                                <div class="form-group">
                                                    <label>Mobile</label>
                                                    <input type="number" name="already_know_mobile"
                                                        value="{{ isset($user->already_know_mobile) ? $user->already_know_mobile : old('already_know_mobile') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2 mt-1">
                                                <div class="form-group">
                                                    <label>Relation</label>
                                                    <input type="text" name="already_know_relation"
                                                        value="{{ isset($user->already_know_relation) ? $user->already_know_relation : old('already_know_relation') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-4">
                                    <legend class="document">Documents</legend>
                                    <div class="row mt-2">
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label>Passport size Photo / पासपोर्ट साइज फोटो <span
                                                        class="requiredt">*</span></label>
                                                <input type="file" name="passport_photo" id="passport_photo" accept="image/*" class="form-control">
                                                @if (isset($user->passport_photo))
                                                    <div class=" d-flex justify-content-between">
                                                        <div class="form-text text-success mt-0">File already uploaded!
                                                        </div>
                                                        <div>
                                                            <a href="javascript:void(0);" onclick="image_preview(this)"
                                                                src="{{ getImage($user->passport_photo) }}">View
                                                                Document</a>
                                                        </div>
                                                    </div>
                                                @endif
                                                <span class="invalid-feedback d-none passport_photo" role="alert">
                                                    <strong class="passport_photo_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label>10th Certificate / 10 वां प्रमाण पत्र <span
                                                        class="requiredt">*</span></label>
                                                <input type="file" name="tenth_certificate" id="tenth_certificate" accept="image/*" class="form-control">
                                                @if (isset($user->tenth_certificate))
                                                    <div class=" d-flex justify-content-between">
                                                        <div class="form-text text-success mt-0">File already uploaded!
                                                        </div>
                                                        <div>
                                                            <a href="javascript:void(0);" onclick="image_preview(this)"
                                                                src="{{ getImage($user->tenth_certificate) }}">View
                                                                Document</a>
                                                        </div>
                                                    </div>
                                                @endif
                                                <span class="invalid-feedback d-none tenth_certificate" role="alert">
                                                    <strong class="tenth_certificate_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label>12th Certificate / 12 वां प्रमाण पत्र <span
                                                        class="requiredt">*</span></label>
                                                <input type="file" name="twelve_certificate" id="twelve_certificate" accept="image/*" class="form-control">
                                                @if (isset($user->twelve_certificate))
                                                    <div class=" d-flex justify-content-between">
                                                        <div class="form-text text-success mt-0">File already uploaded!
                                                        </div>
                                                        <div>
                                                            <a href="javascript:void(0);" onclick="image_preview(this)"
                                                                src="{{ getImage($user->twelve_certificate) }}">View
                                                                Document</a>
                                                        </div>
                                                    </div>
                                                @endif
                                                <span class="invalid-feedback d-none twelve_certificate" role="alert">
                                                    <strong class="twelve_certificate_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label>ITI Certificate / ITI प्रमाण पत्र <span
                                                        class="requiredt">*</span></label>
                                                <input type="file" name="iti_certificate" id="iti_certificate" accept="image/*" class="form-control">
                                                @if (isset($user->iti_certificate))
                                                    <div class=" d-flex justify-content-between">
                                                        <div class="form-text text-success mt-0">File already uploaded!
                                                        </div>
                                                        <div>
                                                            <a href="javascript:void(0);" onclick="image_preview(this)"
                                                                src="{{ getImage($user->iti_certificate) }}">View
                                                                Document</a>
                                                        </div>
                                                    </div>
                                                @endif
                                                <span class="invalid-feedback d-none iti_certificate" role="alert">
                                                    <strong class="iti_certificate_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label>Aadhar Card (Front)/ आधार कार्ड <span
                                                        class="requiredt">*</span></label>
                                                <input type="file" name="aadhar_card_front" id="aadhar_card_front" accept="image/*" class="form-control">
                                                @if (isset($user->aadhar_card_front))
                                                    <div class=" d-flex justify-content-between">
                                                        <div class="form-text text-success mt-0">File already uploaded!
                                                        </div>
                                                        <div>
                                                            <a href="javascript:void(0);" onclick="image_preview(this)"
                                                                src="{{ getImage($user->aadhar_card_front) }}">View
                                                                Document</a>
                                                        </div>
                                                    </div>
                                                @endif
                                                <span class="invalid-feedback d-none aadhar_card_front" role="alert">
                                                    <strong class="aadhar_card_front_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label>Aadhar Card (Back)/ आधार कार्ड <span
                                                        class="requiredt">*</span></label>
                                                <input type="file" name="aadhar_card_back" id="aadhar_card_back" accept="image/*" class="form-control">
                                                @if (isset($user->aadhar_card_back))
                                                    <div class=" d-flex justify-content-between">
                                                        <div class="form-text text-success mt-0">File already uploaded!
                                                        </div>
                                                        <div>
                                                            <a href="javascript:void(0);" onclick="image_preview(this)"
                                                                src="{{ getImage($user->aadhar_card_back) }}">View
                                                                Document</a>
                                                        </div>
                                                    </div>
                                                @endif
                                                <span class="invalid-feedback d-none aadhar_card_back" role="alert">
                                                    <strong class="aadhar_card_back_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label>PAN Card (Front)/ पैन कार्ड <span
                                                        class="requiredt">*</span></label>
                                                <input type="file" name="pan_card" id="pan_card" accept="image/*" class="form-control">
                                                @if (isset($user->pan_card))
                                                    <div class=" d-flex justify-content-between">
                                                        <div class="form-text text-success mt-0">File already uploaded!
                                                        </div>
                                                        <div>
                                                            <a href="javascript:void(0);" onclick="image_preview(this)"
                                                                src="{{ getImage($user->pan_card) }}">View Document</a>
                                                        </div>
                                                    </div>
                                                @endif
                                                <span class="invalid-feedback d-none pan_card" role="alert">
                                                    <strong class="pan_card_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-4">
                                    <legend style="margin-top:-13px; ">Eligible Status</legend>
                                    <div class="row mt-2">
                                        <div class="col-md-12 " id="eligibility_status_wrapper">
                                            <div class="row">
                                                <div class="col-md-4 mt-3">
                                                    <div class="form-group">
                                                        <label>Eligibility </label>
                                                        <select class="single-select select2" name="eligibility"
                                                            id="eligibilityStatus">
                                                            <option value="">Select Eligibility</option>
                                                            <option value="Eligible"
                                                                @if ($user->eligibility == 'Eligible') selected @endif>Eligible
                                                            </option>
                                                            @if ($user->assessment == '0')
                                                                <option value="Not Eligible"
                                                                    @if ($user->eligibility == 'Not Eligible') selected @endif>Not
                                                                    Eligible
                                                                </option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mt-3  not_eligibility_wrapper d-none">
                                                    <div class="form-group">
                                                        <label>Not Eligible Reason</label>
                                                        <select class="single-select select2" name="not_eligibility">
                                                            <option value="">Select One Reason</option>
                                                            <option value="Overage"
                                                                @if ($user->not_eligibility == 'Overage') selected @endif>Overage
                                                            </option>
                                                            <option value="Documents mismatch"
                                                                @if ($user->not_eligibility == 'Documents mismatch') selected @endif>
                                                                Documents mismatch</option>
                                                            <option value="Wrong information"
                                                                @if ($user->not_eligibility == 'Wrong information') selected @endif>Wrong
                                                                information</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-4">
                                    <legend style=" margin-top: -5px;">Confirm & Submit</legend>
                                    <div class="row mt-2">
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input radius-4" name="i_agree"
                                                        type="checkbox"
                                                        {{ isset($user->agreed) && $user->agreed == 'YES' ? 'checked' : '' }}>
                                                    <label for="i_agree"> I hereby declare that the particulars given
                                                        above are true to the best of my knowledge and
                                                        belief. Nothing has been hidden or falsely stated above.  If, at any
                                                        stage of recruitment it is
                                                        found that I have hidden any facts/ information or if any
                                                        information provided by me is
                                                        found misleading / incorrect, then company may cancel my candidature
                                                        and may take
                                                        appropriate legal action against me, for which I will be solely
                                                        responsible. I understand that
                                                        my appointment in the company services will be subject to my passing
                                                        the assessment test,
                                                        personal interview and medical examination. <br>
                                                        मैं एतद्द्वारा घोषणा करता हूं कि ऊपर दिए गए विवरण मेरे सर्वोत्तम
                                                        ज्ञान और विश्वास के अनुसार सत्य हैं। ऊपर प्रदान
                                                        की गई जानकारी में कुछ भी छिपाया नहीं गया है एवं ना ही कोई जानकारी
                                                        भ्रामक/गलत प्रदान की गई है। भर्ती के
                                                        किसी भी चरण में यदि यह पाया जाता है कि मैंने कोई तथ्य/जानकारी छुपाई
                                                        है या मेरे द्वारा प्रदान की गई कोई भी
                                                        जानकारी भ्रामक/गलत पाई जाती है, तो कंपनी मेरी उम्मीदवारी को रद्द कर
                                                        सकती है और मेरे खिलाफ उचित कानूनी
                                                        कार्रवाई कर सकती है, जिसके लिए मैं पूरी तरह जिम्मेदार होउगा। मैं
                                                        समझता हूं कि कंपनी की सेवाओं में मेरी नियुक्ति
                                                        मेरे द्वारा असेसमेंट  (Assessment) परीक्षा, व्यक्तिगत साक्षात्कार और
                                                        चिकित्सा परीक्षा उत्तीर्ण करने के अधीन होगी।</label>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-primary text-white radius-2 mt-3">Update
                                                    Detail</button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/picker.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/picker.date.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
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
            });
            $('#iti_trade').on('change', function() {
                let val = $("#iti_trade option:selected").text();
                val = val.trim();
                if (val == 'Other') {
                    $('.other_trade_wrapper').show();
                } else {
                    $('.other_trade').val('');
                    $('.other_trade_wrapper').hide();
                }
            });
            $('#previous_company_work').change(function() {
                if ($(this).val() == 'YES') {
                    $('#Work_Experience_Wrapper').show();
                } else {
                    $('#Work_Experience_Wrapper').hide();
                }
            });
            $('#already_worked').change(function() {
                if ($(this).val() == 'YES') {
                    $('#already_worked_wrapper').show();
                } else {
                    $('#already_worked_wrapper').hide();
                }
            });
            $('#already_know').change(function() {
                if ($(this).val() == 'YES') {
                    $('#already_know_wrapper').show();
                } else {
                    $('#already_know_wrapper').hide();
                }
            });
            $('#apprentice').change(function() {
                if ($(this).val() == 'YES') {
                    $('#apprentice_Wrapper').show();
                } else {
                    $('#apprentice_Wrapper').hide();
                }
            });
            $('#have_you_applied').change(function() {
                if ($(this).val() == 'YES') {
                    $('.have_you_applied_wrapper').removeClass('d-none');
                } else {
                    $('.have_you_applied_wrapper').addClass('d-none');
                }
            });
            $('#physically_handicapped').change(function() {
                if ($(this).val() == 'YES') {
                    $('.physically_handicapped_detail').show();
                } else {
                    $('.physically_handicapped_detail').hide();
                }
            });
            $('#car_driving').change(function() {
                if ($(this).val() == 'YES') {
                    $('.car_driving_detail').show();
                } else {
                    $('.car_driving_detail').hide();
                }
            });
            $('#nil').change(function() {
                if ($('#nil').prop('checked') == true) {
                    $('#msword').prop('checked', false);
                    $('#msexcel').prop('checked', false);
                    $('#internet').prop('checked', false);
                    $('#basic').prop('checked', false);
                }
            });
            $('#msword').change(function() {
                if ($('#msword').prop('checked') == true) {
                    $('#nil').prop('checked', false);
                }
            });
            $('#msword').change(function() {
                if ($('#msword').prop('checked') == true) {
                    $('#nil').prop('checked', false);
                }
            });
            $('#msexcel').change(function() {
                if ($('#msexcel').prop('checked') == true) {
                    $('#nil').prop('checked', false);
                }
            });
            $('#internet').change(function() {
                if ($('#internet').prop('checked') == true) {
                    $('#nil').prop('checked', false);
                }
            });
            $('#basic').change(function() {
                if ($('#basic').prop('checked') == true) {
                    $('#nil').prop('checked', false);
                }
            });
            if ($('#nil').prop('checked') == true) {
                $('#msword').prop('checked', false);
                $('#msexcel').prop('checked', false);
                $('#internet').prop('checked', false);
                $('#basic').prop('checked', false);
            }
            $('.single-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ?
                    '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
            $('#present_state').on('change', function() {
                var idState = this.value;
                var present_district_id =
                    "{{ isset($user->present_district) && $user->present_district ? $user->present_district : '' }}";
                $("#present_district").html('<option value="">Fetching Districts</option>');
                $.ajax({
                    url: "{{ url('fetch-districts') }}/" + idState,
                    type: "get",
                    dataType: 'json',
                    success: function(res) {
                        $("#present_district").html('');
                        var option = `<option value="">Select District</option>`;
                        $.each(res.data, function(key, value) {
                            if (value.id == present_district_id) {
                                option +=
                                    `<option value="${value.id}" selected>${value.name}</option>`;
                            } else {
                                option +=
                                    `<option value="${value.id}">${value.name}</option>`;
                            }
                        });
                        $("#present_district").append(option);
                        if ($('#same_address').prop("checked") == true) {
                            $('#present_district').val($('#permanent_district').val()).change();
                            $('#present_district').attr("disabled", true);
                        }
                    }
                });
            });
            $('#permanent_state').on('change', function() {
                var idState = this.value;
                var permanent_district =
                    "{{ isset($user->permanent_district) && $user->permanent_district ? $user->permanent_district : '' }}";
                $("#permanent_district").html('<option value="">Fetching Districts</option>');
                $.ajax({
                    url: "{{ url('fetch-districts') }}/" + idState,
                    type: "get",
                    dataType: 'json',
                    success: function(res) {
                        $("#permanent_district").html('');
                        var option = `<option value="">Select District</option>`;
                        $.each(res.data, function(key, value) {
                            if (value.id == permanent_district) {
                                option +=
                                    `<option value="${value.id}" selected>${value.name}</option>`;
                            } else {
                                option +=
                                    `<option value="${value.id}">${value.name}</option>`;
                            }
                        });
                        $("#permanent_district").append(option);
                    }
                });
            });
            $('#tenth_score').on('keypress', (event) => {
                if ($('#tenth_score').val().split('.')[1].length == 2) {
                    event.preventDefault();
                    return false;
                }
            });
            $('#iti_score').on('keypress', (event) => {
                if ($('#iti_score').val().split('.')[1].length == 2) {
                    event.preventDefault();
                    return false;
                }
            });
            $('#other_score').on('keypress', (event) => {
                if ($('#other_score').val().split('.')[1].length == 2) {
                    event.preventDefault();
                    return false;
                }
            });
            $('#twelve_score').on('keypress', (event) => {
                if ($('#twelve_score').val().split('.')[1].length == 2) {
                    event.preventDefault();
                    return false;
                }
            });
            // same as address
            $('#same_address').click(function() {
                if ($(this).prop("checked") == true) {
                    $('#present_pincode').val($('#permanent_pincode').val());
                    $('#present_pincode').prop('readonly', true);
                    $('#present_state').val($('#permanent_state').val()).change();
                    $('#present_state').attr("disabled", true);
                    $('#present_district').val($('#permanent_district').val()).change();
                    $('#present_district').attr("disabled", true);
                    $('#present_house_street_village').val($('#permanent_house_street_village').val());
                    $('#present_house_street_village').prop('readonly', true);
                    $('#present_house_number').val($('#permanent_house_number').val());
                    $('#present_house_number').prop('readonly', true);
                } else if ($(this).prop("checked") == false) {
                    $('#present_pincode').val('');
                    $('#present_pincode').prop('readonly', false);
                    $('#present_state').val('').change();
                    $('#present_state').attr("disabled", false);
                    $('#present_district').val('').change();
                    $('#present_district').attr("disabled", false);
                    $('#present_house_street_village').val('');
                    $('#present_house_street_village').prop('readonly', false);
                    $('#present_house_number').val('');
                    $('#present_house_number').prop('readonly', false);
                }
            });
            $('#userForm').validate({
                // ignore: "input[type='file']",
                rules: {
                    first_name: {
                        required: true,
                        notEqualTo: ['#last_name', '#middle_name']
                    },
                    last_name: {
                        notEqualTo: ['#middle_name', '#first_name']
                    },
                    middle_name: {
                        notEqualTo: ['#last_name', '#first_name']
                    },
                    alternative_number: {
                        number: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    already_know_mobile: {
                        number: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    phone_number: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    aadhar_card: {
                        required: true,
                        digits: true,
                        minlength: 12,
                        maxlength: 12
                    },
                    permanent_pincode: {
                        required: true,
                        digits: true,
                        minlength: 6,
                        maxlength: 6
                    },
                    present_pincode: {
                        required: true,
                        digits: true,
                        minlength: 6,
                        maxlength: 6
                    },
                    other_score: {
                        digits: true,
                        max: 100
                    },
                    twelve_score: {
                        max: 100
                    },
                    tenth_score: {
                        required: true,
                        min: 1,
                        max: 100
                    },
                    iti_score: {
                        required: true,
                        min: 1,
                        max: 100
                    },
                    father_age: {
                        min: 0,
                        max: 99,
                        digits: true,
                    },
                    mother_age: {
                        min: 0,
                        max: 99,
                        digits: true,
                    },
                    wife_age: {
                        min: 0,
                        max: 99,
                        digits: true,
                    },
                    s1sage: {
                        min: 0,
                        max: 99,
                        digits: true,
                    },
                    s2sage: {
                        min: 0,
                        max: 99,
                        digits: true,
                    },
                    s3sage: {
                        min: 0,
                        max: 99,
                        digits: true,
                    },
                    child1sage: {
                        min: 0,
                        max: 99,
                        digits: true,
                    },
                    child2sage: {
                        min: 0,
                        max: 99,
                        digits: true,
                    },
                    child3sage: {
                        min: 0,
                        max: 99,
                        digits: true,
                    },
                    pan_card: {
                        accept: "image/jpeg, image/pjpeg, image/jpeg,image/png",
                    },
                    aadhar_card_back: {
                        accept: "image/jpeg, image/pjpeg, image/jpeg,image/png",
                    },
                    aadhar_card_front: {
                        accept: "image/jpeg, image/pjpeg, image/jpeg,image/png",
                    },
                    iti_certificate: {
                        accept: "image/jpeg, image/pjpeg, image/jpeg,image/png",
                    },
                    twelve_certificate: {
                        accept: "image/jpeg, image/pjpeg, image/jpeg,image/png",
                    },
                    tenth_certificate: {
                        accept: "image/jpeg, image/pjpeg, image/jpeg,image/png",
                    },
                    passport_photo: {
                        accept: "image/jpeg, image/pjpeg, image/jpeg,image/png",
                    },
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    // form.submit();
                    if (panFormat() == true) {
                        var formData = new FormData(form);
                        if ($('#present_district').prop("disabled") == true) {
                            formData.append('present_district', $('#present_district').val());
                        }
                        if ($('#present_state').prop("disabled") == true) {
                            formData.append('present_state', $('#present_state').val());
                        }
                        $.ajax({
                            url: "{{ route('admin.update-candidate-detail') }}",
                            type: "POST",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend: function() {
                                $(".loader-wrapper").removeClass("d-none");
                                $('.success_message').html(
                                    'Form are submitting please wait....');
                                $('#save_detail').prop("disabled", true);
                            },
                            complete: function() {
                                $(".loader-wrapper").addClass("d-none");
                                $('.success_message').html('Exporting to excel');
                                $('#save_detail').prop("disabled", false);
                            },

                            success: function(response) {
                                if (response.status == true) {
                                    if (response.success_input) {
                                        $.each(response.success_input, function(key,value) {
                                            $('#' + value).removeClass('is-invalid');
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
                                    }).then(()=>{
                                        document.getElementById("userForm").reload();
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
                                });
                                // .then(() => {
                                //     location.relode();
                                // });
                            }
                        });
                    }
                },
                highlight: function(element) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element) {
                    $(element).removeClass("is-invalid");
                },
            });
            $.validator.addMethod("notEqualTo",
                function(value, element, param) {
                    var notEqual = true;
                    value = $.trim(value);
                    for (i = 0; i < param.length; i++) {
                        if (value == $.trim($(param[i]).val())) {
                            notEqual = false;
                        }
                    }
                    return this.optional(element) || notEqual;
                },
                "Please enter a diferent value."
            );
            $.validator.addMethod("valDomain", function(nname) {
                name = nname.replace('http://', '');
                nname = nname.replace('https://', '');
                var arr = ['gmail.com', 'yahoo.com', 'outlook.com', 'icloud.com', 'hotmail.com'];
                var mai = nname;
                var val = true;
                var dot = mai.lastIndexOf("@") + 1;
                var dname = mai.substring(0, dot);
                var ext = mai.substring(dot, mai.length);
                console.log($.inArray(ext, arr));
                if ($.inArray(ext, arr) == -1) {
                    return false;
                } else {
                    return true;
                }
                return true;
            }, 'Invalid/Wrong Email Address.Please Enter Correct Email id.');

            
            @if (isset($user->id) && isset($user->permanent_state))
                $('#present_state').change();
                $('#permanent_state').change();
                $('#physically_handicapped').change();
                $('#car_driving').change();
                $('#have_you_applied').change();
            @endif
            $('#eligibilityStatus').on('change', function() {
                var value = $(this).val();
                if (value == 'Eligible') {
                    $('.not_eligibility_wrapper').addClass('d-none');
                } else if (value == 'Not Eligible') {
                    $('.not_eligibility_wrapper').removeClass('d-none');
                } else if (value == '' || value == null) {
                    $('.not_eligibility_wrapper').addClass('d-none');
                }
            });
            $('.form-select').change();
            $('.select2').change();
        });

        function panFormat() {
            var txtPANCard = document.getElementById("pancard");
            if (txtPANCard != '') {
                var regex = /([A-Z]){5}([0-9]){4}([A-Z]){1}$/;
                if (regex.test(txtPANCard.value.toUpperCase())) {
                    $('#pancard').removeClass('is-invalid');
                    $('.pancard').addClass('d-none');
                    $('.pancard_msg').html('');
                    return true;
                } else {
                    $('#pancard').addClass('is-invalid');
                    $('.pancard').removeClass('d-none');
                    $('.pancard_msg').html('Invalid pan card format');
                    $('#pancard').focus();
                    return false;
                }
            } else {
                return true;
            }
        }

        function ValidatePAN() {
            var txtPANCard = document.getElementById("pancard");
            if (txtPANCard != '') {
                var regex = /([A-Z]){5}([0-9]){4}([A-Z]){1}$/;
                if (regex.test(txtPANCard.value.toUpperCase())) {
                    $('#pancard').removeClass('is-invalid');
                    $('.pancard').addClass('d-none');
                    $('.pancard_msg').html('');
                } else {
                    $('#pancard').addClass('is-invalid');
                    $('.pancard').removeClass('d-none');
                    $('.pancard_msg').html('Invalid pan card format');
                }
            } else {
                return true;
            }
        }
    </script>
@endsection
