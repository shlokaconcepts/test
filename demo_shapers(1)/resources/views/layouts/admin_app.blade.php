<!doctype html>
<html lang="en" class="{{ $setting->theme_color }} {{ $setting->side_bar }}">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="icon" href="{{ getImage($setting->favicon) }}" type="image/png" />
    <!--plugins-->

    <link href="{{ asset('public/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/assets/plugins/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/select2/css/select2-bootstrap4.css') }}" />

    <link href="{{ asset('public/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />



    <link href="{{ asset('public/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/icons.css') }}" rel="stylesheet">

    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/css/header-colors.css') }}" />
    <script src="{{ asset('public/assets/js/lottie.js') }}"></script>
    @yield('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ isset($title) ? $title : 'title' }}</title>

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

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .dataTables_processing {
            background-color: #045de9 !important;
            background-image: linear-gradient(315deg, #045de9 0%, #09c6f9 74%) !important;
            color: white !important;
            z-index: 99;
            box-shadow: -1px 0px 19px -5px rgba(0, 0, 0, 0.75) !important;
            border: 1px solid #045de9 !important;
        }

        .dataTables_scrollBody::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 1px rgba(0, 0, 0, 0.5);
            border-radius: 5px;
            background-color: #F5F5F5 !important;
        }

        .dataTables_scrollBody::-webkit-scrollbar {
            width: 5px !important;
            height: 5px !important;
            background-color: #F5F5F5 !important;
        }

        .dataTables_scrollBody::-webkit-scrollbar-thumb {
            border-radius: 5px !important;
            -webkit-box-shadow: inset 0 0 1px rgba(0, 0, 0, .3) !important;
            background-color: #63a4ff !important;
            background-image: linear-gradient(315deg, #63a4ff 0%, #83eaf1 74%) !important;
        }

        .table-responsive {
            position: relative;
        }

        .dataTables_wrapper .row:first-child {
            margin-bottom: -3px !important;
        }

        .mr-2 {
            margin-right: 10px;
        }

        .dt_searching_wrapper {
            display: flex;
            justify-content: end;
            align-items: end;
        }
    </style>
    @yield('style')
</head>

<body>
    <div class="loader-wrapper h-100 d-flex align-items-center justify-content-center d-none">
        <lottie-player src="{{ asset('public/assets/json/loader.json') }}" background="transparent" speed="1"
            style="width: 300px; height: 300px;" loop autoplay></lottie-player>
        <h3 class="success_message">Under Processing..</h3>
    </div>

    <!--wrapper-->
    <div class="wrapper">
        <!--start header -->
        @include('layouts.admin_header')
        <!--end header -->
        <!--navigation-->
        @include('layouts.admin_nav')
        <!--end navigation-->
        <!--start page wrapper -->
        @yield('wrapper')
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

        <!--Preview File Modal-->
        <div class="modal fade" id="my_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                        <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
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
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2022. All right reserved.</p>
        </footer>
    </div>



    <!-- Bootstrap JS -->
    <script src="{{ secure_asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ secure_asset('public/assets/js/jquery.min.js') }}"></script>
    <script src="{{ secure_asset('public/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ secure_asset('public/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ secure_asset('public/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>

    <!--app JS-->
    <script src="{{ secure_asset('public/assets/js/app.js') }}"></script>
    <script src="{{ secure_asset('public/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ secure_asset('public/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ secure_asset('public/assets/js/btn-server-side.js') }}"></script>
    <script src="{{ secure_asset('public/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ secure_asset('public/assets/js/sweetalert.js') }}"></script>
    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @yield('script')
    <script>
        $(document).ready(function() {
            $('.dataTable ').each(function() {
                var datatable = $(this);
                var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                search_input.attr('placeholder', 'Search');
                search_input.removeClass('form-control-sm');
                var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                length_sel.removeClass('form-control-sm');
            });

            $('.single-select').each(function() {
                $(this).select2({
                    dropdownParent: $(this).parent(),
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass(
                        'w-100') ? '100%' : 'style',
                    placeholder: $(this).attr('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            });

            $('.select2').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
        });

        function getCategory() {
            var id = $('#company_id').val();
            $("#form_category").html('<option value="">Select Category</option>');
            $("#iti_trade").html('<option value="">Select Trade</option>');
            if (id != '') {
                $("#form_category").html('<option value="">Fetching Category...</option>');
                $("#iti_trade").html('<option value="">Fetching Trade...</option>');
                $.ajax({
                    url: "{{ url('admin/get_rg_category') }}/" + id,
                    type: "GET",
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        $('#form_category').html(
                            '<option value="">Select Category</option>');
                        $.each(res.data, function(key, value) {
                            $("#form_category").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });


                        $('#iti_trade').html('<option value="">Select Trade</option>');
                        $.each(res.trade, function(key, value) {
                            $("#iti_trade").append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                    }
                });
            }
        }

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
</body>

</html>
