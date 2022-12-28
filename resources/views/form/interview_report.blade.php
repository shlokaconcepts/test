<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('public/' . $setting->site_favicon) }}" type="image/png" />
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/candidate-assesment-form.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet"
        type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Sintony:400,700" rel="stylesheet" type="text/css" />

    <title class=" title no-pri">
        Candidate Application Form - {{ $user->unique_id }} - {{ $user->first_name }} {{ $user->last_name }}
    </title>

    <style>
        .Category-wrapper {
            border-top: 1.5px solid;
        }

        .tblinnermaincol2 img {
            width: 100%;
        }

        @media print {
            .mailwrapper_col {
                display: inherit !important;
            }

            .tblinnermaincol2 {
                display: flex;
            }

            .intermainbody {
                margin-top: 9px;
            }

            .pageheadcol1 {
                line-height: 17px !important;
            }

            .tblinnermaincol2 img {
                width: 120px !important;
            }

            .empdetails {
                width: 476px !important;
            }

            .tblinnermaincol2 {
                width: 196px !important;
            }
        }

        @page {
            margin-top: 0mm;
            margin-bottom: 0mm;
        }

        .intermainbody {
            margin-top: 9px;
        }

        .pageheadcol1 {
            line-height: 17px !important;
        }

        .headbox {
            padding: 0px 5px 5px 5px !important;
        }

        .tblinnermaincol2 img {
            width: 120px !important;
        }

        .empdetails {
            width: 476px !important;
        }

        .tblinnermaincol2 {
            width: 196px !important;
        }
    </style>
</head>

<body>

    <?php
    $trade = '';
    if (is_numeric($user->iti_trade)) {
        $trade = $user->trade_iti;
    } else {
        $trade = $user->iti_trade;
    }
    
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 text-center  mt-3 mb-2">
                <button class=" btn btn-primary  " onclick="printpage();" id="printpagebutton">Print Form</button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="mainwrapper" style="border:2px solid #333;padding:10px">

            <!------------// Page Heading  //--------------->
            <div class="pagehead">
                <div class="pageheadcol1">
                    <b><u>Interview Assessment Sheet</u></b> <br><span> <span id="lblRegistrationType">
                            {{ $user->reg_cat_name }}
                        </span></span>
                </div>
            </div>


            <div class="headbox borbot"> Personal Information</div>

            <div class="perosnalbx">
                <table class="perosnaltable " cellpadding="0" cellspacing="0">

                    <tr>
                        <td class="tblinnermaincol1">
                            <div class="tblinnerempdetails">
                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="intercolone">Date of Interview</td>
                                        <td class="intercoltwo" style="border-right:1px solid #333">
                                            <span
                                                id="lblDateofInterview">{{ date('d/m/Y', strtotime($interview->interview_date)) }}</span>
                                        </td>

                                        <td class="intercolone">Interview Location</td>
                                        <td class="intercoltwo">
                                            <span id="lblInterviewLocation">{{ $interview->location }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="intercolone">Registration ID</td>
                                        <td class="intercoltwo" style="border-right:1px solid #333">
                                            <span id="lblRegistrationId">{{ $user->unique_id }}</span>
                                        </td>

                                        <td class="intercolone">Aadhaar Number</td>
                                        <td class="intercoltwo">
                                            <span id="lblAadhaar">{{ $user->aadhar_card }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="intercolone">Name of Candidate</td>
                                        <td class="intercoltwo" style="border-right:1px solid #333">
                                            <span id="lblNameofCandidate">{{ $user->first_name }}
                                                {{ $user->last_name }}</span>
                                        </td>

                                        <td class="intercolone">Father’s Name</td>
                                        <td class="intercoltwo">
                                            <span id="lblFathersName">{{ $user->father_name }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="intercolone">DOB (DD/MM/YYYY)</td>
                                        <td class="intercoltwo" style="border-right:1px solid #333">
                                            <span id="lblDOB">{{ date('d/m/Y', strtotime($user->dob)) }}</span>
                                        </td>

                                        <td class="intercolone">Age </td>
                                        <td class="intercoltwo"> <span
                                                id="lblYear">{{ ageCalculatorYear($user->dob) }}</span> Years &nbsp;
                                            <span id="lblMonth">{{ ageCalculatorMonth($user->dob) }}</span> Months
                                        </td>

                                    </tr>

                                    <tr>
                                        <td class="intercolone">ITI Trade</td>
                                        <td class="intercoltwo" style="border-right:1px solid #333">
                                            <span id="lblITITrade">{{ $trade }}</span>
                                        </td>

                                        <td class="intercolone">ITI Passing Year</td>
                                        <td class="intercoltwo">
                                            <span id="lblITIPassingYear">{{ $user->iti_passing_year }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="intercolone">Worked with MSIL*</td>
                                        <td class="intercoltwo" style="border-right:1px solid #333">
                                            <span
                                                id="lblWorkedwithMSILYes">{{ $user->already_worked == '0' ? 'NO' : 'YES' }}</span>
                                            <span id="lblWorkedwithMSILNo"></span>
                                        </td>

                                        <td class="intercolone">If yes, then Staff ID</td>
                                        <td class="intercoltwo">
                                            <span id="lblStaffID">{{ $user->already_worked_staff_id }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>


                    </tr>

                </table>
            </div>


            <div class="intermainbody">
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
                                <td class="ratcol"> <i>Inadequate demonstration Of the Desired skill/behaviour.</i>
                                </td>
                                <td class="ratcol"> <i>Inconsistent &amp; partially adequate demonstration of the
                                        desired skill/behaviour.</i> </td>
                                <td class="ratcol"> <i>Somewhat consistent &amp; adequate demonstration of the desired
                                        skill/behaviour.</i></td>
                                <td class="ratcol"> <i>Consistent &amp; strong demonstration of the desired skill.</i>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>


            <div class="intermainbody">
                <div class="interinner">

                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td class="interquescolone" style="padding-left:0px; border-right:none">
                                    <div class="headbox" style="border-bottom:1px solid #333"> A) Personality Traits
                                    </div>
                                </td>

                                <td class="interquescoltwo" style="padding-left:0px">
                                    <div class="headbox" style="border-bottom:1px solid #333"> Comments </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="interquescolone">
                                    <b>Physical Appearance </b> (Overall Built, Grooming, Body Language)
                                </td>

                                <td class="interquescoltwo"><span
                                        id="lblAPhysicalAppearanc">{{ $interview->physical_appearance }}</span></td>
                            </tr>

                            <tr>
                                <td class="interquescolone">
                                    <b>Communication </b> (Ability to understand &amp; communicate in Hindi)
                                </td>

                                <td class="interquescoltwo"><span
                                        id="lblACommunication">{{ $interview->communication }}</span></td>
                            </tr>

                            <tr>
                                <td class="interquescolone">
                                    <b>Family Background</b> (Annual Income, Education Background)
                                </td>

                                <td class="interquescoltwo"><span
                                        id="lblAFamilyBackground">{{ $interview->family_background }}</span></td>
                            </tr>

                            <tr>
                                <td class="interquescolone" style="padding-left:0px; border-right:none">
                                    <div class="headbox" style="border-bottom:1px solid #333"> B) Technical </div>
                                </td>

                                <td class="interquescoltwo" style="padding-left:0px">
                                    <div class="headbox" style="border-bottom:1px solid #333"> Ratings
                                        1 to 4) </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="interquescolone">
                                    <b>Subject Knowledge </b> (Theoretical / Practical Knowledge, Basics of ITI Trade,
                                    Safety norms)
                                </td>

                                <td class="interquescoltwo"><span
                                        id="lblBSubjectKnowledge">{{ $interview->subject_knowledge }}</span></td>
                            </tr>

                            <tr>
                                <td class="interquescolone">
                                    <b>Previous experience </b> (Nature of job, Relevant experience, Learnings)
                                </td>

                                <td class="interquescoltwo"><span
                                        id="lblBFamilyBackground">{{ $interview->previous_experience }}</span></td>
                            </tr>

                            <tr>
                                <td class="interquescolone" style="padding-left:0px; border-right:none">
                                    <div class="headbox" style="border-bottom:1px solid #333"> C) Behavioural </div>
                                </td>

                                <td class="interquescoltwo" style="padding-left:0px">
                                    <div class="headbox" style="border-bottom:1px solid #333"> Ratings (1 to 4) </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="interquescolone">
                                    <b>Discipline </b> (Values punctuality, Follows rules &amp; instructions)
                                </td>

                                <td class="interquescoltwo"><span
                                        id="lblCDiscipline">{{ $interview->discipline }}</span></td>
                            </tr>

                            <tr>
                                <td class="interquescolone">
                                    <b>Positive Attitude </b> (Avoids conflict, Does not indulge in aggressive behaviour
                                </td>

                                <td class="interquescoltwo"><span
                                        id="lblCPositiveAttitude">{{ $interview->positive_attitude }}</span></td>
                            </tr>

                            <tr>
                                <td class="interquescolone">
                                    <b>Need for Job </b> (Prefers defined job role)
                                </td>

                                <td class="interquescoltwo"><span
                                        id="lblCNeedforJob">{{ $interview->need_for_job }}</span></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>




            <div class="intermainbody">
                <div class="interinner">

                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr style="background-color:#F5F5F5">
                                <td class="indmaincolone"> <b>Interviewer’s Remarks</b> </td>
                                <td class="indmaincoltwo" colspan="2"> <b>Interview Panel Details</b> </td>
                                <td class="indmaincolthree"> <b>Result</b> </td>
                            </tr>

                            <tr>
                                <td class="indmaincolone"> <span
                                        id="lblInterviewRemarks">{{ $interview->remark }}</span> </td>
                                <td class="indmaincoltwo" colspan="2" style="padding-left:0px">
                                    <table cellpadding="0" cellspacing="0" style="width:100%">
                                        <tbody>
                                            <tr>
                                                <td class="indcolone"></td>
                                                <td class="indcoltwo"> Interviewer 1 </td>
                                                <td class="indcolthree">Interviewer 2</td>
                                            </tr>
                                            <tr>
                                                <td class="indcolone" style="border-bottom:none">SIGNATURE</td>
                                                <td class="indcoltwo" style="border-bottom:none; text-align:center">
                                                    @if ($interview->interviewer_id != null && getInterviewerUsername($interview->interviewer_id)['username'] != null)
                                                        <img id="ImgInterviewer1"
                                                            style="width: 150px; border-width: 0px;"
                                                            src="{{ getImage(getInterviewersTechnical(getInterviewerUsername($interview->interviewer_id)['username'])['signature']) }}">
                                                        <span
                                                            id="lblInterviewer1">{{ getInterviewersTechnical(getInterviewerUsername($interview->interviewer_id)['username'])['name'] }}</span>
                                                    @else
                                                        <span id="lblInterviewer1">--</span>
                                                    @endif
                                                </td>

                                                <td class="indcolthree" style="border-bottom:none; text-align:center">
                                                    @if ($interview->interviewer_id != null && getInterviewerUsername($interview->interviewer_id)['username'] != null)
                                                        <img id="ImgInterviewer2"
                                                            style="width: 150px; border-width: 0px;" class="img-fluid"
                                                            src="{{ getImage(getInterviewersHR(getInterviewerUsername($interview->interviewer_id)['username'])['signature']) }}">
                                                        <br>
                                                        <span
                                                            id="lblInterviewer2">{{ getInterviewersHR(getInterviewerUsername($interview->interviewer_id)['username'])['name'] }}</span>
                                                    @else
                                                        <span id="lblInterviewer2">--</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="indmaincolthree"> <span
                                        id="lblInterviewResult">{{ $interview->status == 'ok' ? 'Selected' : $interview->status }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="intermainbody">


                <div class="pagehead">
                    <div class="pageheadcol1" style="border:1px solid #333"> <b>Candidate Assessment report</b>
                        <br /> <span>(<span id="lblRegistrationType">{{ $user->reg_cat_name }}</span>)</span>
                    </div>
                </div>
                <div class="headbox borbot"> Personal Information (व्यक्तिगत विवरण) </div>
                <div class="perosnalbx">
                    <table class="perosnaltable" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="tblinnermaincol1" valign="top">
                                <div class="tblinnerempdetails">
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="emphead">Registration Id: </td>
                                            <td class="empdetails"><span
                                                    id="lblRegistrationId">{{ $user->unique_id }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="emphead">Full Name : </td>
                                            <td class="empdetails"><span id="lblFullName">{{ $user->first_name }}
                                                    {{ $user->last_name }} </span></td>
                                        </tr>
                                        <tr>
                                            <td class="emphead">Birthdate (जन्म तिथि) : </td>
                                            <td class="empdetails"> <span
                                                    id="lblBirthDate">{{ date('d/m/Y', strtotime($user->dob)) }}
                                                </span> <span class="rightpos"> <b>Age (उम्र) (YY/MM)</b> :
                                                    <span id="lblAgeYear">{{ ageCalculatorYear($user->dob) }}
                                                    </span>
                                                    Years / <span
                                                        id="lblAgeMonth">{{ ageCalculatorMonth($user->dob) }}</span></span>
                                                Month </td>
                                        </tr>
                                        <tr>
                                            <td class="emphead">Father's Name (पिता का नाम) : </td>
                                            <td class="empdetails"><span
                                                    id="lblFatherName">{{ $user->father_name }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="emphead">Mother's Name (माता का नाम) : </td>
                                            <td class="empdetails"><span id="lblMotherName">{{ $user->mother_name }}
                                                </span></td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                            <td class="tblinnermaincol2 text-center"> <img id="ImgCandidate"
                                    src="{{ getImage($user->passport_photo) }}" style="border-width:0px;" />
                            </td>
                        </tr>
                        <tr class=" Category-wrapper">
                            <td colspan="2" class="tblinnermaincol1" style="border-right:none" valign="top">
                                <div class="tblinnerempdetails">
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="detailcolone"><b>Category (श्रेणी)</b> :</td>
                                            <td class="detailcolthree" colspan="2"> <span
                                                    id="lblCategory">{{ $user->category }}</span></td>
                                            <td class="detailcolfour" colspan="2"><b>Domicile State (मूल
                                                    निवास
                                                    प्रमाणपत्र)</b> :</td>
                                            <td class="detailcolseven" colspan="2"> <span
                                                    id="lblDomicileState">{{ $user->permanent_state_name }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="detailcolone"><b>Marital Status (वैवाहिक स्थिति)</b> :
                                            </td>
                                            <td class="detailcolthree" colspan="2"> <span
                                                    id="lblMaritalStatus">{{ $user->marital_status }}</span>
                                            </td>
                                            <td class="detailcolfour" colspan="2"><b>Email ID (ईमेल
                                                    आईडी)</b> :
                                            </td>
                                            <td class="detailcolseven" colspan="2"> <span
                                                    id="lblEmail">{{ $user->email }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="detailcolone"><b>Mobile / (मोबाइल)</b> :</td>
                                            <td class="detailcoltwo">मोबाइल 1 :</td>
                                            <td class="detailcolthree"> <span
                                                    id="lblMobileNo">{{ $user->phone_number }}</span></td>
                                            <td class="detailcolfour">मोबाइल 2 :</td>
                                            <td class="detailcolfive"> <span id="lblAlternateMobile">
                                                    {{ $user->alternative_number }}</span></td>
                                            <td class="detailcolsix"> <b>Blood Group <br />(ब्लड ग्रुप)</b> :
                                            </td>
                                            <td class="detailcolseven"> <span
                                                    id="lblBloodGroup">{{ $user->blood_group }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="detailcolone"><b>Aadhaar Number (आधार)</b> : </td>
                                            <td class="detailcolthree" colspan="2"><span
                                                    id="lblAadhaar">{{ $user->aadhar_card }}</span></td>
                                            <td class="detailcolfour"><b>PAN No. (पैन)</b> : </td>
                                            <td class="detailcolseven" colspan="3"><span
                                                    id="lblPANNo">{{ $user->pancard }}</span></td>
                                        </tr>

                                        <tr>
                                            <td colspan="7">
                                                <div class="headbox" style="border-left:none;border-right:none">
                                                    Assessment Details - <span
                                                        id="lblTrade">{{ $trade }}</span>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; (Total Correct Answer : <span
                                                        id="lblTotalAns"
                                                        style="color:Green;font-weight:bold;">{{ isset(getAssessmentDetail($user->id)['total_mark']) ? getAssessmentDetail($user->id)['total_mark'] : '' }}
                                                    </span>)
                                                    <span
                                                        class=" text-capitalize">{{ isset(getAssessmentDetail($user->id)['result']) ? getAssessmentDetail($user->id)['result'] : '' }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="detailcolone" colspan="3"><b>Technical - Total Marks
                                                    Obtained</b> :</td>
                                            <td class="detailcolthree"> <span
                                                    id="lblTechnical">{{ isset(getAssessmentDetail($user->id)['technical']) ? getAssessmentDetail($user->id)['technical'] : '' }}</span>
                                                Marks</td>
                                            <td colspan="3" class="detailcolthree">
                                                <span>{{ isset(getAssessmentDetail($user->id)['technical']) && getAssessmentDetail($user->id)['technical_passing_mark'] && getAssessmentDetail($user->id)['technical'] >= getAssessmentDetail($user->id)['technical_passing_mark'] ? 'Pass' : 'Fail' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="detailcolone" colspan="3"><b>Aptitude - Total Marks
                                                    Obtained</b> :</td>
                                            <td class="detailcolthree"> <span
                                                    id="lblAptitude">{{ isset(getAssessmentDetail($user->id)['aptitude']) ? getAssessmentDetail($user->id)['aptitude'] : '' }}
                                                </span> Marks</td>
                                            <td colspan="3" class="detailcolthree">
                                                <span>{{ isset(getAssessmentDetail($user->id)['aptitude']) && getAssessmentDetail($user->id)['aptitude_passing_mark'] && getAssessmentDetail($user->id)['aptitude'] >= getAssessmentDetail($user->id)['aptitude_passing_mark'] ? 'Pass' : 'Fail' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="detailcolone" colspan="3"><b>Behavior - Total Marks
                                                    Obtained</b> :</td>
                                            <td class="detailcolthree"> <span
                                                    id="lblAptitude">{{ isset(getAssessmentDetail($user->id)['behavior']) ? getAssBehaviour(getAssessmentDetail($user->id)['behavior']) : '' }}</span>
                                            </td>
                                            <td colspan="3" class="detailcolthree"> <span>
                                                    {{ isset(getAssessmentDetail($user->id)['behavior']) && getAssessmentDetail($user->id)['behavior_passing_mark'] && getAssessmentDetail($user->id)['behavior'] >= getAssessmentDetail($user->id)['behavior_passing_mark'] ? 'Pass' : 'Fail' }}
                                                </span> </td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        function printpage() {
            var printButton = document.getElementById("printpagebutton");
            printButton.style.visibility = 'hidden';
            window.print()
            printButton.style.visibility = 'visible';
        }
    </script>

</body>

</html>
