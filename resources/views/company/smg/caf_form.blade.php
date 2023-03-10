<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon"href="{{ asset('public/' . $setting->site_favicon) }}" type="image/png" />
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/candidate-print-form.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet"
        type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Sintony:400,700" rel="stylesheet" type="text/css" />
    <title>CAF-Form | {{$user->full_name}}</title>
    <style>
        .heading {
            background-color: #141C69;
            color: white;
            padding: 3px 0px 3px 6px;
            font-size: 13px !important;
        }

        .headbox {
            background-color: #140698 !important;
            color: white !important;
            font-size: 12px !important;
        }

        .mainwrapper {
            border: 0px !important;
        }

        .pagehead {
            display: flex !important;
            justify-content: end !important;
            align-items: center !important;
        }

        p {
            margin-bottom: 4px !important;
        }

        @page {
            size: auto;
            margin: 0px 10px 0px 10px;
        }

        .termstext {
            width: 100% !important;
        }

        .perosnalbx {
            border-top: 0px !important;
        }

        .cs_table {
            width: 100%;
            font-size: 12px;
            font-weight: 400;
            border: 1px solid #333;
            line-height: 25px;
        }

        .br-right {
            border-right: 1px solid #333;
        }

        .br-top {
            border-top: 1px solid #333;
        }

        .br-left {
            border-left: 1px solid #333;
        }

        .cs_table th {
            border-right: 1px solid #333;
            border-bottom: 1px solid #333;
            padding-left: 5px;
            text-align: left;
            font-weight: bold;
            background-color: #F5F5F5;
        }


        .cs_table tbody td {
            border-right: 1px solid #333;
            border-bottom: 1px solid #333;
            padding-left: 5px;
            text-align: left;
        }

        .some_info1 p {
            font-size: 14px;
            margin-bottom: 2px;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="container">
            <div class="col-md-12 text-center">
                <button class=" btn btn-primary  " onclick="printpage();" id="printpagebutton">Print Form</button>
            </div>
        </div>
    </div>
    <div id="PnlPersonalInfoToPersonalID" class="d-flex">
        <section class=" align-content-center text-capitalize">
            <div class="mainwrapper">
                <div class="container-fluid">
                    <div class="row" style="min-height: 110px !important;">
                        <div class="col-8 d-flex justify-content-end align-items-center">
                            <h4><b>PERSONAL DATA FORM</b>
                            </h4>
                        </div>
                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <div>
                                <img src="{{ getImage($user->getCompany->logo) }}" style="height: 100px;"
                                    class=" img-thumbnail img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p> <b>Position Applied for</b>: {{ $user->getFormCategory->name }}</p>
                        </div>
                        <div class="col-6">
                            <p> <b>Name Of ITI</b>: {{ $user->iti_college_name }}</p>
                        </div>
                        <div class="col-6">
                            <p> <b>Trade</b>: {{ $user->trade_name }}</p>
                        </div>
                    </div>
                    <div class="heading">Personal Details (??????????????????????????? ???????????????) </div>
                    <table class="perosnaltable" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="emphead">Full Name (As per Aadhar Card) : </td>
                                        <td class="empdetails br-right"><span>{{ $user->full_name }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="emphead">Father's Name (???????????? ?????? ?????????) : </td>
                                        <td class="empdetails br-right"><span>{{ $user->gender }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="emphead">Gender: </td>
                                        <td class="empdetails br-right"><span>{{ $user->father_name }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="emphead">Birthdate (???????????? ????????????) : </td>
                                        <td class="empdetails br-right">
                                            <span
                                                id="lblBirthDate">{{ $user->dob ? date('d/m/Y', strtotime($user->dob)) : '' }}</span>
                                            <span class="rightpos"><b>Age (????????????)</b>:<span
                                                    id="lblAgeYear">{{ $other->age }}</span>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="emphead">Birth Place: </td>
                                        <td class="empdetails br-right"><span>{{ $other->birth_place }}</span></td>
                                    </tr>

                                    <tr>
                                        <td class="emphead">Religion: </td>
                                        <td class="empdetails br-right"><span>{{ $other->religion }}</span></td>
                                    </tr>

                                    <tr>
                                        <td class="emphead">Category: </td>
                                        <td class="empdetails br-right"><span>{{ $user->category }}</span></td>
                                    </tr>

                                    <tr>
                                        <td class="emphead">Mother Tongue: </td>
                                        <td class="empdetails br-right"><span>{{ $other->mother_tongue }}</span></td>
                                    </tr>

                                    <tr>
                                        <td class="emphead">Domicile: </td>
                                        <td class="empdetails br-right"><span>{{ $other->domicile }}</span></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 5px; min-width: 200px">
                                <img src="{{ getImage($user->passport_photo) }}" class=" img-thumbnail"
                                    style="width: 200px; height: 194px;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table cellpadding="0" cellspacing="0" style="    width: 100%;">
                                    <tr>
                                        <td class="detailcolone"><b>Blood Group (???????????? ???????????????)</b> :
                                        <td class="detailcolthree " colspan="2">
                                            <span>{{ $user->blood_group }}</span>
                                        </td>

                                        <td class="detailcolone" style="border-right: none;"><b>Height (???????????????)</b> :
                                        </td>
                                        <td class="detailcolthree br-top br-left" colspan="3"
                                            style="border-right: none;">
                                            <span>{{ $other->height }} CM</span>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td class="detailcolfour br-top"><b>Weight (?????????)</b> :</td>
                                        <td class="detailcolseven br-top" colspan="2"> <span>{{ $other->weight }}
                                                KG</span></td>
                                        <td class="detailcolfour br-left"><b>Marital Status (????????????????????? ??????????????????) </b> :</td>
                                        <td class="detailcolseven" colspan="3">
                                            <span>{{ $user->marital_status }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="detailcolfour br-top"><b>Marriage Date (???????????? ?????? ???????????????)</b> :</td>
                                        <td class="detailcolseven br-top" colspan="2">
                                            <span>{{ $other->marriage_date }}</span>
                                        </td>
                                        <td class="detailcolfour br-left"><b>Aadhar Number (???????????? ??????????????????)</b> :</td>
                                        <td class="detailcolseven" colspan="3">
                                            <span>{{ $user->aadhar_card }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="detailcolone"><b>PAN No (????????? ????????????)</b> :</td>
                                        <td class="detailcolthree" colspan="5" style="border-right: none;"> <span
                                                id="lblCategory">{{ $user->pan_card }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>


                    <div class="heading">
                        <p>Address Details (????????? ?????? ???????????????)
                        </p>
                    </div>
                    <table class="cs_table" cellpadding="0" cellspacing="0">
                        <thead>
                            <th>Details</th>
                            <th>Permanent Address (??????????????? ?????????) </th>
                            <th>Present Address (????????????????????? ?????????) </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    House No / Street
                                </td>
                                <td>{{ $user->permanent_house_number }}</td>
                                <td>{{ $user->present_house_number }}</td>
                            </tr>
                            <tr>
                                <td>
                                    Village / Mohalla
                                </td>
                                <td>{{ $user->permanent_house_street_village }}</td>
                                <td>{{ $user->present_house_street_village }}</td>
                            </tr>
                            <tr>
                                <td>
                                    Post Office / Tehsil
                                </td>
                                <td>{{ $other->permanent_post_office_tehsil }}</td>
                                <td>{{ $other->present_post_office_tehsil }}</td>
                            </tr>
                            <tr>
                                <td>District. & State</td>
                                <td>{{ $user->permanent_district_name }} & {{ $user->permanent_state_name }}</td>
                                <td>{{ $user->present_district_name }} & {{ $user->present_state_name }}</td>
                            </tr>
                            <tr>
                                <td>Pin No</td>
                                <td>{{ $user->permanent_pincode }}</td>
                                <td>{{ $user->present_pincode }}</td>
                            </tr>
                            <tr>
                                <td>Contact Number </td>
                                <td>Landline/Mobile {{ $other->permanent_landline_mobile }}</td>
                                <td>Landline/Mobile {{ $other->present_landline_mobile }}</td>
                            </tr>
                            <tr>
                                <td>Period of Stay</td>
                                <td>Form: {{ $other->permanent_stay_from }} & To: {{ $other->permanent_stay_to }}</td>
                                <td>Form: {{ $other->present_stay_from }} & To: {{ $other->present_stay_to }}</td>
                            </tr>
                            <tr>
                                <td>Email ID:</td>
                                <td colspan="5">{{ $user->email }}</td>
                            </tr>


                            <tr>
                                <td>Years spent with family:</td>
                                <td colspan="5">{{ $other->year_spent_family }}</td>

                            </tr>
                            <tr>
                                <td>Years spent in hostel/relatives:</td>
                                <td colspan="5">{{ $other->year_spent_relative }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="heading">
                        <p>Family Details (??????????????????????????? ???????????????)
                        </p>
                    </div>
                    <table class="cs_table" cellpadding="0" cellspacing="0">
                        <thead>
                            <th>Sl.No</th>
                            <th>Relation <br>
                                With <br>
                                Candidate <br>
                                (?????????????????????)</th>
                            <th>Name <br>
                                ?????????</th>
                            <th>Study <br>
                                ????????????</th>
                            <th>
                                Age <br>??????
                            </th>
                            <th>
                                Profession <br>
                                ????????????
                            </th>
                            <th>
                                Monthly <br>
                                income <br>
                                ??????????????? ??????
                            </th>
                            <th>
                                Owned
                                Land / <br>
                                Property / <br>
                                House <br>
                                ???????????? / ?????????????????????
                            </th>
                            <th>Income from <br>
                                Other <br>
                                Sources (ANY) <br>
                                ???????????? ???????????????</th>
                            <th>
                                Contact no <br>
                                ?????????????????? ???????????????
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Grandpa / ????????????</td>
                                <td>{{ $other->grandpa_name }}
                                </td>
                                <td>{{ $other->grandpa_education }}
                                </td>
                                <td>{{ $other->grandpa_age }}
                                </td>
                                <td>{{ $other->grandpa_profession }}
                                </td>
                                <td>{{ $other->grandpa_income }}
                                </td>
                                <td>{{ $other->grandpa_property }}
                                </td>
                                <td>{{ $other->grandpa_other_income }}
                                </td>
                                <td>{{ $other->grandpa_contact_no }}
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Grandmother / ???????????? ?????????</td>
                                <td>{{ $other->grandmother_name }}
                                </td>
                                <td>{{ $other->grandmother_education }}
                                </td>
                                <td>{{ $other->grandmother_age }}
                                </td>
                                <td>{{ $other->grandmother_profession }}
                                </td>
                                <td>{{ $other->grandmother_income }}
                                </td>
                                <td>{{ $other->grandmother_property }}
                                </td>
                                <td>{{ $other->grandmother_other_income }}
                                </td>
                                <td>{{ $other->grandmother_contact_no }}
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Father / ????????????</td>
                                <td>{{ $user->father_name }}</td>
                                <td>
                                    {{ $other->father_education }}
                                </td>
                                <td>
                                    {{ $user->father_age }}
                                </td>
                                <td>
                                    {{ $user->father_occupation }}
                                </td>
                                <td>
                                    {{ $user->father_annual_income }}
                                </td>
                                <td>
                                    {{ $other->father_property }}
                                </td>
                                <td>
                                    {{ $other->father_other_income }}
                                </td>
                                <td>
                                    {{ $other->father_contact_no }}
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Mother / ?????????</td>
                                <td>{{ $user->mother_name }}
                                </td>
                                <td>{{ $other->mother_education }}
                                </td>
                                <td>{{ $user->mother_age }}
                                </td>
                                <td>{{ $user->mother_occupation }}
                                </td>
                                <td>{{ $user->mother_annual_income }}
                                </td>
                                <td>{{ $other->mother_property }}
                                </td>
                                <td>{{ $other->mother_other_income }}
                                </td>
                                <td>{{ $other->mother_contact_no }}
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Guardian / ?????????????????????</td>
                                <td>{{ $other->guardian_name }}
                                </td>
                                <td>{{ $other->guardian_education }}
                                </td>
                                <td>{{ $other->guardian_age }}
                                </td>
                                <td>{{ $other->guardian_profession }}
                                </td>
                                <td>{{ $other->guardian_income }}
                                </td>
                                <td>{{ $other->guardian_property }}
                                </td>
                                <td>{{ $other->guardian_other_income }}
                                </td>
                                <td>{{ $other->guardian_contact_no }}
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Uncle / ???????????? / ????????? 1</td>
                                <td>{{ $other->uncle1_name }}
                                </td>
                                <td>{{ $other->uncle1_education }}
                                </td>
                                <td>{{ $other->uncle1_age }}
                                </td>
                                <td>{{ $other->uncle1_profession }}
                                </td>
                                <td>{{ $other->uncle1_income }}
                                </td>
                                <td>{{ $other->uncle1_property }}
                                </td>
                                <td>{{ $other->uncle1_other_income }}
                                </td>
                                <td>{{ $other->uncle1_contact_no }}
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Uncle / ???????????? / ????????? 2</td>
                                <td>{{ $other->uncle2_name }}
                                </td>
                                <td>{{ $other->uncle2_education }}
                                </td>
                                <td>{{ $other->uncle2_age }}
                                </td>
                                <td>{{ $other->uncle2_profession }}
                                </td>
                                <td>{{ $other->uncle2_income }}
                                </td>
                                <td>{{ $other->uncle2_property }}
                                </td>
                                <td>{{ $other->uncle2_other_income }}
                                </td>
                                <td>{{ $other->uncle2_contact_no }}
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Husband or wife <br> / ????????? ?????? ???????????????</td>
                                <td>{{ $user->wife_name }}
                                </td>
                                <td>{{ $other->wife_education }}
                                </td>
                                <td>{{ $user->wife_age }}
                                </td>
                                <td>{{ $user->wife_occupation }}
                                </td>
                                <td>{{ $user->wife_annual_income }}
                                </td>
                                <td>{{ $other->wife_property }}
                                </td>
                                <td>{{ $other->wife_other_income }}
                                </td>
                                <td>{{ $other->wife_contact_no }}
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Children / ??????????????? 1</td>
                                <td>{{ $user->child1name }}
                                </td>
                                <td>{{ $other->child1_education }}
                                </td>
                                <td>{{ $user->child1sage }}
                                </td>
                                <td>{{ $other->child1_profession }}
                                </td>
                                <td>{{ $other->child1_income }}
                                </td>
                                <td>{{ $other->child1_property }}
                                </td>
                                <td>{{ $other->child1_other_income }}
                                </td>
                                <td>{{ $other->child1_contact_no }}
                                </td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Children / ??????????????? 2</td>
                                <td>{{ $user->child2name }}
                                </td>
                                <td>{{ $other->child2_education }}
                                </td>
                                <td>{{ $user->child2sage }}
                                </td>
                                <td>{{ $other->child2_profession }}
                                </td>
                                <td>{{ $other->child2_income }}
                                </td>
                                <td>{{ $other->child2_property }}
                                </td>
                                <td>{{ $other->child2_other_income }}
                                </td>
                                <td>{{ $other->child2_contact_no }}
                                </td>
                            </tr>

                            <tr>
                                <td>11</td>
                                <td>Brother / Sister <br> ????????? ????????? 1</td>
                                <td>{{ $user->s1name }}
                                </td>
                                <td>{{ $other->s1_education }}
                                </td>
                                <td>{{ $user->s1sage }}
                                </td>
                                <td>{{ $user->s1soccupation }}
                                </td>
                                <td>{{ $user->s1sannualincome }}
                                </td>
                                <td>{{ $other->s1_property }}
                                </td>
                                <td>{{ $other->s1_other_income }}
                                </td>
                                <td>{{ $other->s1_contact_no }}
                                </td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>Brother / Sister <br> ????????? ????????? 2</td>
                                <td>{{ $user->s2name }}
                                </td>
                                <td>{{ $other->s2_education }}
                                </td>
                                <td>{{ $user->s2sage }}
                                </td>
                                <td>{{ $user->s2soccupation }}
                                </td>
                                <td>{{ $user->s2sannualincome }}
                                </td>
                                <td>{{ $other->s2_property }}
                                </td>
                                <td>{{ $other->s2_other_income }}
                                </td>
                                <td>{{ $other->s2_contact_no }}
                                </td>
                            </tr>
                            <tr class=" ">
                                <td>13</td>
                                <td>Mother-in-law / ?????????</td>
                                <td>{{ $other->mother_in_law_name }}
                                </td>
                                <td>{{ $other->mother_in_law_education }}
                                </td>
                                <td>{{ $other->mother_in_law_age }}
                                </td>
                                <td>{{ $other->mother_in_law_profession }}
                                </td>
                                <td>{{ $other->mother_in_law_income }}
                                </td>
                                <td>{{ $other->mother_in_law_property }}
                                </td>
                                <td>{{ $other->mother_in_law_other_income }}
                                </td>
                                <td>{{ $other->mother_in_law_contact_no }}
                                </td>
                            </tr>
                            <tr class="">
                                <td>14</td>
                                <td>Father-in-law / ????????????</td>
                                <td>{{ $other->father_in_law_name }}
                                </td>
                                <td>{{ $other->father_in_law_education }}
                                </td>
                                <td>{{ $other->father_in_law_age }}
                                </td>
                                <td>{{ $other->father_in_law_profession }}
                                </td>
                                <td>{{ $other->father_in_law_income }}
                                </td>
                                <td>{{ $other->father_in_law_property }}
                                </td>
                                <td>{{ $other->father_in_law_other_income }}
                                </td>
                                <td>{{ $other->father_in_law_contact_no }}
                                </td>
                            </tr>
                            <tr class="">
                                <td>15</td>
                                <td>Brother-in-law / ????????????</td>
                                <td>{{ $other->brother_in_law_name }}
                                </td>
                                <td>{{ $other->brother_in_law_education }}
                                </td>
                                <td>{{ $other->brother_in_law_age }}
                                </td>
                                <td>{{ $other->brother_in_law_profession }}
                                </td>
                                <td>{{ $other->brother_in_law_income }}
                                </td>
                                <td>{{ $other->brother_in_law_property }}
                                </td>
                                <td>{{ $other->brother_in_law_other_income }}
                                </td>
                                <td>{{ $other->brother_in_law_contact_no }}
                                </td>
                            </tr>
                            <tr>
                                <td>16</td>
                                <td>Sister-in-law / ????????????</td>
                                <td>{{ $other->sister_in_law_name }}
                                </td>
                                <td>{{ $other->sister_in_law_education }}
                                </td>
                                <td>{{ $other->sister_in_law_age }}
                                </td>
                                <td>{{ $other->sister_in_law_profession }}
                                </td>
                                <td>{{ $other->sister_in_law_income }}
                                </td>
                                <td>{{ $other->sister_in_law_property }}
                                </td>
                                <td>{{ $other->sister_in_law_other_income }}
                                </td>
                                <td>{{ $other->sister_in_law_contact_no }}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <table class="cs_table" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="background-color:#F5F5F5">Any Loan liability on Family/ Self  (??????????????????/???????????????
                                ?????? ????????? ?????? ???????????????):</td>
                            <td>{{ $other->fam_any_loan_lability }}</td>
                        </tr>
                    </table>

                    <div class="some_info1 mt-2">
                        <p>Is any of your relative government employed? ???????????? ???????????? ????????? ???????????????????????????
                            ??????????????????/???????????????????????????
                            ???????????? ????????? ????????????????????? ??????: {{ $other->relative_government_employed }}</p>
                        <p>If yes, then enter his/her name, relation, ????????? ?????????, ?????? ???????????? ?????????, ??????????????? ????????????
                            ????????????</p>

                        <table class="cs_table" cellpadding="0" cellspacing="0">
                            <thead>
                                <th>Name (?????????)</th>
                                <th>Relation (?????????????????????)</th>
                                <th>Business (?????????????????????)</th>
                            </thead>
                            <tr>
                                <td>{{ $other->rel_name_gov_emp }}</td>
                                <td>{{ $other->rel_relation_gov_emp }}</td>
                                <td>{{ $other->rel_buss_gov_emp }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="heading mt-1">
                        <p>Educational Qualifications
                            (????????????????????????
                            ???????????????????????????) </p>
                    </div>

                    <table class="perosnaltable" cellpadding="0" cellspacing="0">
                        <tr style="background-color:#F5F5F5">
                            <td class="educolone"><b>Examination Passed <br />(???????????????????????? ????????????????????? ?????? ?????????)</b> :</td>
                            <td class="educoltwo"><b>Name of School / College<br /> (???????????????/??????????????????????????????????????? ??????
                                    ?????????)</b> :
                            </td>
                            <td class="educolthree"><b>Examining
                                    Board /
                                    University</b> :</td>
                            <td class="educolfour"><b>Month & Year
                                    of Passing</b> :</td>
                            <td class="educolfive"><b>Obtained
                                    Marks</b> :</td>
                            <td class="educolfour"><b>Max
                                    Marks </b> :</td>
                            <td class="educolfour"><b>%</b> :</td>
                            <td class="educolfour"><b>Regular
                                    /Private/
                                    Open </b> :</td>
                        </tr>
                        <tr>
                            <td class="educolone">10th (??????????????? ???????????????) : </td>
                            <td class="educoltwo"><span>{{ $user->tenth_college_name }}</span></td>
                            <td class="educolthree"><span>{{ $user->tenth_board }}</span></td>
                            <td class="educolfour"><span>{{ $user->tenth_passing_year }}</span></td>
                            <td class="educolfour"><span>{{ $other->tenth_obtain_mark }}</span></td>
                            <td class="educolfour"><span>{{ $other->tenth_max_mark }}</span></td>
                            <td class="educolfour"><span>{{ $user->tenth_score }}</span></td>
                            <td class="educolfour"><span>{{ $user->tenth_education_type }}</span>
                        </tr>
                        <tr>
                            <td class="educolone">12th (????????????????????? ???????????????) : </td>
                            <td class="educoltwo"><span>{{ $user->twelve_college_name }}</span></td>
                            <td class="educolthree"><span>{{ $user->twelve_board }}</span></td>
                            <td class="educolfour"><span>{{ $user->twelve_passing_year }}</span></td>
                            <td class="educolfour"><span>{{ $other->twelve_obtain_mark }}</span></td>
                            <td class="educolfour"><span>{{ $other->twelve_max_mark }}</span></td>
                            <td class="educolfour"><span>{{ $user->twelve_score }}</span></td>
                            <td class="educolfour"><span>{{ $user->twelve_education_type }}</span>
                        </tr>
                        <tr>
                            <td class="educolone">BA/B Com/BSc/Others: </td>
                            <td class="educoltwo"><span>{{ $user->other_college_name }}</span></td>
                            <td class="educolthree"><span>{{ $other->other_board }}</span></td>
                            <td class="educolfour"><span>{{ $user->other_passing_year }}</span></td>
                            <td class="educolfour"><span>{{ $other->other_obtain_mark }}</span></td>
                            <td class="educolfour"><span>{{ $other->other_max_mark }}</span></td>
                            <td class="educolfour"><span>{{ $user->other_score }}</span></td>
                            <td class="educolfour"><span>{{ $user->other_education_type }}</span>
                        </tr>
                    </table>

                    <div class="heading mt-1">
                        <p> Technical Qualification (?????????????????? ?????????????????????) </p>
                    </div>


                    <table class="perosnaltable" cellpadding="0" cellspacing="0">
                        <tr style="background-color:#F5F5F5">
                            <td class="educolone"><b>Exam Passed </b> :</td>
                            <td class="educoltwo"><b>Name of Institute</b> :</td>
                            <td class="educolthree"><b>From</b> :</td>
                            <td class="educolfour"><b>To</b> :</td>
                            <td class="educolfive"><b>Trade/Branch </b> :</td>
                            <td class="educolfour"><b>Marks Obtained</b> :</td>
                            <td class="educolfour"><b>Any Gap/ Back Papers</b> :</td>
                        </tr>
                        <tr>
                            <td class="educolone">ITI-(NCVT/SCVT):</td>
                            <td class="educoltwo"><span>{{ $user->iti_college_name }}</span></td>
                            <td class="educolthree"><span>{{ $other->iti_start_from }}</span></td>
                            <td class="educolfour"><span>{{ $other->iti_start_to }}</span></td>
                            <td class="educolfour"><span>{{ $user->trade_name }}</span></td>
                            <td class="educolfour"><span>{{ $other->iti_obtain_mark }}</span></td>
                            <td class="educolfour"><span>{{ $other->iti_gap_paper }}</span></td>
                        </tr>

                        <tr>
                            <td class="educolone">Apprenticeship:</td>
                            <td class="educoltwo"><span>{{ $user->apprentice_company_name }}</span></td>
                            <td class="educolthree"><span>{{ $user->apprentice_start_date }}</span></td>
                            <td class="educolfour"><span>{{ $user->apprentice_end_date }}</span></td>
                            <td class="educolfour"><span>{{ $user->apprentice_division }}</span></td>
                            <td class="educolfour"><span></span></td>
                            <td class="educolfour"><span></span></td>
                        </tr>
                        <tr>
                            <td class="educolone">Diploma:</td>
                            <td class="educoltwo"><span>{{ $other->diploma_college_name }}</span></td>
                            <td class="educolthree"><span>{{ $other->diploma_start_from }}</span></td>
                            <td class="educolfour"><span>{{ $other->diploma_start_to }}</span></td>
                            <td class="educolfour"><span>{{ $other->diploma_trade_branch }}</span></td>
                            <td class="educolfour"><span>{{ $other->diploma_obtain_mark }}</span></td>
                            <td class="educolfour"><span>{{ $other->diploma_gap_paper }}</span></td>
                        </tr>
                    </table>

                    <table class="cs_table" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="background-color:#F5F5F5;">Total Attendance in ITI </td>
                            <td colspan="2">{{ $other->iti_attendance }}</td>
                            <td style="background-color:#F5F5F5;">Reason for Below 90 %</td>
                            <td colspan="2">{{ $other->iti_attendance_reason }}</td>
                        </tr>

                        <tr>
                            <td style="background-color:#F5F5F5;width: 290px;">Reason for any gap in Education, if
                                applicable </td>
                            <td colspan="2">{{ $other->reas_gap_any_edu }}</td>
                            <td style="background-color:#F5F5F5;    width: 282px; ">Extra-curricular activities in
                                school/college?</td>
                            <td colspan="2">{{ $other->ext_act_college }}</td>
                        </tr>
                        <tr>
                            <td style="background-color:#F5F5F5;">Computer Knowledge</td>
                            <td colspan="2">{{ $other->comp_know }}</td>
                        </tr>
                    </table>



                    <div class="heading mt-1">
                        <p>Languages known ( ??????????????? ??????????????????)</p>
                    </div>
                    <table class="perosnaltable" cellpadding="0" cellspacing="0">
                        <tr style="background-color:#F5F5F5">
                            <td class="educolone"><b>Languages </b> :</td>
                            <td class="educoltwo"><b>Read</b> :</td>
                            <td class="educolthree"><b>Write</b> :</td>
                            <td class="educolfour"><b>Speak</b> :</td>
                        </tr>
                        <tr>
                            <td class="educolone">English:</td>
                            <td class="educolthree"><span>{{ $other->eng_read }}</span></td>
                            <td class="educolfour"><span>{{ $other->eng_Write }}</span></td>
                            <td class="educolfour"><span>{{ $other->eng_speak }}</span></td>
                        </tr>
                        <tr>
                            <td class="educolone">Hindi:</td>
                            <td class="educolthree"><span>{{ $other->hin_read }}</span></td>
                            <td class="educolfour"><span>{{ $other->hin_Write }}</span></td>
                            <td class="educolfour"><span>{{ $other->hin_speak }}</span></td>
                        </tr>
                        <tr>
                            <td class="educolone">Gujarati:</td>
                            <td class="educolthree"><span>{{ $other->guj_read }}</span></td>
                            <td class="educolfour"><span>{{ $other->guj_Write }}</span></td>
                            <td class="educolfour"><span>{{ $other->guj_speak }}</span></td>
                        </tr>

                        <tr>
                            <td class="educolone">Other: <b>{{ $other->other_lang }}</b> </td>
                            <td class="educolthree"><span>{{ $other->other_read }}</span></td>
                            <td class="educolfour"><span>{{ $other->other_Write }}</span></td>
                            <td class="educolfour"><span>{{ $other->other_speak }}</span></td>
                        </tr>
                    </table>

                    <div class="heading mt-1 work_wrapper"> Work Experience (??????????????? ???????????????) </div>
                    <table class="perosnaltable" cellpadding="0" cellspacing="0">
                        <tr style="background-color:#F5F5F5">
                            <th class="workcolone">Company Name (?????????????????? ?????? ?????????)</th>
                            <th class="workcolone">Start Date (???????????? ????????????)</th>
                            <th class="workcolone">End Date (?????????????????? ????????????)</th>
                            <th class="workcolone">Salary per month (???????????? ??????????????? ?????????)</th>
                            <th class="workcolone">Designation Post (?????? ?????? ?????????)</th>
                            <th class="workcolone">Reason for Separation (?????????????????? ?????? ????????????)</th>
                            <th class="workcolone">Certificate Yes / No (?????????????????????????????? ????????? / ????????????)</th>
                        </tr>
                        <tr>
                            <td class="workcolone"><span>{{ $user->previous_company_name }}</span></td>
                            <td class="workcoltwo"><span>{{ $user->previous_company_start_date }}</span> </td>
                            <td class="workcolthree"><span>{{ $user->previous_company_end_date }}</span></td>
                            <td class="workcolseven"><span>{{ $user->previous_company_salary }}</span></td>
                            <td class="workcolfour"><span>{{ $user->previous_company_division }}</span></td>
                            <td class="workcolfive"><span>{{ $other->previous_company_res_living }}</span></td>
                            <td class="workcolsix"><span>{{ $other->previous_com_cert }}</span></td>
                        </tr>
                        <tr>
                            <td class="workcolone"><span>{{ $user->previous_company_name_two }}</span></td>
                            <td class="workcoltwo"><span>{{ $user->previous_company_start_date_two }}</span> </td>
                            <td class="workcolthree"><span>{{ $user->previous_company_end_date_two }}</span></td>
                            <td class="workcolseven"><span>{{ $user->previous_company_salary_two }}</span></td>
                            <td class="workcolfour"><span>{{ $user->previous_company_division_two }}</span></td>
                            <td class="workcolfive"><span>{{ $other->previous_company_res_living_two }}</span></td>
                            <td class="workcolsix"><span>{{ $other->previous_com_cert_two }}</span></td>
                        </tr>
                        <tr>
                            <td class="workcolone"><span>{{ $user->previous_company_name_three }}</span></td>
                            <td class="workcoltwo"><span>{{ $user->previous_company_start_date_three }}</span> </td>
                            <td class="workcolthree"><span>{{ $user->previous_company_end_date_three }}</span></td>
                            <td class="workcolseven"><span>{{ $user->previous_company_salary_three }}</span></td>
                            <td class="workcolfour"><span>{{ $user->previous_company_division_three }}</span></td>
                            <td class="workcolfive"><span>{{ $other->previous_company_res_living_three }}</span></td>
                            <td class="workcolsix"><span>{{ $other->previous_com_cert_three }}</span></td>
                        </tr>
                    </table>








                    <div class="heading mt-1"> Other Information (???????????????????????? ???????????????) </div>
                    <table class="cs_table" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td style="width: 584px;"><b>What are your major achievements in your experience? ????????????
                                        ??????????????? ?????????
                                        ????????????
                                        ??????????????????
                                        ?????????????????????????????? ???????????? ??????????</b></td>
                                <td>{{ $other->your_major_achievement }}</td>
                            </tr>
                            <tr>
                                <td style="width: 584px;"><b>What are your hobbies? ???????????? ????????? ???????????? ?????? </b></td>
                                <td>{{ $other->your_hobbies }}</td>
                            </tr>

                            <tr>
                                <td class="othercolone"><b>Does your phone have/don't have internet connection? If yes,
                                        which plan
                                        do you
                                        have (2G, 3G, 4G) <br> ???????????? ???????????? ????????? ????????? ????????????????????? ????????????????????? ??????/???????????? ??????? ?????????
                                        ?????????, ??????
                                        ???????????? ????????? ????????? ?????? ??????????????? ?????? (2??????, 3??????, 4??????)</b></td>
                                <td class="othercoltwo"><span>{{ $other->internet_connection }}</span></td>
                            </tr>

                            <tr>
                                <td class="othercolone"><b>Do you think mobile should be used while
                                        lunch/studying/working?<br> ????????????
                                        ????????????
                                        ???????????? ?????? ?????? ?????????/???????????????/????????? ???????????? ????????? ?????????????????? ?????? ???????????????????????? ???????????? ????????????????</b></td>
                                <td class="othercoltwo"><span>{{ $other->mobile_uses }}</span></td>
                            </tr>

                            <tr>
                                <td class="othercolone"><b>For what do you use the internet on the mobile phone? <br>
                                        ?????? ????????? ??????
                                        ????????????????????? ??????
                                        ???????????????
                                        ?????????
                                        ????????? ???????????? ??????????</b></td>
                                <td class="othercoltwo"><span>{{ $other->what_you_use_net }}</span></td>
                            </tr>

                            <tr>
                                <td class="othercolone"><b>Why do you want to associate with Suzuki Motor Gujarat
                                        Private
                                        Limited<br> ??????
                                        ?????????????????? ???????????? ?????????????????? ???????????????????????? ????????????????????? ?????? ????????? ??????????????? ?????????????????? ??????????????? ??????????</b></td>
                                <td class="othercoltwo"><span>{{ $other->want_to_associate }}</span></td>
                            </tr>

                            <tr>
                                <td class="othercolone"><b>Do you have any relative or friend working in Suzuki Group
                                        of Companies?
                                        If yes,
                                        please share the details<br> ???????????? ???????????? ????????? ??????????????????????????? ?????? ??????????????? ?????????????????? ???????????????
                                        ?????? ??????????????????
                                        ????????? ????????? ???????????? ??????? ????????? ?????????, ?????? ??????????????? ??????????????? ???????????? ???????????? </b></td>
                                <td class="othercoltwo"><span>{{ $other->relative_work_with_company }}</span></td>
                            </tr>

                            <tr>
                                <td class="othercolone"><b>Have you suffered any major accident/ illness/ operation in
                                        the past? If
                                        yes,
                                        please share the details <br> ???????????? ?????? ??????????????? ????????? ???????????? ????????????
                                        ????????????????????????/??????????????????/?????????????????? ??????
                                        ?????????????????? ????????? ?????????? ????????? ?????????, ?????? ??????????????? ??????????????? ???????????? ???????????? </b></td>
                                <td class="othercoltwo"><span>{{ $user->detail_of_past_surgery }}</span></td>
                            </tr>
                            <tr>
                                <td class="othercolone"><b>What do you think, is mobile necessary? if so why ???????????? ????????????
                                        ???????????? ??????, ???????????? ?????????????????? ??????????????? ??????? ????????? ????????? ?????? ?????? ??????????????? </b></td>
                                <td class="othercoltwo"><span>{{ $other->mobile_necessary }}</span></td>
                            </tr>
                            <tr>
                                <td class="othercolthree"><b>How many phones do you have (please specify the
                                        model)<br>???????????? ????????? ???????????????
                                        ???????????? ?????????
                                        (??????????????? ???????????? ??????????????????????????? ????????????): </td>
                                <td class="othercolfour"><span>{{ $other->how_many_mobile }}</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="perosnaltable" cellpadding="0" cellspacing="0">

                        <tr>
                            <td class="othercolone"><b>Do you know four wheeler driving?</b> / <br />???????????? ?????? ?????????
                                ???????????????
                                ???????????? ???????????? ??????????????? ??????????????? ????????? : </td>
                            <td class="othercoltwo"><span>{{ $user->car_driving }}</span></td>
                            <td class="othercolthree"><b>Driving Licence No</b> / <br />????????????????????? ???????????? : </td>
                            <td class="othercolfour"><span>{{ $user->driving_license }}</span></td>
                        </tr>

                        <tr>
                            <td class="othercolone"><b>Are you ready to work in Hansalpur, Gujarat? <br> ???????????? ?????? ??????????????????
                                    ??????
                                    ?????????????????????, ?????????
                                    ????????? ???????????? ?????? ????????? ??????????????? ??????????</b></td>
                            <td class="othercoltwo"><span>{{ $other->are_you_ready_work_in_plc }}</span></td>
                            <td class="othercolthree"><b> Are you ready to relocate anywhere in India or abroad? <br>
                                    ???????????? ?????? ????????????
                                    ?????? ???????????????
                                    ????????? ???????????? ?????? ????????????????????????????????? ???????????? ?????? ????????? ??????????????? ??????????</b> </td>
                            <td class="othercolfour"><span>{{ $other->are_you_ready_rel_anyw }}</span></td>
                        </tr>

                        <tr>
                            <td class="othercolone"><b>Are you physically
                                    handicapped <br> ???????????? ??????
                                    ?????????????????????
                                    ????????? ?????? ????????????????????? ????????????? </b></td>
                            <td class="othercoltwo"><span>{{ $user->physically_handicapped }}</span></td>
                            <td class="othercolthree"><b>If you are handicapped, then give further information <br> ?????????
                                    ?????? ?????????????????????
                                    ????????? ??????
                                    ??????
                                    ????????????????????? ????????? </b> </td>
                            <td class="othercolfour"><span>{{ $user->physically_handicap_information }}</span></td>
                        </tr>

                        <tr>
                            <td class="othercolone"><b>Have you or your family been prosecuted by any court? <br> ????????????
                                    ?????? ??????
                                    ???????????? ??????????????????
                                    ?????? ???????????? ???????????????????????? ?????????????????? ?????????????????? ??????????????? ????????? ???????</b></td>
                            <td class="othercoltwo"><span>{{ $other->gov_action }}</span></td>
                            <td class="othercolthree"><b>If yes,
                                    please share the details <br> ????????? ?????????, ?????? ??????????????? ??????????????? ???????????? ????????????</b> </td>
                            <td class="othercolfour"><span>{{ $other->gov_action_detail }}</span></td>
                        </tr>

                        <tr>
                            <td class="othercolone"><b>Have you appeared in Suzuki Motors or Mr. Suzuki Interview or
                                    Written
                                    Test
                                    before? <br>???????????? ?????? ???????????? Suzuki Motors ?????? Mr. Suzuki ????????????????????????????????? ?????? ???????????????
                                    ?????????????????????
                                    ????????? ????????????????????? ????????? ??????????</b></td>
                            <td class="othercoltwo"><span>{{ $other->have_you_appeared_this_com }}</span></td>
                            <td class="othercolthree"><b>If yes,
                                    please share the details <br> ????????? ?????????, ?????? ??????????????? ??????????????? ???????????? ????????????</b> </td>
                            <td class="othercolfour"><span>{{ $other->have_you_appeared_this_com_detail }}</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="othercolone"><b>Have you worked with this company<br>???????????? ???????????? ?????? ??????????????? ?????? ?????????
                                    ????????? ????????????
                                    ??????</b></td>
                            <td class="othercoltwo"><span>{{ $user->already_worked }}</span></td>
                            <td class="othercolthree"><b>If yes, give details of designation, season and
                                    duration<br>????????? ?????????, ??????
                                    ???????????????,
                                    ????????? ?????? ???????????? ?????? ??????????????? ?????????</b> </td>
                            <td class="othercolfour"><span>{{ $other->already_worked_detail }}</span></td>
                        </tr>
                    </table>

                   
                    <div class="heading mt-1">Provide details of 2 responsible references, other than
                        family
                        members and friends / ?????????????????? ?????? ????????????????????? ?????? ????????????????????? ?????? ??????????????? 2 ??????????????????????????? <br>
                        ???????????????????????? ??????
                        ??????????????? ?????????????????? ????????????</div>
                    <table class="perosnaltable" cellpadding="0" cellspacing="0">
                        <tr style="background-color:#F5F5F5">

                            <th class="workcolone">Sl.No (?????????????????????) </th>
                            <th class="workcolone">Name of Person (????????????????????? ?????? ?????????)</th>
                            <th class="workcolone">Address (?????????)</th>
                            <th class="workcolone">Contact No (?????????????????? ????????????)</th>
                            <th class="workcolone">Since when you know (?????? ?????? ?????? ??????????????? ?????????)</th>
                        </tr>
                        </tr>
                        <tr>
                            <td class="workcolfive"><span>1</span></td>
                            <td class="workcolfive"><span>{{ $other->resp_per_name_one }}</span></td>
                            <td class="workcolsix"><span>{{ $other->resp_per_address_one }}</span></td>
                            <td class="workcolfive"><span>{{ $other->resp_per_cont_one }}</span></td>
                            <td class="workcolsix"><span>{{ $other->resp_per_since_know_one }}</span></td>
                        </tr>
                        <tr>
                            <td class="workcolfive"><span>2</span></td>
                            <td class="workcolfive"><span>{{ $other->resp_per_name_two }}</span></td>
                            <td class="workcolsix"><span>{{ $other->resp_per_address_two }}</span></td>
                            <td class="workcolfive"><span>{{ $other->resp_per_cont_two }}</span></td>
                            <td class="workcolsix"><span>{{ $other->resp_per_since_know_two }}</span></td>
                        </tr>
                    </table>


                    <div class="heading mt-1">Additional Information for Background Verification /
                        ???????????????????????????
                        ????????????????????? ?????? ????????? ???????????????????????? ????????????????????? </div>
                    <table class="perosnaltable" cellpadding="0" cellspacing="0">
                        <tr style="background-color:#F5F5F5">
                            <th class="workcolone">Period of stay From</th>
                            <th class="workcolone">Period of stay To</th>
                            <th class="workcolone">Address </th>
                            <th class="workcolone">State</th>
                            <th class="workcolone">Country</th>
                            <th class="workcolone">Pin Code</th>
                        </tr>
                        </tr>
                        <tr>
                            <td class="workcolfive"><span>{{ $other->addit_info_back_stay_from_one }}</span></td>
                            <td class="workcolfive"><span>{{ $other->addit_info_back_stay_to_one }}</span></td>
                            <td class="workcolfive"><span>{{ $other->addit_info_address_one }}</span></td>
                            <td class="workcolsix"><span>{{ getStateName($other->addit_info_state_one) }}</span></td>
                            <td class="workcolfive"><span>{{ $other->addit_info_country_one }}</span></td>
                            <td class="workcolsix"><span>{{ $other->addit_info_zip_code_one }}</span></td>
                        </tr>
                        <tr>
                            <td class="workcolfive"><span>{{ $other->addit_info_back_stay_from_two }}</span></td>
                            <td class="workcolfive"><span>{{ $other->addit_info_back_stay_to_two }}</span></td>
                            <td class="workcolfive"><span>{{ $other->addit_info_address_two }}</span></td>
                            <td class="workcolsix"><span>{{ getStateName($other->addit_info_state_two) }}</span></td>
                            <td class="workcolfive"><span>{{ $other->addit_info_country_two }}</span></td>
                            <td class="workcolsix"><span>{{ $other->addit_info_zip_code_two }}</span></td>
                        </tr>
                        <tr>
                            <td class="workcolfive"><span>{{ $other->addit_info_back_stay_from_three }}</span></td>
                            <td class="workcolfive"><span>{{ $other->addit_info_back_stay_to_three }}</span></td>
                            <td class="workcolfive"><span>{{ $other->addit_info_address_three }}</span></td>
                            <td class="workcolsix"><span>{{ getStateName($other->addit_info_state_three) }}</span></td>
                            <td class="workcolfive"><span>{{ $other->addit_info_country_three }}</span></td>
                            <td class="workcolsix"><span>{{ $other->addit_info_zip_code_three }}</span></td>
                        </tr>
                        <tr>
                            <td class="workcolfive"><span>{{ $other->addit_info_back_stay_from_four }}</span></td>
                            <td class="workcolfive"><span>{{ $other->addit_info_back_stay_to_four }}</span></td>
                            <td class="workcolfive"><span>{{ $other->addit_info_address_four }}</span></td>
                            <td class="workcolsix"><span>{{ getStateName($other->addit_info_state_four) }}</span></td>
                            <td class="workcolfive"><span>{{ $other->addit_info_country_four }}</span></td>
                            <td class="workcolsix"><span>{{ $other->addit_info_zip_code_four }}</span></td>
                        </tr>
                        <tr>
                            <td class="workcolfive"><span>{{ $other->addit_info_back_stay_from_five }}</span></td>
                            <td class="workcolfive"><span>{{ $other->addit_info_back_stay_to_five }}</span></td>
                            <td class="workcolfive"><span>{{ $other->addit_info_address_five }}</span></td>
                            <td class="workcolsix"><span>{{ getStateName($other->addit_info_state_five) }}</span></td>
                            <td class="workcolfive"><span>{{ $other->addit_info_country_five }}</span></td>
                            <td class="workcolsix"><span>{{ $other->addit_info_zip_code_five }}</span></td>
                        </tr>
                    </table>



                    <div class="heading mt-1">Educational Qualification Verification (Highest Degree)</div>
                    <table class="cs_table" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td class=" text-danger"><b>(Important: Copy of Mark sheet and Degree certificate
                                        MUST be
                                        attached) </b></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="cs_table" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td ><b>Institution Name</b></td>
                                <td>{{ $other->institution_name }}</td>
                                <td ><b>Institution Address</b></td>
                                <td>{{ $other->institution_address }}</td>
                            </tr>
                            <tr>
                                <td ><b>University Name and address</b></td>
                                <td>{{ $other->ot_grad_uni_na_adr }}</td>
                                <td ><b>From</b></td>
                                <td>{{ $other->other_grad_from }}</td>
                            </tr>
                            <tr>
                                <td ><b>To</b></td>
                                <td>{{ $other->other_grad_two }}</td>
                                <td ><b>Institution Address</b></td>
                                <td>{{ $other->institution_address }}</td>
                            </tr>
                            <tr>
                                <td ><b>Passed</b></td>
                                <td>{{ $other->other_grad_passed }}</td>
                                <td ><b>Program</b></td>
                                <td>{{ $other->other_grad_program }}</td>
                            </tr>

                            <tr>
                                <td ><b>Student ID/ Enrolment No</b></td>
                                <td>{{ $other->other_grad_deg_type }}</td>
                                <td ><b>Graduation date</b></td>
                                <td>{{ $other->other_grad_date }}</td>
                            </tr>
                            <tr>
                                <td ><b>Trade/Branch</b></td>
                                <td>{{ $other->other_grad_branch }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="cs_table" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                            <td> <b>Referred By</b>: <span class=" text-success">{{ $user->referred_by }}</span> </td>
                                       
                            </tr>
                        </tbody>
                    </table>






                    <div class="termstext">
                        <input id="ChkTerm" disabled type="checkbox" name="ChkTerm"
                            @if ($user->agreed == 'YES') checked="checked" @endif /> I hereby declare that the
                        particulars
                        given above are true to the best of my
                        knowledge and
                        belief. Nothing has been hidden or falsely stated above. ??If, at any stage of
                        recruitment it is
                        found that I have hidden any facts/ information or if any information provided
                        by me is
                        found misleading / incorrect, then company may cancel my candidature and may
                        take
                        appropriate legal action against me, for which I will be solely responsible. I
                        understand that
                        my appointment in the company services will be subject to my passing the
                        assessment test,
                        personal interview and medical examination. <br>
                        ????????? ?????????????????????????????? ??????????????? ???????????? ????????? ?????? ????????? ????????? ?????? ??????????????? ???????????? ??????????????????????????? ??????????????? ??????
                        ????????????????????? ?????? ?????????????????? ???????????? ???????????? ????????? ??????????????????
                        ?????? ?????? ????????????????????? ????????? ????????? ?????? ?????????????????? ???????????? ????????? ?????? ????????? ?????? ?????? ????????? ????????????????????? ??????????????????/?????????
                        ?????????????????? ?????? ?????? ????????? ??????????????? ??????
                        ???????????? ?????? ????????? ????????? ????????? ?????? ???????????? ???????????? ?????? ?????? ??????????????? ????????? ????????????/????????????????????? ??????????????? ?????? ?????? ????????????
                        ?????????????????? ?????????????????? ?????? ?????? ????????? ??????
                        ????????????????????? ??????????????????/????????? ????????? ???????????? ??????, ?????? ??????????????? ???????????? ?????????????????????????????? ?????? ???????????? ?????? ???????????? ?????? ??????
                        ???????????? ??????????????? ???????????? ??????????????????
                        ???????????????????????? ?????? ???????????? ??????, ??????????????? ????????? ????????? ???????????? ????????? ??????????????????????????? ?????????????????? ????????? ??????????????? ????????? ??????
                        ??????????????? ?????? ?????????????????? ????????? ???????????? ????????????????????????
                        ???????????? ?????????????????? ???????????????????????? ??(Assessment) ?????????????????????, ??????????????????????????? ????????????????????????????????? ?????? ????????????????????????
                        ????????????????????? ???????????????????????? ???????????? ?????? ???????????? ???????????????
                    </div>
                    <div style="text-align: initial;">
                        <b>Registration Date (????????????????????? ??????????????????)</b> : <u><span
                                id="">{{ date('d/m/Y', strtotime($user->registration_date)) }}</span></u>
                    </div>
        </section>
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
