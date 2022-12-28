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
                <button class="nav-link btn active " id="pills-education-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-education" type="button" role="tab" aria-controls="pills-education"
                    aria-selected="false">Education Details
                    शिक्षा विवरण</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link btn " id="pills-work-experience-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-work-experience" disabled type="button" role="tab"
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
            <div class="tab-pane fade show active" id="pills-education" role="tabpanel"
                aria-labelledby="pills-education-tab">
                <form action="javascript:void(0);" id="personal_detail">
                    {{ csrf_field() }}
                    <input type="hidden" name="form_id" value="{{ $form_id }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <fieldset class="mt-3">
                        <legend>
                            <p>Education Details</p>
                        </legend>
                        <fieldset>
                            <legend>
                                <p>10th(दसवीं कक्षा)</p>
                            </legend>
                            <div class="row">
                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>School /Institution (स्कूल/विश्वविद्यालय) <span
                                                class="requiredt">*</span></label>
                                        <input type="text" name="tenth_college_name" id="tenth_college_name"
                                            value="{{ isset($user->tenth_college_name) ? $user->tenth_college_name : old('tenth_college_name') }}"
                                            class="form-control" required="">
                                        <span class="invalid-feedback d-none tenth_college_name" role="alert">
                                            <strong class="tenth_college_name_msg"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>Board / बोर्ड<span class="requiredt">*</span>
                                        </label>
                                        <input type="text" required name="tenth_board" id="tenth_board"
                                            value="{{ isset($user->tenth_board) ? $user->tenth_board : old('tenth_board') }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>Month & Year of Passing / पास होने का महीना और वर्ष<span
                                                class="requiredt">*</span></label>

                                        <input type="text" name="tenth_pass_year_month" id="tenth_pass_year_month"
                                            value="{{ $user->tenth_pass_year_month }}" class="form-control" required>
                                        <span class="invalid-feedback d-none tenth_pass_year_month" role="alert">
                                            <strong class="tenth_pass_year_month_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>Obtained Marks / पाया हुआ मार्क्स<span class="requiredt">*</span></label>
                                        <input type="text" name="tenth_obtain_mark" id="tenth_obtain_mark"
                                            value="{{ $user->tenth_obtain_mark }}" class="form-control" required>
                                        <span class="invalid-feedback d-none tenth_obtain_mark" role="alert">
                                            <strong class="tenth_obtain_mark_msg"></strong>
                                        </span>
                                    </div>
                                </div>


                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>Max Marks / मैक्स मार्क्स<span class="requiredt">*</span></label>
                                        <input type="text" name="tenth_max_mark" id="tenth_max_mark"
                                            value="{{ $user->tenth_max_mark }}" class="form-control" required>
                                        <span class="invalid-feedback d-none tenth_max_mark" role="alert">
                                            <strong class="tenth_max_mark_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>%Percent / प्रतिशत<span class="requiredt">*</span></label>
                                        <input type="number" name="tenth_score" id="tenth_score"
                                            value="{{ isset($user->tenth_score) ? $user->tenth_score : old('tenth_score') }}"
                                            class="form-control" required="">
                                        <span class="invalid-feedback d-none tenth_score" role="alert">
                                            <strong class="tenth_score_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>Reg/ Correspondence / व्यवसायिक व पत्राचार<span
                                                class="requiredt">*</span></label>
                                        <select class="form-select" name="tenth_education_type" id="tenth_education_type"
                                            required="">
                                            <option value="">Select</option>
                                            <option value="Regular" @if (isset($user->tenth_education_type) && $user->tenth_education_type == 'Regular') selected @endif>
                                                {{ 'Regular' }}</option>
                                            <option value="Correspondence"
                                                @if (isset($user->tenth_education_type) && $user->tenth_education_type == 'Correspondence') selected @endif>
                                                {{ 'Correspondence' }}
                                            </option>
                                        </select>
                                        <span class="invalid-feedback d-none tenth_education_type" role="alert">
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
                                        <label>School /Institution (स्कूल/विश्वविद्यालय) <span
                                                class="requiredt">*</span></label>
                                        <input type="text" name="twelve_college_name" id="twelve_college_name"
                                            value="{{ $user->twelve_college_name }}" class="form-control"
                                            required="">
                                        <span class="invalid-feedback d-none twelve_college_name" role="alert">
                                            <strong class="twelve_college_name_msg"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>Board / बोर्ड<span class="requiredt">*</span>
                                        </label>
                                        <input type="text" required name="twelve_board" id="twelve_board"
                                            value="{{ $user->twelve_board }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>Month & Year of Passing / पास होने का महीना और वर्ष<span
                                                class="requiredt">*</span></label>

                                        <input type="text" name="twelve_pass_year_month" id="twelve_pass_year_month"
                                            value="{{ $user->twelve_pass_year_month }}" class="form-control" required>
                                        <span class="invalid-feedback d-none twelve_pass_year_month" role="alert">
                                            <strong class="twelve_pass_year_month_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>Obtained Marks / पाया हुआ मार्क्स<span class="requiredt">*</span></label>
                                        <input type="text" name="twelve_obtain_mark" id="twelve_obtain_mark"
                                            value="{{ $user->twelve_obtain_mark }}" class="form-control" required>
                                        <span class="invalid-feedback d-none twelve_obtain_mark" role="alert">
                                            <strong class="twelve_obtain_mark_msg"></strong>
                                        </span>
                                    </div>
                                </div>


                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>Max Marks / मैक्स मार्क्स<span class="requiredt">*</span></label>
                                        <input type="text" name="twelve_max_mark" id="twelve_max_mark"
                                            value="{{ $user->twelve_max_mark }}" class="form-control" required>
                                        <span class="invalid-feedback d-none twelve_max_mark" role="alert">
                                            <strong class="twelve_max_mark_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>%Percent / प्रतिशत<span class="requiredt">*</span></label>
                                        <input type="number" name="twelve_score" id="twelve_score"
                                            value="{{ $user->twelve_score }}" class="form-control" required="">
                                        <span class="invalid-feedback d-none twelve_score" role="alert">
                                            <strong class="twelve_score_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>Reg/ Correspondence / व्यवसायिक व पत्राचार<span
                                                class="requiredt">*</span></label>
                                        <select class="form-select" name="twelve_education_type"
                                            id="twelve_education_type" required="">
                                            <option value="">Select</option>
                                            <option value="Regular" @selected($user->twelve_education_type == 'Regular')> {{ 'Regular' }}
                                            </option>

                                            <option value="Correspondence"
                                                @if (isset($user->twelve_education_type) && $user->twelve_education_type == 'Correspondence') selected @endif>
                                                {{ 'Correspondence' }}
                                            </option>
                                        </select>
                                        <span class="invalid-feedback d-none twelve_education_type" role="alert">
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
                            <div class="row">
                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>School /Institution (स्कूल/विश्वविद्यालय) <span
                                                class="requiredt">*</span></label>
                                        <input type="text" name="other_college_name" id="other_college_name"
                                            value="{{ $user->other_college_name }}" class="form-control" required="">
                                        <span class="invalid-feedback d-none other_college_name" role="alert">
                                            <strong class="other_college_name_msg"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>Board / बोर्ड<span class="requiredt">*</span>
                                        </label>
                                        <input type="text" required name="other_board" id="other_board"
                                            value="{{ $user->other_board }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>Month & Year of Passing / पास होने का महीना और वर्ष<span
                                                class="requiredt">*</span></label>

                                        <input type="text" name="other_pass_year_month" id="other_pass_year_month"
                                            value="{{ $user->other_pass_year_month }}" class="form-control" required>
                                        <span class="invalid-feedback d-none other_pass_year_month" role="alert">
                                            <strong class="other_pass_year_month_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>Obtained Marks / पाया हुआ मार्क्स<span class="requiredt">*</span></label>
                                        <input type="text" name="other_obtain_mark" id="other_obtain_mark"
                                            value="{{ $user->other_obtain_mark }}" class="form-control" required>
                                        <span class="invalid-feedback d-none other_obtain_mark" role="alert">
                                            <strong class="other_obtain_mark_msg"></strong>
                                        </span>
                                    </div>
                                </div>


                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>Max Marks / मैक्स मार्क्स<span class="requiredt">*</span></label>
                                        <input type="text" name="other_max_mark" id="other_max_mark"
                                            value="{{ $user->other_max_mark }}" class="form-control" required>
                                        <span class="invalid-feedback d-none other_max_mark" role="alert">
                                            <strong class="other_max_mark_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>%Percent / प्रतिशत<span class="requiredt">*</span></label>
                                        <input type="number" name="other_score" id="other_score"
                                            value="{{ $user->other_score }}" class="form-control" required="">
                                        <span class="invalid-feedback d-none other_score" role="alert">
                                            <strong class="other_score_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>Reg/ Correspondence / व्यवसायिक व पत्राचार<span
                                                class="requiredt">*</span></label>
                                        <select class="form-select" name="other_education_type" id="other_education_type"
                                            required="">
                                            <option value="">Select</option>
                                            <option value="Regular" @selected($user->other_education_type == 'Regular')> {{ 'Regular' }}
                                            </option>

                                            <option value="Correspondence"
                                                @if (isset($user->other_education_type) && $user->other_education_type == 'Correspondence') selected @endif>
                                                {{ 'Correspondence' }}
                                            </option>
                                        </select>
                                        <span class="invalid-feedback d-none other_education_type" role="alert">
                                            <strong class="other_education_type_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </fieldset>


                        <div class=" col-12 mt-3">
                            <label for=""> <b>Educational Qualification Verification (Highest Degree)
                                    –</b></label>
                            <div class="row ">
                                <p class=" text-danger mb-1">(Important: Copy of Mark sheet and Degree certificate
                                    MUST be
                                    attached)
                                </p>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>ITI name</label>
                                        <input type="text" name="other_grad_name" id="other_grad_name"
                                            value="{{ $user->other_grad_name }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>ITI Address</label>
                                        <input type="text" name="other_grad_iti_address" id="other_grad_iti_address"
                                            value="{{ $user->other_grad_iti_address }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>University Name and address</label>
                                        <input type="text" name="other_grad_uni_name_address"
                                            id="other_grad_uni_name_address"
                                            value="{{ $user->other_grad_uni_name_address }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>From</label>
                                        <input type="month" name="other_grad_from" id="other_grad_from"
                                            value="{{ $user->other_grad_from }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>To</label>
                                        <input type="month" name="other_grad_to" id="other_grad_to"
                                            value="{{ $user->other_grad_to }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Passed</label>
                                        <select name="other_grad_passed" id="other_grad_passed" class=" form-select">
                                            <option value="NO" @selected($user->other_grad_passed == 'NO')>No</option>
                                            <option value="YES" @selected($user->other_grad_passed == 'YES')>YES</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Program</label>
                                        <select name="other_grad_proram" id="other_grad_proram" class=" form-select">
                                            <option value="">Select Program</option>
                                            <option value="Full Time" @selected($user->other_grad_proram == 'Full Time')>Full Time</option>
                                            <option value="Pasrt Time" @selected($user->other_grad_proram == 'Pasrt Time')>Pasrt Time
                                            </option>
                                            <option value="Day" @selected($user->other_grad_proram == 'Day')>Day</option>
                                            <option value="Evening" @selected($user->other_grad_proram == 'Evening')>Evening</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Student ID/ Enrolment No</label>
                                        <input type="text" name="other_grad_enrol_nu" id="other_grad_enrol_nu"
                                            value="{{ $user->other_grad_enrol_nu }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Type Of Degree</label>
                                        <input type="text" name="other_grad_degre_type" id="other_grad_degre_type"
                                            value="{{ $user->other_grad_degre_type }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Graduation date</label>
                                        <input type="date" name="other_grad_date" id="other_grad_date"
                                            value="{{ $user->other_grad_date }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>ITI Trade</label>
                                        <input type="text" readonly name="other_grad_iti_trade"
                                            id="other_grad_iti_trade" value="{{ $user->other_grad_iti_trade }}"
                                            class="form-control">
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
                                        <label>ITI College (आई. टी. आई. कॉलेज)<span class="requiredt">*</span></label>
                                        <input type="text" name="iti_college_name" id="iti_college_name"
                                            value="{{ $user->iti_college_name }}" class="form-control" required="">
                                        <span class="invalid-feedback d-none iti_college_name" role="alert">
                                            <strong class="iti_college_name_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>From <span class="requiredt">*</span></label>
                                        <input type="text" name="iti_start_from" value="{{ $user->iti_start_from }}"
                                            id="iti_start_from" class="form-control" required="">
                                        <span class="invalid-feedback d-none iti_start_from" role="alert">
                                            <strong class="iti_start_from_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>From To<span class="requiredt">*</span></label>
                                        <input type="text" name="iti_start_to" value="{{ $user->iti_start_to }}"
                                            id="iti_start_to" class="form-control" required="">
                                        <span class="invalid-feedback d-none iti_start_to" role="alert">
                                            <strong class="iti_start_to_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <div class="form-group">
                                        <label>Trade (ट्रेड)<span class="requiredt">*</span></label><br>
                                        <select class="form-select" name="iti_trade" id="iti_trade" required="">
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

                                <div class="col-md-4 mt-2">
                                    <div class="form-group">
                                        <label>Mark Obtained<span class="requiredt">*</span></label>
                                        <input type="number" name="iti_obtain_mark"
                                            value="{{ $user->iti_obtain_mark }}" id="iti_obtain_mark"
                                            class="form-control" required="">
                                        <span class="invalid-feedback d-none iti_obtain_mark" role="alert">
                                            <strong class="iti_obtain_mark_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <div class="form-group">
                                        <label>Any Gap / Back Papers<span class="requiredt">*</span></label>
                                        <input type="text" name="iti_gap_paper" value="{{ $user->iti_gap_paper }}"
                                            id="iti_gap_paper" class="form-control" required="">
                                        <span class="invalid-feedback d-none iti_gap_paper" role="alert">
                                            <strong class="iti_gap_paper_msg"></strong>
                                        </span>
                                    </div>
                                </div>


                                <div class="col-md-4 mt-2">
                                    <div class="form-group">
                                        <label>Total Attendance in ITI<span class="requiredt">*</span></label>
                                        <input type="text" name="iti_attendance" value="{{ $user->iti_attendance }}"
                                            id="iti_attendance" class="form-control" required="">
                                        <span class="invalid-feedback d-none iti_attendance" role="alert">
                                            <strong class="iti_attendance_msg"></strong>
                                        </span>
                                    </div>
                                </div>



                                <div class="col-md-4 mt-2">
                                    <div class="form-group">
                                        <label>Reason for Below 90 % </label>
                                        <input type="text" name="iti_attendance_reason"
                                            value="{{ $user->iti_attendance_reason }}" id="iti_attendance_reason"
                                            class="form-control">
                                        <span class="invalid-feedback d-none iti_attendance_reason" role="alert">
                                            <strong class="iti_attendance_reason_msg"></strong>
                                        </span>
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
                                        <label>Apprenticeship<span class="requiredt">*</span></label><br>
                                        <select class="form-select" name="apprentice" id="apprentice" required="">
                                            <option value="NO" @selected($user->apprentice == 'NO')> NO </option>
                                            <option value="YES" @selected($user->apprentice == 'YES')> YES </option>
                                        </select>
                                    </div>
                                </div>



                                <div class="row d-none" id="apprentice_Wrapper">
                                    <div class="col-md-4 mt-1">
                                        <div class="form-group">
                                            <label>Name<span class="requiredt">*</span></label>
                                            <input type="text" name="apprentice_company_name"
                                                id="apprentice_company_name" value="{{ $user->apprentice_company_name }}"
                                                class="form-control" required="">
                                            <span class="invalid-feedback d-none apprentice_company_name" role="alert">
                                                <strong class="apprentice_company_name_msg"></strong>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mt-1">
                                        <div class="form-group">
                                            <label>From <span class="requiredt">*</span></label>
                                            <input type="text" name="apprentice_start_from"
                                                value="{{ $user->apprentice_start_from }}" id="apprentice_start_from"
                                                class="form-control" required="">
                                            <span class="invalid-feedback d-none apprentice_start_from" role="alert">
                                                <strong class="apprentice_start_from_msg"></strong>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>From To<span class="requiredt">*</span></label>
                                            <input type="text" name="apprentice_start_to"
                                                value="{{ $user->apprentice_start_to }}" id="apprentice_start_to"
                                                class="form-control" required="">
                                            <span class="invalid-feedback d-none apprentice_start_to" role="alert">
                                                <strong class="apprentice_start_to_msg"></strong>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Trade (ट्रेड)<span class="requiredt">*</span></label><br>
                                            <input type="text" name="apprentice_trade" id="apprentice_trade"
                                                value="{{ $user->apprentice_trade }}" class=" form-control">
                                            <span class="invalid-feedback d-none apprentice_trade" role="alert">
                                                <strong class="apprentice_trade_msg"></strong>
                                            </span>
                                        </div>
                                    </div>


                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Mark Obtained<span class="requiredt">*</span></label>
                                            <input type="number" name="apprentice_obtain_mark"
                                                value="{{ $user->apprentice_obtain_mark }}" id="apprentice_obtain_mark"
                                                class="form-control" required="">
                                            <span class="invalid-feedback d-none apprentice_obtain_mark" role="alert">
                                                <strong class="apprentice_obtain_mark_msg"></strong>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label>Any Gap / Back Papers<span class="requiredt">*</span></label>
                                            <input type="text" name="apprentice_gap_paper"
                                                value="{{ $user->apprentice_gap_paper }}" id="apprentice_gap_paper"
                                                class="form-control" required="">
                                            <span class="invalid-feedback d-none apprentice_gap_paper" role="alert">
                                                <strong class="apprentice_gap_paper_msg"></strong>
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
                            <div class="row">
                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>Name<span class="requiredt">*</span></label>
                                        <input type="text" name="diploma_college_name" id="diploma_college_name"
                                            value="{{ $user->diploma_college_name }}" class="form-control"
                                            required="">
                                        <span class="invalid-feedback d-none diploma_college_name" role="alert">
                                            <strong class="diploma_college_name_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>From <span class="requiredt">*</span></label>
                                        <input type="text" name="diploma_start_from"
                                            value="{{ $user->diploma_start_from }}" id="diploma_start_from"
                                            class="form-control" required="">
                                        <span class="invalid-feedback d-none diploma_start_from" role="alert">
                                            <strong class="diploma_start_from_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label>From To<span class="requiredt">*</span></label>
                                        <input type="text" name="diploma_start_to"
                                            value="{{ $user->diploma_start_to }}" id="diploma_start_to"
                                            class="form-control" required="">
                                        <span class="invalid-feedback d-none diploma_start_to" role="alert">
                                            <strong class="diploma_start_to_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <div class="form-group">
                                        <label>Trade (ट्रेड)<span class="requiredt">*</span></label><br>
                                        <input type="text" name="diploma_trade" id="diploma_trade"
                                            value="{{ $user->diploma_trade }}" class=" form-control">
                                        <span class="invalid-feedback d-none diploma_trade" role="alert">
                                            <strong class="diploma_trade_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <div class="form-group">
                                        <label>Mark Obtained<span class="requiredt">*</span></label>
                                        <input type="number" name="diploma_obtain_mark"
                                            value="{{ $user->diploma_obtain_mark }}" id="diploma_obtain_mark"
                                            class="form-control" required="">
                                        <span class="invalid-feedback d-none diploma_obtain_mark" role="alert">
                                            <strong class="diploma_obtain_mark_msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                    <div class="form-group">
                                        <label>Any Gap / Back Papers<span class="requiredt">*</span></label>
                                        <input type="text" name="diploma_gap_paper"
                                            value="{{ $user->diploma_gap_paper }}" id="diploma_gap_paper"
                                            class="form-control" required="">
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
                                    <input type="text" name="reas_gap_any_edu" value="{{ $user->reas_gap_any_edu }}"
                                        id="reas_gap_any_edu" class="form-control" required="">
                                    <span class="invalid-feedback d-none reas_gap_any_edu" role="alert">
                                        <strong class="reas_gap_any_edu_msg"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <div class="form-group">
                                    <label>Extra-curricular activities in school/college?</label>
                                    <input type="text" name="ext_act_college" value="{{ $user->ext_act_college }}"
                                        id="ext_act_college" class="form-control" required="">
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
                                        <option value="Beginner" @selected($user->comp_know == 'Beginner')> Beginner</option>
                                        <option value="Advance" @selected($user->comp_know == 'Advance')> Advance</option>
                                        <option value="Proficient" @selected($user->comp_know == 'Proficient')> Proficient</option>
                                        <option value="Expert" @selected($user->comp_know == 'Expert')> Expert</option>
                                        <option value="Beginner" @selected($user->comp_know == 'Beginner')> Beginner</option>
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
                                            <td><input type="checkbox" name="eng_read" id="eng_read" value="1"
                                                    @checked($user->eng_read == 1)></td>
                                            <td><input type="checkbox" name="eng_Write" id="eng_Write" value="1"
                                                    @checked($user->eng_Write == 1)></td>
                                            <td><input type="checkbox" name="eng_speak" id="eng_speak" value="1"
                                                    @checked($user->eng_speak == 1)></td>
                                        </tr>

                                        <tr>
                                            <td>Hindi</td>
                                            <td><input type="checkbox" name="hin_read" id="hin_read" value="1"
                                                    @checked($user->hin_read == 1)></td>
                                            <td><input type="checkbox" name="hin_Write" id="hin_Write" value="1"
                                                    @checked($user->hin_Write == 1)></td>
                                            <td><input type="checkbox" name="hin_speak" id="hin_speak" value="1"
                                                    @checked($user->hin_speak == 1)></td>
                                        </tr>

                                        <tr>
                                            <td>Gujarati</td>
                                            <td><input type="checkbox" name="guj_read" id="guj_read" value="1"
                                                    @checked($user->guj_read == 1)></td>
                                            <td><input type="checkbox" name="guj_Write" id="guj_Write" value="1"
                                                    @checked($user->guj_Write == 1)></td>
                                            <td><input type="checkbox" name="guj_speak" id="guj_speak" value="1"
                                                    @checked($user->guj_speak == 1)></td>
                                        </tr>

                                        <tr>
                                            <td class=" d-flex align-items-center">Other: <div class="col-8"
                                                    style="margin-left: 10px;"><input type="text" name="other_lang"
                                                        id="other_lang" value="{{ $user->other_lang }}"
                                                        class=" form-control "></div>
                                            </td>
                                            <td><input type="checkbox" name="other_read" id="other_read" value="1"
                                                    @checked($user->other_read == 1)></td>
                                            <td><input type="checkbox" name="other_Write" id="other_Write"
                                                    value="1" @checked($user->other_Write == 1)></td>
                                            <td><input type="checkbox" name="other_speak" id="other_speak"
                                                    value="1" @checked($user->other_speak == 1)></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>
                    </fieldset>

                    
                    <fieldset class="mt-3">
                        <legend>
                            <p>Work Experience (कार्य अनुभव)</p>
                        </legend>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Have You Work Experience?<span class="requiredt">*</span></label><br>
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
                                                    <input type="text" name="previous_company_start_date"
                                                        value="{{ $user->previous_company_start_date }}"
                                                        class="form-control datepicker">
                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_end_date"
                                                        value="{{ $user->previous_company_end_date }}"
                                                        class="form-control datepicker">
                                                </td>
                                                <td>
                                                    <input type="number" name="previous_company_salary"
                                                        value="{{ $user->previous_company_salary }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_designation"
                                                        value="{{ $user->previous_company_designation }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_res_living"
                                                        value="{{ $user->previous_company_res_living }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <select name="previous_company_certi" id="previous_company_certi"
                                                        class=" form-select">
                                                        <option value="NO" @selected($user->previous_company_certi == 'NO')>No</option>
                                                        <option value="YES" @selected($user->previous_company_certi == 'YES')>Yes</option>
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
                                                    <input type="text" name="previous_company_start_date_two"
                                                        value="{{ $user->previous_company_start_date_two }}"
                                                        class="form-control datepicker">
                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_end_date_two"
                                                        value="{{ $user->previous_company_end_date_two }}"
                                                        class="form-control datepicker">
                                                </td>
                                                <td>
                                                    <input type="number" name="previous_company_salary_two"
                                                        value="{{ $user->previous_company_salary_two }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_designation_two"
                                                        value="{{ $user->previous_company_designation_two }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="previous_company_res_living_two"
                                                        value="{{ $user->previous_company_res_living_two }}"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <select name="previous_company_certi_two"
                                                        id="previous_company_certi_two" class=" form-select">
                                                        <option value="NO" @selected($user->previous_company_certi_two == 'NO')>No</option>
                                                        <option value="YES" @selected($user->previous_company_certi_two == 'YES')>Yes</option>
                                                    </select>
                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="col-md-12 next-btn-wrapper">

                        <a href="{{ url('my-form') }}" class=" btn btn-next "><i
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

            $('#apprentice').change(function() {
                if ($(this).val() == 'YES') {
                    $('#apprentice_Wrapper').show();
                } else {
                    $('#apprentice_Wrapper').hide();
                }
            });

            $('#iti_trade').change(function() {
                if ($(this).val() == 'Other') {
                    $('.other_trade_wrapper').show();
                    $('.other_trade').rules("add", {
                        required: true
                    });
                } else {
                    $('.other_trade_wrapper').hide();
                }
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


            $('form').validate({
                // ignore: "input[type='file']",
                rules: {
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
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();

                    var formData = new FormData(form);
                    $.ajax({
                        url: "{{ route('store-education-detail') }}",
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

            $('#iti_trade').change();
            $('#apprentice').change();

        });
    </script>
@endsection
