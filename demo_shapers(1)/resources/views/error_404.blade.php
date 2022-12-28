@extends('html_master')
@section('style')
@endsection

@extends('nav_bar')
@section('wrapper')
    <div class="error-404 d-flex align-items-center justify-content-center mt-4">
        <div class="container">
            <div class="card py-5">
                <div class="row g-0">
                    <div class="col col-xl-5">
                        <div class="card-body p-4">
                            <h1 class="display-1"><span class="text-primary">4</span><span class="text-danger">0</span><span
                                    class="text-success">4</span></h1>
                            <h2 class="font-weight-bold display-4">Error: Message</h2>
                            <p>
                                {{ isset($error) ? $error : 'Something went wrong!' }}
                            </p>
                            <div class="mt-5"> <a href="{{ url('/') }}"
                                    class="btn btn-primary btn-lg px-md-5 radius-30">Go
                                    Home</a>
                                <a href="{{ URL::previous() }}"
                                    class="btn btn-outline-dark btn-lg ms-3 px-md-5 radius-30">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <img src="{{ asset('public/assets/images/errors-images/404.png') }}" class="img-fluid"
                            alt="">
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
