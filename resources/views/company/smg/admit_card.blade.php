<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon"href="{{ getImage($setting->site_favicon) }}" type="image/png" />

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
    <style>
        .heading {
    background-color: #141C69;
    color: white;
    padding: 3px 0px 3px 6px;
    font-size: 13px !important;
    border-color: #141C69 !important;
}
@page {
            size: auto;
            margin: 0px 10px 0px 10px;
        }
        .bodyss {
    width: 800px;
}
    </style>

<body>

    <div class="container">
        <div class="row mt-3 mb-3">
            <div class="col-md-12 text-center">
                <button class=" btn btn-primary  " onclick="printpage();" id="printpagebutton">Print Admit Card</button>
            </div>
        </div>
    </div>

    <form>

        <center class=" mb-4">

            <div>

                <div class="border p-2 bodyss radius-10">

                    <div class="row">
                        <div class="headerdetails col-12 d-flex justify-content-center">
                            <p> 
                                <b>{{ $user->cat_name }} Drive
                                    {{ date('d M,Y', strtotime($user->exam_date)) }}-Category, e-Admit Card</b>
                            </p>

                        </div>
                    </div>

                    <div class="header heading">Personal Details </div>
                    <div class="candidatedetails">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="columnone"> Name of the Candidate : </td>
                                <td class="columnTwo"> <span id="lblCandidateName">
                                        {{ $user->full_name }}</span></td>
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
                                        id="lblPreAdd_District">{{ $user->district_name}}</span>
                                    <br />
                                    <b>State : </b> <span
                                        id="lblPreAdd_State">{{ $user->state_name}}</span>
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
                        </table>
                    </div>

                    <div class="header heading mt-1">Address of Examination Center</div>
                    <div class="candidatedetails">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="columnTwo" colspan="6">
                                    <div style="font-size:12px;line-height:23px">
                                        <b><span id="lblExamCenterName">{{ $user->center }}</span> <br />
                                            <span id="lblExamCenterAddress">{!! $user->venue !!}</span><br /><br />
                                        </b>
                                    </div>

                                </td>
                            </tr>

                        </table>

                        
                    </div>

                    <div class="header heading mt-1">Date & Time Of Examination</div>
                    <div class="candidatedetails">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="columnTwo" colspan="6">
                                    <div style="font-size:12px;line-height:23px">
                                        <p>Exam Batch : <b>{{ $user->exam_batch }}</b> </p>
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

                        
                    </div>

                    <div class="header heading mt-1">Examination Instructions</div>
                    <div class="candidatedetails">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="columnTwo" colspan="6">
                                    <div class="instructiondetails"
                                    style="    
                                padding: 10px;">
                                    {!! $user->instruction !!}
                                </div>

                                </td>
                            </tr>

                        </table>

                        
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
