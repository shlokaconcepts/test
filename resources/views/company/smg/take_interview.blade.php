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

        fieldset {
            border: 1px solid #008cff;
            margin-bottom: 5px;
            padding: 11px 10px 15px 10px;
            border-radius: 6px;
        }

        legend {
            float: unset;
            width: auto;
            margin-bottom: 0 !important;
        }

        legend p {
            font-size: 11pt;
            border: transparent;
            width: auto !important;
            border: 1px solid #008cff;
            box-shadow: 3px 3px 15px #ccc;
            padding: 5px 10px;
            background: #008cff;
            color: white;
            border-radius: 4px;
            margin: 0 auto;
            display: block;
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
                                            value="{{ $user->full_name }} " id="ctl00_ContentPlaceHolder1_TxtCandidateRegNo"
                                            disabled="disabled" class="form-control">
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
                                        <label class="form-label">Application for the post : <span
                                                class="required">*</span></label>
                                        <input type="text" value="{{ $user->cat_name }}" disabled="disabled"
                                            class="form-control">

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
                                                value=""
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
                                <label class="form-label">Written Test : </label>
                                <input name="ctl00$ContentPlaceHolder1$TxtAssessmentQuestions" type="text"
                                    value="{{ getAssessmentDetail($user->id)['total_mark'] }}"
                                    id="ctl00_ContentPlaceHolder1_TxtAssessmentQuestions" disabled="disabled"
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
                <input type="hidden" name="int_type" value="other_interview"/>
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




                    <fieldset class="mt-2">
                        <legend>
                            <p>Grade</p>
                        </legend>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="psychometric_test">Psychometric Test</label>
                                   <input type="number" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class=" form-control" name="psychometric_test" min="0" max="50" id="psychometric_test">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="family_detail">Family Details</label>
                                    <select name="family_details" id="family_details" class=" select2 single-select">
                                        <option value="">Select Grade</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="general_view">General view about Institute</label>
                                    <select name="general_view" id="general_view" class=" select2 single-select">
                                        <option value="">Select Grade</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="social_media">Social Media Savvy</label>
                                    <select name="social_media" id="social_media" class=" select2 single-select">
                                        <option value="">Select Grade</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>


                    <fieldset class=" mt-2">
                        <legend>
                            <p>Competencies</p>
                        </legend>
                        <div class="intermainbody mt-3 mb-3">
                            <div class="interinner table-responsive">
                                <table cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr style="background-color:#F5F5F5">
                                            <td class="ratcol" colspan="4"><b>Rating Scale</b> :</td>
                                        </tr>
                                        <tr>
                                            <td class="ratcol"> <b><i>1-3: Unsatisfactory</i></b> </td>
                                            <td class="ratcol"> <b><i>4-6: Satisfactory</i></b> </td>
                                            <td class="ratcol"> <b><i>7-8: Good</i></b> </td>
                                            <td class="ratcol"> <b><i>9-10: Exceptional</i></b> </td>
                                        </tr>
                                        <tr>
                                            <td class="ratcol"> <i>Does not match the Desired Expectation </i> </td>
                                            <td class="ratcol"> <i>Matching with Desired Expectation</i> </td>
                                            <td class="ratcol"> <i>Surpasses the Expectation</i></td>
                                            <td class="ratcol"> <i>Highly Exceeds Expectation</i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <p> <strong>Technical knowledge:</strong> Candidate demonstrates his Technical & Subject
                                    knowledge.</p>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <select name="tech_know" id="tech_know" class=" select2 single-select">
                                        <option value="">Select Rating</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <p> <strong>Communication:</strong> Candidate expresses thoughts clearly ;
                                    projects positive manner in all forms of communication;
                                    responds diplomatically</p>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <select name="communication" id="communication" class=" select2 single-select">
                                        <option value="">Select Rating</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <p> <strong>Rule Consciousness:</strong> Candidate conveys positive
                                    attitudes towards authority and likelihood of obedience.
                                    exhibit a tendency to show self-discipline</p>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <select name="rule_consciousness" id="rule_consciousness"
                                        class=" select2 single-select">
                                        <option value="">Select Rating</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <p> <strong>Openness to Change:</strong> Readily accepts New Things, new
                                    experiences or acceptance of non-conventional ideas and
                                    continue to work with high level of performance.</p>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <select name="openness_to_change" id="openness_to_change"
                                        class=" select2 single-select">
                                        <option value="">Select Rating</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <p> <strong>Team Player:</strong> Candidate demonstrate ability to work as a
                                    part of team, seeks the perspective, looks for opportunities to
                                    support others on team</p>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <select name="team_player" id="team_player" class=" select2 single-select">
                                        <option value="">Select Rating</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <p><strong>Enthusiasm:</strong> (Go-getter , Energy level, Self-initiatives,
                                    Work commitments)

                                </p>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <select name="enthusiasm" id="enthusiasm" class=" select2 single-select">
                                        <option value="">Select Rating</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <p> <strong>Personality:</strong> Grooming, Good manner & Etiquettes, Body
                                    language
                                </p>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <select name="personality" id="personality" class=" select2 single-select">
                                        <option value="">Select Rating</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>


                    <div class="row mt-3">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group" style="text-align:left">
                                <label class="form-label ">Interviewer Remarks <span class="required">*</span>
                                    :</label>
                                <div class="form-control-wrapper">
                                    <textarea required name="remark" rows="1"
                                        cols="20" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label ">Interview Status <span class="required">*</span>
                                    :</label>
                                <div class="form-control-wrapper">
                                    <select required name="status" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Final Decision"> Final Decision </option>
                                        <option value="Selected"> Selected</option>
                                        <option value="Rejected">Rejected</option>
                                        <option value="Hold">On hold</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-4">
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
