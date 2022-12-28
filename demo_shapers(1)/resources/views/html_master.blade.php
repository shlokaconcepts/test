<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ getImage($setting->site_favicon) }}" type="image/png" />
    <meta name="description" content="{{ $setting->meta_description }}">
    <meta name="keywords" content="{{ $setting->meta_keyword }}">
    <meta name="author" content="{{ $setting->meta_title }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('public/assets/js/lottie.js') }}"></script>

    <title>{{ $title ?? '' }}</title>
    @yield('style')
</head>

<body>

    <div class="loader-wrapper h-100 d-flex align-items-center justify-content-center d-none">
        <lottie-player src="{{ asset('public/assets/json/loader.json') }}" background="transparent" speed="1"
            style="width: 300px; height: 300px;" loop autoplay></lottie-player>
        <h3 class="success_message">Submitting the exam .Please wait</h3>
    </div>

    @yield('wrapper')
    <footer class="bg-light pb-1 text-center border-top mt-1 fixed-bottom ">
        <div class="row mt-4 mb-3 m-0">
            <div class="col-md-4 col-12 ">
                <img src="{{ getImage($setting->logo) }}" class="w-50">
            </div>
            <div class="col-md-4 col-12 text-start">
                <p>
                    {{ $setting->address }}
                </p>
            </div>
        </div>
    </footer>
    <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/pace.min.js') }}"></script>
    @yield('script')
</body>

</html>
