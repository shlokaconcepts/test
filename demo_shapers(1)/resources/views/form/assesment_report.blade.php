<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon"href="{{ getImage($setting->site_favicon) }}" type="image/png" />
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/candidate-assesment-form.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet"
        type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Sintony:400,700" rel="stylesheet" type="text/css" />

    <title class=" title no-pri">
        Candidate Application Form - {{ $user->unique_id }} - {{ $user->full_name }}
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
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="col-md-12 text-center mt-3 mb-2">
            <button class=" btn btn-primary  " onclick="printpage();" id="printpagebutton">Print Form</button>
        </div>
        <div class="col-12 mailwrapper_col d-flex justify-content-center">
            <div class="mainwrapper">
                <div class="pagehead">
                    <div class="pageheadcol1" style="border:1px solid #333"> <b>Candidate Assessment report</b>
                        <br /> <span>(<span
                                id="lblRegistrationType">{{ $user->reg_cat_name }}</span>)</span>
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
                                            <td class="empdetails"><span id="lblFullName">{{ $user->full_name }} </span></td>
                                        </tr>
                                        <tr>
                                            <td class="emphead">Birthdate (जन्म तिथि) : </td>
                                            <td class="empdetails"> <span
                                                    id="lblBirthDate">{{ date('d/m/Y', strtotime($user->dob)) }} </span>
                                                <span class="rightpos"> <b>Age (उम्र) (YY/MM)</b> :
                                                    <span id="lblAgeYear">{{ ageCalculatorYear($user->dob) }} </span>
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
                            <td class="tblinnermaincol2"> <img id="ImgCandidate"
                                    src="{{ getImage($user->passport_photo) }}" style="border-width:0px;" /> </td>
                        </tr>
                        <tr class=" Category-wrapper">
                            <td colspan="2" class="tblinnermaincol1" style="border-right:none" valign="top">
                                <div class="tblinnerempdetails">
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="detailcolone"><b>Category (श्रेणी)</b> :</td>
                                            <td class="detailcolthree" colspan="2"> <span
                                                    id="lblCategory">{{ $user->category }}</span></td>
                                            <td class="detailcolfour" colspan="2"><b>Domicile State (मूल निवास
                                                    प्रमाणपत्र)</b> :</td>
                                            <td class="detailcolseven" colspan="2"> <span
                                                    id="lblDomicileState">{{ $user->permanent_state_name}}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="detailcolone"><b>Marital Status (वैवाहिक स्थिति)</b> :</td>
                                            <td class="detailcolthree" colspan="2"> <span
                                                    id="lblMaritalStatus">{{ $user->marital_status }}</span></td>
                                            <td class="detailcolfour" colspan="2"><b>Email ID (ईमेल आईडी)</b> :</td>
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
                                            <td class="detailcolsix"> <b>Blood Group <br />(ब्लड ग्रुप)</b> :</td>
                                            <td class="detailcolseven"> <span
                                                    id="lblBloodGroup">{{ $user->blood_group }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="detailcolone"><b>Aadhaar Number (आधार)</b> : </td>
                                            <td class="detailcolthree" colspan="2"><span
                                                    id="lblAadhaar">{{ $user->aadhar_card }}</span></td>
                                            <td class="detailcolfour"><b>PAN No. (पैन)</b> : </td>
                                            <td class="detailcolseven" colspan="3"><span
                                                    id="lblPANNo">{{ $user->pan_card }}</span></td>
                                        </tr>

                                        <tr>
                                            <td colspan="7">
                                                <div class="headbox" style="border-left:none;border-right:none">
                                                    <!--Assessment Details - <span-->
                                                    <!--    id="lblTrade">{{ $user->trade_name }}</span>-->Total Marks Obtained : <span
                                                        id="lblTotalAns"
                                                        style="color:Green;font-weight:bold;">{{ getAssessmentDetail($user->id)['total_mark'] }}
                                                    </span>
                                                    <span
                                                        class=" text-capitalize">({{ getAssessmentDetail($user->id)['result'] }})</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <!--<tr>-->
                                        <!--    <td class="detailcolone" colspan="3"><b>Technical - Total Marks-->
                                        <!--            Obtained</b> :</td>-->
                                        <!--    <td class="detailcolthree"> <span-->
                                        <!--            id="lblTechnical">{{ getAssessmentDetail($user->id)['technical'] }}</span>-->
                                        <!--        Marks</td>-->
                                        <!--    <td colspan="3" class="detailcolthree">-->
                                        <!--        <span>{{ getAssessmentDetail($user->id)['technical'] >= getAssessmentDetail($user->id)['technical_passing_mark'] ? 'Pass' : 'Fail' }}-->
                                        <!--        </span> </td>-->
                                        <!--</tr>-->
                                        <!--<tr>-->
                                        <!--    <td class="detailcolone" colspan="3"><b>Aptitude - Total Marks-->
                                        <!--            Obtained</b> :</td>-->
                                        <!--    <td class="detailcolthree"> <span-->
                                        <!--            id="lblAptitude">{{ getAssessmentDetail($user->id)['aptitude'] }}-->
                                        <!--        </span> Marks</td>-->
                                        <!--    <td colspan="3" class="detailcolthree">-->
                                        <!--        <span>{{ getAssessmentDetail($user->id)['aptitude'] >= getAssessmentDetail($user->id)['aptitude_passing_mark'] ? 'Pass' : 'Fail' }}-->
                                        <!--        </span> </td>-->
                                        <!--</tr>-->
                                        <!--<tr>-->
                                        <!--    <td class="detailcolone" colspan="3"><b>Behavior - Total Marks-->
                                        <!--            Obtained</b> :</td>-->
                                        <!--    <td class="detailcolthree"> <span-->
                                        <!--            id="lblAptitude">{{ getAssBehaviour(getAssessmentDetail($user->id)['behavior']) }}</span>-->
                                        <!--    </td>-->
                                        <!--    <td colspan="3" class="detailcolthree"> <span>-->
                                        <!--            {{ getAssessmentDetail($user->id)['behavior'] >= getAssessmentDetail($user->id)['behavior_passing_mark'] ? 'Pass' : 'Fail' }}-->
                                        <!--        </span> </td>-->
                                        <!--</tr>-->
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>



</body>

<script>
    function printpage() {
        var printButton = document.getElementById("printpagebutton");
        printButton.style.visibility = 'hidden';
        window.print()
        printButton.style.visibility = 'visible';
    }
</script>

</html>
