@extends('form.layout')
@section('content')
    <div class="container">
        <ul class="nav nav-pills mb-5 mt-2" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link  btn " id="pills-personal-detail-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-personal-detail" type="button" role="tab"
                    aria-controls="pills-personal-detail" disabled aria-selected="true">Personal Details (व्यक्तिगत
                    विवरण)</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link btn  " id="pills-education-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-education" type="button" disabled role="tab" aria-controls="pills-education"
                    aria-selected="false">Education Details
                    शिक्षा विवरण</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link btn  " id="pills-work-experience-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-work-experience" disabled type="button" role="tab"
                    aria-controls="pills-work-experience" aria-selected="false">Work Experience
                    (कार्य
                    अनुभव)</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link btn " id="pills-other-tab" data-bs-toggle="pill" data-bs-target="#pills-other"
                    type="button" role="tab" aria-controls="pills-other" disabled aria-selected="false">Other
                    Information
                    (अतिरिक्त सूचना)</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link btn active " id="pills-document-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-document" type="button" role="tab" aria-controls="pills-document"
                    aria-selected="false">Documents & Final
                    Submit</button>
            </li>

        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-document" role="tabpanel" aria-labelledby="pills-document-tab">
                <form action="javascript:void(0);" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="form_id" value="{{ $form_id }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <fieldset class="mt-4">
                        <legend class="document">Documents</legend>
                        <div class="row mt-2">

                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <i class="bx bx-edit bx-2x"><strong class="notes">&nbsp;Note</strong></i><br>
                                    Before uploading any document make sure the document size is not
                                    more than 100 kb.
                                    The collective size of the documents must not exceed 1.5 MB. /
                                    किसी भी दस्तावेज़ को
                                    अपलोड करने से पहले सुनिश्चित करें कि दस्तावेज़ का आकार 100 kb से
                                    अधिक नहीं है।
                                    दस्तावेजों का सामूहिक आकार 1.5 एमबी से अधिक नहीं होना चाहिए।
                                </div>
                            </div>

                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label>Passport size Photo / पासपोर्ट साइज फोटो <span class="requiredt">*</span></label>
                                    <input type="file" name="passport_photo" accept=".jpg,.jpeg,.png" id="passport_photo"
                                        class="form-control" @if ($user->passport_photo == null || $user->passport_photo == '') required @endif>
                                    @if (isset($user->passport_photo))
                                        <div class="form-text text-success mt-0">File already
                                            uploaded!</div>
                                    @endif

                                    <span class="invalid-feedback d-none passport_photo" role="alert">
                                        <strong class="passport_photo_msg"></strong>
                                    </span>

                                </div>
                            </div>


                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label>10th Certificate / 10 वां प्रमाण पत्र <span class="requiredt">*</span></label>
                                    <input type="file" name="tenth_certificate" accept=".jpg,.jpeg,.png,.pdf"
                                        id="tenth_certificate" class="form-control"
                                        @if ($user->tenth_certificate == null || $user->tenth_certificate == '') required @endif>
                                    @if (isset($user->tenth_certificate))
                                        <div class="form-text text-success mt-0">File already
                                            uploaded!</div>
                                    @endif
                                    <span class="invalid-feedback d-none tenth_certificate" role="alert">
                                        <strong class="tenth_certificate_msg"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label>12th Certificate / 12 वां प्रमाण पत्र </label>
                                    <input type="file" name="twelve_certificate" accept=".jpg,.jpeg,.png,.pdf"
                                        id="twelve_certificate" class="form-control"
                                        @if (!isset($user->id))  @endif>
                                    @if (isset($user->twelve_certificate))
                                        <div class="form-text text-success mt-0">File already
                                            uploaded!</div>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label>ITI Certificate / ITI प्रमाण पत्र <span class="requiredt">*</span></label>
                                    <input type="file" name="iti_certificate" accept=".jpg,.jpeg,.png,.pdf"
                                        id="iti_certificate" class="form-control"
                                        @if ($user->iti_certificate == null || $user->iti_certificate == '') required @endif>
                                    @if (isset($user->iti_certificate))
                                        <div class="form-text text-success mt-0">File already
                                            uploaded!</div>
                                    @endif
                                    <span class="invalid-feedback d-none iti_certificate" role="alert">
                                        <strong class="iti_certificate_msg"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label>Aadhar Front / आधार कार्ड <span class="requiredt">*</span></label>
                                    <input type="file" name="aadharcard" accept=".jpg,.jpeg,.png,.pdf"
                                        id="aadharcard" class="form-control"
                                        @if ($user->aadharcard == null || $user->aadharcard == '') required @endif>
                                    @if (isset($user->aadharcard))
                                        <div class="form-text text-success mt-0">File already
                                            uploaded!</div>
                                    @endif
                                    <span class="invalid-feedback d-none aadharcard" role="alert">
                                        <strong class="aadharcard_msg"></strong>
                                    </span>
                                </div>
                            </div>


                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label>Aadhar Back / आधार कार्ड <span class="requiredt">*</span></label>
                                    <input type="file" name="aadhar_card_back" accept=".jpg,.jpeg,.png,.pdf"
                                        id="aadhar_card_back" class="form-control"
                                        @if ($user->aadhar_card_back == null || $user->aadhar_card_back == '') required @endif>
                                    @if (isset($user->aadhar_card_back))
                                        <div class="form-text text-success mt-0">File already
                                            uploaded!</div>
                                    @endif
                                    <span class="invalid-feedback d-none aadhar_card_back" role="alert">
                                        <strong class="aadhar_card_back_msg"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label>PAN Card / पैन कार्ड </label>
                                    <input type="file" name="pancard" accept=".jpg,.jpeg,.png,.pdf"
                                        class="form-control">
                                    @if (isset($user->pancard))
                                        <div class="form-text text-success mt-0">File already
                                            uploaded!</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="mt-3">
                        <legend>
                            <p>Confirm & Submit</p>
                        </legend>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input radius-4" name="i_agree" type="checkbox"
                                            {{ isset($user->agreed) && $user->agreed == 'YES' ? 'checked' : '' }}>
                                        <label for="i_agree"> I hereby declare that the particulars given
                                            above are true to the best of my knowledge and
                                            belief. Nothing has been hidden or falsely stated above. If, at any
                                            stage of recruitment it is
                                            found that I have hidden any facts/ information or if any
                                            information provided by me is
                                            found misleading / incorrect, then company may cancel my candidature
                                            and may take
                                            appropriate legal action against me, for which I will be solely
                                            responsible. I understand that
                                            my appointment in the company services will be subject to my passing
                                            the assessment test,
                                            personal interview and medical examination. <br>
                                            मैं एतद्द्वारा घोषणा करता हूं कि ऊपर दिए गए विवरण मेरे सर्वोत्तम
                                            ज्ञान और विश्वास के अनुसार सत्य हैं। ऊपर प्रदान
                                            की गई जानकारी में कुछ भी छिपाया नहीं गया है एवं ना ही कोई जानकारी
                                            भ्रामक/गलत प्रदान की गई है। भर्ती के
                                            किसी भी चरण में यदि यह पाया जाता है कि मैंने कोई तथ्य/जानकारी छुपाई
                                            है या मेरे द्वारा प्रदान की गई कोई भी
                                            जानकारी भ्रामक/गलत पाई जाती है, तो कंपनी मेरी उम्मीदवारी को रद्द कर
                                            सकती है और मेरे खिलाफ उचित कानूनी
                                            कार्रवाई कर सकती है, जिसके लिए मैं पूरी तरह जिम्मेदार होउगा। मैं
                                            समझता हूं कि कंपनी की सेवाओं में मेरी नियुक्ति
                                            मेरे द्वारा असेसमेंट (Assessment) परीक्षा, व्यक्तिगत साक्षात्कार और
                                            चिकित्सा परीक्षा उत्तीर्ण करने के अधीन होगी।</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-primary text-white radius-2 mt-3">Submit</button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(() => {
            $('form').validate({
                rules: {
                    pancard: {
                        accept: "image/jpeg, image/pjpeg, image/jpeg,image/png, pdf",
                    },
                    aadhar_card_back: {
                        accept: "image/jpeg, image/pjpeg, image/jpeg,image/png, pdf",
                    },
                    aadharcard: {
                        accept: "image/jpeg, image/pjpeg, image/jpeg,image/png, pdf",
                    },
                    iti_certificate: {
                        accept: "image/jpeg, image/pjpeg, image/jpeg,image/png, pdf",
                    },
                    twelve_certificate: {
                        accept: "image/jpeg, image/pjpeg, image/jpeg,image/png, pdf",
                    },
                    tenth_certificate: {
                        accept: "image/jpeg, image/pjpeg, image/jpeg,image/png, pdf",
                    },

                    passport_photo: {
                        accept: "image/jpeg, image/pjpeg, image/jpeg,image/png",
                    },
                },
                submitHandler: function(form, event) {
                    event.preventDefault();

                    var formData = new FormData(form);
                    $.ajax({
                        url: "{{ route('store-document') }}",
                        type: "POST",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $(".loader-wrapper").removeClass("d-none");
                            $('#save_detail').prop("disabled", true);
                            $('#save_detail').html(
                                `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>`
                            );
                        },

                        complete: function() {
                            $(".loader-wrapper").addClass("d-none");
                            $('.add_remark_status_btn').prop('disabled', false);
                            $('#save_detail').prop("disabled", false);
                            $('#save_detail').html('Save And Continue Later');
                        },

                        success: function(response) {

                            if (response.status == true) {
                                if (response.success_input) {
                                    $.each(response.success_input, function(key,
                                        value) {
                                        $('#' + value).removeClass(
                                            'is-invalid');
                                        $('.' + value).addClass('d-none');
                                        $('.' + value + '_msg').html('');
                                    });
                                }
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    text: response.msg,
                                    title: "Success",
                                    showConfirmButton: true,
                                }).then(() => {
                                    if (response.redirect_url) {
                                        window.location.replace(response
                                            .redirect_url);
                                    }
                                });

                            } else if (response.status == false) {
                                if (response.first_error) {
                                    $('#' + response.first_error).focus();
                                }
                                if (response.errors) {
                                    $.each(response.errors, function(key, value) {
                                        $('#' + key).addClass('is-invalid');
                                        $('.' + key).removeClass('d-none');
                                        $('.' + key + '_msg').html(value);
                                    });

                                } else {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        text: response.msg,
                                        title: "Error",
                                        showConfirmButton: true,
                                    });
                                }
                                if (response.success_input) {
                                    $.each(response.success_input, function(key,
                                        value) {
                                        $('#' + value).removeClass(
                                            'is-invalid');
                                        $('.' + value).addClass('d-none');
                                        $('.' + value + '_msg').html('');
                                    });
                                }

                                if (response.email_error) {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'warning',
                                        text: response.msg,
                                        title: "warning",
                                        showConfirmButton: true,
                                    }).then(() => {
                                        if (response.redirect_url) {
                                            window.location.replace(response
                                                .redirect_url);
                                        }
                                    });
                                }
                            }
                        },
                        error: function() {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                text: "Something went wrong..",
                                title: "Error",
                                showConfirmButton: true,
                            }).then(() => {
                                location.relode();
                            });
                        }
                    });
                },
                highlight: function(element) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element) {
                    $(element).removeClass("is-invalid");
                },
            });
        });
    </script>
@endsection
