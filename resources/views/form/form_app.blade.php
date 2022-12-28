<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ getImage($setting->favicon) }}" type="image/png" />
    <link href="{{ asset('public/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/plugins/datetimepicker/css/classic.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/datetimepicker/css/classic.date.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/select2/css/select2-bootstrap4.css') }}" />
    <script src="{{ asset('public/assets/js/lottie.js') }}"></script>
    <title>{{ isset($title) ? $title : '' }}</title>
    @yield('style')
    <style>
        .success_message {
            position: absolute;
            top: 57%;
            margin-left: 40px;
        }

        .loader-wrapper {
            position: fixed;
            z-index: 1056 !important;
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
    </style>
</head>

<body>

    <div class="loader-wrapper h-100 d-flex align-items-center justify-content-center d-none">
        <lottie-player src="{{ asset('public/assets/json/loader.json') }}" background="transparent" speed="1"
            style="width: 300px; height: 300px;" loop autoplay></lottie-player>
        <h3 class="success_message"></h3>
    </div>

    <nav id="navbar_top" class="navbar m-0 p-0 navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img class="nav-logo pt-2 pb-2"
                    src="{{ isset($data->company_logo) ? getImage($data->company_logo) : getImage($company->logo) }}"
                    height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse  justify-content-end" id="navbarSupportedContent">
                <img class="nav-logo pt-2 pb-2" src="{{ getImage($setting->logo) }}" height="50">

            </div>
        </div>
    </nav>



    @yield('wrapper')


    
        <!--Preview File Modal-->
        <div class="modal fade" id="my_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                        <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center">
                            <div class="col-12 col-lg-12 my_modal_html">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--End Preview File Modal-->
    <footer class=" pt-2 pb-2 border-top bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-sm">{{ $setting->copy_right }}</p>
                </div>
                <div class="col-md-6 text-end">

                    <ul class=" list-unstyled">
                        <li>
                            <a href="{{ url('terms-&-condition') }}" style="font-size: 13px;"
                                class=" link-primary text-decoration-none">Term & Condition
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('privacy-policy') }}"
                                style="font-size: 13px;"class="link-primary text-decoration-none">
                                Privacy Policy
                            </a>
                        </li>
                    </ul>



                </div>
            </div>
        </div>

    </footer>
    <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/sweetalert.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/picker.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/picker.date.js') }}"></script>

    <script src="{{ asset('public/assets/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/assets/validation/additional-methods.min.js') }}"></script>

    @if (Session::has('error'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: "Error",
                text: "{{ Session::get('error') }}".
                showConfirmButton: true,
            });
        </script>
    @endif

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    document.getElementById('navbar_top').classList.add('fixed-top');
                    navbar_height = document.querySelector('.navbar').offsetHeight;
                    document.body.style.paddingTop = navbar_height + 'px';
                } else {
                    document.getElementById('navbar_top').classList.remove('fixed-top');
                    document.body.style.paddingTop = '0';
                }
            });
        });
        // document.onkeydown = function(e) {
        //     if (event.keyCode == 123) {
        //         return false;
        //     }
        //     if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
        //         return false;
        //     }
        //     if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
        //         return false;
        //     }
        //     if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
        //         return false;
        //     }
        //     if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
        //         return false;
        //     }
        // }
        function image_preview(selector) {
            var src = $(selector).attr('src');
            if (src) {
                if (src.split('.').pop() == 'pdf') {
                    $('.my_modal_html').html('<embed src="' + src + '"  frameborder="0" width="100%"  allowfullscreen> ');
                } else {
                    $('.my_modal_html').html('<img class="img-fluid img-thumbnail" src="' + src + '"> ')
                }
                $('#my_modal').modal('show');
            }
        }
    </script>
    @yield('script')
</body>

</html>
