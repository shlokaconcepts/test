<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{getImage($setting->site_favicon)}}" type="image/png" />
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <title>{{($title)?$title:''}}</title>
    <style>
        .message-row p,li{
            text-align: justify
        }
    </style>
</head>

<body>

    <nav id="navbar_top" class="navbar m-0 p-0 navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img class="nav-logo pt-2 pb-2" src="{{getImage($setting->logo)}}"
                    height="50">
            </a>
        </div>
    </nav>

  @yield('wrapper')

    <footer class="  bg-light pt-3 pb-3 text-center border-top ">

        <div class="row mt-4 mb-3 m-0">
            <div class="col-md-4 col-12 ">
                <img src="{{getImage($setting->logo)}}" class="w-50">
            </div>
            <div class="col-md-4 col-12 text-start">
               {{$setting->address}}
            </div>
        </div>
    </footer>
</body>

</html>
