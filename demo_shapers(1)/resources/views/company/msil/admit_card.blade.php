<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon"href="{{ getImage($setting->site_favicon) }}" type="image/png" />

    <!--// Favicon //-->

    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/candidate-admit-card.css') }}" rel="stylesheet" type="text/css" />


    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet"
        type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Sintony:400,700" rel="stylesheet" type="text/css" />
    <title class=" title no-pri">
        Candidate Admit Card - {{ $user->unique_id }} - {{ $user->full_name }}
    </title>

    
<body>
    <div class="container">
        <div class="row mt-3 mb-3">
            <div class="col-md-12 text-center">
                <button class=" btn btn-primary  " onclick="printpage();" id="printpagebutton">Print Form</button>
            </div>
        </div>
    </div>

    <form>

        <center class=" mb-4">

            <div>

                <div class="mainbody">

                    <div class="row">
                        <div class="headerdetails col-12 d-flex justify-content-center">
                            <p> {{ $user->cat_name }} Drive
                                {{ date('d M,Y', strtotime($user->exam_date)) }}-Category, e-Admit Card
                            </p>

                        </div>
                    </div>


                    <div class="candidatedetails">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="4">
                                    <div class="header">Personal Details </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="columnone"> Name of the Candidate : </td>
                                <td class="columnTwo"> <span id="lblCandidateName">{{ $user->full_name }}</span></td>
                                <td class="columnone"> Registration ID : </td>
                                <td class="columnTwo" style="border-right:none"> <span
                                        id="lblRegistrationId">{{ $user->unique_id }}</span></td>
                            </tr>

                            <tr>
                                <td class="columnone"> Mobile : </td>
                                <td class="columnTwo"> <span id="lblMobile">{{ $user->phone_number }}</span></td>
                                <td class="columnone"> Email : </td>
                                <td class="columnTwo" style="border-right:none"> <span
                                        id="lblEmail">{{ $user->email }}</span></td>
                            </tr>

                            <tr>
                                <td class="columnone"> DOB : </td>
                                <td class="columnTwo"> <span id="lblDOB">{{ date('d/m/Y', strtotime($user->dob)) }}
                                    </span></td>
                                <td class="columnone"> Aadhaar : </td>
                                <td class="columnTwo" style="border-right:none"> <span
                                        id="lblAadhaar">{{ $user->aadhar_card }}</span></td>
                            </tr>

                            <tr>
                                <td class="columnone"> Father's Name : </td>
                                <td class="columnTwo"> <span id="lblFatherName">{{ $user->father_name }}</span></td>
                                <td class="columnone"> Mother's Name : </td>
                                <td class="columnTwo" style="border-right:none"> <span
                                        id="lblMotherName">{{ $user->mother_name }}</span></td>
                            </tr>

                            <tr>
                                <td class="columnone"> Address : </td>
                                <td class="columnTwo" colspan="2" style="padding:10px 0px 10px 5px">
                                    <b>House / Flat No : </b> <span
                                        id="lblPreAdd_House_FlatNo">{{ $user->present_house_number }}</span>
                                    <br>
                                    <b>Street / Village : </b><span
                                        id="lblPreAdd_Street_Village">{{ $user->present_house_street_village }}</span>
                                    <br />
                                    <b>District : </b> <span
                                        id="lblPreAdd_District">{{ $user->district_name }}</span>
                                    <br />
                                    <b>State : </b> <span
                                        id="lblPreAdd_State">{{ $user->state_name }}</span>
                                    <br />
                                    <b>Pincode : </b> <span id="lblPreAdd_PinCode">{{ $user->present_pincode }}</span>

                                </td>
                                <td class="columnTwo">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <img id="ImgCandidate" class=" img-fluid"
                                                    src="{{ getImage($user->passport_photo) }}"
                                                    style="border-width:0px;" />
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="columnTwo" colspan="6">
                                    <div style="font-size:12px;line-height:23px">
                                        <div class="header" style="margin-left:-5px">Address of Examination Center
                                        </div>
                                        <b><span id="lblExamCenterName">{{ $user->center }}</span> <br />
                                            <span id="lblExamCenterAddress">{!! $user->venue !!}</span><br /><br />
                                        </b>
                                    </div>

                                </td>
                            </tr>

                            <tr style="border-left:none;">
                                <td valign="top" class="columnTwo" colspan="6"
                                    style="border-bottom:none;border-left:none;">
                                    <div style="font-size:12px;line-height:23px">
                                        <div class="header" style="margin-left:-5px">Date & Time Of Examination </div>
                                        <p>Exam Batch : <b>{{ $user->exam_batch}}</b> </p>
                                        <p>
                                            Exam Batch Time :
                                            <b> <span id="lblExamDate">{{date('d/m/Y',strtotime($user->exam_date))}}</span> -
                                                <span id="lblStartTime">{{$user->start_time}}</span>
                                                <span class="text-warning">To </span>
                                                <span id="lblEndTime">{{$user->end_time}}</span>
                                            </b>
                                       </p>
                                    </div>

                                </td>

                            </tr>

                        </table>

                        <div class="header" style="border-left:1px solid #a4a4a4; border-right:1px solid #a4a4a4">
                            Examination Instructions </div>

                        <div class="instructiondetails"
                            style="    border: 1px solid #a4a4a4;
                        padding: 10px;">
                            {!! $user->instruction !!}
                        </div>
                    </div>


                </div>

            </div>
        </center>
    </form>
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
