@extends('layouts.admin_app')
@section('style')
    <style>
        .sidebarcolor1 {
            background-image: url("{{ asset('public/assets/images/bg-themes/1.png') }}");
        }

        .sidebarcolor2 {
            background-image: url("{{ asset('public/assets/images/bg-themes/2.png') }}");
        }

        .sidebarcolor3 {
            background-image: url("{{ asset('public/assets/images/bg-themes/3.png') }}");
        }

        .sidebarcolor4 {
            background-image: url("{{ asset('public/assets/images/bg-themes/4.png') }}");
        }

        .sidebarcolor5 {
            background-image: url("{{ asset('public/assets/images/bg-themes/5.png') }}");
        }

        .sidebarcolor6 {
            background-image: url("{{ asset('public/assets/images/bg-themes/6.png') }}");
        }

        .sidebarcolor7 {
            background-image: url("{{ asset('public/assets/images/bg-themes/7.png') }}");
        }

        .sidebarcolor8 {
            background-image: url("{{ asset('public/assets/images/bg-themes/8.png') }}");
        }
        .active-indigateor{
            border: 2px solid #96f596;
        }
        label{
            font-weight: 500;
        }
    </style>
@endsection
@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Site Setting </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <form class="row g-3" id="edit_setting" action="javascript:void(0);" enctype="multipart/form-data">
                                <input type="hidden" value="{{ $data->id }}" name="id">

                                <div class="col-md-6">
                                    <label for="site_title" class="form-label">Site Title</label>
                                    <input type="text" class="form-control @error('site_title') is-invalid @enderror"
                                        name="site_title" value="{{ $data->site_title }}" id="site_title"
                                        placeholder=" Site Title" />
                                    @error('site_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                <div class="col-md-6">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                        name="meta_title" value="{{ $data->meta_title }}" id="meta_title"
                                        placeholder="Meta Title" />
                                    @error('meta_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="meta_keyword" class="form-label">Meta Keyword</label>
                                    <input type="text" class="form-control @error('meta_keyword') is-invalid @enderror"
                                        name="meta_keyword" value="{{ $data->meta_keyword }}" id="meta_keyword"
                                        placeholder="Meta Keyword" />
                                    @error('meta_keyword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-md-6">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <input type="text"
                                        class="form-control @error('meta_description') is-invalid @enderror"
                                        name="meta_description" value="{{ $data->meta_description }}" id="meta_description"
                                        placeholder="Meta Description" />
                                    @error('meta_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                <div class="col-md-6">
                                    <label for="site_favicon" class="form-label">Site Favicon</label>
                                    <input type="file" class="form-control @error('site_favicon') is-invalid @enderror"
                                        name="site_favicon" id="site_favicon" placeholder="site_favicon" />
                                    @error('site_favicon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="logo" class="form-label">Site Logo</label>
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                        name="logo" id="logo" placeholder="Logo" />
                                    @error('logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ $data->phone }}" id="phone"
                                        placeholder="Phone Number" />
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $data->email }}" id="email"
                                        placeholder="Email" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-md-6">
                                    <label for="address" class="form-label">Company Address</label>
                                    <input type="text"
                                        class="form-control @error('address') is-invalid @enderror"
                                        name="address" value="{{ $data->address }}" id="address"
                                        placeholder="Company Address" />
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-md-6">
                                    <label for="copy_right" class="form-label">Copy Right</label>
                                    <input type="text" class="form-control @error('copy_right') is-invalid @enderror"
                                        name="copy_right" value="{{ $data->copy_right }}" id="copy_right"
                                        placeholder="Copy Right" />
                                    @error('copy_right')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="">

                                    <hr />
                                    <h6 class="mb-0">Theme Styles</h6>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-3 col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="theme_color"
                                                    {{ $data->theme_color == 'light-theme' ? 'checked' : '' }} value="light-theme"
                                                    id="lightmode">
                                                <label class="form-check-label" for="lightmode">Light</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="theme_color"
                                                {{ $data->theme_color == 'dark-theme' ? 'checked' : '' }} value="dark-theme"
                                                id="darkmode">
                                            <label class="form-check-label" for="darkmode">Dark</label>
                                        </div>
                                        </div>
                                        <div class="col-md-3 col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="theme_color"
                                                {{ $data->theme_color == 'semi-dark' ? 'checked' : '' }} value="semi-dark"
                                                id="semidark">
                                            <label class="form-check-label" for="semidark">Semi Dark</label>
                                        </div>
                                        </div>
                                        <div class="col-md-3 col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="theme_color"
                                                value="minimal-theme"
                                                {{ $data->theme_color == 'minimal-theme' ? 'checked' : '' }}
                                                id="minimaltheme">
                                            <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
                                        </div>
                                        </div>

                                    </div>
                                    <hr />

                                    {{-- <input type="hidden" name="side_bar" id="side_bar_color">

                                    <h6 class="mb-0">Sidebar Colors</h6>
                                    <hr />


                                    <div class="header-colors-indigators">
                                        <div class="row row-cols-auto g-3">
                                            <div class="col">
                                                <div class="indigator sidebarcolor1 {{($setting->side_bar=="color-sidebar sidebarcolor1")?"active-indigateor":""}}" data-value="color-sidebar sidebarcolor1" id="sidebarcolor1"></div>
                                            </div>
                                            <div class="col">
                                                <div class="indigator sidebarcolor2   {{($setting->side_bar=="color-sidebar sidebarcolor2")?"active-indigateor":""}} " data-value="color-sidebar sidebarcolor2" id="sidebarcolor2"></div>
                                            </div>
                                            <div class="col">
                                                <div class="indigator sidebarcolor3 {{($setting->side_bar=="color-sidebar sidebarcolor3")?"active-indigateor":""}}" data-value="color-sidebar sidebarcolor3" id="sidebarcolor3"></div>
                                            </div>
                                            <div class="col">
                                                <div class="indigator sidebarcolor4 {{($setting->side_bar=="color-sidebar sidebarcolor4")?"active-indigateor":""}}"  data-value="color-sidebar sidebarcolor4" id="sidebarcolor4"></div>
                                            </div>
                                            <div class="col">
                                                <div class="indigator sidebarcolor5 {{($setting->side_bar=="color-sidebar sidebarcolor5")?"active-indigateor":""}}" data-value="color-sidebar sidebarcolor5" id="sidebarcolor5"></div>
                                            </div>
                                            <div class="col">
                                                <div class="indigator sidebarcolor6 {{($setting->side_bar=="color-sidebar sidebarcolor6")?"active-indigateor":""}}" data-value="color-sidebar sidebarcolor6" id="sidebarcolor6"></div>
                                            </div>
                                            <div class="col">
                                                <div class="indigator sidebarcolor7 {{($setting->side_bar=="color-sidebar sidebarcolor7")?"active-indigateor":""}}" data-value="color-sidebar sidebarcolor7" id="sidebarcolor7"></div>
                                            </div>
                                            <div class="col">
                                                <div class="indigator sidebarcolor8 {{($setting->side_bar=="color-sidebar sidebarcolor8")?"active-indigateor":""}}" data-value="color-sidebar sidebarcolor8" id="sidebarcolor8"></div>
                                            </div>
                                            <div class="col d-none">
                                                <div class="indigator sidebarcolor9  "  data-value=" color-sidebar sidebarcolor9" id="sidebarcolor9"></div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    @if (in_array(
                                        14,
                                        auth()->user()->get_allowed_menus()['edit'],
                                    ))
                                        <div class="col-12 mt-4 text-center">
                                            <button type="submit" class="btn btn-success px-5">Update</button>
                                        </div>
                                    @endif
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>
        $(() => {

            $('.indigator').on('click', function() {
                $('#side_bar_color').val($(this).data('value'));
            });

            $('#edit_setting').on('submit', function(e) {
                e.preventDefault();
                var postData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.edit-site-setting') }}",
                    data: postData,
                    async: true,
                    contentType: false,
                    processData: false,
                    datatype: 'json',
                    beforeSend: function() {
                        $('button[type="submit"]').prop("disabled", true);
                        $('button[type="submit"]').html(`<span class="fadeIn animated bx bx-loader-circle bx-spin"></span>`);
                    },

                    complete: function() {
                        $('button[type="submit"]').prop("disabled", false);
                        $('button[type="submit"]').html(`Update`);
                    },


                    success: function (response) {
                    if (response.status == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title:"Success",
                            text: response.msg,
                            showConfirmButton: true,
                        }).then(() => {
                            location.reload();
                        });


                    } else if (response.status == false) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title:"Error",
                            text: response.msg,
                            showConfirmButton: true,
                        });
                    }

                },
                error: function () {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title:"Error",
                        text:"Something went wrong..",
                        showConfirmButton: true,
                    });
                }

                });
            });

        });
    </script>
@endsection
