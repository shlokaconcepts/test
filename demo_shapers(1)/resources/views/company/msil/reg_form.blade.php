@extends('form.form_app')
@section('style')
    <link rel="stylesheet" href=" {{ asset('public/assets/css/form_2.css') }}">
    <link href="{{ asset('public/assets/plugins/datetimepicker/css/classic.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/datetimepicker/css/classic.date.css') }}" rel="stylesheet" />
    <style>
        fieldset {
            background: #141c6905;
        }
    </style>
@endsection
@section('wrapper')
    <!--end breadcrumb-->
    <div class="container">
        <div class="row">
            <div class="mx-auto col-md-6 mt-5">
                <img class="w-100" src="{{ getImage($company->logo) }}">
            </div>
            <div class="col-12">
                <div class="form-wrapper border-0 radius-15 shadow-sm mt-2 mb-5">
                    <form action="javascript:void(0);" class="container-fluid" id="userForm" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-md-12 mt-1">
                                <h3>Application Form</h3>
                                <p class=" text-danger">All fields with * are compulsory / * वाले सभी कॉलम अनिवार्य हैं
                                </p>
                            </div>

                            <div class="col-12 ">
                                <div class="alert alert-info">
                                    <i class="bx bx-pencil fa-2x"><strong class="notes">&nbsp;Notes</strong></i><br>
                                    Your age should not be more than <strong>25 years 9 months</strong> at the time of
                                    filling this form. / इस फॉर्म को भरते समय आपकी उम्र 25 साल 9 महीना से ज्यादा नहीं
                                    होनी चाहिए।
                                </div>
                            </div>
                            <fieldset class=" mt-4">
                                <legend>
                                    <p>Personal Information (व्यक्तिगत विवरण)</p>
                                </legend>
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>First Name (पहला नाम):<span class="text-danger">*</span></label>
                                            <input type="text" name="first_name" value="{{ $user->first_name }}"
                                                class="form-control" id="first_name" required>
                                            <span class="invalid-feedback first_name d-none" role="alert">
                                                <strong class="first_name_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> Middle Name (मध्य नाम)</label>
                                            <input type="text" name="middle_name" value="{{ $user->middle_name }}"
                                                class="form-control">
                                                  <span class="invalid-feedback middle_name d-none" role="alert">
                                                <strong class="middle_name_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Last Name (अंतिम नाम)</label>
                                            <input type="text" name="last_name" id="last_name"
                                                value="{{ $user->last_name}}" class="form-control">
                                            <span class="invalid-feedback last_name d-none" role="alert">
                                                <strong class="last_name_msg"></strong>
                                            </span>

                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Date of Birth <br>(जन्म की तारीख) <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="dob" id="dob"
                                                class="form-control dob_datepicker" value="{{ $user->dob }}"
                                                required="">
                                            <span class="invalid-feedback dob d-none" role="alert">
                                                <strong class="dob_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Phone Number (10 digit) / फ़ोन नंबर (10 अंक) <br> <b> Note: Enter
                                                    without
                                                    country code </b> <span class="text-danger">*</span> </label>
                                            <input type="number" name="phone_number"
                                                value="{{$user->phone_number}}"
                                                class="form-control" id="phone_number" required="">
                                            <span class="invalid-feedback phone_number d-none" role="alert">
                                                <strong class="phone_number_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Alternative Mobile Number (वैकल्पिक मोबाइल नंबर) <br> <b> Note: Enter
                                                    without
                                                    country code </b></label>
                                            <input type="number" name="alternative_number"
                                                value="{{ $user->alternative_number }}"
                                                class="form-control">

                                               <span class="invalid-feedback alternative_number d-none" role="alert">
                                                <strong class="alternative_number_msg"></strong>
                                            </span>   
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Email ID (ईमेल आईडी)</label>
                                            <input type="email" id="email" name="email" value="{{ $user->email }}"
                                                readonly class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Gender (लिंग) <span class="text-danger">*</span></label><br>
                                            <select class="form-select" name="gender" id="gender">
                                                <option value="MALE" @selected($user->gender == 'MALE')>
                                                    Male /
                                                    पुरुष
                                                </option>
                                                <option value="FEMALE" @selected($user->gender == 'FEMALE')>
                                                    Female
                                                    /
                                                    महिला</option>
                                                <option value="OTHER" @selected($user->gender == 'OTHER')>
                                                    Other
                                                    /
                                                    अन्य</option>
                                            </select>
                                            <span class="invalid-feedback d-none gender" role="alert">
                                                <strong class="gender_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Marital Status (वैवाहिक स्थिति) <span
                                                    class="text-danger">*</span></label><br>
                                            <select class="form-select" name="marital_status" id="marital_status"
                                                required="">
                                                <option value="Single" @selected($user->marital_status == 'Single')>
                                                    Single / अविवाहित</option>
                                                <option value="Married" @selected($user->marital_status == 'Married')>
                                                    Married / विवाहित</option>
                                            </select>
                                            <span class="invalid-feedback d-none marital_status" role="alert">
                                                <strong class="marital_status_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Category / वर्ग <span class="text-danger">*</span></label><br>
                                            <select class="form-select" name="category" id="category" required="">
                                                <option value="GENERAL" @selected($user->category == 'GENERAL')>
                                                    General
                                                </option>
                                                <option value="OBC"  @selected($user->category == 'OBC')>
                                                    OBC
                                                </option>
                                                <option value="SC" @selected($user->category == 'SC')>SC
                                                </option>
                                                <option value="ST"  @selected($user->category == 'ST')>ST
                                                </option>
                                                <option value="OTHER"  @selected($user->category == 'OTHER')>
                                                    OTHER
                                                </option>
                                            </select>
                                            <span class="invalid-feedback d-none category" role="alert">
                                                <strong class="category_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Aadhar Number / आधार संख्या <span class="text-danger">*</span></label>
                                            <input type="number" name="aadhar_card" id="aadhar_card"
                                                value="{{$user->aadhar_card}}"
                                                class="form-control" required="">
                                            <span class="invalid-feedback aadhar_card d-none" role="alert">
                                                <strong class="aadhar_card_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>PAN Number/ पैन नंबर </label>
                                            <input type="text" name="pan_card" id="pan_card"
                                                onkeyup="ValidatePAN();"
                                                value="{{$user->pan_card}}"
                                                class="form-control" style="text-transform: uppercase;">
                                            <span class="invalid-feedback pan_card d-none" role="alert">
                                                <strong class="pan_card_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Blood group / ब्लड ग्रुप </label><br>
                                            <select class="form-select" name="blood_group" id="blood_group">
                                                <option value="">Select Blood Group</option>
                                                <option value="O+" @selected($user->blood_group == 'O+')>
                                                    O+
                                                </option>
                                                <option value="A+"@selected($user->blood_group == 'A+')>
                                                    A+
                                                </option>
                                                <option value="B+" @selected($user->blood_group == 'B+')>
                                                    B+
                                                </option>
                                                <option value="O-"@selected($user->blood_group == 'O-')>
                                                    O-
                                                </option>
                                                <option value="A-" @selected($user->blood_group == 'A-')>
                                                    A-
                                                </option>
                                                <option value="AB+" @selected($user->blood_group == 'AB+')>
                                                    AB+
                                                </option>
                                                <option value="B-" @selected($user->blood_group == 'B-')>
                                                    B-
                                                </option>
                                                <option value="AB-" @selected($user->blood_group == 'AB-')>
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
                            <fieldset class="mt-2">
                                <legend>
                                    <p>Permanent Address (स्थायी पता )</p>
                                </legend>
                                <div class="row mt-2">
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>House / Flat No (मकान संख्या)<span class="text-danger">*</span></label>
                                            <input type="text" id="permanent_house_number"
                                                name="permanent_house_number" class="form-control" required
                                                value="{{ $user->permanent_house_number}}">
                                            <span class="invalid-feedback permanent_house_number d-none" role="alert">
                                                <strong class="permanent_house_number_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Street / Village (गली/गााँव)<span class="text-danger">*</span></label>
                                            <input type="text" name="permanent_house_street_village"
                                                id="permanent_house_street_village" class="form-control" required
                                                value="{{ $user->permanent_house_street_village }}">
                                            <span class="invalid-feedback permanent_house_street_village d-none"
                                                role="alert">
                                                <strong class="permanent_house_street_village_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>State / राज्य <span class="text-danger">*</span></label><br>
                                            <select class="form-select"
                                                name="permanent_state" id="permanent_state" required="">
                                                <option value="">Select State</option>
                                                @foreach ($pr_state as $state)
                                                    <option value="{{ $state->id }}" @selected($user->permanent_state == $state->id)>
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
                                            <select class="form-select" name="permanent_district" id="permanent_district"
                                                required>
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
                                                value="{{ $user->permanent_pincode}}"
                                                class="form-control " required="">
                                            <span class="invalid-feedback d-none permanent_pincode" role="alert">
                                                <strong class="permanent_pincode_msg"></strong>
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
                                            <input class="form-check-input me-1" type="checkbox" id="same_address">
                                            Is your present address same as permanent address ?
                                        </label>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>House / Flat No (मकान संख्या)<span class="text-danger">*</span></label>
                                            <input type="text" name="present_house_number" class="form-control"
                                                id="present_house_number" required
                                                value="{{$user->present_house_number}}">
                                            <span class="invalid-feedback present_house_number d-none" role="alert">
                                                <strong class="present_house_number_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Street / Village (गली/गााँव)<span class="text-danger">*</span></label>
                                            <input type="text" name="present_house_street_village"
                                                id="present_house_street_village" class="form-control" required
                                                value="{{$user->present_house_street_village}}">
                                            <span class="invalid-feedback present_house_street_village d-none"
                                                role="alert">
                                                <strong class="present_house_street_village_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>State / राज्य <span class="text-danger">*</span></label><br>
                                            <select class="form-select" name="present_state" id="present_state"
                                                required="">
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
                                            <label>District (जिला)<span class="text-danger">*</span></label><br>
                                            <select class="form-select" name="present_district" id="present_district"
                                                required="">
                                                <option value="">Select District</option>
                                            </select>
                                            <span class="invalid-feedback present_state d-none" role="alert">
                                                <strong class="present_state_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Pin Code / पिन कोड <span class="text-danger">*</span></label>
                                            <input type="number" name="present_pincode" id="present_pincode"
                                                value="{{$user->present_pincode}}"
                                                class="form-control" required="">
                                            <span class="invalid-feedback present_pincode d-none" role="alert">
                                                <strong class="present_pincode_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mt-2">
                                <legend>
                                    <p>Family Details</p>
                                </legend>
                                <div class="row mt-2">
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Father's Name / <br>पिता का नाम <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="father_name" id="father_name"
                                                class="form-control"
                                                value="{{$user->father_name}}"
                                                required="">
                                            <span class="invalid-feedback d-none father_name" role="alert">
                                                <strong class="father_name_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Father's Age / <br>पिता की उम्र</label>
                                            <input type="number" name="father_age"
                                                value="{{$user->father_age}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Father's Occupation / <br> पिता का व्यवसाय</label>
                                            <input type="text" name="father_occupation"
                                                value="{{$user->father_occupation}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Father's Annual Income in Rupees / <br> रुपए में पिता की वार्षिक
                                                आय</label>
                                            <input type="number" name="father_annual_income"
                                                value="{{$user->father_annual_income }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Mother's Name / <br>मां का नाम</label>
                                            <input type="text" name="mother_name"
                                                value="{{$user->mother_name}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Mother's Age / <br>माँ की उम्र</label>
                                            <input type="number" name="mother_age"
                                                value="{{$user->mother_age}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Mother's Occupation / <br>मां का व्यवसाय</label>
                                            <input type="text" name="mother_occupation"
                                                value="{{$user->mother_occupation}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Mother's Annual Income in Rupees / <br> रुपए में मां की वार्षिक
                                                आय</label>
                                            <input type="number" name="mother_annual_income"
                                                value="{{$user->mother_annual_income}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Wife's Name / <br> पत्नी का नाम</label>
                                            <input type="text" name="wife_name"
                                                value="{{$user->wife_name}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Wife's Age / <br> पत्नी की उम्र</label>
                                            <input type="number" name="wife_age"
                                                value="{{$user->wife_age }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Wife's Occupation / <br> पत्नी का व्यवसाय</label>
                                            <input type="text" name="wife_occupation"
                                                value="{{$user->wife_occupation }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Wife's Annual Income in Rupees / <br> रुपए में पत्नी की वार्षिक
                                                आय</label>
                                            <input type="number" name="wife_annual_income"
                                                value="{{$user->wife_annual_income}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Sibling 1 's Name / <br> भाई/बहन 1 का नाम</label>
                                            <input type="text" name="s1name"
                                                value="{{$user->s1name}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Sibling 1 's Age / <br> भाई/बहन 1 की उम्र</label>
                                            <input type="number" name="s1sage"
                                                value="{{$user->s1sage}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Sibling 1 's Occupation / <br> भाई/बहन 1 का व्यवसाय</label>
                                            <input type="text" name="s1soccupation"
                                                value="{{$user->s1soccupation }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Sibling 1 's Annual Income in Rupees / <br> रुपए में भाई/बहन 1 की
                                                वार्षिक
                                                आय</label>
                                            <input type="number" name="s1sannualincome"
                                                value="{{$user->s1sannualincome}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Sibling 2 's Name / <br> भाई/बहन 2 का नाम</label>
                                            <input type="text" name="s2name"
                                                value="{{$user->s2name}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Sibling 2 's Age / <br> भाई/बहन 2 की उम्र</label>
                                            <input type="number" name="s2sage"
                                                value="{{$user->s2sage}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Sibling 2 's Occupation / <br> भाई/बहन 2 का व्यवसाय</label>
                                            <input type="text" name="s2soccupation"
                                                value="{{$user->s2soccupation}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Sibling 2 's Annual Income in Rupees / <br>रुपए में भाई/बहन 2 की
                                                वार्षिक
                                                आय</label>
                                            <input type="number" name="s2sannualincome"
                                                value="{{$user->s2sannualincome}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Sibling 3 's Name / <br> भाई/बहन 3 का नाम</label>
                                            <input type="text" name="s3name"
                                                value="{{$user->s3name}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Sibling 3 's Age / <br> भाई/बहन 3 की उम्र</label>
                                            <input type="number" name="s3sage"
                                                value="{{$user->s3sage}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Sibling 3 's Occupation / <br> भाई/बहन 3 का व्यवसाय</label>
                                            <input type="text" name="s3soccupation"
                                                value="{{$user->s3soccupation}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Sibling 3 's Annual Income in Rupees / <br> रुपए में भाई/बहन 3 की
                                                वार्षिक
                                                आय</label>
                                            <input type="number" name="s3sannualincome"
                                                value="{{$user->s3sannualincome}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Children 1 's Name / <br> संतान 1 का नाम</label>
                                            <input type="text" name="child1name"
                                                value="{{$user->child1name}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Children 1 's Age / <br> संतान 1 की उम्र</label>
                                            <input type="number" name="child1sage"
                                                value="{{$user->child1sage}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Children 2 's Name / <br> संतान 2 का नाम</label>
                                            <input type="text" name="child2name"
                                                value="{{$user->child2name}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Children 2 's Age / <br> संतान 2 की उम्र</label>
                                            <input type="number" name="child2sage"
                                                value="{{$user->child2sage}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Children 3 's Name / <br> संतान 3 का नाम</label>
                                            <input type="text" name="child3name"
                                                value="{{$user->child3name}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Children 3 's Age / <br> संतान 3 की उम्र</label>
                                            <input type="number" name="child3sage"
                                                value="{{$user->child3sage}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mt-2">
                                <legend>
                                    <p>Education Details</p>
                                </legend>
                                <fieldset class="mt-2">
                                    <legend>
                                        <p>10th(दसवीं कक्षा)</p>
                                    </legend>
                                    <div class="row mt-2">
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>School /Institution <br> (स्कूल/विश्वविद्यालय) <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="tenth_college_name" id="tenth_college_name"
                                                    value="{{$user->tenth_college_name}}"
                                                    class="form-control" required="">
                                                <span class="invalid-feedback d-none tenth_college_name" role="alert">
                                                    <strong class="tenth_college_name_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Board<br> (बोर्ड)<span class="text-danger">*</span>
                                                </label>
                                                <input type="text" required name="tenth_board" id="tenth_board"
                                                    value="{{ $user->tenth_board}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Reg/ Correspondence <br> (व्यवसायिक व पत्राचार)<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" name="tenth_education_type"
                                                    id="tenth_education_type" required="">
                                                    <option value="">Select</option>
                                        <option value="Regular" @selected($user->tenth_education_type == 'Regular')>
                                                        {{ 'Regular' }}</option>
                                        <option value="Correspondence"@selected($user->tenth_education_type == 'Correspondence')>
                                                        {{ 'Correspondence' }}
                                                    </option>
                                                </select>
                                                <span class="invalid-feedback d-none tenth_education_type" role="alert">
                                                    <strong class="tenth_education_type_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Starting Year <br> (शुरू वर्ष) <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" name="tenth_start_year" id="tenth_start_year"
                                                    required="">
                                                    <option value="">Select Start Year</option>
                                                    @for ($i = date('Y'); $i >= 1980; $i--)
                                                        <option value="{{ $i }}" @selected($user->tenth_start_year == $i)>
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
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" name="tenth_passing_year"
                                                    id="tenth_passing_year" required="">
                                                    <option value="">Select Start Year</option>
                                                    @for ($i = date('Y'); $i >= 1980; $i--)
                                                        <option value="{{ $i }}" @selected($user->tenth_passing_year == $i)>
                                                            {{ $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                                <span class="invalid-feedback d-none tenth_passing_year" role="alert">
                                                    <strong class="tenth_passing_year_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>%Percent <br> (प्रतिशत)<span class="text-danger">*</span></label>
                                                <input type="number" name="tenth_score" id="tenth_score"
                                                    value="{{$user->tenth_score}}"
                                                    class="form-control" required="">
                                                <span class="invalid-feedback d-none tenth_score" role="alert">
                                                    <strong class="tenth_score_msg"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-2">
                                    <legend>
                                        <p>12th(बारहवीं कक्षा)</p>
                                    </legend>
                                    <div class="row mt-2">
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>School/Institution <br> (स्कूल/विश्वविद्यालय)</label>
                                                <input type="text" name="twelve_college_name"
                                                    value="{{$user->twelve_college_name}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Board<br> (बोर्ड) </label>
                                                <input type="text" name="twelve_board" id="twelve_board"
                                                    value="{{$user->twelve_board}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Reg/ Correspondence <br> (व्यवसायिक व पत्राचार)</label>
                                                <select class="form-select" name="twelve_education_type">
                                                    <option value="">Select</option>
                                                    <option value="Regular" @selected($user->twelve_education_type == 'Regular')>
                                                        {{ 'Regular' }}</option>
                                                    <option value="Correspondence" @selected($user->twelve_education_type == 'Correspondence')>
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
                                                        <option value="{{ $i }}" @selected($user->twelve_start_year == $i)>
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
                                                        <option value="{{ $i }}" @selected($user->twelve_passing_year == $i)>
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
                                                    value="{{$user->twelve_score}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-2">
                                    <legend class="educations">
                                        <p>Any Other(Graduation)</p>
                                    </legend>
                                    <div class="row mt-2">
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>College/Institution <br> (कॉलेज/विश्वविद्यालय) </label>
                                                <input type="text" name="other_college_name"
                                                    value="{{$user->other_college_name}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="form-group">
                                                <label>Reg/ Correspondence <br> (व्यवसायिक व पत्राचार)</label>
                                                <select class="form-select" name="other_education_type">
                                                    <option value="">Select</option>
                                                    <option value="Regular" @selected($user->other_education_type == 'Regular')>
                                                        {{ 'Regular' }}</option>
                                                    <option value="Correspondence"@selected($user->other_education_type == 'Correspondence')>
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
                                                        <option value="{{ $i }}" @selected($user->other_start_year == $i)>
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
                                                        <option value="{{ $i }}" @selected($user->other_passing_year == $i)>
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
                                                    value="{{$user->other_score}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </fieldset>
                            <fieldset class="mt-2">
                                <legend>
                                    <p>ITI Details (आई. टी. आई. विवरण)</p>
                                </legend>
                                <div class="row mt-2">
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>ITI College (आई. टी. आई. कॉलेज)<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="iti_college_name" id="iti_college_name"
                                                value="{{$user->iti_college_name}}"
                                                class="form-control" required="">
                                            <span class="invalid-feedback d-none iti_college_name" role="alert">
                                                <strong class="iti_college_name_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>ITI Location (स्थान)<span class="text-danger">*</span></label>
                                            <input type="text" name="iti_college_location"
                                                value="{{$user->iti_college_location}}"
                                                id="iti_college_location" class="form-control" required="">
                                            <span class="invalid-feedback d-none iti_college_location" role="alert">
                                                <strong class="iti_college_location_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>ITI Type (संस्थान)<span class="text-danger">*</span></label><br>
                                            <select class="form-select" name="iti_college_type" id="iti_college_type"
                                                required="">
                                                <option value="Private" @selected($user->iti_college_type == 'Private')>
                                                    Private</option>
                                                <option value="Government" @selected($user->iti_college_type == 'Government')>
                                                    Government</option>
                                            </select>
                                            <span class="invalid-feedback d-none iti_college_type" role="alert">
                                                <strong class="iti_college_type_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>ITI Council/ आईटीआई परिषद<span class="text-danger">*</span></label><br>
                                            <select class="form-select" name="iti_board_type" id="iti_board_type"
                                                required="">
                                                <option value="NCVT" @selected($user->iti_board_type == 'NCVT')>
                                                    NCVT
                                                </option>
                                                <option value="SCVT" @selected($user->iti_board_type == 'SCVT')>
                                                    SCVT
                                                </option>
                                                <option value="SCVT tO NCVT" @selected($user->iti_board_type == 'SCVT tO NCVT')>SCVT to NCVT
                                                </option>
                                            </select>
                                            <span class="invalid-feedback d-none iti_board_type" role="alert">
                                                <strong class="iti_board_type_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Trade (ट्रेड)<span class="text-danger">*</span></label><br>
                                            <select class="form-select" name="iti_trade" id="iti_trade" required="">
                                                <option value="">Select Trade</option>
                                                @foreach (companyTrades($user->company) as $trade)
                                                    <option value="{{ $trade->id }}" @selected($user->iti_trade == $trade->id)>
                                                        {{ $trade->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="invalid-feedback d-none iti_trade" role="alert">
                                                <strong class="iti_trade_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2 other_trade_wrapper" style="display: none;">
                                        <div class="form-group">
                                            <label>Other Trade <span class="text-danger">*</span></label>
                                            <input type="text" name="other_trade"
                                                value="{{$user->other_trade}}"
                                                class="form-control other_trade">
                                            <span class="invalid-feedback d-none other_trade" role="alert">
                                                <strong class="other_trade_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>ITI Passing Year/ आईटीआई पासिंग वर्ष <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" required name="iti_passing_year"
                                                id="iti_passing_year" class="form-control">
                                                <option value="">Select Year</option>
                                                @for ($i = date('Y'); $i >= 1980; $i--)
                                                    <option value="{{ $i }}" @selected($user->iti_passing_year == $i)>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                            <span class="invalid-feedback d-none iti_passing_year" role="alert">
                                                <strong class="iti_passing_year_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Percentage Score in ITI/ आईटीआई में प्रतिशत अंक <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="iti_score" id="iti_score"
                                                value="{{$user->iti_score }}"
                                                class="form-control" required="">
                                            <span class="invalid-feedback d-none iti_score" role="alert">
                                                <strong class="iti_score_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mt-2">
                                <legend>
                                    <p>Apprenticeship (प्रशिक्षु)</p>
                                </legend>
                                <div class="row mt-2">
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Apprenticeship<span class="text-danger">*</span></label><br>
                                            <select class="form-select" name="apprentice" id="apprentice"
                                                required="">
                                                <option value="NO" @selected($user->apprentice == 'NO')>
                                                    NO
                                                </option>
                                                <option value="YES" @selected($user->apprentice == 'YES')>
                                                    YES
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" id="apprentice_Wrapper" style="display: none;">
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Company Name (संस्था का नाम)</label>
                                                <input type="text" name="apprentice_company_name"
                                                    value="{{$user->apprentice_company_name}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Apprenticeship Start Date/ आरंभ तिथि</label>
                                                <input type="text" name="apprentice_start_date"
                                                    value="{{$user->apprentice_start_date}}"
                                                    class="form-control datepicker">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Apprenticeship End Date/ अंतिम तिथि</label>
                                                <input type="text" name="apprentice_end_date"
                                                    value="{{$user->apprentice_end_date}}"
                                                    class="form-control datepicker">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Location (स्थान)</label>
                                                <input type="test" name="apprentice_location"
                                                    value="{{$user->apprentice_location}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Job Area/Shop (विभाग)</label>
                                                <input type="text" name="apprentice_division"
                                                    value="{{$user->apprentice_division}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label>Salary per month /निर्धारित राशि प्रति मास</label>
                                                <input type="number" name="apprentice_salary"
                                                    value="{{$user->apprentice_salary}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mt-2">
                                <legend>
                                    <p>Work Experience (कार्य अनुभव)</p>
                                </legend>
                                <div class="row mt-2">
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>Have You Work Experience?<span class="text-danger">*</span></label><br>
                                            <select class="form-select" name="previous_company_work"
                                                id="previous_company_work" required="">
                                                <option value="NO" @selected($user->previous_company_work == 'NO')>
                                                    NO
                                                </option>
                                                <option value="YES" @selected($user->previous_company_work == 'YES')>
                                                    YES
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
                                                                value="{{$user->previous_company_name}}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="previous_company_start_date"
                                                                value="{{$user->previous_company_start_date}}"
                                                                class="form-control datepicker">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="previous_company_end_date"
                                                                value="{{$user->previous_company_end_date}}"
                                                                class="form-control datepicker">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="previous_company_location"
                                                                value="{{$user->previous_company_location}}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <select class="form-select" name="previous_company_type">
                                                                <option value="">Select Type</option>
                                                                <option value="Regular" @selected($user->previous_company_type == 'Regular')>
                                                                    Regular
                                                                </option>
                                                                <option value="Contract"@selected($user->previous_company_type == 'Contract')>
                                                                    Contract
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="previous_company_division"
                                                                value="{{$user->previous_company_division}}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="number"
                                                                name="previous_company_salary"value="{{$user->previous_company_salary}}"
                                                                class="form-control">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="previous_company_name_two"
                                                                value="{{$user->previous_company_name_two}}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="previous_company_start_date_two"
                                                                value="{{$user->previous_company_start_date_two}}"
                                                                class="form-control datepicker">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="previous_company_end_date_two"
                                                                value="{{$user->previous_company_end_date_two}}"
                                                                class="form-control datepicker">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="previous_company_location_two"
                                                                value="{{$user->previous_company_location_two}}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <select class="form-select" name="previous_company_type_two">
                                                                <option value="">Select Type</option>
                                                                <option value="Regular" @selected($user->previous_company_type_two == 'Regular')>
                                                                    Regular
                                                                </option>
                                                                <option value="Contract" @selected($user->previous_company_type_two == 'Regular')>
                                                                    Contract
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="previous_company_division_two"
                                                        value="{{$user->previous_company_division_two}}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="number"
                                                                name="previous_company_salary_two"value="{{$user->previous_company_salary_two}}"
                                                                class="form-control">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="previous_company_name_three"
                                                                value="{{$user->previous_company_name_three }}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="previous_company_start_date_three"
                                                                value="{{$user->previous_company_start_date_three}}"
                                                                class="form-control datepicker">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="previous_company_end_date_three"
                                                                value="{{$user->previous_company_end_date_three}}"
                                                                class="form-control datepicker">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="previous_company_location_three"
                                                                value="{{$user->previous_company_location_three}}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <select class="form-select"
                                                                name="previous_company_type_three">
                                                                <option value="">Select Type</option>
                                                                <option value="Regular" @selected($user->previous_company_type_three == 'Regular')>
                                                                    Regular
                                                                </option>
                                                                <option value="Contract" @selected($user->previous_company_type_three == 'Contract')>
                                                                    Contract
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="previous_company_division_three"
                                                                value="{{$user->previous_company_division_three}}"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="number"
                                                                name="previous_company_salary_three"value="{{$user->previous_company_salary_three }}"
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
                            <fieldset class="mt-2">
                                <legend>
                                    <p>Other Information (अतिरिक्त सूचना)</p>
                                </legend>
                                <div class="row mt-2">
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <h6 class="filed_sub_heading">Computer Knowledge / (कंप्यूटर ज्ञान) : <span
                                                    class=" text-danger">*</span></h6>
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
                                                        <label for="basic" class="form-check-label">Basic</label><br>
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
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Are you physically
                                                handicapped/&nbsp;क्या आप
                                                शारीरिक
                                                रूप से विकलांग हैंा? </label><br>
                                            <select class="form-select" name="physically_handicapped"
                                                id="physically_handicapped">
                                                <option value="NO" @selected($user->physically_handicapped == 'NO')>
                                                    NO
                                                    (ना)</option>
                                                <option value="YES" @selected($user->physically_handicapped == 'YES')>
                                                    YES (हाँ)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Do you know four wheeler driving? / क्या आप चार पहिये वाली गाड़ी चलाना
                                                जानते
                                                हैं : </label>
                                            <select class="form-select" name="car_driving" id="car_driving">
                                                <option value="NO" @selected($user->car_driving == 'NO')>
                                                    NO
                                                    (ना)
                                                </option>
                                                <option value="YES" @selected($user->car_driving == 'YES')>
                                                    YES
                                                    (हाँ)
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2 physically_handicapped_detail" style="display: none;">
                                        <div class="form-group">
                                            <label>If you are handicapped, then give further information /अगर आप विकलांग
                                                हैं तो
                                                और
                                                जानकारी दें </label>
                                            <input type="text" name="physically_handicap_information"
                                                value="{{$user->physically_handicap_information}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2 car_driving_detail" style="display: none;">
                                        <div class="form-group">
                                            <label>Driving Licence No / लाइसेंस नंबर:</label><br>
                                            <input type="text" name="driving_license"
                                                value="{{$user->driving_license}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label> Are you a patient of epilepsy/or taking medicine related to
                                                epilepsy? क्या
                                                आप मिर्गी के रोगी हैं/या मिर्गी से संबंधित कोई दवाई ले रहे हैं?
                                                (Yes/No)? <span class=" text-danger">*</span></label>
                                            <select class="form-select" name="epilepsy" id="epilepsy">
                                                <option value="NO" @selected($user->epilepsy == 'NO')>
                                                    NO
                                                    (ना)</option>
                                                <option value="YES" @selected($user->epilepsy == 'YES')>
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
                                                value="{{$user->detail_of_past_surgery }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <label>Have you ever been declared Medically Unfit? / क्या आपको कभी
                                                चिकित्सकीय रूप
                                                से अनफिट घोषित किया गया है? </label>
                                            <input type="text" name="medically_unfit"
                                                value="{{$user->medically_unfit}}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <hr class="">
                                        <h6 class="sub_heading">Have you applied to MSIL earlier / क्या आपने पहले MSIL
                                            में
                                            आवेदन किया है? <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-select" name="have_you_applied" id="have_you_applied">
                                                <option value="NO" @selected($user->have_you_applied == 'NO')>
                                                    NO
                                                </option>
                                                <option value="YES" @selected($user->have_you_applied == 'YES')>
                                                    YES
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2 have_you_applied_wrapper d-none">
                                        <p class=" mb-0 pb-0 heading-color">When and where have you applied to this
                                            company?/
                                            तो कब और कहाँ?</p>
                                        <input type="text" name="applied_before"
                                            value="{{$user->applied_before}}"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <hr class="">
                                        <h6 class="sub_heading">Have you worked with MSIL earlier /क्या आपने पहले
                                            मारुति
                                            सुजुकी/एसएमजी
                                            के साथ काम किया है? यदि हां, तो कृपया अपना विवरण दें। <span
                                                class="text-danger">*</span></h6>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-select" name="already_worked" id="already_worked"
                                                required="">
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
                                    <div class="row mt-2" id="already_worked_wrapper" style="display: none;">
                                        <div class="col-md-3 mt-1">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select class="form-select" name="already_worked_category"
                                                    id="already_worked_category">
                                                    <option value="">Select Category</option>
                                                    <option value="TW- Temporary Worker"
                                                        @selected($user->already_worked_category == 'TW- Temporary Worker')>
                                                        TW- Temporary Worker
                                                    </option>
                                                    <option value="CW- Contract Worker"
                                                        @selected($user->already_worked_category == 'CW- Contract Worker')>
                                                        CW- Contract Worker
                                                    </option>
                                                    <option value="Fixed Term Employee"
                                                        @selected($user->already_worked_category == 'Fixed Term Employee')>
                                                        Fixed Term Employee
                                                    </option>
                                                    <option value="Apprenticeship"
                                                        @selected($user->already_worked_category == 'Apprenticeship')>
                                                        Apprenticeship
                                                    </option>
                                                    <option value="ST- Student Trainee"
                                                        @selected($user->already_worked_category == 'ST- Student Trainee')>
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
                                                    value="{{$user->already_worked_staff_id}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-1">
                                            <div class="form-group">
                                                <label>Time Period</label>
                                                <input type="text" name="already_worked_time_period"
                                                    value="{{$user->already_worked_time_period}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-1">
                                            <div class="form-group">
                                                <label>Shop & Location</label>
                                                <input type="text" name="already_worked_shop_location"
                                                    value="{{$user->already_worked_shop_location}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <hr class="">
                                        <h6 class="sub_heading">Do you know anyone in Maruti Suzuki? Please give
                                            details. / यदि आप मारुति सुज़ूकी कंपनी में किसी को पहले से जानते है तो उस
                                            व्यक्ति
                                            का विवरण दीजिये <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-select" name="already_know" id="already_know"
                                                required="">
                                                <option value="NO" @selected($user->already_know == 'NO')>
                                                    NO
                                                </option>
                                                <option value="YES" @selected($user->already_know == 'YES')>YES
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
                                                    value="{{$user->already_know_full_name}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-1">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <input type="text" name="already_know_department"
                                                    value="{{$user->already_know_department}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-1">
                                            <div class="form-group">
                                                <label>Work Location</label>
                                                <input type="text" name="already_know_location"
                                                    value="{{$user->already_know_location}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-1">
                                            <div class="form-group">
                                                <label>Mobile</label>
                                                <input type="number" name="already_know_mobile"
                                                    value="{{$user->already_know_mobile}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-1">
                                            <div class="form-group">
                                                <label>Relation</label>
                                                <input type="text" name="already_know_relation"
                                                    value="{{$user->already_know_relation}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mt-2">
                                <legend>
                                    <p>Documents</p>
                                </legend>
                                <div class="row mt-2">

                                    <div class="col-12">
                                        <div class="alert alert-danger">
                                            <i class="bx bx-edit bx-2x"><strong
                                                    class="notes">&nbsp;Note</strong></i><br>
                                            Before uploading any document make sure the document size is not more than 100
                                            kb.
                                            The collective size of the documents must not exceed 1.5 MB. / किसी भी दस्तावेज़
                                            को
                                            अपलोड करने से पहले सुनिश्चित करें कि दस्तावेज़ का आकार 100 kb से अधिक नहीं है।
                                            दस्तावेजों का सामूहिक आकार 1.5 एमबी से अधिक नहीं होना चाहिए।
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Passport size Photo / पासपोर्ट साइज फोटो <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="passport_photo" @if(!$user->passport_photo) required @endif   id="passport_photo"
                                                accept="image/*" class="form-control">
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
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>10th Certificate / 10 वां प्रमाण पत्र <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="tenth_certificate" @if(!$user->tenth_certificate) required @endif
                                                id="tenth_certificate" accept="image/*" class="form-control">
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
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>12th Certificate / 12 वां प्रमाण पत्र <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="twelve_certificate" @if(!$user->twelve_certificate) required @endif
                                                id="twelve_certificate" accept="image/*" class="form-control">
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
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>ITI Certificate / ITI प्रमाण पत्र <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="iti_certificate" @if(!$user->iti_certificate) required @endif id="iti_certificate"
                                                accept="image/*" class="form-control">
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
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Aadhar Card (Front)/ आधार कार्ड <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="aadhar_card_front" @if(!$user->aadhar_card_front) required @endif
                                                id="aadhar_card_front" accept="image/*" class="form-control">
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
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>Aadhar Card (Back)/ आधार कार्ड <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="aadhar_card_back" 
                                            @if(!$user->aadhar_card_back) required @endif
                                                id="aadhar_card_back" accept="image/*" class="form-control">
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
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label>PAN Card (Front)/ पैन कार्ड <span class="text-danger">*</span></label>
                                            <input type="file" name="pancard" id="pancard" accept="image/*"
                                                class="form-control">
                                            @if (isset($user->pancard))
                                                <div class=" d-flex justify-content-between">
                                                    <div class="form-text text-success mt-0">File already uploaded!
                                                    </div>
                                                    <div>
                                                        <a href="javascript:void(0);" onclick="image_preview(this)"
                                                            src="{{ getImage($user->pancard) }}">View Document</a>
                                                    </div>
                                                </div>
                                            @endif
                                            <span class="invalid-feedback d-none pancard" role="alert">
                                                <strong class="pancard_msg"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>


                            <fieldset class="mt-2">
                                <legend>
                                    <p>Confirm & Submit</p>
                                </legend>
                                <div class="row mt-2">
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input radius-4" name="i_agree"
                                                    type="checkbox"
                                                    {{ isset($user->agreed) && $user->agreed == 'YES' ? 'checked' : '' }}>
                                                <label for="i_agree">
                                                    1. I hereby declare that the particulars given above are true to the
                                                    best of my knowledge
                                                    and belief. Nothing has been hidden or falsely stated above. If, at any
                                                    stage of
                                                    recruitment it is found that I have hidden any facts/ information or if
                                                    any information
                                                    provided by me is found misleading / incorrect, then company may cancel
                                                    my
                                                    candidature and may take appropriate legal action against me, for which
                                                    I will be solely
                                                    responsible. I understand that my appointment in the company services
                                                    will be subject to
                                                    my passing the assessment test, personal interview, and medical
                                                    examination.<br>
                                                    2. I hereby declare that no bribe, money or any other benefit has been
                                                    given to anyone by
                                                    me to participate in the recruitment & selection process. At any stage
                                                    of the recruitment
                                                    process and employment, if it is found that I have given bribe, money or
                                                    any other
                                                    benefit to any person or institution for the purpose of recruitment in
                                                    Maruti Suzuki, then
                                                    the company can reject my candidature and take appropriate legal action
                                                    against me, for
                                                    which I will be solely responsible.I read and understood the mentioned
                                                    declaration and accept it <br>
                                                    1. मैं एतद्वारा घोषणा करता हूँ कि ऊपर दिए गए विवरण मेरे सर्वोत्तम ज्ञान
                                                    और विश्वास के अनुसार सत्य हैं। ऊपर प्रदान की गई जानकारी में कुछ भी
                                                    छिपाया नहीं गया है एवं ना ही कोई जानकारी भ्रामक/गलत प्रदान की गई है।
                                                    भर्ती के किसी भी चरण में यदि यह पाया जाता है कि मैंने कोई तथ्य/जानकारी
                                                    छुपाई है या मेरे द्वारा प्रदान की गई कोई भी जानकारी भ्रामक/ गलत पाई जाती
                                                    है,
                                                    तो कंपनी मेरी उम्मीदवारी को रद्द कर सकती है और मेरे ख़िलाफ़ उचित कानूनी
                                                    कारवाई कर सकती है, जिसके लिए मैं पूरी तरह ज़िम्मेदार होऊँगा ।
                                                    मैं समझता हूँ कि कंपनी की सेवाओं में मेरी नियुक्ति मेरे द्वारा असेसमेंट
                                                    (Assessment) परीक्षा, व्यक्तिगत साक्षात्कार और चिकित्सा परीक्षा उत्तीर्ण
                                                    करने के अधीन होगी ।<br>
                                                    2. मैं एतद्वारा घोषणा करता हूँ कि भर्ती प्रक्रिया के दौरान मेरे द्वारा
                                                    किसी को कोई रिश्वत, धन लाभ या कोई अन्य लाभ नहीं दिया गया है। भर्ती
                                                    प्रक्रिया एवं रोज़गार के किसी भी चरण में यदि यह पता चलता है
                                                    कि मैंने मारुति सुज़ुकी में भर्ती के उद्देश्य से किसी भी व्यक्ति या
                                                    संस्था को रिश्वत, धन लाभ या कोई अन्य लाभ दिया है तो कंपनी मेरी
                                                    उम्मीदवारी को रद्द कर सकती है
                                                    और मेरे ख़िलाफ़ उचित कानूनी कारवाई कर सकती है, जिसके लिए मैं पूरी तरह
                                                    ज़िम्मेदार होऊँगा।
                                                </label><br>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-primary text-white radius-2 mt-2">Submit
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
@endsection
@section('script')
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/picker.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/picker.date.js') }}"></script>
    <script src="{{ secure_asset('public/assets/plugins/select2/js/select2.min.js') }}"></script>
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
            });

            $(".dob_datepicker").pickadate({
                today: 'Today',
                clear: 'Clear',
                close: 'Close',
                format: 'dd-mm-yyyy',
                selectMonths: true,
                selectYears: true,
                max: new Date().toISOString().slice(0, 10),
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


                    if (panFormat() == true) {
                        var formData = new FormData(form);
                        if ($('#present_district').prop("disabled") == true) {
                            formData.append('present_district', $('#present_district').val());
                        }
                        if ($('#present_state').prop("disabled") == true) {
                            formData.append('present_state', $('#present_state').val());
                        }
                        $.ajax({
                            url: "{{ route('store-user-details') }}",
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

            $('.form-select').change();
            $('.select2').change();
        });

        function panFormat() {
            var txtPANCard = document.getElementById("pan_card");
            if (txtPANCard != '') {
                var regex = /([A-Z]){5}([0-9]){4}([A-Z]){1}$/;
                if (regex.test(txtPANCard.value.toUpperCase())) {
                    $('#pan_card').removeClass('is-invalid');
                    $('.pan_card').addClass('d-none');
                    $('.pan_card_msg').html('');
                    return true;
                } else {
                    $('#pan_card').addClass('is-invalid');
                    $('.pan_card').removeClass('d-none');
                    $('.pan_card_msg').html('Invalid pan card format');
                    $('#pan_card').focus();
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
        }

       
    </script>
@endsection
