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

        .form-label {
            margin-bottom: 3px !important;
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
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">
                                    <i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item " aria-current="page">
                                Document Details
                            </li>

                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <a onclick="location.href = document.referrer; return false;" class="btn btn-primary btn-sm add_exam">
                        <i class="fadeIn animated bx bx-arrow-back" aria-hidden="true"></i>Back
                    </a>
                </div>
            </div>


            <div class="card border border-primary">
                <div class="card-header bg-primary bg-gradient text-white ">
                    <i class="icon fa fa-user"></i> Basic Details
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-4 col-md-3">
                            <div class="form-group">
                                <label class="form-label ">Registraion ID :</label>
                                <div class="form-control-wrapper">
                                    <input type="text" value="{{ $user->unique_id }}" disabled="disabled"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-3">
                            <div class="form-group">
                                <label class="form-label ">Full Name :</label>
                                <input type="text" value="{{ $user->full_name }}" disabled="disabled"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-3">
                            <div class="form-group">
                                <label class="form-label">Mobile No. : </label>
                                <div class="form-control-wrapper">
                                    <input type="text" value="{{ $user->phone_number }}" disabled="disabled"
                                        class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-3 mt-3">
                            <div class="form-group">
                                <label class="form-label">Aadhaar : </label>
                                <div class="form-control-wrapper">
                                    <input type="text" value="{{ $user->aadhar_card }}" disabled="disabled"
                                        class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-3 mt-3">
                            <div class="form-group">
                                <label class="form-label">ITI Trade :</label>
                                <div class="form-control-wrapper">
                                    <input type="text" value="{{ $user->trade_name }}" disabled="disabled"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-3 mt-3">
                            <div class="form-group">
                                <label class="form-label">Category :</label>
                                <div class="form-control-wrapper">
                                    <input type="text" value="{{ $user->cat_name }}" disabled="disabled"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>



                </div>
            </div>


            <form class="card border border-success" id="StatusForm">
                <div class="card-header bg-success text-white ">
                    <i class="icon fa fa-briefcase"></i> Document Details
                </div>
                <div class="card-body">
                    <input type="hidden" name="id" value="{{ $data->id }}">

                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">10th Certificate &amp; Marksheet:</label>
                                <div class="form-control-wrapper">

                                    <a class="link" href="{{ getImage($user->tenth_certificate) }}" target="_blank"
                                        style="color: #428bca">Download File</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Approve/Reject :</label>
                                <div class=" d-flex">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Approve"
                                            @if ($data->tenth_certificate == 'Approve') checked @endif name="tenth_certificate"
                                            id="tenth_certificate_btn1">
                                        <label class="form-check-label text-success" for="tenth_certificate_btn1">
                                            Approve
                                        </label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" value="Reject"
                                            @if ($data->tenth_certificate == 'Reject') checked @endif name="tenth_certificate"
                                            id="tenth_certificate_btn2">
                                        <label class="form-check-label text-danger" for="tenth_certificate_btn2">
                                            Reject
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">12th Certificate &amp; Marksheet:</label>
                                <div class="form-control-wrapper">

                                    <a class="link" href="{{ getImage($user->twelve_certificate) }}" target="_blank"
                                        style="color: #428bca">Download File</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Approve/Reject :</label>
                                <div class=" d-flex">
                                    <div class="form-check">
                                        <input class="form-check-input " type="radio" value="Approve"
                                            @if ($data->twelve_certificate == 'Approve') checked @endif name="twelve_certificate"
                                            id="twelve_certificate_btn1">
                                        <label class="form-check-label text-success" for="twelve_certificate_btn1">
                                            Approve
                                        </label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" value="Reject"
                                            @if ($data->twelve_certificate == 'Reject') checked @endif name="twelve_certificate"
                                            id="twelve_certificate_btn2">
                                        <label class="form-check-label text-danger" for="twelve_certificate_btn2">
                                            Reject
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">ITI Certificate :</label>
                                <div class="form-control-wrapper">

                                    <a class="link" href="{{ getImage($user->iti_certificate) }}" target="_blank"
                                        style="color: #428bca">Download File</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Approve/Reject :</label>
                                <div class=" d-flex">
                                    <div class="form-check">
                                        <input class="form-check-input" value="Approve" type="radio"
                                            @if ($data->iti_certificate == 'Approve') checked @endif name="iti_certificate"
                                            id="iti_certificate_btn1">
                                        <label class="form-check-label text-success" for="iti_certificate_btn1">
                                            Approve
                                        </label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" value="Reject" type="radio"
                                            @if ($data->iti_certificate == 'Reject') checked @endif name="iti_certificate"
                                            id="iti_certificate_btn2">
                                        <label class="form-check-label text-danger" for="iti_certificate_btn2">
                                            Reject
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Profile Image:</label>
                                <div class="form-control-wrapper">

                                    <a class="link" href="{{ getImage($user->passport_photo) }}" target="_blank"
                                        style="color: #428bca">Download File</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Approve/Reject :</label>
                                <div class=" d-flex">
                                    <div class="form-check">
                                        <input class="form-check-input" value="Approve"
                                            @if ($data->profile_image == 'Approve') checked @endif type="radio"
                                            name="profile_image" id="profile_image_btn1">
                                        <label class="form-check-label text-success" for="profile_image_btn1">
                                            Approve
                                        </label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" value="Reject"
                                            @if ($data->profile_image == 'Reject') checked @endif type="radio"
                                            name="profile_image" id="profile_image_btn2">
                                        <label class="form-check-label text-danger" for="profile_image_btn2">
                                            Reject
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>



                    <div class="row mt-3">

                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Aadhar (Front):</label>
                                <div class="form-control-wrapper">

                                    <a class="link" href="{{ getImage($user->aadhar_card_front) }}" target="_blank"
                                        style="color: #428bca">Download File</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Approve/Reject :</label>
                                <div class=" d-flex">
                                    <div class="form-check">
                                        <input class="form-check-input" value="Approve"
                                            @if ($data->aadhar_card_front == 'Approve') checked @endif type="radio"
                                            name="aadhar_card_front" id="aadhar_card_front_btn1">
                                        <label class="form-check-label text-success" for="aadhar_card_front_btn1">
                                            Approve
                                        </label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" value="Reject" type="radio"
                                            @if ($data->aadhar_card_front == 'Reject') checked @endif name="aadhar_card_front"
                                            id="aadhar_card_front_btn2">
                                        <label class="form-check-label text-danger" for="aadhar_card_front_btn2">
                                            Reject
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Aadhar (Back):</label>
                                <div class="form-control-wrapper">

                                    <a class="link" href="{{ getImage($user->aadhar_card_back) }}" target="_blank"
                                        style="color: #428bca">Download File</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Approve/Reject :</label>
                                <div class=" d-flex">
                                    <div class="form-check">
                                        <input class="form-check-input" value="Approve" type="radio"
                                            @if ($data->aadhar_card_back == 'Approve') checked @endif name="aadhar_card_back"
                                            id="aadhar_card_back_btn1">
                                        <label class="form-check-label text-success" for="aadhar_card_back_btn1">
                                            Approve
                                        </label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" value="Reject" type="radio"
                                            @if ($data->aadhar_card_back == 'Reject') checked @endif name="aadhar_card_back"
                                            id="aadhar_card_back_btn2">
                                        <label class="form-check-label text-danger" for="aadhar_card_back_btn2">
                                            Reject
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row mt-3">

                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Pan (Front):</label>
                                <div class="form-control-wrapper">

                                    <a class="link" href="{{ getImage($user->pancard) }}" target="_blank"
                                        style="color: #428bca">Download File</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Approve/Reject :</label>
                                <div class=" d-flex">
                                    <div class="form-check">
                                        <input class="form-check-input" value="Approve" type="radio"
                                            @if ($data->pan_card == 'Approve') checked @endif name="pan_card"
                                            id="pan_card_front_btn1">
                                        <label class="form-check-label text-success" for="pan_card_front_btn1">
                                            Approve
                                        </label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" value="Reject" type="radio"
                                            @if ($data->pan_card == 'Reject') checked @endif name="pan_card"
                                            id="pan_card_front_btn2">
                                        <label class="form-check-label text-danger" for="pan_card_front_btn2">
                                            Reject
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Other Graduation File:</label>
                                <div class="form-control-wrapper">

                                    <a class="link" href="{{ getImage($user->other_graduation_file) }}"
                                        target="_blank" style="color: #428bca">Download File</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Approve/Reject :</label>
                                <div class=" d-flex">
                                    <div class="form-check">
                                        <input class="form-check-input" value="Approve" type="radio"
                                            @if ($data->other_graduation_file == 'Approve') checked @endif name="other_graduation_file"
                                            id="other_graduation_file_btn1">
                                        <label class="form-check-label text-success" for="other_graduation_file_btn1">
                                            Approve
                                        </label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" value="Reject" type="radio"
                                            @if ($data->other_graduation_file == 'Reject') checked @endif name="other_graduation_file"
                                            id="other_graduation_file_btn2">
                                        <label class="form-check-label text-danger" for="other_graduation_file_btn2">
                                            Reject
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group" style="text-align:left">
                                <label class="form-label ">Remarks :</label>
                                <div class="form-control-wrapper">
                                    <textarea rows="1" cols="20" placeholder="Remark" class=" form-control" name="remark">{{ $data->remark }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label ">Select Status <span class="required">*</span>
                                    :</label>
                                <div class="form-control-wrapper">
                                    <select name="status" class=" form-select">
                                        <option value="">Select Status</option>
                                        <option value="Hold" @if ($data->status == 'Hold') selected @endif>Hold
                                        </option>
                                        <option value="Doc Ok" @if ($data->status == 'Doc Ok') selected @endif>Doc Ok
                                        </option>
                                        <option value="Doc Mismatch" @if ($data->status == 'Doc Mismatch') selected @endif>
                                            Doc Mismatch</option>
                                        <option value="Fake Document" @if ($data->status == 'Fake Document') selected @endif>
                                            Fake Document</option>
                                        <option value="Document Not Available"
                                            @if ($data->status == 'Document Not Available') selected @endif>Document Not Available
                                        </option>
                                        <option value="Rejected" @if ($data->status == 'Rejected') selected @endif>
                                            Rejected</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 text-start ">
                            <button class=" btn btn-success mt-4" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>


            <div class="card border border-danger">
                <div class="card-header bg-danger bg-gradient text-white ">
                    <i class="icon fa fa-list-alt"></i> Important Notes
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <ul style="list-style-type:lower-alpha">
                                <li>Doc Ok : All documents available and no mismatch in any document i.e name/DOB/Father
                                    name.</li>
                                <li>Doc Mismatch : All documents available but name/DOB/Father name mismatched.</li>
                                <li>Hold : ITI handwritten.</li>
                                <li>Fake Doccuments: Any fake document uploaded by candidate.</li>
                                <li>Document missing: In case of any document not uploaded by candidate.</li>
                                <li>Rejected : Trade not valid / Over Age.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <!--end page wrapper -->
@endsection

@section('script')
    <script>
        $(() => {

            var approve_btn = 0;
            $('input[type=radio]').each(function() {
                if ($(this).val() == 'Approve') {
                    approve_btn += 1;
                }
            });


            // $('input[type="radio"]').change(function() {
            //     if($(".form-select").val()=='Doc Ok'){
            //         $(".form-select option:selected").prop("selected", false);
            //     }
            //     let checked_approve_btn=0;
            //     $('input[type=radio]:checked').each(function() {
            //         if ($(this).val()=='Approve') {
            //             checked_approve_btn+=1;
            //         }
            //     });
            //     if(approve_btn==checked_approve_btn){
            //         $(".form-select option[value='Doc Ok']").removeAttr("disabled","disabled");
            //     }else{

            //         $(".form-select option[value='Doc Ok']").attr("disabled","disabled");
            //     }
            // });



            $('#StatusForm').on('submit', function(e) {
                e.preventDefault();
                var postData = new FormData(document.getElementById('StatusForm'));
                postData.append("_token", "{{ csrf_token() }}");
                $.ajax({
                    type: 'POST',
                    data: postData,
                    contentType: false,
                    processData: false,
                    url: "{{ route('admin.change-document-status') }}",
                    success: function(response) {
                        if (response.status == true) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                text: response.msg,
                                title: 'Success',
                                showConfirmButton: true,
                            }).then(() => {
                                location.href = document.referrer;
                                return false;
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
        });
    </script>
@endsection
