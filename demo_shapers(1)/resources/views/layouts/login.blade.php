<!doctype html>
<html lang="en">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
        <meta name="description" content="{{ $setting->meta_description }}">
        <meta name="keywords" content="{{ $setting->meta_keyword }}">
        <meta name="author" content="{{ $setting->meta_title }}">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--favicon-->
        <link rel="icon"href="{{ getImage($setting->favicon) }}" type="image/png"/>
		<link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{asset('public/assets/css/app.css')}}" rel="stylesheet">
		<link href="{{asset('public/assets/css/icons.css')}}" rel="stylesheet">
		<title>Admin Panel</title>
	</head>

<body class="bg-login">
	<!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            <img src="{{asset('public/assets/images/avatars/user-icon.png')}}" width="200" alt="" />
                        </div>
                        <div class="card">
                            @if(session()->has('error'))
                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                                <div class="d-flex align-items-center">
                                    <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                                    </div>
                                    <div class="ms-3">
                                        <div class="text-white">{{ session()->get('error') }}!</div>
                                    </div>
                                </div>
                                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session()->has('success'))
                            <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                                <div class="d-flex align-items-center">
                                    <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                                    </div>
                                    <div class="ms-3">
                                        <div class="text-white">{{ session()->get('success') }}</div>
                                    </div>
                                </div>
                                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif


                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h4 class="">Welcome to Shapers</h4>
                                        <h4 class="">Login</h4>
                                    </div>

                                    <div class="form-body">
                                        <form class="row g-3" action="{{route('admin_login')}}" method="post" autocomplete="off">
                                            @csrf
                                            <div class="col-12">
                                                <label for="Username_email" class="form-label">Username/Email</label>
                                                <input type="text" autocomplete="off" class="form-control @error('Username_email') is-invalid @enderror" name="Username_email" id="Username_email" value="{{old('Username_email')}}"  placeholder="Username / Email Address">
                                                @error('Username_email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" autocomplete="off" name="password" class="form-control border-end-0 @error('password') is-invalid @enderror" id="inputChoosePassword" value="{{old('password')}}" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
	<!--end wrapper-->

	<!--plugins-->
	<script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/assets/js/bootstrap.bundle.min.js')}}"></script>


    <script>
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
</body>

</html>
