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
                                {{ $user->cat_name }}
                            </li>

                        </ol>
                    </nav>
                </div>

                <div class="ms-auto">
                    <a href="{{ route('admin.initiate-interview') }}" class="btn btn-primary btn-sm add_exam">
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
                        <div class="col-md-9 col-12">
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label ">Registraion ID : <span class="required">*</span></label>
                                        <div class="form-control-wrapper">
                                            <input name="ctl00$ContentPlaceHolder1$TxtCandidateRegNo" type="text"
                                                value="{{ $user->unique_id }}"
                                                id="ctl00_ContentPlaceHolder1_TxtCandidateRegNo" disabled="disabled"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label ">Candidate Name :<span class="required">*</span> </label>
                                        <input name="ctl00$ContentPlaceHolder1$TxtCandidateRegNo" type="text"
                                            value="{{ $user->full_name }} "
                                            id="ctl00_ContentPlaceHolder1_TxtCandidateRegNo" disabled="disabled"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Mobile No. : <span class="required">*</span></label>
                                        <div class="form-control-wrapper">
                                            <input name="ctl00$ContentPlaceHolder1$TxtCandidateMobile" type="text"
                                                value="{{ $user->phone_number }}"
                                                id="ctl00_ContentPlaceHolder1_TxtCandidateMobile" disabled="disabled"
                                                class="form-control">
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
                                                value="{{ $user->aadhar_card }}"
                                                id="ctl00_ContentPlaceHolder1_TxtCandidateAadhaar" disabled="disabled"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Father's Name : <span class="required">*</span></label>
                                        <div class="form-control-wrapper">
                                            <input name="ctl00$ContentPlaceHolder1$TxtFatherName" type="text"
                                                value="{{ $user->father_name }}"
                                                id="ctl00_ContentPlaceHolder1_TxtFatherName" disabled="disabled"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Date Of Birth : <span class="required">*</span></label>
                                        <div class="form-control-wrapper">
                                            <input name="ctl00$ContentPlaceHolder1$TxtDOB" type="text"
                                                value="{{ date('d/m/Y', strtotime($user->dob)) }}"
                                                id="ctl00_ContentPlaceHolder1_TxtDOB" disabled="disabled"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>



                                <div class="col-lg-3 col-md-3 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Age : <span class="required">*</span></label>
                                        <div class="form-control-wrapper">
                                            <input name="ctl00$ContentPlaceHolder1$TxtAgeYear" type="text"
                                                value="{{ \Carbon\Carbon::parse(date('Y-m-d', strtotime($user->dob)))->diff(\Carbon\Carbon::now())->format('%y') }} Years"
                                                id="ctl00_ContentPlaceHolder1_TxtAgeYear" disabled="disabled"
                                                class="form-control" style="width:47%; float:left; margin-right:10px">
                                            <input name="ctl00$ContentPlaceHolder1$TxtAgeMonth" type="text"
                                                value="{{ \Carbon\Carbon::parse(date('Y-m-d', strtotime($user->dob)))->diff(\Carbon\Carbon::now())->format('%m') }} Month"
                                                id="ctl00_ContentPlaceHolder1_TxtAgeMonth" disabled="disabled"
                                                class="form-control" style="width:47%; float:left">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3  mt-3">
                                    <div class="form-group">
                                        <label class="form-label">ITI Trade : <span class="required">*</span></label>
                                        <div class="form-control-wrapper">
                                            <input name="ctl00$ContentPlaceHolder1$TxtITITrade" type="text"
                                                value="{{ $user->iti_trade }}" id="ctl00_ContentPlaceHolder1_TxtITITrade"
                                                disabled="disabled" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3  mt-3">
                                    <div class="form-group">
                                        <label class="form-label">ITI Passing Year : <span
                                                class="required">*</span></label>
                                        <div class="form-control-wrapper">
                                            <input name="ctl00$ContentPlaceHolder1$TxtITIPassingYear" type="text"
                                                value="{{$user->iti_passing_year}}"
                                                id="ctl00_ContentPlaceHolder1_TxtITIPassingYear" disabled="disabled"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3  mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Worked with MSIL* : <span
                                                class="required">*</span></label>
                                        <div class="form-control-wrapper">
                                            <input name="ctl00$ContentPlaceHolder1$TxtWorkedWithMSIL" type="text"
                                                value="NO" id="ctl00_ContentPlaceHolder1_TxtWorkedWithMSIL"
                                                disabled="disabled" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3  mt-3">
                                    <div class="form-group">
                                        <label class="form-label">If yes, then Staff ID : <span
                                                class="required">*</span></label>
                                        <div class="form-control-wrapper">
                                            <input name="ctl00$ContentPlaceHolder1$TxtMSILStaffID" type="text"
                                                value="NO" id="ctl00_ContentPlaceHolder1_TxtMSILStaffID"
                                                disabled="disabled" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-3 col-6  d-flex justify-content-center align-items-center">
                            <div class=" ">
                                <img src="{{ getImage($user->passport_photo) }}" alt="" class=" img-thumbnail"
                                    style="width: 100%; height: 233px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card border border-danger">
                <div class="card-header bg-danger bg-gradient text-white ">
                    <i class="icon fa fa-list-alt"></i> Assessment Details
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label class="form-label">Technical : </label>
                                <input name="ctl00$ContentPlaceHolder1$TxtAssessmentQuestions" type="text"
                                    value="{{ getAssessmentDetail($user->id)['technical'] }}"
                                    id="ctl00_ContentPlaceHolder1_TxtAssessmentQuestions" disabled="disabled"
                                    class="form-control">
                            </div>
                        </div>



                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label class="form-label">Aptitude : </label>
                                <input name="ctl00$ContentPlaceHolder1$TxtAssessmentAttempted" type="text"
                                    value="{{ getAssessmentDetail($user->id)['aptitude'] }}"
                                    id="ctl00_ContentPlaceHolder1_TxtAssessmentAttempted" disabled="disabled"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label class="form-label">Behavior :</label>
                                <input name="ctl00$ContentPlaceHolder1$TxtAssessmentMarksScored" type="text"
                                    value="{{ getAssBehaviour(getAssessmentDetail($user->id)['behavior']) }}"
                                    id="ctl00_ContentPlaceHolder1_TxtAssessmentMarksScored" disabled="disabled"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label class="form-label">Result :</label>
                                <input type="text"
                                    value="{{ getAssessmentDetail($user->id) ? getAssessmentDetail($user->id)['result'] : '' }}"
                                    disabled="disabled" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>







            <form class="card border border-success" id="interview_submit_form">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="int_type" value="normal_interview"/>
                <div class="card-header bg-success text-white ">
                    <i class="icon fa fa-briefcase"></i> Interview Details
                </div>
                <div class="card-body">

                    <div class="row">

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label class="form-label">Interview Panel : </label>
                                <input name="ctl00$ContentPlaceHolder1$txtInterviewTakenBy" type="text"
                                    value="{{ auth()->user()->getPanelName ? auth()->user()->getPanelName->name : '' }}"
                                    id="ctl00_ContentPlaceHolder1_txtInterviewTakenBy" disabled="disabled"
                                    class="form-control">
                            </div>

                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label class="form-label ">Interview Date :</label>
                                <input type="text" value="{{ date('d-m-Y') }}" disabled="disabled"
                                    class="form-control">

                            </div>
                        </div>


                    </div>




                    <div class="intermainbody mt-3 mb-3">
                        <div class="interinner">

                            <table cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr style="background-color:#F5F5F5">
                                        <td class="ratcol" colspan="4"><b>Rating Scale</b> :</td>
                                    </tr>

                                    <tr>
                                        <td class="ratcol"> <b><i>1: Below Average</i></b> </td>
                                        <td class="ratcol"> <b><i>2: Average</i></b> </td>
                                        <td class="ratcol"> <b><i>3: Good</i></b> </td>
                                        <td class="ratcol"> <b><i>4: Excellent</i></b> </td>
                                    </tr>

                                    <tr>
                                        <td class="ratcol"> <i>Inadequate demonstration Of the Desired
                                                skill/behaviour.</i> </td>
                                        <td class="ratcol"> <i>Inconsistent &amp; partially adequate demonstration
                                                of the desired skill/behaviour.</i> </td>
                                        <td class="ratcol"> <i>Somewhat consistent &amp; adequate demonstration of
                                                the desired skill/behaviour.</i></td>
                                        <td class="ratcol"> <i>Consistent &amp; strong demonstration of the desired
                                                skill.</i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div
                                class="d-inline-flex mb-3 px-2 py-1 fw-semibold  bg-info bg-opacity-10 border border-info border-opacity-10 rounded-2 text-white w-100">
                                A) Personality Traits </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group interview-points"> Physical Appearance <span>(Overall Built,
                                    Grooming, Body Language)</span> </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group" style="text-align:left">
                                <textarea name="physical_appearance" {{ isset($find) && $find->physical_appearance ? 'readonly' : '' }} rows="2"
                                    cols="20" class="form-control" style="height:50px;">{{ isset($find) && $find->physical_appearance ? $find->physical_appearance : '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group interview-points"> Communication <span>(Ability to understand &amp;
                                    communicate in Hindi)</span> </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group" style="text-align:left">
                                <textarea name="communication" {{ isset($find) && $find->communication ? 'readonly' : '' }} rows="2"
                                    cols="20"class="form-control" style="height:50px;">{{ isset($find) && $find->communication ? $find->communication : '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group interview-points">
                                Family Background <span>(Annual Income, Education Background)</span>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group" style="text-align:left">
                                <textarea name="family_background" {{ isset($find) && $find->family_background ? 'readonly' : '' }} rows="2"
                                    cols="20" class="form-control" style="height:50px;">{{ isset($find) && $find->family_background ? $find->family_background : '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row ">
                        <div class="col-lg-12 col-md-12">
                            <div
                                class="d-inline-flex mb-3 px-2 py-1 fw-semibold  bg-info bg-opacity-10 border border-info border-opacity-10 rounded-2 text-white w-100">
                                B) Technical </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group interview-points">
                                Subject Knowledge <span>(Theoretical / Practical Knowledge, Basics of ITI Trade,
                                    Safety norms)</span>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group" style="text-align:left">
                                <select name="subject_knowledge"
                                    {{ isset($find) && $find->subject_knowledge ? 'disabled' : '' }} class="form-control">
                                    <option value="">Select</option>
                                    <option value="1"
                                        {{ isset($find) && $find->subject_knowledge && $find->subject_knowledge == '1' ? 'selected' : '' }}>
                                        1 - Below Average</option>
                                    <option value="2"
                                        {{ isset($find) && $find->subject_knowledge && $find->subject_knowledge == '2' ? 'selected' : '' }}>
                                        2 - Average</option>
                                    <option value="3"
                                        {{ isset($find) && $find->subject_knowledge && $find->subject_knowledge == '3' ? 'selected' : '' }}>
                                        3 - Good</option>
                                    <option value="4"
                                        {{ isset($find) && $find->subject_knowledge && $find->subject_knowledge == '4' ? 'selected' : '' }}>
                                        4 - Excellent</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group interview-points">
                                Previous experience <span>(Nature of job, Relevant experience, Learnings) </span>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group" style="text-align:left">
                                <select name="previous_experience"
                                    {{ isset($find) && $find->previous_experience ? 'disabled' : '' }}
                                    class="form-control">
                                    <option value="">Select</option>
                                    <option value="1"
                                        {{ isset($find) && $find->previous_experience && $find->previous_experience == '1' ? 'selected' : '' }}>
                                        1 - Below Average</option>
                                    <option value="2"
                                        {{ isset($find) && $find->previous_experience && $find->previous_experience == '2' ? 'selected' : '' }}>
                                        2 - Average</option>
                                    <option value="3"
                                        {{ isset($find) && $find->previous_experience && $find->previous_experience == '3' ? 'selected' : '' }}>
                                        3 - Good</option>
                                    <option value="4"
                                        {{ isset($find) && $find->previous_experience && $find->previous_experience == '4' ? 'selected' : '' }}>
                                        4 - Excellent</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row mt-3">
                        <div class="col-lg-12 col-md-12">
                            <div
                                class="d-inline-flex mb-3 px-2 py-1 fw-semibold  bg-info bg-opacity-10 border border-info border-opacity-10 rounded-2 text-white w-100">
                                C) Behavioural </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group interview-points">
                                Discipline <span> (Values punctuality, Follows rules &amp; instructions)</span>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group" style="text-align:left">
                                <select name="discipline" {{ isset($find) && $find->discipline ? 'disabled' : '' }}
                                    class="form-control">
                                    <option value="">Select</option>
                                    <option value="1"
                                        {{ isset($find) && $find->discipline && $find->discipline == '1' ? 'selected' : '' }}>
                                        1 - Below Average</option>
                                    <option value="2"
                                        {{ isset($find) && $find->discipline && $find->discipline == '2' ? 'selected' : '' }}>
                                        2 - Average</option>
                                    <option value="3"
                                        {{ isset($find) && $find->discipline && $find->discipline == '3' ? 'selected' : '' }}>
                                        3 - Good</option>
                                    <option value="4"
                                        {{ isset($find) && $find->discipline && $find->discipline == '4' ? 'selected' : '' }}>
                                        4 - Excellent</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group interview-points">
                                Positive Attitude <span>(Avoids conflict, Does not indulge in aggressive
                                    behaviour)</span>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group" style="text-align:left">
                                <select name="positive_attitude" class="form-control"
                                    {{ isset($find) && $find->positive_attitude ? 'disabled' : '' }}>
                                    <option value="">Select</option>
                                    <option value="1"
                                        {{ isset($find) && $find->positive_attitude && $find->positive_attitude == '1' ? 'selected' : '' }}>
                                        1 - Below Average</option>
                                    <option value="2"
                                        {{ isset($find) && $find->positive_attitude && $find->positive_attitude == '2' ? 'selected' : '' }}>
                                        2 - Average</option>
                                    <option value="3"
                                        {{ isset($find) && $find->positive_attitude && $find->positive_attitude == '3' ? 'selected' : '' }}>
                                        3 - Good</option>
                                    <option value="4"
                                        {{ isset($find) && $find->positive_attitude && $find->positive_attitude == '4' ? 'selected' : '' }}>
                                        4 - Excellent</option>

                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group interview-points">
                                Need for Job <span> (Prefers defined job role)</span>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group" style="text-align:left">
                                <select name="need_for_job" class="form-control"
                                    {{ isset($find) && $find->need_for_job ? 'disabled' : '' }}>
                                    <option value="">Select</option>
                                    <option value="1"
                                        {{ isset($find) && $find->need_for_job && $find->need_for_job == '1' ? 'selected' : '' }}>
                                        1 - Below Average</option>
                                    <option value="2"
                                        {{ isset($find) && $find->need_for_job && $find->need_for_job == '2' ? 'selected' : '' }}>
                                        2 - Average</option>
                                    <option value="3"
                                        {{ isset($find) && $find->need_for_job && $find->need_for_job == '3' ? 'selected' : '' }}>
                                        3 - Good</option>
                                    <option value="4"
                                        {{ isset($find) && $find->need_for_job && $find->need_for_job == '4' ? 'selected' : '' }}>
                                        4 - Excellent</option>

                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group" style="text-align:left">
                                <label class="form-label ">Interviewer Remarks <span class="required">*</span>
                                    :</label>
                                <div class="form-control-wrapper">
                                    <textarea required name="remark" rows="1" {{ isset($find) && $find->remark ? 'readonly' : '' }} cols="20"
                                        class="form-control">{{ isset($find) && $find->remark ? $find->remark : '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label ">Interview Status <span class="required">*</span>
                                    :</label>
                                <div class="form-control-wrapper">
                                    <select required name="status" class="form-control"
                                        {{ isset($find) && $find->status ? 'disabled' : '' }}>
                                        <option value="">Select</option>
                                        <option value="Selected"
                                            {{ isset($find) && $find->status && $find->status == 'Selected' ? 'selected' : '' }}>OK
                                        </option>
                                        <option value="Rejected"
                                            {{ isset($find) && $find->status && $find->status == 'Rejected' ? 'selected' : '' }}>
                                            NOT OK</option>
                                        <option value="Hold"
                                            {{ isset($find) && $find->status && $find->status == 'Hold' ? 'selected' : '' }}>
                                            HOLD</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- @if (isset($find) && $find->status == null) --}}

                        <div class="col-lg-4 col-md-4">
                            <button type="submit" class="btn btn-success submit_btn">Submit</button>
                        </div>
                        {{-- @endif --}}
                    </div>


                </div>
            </form>
        </div>
    </div>
    <!--end page wrapper -->
@endsection

@section('script')
    <script>
        $('#interview_submit_form').on('submit', function(e) {
            e.preventDefault();
            var postData = new FormData(document.getElementById('interview_submit_form'));
            $.ajax({
                type: 'POST',
                data: postData,
                url: "{{ route('admin.store-interview-detail') }}",
                contentType: false,
                processData: false,
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
                            "{{ url('admin/initiate-interview') }}");
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
    </script>
@endsection
