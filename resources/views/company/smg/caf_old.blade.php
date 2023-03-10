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

    <style>
        .headbox {
            background-color: #140698 !important;
            color: white !important;
            font-size: 12px !important;
            
        }
        .mainwrapper{
            border: 0px !important;
        }

        .pagehead {
            display: flex !important;
            justify-content: end !important;
            align-items: center !important;
        }
        @page { size: auto;  margin: 0px 10px 0px 10px; }
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

        <section class=" align-content-center text-capitalize text-center border p-3">
            <!-------------- // Page One Design // -------------->

            <div class="mainwrapper">
                <!------------// Page Heading  //--------------->
                <div class="container-fluid">
                    <div class="row" style="    min-height: 110px !important;">
                        <div class="col-8 d-flex justify-content-end align-items-center">
                            <h4><b>PERSONAL DATA FORM</b>
                            </h4>
                        </div>
                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <div>
                                <img src="{{ getImage($user->getCompany->logo) }}" style="height: 100px;" class=" img-thumbnail img-fluid">
                            </div>
                        </div>
                    </div>
                </div>

                <!------------ Personal Information Columns ------------>

                <div class="headbox borbot"> Personal Information (??????????????????????????? ???????????????) </div>

                <div class="perosnalbx">
                    <table class="perosnaltable " cellpadding="0" cellspacing="0">

                        <tr>
                            <td class="tblinnermaincol1">
                                <div class="tblinnerempdetails">
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="emphead">Registration Id: </td>
                                            <td class="empdetails"><span
                                                    id="lblRegistrationId">{{ $user->unique_id }}</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="emphead">Full Name : </td>
                                            <td class="empdetails"><span id="lblFullName">{{ $user->first_name }}
                                                    {{ $user->last_name }}</span></td>
                                        </tr>

                                        <tr>
                                            <td class="emphead">Birthdate (???????????? ????????????) : </td>
                                            <td class="empdetails">
                                                <span id="lblBirthDate">
                                                    {{ $user->dob ? date('d/m/Y', strtotime($user->dob)) : '' }}</span>
                                                <span class="rightpos"> <b>Age (????????????) (YY/MM)</b> :<span
                                                        id="lblAgeYear">{{ \Carbon\Carbon::parse(date('Y-m-d', strtotime($user->dob)))->diff(\Carbon\Carbon::now())->format('%y') }}</span>
                                                    Years /
                                                    <span
                                                        id="lblAgeMonth">{{ \Carbon\Carbon::parse(date('Y-m-d', strtotime($user->dob)))->diff(\Carbon\Carbon::now())->format('%m') }}</span></span>
                                                Month
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="emphead">Father's Name (???????????? ?????? ?????????) : </td>
                                            <td class="empdetails"><span
                                                    id="lblFatherName">{{ $user->father_name }}</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="emphead"><b>Present Address (????????????????????? ?????????)</b> :</td>
                                            <td class="empdetails" style="padding:10px 0px 10px 5px">
                                                House / Flat No (???????????? ??????????????????) &nbsp; <u><span
                                                        id="lblPreAdd_House_FlatNo">{{ $user->present_house_number }}</span></u>
                                                Street / Village (?????????/???????????????) &nbsp; <u><span
                                                        id="lblPreAdd_Street_Village">{{ $user->present_house_street_village }}</span></u>
                                                <br />
                                                District (????????????) &nbsp; <u><span
                                                        id="lblPreAdd_District">{{ $user->present_district_name }}</span></u>
                                                State (???????????????) &nbsp; <u><span
                                                        id="lblPreAdd_State">{{ $user->present_state_name }}</span></u>
                                                Pincode (??????????????????) &nbsp; <u><span
                                                        id="lblPreAdd_PinCode">{{ $user->present_pincode }}</span></u>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="emphead"><b>Permanent Address (?????????????????? ????????? )</b> :</td>
                                            <td class="empdetails" style="padding:5px 0px 5px 5px">
                                                House / Flat No (???????????? ??????????????????) &nbsp; <u><span
                                                        id="lblPerAdd_House_FlatNo">{{ $user->permanent_house_number }}</span></u>
                                                Street / Village (?????????/???????????????) &nbsp; <u><span
                                                        id="lblPerAdd_Street_Village">{{ $user->permanent_house_street_village }}</span></u>
                                                <br />
                                                District (????????????) &nbsp; <u><span
                                                        id="lblPerAdd_District">{{ $user->permanent_district_name }}</span></u>
                                                State (???????????????) &nbsp; <u><span
                                                        id="lblPerAdd_State">{{ $user->permanent_state_name }}</span></u>
                                                Pincode (?????????????????? &nbsp; <u><span
                                                        id="lblPerAdd_PinCode">{{ $user->permanent_pincode }}</span>
                                                </u>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </td>

                            <td style="border-bottom: 1.5px solid #333;
                        padding: 10px;">

                                <img src="{{ getImage($user->passport_photo) }}" class=" img-thumbnail img-fluid">

                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" class="tblinnermaincol1" style="border-right:none">
                                <div class="tblinnerempdetails">
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="detailcolone"><b>Category (??????????????????)</b> :</td>
                                            <td class="detailcolthree" colspan="2"> <span
                                                    id="lblCategory">{{ $user->category }}</span>
                                            </td>

                                            <td class="detailcolfour" colspan="2"><b>Domicile State (????????? ???????????????
                                                    ??????????????????????????????)</b> :</td>
                                            <td class="detailcolseven" colspan="2"> <span
                                                    id="lblDomicileState">{{ $user->permanent_state_name }}</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="detailcolone"><b>Marital Status (????????????????????? ??????????????????)</b> :</td>
                                            <td class="detailcolthree" colspan="2"> <span
                                                    id="lblMaritalStatus">{{ $user->marital_status }}</span></td>

                                            <td class="detailcolfour" colspan="2"><b>Email ID (???????????? ????????????)</b> :
                                            </td>
                                            <td class="detailcolseven" colspan="2"> <span
                                                    id="lblEmail">{{ $user->email }}</span></td>
                                        </tr>

                                        <tr>
                                            <td class="detailcolone"><b>Mobile / (??????????????????)</b> :</td>
                                            <td class="detailcoltwo">?????????????????? 1 :</td>
                                            <td class="detailcolthree"> <span
                                                    id="lblMobileNo">{{ $user->phone_number }}</span></td>
                                            <td class="detailcolfour">?????????????????? 2 :</td>
                                            <td class="detailcolfive"> <span
                                                    id="lblAlternateMobile">{{ $user->alternative_number }}</span>
                                            </td>
                                            <td class="detailcolsix"> <b>Blood Group <br />(???????????? ???????????????)</b> :</td>
                                            <td class="detailcolseven"> <span
                                                    id="lblBloodGroup">{{ $user->blood_group }}</span></td>
                                        </tr>

                                        <tr>
                                            <td class="detailcolone"><b>Aadhaar Number (????????????)</b> : </td>
                                            <td class="detailcolthree" colspan="2"><span
                                                    id="lblAadhaar">{{ $user->aadhar_card }}</span></td>

                                            <td class="detailcolfour"><b>PAN No. (?????????)</b> : </td>
                                            <td class="detailcolseven" colspan="3"><span
                                                    id="lblPANNo">{{ $user->pancard }}</span>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </td>
                        </tr>

                    </table>
                </div>


                <!------------ Educational Qualifications ------------>
                <div class="headbox borbot" style="border-bottom:2px solid #333"> Educational Qualifications (????????????????????????
                    ???????????????????????????) </div>
                <div class="perosnalbx">
                    <table class="perosnaltable" cellpadding="0" cellspacing="0">

                        <tr style="background-color:#F5F5F5">
                            <td class="educolone"><b>Examination Passed <br />(???????????????????????? ????????????????????? ?????? ?????????)</b> :</td>
                            <td class="educoltwo"><b>College/Institution Name <br /> (???????????????/??????????????????????????????????????? ?????? ?????????)</b> :
                            </td>
                            <td class="educolthree"><b>Reg/ Correspondence <br /> (??????????????????????????? ??? ????????????????????????)</b> :</td>
                            <td class="educolfour"><b>Starting Month & Year (???????????? ????????????)</b> :</td>
                            <td class="educolfive"><b>Passing Month & Year (???????????????????????? ????????????)</b> :</td>
                            <td class="educolsix"><b>%age<br /> (?????????????????????)</b> :</td>
                        </tr>

                        <tr>

                            <td class="educolone">10th (??????????????? ???????????????) : </td>
                            <td class="educoltwo"><span
                                    id="lblClass10th_College_Institution_Name">{{ $user->tenth_college_name }}</span>
                            </td>
                            <td class="educolthree"><span
                                    id="lblClass10th_Regular_Correspondence">{{ $user->tenth_education_type }}</span>
                            </td>
                            <td class="educolfour"><span
                                    id="lblClass10th_StartingYear">{{ $user->tenth_start_year }}</span>
                            </td>
                            <td class="educolfive"><span
                                    id="lblClass10th_PassingYear">{{ $user->tenth_passing_year }}</span>
                            </td>
                            <td class="educolsix"><span
                                    id="lblClass10th_Percentage">{{ $user->tenth_score ? $user->tenth_score . '%' : '' }}</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="educolone">12th (????????????????????? ???????????????) : </td>
                            <td class="educoltwo"><span
                                    id="lblClass12th_College_Institution_Name">{{ $user->twelve_college_name }}</span>
                            </td>
                            <td class="educolthree"><span
                                    id="lblClass12th_Regular_Correspondence">{{ $user->twelve_education_type }}</span>
                            </td>
                            <td class="educolfour"><span
                                    id="lblClass12th_StartingYear">{{ $user->twelve_start_year }}</span>
                            </td>
                            <td class="educolfive"><span
                                    id="lblClass12th_PassingYear">{{ $user->twelve_passing_year }}</span>
                            </td>
                            <td class="educolsix"><span
                                    id="lblClass12th_Percentage">{{ $user->twelve_score ? $user->twelve_score . '%' : '' }}</span>
                            </td>

                        </tr>

                        <tr>
                            <td class="educolone">Any Other (Graduation etc.) : </td>
                            <td class="educoltwo"><span
                                    id="lblAnyOther_Graduation_College_Institution_Name">{{ $user->other_college_name }}</span>
                            </td>
                            <td class="educolthree"><span
                                    id="lblAnyOther_Graduation_Regular_Correspondence">{{ $user->other_education_type }}</span>
                            </td>
                            <td class="educolfour"><span
                                    id="lblAnyOther_Graduation_StartingYear">{{ $user->other_start_year }}</span></td>
                            <td class="educolfive"><span
                                    id="lblAnyOther_Graduation_PassingYear">{{ $user->other_passing_year }}</span>
                            </td>
                            <td class="educolsix"><span
                                    id="lblAnyOther_Graduation_Percentage">{{ $user->other_score ? $user->other_score . '%' : '' }}</span>
                            </td>
                        </tr>

                    </table>
                </div>


                <!------------ ITI Education Columns ------------>
                <div class="headbox borbot"> ITI Details (??????. ??????. ??????. ???????????????) </div>


                <div class="perosnalbx">
                    <table class="perosnaltable" cellpadding="0" cellspacing="0">

                        <tr style="background-color:#F5F5F5">
                            <td class="educolone"><b>Name of ITI & Location<br /> (??????. ??????. ??????. ?????? ????????? ??? ???????????????)</b> :
                            </td>
                            <td class="educolone"><b>ITI TYPE :</td>

                            <td class="educoltwo"><b>Trade<br /> (???????????????)</b> :</td>
                            @if ($user->trade_name == 'Other')
                                <td class="educolthree"><b>Other Trade<br /> (???????????? ???????????????)</b> :</td>
                            @endif

                            <td class="educolfour"><b>Certified Body (???????????????????????????????????????)</b> :</td>
                            <td class="educolfive"><b>Passing Year (???????????????????????? ????????????)</b> :</td>
                            <td class="educolsix"><b>ITI %age<br /> (?????????????????????)</b> :</td>
                        </tr>

                        <tr>

                            <td class="educolone"><span>{{ $user->iti_college_name }}</span></td>
                            <td class="educolone"> <span>{{ $user->iti_college_type }}</span></td>
                            <td class="educoltwo">
                                <span id="lblClass10th_College_Institution_Name">{{ $user->trade_name }}</span>
                            </td>
                            @if ($user->trade_name == 'Other')
                                <td class="educolfour">
                                    <span id="lblClass10th_StartingYear">{{ $user->other_trade }}</span>
                                </td>
                            @endif

                            <td class="educolthree"><span
                                    id="lblClass10th_Regular_Correspondence">{{ $user->iti_board_type }}</span></td>


                            <td class="educolfive"><span
                                    id="lblClass10th_PassingYear">{{ $user->iti_passing_year }}</span>
                            </td>
                            <td class="educolsix"><span id="lblClass10th_Percentage">{{ $user->iti_score }}%</span>
                            </td>
                        </tr>

                    </table>
                </div>






                <!------------ ITI Apprenticeship Columns ------------>
                <div class="headbox borbot"> Apprenticeship (???????????????????????????)</div>

                <div class="perosnalbx">
                    <table class="perosnaltable" cellpadding="0" cellspacing="0">
                        <tr style="background-color:#F5F5F5">
                            <td class="aprcolone"><b>Company Name <br /> (?????????????????? ?????? ?????????) : </b></td>
                            <td class="aprcoltwo"><b>Start Date <br /> (???????????? ????????????) : </b></td>
                            <td class="aprcolthree"><b>End Date <br /> (????????????????????? ????????????) : </b></td>
                            <td class="aprcolfour"><b>Location <br /> (???????????????) : </b></td>
                            <td class="aprcolfive"><b>Job Area/Shop <br /> (???????????????) : </b></td>
                            <td class="aprcolsix"><b>Stipend (p.m.) <br /> ??????????????????????????? ???????????? (??????????????? ?????????) : </b></td>
                        </tr>

                        <tr>
                            <td class="aprcolone"><span
                                    id="lblApprenticeship_CompanyName">{{ $user->apprentice_company_name }}</span>
                            </td>
                            <td class="aprcoltwo"><span
                                    id="lblApprenticeship_StartDate">{{ $user->apprentice_start_date ? date('d-m-Y', strtotime($user->apprentice_start_date)) : '' }}</span>
                            </td>
                            <td class="aprcolthree"><span
                                    id="lblApprenticeship_EndDate">{{ $user->apprentice_end_date ? date('d-m-Y', strtotime($user->apprentice_end_date)) : '' }}</span>
                            </td>
                            <td class="aprcolfour"><span
                                    id="lblApprenticeship_Location">{{ $user->apprentice_location }}</span></td>
                            <td class="aprcolfive"><span
                                    id="lblApprenticeship_JobArea_Shop">{{ $user->apprentice_division }}</span></td>
                            <td class="aprcolsix"><span
                                    id="lblApprenticeship_Stipend_per_month">{{ $user->apprentice_salary }}</span>
                            </td>

                        </tr>
                    </table>
                </div>

                <!------------  Work Experience Columns ------------>
                <div class="headbox borbot"> Work Experience (??????????????? ???????????????) </div>
                <div class="perosnalbx">
                    <table class="perosnaltable" cellpadding="0" cellspacing="0">
                        <tr style="background-color:#F5F5F5">
                            <td class="workcolone"><b>Company Name <br /> (?????????????????? ?????? ?????????) : </b></td>
                            <td class="workcoltwo"><b>Start Date (???????????? ????????????) : </b></td>
                            <td class="workcolthree"><b>End Date (????????????????????? ????????????) : </b></td>
                            <td class="workcolfour"><b>Location (???????????????) : </b></td>
                            <td class="workcolfive"><b>Regular/Contract (???????????????????????????/??????????????????) : </b></td>
                            <td class="workcolsix"><b>Job Area/Shop (???????????????) : </b></td>
                            <td class="workcolseven"><b>Stipend (p.m.) ??????????????????????????? ???????????? (??????????????? ?????????) : </b></td>
                        </tr>

                        <tr>
                            <td class="workcolone"><span
                                    id="lblWorkExperience_CompanyName">{{ $user->previous_company_name }}</span></td>
                            <td class="workcoltwo"><span
                                    id="lblWorkExperience_StartDate">{{ $user->previous_company_start_date }}</span>
                            </td>
                            <td class="workcolthree"><span
                                    id="lblWorkExperience_EndDate">{{ $user->previous_company_end_date }}</span></td>
                            <td class="workcolfour"><span
                                    id="lblWorkExperience_Location">{{ $user->previous_company_location }}</span></td>
                            <td class="workcolfive"><span
                                    id="lblWorkExperience_Regular_Contract">{{ $user->previous_company_type }}</span>
                            </td>
                            <td class="workcolsix"><span
                                    id="lblWorkExperience_JobArea">{{ $user->previous_company_division }}</span></td>
                            <td class="workcolseven"><span
                                    id="lblWorkExperience_Salary_per_month">{{ $user->previous_company_salary }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="workcolone"><span
                                    id="lblWorkExperience_CompanyName">{{ $user->previous_company_name_two }}</span>
                            </td>
                            <td class="workcoltwo"><span
                                    id="lblWorkExperience_StartDate">{{ $user->previous_company_start_date_two }}</span>
                            </td>
                            <td class="workcolthree"><span
                                    id="lblWorkExperience_EndDate">{{ $user->previous_company_end_date_two }}</span>
                            </td>
                            <td class="workcolfour"><span
                                    id="lblWorkExperience_Location">{{ $user->previous_company_location_two }}</span>
                            </td>
                            <td class="workcolfive"><span
                                    id="lblWorkExperience_Regular_Contract">{{ $user->previous_company_type_two }}</span>
                            </td>
                            <td class="workcolsix"><span
                                    id="lblWorkExperience_JobArea">{{ $user->previous_company_division_two }}</span>
                            </td>
                            <td class="workcolseven"><span
                                    id="lblWorkExperience_Salary_per_month">{{ $user->previous_company_salary_two }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="workcolone"><span
                                    id="lblWorkExperience_CompanyName">{{ $user->previous_company_name_three }}</span>
                            </td>
                            <td class="workcoltwo"><span
                                    id="lblWorkExperience_StartDate">{{ $user->previous_company_start_date_three }}</span>
                            </td>
                            <td class="workcolthree"><span
                                    id="lblWorkExperience_EndDate">{{ $user->previous_company_end_date_three }}</span>
                            </td>
                            <td class="workcolfour"><span
                                    id="lblWorkExperience_Location">{{ $user->previous_company_location_three }}</span>
                            </td>
                            <td class="workcolfive"><span
                                    id="lblWorkExperience_Regular_Contract">{{ $user->previous_company_type_three }}</span>
                            </td>
                            <td class="workcolsix"><span
                                    id="lblWorkExperience_JobArea">{{ $user->previous_company_division_three }}</span>
                            </td>
                            <td class="workcolseven"><span
                                    id="lblWorkExperience_Salary_per_month">{{ $user->previous_company_salary_three }}</span>
                            </td>
                        </tr>

                    </table>
                </div>

            </div>
            {{-- 
        <br /><br /><br /><br /><br /><br /><br /><br /><br /> --}}

            <div class="mainwrapper">

                <!------------  Family Details Columns ------------>
                <div class="headbox borbot"> Family Details </div>

                <div class="perosnalbx">
                    <table class="perosnaltable" cellpadding="0" cellspacing="0">

                        <tr style="background-color:#F5F5F5">
                            <td class="familycolone"><b>Family Member <br /> / (?????????????????? ???????????????) : </b></td>
                            <td class="familycoltwo"><b>Full Name <br /> / (???????????? ?????????) : </b></td>
                            <td class="familycolthree"><b>Age <br /> / (????????????) : </b></td>
                            <td class="familycolfour"><b>Occupation <br /> / (?????????????????????) : </b></td>
                            <td class="familycolfive"><b>Annual Income <br /> / (????????????????????? ??????) : </b></td>
                        </tr>

                        <tr>
                            <td class="familycolone">Father / (????????????) :</td>
                            <td class="familycoltwo"><span id="lblFather_FullName">{{ $user->father_name }}</span>
                            </td>
                            <td class="familycolthree"><span id="lblFather_Age">{{ $user->father_age }}</span></td>
                            <td class="familycolfour"><span
                                    id="lblFather_Occupation">{{ $user->father_occupation }}</span>
                            </td>
                            <td class="familycolfive"><span
                                    id="lblFather_AnnualIncome">{{ $user->father_annual_income }}</span></td>
                        </tr>

                        <tr>
                            <td class="familycolone">Mother / (????????????) :</td>
                            <td class="familycoltwo"><span id="lblMother_FullName">{{ $user->mother_name }}</span>
                            </td>
                            <td class="familycolthree"><span id="lblMother_Age">{{ $user->mother_age }}</span></td>
                            <td class="familycolfour"><span
                                    id="lblMother_Occupation">{{ $user->mother_occupation }}</span>
                            </td>
                            <td class="familycolfive"><span
                                    id="lblMother_AnnualIncome">{{ $user->mother_annual_income }}</span></td>
                        </tr>

                        <tr>
                            <td class="familycolone">Borther (s) / (?????????) :</td>
                            <td class="familycoltwo"><span
                                    id="lblBrotherOne_FullName">{{ $user->s1name }}</span>&nbsp;</td>
                            <td class="familycolthree"><span id="lblBrotherOne_Age">{{ $user->s1sage }}</span>&nbsp;
                            </td>
                            <td class="familycolfour"><span
                                    id="lblBrotherOne_Occupation">{{ $user->s1soccupation }}</span>&nbsp;</td>
                            <td class="familycolfive"><span
                                    id="lblBrotherOne_AnnualIncome">{{ $user->s1sannualincome }}</span>&nbsp;</td>
                        </tr>

                        <tr>
                            <td class="familycolone"></td>
                            <td class="familycoltwo"><span
                                    id="lblBrotherTwo_FullName">{{ $user->s2name }}</span>&nbsp;</td>
                            <td class="familycolthree"><span id="lblBrotherTwo_Age">{{ $user->s2sage }}</span>&nbsp;
                            </td>
                            <td class="familycolfour"><span
                                    id="lblBrotherTwo_Occupation">{{ $user->s2soccupation }}</span>&nbsp;</td>
                            <td class="familycolfive"><span
                                    id="lblBrotherTwo_AnnualIncome">{{ $user->s2sannualincome }}</span>&nbsp;</td>
                        </tr>

                        <tr>
                            <td class="familycolone"></td>
                            <td class="familycoltwo"><span id="lblBrotherThree_FullName">{{ $user->s3name }}</span>
                            </td>
                            <td class="familycolthree"><span
                                    id="lblBrotherThree_Age">{{ $user->s3sage }}</span>&nbsp;</td>
                            <td class="familycolfour"><span
                                    id="lblBrotherThree_Occupation">{{ $user->s3soccupation }}</span>&nbsp;</td>
                            <td class="familycolfive"><span
                                    id="lblBrotherThree_AnnualIncome">{{ $user->s3sannualincome }}</span>&nbsp;</td>
                        </tr>


                        <tr>
                            <td class="familycolone">Wife / (???????????????) :</td>
                            <td class="familycoltwo"><span id="lblWife_FullName">{{ $user->wife_name }}</span>&nbsp;
                            </td>
                            <td class="familycolthree"><span id="lblWife_Age">{{ $user->wife_age }}</span>&nbsp;
                            </td>
                            <td class="familycolfour"><span
                                    id="lblWife_Occupation">{{ $user->wife_occupation }}</span>&nbsp;
                            </td>
                            <td class="familycolfive"><span
                                    id="lblWife_AnnualIncome">{{ $user->wife_annual_income }}</span>&nbsp;</td>
                        </tr>

                        <tr>
                            <td class="familycolone">Children / (???????????????) :</td>
                            <td class="familycoltwo"><span
                                    id="lblChildrenOne_FullName">{{ $user->child1name }}</span>&nbsp;
                            </td>
                            <td class="familycolthree"><span
                                    id="lblChildrenOne_Age">{{ $user->child1sage }}</span>&nbsp;</td>
                            <td class="familycolfour"><span id="lblChildrenOne_Occupation"></span>&nbsp;</td>
                            <td class="familycolfive"><span id="lblChildrenOne_AnnualIncome"></span>&nbsp;</td>
                        </tr>

                        <tr>
                            <td class="familycolone"></td>
                            <td class="familycoltwo"><span
                                    id="lblChildrenTwo_FullName">{{ $user->child2name }}</span>&nbsp;
                            </td>
                            <td class="familycolthree"><span
                                    id="lblChildrenTwo_Age">{{ $user->child2sage }}</span>&nbsp;</td>
                            <td class="familycolfour"><span id="lblChildrenTwo_Occupation"></span>&nbsp;</td>
                            <td class="familycolfive"><span id="lblChildrenTwo_AnnualIncome"></span>&nbsp;</td>
                        </tr>

                        <tr>
                            <td class="familycolone"></td>
                            <td class="familycoltwo"><span
                                    id="lblChildrenThree_FullName">{{ $user->child3name }}</span>&nbsp;
                            </td>
                            <td class="familycolthree"><span
                                    id="lblChildrenThree_Age">{{ $user->child3sage }}</span>&nbsp;
                            </td>
                            <td class="familycolfour"><span id="lblChildrenThree_Occupation"></span>&nbsp;</td>
                            <td class="familycolfive"><span id="lblChildrenThree_AnnualIncome"></span>&nbsp;</td>
                        </tr>

                    </table>
                </div>


                <!------------ Other Information Columns ------------>
                <div class="headbox borbot"> Other Information (???????????????????????? ???????????????) </div>

                <div class="perosnalbx">
                    <table class="perosnaltable" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="othercolone"><b>Computer Knowledge</b> / (???????????????????????? ???????????????) : </td>
                            <td class="othercoltwo" colspan="3">

                                <table class="perosnaltable" style="border: 0px" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            @if ($user->msword == 'YES')
                                                <td id="lblComputerKnowledge">Ms Word</td>
                                            @endif
                                            @if ($user->msexcel == 'YES')
                                                <td id="lblComputerKnowledge">Ms Excel</td>
                                            @endif
                                            @if ($user->internet == 'YES')
                                                <td id="lblComputerKnowledge">Internet</td>
                                            @endif
                                            @if ($user->basic == 'YES')
                                                <td id="lblComputerKnowledge">Basic Computer</td>
                                            @endif
                                            @if ($user->nil == 'YES')
                                                <td id="lblComputerKnowledge">Nil</td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>

                            </td>
                        </tr>

                        <tr>
                            <td class="othercolone"><b>Are You Physically Handicapped?</b> / <br />???????????? ?????? ????????????????????? ?????? :
                            </td>
                            <td class="othercoltwo"><span
                                    id="lblPhysicallyHandicapped">{{ $user->physically_handicapped }}</span></td>

                            <td class="othercolthree"><b>If Yes, Give Details</b> / <br />????????? ?????????, ?????? ??????????????? ?????????????????? :
                            </td>
                            <td class="othercolfour"><span
                                    id="lblPhysicallyHandicapped_Details">{{ $user->physically_handicap_information }}</span>
                            </td>

                        </tr>

                        <tr>
                            <td class="othercolone"><b>Do you know four wheeler driving?</b> / <br />???????????? ?????? ????????? ???????????????
                                ???????????? ???????????? ??????????????? ??????????????? ????????? : </td>
                            <td class="othercoltwo"><span
                                    id="lblFour_Wheeler_Driving_Skill">{{ $user->car_driving }}</span></td>

                            <td class="othercolthree"><b>Driving Licence No</b> / <br />????????????????????? ???????????? : </td>
                            <td class="othercolfour"><span
                                    id="lblDrivingLicenceNo">{{ $user->driving_license }}</span></td>

                        </tr>

                        <tr>
                            <td class="othercolone" colspan="3">
                                <b>Details of any past major surgery / illness requiring hospitalisation or long
                                    treatment</b> / <br />
                                ???????????? ?????????????????? ??????????????? ?????????????????? / ?????????????????? ?????? ??????????????? ?????????????????? ???????????? : ??????????????? ????????? ????????????????????? ????????? ??????????????? ??????
                                ??????????????? ????????? ?????? ??????????????? ?????? ???????????????????????? ????????? ?????? :
                            </td>

                            <td class="othercolfour"><span
                                    id="lblDetails_Past_Major_Surgery">{{ $user->detail_of_past_surgery }}</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="othercolone" colspan="2"><b>Have you ever been declared medically unfit?
                                    Give
                                    Reasons for same</b> / <br />
                                ????????? ???????????? ??????????????????????????? ?????? ?????????????????? ?????? ?????????????????? ??????????????? ???????????? ????????? ?????? ? ???????????? ??????????????? ????????? :
                                <b>{{ $user->medically_unfit }} </b>
                            </td>

                            <td class="othercoltwo" colspan="2"><span
                                    id="lblMedicallyUnfit_Reasons">{{ $user->medically_unfit }}</span></td>
                        </tr>


                        <tr>
                            <td class="othercolone" colspan="2"><b>Are you a patient of epilepsy/or taking medicine
                                    related to epilepsy</b> / <br />
                                ???????????? ?????? ?????????????????? ?????? ???????????? ?????????/?????? ?????????????????? ?????? ????????????????????? ????????? ???????????? ?????? ????????? ????????? : </td>
                            <td class="othercoltwo" colspan="2"><span id="lblMedicallyUnfit_Reasons">
                                    <b>{{ $user->epilepsy }}</b> </span></td>
                        </tr>



                        <tr>
                            <td class="othercolone" colspan="2"><b>Have you applied to this company earlier? If
                                    yes,
                                    then when and where </b> / <br />
                                ???????????? ???????????? ???????????? ?????? ??????????????? ????????? ??????????????? ???????????? ?????? ? ????????? ????????? ?????? ?????? ?????? ???????????? | :
                                <b>{{ $user->have_you_applied }}</b>
                            </td>
                            <td class="othercoltwo" colspan="2"><span
                                    id="lblAppliedCompany_Earlier">{{ $user->applied_before }}</span></td>
                        </tr>

                        <tr>
                            <td class="othercolone" colspan="2"><b>Have you worked with Maruti Suzuki/SMG earlier?
                                    If
                                    yes, then please provide your details.</b> /
                                ???????????? ???????????? ???????????? ????????? ?????????????????? ?????????????????? / SMG ????????? ????????? ???????????? ?????? ? ????????? ????????? ?????? ???????????? ??????????????? ?????????????????? :
                                <b>{{ $user->already_worked }}</b>
                            </td>

                            <td class="othercoltwo" colspan="2">
                                Category : <span id="lblMS_Category">{{ $user->already_worked_category }}</span>
                                <br />
                                Staff ID : <span id="lblStaff_ID">{{ $user->already_worked_staff_id }}</span> <br />
                                Time Period : <span
                                    id="lblTime_Period">{{ $user->already_worked_time_period }}</span> <br />
                                Shop & Location : <span
                                    id="lblShop_Location">{{ $user->already_worked_shop_location }}</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="othercolone" colspan="4"><b>Do you know anyone in Maruti Suzuki? Please give
                                    details.</b> /
                                ????????? ?????? ?????????????????? ?????????????????? ??????????????? ????????? ???????????? ?????? ???????????? ?????? ??????????????? ?????? ?????? ?????? ????????????????????? ?????? ??????????????? ?????????????????? |
                                : <b>{{ $user->already_know }}</b></td>
                        </tr>

                        <tr>
                            <td class="othercolone" colspan="2">Full Name : </td>
                            <td class="othercolthree" colspan="2"><span
                                    id="lblMS_FullName">{{ $user->already_know_full_name }}</span></td>
                        </tr>

                        <tr>
                            <td class="othercolone" colspan="2">Department : </td>
                            <td class="othercolthree" colspan="2"><span
                                    id="lblMS_Department">{{ $user->already_know_department }}</span></td>
                        </tr>

                        <tr>
                            <td class="othercolone" colspan="2">Work Location : </td>
                            <td class="othercolthree" colspan="2"><span
                                    id="lblMS_WorkLocation">{{ $user->already_know_location }}</span></td>
                        </tr>

                        <tr>
                            <td class="othercolone" colspan="2">Mobile : </td>
                            <td class="othercolthree" colspan="2"><span
                                    id="lblMS_Mobile">{{ $user->already_know_mobile }}</span></td>
                        </tr>

                        <tr>
                            <td class="othercolone" colspan="2">Relation : </td>
                            <td class="othercolthree" colspan="2"><span
                                    id="lblMS_Relation">{{ $user->already_know_relation }}</span></td>
                        </tr>

                        <tr>
                            <td class="othercolone" colspan="2">Referred By : </td>
                            <td class="othercolthree" colspan="2"><span
                                    id="lblMS_Relation">{{ $user->referred_by }}</span></td>
                        </tr>

                    </table>
                </div>

            </div>

            <div class="termstext">
                <input id="ChkTerm" disabled type="checkbox" name="ChkTerm"
                    @if ($user->agreed == 'YES') checked="checked" @endif /> I hereby declare that the particulars
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
