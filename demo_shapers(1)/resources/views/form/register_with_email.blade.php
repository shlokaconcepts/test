@extends('form.form_app')
@section('style')
    <style>
        .head_section {
            background-color: #595959;
        }

        h1,
        h4,
        h3,
        h5,
        h6 {
            color: #00143c !important;
        }

        footer {
            background-color: #595959;
        }

        .close_text {
            line-height: 29px;
            font-size: 14px;
            background: #b02930;
            padding: 0px 15px;
            border-radius: 3px;
        }

        .accordion-button {
            border-radius: 0px !important;
            background: #fff !important;
        }

        .accordion-button:focus {
            outline: none !important;
            box-shadow: none;
        }



        .success-message {
            color: #106515;
        }

        .resend_btn {
            padding: 6px 39px;
            background: transparent;
            color: black;

        }

        .step_bg {
            background-color: #2f646e !important;
            color: white;
        }

        .loader-wrapper {
            position: fixed;
            z-index: 999999 !important;
            box-sizing: border-box;
            width: 100vw;
            overflow: hidden;
            height: 100vh !important;
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.5);
            transition: .5s !important;
            top: 0;
        }

        .success_message {
            position: absolute;
            top: 57%;
            margin-left: 40px;
        }

        .overflow-hidden {
            overflow: hidden;
        }

        #heading {
            text-transform: uppercase;
            color: #673AB7;
            font-weight: normal
        }

        #msform {
            text-align: center;
            position: relative;
            margin-top: 20px
        }

        #msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 0.5rem;
            box-sizing: border-box;
            width: 100%;
            margin: 0;
            padding-bottom: 20px;
            position: relative
        }

        .form-card {
            text-align: left
        }

        #msform fieldset:not(:first-of-type) {
            display: none
        }

        #msform input,
        #msform textarea {
            padding: 8px 15px 8px 15px;
            border: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 25px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            background-color: #ECEFF1;
            font-size: 16px;
            letter-spacing: 1px
        }

        #msform input:focus,
        #msform textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #673AB7;
            outline-width: 0
        }

        #msform .action-button {
            width: 100px;
            background: #673AB7;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 0px 10px 5px;
            float: right
        }

        #msform .action-button:hover,
        #msform .action-button:focus {
            background-color: #311B92
        }

        #msform .action-button-previous {
            width: 100px;
            background: #616161;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px 10px 0px;
            float: right
        }

        #msform .action-button-previous:hover,
        #msform .action-button-previous:focus {
            background-color: #000000
        }

        .card {
            z-index: 0;
            border: none;
            position: relative
        }

        .fs-title {
            font-size: 25px;
            color: #673AB7;
            margin-bottom: 15px;
            font-weight: normal;
            text-align: left
        }

        .purple-text {
            color: #673AB7;
            font-weight: normal
        }

        .steps {
            font-size: 25px;
            color: gray;
            margin-bottom: 10px;
            font-weight: normal;
            text-align: right
        }

        .fieldlabels {
            color: gray;
            text-align: left
        }

        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: lightgrey
        }

        #progressbar .active {
            color: #130232;
        }

        #progressbar li {
            list-style-type: none;
            font-size: 15px;
            width: 25%;
            float: left;
            position: relative;
            font-weight: 400
        }

        #progressbar #account:before {
            font-family: boxicons !important;
            content: "\eab5";
            padding-left: 14px;
            padding-top: 3px;
        }

        #progressbar #personal:before {
            font-family: FontAwesome;
            content: "\f385";
            padding-left: 11px;
            padding-top: 3px;
        }


        #progressbar #confirm:before {
            font-family: FontAwesome;
            content: "\f298";
            padding-left: 15px;
            padding-top: 3px;
        }

        #progressbar li:before {
            width: 50px;
            height: 50px;
            line-height: 45px;
            display: block;
            font-size: 20px;
            color: #ffffff;
            background: lightgray;
            border-radius: 50%;
            margin: 0 auto 10px auto;
        }

        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: lightgray;
            position: absolute;
            left: 0;
            top: 25px;
            z-index: -1
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #2D3394;
        }

        .progress {
            height: 20px
        }

        .progress-bar {
            background: #2D3394;
        }

        .fit-image {
            width: 100%;
            object-fit: cover
        }

        #progressbar li strong {
            margin-left: 76px;
        }

        @media only screen and (max-width: 600px) {
            .close_text {
                margin-left: 0px !important;
                margin-top: 10px;
            }

            #progressbar li {
                width: 33%;
            }

            #progressbar li strong {
                margin-left: inherit;
                font-size: 12px;
            }

            #confirm {
                padding-left: 24px;
            }

            #progressbar {
                margin-left: -38px;
            }
        }

        .title {
            max-width: 400px;
            margin: auto;
            text-align: center;
            font-family: "Poppins", sans-serif;
        }

        .title h3 {
            font-weight: bold;
        }

        .title p {
            font-size: 12px;
            color: #118a44;
        }

        .title p.msg {
            color: initial;
            /* text-align: initial; */
            font-weight: bold;
        }

        .otp-input-fields {
            margin: auto;
            background-color: white;
            box-shadow: 0px 0px 8px 0px #020250 44;
            max-width: 400px;
            width: auto;
            display: flex;
            justify-content: center;
            gap: 10px;
            /* padding: 40px; */
        }

        .otp-input-fields input {
            height: 40px;
            width: 40px;
            background-color: transparent;
            border-radius: 4px;
            border: 1px solid #008cffbf;
            text-align: center;
            outline: none;
            font-size: 16px;
            /* Firefox */
        }

        .otp-input-fields input::-webkit-outer-spin-button,
        .otp-input-fields input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .otp-input-fields input[type=number] {
            -moz-appearance: textfield;
        }

        .otp-input-fields input:focus {
            border-width: 2px;
            border-color: #008cff;
            font-size: 20px;
        }

        .modal-close-btn {
            font-size: 24px;
            padding: 0.5rem 0.5rem;
            margin: -0.5rem -0.5rem -0.5rem auto;
            box-sizing: content-box;
            width: 1em;
            height: 1em;
            padding: 0.25em 0.25em;
            border: 0;
            border-radius: 0.25rem;
            background: transparent;
            line-height: 9px;
            color: whitesmoke;
        }
    </style>
@endsection


@section('wrapper')
    <div class="container d-none">
        <div class="row">
            <div class="mx-auto col-md-6 mt-5">
                <img class="w-100" src="{{ getImage($data->company_logo) }}">
            </div>
        </div>
    </div>

    <section class=" head_section mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <nav class="nav pt-3 pb-3">
                        <h4 class=" text-white mb-0">{{ $data->reg_cat_name }} | Engagement
                        </h4>
                        <h6 class="  mx-3 text-white mb-0 close_text radius-2 d-none">(Registration closes on
                            {{ date('d M, Y h:i A', strtotime($data->closed_time)) }})</h6>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="accordion radius-0 bg-white" id="accordionExample">
                        <div class="accordion-item radius-0">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button text-primary" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Details and Process
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body ">
                                    {!! $data->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="step_section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="steps-main">
                        <div class="tabs">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul id="progressbar">
                                        <li class="active" id="account"><strong>Provide Email ID</strong></li>
                                        <li id="personal" class=""><strong>Email Verification</strong></li>
                                        <li id="confirm" class=""><strong>Fill Registration Form</strong></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class=" mt-5 ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>Step 1: Provide Email ID</h4>
                </div>
            </div>
        </div>
    </section>

    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-none  border radius-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="offset-md-4 col-md-4">
                                    <div class="p-5 my-5 card roundcorner-5 bg-light">

                                        <form id="send_otp_form" action="javascript:void(0)">
                                            <div class="form-group">
                                                <label>Your Email Id:<span class="text-danger">*</span></label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    required="" placeholder="Enter Your Email Id">
                                                <button type="submit"
                                                    class="btn otp_send_btn btn-primary mt-3">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- verify otp modal  -->
    <div class="modal fade" id="verifyOtpModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header  align-items-center">
                    <h5 class="modal-title">Email OTP</h5>
                    <button type="button" class="modal-close-btn"> <i class="fadeIn animated bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="javascript: void(0)" class="otp-form" name="otp-form">
                        <div class="title">
                            <p class="info">OTP sent on <span class="user_mail"></span> successfully!</p>
                            <p class="msg">Please Enter the OTP Below</p>
                        </div>
                        <div class="otp-input-fields">
                            <input type="number" class="otp__digit otp__field__1">
                            <input type="number" class="otp__digit otp__field__2">
                            <input type="number" class="otp__digit otp__field__3">
                            <input type="number" class="otp__digit otp__field__4">
                            <input type="number" class="otp__digit otp__field__5">
                            <input type="number" class="otp__digit otp__field__6">
                        </div>
                    </form>

                    <div class=" mt-2 text-center">
                        <small>did't get the otp</small> <small><a href="javascript:void(0);" class="text-primary d-none"
                                id="resend_btn">Resend</a></small> <span class="text-danger count_down">00</span>
                    </div>
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-primary w-50" style="border-radius: 19px;" disabled
                            id="verify_OTP">Verify</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end verify otp modal  -->
@endsection
@section('script')
    <script>
        $(() => {

            var interval = '';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $('#send_otp_form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    data: {
                        email: $('#email').val()
                    },
                    dataType: "json",
                    url: "{{ route('send-otp') }}",
                    encode: true,
                    beforeSend: function() {
                        $('.success_message').html('We Are Sending OTP .Please Wait');
                        $('body').addClass("overflow-hidden");
                        $(".loader-wrapper").removeClass("d-none");
                        $(".otp_send_btn").prop("disabled", true);
                    },
                    complete: function() {
                        $('.success_message').html('');
                        $('body').removeClass("overflow-hidden");
                        $(".loader-wrapper").addClass("d-none");
                        $(".otp_send_btn").prop("disabled", false);
                    },

                    success: function(response) {
                        if (response.status == true) {
                            $("#personal").addClass('active');
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                text: response.msg,
                                title: "Success",
                                showConfirmButton: true,
                            }).then(() => {
                                clearInterval(interval);
                                var counter = 30;
                                interval = setInterval(function() {
                                    counter--;
                                    if (counter <= 0) {
                                        clearInterval(interval);
                                        $('.count_down').addClass('d-none');
                                        $('#resend_btn').removeClass('d-none');
                                        return;
                                    } else {
                                        $('.count_down').html('0');
                                        $('.count_down').html(counter);
                                    }
                                }, 1000);
                                $('.user_mail').html(response.input);
                                $('#verifyOtpModal').modal('show');
                            });
                        } else if (response.status == false) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                text: response.msg,
                                title: "Error",
                                showConfirmButton: true,
                            });

                        }
                    },
                    error: function() {

                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: "Error",
                            text: "Something went wrong..",
                            showConfirmButton: true,
                        })
                    }

                });

            });

            $('#resend_btn').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: "{{ url('resend-otp') }}",
                    beforeSend: function() {
                        $('.success_message').html('We Are Sending OTP .Please Wait');
                        $('body').addClass("overflow-hidden");
                        $(".loader-wrapper").removeClass("d-none");
                    },
                    complete: function() {
                        $('.success_message').html('');
                        $('body').removeClass("overflow-hidden");
                        $(".loader-wrapper").addClass("d-none");
                    },

                    success: function(response) {
                        if (response.status == true) {
                            $('#resend_btn').addClass('d-none');
                            $('.count_down').removeClass('d-none');
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                text: response.msg,
                                title: "Success",
                                showConfirmButton: true,
                            }).then(() => {
                                clearInterval(interval);
                                var counter = 30;
                                interval = setInterval(function() {
                                    counter--;
                                    if (counter <= 0) {
                                        clearInterval(interval);
                                        $('.count_down').addClass('d-none');
                                        $('#resend_btn').removeClass('d-none');
                                        return;
                                    } else {
                                        $('.count_down').html('0');
                                        $('.count_down').html(counter);
                                    }
                                }, 1000);
                                $('.user_mail').html(response.input);
                            });

                        } else if (response.status == false) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                text: response.msg,
                                title: "Error",
                                showConfirmButton: true,
                            })
                        }
                    },
                    error: function() {

                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            text: "Something went wrong..",
                            title: "Error",
                            showConfirmButton: true,
                        })
                    }
                });

            });

            $('#verify_OTP').click(function(e) {
                e.preventDefault();
                var otp = '';
                $('.otp__digit').each(function(key, val) {
                    otp += $(`.otp__field__${key+1}`).val();
                });
                $.ajax({
                    type: 'POST',
                    data: {
                        otp: otp,
                    },
                    url:"{{route('verify-code')}}",
                    dataType: 'json',
                    beforeSend: function() {
                        $('.success_message').html('We Are Verifying OTP .Please Wait');
                        $('body').addClass("overflow-hidden");
                        $(".loader-wrapper").removeClass("d-none");

                        $('#verify_OTP').prop("disabled", true);
                        $('#verify_OTP').html(`<span class="fadeIn animated bx bx-loader-circle bx-spin"></span>`);
                    },

                    complete: function() {
                        $('.success_message').html('');
                        $('body').removeClass("overflow-hidden");
                        $(".loader-wrapper").addClass("d-none");
                        $('#verify_OTP').html('Verify');
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $("#confirm").addClass('active');
                            $('.user_mail').html('');
                            $('#verifyOtpModal').modal('hide');

                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                text: "OTP Verified",
                                title: "Success",
                                showConfirmButton: true,
                            }).then(() => {
                                if (response.redirect_url) {
                                    window.location.replace(response.redirect_url);
                                }
                            });

                        } else if (response.status == false) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: "Error",
                                text: response.msg,
                                showConfirmButton: true,
                            })
                        }
                    },
                    error: function() {

                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            text: "Something went wrong..",
                            title: "Error",
                            showConfirmButton: true,
                        })
                    }

                });
            });

            $('.modal-close-btn').click(function() {
                clearInterval(interval);
                $('#verifyOtpModal').modal('hide');
                $('.count_down').html('0');
                document.querySelectorAll(".otp-form").reset();

            });
        });

        var otp_inputs = document.querySelectorAll(".otp__digit")
        var mykey = "0123456789".split("")
        otp_inputs.forEach((_) => {
            _.addEventListener("keyup", handle_next_input)
        })

        function handle_next_input(event) {
            let current = event.target
            let index = parseInt(current.classList[1].split("__")[2])
            current.value = event.key

            if (event.keyCode == 8 && index > 1) {
                current.previousElementSibling.focus()
            }
            if (index < 6 && mykey.indexOf("" + event.key + "") != -1) {
                var next = current.nextElementSibling;
                next.focus()
            }
            var _finalKey = ""
            for (let {
                    value
                } of otp_inputs) {
                _finalKey += value
            }

            let otp = '';
            $('.otp__digit').each(function(key, val) {
                otp += $(`.otp__field__${key+1}`).val();
            });
            if (otp.length == 6) {
                $('#verify_OTP').prop('disabled', false);
            } else {
                $('#verify_OTP').prop('disabled', true);
            }
        }
    </script>
@endsection
