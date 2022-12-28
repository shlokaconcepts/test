<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon"href="{{ getImage($setting->site_favicon) }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/icons.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>
		Shapers –  Innovative HR Solutions
	</title>
</head>

<body>

    <div class="wrapper">
        <nav id="navbar_top" class="navbar m-0 p-0 navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img class="nav-logo pt-2 pb-2" src="{{getImage($setting->logo)}}"
                        height="50">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse  justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0 ">
        
                        
        
                        @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                              {{auth()->user()->first_name.' '.auth()->user()->last_name}}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{route('candidate-status')}}">Dashboard</a>
                                </li>
        
                                <li>
                                    <a class="dropdown-item"  href="{{ route('user_logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                       <span>Logout</span>
                                        <form id="logout-form" action="{{ route('user_logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </a>
                                </li>
        
                            </ul>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('login')}}">Candidate Login</a>
                        </li>
                        @endif
                        
        
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
        

        <div class="container-fluid">
            <div class="row d-flex align-items-center justify-content-center ">
                <div class="col-md-8">
                    <div class=" card mt-4 mb-5 p-5 border h-100 w-100">
                        <div class="card-body" style="    display: flex;
                        justify-content: center;
                        align-items: baseline;
                        text-align: center;">
                            <div>
                                <img src="{{getImage($setting->logo)}}"  class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <footer class="  bg-light pt-3 pb-1 text-center border-top ">
            <div class="row mt-4 mb-3 m-0">
                <div class="col-md-4 col-12 ">
                    <img src="{{ getImage($setting->logo) }}" class="w-50">
                </div>
                <div class="col-md-4 col-12 text-start">
                    <p>Office no 812, 8th floor,<br>Vipul Business park, sector 48,<br>sohna road, Gurgaon,<br>Haryana -
                        122018</p>
                </div>
            </div>
        </footer>
    </div>



    <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    @yield('script')
</body>

</html>
