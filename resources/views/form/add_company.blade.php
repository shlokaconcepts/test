@extends('layouts.admin_app')

@section('style')
    <link href="{{ asset('public/assets/plugins/datetimepicker/css/classic.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/datetimepicker/css/classic.time.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/datetimepicker/css/classic.date.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        .num-block {
            float: left;
            width: 100%;
            padding: 8px 0px;
            cursor: pointer;
        }

        /* skin 2 */
        .skin-2 .num-in {
            background: #FFFFFF;
            box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.15);
            float: left;
        }

        .skin-2 .num-in span {
            width: 32%;
            display: block;
            height: 40px;
            float: left;
            position: relative;
        }

        .skin-2 .num-in span:before,
        .skin-2 .num-in span:after {
            content: '';
            position: absolute;
            background-color: whitesmoke;
            height: 2px;
            width: 10px;
            top: 50%;
            left: 50%;
            margin-top: -1px;
            margin-left: -5px;
        }

        .skin-2 .num-in span.plus:after {
            transform: rotate(90deg);
        }

        .skin-2 .num-in input {
            float: left;
            width: 35%;
            height: 40px;
            border: none;
            text-align: center;
        }

        .minus {
            background: #362998;
        }

        .plus {
            background: #362998;
            margin-left: 1px;
        }

        .select_q_p {
            background: #362998;
        }
    </style>
@endsection


@section('wrapper')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Company List</li>
                            <li class="breadcrumb-item active" aria-current="page">Add Company</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('admin.company-list') }}" class="btn btn-primary btn-sm add_exam">
                        <i class="fadeIn animated bx bx-arrow-back" aria-hidden="true"></i>Back
                    </a>
                </div>
            </div>
            <!--end breadcrumb-->


            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <form class="row " id="addExamForm" enctype="multipart/form-data">
                                    <div class="col-md-4">
                                        <label for="name" class="form-label mb-0"><strong>Name<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="text" id="name" class="form-control" name="name"
                                            placeholder="Full compnay name.." />
                                    </div>

                                    <div class="col-md-4">
                                        <label for="phone" class="form-label mb-0"><strong>Contact.<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="number" id="phone" class="form-control" name="phone"
                                            placeholder="Contact.." />
                                    </div>

                                    <div class="col-md-4">
                                        <label for="logo" class="form-label mb-0"><strong>Logo.<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="file" id="logo" class="form-control" name="logo" />
                                    </div>


                                    <div class="col-md-4 mt-2">
                                        <label for="company_prefix" class="form-label mb-0"><strong>Company Prefix<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="text" id="company_prefix" placeholder="Short company prefix"
                                            class="form-control" name="company_prefix" />
                                    </div>



                                    <div class="col-md-4 mt-2">
                                        <label for="reg_prefix" class="form-label mb-0"><strong>Reg. Prefix<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="text" id="reg_prefix" placeholder="Registration prefix"
                                            class="form-control" name="reg_prefix" />
                                    </div>



                                    <div class="col-md-4 col-12 mt-2">
                                        <label for="state" class="form-label mb-0"><strong>Category<span
                                                    class="text-danger">*</span></strong></label>
                                        <select class="single-select select2" name="category" id="category">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>




                                    <div class="col-md-12 mt-3">
                                        <label for="address" class="form-label mb-0"><strong>Address<span
                                                    class="text-danger">*</span></strong></label>
                                        <textarea class="form-control" name="address" id="address"></textarea>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label for="description" class="form-label mb-0"><strong>Description<span
                                                    class="text-danger">*</span></strong></label>
                                        <textarea class="form-control" name="description" id="description"></textarea>
                                    </div>


                                    <div class="col-12 mt-3">
                                        <div class="select_q_p text-white d-flex  justify-content-between align-items-center"
                                            style="padding: 5px 6px;">
                                            <strong>Candidate Registration Category</strong>
                                            <button type="button" name="add" id="add"
                                                class="btn btn-primary add-more-btn btn-sm" style="padding: 2px 6px;"><i
                                                    class="fadeIn animated bx bx-plus"></i></button>
                                        </div>
                                    </div>

                                    <section id="dynamic_field">

                                    </section>




                                    <div class="modal-footer mt-3">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/legacy.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/picker.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/picker.time.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datetimepicker/js/picker.date.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


    <script>
        $(function() {
            $('.single-select').each(function() {
                $(this).select2({
                    dropdownParent: $(this).parent(),
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass(
                        'w-100') ? '100%' : 'style',
                    placeholder: $(this).attr('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            })


            $(".datepicker").pickadate({
                selectMonths: true,
                selectYears: true,
                format: 'dd-mm-yyyy',
            });

            $('.timepicker').pickatime();

            $('#address').summernote({
                placeholder: 'Compnany address...',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                focus: true
            });

            $('#description').summernote({
                placeholder: 'Compnay description...',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                focus: true
            });



            $('.note-image-input').remove();
            $('#addExamForm').on('submit', function(e) {
                e.preventDefault();
                var postData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.edit-exam') }}",
                    data: postData,
                    async: true,
                    contentType: false,
                    processData: false,
                    datatype: 'json',
                    beforeSend: function() {
                        $('button[type="submit"]').prop("disabled", true);
                        $('button[type="submit"]').html(
                            `<span class="fadeIn animated bx bx-loader-circle bx-spin"></span>`
                        );
                    },

                    complete: function() {
                        $('button[type="submit"]').prop("disabled", false);
                        $('button[type="submit"]').html(`Save`);
                    },
                    success: function(response) {
                        if (response.status == true) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                text: response.msg,
                                title: 'Success',
                                showConfirmButton: true,
                            });
                        } else if (response.status == false) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Error',
                                text: response.msg,
                                showConfirmButton: true,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Error',
                            text: "Something went wrong..",
                            showConfirmButton: true,
                        })
                    }

                });
            });


        });

        function resetForm() {
            document.getElementById('addExamForm').reset();
            $('#op_type').val('add');
            $('button[type="submit"]').html(`Submit`);
            $('.select2').val('').change();
            $('.img-box').addClass('d-none');
        }





        $(document).ready(function() {
            var i = 0;
            $('#add').click(function() {
                i++;
                var html = `
            <div class="row mt-4" id="row${i}">

                
                        <div class="col-md-12 col-12 exam-count">
                            <p class="text-success mb-0">Category ${i}</p>
                        </div>

                        <div class="col-md-4 mt-1">
                            <label for="cat_name" class="form-label mb-0"><strong>Category Name<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="cat_name" class="form-control" name="cat_name[]" placeholder="ex: Temporary Worker" required/>
                        </div>

                        <div class="col-md-4 mt-1">
                            <label for="cat_prefix" class="form-label mb-0"><strong>Category Prefix<span
                                        class="text-danger">*</span></strong></label>
                            <input type="text" id="cat_prefix" class="form-control" name="cat_prefix[]" placeholder="ex: TW" required/>
                        </div>

                        <div class="col-md-2 col-12">
                            <button type="button" name="add" class="btn btn-danger btn_remove add-more-btn btn-sm" style="margin-top: 29px;" id="${i}"><i class="fadeIn animated bx bx-minus"></i></button>
                        </div>
                      </div>`;

                $('#dynamic_field').append(html);

                $('.select').each(function() {
                    $(this).select2({
                        dropdownParent: $(this).parent(),
                        theme: 'bootstrap4',
                        width: $(this).data('width') ? $(this).data('width') : $(this)
                            .hasClass(
                                'w-100') ? '100%' : 'style',
                        placeholder: $(this).data('placeholder'),
                        allowClear: Boolean($(this).data('allow-clear')),
                    });
                });
            });
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

        });
    </script>
@endsection
