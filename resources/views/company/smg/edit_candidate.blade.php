@extends('layouts.admin_app')
@section('style')
    <link href="{{ asset('public/assets/plugins/datetimepicker/css/classic.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/datetimepicker/css/classic.date.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href=" {{ asset('public/assets/css/form_2.css') }}">
@endsection


@section('wrapper')
    <div class="page-wrapper ">
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
            <div class="container py-1 bg-white radius-10 ">
                <div class="col-md-12">
                    <h5 class=" form_type_heading text-center">Candidate Registration Form ({{ $user->getFormCategory->title }})
                    </h5>
                </div>
                <ul class="nav nav-pills steppers-list mb-1 mt-2" id="pills-tab" role="tablist">
                    <li class="nav-item mt-1" role="presentation">
                        <button class="nav-link  active btn btn-sm " id="pills-personal-detail-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-personal-detail" type="button" role="tab"
                            aria-controls="pills-personal-detail" aria-selected="true">Personal Detail</button>
                    </li>
                    <li class="nav-item mt-1" role="presentation">
                        <button class="nav-link btn btn-sm " id="pills-family-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-family" type="button" role="tab"
                            aria-controls="pills-family" aria-selected="true">Family Detail</button>
                    </li>
                    <li class="nav-item mt-1" role="presentation">
                        <button class="nav-link btn btn-sm" id="pills-address-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-address" type="button" role="tab" aria-controls="pills-address"
                            aria-selected="false">Address</button>
                    </li>
                    <li class="nav-item mt-1" role="presentation">
                        <button class="nav-link btn btn-sm" id="pills-education-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-education" type="button" role="tab" aria-controls="pills-education"
                            aria-selected="false">Education Details</button>
                    </li>
                    <li class="nav-item mt-1" role="presentation">
                        <button class="nav-link btn  btn-sm" id="pills-work-experience-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-work-experience" type="button" role="tab"
                            aria-controls="pills-work-experience" aria-selected="false">Work Experience</button>
                    </li>
                    <li class="nav-item mt-1" role="presentation">
                        <button class="nav-link btn btn-sm" id="pills-other-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-other" type="button" role="tab" aria-controls="pills-other"
                            aria-selected="false">Other Information</button>
                    </li>
                    <li class="nav-item mt-1" role="presentation">
                        <button class="nav-link btn btn-sm" id="pills-document-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-document" type="button" role="tab" aria-controls="pills-document"
                            aria-selected="false">Doc & Submit</button>
                    </li>
                    <li class="nav-item mt-1" role="presentation">
                        <button class="nav-link btn btn-sm" id="pills-eligibility-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-eligibility" type="button" role="tab" aria-controls="pills-eligibility"
                            aria-selected="false">Eligibility</button>
                    </li>
                </ul>
                <div class="tab-content mt-0" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-personal-detail" role="tabpanel"
                        aria-labelledby="pills-personal-detail-tab">
                        <form id="personal_detail" data-url="{{ route('store-personal-detail') }}">
                            <input type="hidden" value="EDIT" name="op_type">
                            <input type="hidden" value="{{$user->id}}" name="user_id">
                            <input type="hidden" value="{{$user->email}}" name="email_id">
                            <fieldset class=" mt-1">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Position Applied for<span class="text-danger">*</span></label>
                                            <select name="form_category" class="select-2 form-select" id="form_category"
                                                required>
                                                <option value="">Select Position</option>
                                                @foreach (getCompanyRgCategories($user->company) as $cat)
                                                    <option value="{{ $cat->id }}" @selected($user->form_category == $cat->id)>
                                                        {{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="invalid-feedback form_category d-none" role="alert">
                                                <strong class="form_category_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name Of ITI<span class="text-danger">*</span></label>
                                            <input type="text" value="{{ $user->iti_college_name }}"
                                                class=" form-control" name="iti_college_name" id="iti_college_name"
                                                required>
                                            <span class="invalid-feedback iti_college_name d-none" role="alert">
                                                <strong class="iti_college_name_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>ITI Trade<span class="text-danger">*</span></label>
                                            <select name="iti_trade" class=" select-2 form-select" id="iti_trade"
                                                required>
                                                <option value="">Select ITI Trade</option>
                                                @foreach (companyTrades(1) as $trade)
                                                    <option value="{{ $trade->id }}" @selected($user->iti_trade == $trade->id)>
                                                        {{ $trade->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="invalid-feedback iti_trade d-none" role="alert">
                                                <strong class="iti_trade_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class=" mt-3">
                                <legend>
                                    <p>Personal Information (व्यक्तिगत विवरण)</p>
                                </legend>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Full Name / पूरा नाम<span class="text-danger">*</span></label>
                                            <input type="text" name="full_name" value="{{ $user->full_name }}"
                                                class="form-control" id="full_name" required>
                                            <span class="invalid-feedback full_name d-none" role="alert">
                                                <strong class="full_name_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gender / लिंग<span class="text-danger">*</span></label><br>
                                            <select class="form-select" name="gender" id="gender" required>
                                                <option value="MALE" @selected($user->gender == 'MALE')>Male /
                                                    पुरुष
                                                </option>
                                                <option value="FEMALE" @selected($user->gender == 'FEMALE')>Female
                                                    /
                                                    महिला</option>
                                                <option value="OTHER" @selected($user->gender == 'OTHER')>Other
                                                    /
                                                    अन्य</option>
                                            </select>
                                            <span class="invalid-feedback d-none gender" role="alert">
                                                <strong class="gender_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Father Name / पिता का नाम<span class="text-danger">*</span></label>
                                            <input type="text" name="father_name" value="{{ $user->father_name }}"
                                                class="form-control" id="father_name" required>
                                            <span class="invalid-feedback father_name d-none" role="alert">
                                                <strong class="father_name_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Date of Birth / जन्म की तारीख<span class="text-danger">*</span>
                                            </label>
                                            <input type="date" name="dob" id="dob"
                                                class="form-control datepicker" value="{{ $user->dob }}" required>
                                            <span class="invalid-feedback dob d-none" role="alert">
                                                <strong class="dob_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Age / आयु</label>
                                            <input type="text" name="age" id="age" class="form-control"
                                                value="{{ $other->age }}">
                                            <span class="invalid-feedback age d-none" role="alert">
                                                <strong class="age_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Birth Place / जन्म स्थान
                                            </label>
                                            <input type="text" name="birth_place" id="birth_place"
                                                class="form-control" value="{{ $other->birth_place }}">
                                            <span class="invalid-feedback birth_place d-none" role="alert">
                                                <strong class="birth_place_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Religion / धर्म</label>
                                            <input type="text" name="religion" id="religion" class="form-control"
                                                value="{{ $other->religion }}">
                                            <span class="invalid-feedback religion d-none" role="alert">
                                                <strong class="religion_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Category / वर्ग<span class="text-danger">*</span></label><br>
                                            <select class="form-select" name="category" id="category" required>
                                                <option value="GENERAL" @selected($user->category == 'GENERAL')>General</option>
                                                <option value="OBC" @selected($user->category == 'OBC')>OBC</option>
                                                <option value="SC" @selected($user->category == 'SC')>SC</option>
                                                <option value="ST" @selected($user->category == 'ST')>ST</option>
                                                <option value="OTHER" @selected($user->category == 'OTHER')>OTHER</option>
                                            </select>
                                            <span class="invalid-feedback d-none category" role="alert">
                                                <strong class="category_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Mother Tongue / मातृ भाषा<span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="mother_tongue" id="mother_tongue"
                                                class="form-control" value="{{ $other->mother_tongue }}" required>
                                            <span class="invalid-feedback mother_tongue d-none" role="alert">
                                                <strong class="mother_tongue_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Domicile / अधिवास<span class="text-danger">*</span></label>
                                            <input type="text" name="domicile" id="domicile" class="form-control"
                                                value="{{ $other->domicile }}" required>
                                            <span class="invalid-feedback domicile d-none" role="alert">
                                                <strong class="domicile_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Blood group / ब्लड ग्रुप </label>
                                            <select class="form-select" name="blood_group" id="blood_group">
                                                <option value="">Select Blood Group</option>
                                                <option value="O+" @if (isset($user->blood_group) && $user->blood_group == 'O+') selected @endif>O+
                                                </option>
                                                <option value="A+" @if (isset($user->blood_group) && $user->blood_group == 'A+') selected @endif>A+
                                                </option>
                                                <option value="B+" @if (isset($user->blood_group) && $user->blood_group == 'B+') selected @endif>B+
                                                </option>
                                                <option value="O-" @if (isset($user->blood_group) && $user->blood_group == 'O-') selected @endif>O-
                                                </option>
                                                <option value="A-" @if (isset($user->blood_group) && $user->blood_group == 'A-') selected @endif>A-
                                                </option>
                                                <option value="AB+"@if (isset($user->blood_group) && $user->blood_group == 'AB+') selected @endif>
                                                    AB+
                                                </option>
                                                <option value="B-" @if (isset($user->blood_group) && $user->blood_group == 'B-') selected @endif>B-
                                                </option>
                                                <option value="AB-"@if (isset($user->blood_group) && $user->blood_group == 'AB-') selected @endif>
                                                    AB-
                                                </option>
                                            </select>
                                            <span class="invalid-feedback blood_group d-none" role="alert">
                                                <strong class="blood_group_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Height (cm)
                                            </label>
                                            <input type="number" name="height" id="height" class="form-control"
                                                value="{{ $other->height }}">
                                            <span class="invalid-feedback height d-none" role="alert">
                                                <strong class="height_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Weight (kg)<span class="text-danger">*</span>
                                            </label>
                                            <input type="number" name="weight" id="weight" class="form-control"
                                                value="{{ $other->weight }}" required>
                                            <span class="invalid-feedback weight d-none" role="alert">
                                                <strong class="weight_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Marital Status / वैवाहिक स्थिति<span
                                                    class="text-danger">*</span></label><br>
                                            <select class="form-select" name="marital_status" id="marital_status"
                                                required>
                                                <option value="Single" @selected($user->marital_status == 'Single')>Single / अविवाहित
                                                </option>
                                                <option value="Married" @selected($user->marital_status == 'Married')>Married / विवाहित
                                                </option>
                                            </select>
                                            <span class="invalid-feedback d-none marital_status" role="alert">
                                                <strong class="marital_status_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Marriage Date / शादी की तारीख
                                            </label>
                                            <input type="date" name="marriage_date" id="marriage_date"
                                                class="form-control"
                                                value="{{ $other->marriage_date ? date('Y-m-d', strtotime($other->marriage_date)) : '' }}">
                                            <span class="invalid-feedback marriage_date d-none" role="alert">
                                                <strong class="marriage_date_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Aadhar Number / आधार संख्या<span class="text-danger">*</span></label>
                                            <input type="number" name="aadhar_card" id="aadhar_card"
                                                value="{{ $user->aadhar_card }}" class="form-control" required>
                                            <span class="invalid-feedback aadhar_card d-none" role="alert">
                                                <strong class="aadhar_card_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>PAN Number/ पैन नंबर </label>
                                            <input type="text" name="pan_card" id="pan_card"
                                                onkeyup="ValidatePAN();" value="{{ $user->pan_card }}"
                                                class="form-control" style="text-transform: uppercase;">
                                            <span class="invalid-feedback pan_card d-none" role="alert">
                                                <strong class="pan_card_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Email ID / ईमेल आईडी</label>
                                            <input type="email" id="email" name="email"
                                                value="{{ $user->email }}" readonly class="form-control">
                                            <span class="invalid-feedback d-none email" role="alert">
                                                <strong class="email_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="text-center mt-3">
                                <button type="submit" id="personal_btn" class="btn btn-custom-2">
                                    Next Step <i class="bx bx-skip-next"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="pills-family" role="tabpanel" aria-labelledby="pills-family-tab">
                        <form action="javascript:void(0);" id="family_detail"
                            data-url="{{ route('store-family-detail') }}">
                            <input type="hidden" value="EDIT" name="op_type">
                            <input type="hidden" value="{{$user->id}}" name="user_id">
                            <input type="hidden" value="{{$user->email}}" name="email_id">
                            <fieldset class="mt-3">
                                <legend>
                                    <p>Family Details</p>
                                </legend>
                                <div class="table-responsive">
                                    <table class=" table table-bordered table-striped mt-4 ">
                                        <thead>
                                            <th>Sl.No</th>
                                            <th>Relation <br>
                                                With <br>
                                                Candidate <br>
                                                (सम्बन्ध)</th>
                                            <th>Name <br>
                                                नाम</th>
                                            <th>Study <br>
                                                पढाई</th>
                                            <th>
                                                Age <br>आय
                                            </th>
                                            <th>
                                                Profession <br>
                                                पेशा
                                            </th>
                                            <th>
                                                Monthly <br>
                                                income <br>
                                                मासिक आय
                                            </th>
                                            <th>
                                                Owned
                                                Land / <br>
                                                Property / <br>
                                                House <br>
                                                भूमि / संपत्ति
                                            </th>
                                            <th>Income from <br>
                                                Other <br>
                                                Sources (ANY) <br>
                                                अन्य स्रोत</th>
                                            <th>
                                                Contact no <br>
                                                संपर्क नंबर।
                                            </th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Grandpa / दादा</td>
                                                <td>
                                                    <input type="text" name="grandpa_name" id="grandpa_name"
                                                        value="{{ $other->grandpa_name }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="grandpa_education" id="grandpa_education"
                                                        value="{{ $other->grandpa_education }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="grandpa_age" id="grandpa_age"
                                                        value="{{ $other->grandpa_age }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="grandpa_profession"
                                                        id="grandpa_profession" value="{{ $other->grandpa_profession }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="grandpa_income" id="grandpa_income"
                                                        value="{{ $other->grandpa_income }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="grandpa_property" id="grandpa_property"
                                                        value="{{ $other->grandpa_property }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="grandpa_other_income"
                                                        id="grandpa_other_income"
                                                        value="{{ $other->grandpa_other_income }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="grandpa_contact_no"
                                                        id="grandpa_contact_no" value="{{ $other->grandpa_contact_no }}"
                                                        class=" form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Grandmother / दादी माँ</td>
                                                <td>
                                                    <input type="text" name="grandmother_name" id="grandmother_name"
                                                        value="{{ $other->grandmother_name }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="grandmother_education"
                                                        id="grandmother_education"
                                                        value="{{ $other->grandmother_education }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="grandmother_age" id="grandmother_age"
                                                        value="{{ $other->grandmother_age }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="grandmother_profession"
                                                        id="grandmother_profession"
                                                        value="{{ $other->grandmother_profession }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="grandmother_income"
                                                        id="grandmother_income" value="{{ $other->grandmother_income }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="grandmother_property"
                                                        id="grandmother_property"
                                                        value="{{ $other->grandmother_property }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="grandmother_other_income"
                                                        id="grandmother_other_income"
                                                        value="{{ $other->grandmother_other_income }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="grandmother_contact_no"
                                                        id="grandmother_contact_no"
                                                        value="{{ $other->grandmother_contact_no }}"
                                                        class=" form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Father / पापा</td>
                                                <td>
                                                    <input type="text" value="{{ $user->father_name }}" readonly
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="father_education" id="father_education"
                                                        value="{{ $other->father_education }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="father_age" id="father_age"
                                                        value="{{ $user->father_age }}" required class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="father_occupation" id="father_occupation"
                                                        value="{{ $user->father_occupation }}" required
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="father_annual_income"
                                                        id="father_annual_income"
                                                        value="{{ $user->father_annual_income }}" required
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="father_property" id="father_property"
                                                        value="{{ $other->father_property }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="father_other_income"
                                                        id="father_other_income"
                                                        value="{{ $other->father_other_income }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="father_contact_no" id="father_contact_no"
                                                        value="{{ $other->father_contact_no }}" class=" form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Mother / मां</td>
                                                <td>
                                                    <input type="text" name="mother_name" id="mother_name"
                                                        value="{{ $user->mother_name }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mother_education" id="mother_education"
                                                        value="{{ $other->mother_education }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mother_age" id="mother_age"
                                                        value="{{ $user->mother_age }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mother_occupation" id="mother_occupation"
                                                        value="{{ $user->mother_occupation }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mother_annual_income"
                                                        id="mother_annual_income"
                                                        value="{{ $user->mother_annual_income }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mother_property" id="mother_property"
                                                        value="{{ $other->mother_property }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mother_other_income"
                                                        id="mother_other_income"
                                                        value="{{ $other->mother_other_income }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mother_contact_no" id="mother_contact_no"
                                                        value="{{ $other->mother_contact_no }}" class=" form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Guardian / अभिभावक</td>
                                                <td>
                                                    <input type="text" name="guardian_name" id="guardian_name"
                                                        value="{{ $other->guardian_name }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="guardian_education"
                                                        id="guardian_education" value="{{ $other->guardian_education }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="guardian_age" id="guardian_age"
                                                        value="{{ $other->guardian_age }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="guardian_profession"
                                                        id="guardian_profession"
                                                        value="{{ $other->guardian_profession }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="guardian_income" id="guardian_income"
                                                        value="{{ $other->guardian_income }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="guardian_property" id="guardian_property"
                                                        value="{{ $other->guardian_property }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="guardian_other_income"
                                                        id="guardian_other_income"
                                                        value="{{ $other->guardian_other_income }}" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="guardian_contact_no"
                                                        id="guardian_contact_no"
                                                        value="{{ $other->guardian_contact_no }}" class=" form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Uncle / चाचा / ताऊ 1</td>
                                                <td>
                                                    <input type="text" name="uncle1_name" id="uncle1_name"
                                                        value="{{ $other->uncle1_name }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="uncle1_education" id="uncle1_education"
                                                        value="{{ $other->uncle1_education }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="uncle1_age" id="uncle1_age"
                                                        value="{{ $other->uncle1_age }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="uncle1_profession" id="uncle1_profession"
                                                        value="{{ $other->uncle1_profession }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="uncle1_income" id="uncle1_income"
                                                        value="{{ $other->uncle1_income }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="uncle1_property" id="uncle1_property"
                                                        value="{{ $other->uncle1_property }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="uncle1_other_income"
                                                        id="uncle1_other_income"
                                                        value="{{ $other->uncle1_other_income }}" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="uncle1_contact_no" id="uncle1_contact_no"
                                                        value="{{ $other->uncle1_contact_no }}" class=" form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Uncle / चाचा / ताऊ 2</td>
                                                <td>
                                                    <input type="text" name="uncle2_name" id="uncle2_name"
                                                        value="{{ $other->uncle2_name }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="uncle2_education" id="uncle2_education"
                                                        value="{{ $other->uncle2_education }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="uncle2_age" id="uncle2_age"
                                                        value="{{ $other->uncle2_age }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="uncle2_profession" id="uncle2_profession"
                                                        value="{{ $other->uncle2_profession }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="uncle2_income" id="uncle2_income"
                                                        value="{{ $other->uncle2_income }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="uncle2_property" id="uncle2_property"
                                                        value="{{ $other->uncle2_property }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="uncle2_other_income"
                                                        id="uncle2_other_income"
                                                        value="{{ $other->uncle2_other_income }}" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="uncle2_contact_no" id="uncle2_contact_no"
                                                        value="{{ $other->uncle2_contact_no }}" class=" form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Husband or wife <br> / पति या पत्नी</td>
                                                <td>
                                                    <input type="text" name="wife_name" id="wife_name"
                                                        value="{{ $user->wife_name }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="wife_education" id="wife_education"
                                                        value="{{ $other->wife_education }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="wife_age" id="wife_age"
                                                        value="{{ $user->wife_age }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="wife_occupation" id="wife_occupation"
                                                        value="{{ $user->wife_occupation }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="wife_annual_income"
                                                        id="wife_annual_income" value="{{ $user->wife_annual_income }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="wife_property" id="wife_property"
                                                        value="{{ $other->wife_property }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="wife_other_income" id="wife_other_income"
                                                        value="{{ $other->wife_other_income }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="wife_contact_no" id="wife_contact_no"
                                                        value="{{ $other->wife_contact_no }}" class=" form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Children / बच्चे 1</td>
                                                <td>
                                                    <input type="text" name="child1name" id="child1name"
                                                        value="{{ $user->child1name }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="child1_education" id="child1_education"
                                                        value="{{ $other->child1_education }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="child1sage" id="child1sage"
                                                        value="{{ $user->child1sage }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="child1_profession" id="child1_profession"
                                                        value="{{ $other->child1_profession }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="child1_income" id="child1_income"
                                                        value="{{ $other->child1_income }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="child1_property" id="child1_property"
                                                        value="{{ $other->child1_property }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="child1_other_income"
                                                        id="child1_other_income"
                                                        value="{{ $other->child1_other_income }}" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="child1_contact_no" id="child1_contact_no"
                                                        value="{{ $other->child1_contact_no }}" class=" form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Children / बच्चे 2</td>
                                                <td>
                                                    <input type="text" name="child2name" id="child2name"
                                                        value="{{ $user->child2name }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="child2_education" id="child2_education"
                                                        value="{{ $other->child2_education }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="child2sage" id="child2sage"
                                                        value="{{ $user->child2sage }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="child2_profession" id="child2_profession"
                                                        value="{{ $other->child2_profession }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="child2_income" id="child2_income"
                                                        value="{{ $other->child2_income }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="child2_property" id="child2_property"
                                                        value="{{ $other->child2_property }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="child2_other_income"
                                                        id="child2_other_income"
                                                        value="{{ $other->child2_other_income }}" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="child2_contact_no" id="child2_contact_no"
                                                        value="{{ $other->child2_contact_no }}" class=" form-control">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>11</td>
                                                <td>Brother / Sister <br> भाई बहन 1</td>
                                                <td>
                                                    <input type="text" name="s1name" id="s1name"
                                                        value="{{ $user->s1name }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="s1_education" id="s1_education"
                                                        value="{{ $other->s1_education }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="s1sage" id="s1sage"
                                                        value="{{ $user->s1sage }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="s1soccupation" id="s1soccupation"
                                                        value="{{ $user->s1soccupation }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="s1sannualincome" id="s1sannualincome"
                                                        value="{{ $user->s1sannualincome }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="s1_property" id="s1_property"
                                                        value="{{ $other->s1_property }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="s1_other_income" id="s1_other_income"
                                                        value="{{ $other->s1_other_income }}" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="s1_contact_no" id="s1_contact_no"
                                                        value="{{ $other->s1_contact_no }}" class=" form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>Brother / Sister <br> भाई बहन 2</td>
                                                <td>
                                                    <input type="text" name="s2name" id="s2name"
                                                        value="{{ $user->s2name }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="s2_education" id="s2_education"
                                                        value="{{ $other->s2_education }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="s2sage" id="s2sage"
                                                        value="{{ $user->s2sage }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="s2soccupation" id="s2soccupation"
                                                        value="{{ $user->s2soccupation }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="s2sannualincome" id="s2sannualincome"
                                                        value="{{ $user->s2sannualincome }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="s2_property" id="s2_property"
                                                        value="{{ $other->s2_property }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="s2_other_income" id="s2_other_income"
                                                        value="{{ $other->s2_other_income }}" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="s2_contact_no" id="s2_contact_no"
                                                        value="{{ $other->s2_contact_no }}" class=" form-control">
                                                </td>
                                            </tr>
                                            <tr class=" d-none depend_on_marital_status">
                                                <td>13</td>
                                                <td>Mother-in-law / सास</td>
                                                <td>
                                                    <input type="text" name="mother_in_law_name"
                                                        id="mother_in_law_name" value="{{ $other->mother_in_law_name }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mother_in_law_education"
                                                        id="mother_in_law_education"
                                                        value="{{ $other->mother_in_law_education }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mother_in_law_age" id="mother_in_law_age"
                                                        value="{{ $other->mother_in_law_age }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mother_in_law_profession"
                                                        id="mother_in_law_profession"
                                                        value="{{ $other->mother_in_law_profession }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mother_in_law_income"
                                                        id="mother_in_law_income"
                                                        value="{{ $other->mother_in_law_income }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mother_in_law_property"
                                                        id="mother_in_law_property"
                                                        value="{{ $other->mother_in_law_property }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mother_in_law_other_income"
                                                        id="mother_in_law_other_income"
                                                        value="{{ $other->mother_in_law_other_income }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="mother_in_law_contact_no"
                                                        id="mother_in_law_contact_no"
                                                        value="{{ $other->mother_in_law_contact_no }}"
                                                        class=" form-control">
                                                </td>
                                            </tr>
                                            <tr class=" d-none depend_on_marital_status">
                                                <td>14</td>
                                                <td>Father-in-law / ससुर</td>
                                                <td>
                                                    <input type="text" name="father_in_law_name"
                                                        id="father_in_law_name" value="{{ $other->father_in_law_name }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="father_in_law_education"
                                                        id="father_in_law_education"
                                                        value="{{ $other->father_in_law_education }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="father_in_law_age" id="father_in_law_age"
                                                        value="{{ $other->father_in_law_age }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="father_in_law_profession"
                                                        id="father_in_law_profession"
                                                        value="{{ $other->father_in_law_profession }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="father_in_law_income"
                                                        id="father_in_law_income"
                                                        value="{{ $other->father_in_law_income }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="father_in_law_property"
                                                        id="father_in_law_property"
                                                        value="{{ $other->father_in_law_property }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="father_in_law_other_income"
                                                        id="father_in_law_other_income"
                                                        value="{{ $other->father_in_law_other_income }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="father_in_law_contact_no"
                                                        id="father_in_law_contact_no"
                                                        value="{{ $other->father_in_law_contact_no }}"
                                                        class=" form-control">
                                                </td>
                                            </tr>
                                            <tr class=" d-none depend_on_marital_status">
                                                <td>15</td>
                                                <td>Brother-in-law / साला</td>
                                                <td>
                                                    <input type="text" name="brother_in_law_name"
                                                        id="brother_in_law_name"
                                                        value="{{ $other->brother_in_law_name }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="brother_in_law_education"
                                                        id="brother_in_law_education"
                                                        value="{{ $other->brother_in_law_education }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="brother_in_law_age"
                                                        id="brother_in_law_age" value="{{ $other->brother_in_law_age }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="brother_in_law_profession"
                                                        id="brother_in_law_profession"
                                                        value="{{ $other->brother_in_law_profession }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="brother_in_law_income"
                                                        id="brother_in_law_income"
                                                        value="{{ $other->brother_in_law_income }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="brother_in_law_property"
                                                        id="brother_in_law_property"
                                                        value="{{ $other->brother_in_law_property }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="brother_in_law_other_income"
                                                        id="brother_in_law_other_income"
                                                        value="{{ $other->brother_in_law_other_income }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="brother_in_law_contact_no"
                                                        id="brother_in_law_contact_no"
                                                        value="{{ $other->brother_in_law_contact_no }}"
                                                        class=" form-control">
                                                </td>
                                            </tr>
                                            <tr class=" d-none depend_on_marital_status">
                                                <td>16</td>
                                                <td>Sister-in-law / साली</td>
                                                <td>
                                                    <input type="text" name="sister_in_law_name"
                                                        id="sister_in_law_name" value="{{ $other->sister_in_law_name }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="sister_in_law_education"
                                                        id="sister_in_law_education"
                                                        value="{{ $other->sister_in_law_education }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="sister_in_law_age" id="sister_in_law_age"
                                                        value="{{ $other->sister_in_law_age }}" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="sister_in_law_profession"
                                                        id="sister_in_law_profession"
                                                        value="{{ $other->sister_in_law_profession }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="sister_in_law_income"
                                                        id="sister_in_law_income"
                                                        value="{{ $other->sister_in_law_income }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="sister_in_law_property"
                                                        id="sister_in_law_property"
                                                        value="{{ $other->sister_in_law_property }}"
                                                        class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="sister_in_law_other_income"
                                                        id="sister_in_law_other_income"
                                                        value="{{ $other->sister_in_law_other_income }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="sister_in_law_contact_no"
                                                        id="sister_in_law_contact_no"
                                                        value="{{ $other->sister_in_law_contact_no }}"
                                                        class=" form-control">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="form-group">
                                        <label>Any Loan liability on Family/ Self / परिवार/स्वयं/पर कोई ऋण देयता
                                        </label>
                                        <textarea name="fam_any_loan_lability" id="fam_any_loan_lability" class=" form-control" rows="2">{{ $other->fam_any_loan_lability }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="form-group">
                                        <label>Is any of your relative government employed? क्या आपका कोई रिश्तेदार
                                            सरकारी/प्रशासनिक
                                            सेवा में कार्यरत है
                                        </label>
                                        <div class="col-md-3">
                                            <select name="relative_government_employed" class=" form-select"
                                                id="relative_government_employed">
                                                <option value="NO" @selected($other->relative_government_employed == 'No')>NO</option>
                                                <option value="YES" @selected($other->relative_government_employed == 'YES')>YES</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class=" mt-3 row d-none depend_on_rel_gov_emp">
                                    <label><b>If yes, then enter his/her name, relation, यदि हां, तो उसका नाम, संबंध दर्ज
                                            करें</b></label>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name / नाम</label>
                                            <input type="text" class=" form-control" name="rel_name_gov_emp"
                                                id="rel_name_gov_emp" value="{{ $other->rel_name_gov_emp }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Relation / सम्बन्ध</label>
                                            <input type="text" class=" form-control" name="rel_relation_gov_emp"
                                                id="rel_relation_gov_emp" value="{{ $other->rel_relation_gov_emp }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Business / व्यवसाय</label>
                                            <select name="rel_buss_gov_emp" id="rel_buss_gov_emp"
                                                class=" form-select">
                                                <option value="">Select Business</option>
                                                <option value="Police Service" @selected($other->rel_buss_gov_emp == 'Police Service')> Police
                                                    Service
                                                </option>
                                                <option value="Politics" @selected($other->rel_buss_gov_emp == 'Politics')> Politics / राजनीति
                                                </option>
                                                <option value="IAS" @selected($other->rel_buss_gov_emp == 'IAS')>IAS / आईएएस</option>
                                                <option value="Collector" @selected($other->rel_buss_gov_emp == 'Collector')>कलेक्टर</option>
                                                <option value="ITO" @selected($other->rel_buss_gov_emp == 'ITO')>ITO / आईटीओ</option>
                                                <option value="Lawyer" @selected($other->rel_buss_gov_emp == 'Lawyer')>Lawyer / वकील
                                                </option>
                                                <option value="Bureaucracy" @selected($other->rel_buss_gov_emp == 'Bureaucracy')>Bureaucracy /
                                                    नौकरशाही
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class=" text-center">
                                <a href="#" class="btn btn-custom-2 btn-prev-tab btn-radius py-1"
                                    onclick="previousTab('pills-personal-detail-tab')"><i
                                        class="bx bx-skip-previous"></i> Prev
                                    Step</a>
                                <button type="submit" id="" class="btn btn-custom-2">
                                    Next Step <i class="bx bx-skip-next"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="pills-address" role="tabpanel"
                        aria-labelledby="pills-address-tab">
                        <form id="address_detail" data-url="{{ route('store-address-detail') }}">
                            <input type="hidden" value="EDIT" name="op_type">
                            <input type="hidden" value="{{$user->id}}" name="user_id">
                            <input type="hidden" value="{{$user->email}}" name="email_id">
                            <fieldset class="mt-3">
                                <fieldset>
                                    <legend>
                                        <p>Permanent Address (स्थायी पता )</p>
                                    </legend>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>House / Flat No (मकान संख्या)<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="permanent_house_number"
                                                    name="permanent_house_number" class="form-control" required
                                                    value="{{ $user->permanent_house_number }}">
                                                <span class="invalid-feedback permanent_house_number d-none"
                                                    role="alert">
                                                    <strong class="permanent_house_number_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Street / Village (गली/गााँव)<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="permanent_house_street_village"
                                                    id="permanent_house_street_village" class="form-control" required
                                                    value="{{ $user->permanent_house_street_village }}">
                                                <span class="invalid-feedback permanent_house_street_village d-none"
                                                    role="alert">
                                                    <strong class="permanent_house_street_village_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Post Office / Tehsil / डाकघर / तहसील<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="permanent_post_office_tehsil"
                                                    id="permanent_post_office_tehsil" class="form-control" required
                                                    value="{{ $other->permanent_post_office_tehsil }}">
                                                <span class="invalid-feedback permanent_post_office_tehsil d-none"
                                                    role="alert">
                                                    <strong class="permanent_post_office_tehsil_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>State / राज्य <span class="text-danger">*</span></label><br>
                                                <select class="form-select" name="permanent_state"
                                                    id="permanent_state" required>
                                                    <option value="">Select State</option>
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->id }}"
                                                            @selected($user->permanent_state == $state->id)>
                                                            {{ $state->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="invalid-feedback permanent_state d-none" role="alert">
                                                    <strong class="permanent_state_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>District (जिला)<span class="text-danger">*</span></label><br>
                                                <select class="form-select" name="permanent_district"
                                                    id="permanent_district" required>
                                                    <option value="">Select District</option>
                                                </select>
                                                <span class="invalid-feedback permanent_district d-none" role="alert">
                                                    <strong class="permanent_district_msg"></strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Pin Code / पिन कोड <span class="text-danger">*</span></label>
                                                <input type="number" id="permanent_pincode" name="permanent_pincode"
                                                    value="{{ $user->permanent_pincode }}" class="form-control "
                                                    required>
                                                <span class="invalid-feedback d-none permanent_pincode" role="alert">
                                                    <strong class="permanent_pincode_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Landline/Mobile / लैंडलाइन/मोबाइल<span
                                                        class="text-danger">*</span></label>
                                                <input type="number" id="permanent_landline_mobile"
                                                    name="permanent_landline_mobile"
                                                    value="{{ $other->permanent_landline_mobile }}"
                                                    class="form-control" required>
                                                <span class="invalid-feedback d-none permanent_landline_mobile"
                                                    role="alert">
                                                    <strong class="permanent_landline_mobile_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Period of Stay from</label>
                                                <input type="text" id="permanent_stay_from"
                                                    name="permanent_stay_from"
                                                    value="{{ $other->permanent_stay_from }}" class="form-control">
                                                <span class="invalid-feedback d-none permanent_stay_from"
                                                    role="alert">
                                                    <strong class="permanent_stay_from_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Period of Stay to</label>
                                                <input type="text" id="permanent_stay_to" name="permanent_stay_to"
                                                    value="{{ $other->permanent_stay_to }}" class="form-control">
                                                <span class="invalid-feedback d-none permanent_stay_to" role="alert">
                                                    <strong class="permanent_stay_to_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-2">
                                    <legend>
                                        <p>Present Address (वर्तमान पता)</p>
                                    </legend>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label>
                                                <input class="form-check-input me-1" type="checkbox"
                                                    id="same_address">
                                                <b> Is your present address same as permanent address ?</b>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>House / Flat No (मकान संख्या)</label>
                                                <input type="text" name="present_house_number" class="form-control"
                                                    id="present_house_number"
                                                    value="{{ $user->present_house_number }}">
                                                <span class="invalid-feedback present_house_number d-none"
                                                    role="alert">
                                                    <strong class="present_house_number_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Street / Village (गली/गााँव)</label>
                                                <input type="text" name="present_house_street_village"
                                                    id="present_house_street_village" class="form-control"
                                                    value="{{ $user->present_house_street_village }}">
                                                <span class="invalid-feedback present_house_street_village d-none"
                                                    role="alert">
                                                    <strong class="present_house_street_village_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Post Office / Tehsil / डाकघर / तहसील</label>
                                                <input type="text" name="present_post_office_tehsil"
                                                    id="present_post_office_tehsil" class="form-control"
                                                    value="{{ $other->present_post_office_tehsil }}">
                                                <span class="invalid-feedback present_post_office_tehsil d-none"
                                                    role="alert">
                                                    <strong class="present_post_office_tehsil_msg"></strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>State / राज्य</label>
                                                <select class="form-select" name="present_state" id="present_state">
                                                    <option value="">Select State</option>
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->id }}"
                                                            @selected($user->present_state == $state->id)>
                                                            {{ $state->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="invalid-feedback present_state d-none" role="alert">
                                                    <strong class="present_state_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>District (जिला)</label><br>
                                                <select class="form-select" name="present_district"
                                                    id="present_district">
                                                    <option value="">Select District</option>
                                                </select>
                                                <span class="invalid-feedback present_district d-none" role="alert">
                                                    <strong class="present_district_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Pin Code / पिन कोड</label>
                                                <input type="number" name="present_pincode" id="present_pincode"
                                                    value="{{ $user->present_pincode }}" class="form-control">
                                                <span class="invalid-feedback present_pincode d-none" role="alert">
                                                    <strong class="present_pincode_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Landline/Mobile / लैंडलाइन/मोबाइल</label>
                                                <input type="number" id="present_landline_mobile"
                                                    name="present_landline_mobile"
                                                    value="{{ $other->present_landline_mobile }}"
                                                    class="form-control">
                                                <span class="invalid-feedback d-none present_landline_mobile"
                                                    role="alert">
                                                    <strong class="present_landline_mobile_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Period of Stay from</label>
                                                <input type="text" id="present_stay_from" name="present_stay_from"
                                                    value="{{ $other->present_stay_from }}" class="form-control">
                                                <span class="invalid-feedback d-none present_stay_from" role="alert">
                                                    <strong class="present_stay_from_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Period of Stay to</label>
                                                <input type="text" id="present_stay_to" name="present_stay_to"
                                                    value="{{ $other->present_stay_to }}" class="form-control">
                                                <span class="invalid-feedback d-none present_stay_to" role="alert">
                                                    <strong class="present_stay_to_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row">
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Years spent with family / <br> परिवार के साथ बिताए साल</label>
                                            <input type="text" id="year_spent_family" name="year_spent_family"
                                                value="{{ $other->year_spent_family }}" class="form-control">
                                            <span class="invalid-feedback d-none year_spent_family" role="alert">
                                                <strong class="year_spent_family_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Years spent in hostel/relatives / <br> हॉस्टल/रिश्तेदारों में बिताए
                                                साल</label>
                                            <input type="text" id="year_spent_relative" name="year_spent_relative"
                                                value="{{ $other->year_spent_relative }}" class="form-control">
                                            <span class="invalid-feedback d-none year_spent_relative" role="alert">
                                                <strong class="year_spent_relative_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="col-12 text-center">
                                <a href="#" class="btn btn-custom-2 btn-prev-tab btn-radius py-1 previous_btn"
                                    onclick="previousTab('pills-family-tab')"><i class="bx bx-skip-previous"></i> Prev
                                    Step</a>
                                <button type="submit" class="btn btn-custom-2">
                                    Next Step <i class="bx bx-skip-next"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="pills-education" role="tabpanel"
                        aria-labelledby="pills-education-tab">
                        <form id="education_detail" data-url="{{ route('store-education-detail') }}">
                            <input type="hidden" value="EDIT" name="op_type">
                            <input type="hidden" value="{{$user->id}}" name="user_id">
                            <input type="hidden" value="{{$user->email}}" name="email_id">
                            <fieldset class="mt-3">
                                <fieldset>
                                    <legend>
                                        <p>10th(दसवीं कक्षा)</p>
                                    </legend>
                                    <div class="row">
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>School /Institution (स्कूल/विश्वविद्यालय) <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="tenth_college_name"
                                                    id="tenth_college_name" value="{{ $user->tenth_college_name }}"
                                                    class="form-control" required>
                                                <span class="invalid-feedback d-none tenth_college_name" role="alert">
                                                    <strong class="tenth_college_name_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Board / बोर्ड<span class="text-danger">*</span>
                                                </label>
                                                <input type="text" required name="tenth_board" id="tenth_board"
                                                    value="{{ $user->tenth_board }}" class="form-control">
                                                <span class="invalid-feedback d-none tenth_board" role="alert">
                                                    <strong class="tenth_board_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Month & Year of Passing / पास होने का महीना और वर्ष<span
                                                        class="text-danger">*</span></label>
                                                <input type="month" name="tenth_passing_year"
                                                    id="tenth_passing_year" value="{{ $user->tenth_passing_year }}"
                                                    class="form-control" required>
                                                <span class="invalid-feedback d-none tenth_passing_year" role="alert">
                                                    <strong class="tenth_passing_year_msg"></strong>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Obtained Marks / पाया हुआ मार्क्स<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="tenth_obtain_mark" id="tenth_obtain_mark"
                                                    value="{{ $other->tenth_obtain_mark }}" class="form-control"
                                                    required>
                                                <span class="invalid-feedback d-none tenth_obtain_mark" role="alert">
                                                    <strong class="tenth_obtain_mark_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Max Marks / मैक्स मार्क्स<span class="text-danger">*</span></label>
                                                <input type="text" name="tenth_max_mark" id="tenth_max_mark"
                                                    value="{{ $other->tenth_max_mark }}" class="form-control"
                                                    required>
                                                <span class="invalid-feedback d-none tenth_max_mark" role="alert">
                                                    <strong class="tenth_max_mark_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>%Percent / प्रतिशत<span class="text-danger">*</span></label>
                                                <input type="number" name="tenth_score" id="tenth_score"
                                                    value="{{ $user->tenth_score }}" class="form-control" required>
                                                <span class="invalid-feedback d-none tenth_score" role="alert">
                                                    <strong class="tenth_score_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Reg/ Correspondence / व्यवसायिक व पत्राचार<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" name="tenth_education_type"
                                                    id="tenth_education_type" required>
                                                    <option value="">Select</option>
                                                    <option value="Regular" @selected($user->tenth_education_type == 'Regular')>
                                                        {{ 'Regular' }}</option>
                                                    <option value="Correspondence" @selected($user->tenth_education_type == 'Correspondence')>
                                                        {{ 'Correspondence' }}
                                                    </option>
                                                </select>
                                                <span class="invalid-feedback d-none tenth_education_type"
                                                    role="alert">
                                                    <strong class="tenth_education_type_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="mt-3">
                                    <legend>
                                        <p>12th(बारहवीं कक्षा)</p>
                                    </legend>
                                    <div class="row">
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>School /Institution (स्कूल/विश्वविद्यालय)</label>
                                                <input type="text" name="twelve_college_name"
                                                    id="twelve_college_name" value="{{ $user->twelve_college_name }}"
                                                    class="form-control">
                                                <span class="invalid-feedback d-none twelve_college_name"
                                                    role="alert">
                                                    <strong class="twelve_college_name_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Board / बोर्ड</label>
                                                <input type="text" name="twelve_board" id="twelve_board"
                                                    value="{{ $user->twelve_board }}" class="form-control">
                                                <span class="invalid-feedback d-none twelve_board" role="alert">
                                                    <strong class="twelve_board_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Month & Year of Passing / पास होने का महीना और वर्ष</label>
                                                <input type="month" name="twelve_passing_year"
                                                    id="twelve_passing_year" value="{{ $user->twelve_passing_year }}"
                                                    class="form-control">
                                                <span class="invalid-feedback d-none twelve_passing_year"
                                                    role="alert">
                                                    <strong class="twelve_passing_year_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Obtained Marks / पाया हुआ मार्क्स</label>
                                                <input type="text" name="twelve_obtain_mark"
                                                    id="twelve_obtain_mark" value="{{ $other->twelve_obtain_mark }}"
                                                    class="form-control">
                                                <span class="invalid-feedback d-none twelve_obtain_mark" role="alert">
                                                    <strong class="twelve_obtain_mark_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Max Marks / मैक्स मार्क्स</label>
                                                <input type="text" name="twelve_max_mark" id="twelve_max_mark"
                                                    value="{{ $other->twelve_max_mark }}" class="form-control">
                                                <span class="invalid-feedback d-none twelve_max_mark" role="alert">
                                                    <strong class="twelve_max_mark_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>%Percent / प्रतिशत</label>
                                                <input type="number" name="twelve_score" id="twelve_score"
                                                    value="{{ $user->twelve_score }}" class="form-control">
                                                <span class="invalid-feedback d-none twelve_score" role="alert">
                                                    <strong class="twelve_score_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Reg/ Correspondence / व्यवसायिक व पत्राचार</label>
                                                <select class="form-select" name="twelve_education_type"
                                                    id="twelve_education_type">
                                                    <option value="">Select</option>
                                                    <option value="Regular" @selected($user->twelve_education_type == 'Regular')>
                                                        {{ 'Regular' }}
                                                    </option>
                                                    <option value="Correspondence" @selected($user->twelve_education_type == 'Correspondence')>
                                                        {{ 'Correspondence' }}</option>
                                                </select>
                                                <span class="invalid-feedback d-none twelve_education_type"
                                                    role="alert">
                                                    <strong class="twelve_education_type_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="mt-3">
                                    <legend>
                                        <p>Any Other(Graduation)</p>
                                    </legend>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Other Graduation <span class="text-danger">*</span></label><br>
                                            <select class="form-select" name="any_other_graduation"
                                                id="any_other_graduation" required>
                                                <option value="NO" @selected($other->any_other_graduation == 'NO')> NO </option>
                                                <option value="YES" @selected($other->any_other_graduation == 'YES')> YES </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row d-none any_other_grd_wrapper">
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>School /Institution (स्कूल/विश्वविद्यालय)</label>
                                                <input type="text" name="other_college_name"
                                                    id="other_college_name" value="{{ $user->other_college_name }}"
                                                    class="form-control">
                                                <span class="invalid-feedback d-none other_college_name" role="alert">
                                                    <strong class="other_college_name_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Board / बोर्ड
                                                </label>
                                                <input type="text" name="other_board" id="other_board"
                                                    value="{{ $other->other_board }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Month & Year of Passing / पास होने का महीना और वर्ष</label>
                                                <input type="month" name="other_passing_year"
                                                    id="other_passing_year" value="{{ $user->other_passing_year }}"
                                                    class="form-control">
                                                <span class="invalid-feedback d-none other_passing_year" role="alert">
                                                    <strong class="other_passing_year_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Obtained Marks / पाया हुआ मार्क्स</label>
                                                <input type="text" name="other_obtain_mark" id="other_obtain_mark"
                                                    value="{{ $other->other_obtain_mark }}" class="form-control">
                                                <span class="invalid-feedback d-none other_obtain_mark" role="alert">
                                                    <strong class="other_obtain_mark_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Max Marks / मैक्स मार्क्स</label>
                                                <input type="text" name="other_max_mark" id="other_max_mark"
                                                    value="{{ $other->other_max_mark }}" class="form-control">
                                                <span class="invalid-feedback d-none other_max_mark" role="alert">
                                                    <strong class="other_max_mark_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>%Percent / प्रतिशत</label>
                                                <input type="number" name="other_score" id="other_score"
                                                    value="{{ $user->other_score }}" class="form-control">
                                                <span class="invalid-feedback d-none other_score" role="alert">
                                                    <strong class="other_score_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Reg/ Correspondence / व्यवसायिक व पत्राचार</label>
                                                <select class="form-select" name="other_education_type"
                                                    id="other_education_type">
                                                    <option value="">Select</option>
                                                    <option value="Regular" @selected($user->other_education_type == 'Regular')>
                                                        {{ 'Regular' }}
                                                    </option>
                                                    <option value="Correspondence" @selected($user->other_education_type == 'Correspondence')>
                                                        {{ 'Correspondence' }}
                                                    </option>
                                                </select>
                                                <span class="invalid-feedback d-none other_education_type"
                                                    role="alert">
                                                    <strong class="other_education_type_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>



                                <div class=" col-12 mt-3">
                                    <label> <b>Educational Qualification Verification (Highest Degree)
                                            –</b></label>
                                    <div class="row ">
                                        <p class=" text-danger mb-1">(Important: Copy of Mark sheet and Degree certificate
                                            MUST be
                                            attached)
                                        </p>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Institution Name</label>
                                                <input type="text" name="institution_name" id="institution_name"
                                                    value="{{ $other->institution_name }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Institution Address</label>
                                                <input type="text" name="institution_address"
                                                    id="institution_address" value="{{ $other->institution_address }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>University Name and address</label>
                                                <input type="text" name="ot_grad_uni_na_adr"
                                                    id="ot_grad_uni_na_adr" value="{{ $other->ot_grad_uni_na_adr }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>From</label>
                                                <input type="month" name="other_grad_from" id="other_grad_from"
                                                    value="{{ $other->other_grad_from }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>To</label>
                                                <input type="month" name="other_grad_to" id="other_grad_to"
                                                    value="{{ $other->other_grad_to }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Passed</label>
                                                <select name="other_grad_passed" id="other_grad_passed"
                                                    class=" form-select">
                                                    <option value="NO" @selected($other->other_grad_passed == 'NO')>No</option>
                                                    <option value="YES" @selected($other->other_grad_passed == 'YES')>YES</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Program</label>
                                                <select name="other_grad_program" id="other_grad_program"
                                                    class=" form-select">
                                                    <option value="">Select Program</option>
                                                    <option value="Full Time" @selected($other->other_grad_program == 'Full Time')>Full Time
                                                    </option>
                                                    <option value="Pasrt Time" @selected($other->other_grad_program == 'Pasrt Time')>Pasrt Time
                                                    </option>
                                                    <option value="Day" @selected($other->other_grad_program == 'Day')>Day</option>
                                                    <option value="Evening" @selected($other->other_grad_program == 'Evening')>Evening</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Student ID/ Enrolment No</label>
                                                <input type="text" name="other_grad_enrol_no"
                                                    id="other_grad_enrol_no" value="{{ $other->other_grad_enrol_no }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Type of degree</label>
                                                <input type="text" name="other_grad_deg_type"
                                                    id="other_grad_deg_type" value="{{ $other->other_grad_deg_type }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Graduation date</label>
                                                <input type="date" name="other_grad_date" id="other_grad_date"
                                                    value="{{ $other->other_grad_date }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Trade/Branch</label>
                                                <input type="text" name="other_grad_branch" id="other_grad_branch"
                                                    value="{{ $other->other_grad_branch }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <fieldset class="mt-3">
                                    <legend>
                                        <p>ITI Details (आई. टी. आई. विवरण)</p>
                                    </legend>
                                    <div class="row">
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>ITI College (आई. टी. आई. कॉलेज)<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" readonly value="{{ $user->iti_college_name }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>From <span class="text-danger">*</span></label>
                                                <select class="form-select" name="iti_start_from" id="iti_start_from"
                                                    required>
                                                    <option value="">Select Start Year</option>
                                                    @for ($i = date('Y'); $i >= 1980; $i--)
                                                        <option value="{{ $i }}"
                                                            @selected($other->iti_start_from == $i)>
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>

                                                <span class="invalid-feedback d-none iti_start_from" role="alert">
                                                    <strong class="iti_start_from_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>To<span class="text-danger">*</span></label>
                                                <select class="form-select" name="iti_start_to" id="iti_start_to"
                                                    required>
                                                    <option value="">Select Start Year</option>
                                                    @for ($i = date('Y'); $i >= 1980; $i--)
                                                        <option value="{{ $i }}"
                                                            @selected($other->iti_start_to == $i)>
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>

                                                <span class="invalid-feedback d-none iti_start_to" role="alert">
                                                    <strong class="iti_start_to_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Trade (ट्रेड)<span class="text-danger">*</span></label><br>
                                                <select class=" form-control" disabled>
                                                    @foreach (companyTrades(1) as $trade)
                                                        <option value="{{ $trade->id }}"
                                                            @selected($user->iti_trade == $trade->id)>
                                                            {{ $trade->name }}
                                                        </option>
                                                        @php
                                                            break;
                                                        @endphp
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Mark Obtained<span class="text-danger">*</span></label>
                                                <input type="number" name="iti_obtain_mark"
                                                    value="{{ $other->iti_obtain_mark }}" id="iti_obtain_mark"
                                                    class="form-control" required>
                                                <span class="invalid-feedback d-none iti_obtain_mark" role="alert">
                                                    <strong class="iti_obtain_mark_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Any Gap / Back Papers</label>
                                                <input type="text" name="iti_gap_paper"
                                                    value="{{ $other->iti_gap_paper }}" id="iti_gap_paper"
                                                    class="form-control">

                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Total Attendance in ITI</label>
                                                <input type="text" name="iti_attendance"
                                                    value="{{ $other->iti_attendance }}" id="iti_attendance"
                                                    class="form-control">
                                                <span class="invalid-feedback d-none iti_attendance" role="alert">
                                                    <strong class="iti_attendance_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Reason for Below 90 % </label>
                                                <input type="text" name="iti_attendance_reason"
                                                    value="{{ $other->iti_attendance_reason }}"
                                                    id="iti_attendance_reason" class="form-control">

                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-4">
                                    <legend>
                                        <p>Apprenticeship (प्रशिक्षु)</p>
                                    </legend>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Apprenticeship <span class="text-danger">*</span></label><br>
                                                <select class="form-select" name="apprentice" id="apprentice"
                                                    required="">
                                                    <option value="NO" @selected($user->apprentice == 'NO')> NO </option>
                                                    <option value="YES" @selected($user->apprentice == 'YES')> YES </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row d-none" id="apprentice_Wrapper">
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>Company Name</label>
                                                    <input type="text" name="apprentice_company_name"
                                                        id="apprentice_company_name"
                                                        value="{{ $user->apprentice_company_name }}"
                                                        class="form-control">
                                                    <span class="invalid-feedback d-none apprentice_company_name"
                                                        role="alert">
                                                        <strong class="apprentice_company_name_msg"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>From </label>
                                                    <input type="date" name="apprentice_start_date"
                                                        value="{{ $user->apprentice_start_date }}"
                                                        id="apprentice_start_date" class="form-control">
                                                    <span class="invalid-feedback d-none apprentice_start_date"
                                                        role="alert">
                                                        <strong class="apprentice_start_date_msg"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-1">
                                                <div class="form-group">
                                                    <label>To</label>
                                                    <input type="date" name="apprentice_end_date"
                                                        value="{{ $user->apprentice_end_date }}"
                                                        id="apprentice_end_date" class="form-control">
                                                    <span class="invalid-feedback d-none apprentice_end_date"
                                                        role="alert">
                                                        <strong class="apprentice_end_date_msg"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-2">
                                                <div class="form-group">
                                                    <label>Department</label><br>
                                                    <input type="text" name="apprentice_division"
                                                        id="apprentice_division"
                                                        value="{{ $user->apprentice_division }}" class="form-control">
                                                    <span class="invalid-feedback d-none apprentice_division"
                                                        role="alert">
                                                        <strong class="apprentice_division_msg"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>


                                <fieldset class="mt-3">
                                    <legend>
                                        <p>Diploma / डिप्लोमा</p>
                                    </legend>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Any Diploma <span class="text-danger">*</span></label><br>
                                            <select class="form-select" name="any_diploma" id="any_diploma">
                                                <option value="NO" @selected($other->any_diploma == 'NO')> NO </option>
                                                <option value="YES" @selected($other->any_diploma == 'YES')> YES </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row d-none" id="diploma_Wrapper">
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="diploma_college_name"
                                                    id="diploma_college_name"
                                                    value="{{ $other->diploma_college_name }}" class="form-control">
                                                <span class="invalid-feedback d-none diploma_college_name"
                                                    role="alert">
                                                    <strong class="diploma_college_name_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>From</label>
                                                <select class="form-select" name="diploma_start_from"
                                                    id="diploma_start_from">
                                                    <option value="">Select Start Year</option>
                                                    @for ($i = date('Y'); $i >= 1980; $i--)
                                                        <option value="{{ $i }}"
                                                            @selected($other->diploma_start_from == $i)>
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>

                                                <span class="invalid-feedback d-none diploma_start_from" role="alert">
                                                    <strong class="diploma_start_from_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>To</label>
                                                <select class="form-select" name="diploma_start_to"
                                                    id="diploma_start_to">
                                                    <option value="">Select Start Year</option>
                                                    @for ($i = date('Y'); $i >= 1980; $i--)
                                                        <option value="{{ $i }}"
                                                            @selected($other->diploma_start_to == $i)>
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                                <span class="invalid-feedback d-none diploma_start_to" role="alert">
                                                    <strong class="diploma_start_to_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Branch</label>
                                                <input type="text" name="diploma_trade_branch"
                                                    id="diploma_trade_branch"
                                                    value="{{ $other->diploma_trade_branch }}" class=" form-control">
                                                <span class="invalid-feedback d-none diploma_trade_branch"
                                                    role="alert">
                                                    <strong class="diploma_trade_branch_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Mark Obtained</label>
                                                <input type="number" name="diploma_obtain_mark"
                                                    value="{{ $other->diploma_obtain_mark }}" id="diploma_obtain_mark"
                                                    class="form-control">
                                                <span class="invalid-feedback d-none diploma_obtain_mark"
                                                    role="alert">
                                                    <strong class="diploma_obtain_mark_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Any Gap / Back Papers</label>
                                                <input type="text" name="diploma_gap_paper"
                                                    value="{{ $other->diploma_gap_paper }}" id="diploma_gap_paper"
                                                    class="form-control">
                                                <span class="invalid-feedback d-none diploma_gap_paper" role="alert">
                                                    <strong class="diploma_gap_paper_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>


                                <div class="row">
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Reason for any gap in Education, if applicable</label>
                                            <input type="text" name="reas_gap_any_edu"
                                                value="{{ $other->reas_gap_any_edu }}" id="reas_gap_any_edu"
                                                class="form-control">
                                            <span class="invalid-feedback d-none reas_gap_any_edu" role="alert">
                                                <strong class="reas_gap_any_edu_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Extra-curricular activities in school/college?</label>
                                            <input type="text" name="ext_act_college"
                                                value="{{ $other->ext_act_college }}" id="ext_act_college"
                                                class="form-control">
                                            <span class="invalid-feedback d-none ext_act_college" role="alert">
                                                <strong class="ext_act_college_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Computer Knowledge</label>
                                            <select name="comp_know" id="comp_know" class=" form-select">
                                                <option value="">Select Knowledge</option>
                                                <option value="Beginner" @selected($other->comp_know == 'Beginner')> Beginner</option>
                                                <option value="Advance" @selected($other->comp_know == 'Advance')> Advance</option>
                                                <option value="Proficient" @selected($other->comp_know == 'Proficient')> Proficient
                                                </option>
                                                <option value="Expert" @selected($other->comp_know == 'Expert')> Expert</option>
                                            </select>
                                            <span class="invalid-feedback d-none ext_act_college" role="alert">
                                                <strong class="ext_act_college_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <fieldset class="mt-3">
                                    <legend>
                                        <p>Languages known / ज्ञात भाषाएँ</p>
                                    </legend>
                                    <div class="col-12 table-responsive">
                                        <table class=" table table-bordered table-striped">
                                            <thead>
                                                <th>Languages</th>
                                                <th>Read</th>
                                                <th>Write</th>
                                                <th>Speak</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>English</td>
                                                    <td><input type="checkbox" name="eng_read" id="eng_read"
                                                            value="1" @checked($other->eng_read == 'YES')></td>
                                                    <td><input type="checkbox" name="eng_Write" id="eng_Write"
                                                            value="1" @checked($other->eng_Write == 'YES')></td>
                                                    <td><input type="checkbox" name="eng_speak" id="eng_speak"
                                                            value="1" @checked($other->eng_speak == 'YES')></td>
                                                </tr>
                                                <tr>
                                                    <td>Hindi</td>
                                                    <td><input type="checkbox" name="hin_read" id="hin_read"
                                                            value="1" @checked($other->hin_read == 'YES')></td>
                                                    <td><input type="checkbox" name="hin_Write" id="hin_Write"
                                                            value="1" @checked($other->hin_Write == 'YES')></td>
                                                    <td><input type="checkbox" name="hin_speak" id="hin_speak"
                                                            value="1" @checked($other->hin_speak == 'YES')></td>
                                                </tr>
                                                <tr>
                                                    <td>Gujarati</td>
                                                    <td><input type="checkbox" name="guj_read" id="guj_read"
                                                            value="1" @checked($other->guj_read == 'YES')></td>
                                                    <td><input type="checkbox" name="guj_Write" id="guj_Write"
                                                            value="1" @checked($other->guj_Write == 'YES')></td>
                                                    <td><input type="checkbox" name="guj_speak" id="guj_speak"
                                                            value="1" @checked($other->guj_speak == 'YES')></td>
                                                </tr>
                                                <tr>
                                                    <td class=" d-flex align-items-center">Other: <div class="col-8"
                                                            style="margin-left: 10px;"><input type="text"
                                                                name="other_lang" id="other_lang"
                                                                value="{{ $other->other_lang }}"
                                                                class=" form-control "></div>
                                                    </td>
                                                    <td><input type="checkbox" name="other_read" id="other_read"
                                                            value="1" @checked($other->other_read == 'YES')></td>
                                                    <td><input type="checkbox" name="other_Write" id="other_Write"
                                                            value="1" @checked($other->other_Write == 'YES')></td>
                                                    <td><input type="checkbox" name="other_speak" id="other_speak"
                                                            value="1" @checked($other->other_speak == 'YES')></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>
                            </fieldset>
                            <div class="col-12 text-center">
                                <a href="#" class="btn btn-custom-2 btn-prev-tab btn-radius py-1"
                                    onclick="previousTab('pills-address-tab')"><i class="bx bx-skip-previous"></i> Prev
                                    Step</a>
                                <button type="submit" class="btn btn-custom-2">
                                    Next Step <i class="bx bx-skip-next"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="pills-work-experience" role="tabpanel"
                        aria-labelledby="pills-work-experience-tab">
                        <form id="work_detail" data-url="{{ route('store-work-experience-detail') }}">
                            <input type="hidden" value="EDIT" name="op_type">
                            <input type="hidden" value="{{$user->id}}" name="user_id">
                            <input type="hidden" value="{{$user->email}}" name="email_id">
                            <fieldset class="mt-3">
                                <legend>
                                    <p>Work Experience (कार्य अनुभव)</p>
                                </legend>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Have You Work Experience?<span class="text-danger">*</span></label><br>
                                            <select class="form-select" name="previous_company_work"
                                                id="previous_company_work" required="">
                                                <option value="NO" @selected($user->previous_company_work == 'NO')>NO</option>
                                                <option value="YES" @selected($user->previous_company_work == 'YES')>YES </option>
                                            </select>
                                            <span class="invalid-feedback d-none previous_company_work" role="alert">
                                                <strong class="previous_company_work_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class=" row mt-2 d-none" id="Work_Experience_Wrapper">
                                        <div class="col-12 table-responsive">
                                            <table class="table  table-bordered table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th>Company Name <br>/ संस्था का नाम</th>
                                                        <th>Start Date <br>/शुरू तिथि</th>
                                                        <th>End Date <br>/समाप्त तिथि</th>
                                                        <th>Salary per month <br>/वेतन प्रति माह</th>
                                                        <th>Designation Post<br>/ पद का नाम</th>
                                                        <th>Reason for Separation<br>/ छोड़ने का कारण</th>
                                                        <th>Certificate Yes / No<br>/ प्रमाणपत्र हां / नहीं</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="previous_company_name"
                                                                value="{{ $user->previous_company_name }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="date" name="previous_company_start_date"
                                                                value="{{ $user->previous_company_start_date }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="date" name="previous_company_end_date"
                                                                value="{{ $user->previous_company_end_date }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="number" name="previous_company_salary"
                                                                value="{{ $user->previous_company_salary }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="previous_company_division"
                                                                value="{{ $user->previous_company_division }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="previous_company_res_living"
                                                                value="{{ $other->previous_company_res_living }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <select name="previous_com_cert" id="previous_com_cert"
                                                                class=" form-select">
                                                                <option value="NO" @selected($other->previous_com_cert == 'NO')>No
                                                                </option>
                                                                <option value="YES" @selected($other->previous_com_cert == 'YES')>Yes
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="previous_company_name_two"
                                                                value="{{ $user->previous_company_name_two }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="date" name="previous_company_start_date_two"
                                                                value="{{ $user->previous_company_start_date_two }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="date" name="previous_company_end_date_two"
                                                                value="{{ $user->previous_company_end_date_two }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="number" name="previous_company_salary_two"
                                                                value="{{ $user->previous_company_salary_two }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="previous_company_division_two"
                                                                value="{{ $user->previous_company_division_two }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="previous_company_res_living_two"
                                                                value="{{ $other->previous_company_res_living_two }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <select name="previous_com_cert_two"
                                                                id="previous_com_cert_two" class=" form-select">
                                                                <option value="NO" @selected($other->previous_com_cert_two == 'NO')>No
                                                                </option>
                                                                <option value="YES" @selected($other->previous_com_cert_two == 'YES')>Yes
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="previous_company_name_three"
                                                                value="{{ $user->previous_company_name_three }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="date"
                                                                name="previous_company_start_date_three"
                                                                value="{{ $user->previous_company_start_date_three }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="date" name="previous_company_end_date_three"
                                                                value="{{ $user->previous_company_end_date_three }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="number" name="previous_company_salary_three"
                                                                value="{{ $user->previous_company_salary_three }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="previous_company_division_three"
                                                                value="{{ $user->previous_company_division_three }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                name="previous_company_res_living_three"
                                                                value="{{ $other->previous_company_res_living_three }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <select name="previous_com_cert_three"
                                                                id="previous_com_cert_three" class=" form-select">
                                                                <option value="NO" @selected($other->previous_com_cert_three == 'NO')>No
                                                                </option>
                                                                <option value="YES" @selected($other->previous_com_cert_three == 'YES')>Yes
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="col-12 text-center">
                                <a href="#" class="btn btn-custom-2 btn-prev-tab btn-radius py-1"
                                    onclick="previousTab('pills-education-tab')"><i class="bx bx-skip-previous"></i>
                                    Prev Step</a>
                                <button type="submit" class="btn btn-custom-2">
                                    Next Step <i class="bx bx-skip-next"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="pills-other" role="tabpanel" aria-labelledby="pills-other-tab">
                        <form id="other_info_detail" data-url="{{ route('store-other-info-detail') }}">
                            <input type="hidden" value="EDIT" name="op_type">
                            <input type="hidden" value="{{$user->id}}" name="user_id">
                            <input type="hidden" value="{{$user->email}}" name="email_id">
                            <fieldset class=" mt-3">
                                <legend>
                                    <p>Other Information</p>
                                </legend>
                                <div class="row">
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>What are your major achievements in your experience? <br> आपके अनुभव में
                                                आपकी
                                                प्रमुख
                                                उपलब्धियां क्या हैं?</label>
                                            <input type="text" name="your_major_achievement"
                                                value="{{ $other->your_major_achievement }}"
                                                id="your_major_achievement" class="form-control">
                                            <span class="invalid-feedback d-none your_major_achievement" role="alert">
                                                <strong class="your_major_achievement_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label> What are your hobbies?<br> आपके शौक क्या है </label>
                                            <input type="text" name="your_hobbies"
                                                value="{{ $other->your_hobbies }}" id="your_hobbies"
                                                class="form-control">
                                            <span class="invalid-feedback d-none your_hobbies" role="alert">
                                                <strong class="your_hobbies_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Do you know four wheeler driving? / क्या आप चार पहिये वाली गाड़ी चलाना
                                                जानते
                                                हैं : </label>
                                            <select class="form-select car_driving " name="car_driving"
                                                id="car_driving">
                                                <option value="NO" @selected($user->car_driving == 'NO')>NO
                                                    (ना)
                                                </option>
                                                <option value="YES" @selected($user->car_driving == 'YES')>YES
                                                    (हाँ)
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2 car_driving_detail d-none">
                                        <div class="form-group">
                                            <label>Driving Licence No <br> लाइसेंस नंबर:</label><br>
                                            <input type="text" name="driving_license"
                                                value="{{ $user->driving_license }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>What do you think, is mobile necessary? if so why <br> आपको क्या लगता है,
                                                क्या
                                                मोबाइल जरूरी है? यदि ऐसा है तो क्यों</label>
                                            <input type="text" name="mobile_necessary"
                                                value="{{ $other->mobile_necessary }}" id="mobile_necessary"
                                                class="form-control">
                                            <span class="invalid-feedback d-none mobile_necessary" role="alert">
                                                <strong class="mobile_necessary_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-8 mt-2">
                                        <div class="form-group">
                                            <label>How many phones do you have (please specify the model)<br>आपके पास कितने
                                                फ़ोन हैं
                                                (कृपया मॉडल निर्दिष्ट करें)</label>
                                            <input type="text" name="how_many_mobile"
                                                value="{{ $other->how_many_mobile }}" id="how_many_mobile"
                                                class="form-control">
                                            <span class="invalid-feedback d-none how_many_mobile" role="alert">
                                                <strong class="how_many_mobile_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label>Does your phone have/don't have internet connection? If yes, which plan
                                                do you
                                                have (2G, 3G, 4G) <br> क्या आपके फोन में इंटरनेट कनेक्शन है/नहीं है? अगर
                                                हां, तो
                                                आपके पास कौन सा प्लान है (2जी, 3जी, 4जी)</label>
                                            <input type="text" name="internet_connection"
                                                value="{{ $other->internet_connection }}" id="internet_connection"
                                                class="form-control">
                                            <span class="invalid-feedback d-none internet_connection" role="alert">
                                                <strong class="internet_connection_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label>Do you think mobile should be used while lunch/studying/working?<br> क्या
                                                आपको
                                                लगता है कि लंच/पढ़ाई/काम करते समय मोबाइल का इस्तेमाल करना चाहिए?</label>
                                            <input type="text" name="mobile_uses"
                                                value="{{ $other->mobile_uses }}" id="mobile_uses"
                                                class="form-control">
                                            <span class="invalid-feedback d-none mobile_uses" role="alert">
                                                <strong class="mobile_uses_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label>For what do you use the internet on the mobile phone? <br> आप फोन पर
                                                इंटरनेट का
                                                उपयोग
                                                किस
                                                लिए करते हैं?</label>
                                            <input type="text" name="what_you_use_net"
                                                value="{{ $other->what_you_use_net }}" id="what_you_use_net"
                                                class="form-control">
                                            <span class="invalid-feedback d-none what_you_use_net" role="alert">
                                                <strong class="what_you_use_net_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label>Why do you want to associate with Suzuki Motor Gujarat Private
                                                Limited<br> आप
                                                सुजुकी मोटर गुजरात प्राइवेट लिमिटेड के साथ क्यों जुड़ना चाहते हैं?</label>
                                            <input type="text" name="want_to_associate"
                                                value="{{ $other->want_to_associate }}" id="want_to_associate"
                                                class="form-control">
                                            <span class="invalid-feedback d-none want_to_associate" role="alert">
                                                <strong class="want_to_associate_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label>Do you have any relative or friend working in Suzuki Group of Companies?
                                                If yes,
                                                please share the details<br> क्या आपका कोई रिश्तेदार या दोस्त सुजुकी ग्रुप
                                                ऑफ कंपनीज
                                                में काम करता है? यदि हाँ, तो कृपया विवरण साझा करें</label>
                                            <input type="text" name="relative_work_with_company"
                                                value="{{ $other->relative_work_with_company }}"
                                                id="relative_work_with_company" class="form-control">
                                            <span class="invalid-feedback d-none relative_work_with_company"
                                                role="alert">
                                                <strong class="relative_work_with_company_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label>Have you suffered any major accident/ illness/ operation in the past? If
                                                yes,
                                                please share the details <br> क्या आप पूर्व में किसी बड़ी
                                                दुर्घटना/बीमारी/ऑपरेशन से
                                                पीड़ित हुए हैं? यदि हाँ, तो कृपया विवरण साझा करें</label>
                                            <input type="text" name="detail_of_past_surgery"
                                                value="{{ $user->detail_of_past_surgery }}"
                                                id="detail_of_past_surgery" class="form-control">
                                            <span class="invalid-feedback d-none detail_of_past_surgery" role="alert">
                                                <strong class="detail_of_past_surgery_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Are you ready to work in Hansalpur, Gujarat? <br> क्या आप गुजरात के
                                                हंसलपुर, में
                                                काम करने के लिए तैयार हैं?</label>
                                            <select name="are_you_ready_work_in_plc" id="are_you_ready_work_in_plc"
                                                class=" form-select">
                                                <option value="NO" @selected($other->are_you_ready_work_in_plc == 'NO')>NO</option>
                                                <option value="YES" @selected($other->are_you_ready_work_in_plc == 'YES')>YES</option>
                                            </select>
                                            <span class="invalid-feedback d-none are_you_ready_work_in_plc"
                                                role="alert">
                                                <strong class="are_you_ready_work_in_plc_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Are you ready to relocate anywhere in India or abroad? <br> क्या आप भारत
                                                या विदेश
                                                में कहीं भी स्थानांतरित होने के लिए तैयार हैं?</label>
                                            <select name="are_you_ready_rel_anyw" id="are_you_ready_rel_anyw"
                                                class=" form-select">
                                                <option value="NO" @selected($other->are_you_ready_rel_anyw == 'NO')>NO</option>
                                                <option value="YES" @selected($other->are_you_ready_rel_anyw == 'YES')>YES</option>
                                            </select>
                                            <span class="invalid-feedback d-none are_you_ready_rel_anyw" role="alert">
                                                <strong class="are_you_ready_rel_anyw_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Are you physically
                                                handicapped <br> क्या आप
                                                शारीरिक
                                                रूप से विकलांग हैंा? </label>
                                            <select class="form-select" name="physically_handicapped"
                                                id="physically_handicapped">
                                                <option value="NO" @selected($user->physically_handicapped == 'NO')>NO
                                                    (ना)</option>
                                                <option value="YES" @selected($user->physically_handicapped == 'YES')>
                                                    YES (हाँ)
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2 d-none physically_handicapped_detail">
                                        <div class="form-group">
                                            <label>If you are handicapped, then give further information <br> अगर आप विकलांग
                                                हैं तो
                                                और
                                                जानकारी दें </label>
                                            <input type="text" name="physically_handicap_information"
                                                value="{{ $user->physically_handicap_information }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Have you or your family been prosecuted by any court? <br> क्या आप या
                                                आपके परिवार
                                                पर किसी न्यायालय द्वारा मुकदमा चलाया गया है?</label>
                                            <select class="form-select" name="gov_action" id="gov_action">
                                                <option value="NO" @selected($other->gov_action == 'NO')>NO
                                                    (ना)</option>
                                                <option value="YES" @selected($other->gov_action == 'YES')>
                                                    YES (हाँ)
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2 d-none gov_action_detail">
                                        <div class="form-group">
                                            <label>If yes,
                                                please share the details <br> यदि हाँ, तो कृपया विवरण साझा करें</label>
                                            <input type="text" name="gov_action_detail"
                                                value="{{ $other->gov_action_detail }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Have you appeared in Suzuki Motors or Mr. Suzuki Interview or Written
                                                Test
                                                before? <br>क्या आप पहले Suzuki Motors या Mr. Suzuki साक्षात्कार या लिखित
                                                परीक्षा
                                                में उपस्थित हुए हैं?</label>
                                            <select class="form-select" name="have_you_appeared_this_com"
                                                id="have_you_appeared_this_com">
                                                <option value="NO" @selected($other->have_you_appeared_this_com == 'NO')>NO
                                                    (ना)</option>
                                                <option value="YES" @selected($other->have_you_appeared_this_com == 'YES')>
                                                    YES (हाँ)
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2 d-none have_you_appeared_this_com_detail">
                                        <div class="form-group">
                                            <label>If yes,
                                                please share the details <br> यदि हाँ, तो कृपया विवरण साझा करें</label>
                                            <input type="text" name="have_you_appeared_this_com_detail"
                                                value="{{ $other->have_you_appeared_this_com_detail }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6  mt-2">
                                        <div class="form-group">
                                            <label>Have you worked with this company<br>क्या आपने इस कंपनी के साथ काम किया
                                                है</label>
                                            <select class="form-select" name="already_worked" id="already_worked">
                                                <option value="NO" @selected($user->already_worked == 'NO')>
                                                    NO
                                                </option>
                                                <option value="YES" @selected($user->already_worked == 'YES')>YES
                                                </option>
                                            </select>
                                            <span class="invalid-feedback d-none already_worked" role="alert">
                                                <strong class="already_worked_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2 d-none already_worked_detail">
                                        <div class="form-group">
                                            <label>If yes, give details of designation, season and duration<br>यदि हाँ, तो
                                                पदनाम,
                                                ऋतु और अवधि का विवरण दें</label>
                                            <input type="text" name="already_worked_detail"
                                                value="{{ $other->already_worked_detail }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for=""> <b>Provide details of 2 responsible references, other than
                                                family
                                                members and friends / परिवार के सदस्यों और दोस्तों के अलावा 2 जिम्मेदार
                                                संदर्भों का
                                                विवरण प्रदान करें</b> </label>
                                        <div class=" table-responsive">
                                            <table class="table  table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Sl.No <br> क्रमांक </th>
                                                        <th>Name of Person <br>/ व्यक्ति का नाम</th>
                                                        <th>Address <br>/पता</th>
                                                        <th>Contact No <br>/संपर्क नंबर</th>
                                                        <th>Since when you know<br>/आप कब से जानते हैं</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            <input type="text" name="resp_per_name_one"
                                                                value="{{ $other->resp_per_name_one }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="resp_per_address_one"
                                                                value="{{ $other->resp_per_address_one }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="resp_per_cont_one"
                                                                value="{{ $other->resp_per_cont_one }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="resp_per_since_know_one"
                                                                value="{{ $other->resp_per_since_know_one }}"
                                                                class="form-control">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                            <input type="text" name="resp_per_name_two"
                                                                value="{{ $other->resp_per_name_two }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="resp_per_address_two"
                                                                value="{{ $other->resp_per_address_two }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="resp_per_cont_two"
                                                                value="{{ $other->resp_per_cont_two }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="resp_per_since_know_two"
                                                                value="{{ $other->resp_per_since_know_two }}"
                                                                class="form-control">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for=""> <b>Additional Information for Background Verification /
                                                पृष्ठभूमि
                                                सत्यापन के लिए अतिरिक्त जानकारी </b> </label>
                                        <p> <b> Address History: Furnish addresses of your residence in the last ten (10)
                                                years.
                                                (Attach additional sheet if you have
                                                more than 5 residential addresses in the last ten years)
                                            </b></p>
                                        <div class="table-responsive">
                                            <table class="table  table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Period of stay From</th>
                                                        <th>Period of stay To</th>
                                                        <th>Address </th>
                                                        <th>State</th>
                                                        <th>Country</th>
                                                        <th>Pin Code</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="addit_info_back_stay_from_one"
                                                                value="{{ $other->addit_info_back_stay_from_one }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_back_stay_to_one"
                                                                value="{{ $other->addit_info_back_stay_to_one }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_address_one"
                                                                value="{{ $other->addit_info_address_one }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <select name="addit_info_state_one" class=" form-select"
                                                                id="addit_info_state_one">
                                                                <option value="">Select State</option>
                                                                @foreach ($states as $state)
                                                                    <option value="{{ $state->id }}"
                                                                        @selected($other->addit_info_state_one == $state->id)>
                                                                        {{ $state->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_country_one"
                                                                value="{{ $other->addit_info_country_one }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_zip_code_one"
                                                                value="{{ $other->addit_info_zip_code_one }}"
                                                                class="form-control">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="addit_info_back_stay_from_two"
                                                                value="{{ $other->addit_info_back_stay_from_two }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_back_stay_to_two"
                                                                value="{{ $other->addit_info_back_stay_to_two }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_address_two"
                                                                value="{{ $other->addit_info_address_two }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <select name="addit_info_state_two" class=" form-select"
                                                                id="addit_info_state_two">
                                                                <option value="">Select State</option>
                                                                @foreach ($states as $state)
                                                                    <option value="{{ $state->id }}"
                                                                        @selected($other->addit_info_state_two == $state->id)>
                                                                        {{ $state->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_country_two"
                                                                value="{{ $other->addit_info_country_two }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_zip_code_two"
                                                                value="{{ $other->addit_info_zip_code_two }}"
                                                                class="form-control">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="addit_info_back_stay_from_three"
                                                                value="{{ $other->addit_info_back_stay_from_three }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_back_stay_to_three"
                                                                value="{{ $other->addit_info_back_stay_to_three }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_address_three"
                                                                value="{{ $other->addit_info_address_three }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <select name="addit_info_state_three" class=" form-select"
                                                                id="addit_info_state_three">
                                                                <option value="">Select State</option>
                                                                @foreach ($states as $state)
                                                                    <option value="{{ $state->id }}"
                                                                        @selected($other->addit_info_state_three == $state->id)>
                                                                        {{ $state->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_country_three"
                                                                value="{{ $other->addit_info_country_three }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_zip_code_three"
                                                                value="{{ $other->addit_info_zip_code_three }}"
                                                                class="form-control">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="addit_info_back_stay_from_four"
                                                                value="{{ $other->addit_info_back_stay_from_four }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_back_stay_to_four"
                                                                value="{{ $other->addit_info_back_stay_to_four }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_address_four"
                                                                value="{{ $other->addit_info_address_four }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <select name="addit_info_state_four" class=" form-select"
                                                                id="addit_info_state_four">
                                                                <option value="">Select State</option>
                                                                @foreach ($states as $state)
                                                                    <option value="{{ $state->id }}"
                                                                        @selected($other->addit_info_state_four == $state->id)>
                                                                        {{ $state->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_country_four"
                                                                value="{{ $other->addit_info_country_four }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_zip_code_four"
                                                                value="{{ $other->addit_info_zip_code_four }}"
                                                                class="form-control">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="addit_info_back_stay_from_five"
                                                                value="{{ $other->addit_info_back_stay_from_five }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_back_stay_to_five"
                                                                value="{{ $other->addit_info_back_stay_to_five }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_address_five"
                                                                value="{{ $other->addit_info_address_five }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <select name="addit_info_state_five" class=" form-select"
                                                                id="addit_info_state_five">
                                                                <option value="">Select State</option>
                                                                @foreach ($states as $state)
                                                                    <option value="{{ $state->id }}"
                                                                        @selected($other->addit_info_state_five == $state->id)>
                                                                        {{ $state->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_country_five"
                                                                value="{{ $other->addit_info_country_five }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="addit_info_zip_code_five"
                                                                value="{{ $other->addit_info_zip_code_five }}"
                                                                class="form-control">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="col-12 text-center">
                                <a href="#" class="btn btn-custom-2 btn-prev-tab btn-radius py-1"
                                    onclick="previousTab('pills-work-experience-tab')"><i
                                        class="bx bx-skip-previous"></i> Prev
                                    Step</a>
                                <button type="submit" class="btn btn-custom-2">
                                    Next Step <i class="bx bx-skip-next"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="pills-document" role="tabpanel"
                        aria-labelledby="pills-document-tab">
                        <form id="doc_detail" data-url="{{ route('store-document-detail') }}">
                            <input type="hidden" value="EDIT" name="op_type">
                            <input type="hidden" value="{{$user->id}}" name="user_id">
                            <input type="hidden" value="{{$user->email}}" name="email_id">
                            <fieldset>
                                <legend>
                                    <p>Documents</p>
                                </legend>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-danger">
                                            <i class="bx bx-edit bx-2x"><strong
                                                    class="notes">&nbsp;Note</strong></i><br>
                                            Before uploading any document make sure the document size is not
                                            more than 100 kb.
                                            The collective size of the documents must not exceed 1.5 MB. /
                                            किसी भी दस्तावेज़ को
                                            अपलोड करने से पहले सुनिश्चित करें कि दस्तावेज़ का आकार 100 kb से
                                            अधिक नहीं है।
                                            दस्तावेजों का सामूहिक आकार 1.5 एमबी से अधिक नहीं होना चाहिए।
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Passport size Photo / पासपोर्ट साइज फोटो <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="passport_photo" id="passport_photo"
                                                class="form-control" @if ($user->passport_photo == null || $user->passport_photo == '') required @endif>
                                            @if (isset($user->passport_photo))
                                                <div class="form-text text-success mt-0 d-flex justify-content-between">File already
                                                    uploaded!  <a href="javascript:void(0);" onclick="image_preview(this)"
                                                    src="{{ getImage($user->passport_photo) }}">View Document</a></div>
                                                        
                                            @endif
                                            <span class="invalid-feedback d-none passport_photo" role="alert">
                                                <strong class="passport_photo_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>10th Certificate / 10 वां प्रमाण पत्र <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="tenth_certificate" id="tenth_certificate"
                                                class="form-control" @if ($user->tenth_certificate == null || $user->tenth_certificate == '') required @endif>
                                            @if (isset($user->tenth_certificate))
                                            <div class="form-text text-success mt-0 d-flex justify-content-between">File already
                                                uploaded!  <a href="javascript:void(0);" onclick="image_preview(this)"
                                                src="{{ getImage($user->tenth_certificate) }}">View Document</a></div>
                                            @endif
                                            <span class="invalid-feedback d-none tenth_certificate" role="alert">
                                                <strong class="tenth_certificate_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>12th Certificate / 12 वां प्रमाण पत्र </label>
                                            <input type="file" name="twelve_certificate" id="twelve_certificate"
                                                class="form-control" @if (!isset($user->id))  @endif>
                                            @if (isset($user->twelve_certificate))
                                            <div class="form-text text-success mt-0 d-flex justify-content-between">File already
                                                uploaded!  <a href="javascript:void(0);" onclick="image_preview(this)"
                                                src="{{ getImage($user->twelve_certificate) }}">View Document</a></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>ITI Certificate / ITI प्रमाण पत्र <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="iti_certificate" id="iti_certificate"
                                                class="form-control" @if ($user->iti_certificate == null || $user->iti_certificate == '') required @endif>
                                            @if (isset($user->iti_certificate))
                                            <div class="form-text text-success mt-0 d-flex justify-content-between">File already
                                                uploaded!  <a href="javascript:void(0);" onclick="image_preview(this)"
                                                src="{{ getImage($user->iti_certificate) }}">View Document</a></div>
                                            @endif
                                            <span class="invalid-feedback d-none iti_certificate" role="alert">
                                                <strong class="iti_certificate_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Aadhar Front / आधार कार्ड <span class="text-danger">*</span></label>
                                            <input type="file" name="aadhar_card_front" id="aadhar_card_front"
                                                class="form-control" @if ($user->aadhar_card_front == null || $user->aadhar_card_front == '') required @endif>
                                            @if (isset($user->aadhar_card_front))
                                            <div class="form-text text-success mt-0 d-flex justify-content-between">File already
                                                uploaded!  <a href="javascript:void(0);" onclick="image_preview(this)"
                                                src="{{ getImage($user->aadhar_card_front) }}">View Document</a></div>
                                            @endif
                                            <span class="invalid-feedback d-none aadharcard" role="alert">
                                                <strong class="aadharcard_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Aadhar Back / आधार कार्ड <span class="text-danger">*</span></label>
                                            <input type="file" name="aadhar_card_back" id="aadhar_card_back"
                                                class="form-control" @if (empty($user->aadhar_card_back)) required @endif>
                                            @if (isset($user->aadhar_card_back))
                                            <div class="form-text text-success mt-0 d-flex justify-content-between">File already
                                                uploaded!  <a href="javascript:void(0);" onclick="image_preview(this)"
                                                src="{{ getImage($user->aadhar_card_back) }}">View Document</a></div>
                                            @endif
                                            <span class="invalid-feedback d-none aadhar_card_back" role="alert">
                                                <strong class="aadhar_card_back_msg"></strong>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>PAN Card / पैन कार्ड </label>
                                            <input type="file" name="pancard" class="form-control">
                                            @if (isset($user->pancard))
                                            <div class="form-text text-success mt-0 d-flex justify-content-between">File already
                                                uploaded!  <a href="javascript:void(0);" onclick="image_preview(this)"
                                                src="{{ getImage($user->pancard) }}">View Document</a></div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Other Graduation</label>
                                            <input type="file" name="other_graduation_file"
                                                id="other_graduation_file" class="form-control">
                                            @if (isset($other->other_graduation_file))
                                            <div class="form-text text-success mt-0 d-flex justify-content-between">File already
                                                uploaded!  <a href="javascript:void(0);" onclick="image_preview(this)"
                                                src="{{ getImage($other->other_graduation_file) }}">View Document</a></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mt-2">
                                <legend>
                                    <p>Confirm & Submit</p>
                                </legend>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input radius-4" name="i_agree"
                                                    type="checkbox"
                                                    {{ isset($user->agreed) && $user->agreed == 'YES' ? 'checked' : '' }}>
                                                <label for="i_agree">
                                                    I hereby confirm that the particulars given above are true and complete
                                                    to the
                                                    best
                                                    of my knowledge and belief. If these are found to be incorrect or
                                                    incomplete,
                                                    the
                                                    Company
                                                    entitled to cancel/terminate my training and cancel my appointment.
                                                    <br>
                                                    मैं एतद्द्वारा पुष्टि करता हूं कि ऊपर दिए गए विवरण मेरे सर्वोत्तम ज्ञान
                                                    और
                                                    विश्वास
                                                    के अनुसार सत्य और पूर्ण हैं। यदि ये गलत या अपूर्ण पाए जाते हैं, तो कंपनी
                                                    मेरे प्रशिक्षण को रद्द/समाप्त करने और मेरी नियुक्ति रद्द करने का हकदार
                                                    है।
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <a href="#" class="btn btn-custom-2 btn-prev-tab btn-radius py-1"
                                            onclick="previousTab('pills-other-tab')"><i class="bx bx-skip-previous"></i>
                                            Prev
                                            Step</a>
                                        <button type="submit" class="btn btn-custom"><i class="fas fa-save"></i>
                                            Submit</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="pills-eligibility" role="tabpanel"
                        aria-labelledby="pills-eligibility-tab">
                        <form id="eligibility_status" accept="javascript:void(0)" data-url="{{ route('update-eligibility') }}">
                            <input type="hidden" value="EDIT" name="op_type">
                            <input type="hidden" value="{{$user->id}}" name="user_id">
                            <input type="hidden" value="{{$user->email}}" name="email_id">
                            <fieldset class="mt-4">
                                <legend> 
                                    <p>Eligible Status</p>
                                </legend>
                                <div class="row">
                                    <div class="col-md-4 mt-1">
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
                                    <div class="col-md-4 mt-1  not_eligibility_wrapper d-none">
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
                            </fieldset>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-custom">
                                    <i class="fas fa-save"></i>
                                    Update Status
                                </button>
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

    <script src="{{ asset('public/assets/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/assets/validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('public/js/msil_form.js') }}"></script>
    <script>
        function nexTab(tab) {
            $('#' + tab).prop('disabled', false);
            $('#' + tab).click();
        }

        function previousTab(tab) {
            $('#' + tab).prop('disabled', false);
            $('#' + tab).click();
        }
        $(() => {

            $('#eligibilityStatus').on('change', function() {
                var value = $(this).val();
                if (value == 'Eligible') {
                    $('.not_eligibility_wrapper').addClass('d-none');
                } else if (value == 'Not Eligible') {
                    $('.not_eligibility_wrapper').removeClass('d-none');
                } else if (value == '' || value == null) {
                    $('.not_eligibility_wrapper').addClass('d-none');
                }
            }).change();

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




            $('#present_state').on('change', function() {
                var idState = this.value;
                if (idState) {
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
                                $('#present_district').val($('#permanent_district').val())
                                    .change();
                                $('#present_district').attr("disabled", true);
                            }
                        }
                    });
                }
            }).change();


            $('#permanent_state').on('change', function() {
                var idState = this.value;
                if (idState) {
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
                }
            }).change();


            $('#dob').on('change', function() {
                $('#dob').removeClass("is-invalid");
                $('#dob-error').remove();
            });
            $('#same_address').click(function() {
                if ($(this).prop("checked") == true) {
                    $('#present_pincode').val($('#permanent_pincode').val());
                    $('#present_pincode').prop('readonly', true);
                    if ($('#permanent_pincode').val().length > 0) {
                        $('#present_pincode').removeClass("is-invalid");
                        $('#present_pincode-error').remove();
                    }
                    $('#present_state').val($('#permanent_state').val()).change();
                    if ($('#permanent_state').val().length > 0) {
                        $('#present_state').removeClass("is-invalid");
                        $('#present_state-error').remove();
                    }
                    $('#present_state').attr("disabled", true);
                    $('#present_district').val($('#permanent_district').val()).change();
                    $('#present_district').attr("disabled", true);
                    if ($('#permanent_district').val().length > 0) {
                        $('#present_district').removeClass("is-invalid");
                        $('#present_district-error').remove();
                    }
                    $('#present_house_street_village').val($('#permanent_house_street_village').val());
                    $('#present_house_street_village').prop('readonly', true);
                    if ($('#permanent_house_street_village').val().length > 0) {
                        $('#present_house_street_village').removeClass("is-invalid");
                        $('#present_house_street_village-error').remove();
                    }
                    $('#present_house_number').val($('#permanent_house_number').val());
                    $('#present_house_number').prop('readonly', true);
                    if ($('#permanent_house_number').val().length > 0) {
                        $('#present_house_number').removeClass("is-invalid");
                        $('#present_house_number-error').remove();
                    }

                    $('#present_post_office_tehsil').val($('#permanent_post_office_tehsil').val());
                    $('#present_post_office_tehsil').prop('readonly', true);
                    if ($('#present_post_office_tehsil').val().length > 0) {
                        $('#present_post_office_tehsil').removeClass("is-invalid");
                        $('#present_post_office_tehsil-error').remove();
                    }


                    $('#present_landline_mobile').val($('#permanent_landline_mobile').val());
                    $('#present_landline_mobile').prop('readonly', true);
                    if ($('#present_landline_mobile').val().length > 0) {
                        $('#present_landline_mobile').removeClass("is-invalid");
                        $('#present_landline_mobile-error').remove();
                    }

                    $('#present_stay_from').val($('#permanent_stay_from').val());
                    $('#present_stay_from').prop('readonly', true);
                    if ($('#present_stay_from').val().length > 0) {
                        $('#present_stay_from').removeClass("is-invalid");
                        $('#present_stay_from-error').remove();
                    }
                    $('#present_stay_to').val($('#permanent_stay_to').val());
                    $('#present_stay_to').prop('readonly', true);
                    if ($('#present_stay_to').val().length > 0) {
                        $('#present_stay_to').removeClass("is-invalid");
                        $('#present_stay_to-error').remove();
                    }


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
                    $('#present_post_office_tehsil').val('');
                    $('#present_house_number').prop('readonly', false);

                    $('#present_landline_mobile').val('');

                    $('#present_stay_from').val('');
                    $('#present_stay_to').val('');
                }
            });
        });

        function ValidatePAN() {
            if ($('#pan_card').val().length > 1) {
                var txtPANCard = document.getElementById("pan_card");
                if (txtPANCard != '') {
                    var regex = /([A-Z]){5}([0-9]){4}([A-Z]){1}$/;
                    if (regex.test(txtPANCard.value.toUpperCase())) {
                        $('#pan_card').removeClass('is-invalid');
                        $('.pan_card').addClass('d-none');
                        $('.pan_card_msg').html('');
                    } else {
                        $('#pan_card').addClass('is-invalid');
                        $('.pan_card').removeClass('d-none');
                        $('.pan_card_msg').html('Invalid pan card format');
                    }
                } else {
                    return true;
                }
            } else {
                $('#pan_card').removeClass('is-invalid');
                $('.pan_card').addClass('d-none');
                $('.pan_card_msg').html('');
                return true;
            }
        }
    </script>
@endsection
