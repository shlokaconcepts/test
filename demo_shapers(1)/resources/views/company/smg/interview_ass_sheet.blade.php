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

        .perosnalbx {
            border-top: none !important;
        }

        .cs_table {
            width: 100%;
            font-size: 12px;
            font-weight: 400;
            border: 1px solid #333;
            line-height: 25px;
        }
    </style>
</head>

<body>

    <?php
    $obtain = $other_int->tech_know + $other_int->communication + ($other_int->rule_consciousness + $other_int->openness_to_change) + $other_int->team_player + ($other_int->enthusiasm + $other_int->personality);
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


            <div class="row pagehead" style="min-height: 110px !important;">
                <div class="col-8 d-flex justify-content-end align-items-center">
                    <h5 class=" text-center"><b>Campus Hiring <br>
                            Interview Assessment Form</b>
                    </h5>
                </div>
                <div class="col-4 d-flex justify-content-center align-items-center">
                    <div>
                        <img src="{{ getImage($user->logo) }}" style="height: 100px;" class=" img-thumbnail img-fluid">
                    </div>
                </div>
            </div>

            <div class="perosnalbx">
                <table class="perosnaltable " style="    border-bottom: none;" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="tblinnermaincol1">
                            <div class="tblinnerempdetails">
                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="intercolone">Name</td>
                                        <td class="intercoltwo">
                                            <span id="lblInterviewLocation">{{ $user->full_name }}</span>
                                        </td>
                                        <td class="intercolone" style=" border-left:1px solid #333;">Date of Interview
                                        </td>
                                        <td class="intercoltwo">
                                            <span
                                                id="lblDateofInterview">{{ date('d/m/Y', strtotime($user->interview_date)) }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="intercolone">Father Name</td>
                                        <td class="intercoltwo">
                                            <span id="lblInterviewLocation">{{ $user->father_name }}</span>
                                        </td>

                                        <td class="intercolone" style=" border-left:1px solid #333;">SMG Sr. No.</td>
                                        <td class="intercoltwo">
                                            <span
                                                id="lblDateofInterview">{{ date('d/m/Y', strtotime($user->unique_id)) }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="intercolone">Application for the post</td>
                                        <td class="intercoltwo">
                                            <span id="lblInterviewLocation">{{ $user->cat_name }}</span>
                                        </td>

                                        <td class="intercolone" style=" border-left:1px solid #333;">Trade</td>
                                        <td class="intercoltwo">
                                            <span id="lblDateofInterview">{{ $user->trade_name }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>


            {{-- <div class="col-md-8 mt-1">
                <div class="perosnalbx">
                    <table class="perosnaltable" style="border-bottom: none;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="tblinnermaincol1">
                                <div class="tblinnerempdetails">
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="intercoltwo" style=" border-right:1px solid #333;">A = 8 - 10
                                            </td>
                                            <td class="intercoltwo" style=" border-right:1px solid #333;">B = 5 - 7</td>
                                            <td class="intercoltwo">C = 1 - 4</td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div> --}}

            <table class="perosnaltable mt-1" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr style="background-color:#F5F5F5">
                        <td class="educolone" style="    width: 100px;"><b>Sr No.</b> :</td>
                        <td class="educoltwo"><b>Area of assessment</b> :</td>
                        <td class="educolthree"><b>Max Marks</b> :</td>
                        <td class="educolfour"><b>Min. Marks to Qualify </b> :</td>
                        <td class="educolfive"><b>Marks Obtained</b> :</td>
                    </tr>
                    <tr>
                        <td class="educolfour"><span>1</span></td>
                        <td class="educolone"> Written Test</td>
                        <td class="educoltwo"><span>50</span></td>
                        <td class="educolthree"><span>18</span></td>
                        <td class="educolfour"><span>{{ getAssessmentDetail($user->user_id)['total_mark'] }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="educolfour"><span>2</span></td>
                        <td class="educolone">Psychometric Test</td>
                        <td class="educoltwo"><span>50</span></td>
                        <td class="educolthree"><span>18</span></td>
                        <td class="educolfour"><span>{{ $other_int->psychometric_test }}</span></td>
                    </tr>

                    <tr>
                        <td class="educolfour"><span>3</span></td>
                        <td class="educolone">Family Details </td>
                        <td class="educoltwo"><span>10</span></td>
                        <td class="educolthree"><span>4</span></td>
                        <td class="educolfour"><span>{{ $other_int->family_details }}</span></td>
                    </tr>

                    <tr>
                        <td class="educolfour"><span>4</span></td>
                        <td class="educolone">General view about Institute </td>
                        <td class="educoltwo"><span>10</span></td>
                        <td class="educolthree"><span>4</span></td>
                        <td class="educolfour"><span>{{ $other_int->general_view }}</span></td>
                    </tr>


                    <tr>
                        <td class="educolfour"><span>5</span></td>
                        <td class="educolone">Social Media Savvy </td>
                        <td class="educoltwo"><span>10</span></td>
                        <td class="educolthree"><span>4</span></td>
                        <td class="educolfour"><span>{{ $other_int->social_media }}</span></td>
                    </tr>

                    <tr>
                        <td class="educolfour"><span>6</span></td>
                        <td class="educolone">Personal Interview</td>
                        <td class="educoltwo"><span>70</span></td>
                        <td class="educolthree"><span>35</span></td>
                        <td class="educolfour">
                            <span>
                                {{ $obtain }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="educolfour" colspan="2" style="    text-align: center;"><b>Total</b></td>
                        <td class="educolone"> <b>200</b> </td>
                        <td class="educolthree"> <b>83</b> </td>
                        <td class="educolfour"> <b>
                                {{ getAssessmentDetail($user->user_id)['total_mark'] +
                                    $other_int->psychometric_test +
                                    ($other_int->family_details + $other_int->general_view) +
                                    ($other_int->social_media + $obtain) }}</b>
                        </td>
                    </tr>

                </tbody>
            </table>



            <table class="cs_table mt-1" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td style="width: 510px;"> <b style="margin-left: 10px;">Unsatisfactory</b>- <span>Does not
                                match the Desired
                                Expectation</span> </td>
                        <td> <b style="margin-left: 10px;">Good</b>- <span>Surpasses the Expectation</span> </td>
                    </tr>

                    <tr>
                        <td> <b style="margin-left: 10px;">Satisfactory</b>- <span>Matching with Desired
                                Expectation</span> </td>
                        <td> <b style="margin-left: 10px;">Exceptional</b>- <span>Highly Exceeds Expectation</span>
                        </td>
                    </tr>
                </tbody>
            </table>


            <div class="intermainbody">
                <div class="interinner">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td class="interquescolone" style="padding-left:0px; border-right:none">
                                    <div class="headbox" style="border-bottom:1px solid #333"> Competencies
                                    </div>
                                </td>
                                <td class="interquescoltwo" style="padding-left:0px">
                                    <div class="headbox" style="border-bottom:1px solid #333"> Ratings </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="interquescolone">
                                    <b>Technical knowledge :</b> Candidate demonstrates his
                                    Technical & Subject knowledge.
                                </td>

                                <td class="interquescoltwo"><span
                                        id="lblAPhysicalAppearanc">{{ $other_int->tech_know }}</span></td>
                            </tr>

                            <tr>
                                <td class="interquescolone">
                                    <b>Communication :</b> Candidate expresses thoughts clearly ;
                                    projects positive manner in all forms of communication;
                                    responds diplomatically
                                </td>

                                <td class="interquescoltwo"><span
                                        id="lblAPhysicalAppearanc">{{ $other_int->communication }}</span></td>
                            </tr>

                            <tr>
                                <td class="interquescolone">
                                    <b>Rule Consciousness :</b> Candidate conveys positive
                                    attitudes towards authority and likelihood of obedience.
                                    exhibit a tendency to show self-discipline

                                </td>

                                <td class="interquescoltwo"><span
                                        id="lblAPhysicalAppearanc">{{ $other_int->rule_consciousness }}</span></td>
                            </tr>

                            <tr>
                                <td class="interquescolone">
                                    <b>Openness to Change :</b> Readily accepts New Things, new
                                    experiences or acceptance of non-conventional ideas and
                                    continue to work with high level of performance.

                                </td>

                                <td class="interquescoltwo"><span
                                        id="lblAPhysicalAppearanc">{{ $other_int->openness_to_change }}</span></td>
                            </tr>

                            <tr>
                                <td class="interquescolone">
                                    <b>Team Player :</b> Candidate demonstrate ability to work as a
                                    part of team, seeks the perspective, looks for opportunities to
                                    support others on team
                                </td>

                                <td class="interquescoltwo"><span
                                        id="lblAPhysicalAppearanc">{{ $other_int->team_player }}</span></td>
                            </tr>

                            <tr>
                                <td class="interquescolone">
                                    <b>Enthusiasm :</b> (Go-getter , Energy level, Self-initiatives,
                                    Work commitments)
                                </td>

                                <td class="interquescoltwo"><span
                                        id="lblAPhysicalAppearanc">{{ $other_int->enthusiasm }}</span></td>
                            </tr>

                            <tr>
                                <td class="interquescolone">
                                    <b>Personality :</b> Grooming, Good manner & Etiquettes, Body
                                    language
                                </td>
                                <td class="interquescoltwo"><span
                                        id="lblAPhysicalAppearanc">{{ $other_int->personality }}</span></td>
                            </tr>

                            <tr>
                                <td class="interquescolone" style="    text-align: center;">
                                    <b>Total Score </b>
                                </td>
                                <td class="interquescoltwo"><b>{{ $obtain }}</b></td>
                            </tr>

                            <tr>
                                <td class="interquescolone" style="    text-align: center;">
                                    <b>Overall ratings ( Out of 70)</b>
                                </td>
                                <td class="interquescoltwo"><b>{{ $obtain }}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class=" mt-3">
                <span><b>Details of Interview Panel:</b></span>
            </div>

            <div class="intermainbody">
                <div class="interinner">
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td class="indmaincolone" colspan="2"> <b>Name of Panel Member:</b> <span>{{$admin['hr_name']}}</span></td>
                                <td class="indmaincolone" colspan="2"> <b>Designation:</b> <span>{{$admin['hr_designation']}}</span></td>
                            </tr>

                            <tr>
                                <td class="indmaincolone" colspan="4" style="    text-align: inherit;"> <b>Comments:</b> <span>{{$user->status}}</span></td>
                            </tr>
                           

                            <tr>
                                <td class="indmaincolone" colspan="4" style="    text-align: inherit;"> <b>Signature:</b> <span> <img src="{{getImage($admin['hr_sig'])}}" alt="" style="width: 100%; height: 126px;"> </span></td>
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
                                <td class="indmaincolone" colspan="2"> <b>Name of Panel Member:</b> <span>{{$admin['tech_name']}}</span></td>
                                <td class="indmaincolone" colspan="2"> <b>Designation:</b> <span>{{$admin['tech_designation']}}</span></td>
                            </tr>

                            <tr>
                                <td class="indmaincolone" colspan="4" style="    text-align: inherit;"> <b>Comments:</b> <span>{{$user->status}}</span></td>
                            </tr>
                          

                            <tr>
                                <td class="indmaincolone" colspan="4" style="    text-align: inherit;"> <b>Signature:</b> <span> <img src="{{getImage($admin['tech_sig'])}}" alt="" style="width: 100%; height: 126px;"> </span></td>
                            </tr>
                        </tbody>
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
