<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ getImage($setting->site_favicon) }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('public/assets/js/lottie.js') }}"></script>
    <title>Successfully Submited</title>
    <style>
        @media only screen and (max-width: 768px) {
            .message-row {
                text-align: -webkit-center !important;
            }
        }

        .c-message {
            color: #3526A5;
        }
    </style>
</head>

<body>

    <nav id="navbar_top" class="navbar m-0 p-0 navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container">
            <a class="navbar-brand" href="#">

                <img class="nav-logo pt-2 pb-2" src="{{ getImage($setting->logo) }}" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse  justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 ">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('login') }}">Candidate Login</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Contact Us
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="tel: +911244034795">Call +911244034795</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row  message-row justify-content-center">
            <div class="col-md-3">
                <lottie-player src="{{ asset('public/assets/json/confirm-one.json') }}" background="transparent"
                    speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
            </div>
        </div>
        <div class="row message-row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-none">
                    <div class="card-body">
                        <h2 class=" text-center c-message">Congratulations!</h2>
                        <p class=" text-center">Your job application has been successfully received. Your registration
                            ID is <strong>
                                @if (Session::has('unique_id'))
                                    {{ Session::get('unique_id') }}
                                @endif
                            </strong>. <br> You will also receive the registration details on your email</p>
                    </div>
                </div>
            </div>
        </div>



    </div>


    <footer class="  bg-light pt-3 pb-3 text-center border-top ">
        
        <div class="row mt-4 mb-3 m-0">
            <div class="col-md-4 col-12 ">
                <img src="{{ getImage($setting->logo) }}" class="w-50">
            </div>
            <div class="col-md-4 col-12 text-start">
                {{ $setting->address }}
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/pace.min.js') }}"></script>




</body>

</html>
