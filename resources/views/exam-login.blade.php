@extends('html_master')
@section('style')
<style>
    footer{
        margin-top: 0px;
    }
</style>
@endsection
@section('wrapper')
@extends('nav_bar')
<div class="d-flex align-items-center justify-content-center  my-lg-0">
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
               
                <div class=" col mx-auto card mt-3">
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
                        <div class="border p-2 rounded">
                            <div class="form-body">
                                <form class="row g-3" action="{{route('post-candidate-exam-login')}}" method="post" autocomplete="off">
                                    @csrf
                                    <div class="col-12">
                                        <label for="phone" class="form-label">Aadhaar</label>
                                        <input type="number" class="form-control @error('aadhar_card') is-invalid @enderror" name="aadhar_card" id="aadhar_card" value="{{old('aadhar_card')}}"  required placeholder="Aadhar Number">
                                        @error('aadhar_card')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="password" class="form-label">Center Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" name="password" class="form-control border-end-0 @error('password') is-invalid @enderror" id="inputChoosePassword" value="{{old('password')}}" placeholder="To be entered by assessment team"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!--end row-->
    </div>
</div>
@endsection
@section('script')
<script>
    $(()=>{
      $('body').addClass('bg-login');
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
    });
</script>
@endsection