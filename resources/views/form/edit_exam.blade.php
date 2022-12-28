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
                            <li class="breadcrumb-item active" aria-current="page">Exam List</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Exam</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('admin.exam-list') }}" class="btn btn-primary btn-sm add_exam">
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
                                    <input type="hidden" name="id" id="id" value="{{$exam->id}}" />

                                    <div class="col-md-6 col-12">
                                        <label for="company" class="form-label mb-0"><strong>Company<span
                                                    class="text-danger">*</span></strong></label>
                                        <select class="form-select" name="company" id="company" disabled>
                                            @foreach (companies() as $company)
                                                <option @selected($company->id == $exam->company) value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
            
                                    <div class="col-md-6 col-12">
                                        <label for="state" class="form-label mb-0"><strong>Exam Category<span
                                                    class="text-danger">*</span></strong></label>
                                        <select class="single-select select2" name="category" id="category">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}" @selected($exam->category == $cat->id)>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-12 mt-2">
                                        <label for="exam_title" class="form-label mb-0"><strong>Exam Title<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="text" id="exam_title" value="{{ $exam->name }}"
                                            class="form-control" name="name" id="name" />
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <label for="exam_date" class="form-label mb-0"><strong>Exam Date<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="text" id="exam_date" class="form-control datepicker"
                                            value="{{ date('d-m-Y', strtotime($exam->date)) }}" name="date"
                                            id="date" />
                                    </div>

                                    @php
                                        $duration = explode(':', $exam->duration);
                                    @endphp

                                    <div class="col-md-3 mt-2">
                                        <label for="exam_date" class="form-label mb-0"><strong>Hours<span
                                                    class="text-danger">*</span></strong></label>
                                        <select class="single-select select2" name="hour" id="hour">
                                            <option value="">Select Hour</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ $duration[0] == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor

                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <label for="exam_date" class="form-label mb-0"><strong>Minute<span
                                                    class="text-danger">*</span></strong></label>
                                        <select class="single-select select2" name="minute" id="minute">
                                            <option value="">Select Minute</option>
                                            @for ($i = 0; $i <= 59; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $duration[1] == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor

                                        </select>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <label class="form-label mb-0"><strong>Exam Center<span
                                                    class="text-danger">*</span></strong></label>
                                        <input type="text" class="form-control" name="center" id="center"
                                            value="{{ $exam->center }}" />
                                    </div>

                                    <div class="col-md-12 col-12 mt-3">
                                        <label class="form-label mb-0"><strong>Exam Center Address<span
                                                    class="text-danger">*</span></strong></label>
                                        <textarea class="form-control" name="venue" id="venue">{!! $exam->venue !!}</textarea>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label class="form-label mb-0"><strong>Instruction<span
                                                    class="text-danger">*</span></strong></label>
                                        <textarea class="form-control" name="instruction" id="instruction">{!! $exam->instruction !!}</textarea>
                                    </div>



                                    <div class="col-md-6 mt-2">
                                        <label class="form-label mb-0"><strong>Total Questions<span
                                                    class="text-danger">*</span></strong></label>
                                        <div class="num-block skin-2">
                                            <div class="num-in">
                                                <span class="minus dis"></span>
                                                <input type="text" class="in-num border" name="total_question"
                                                    id="total_question" value="{{ $exam->total_question }}"
                                                    readonly="">
                                                <span class="plus"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <section class="container-fluid border px-2 ps-2">
                                        <div class="row">
                                            <div class="col-12 mt-3">
                                                <p class=" mb-0 select_q_p text-white p-2"> <strong>Select Question
                                                        Bank</strong></p>
                                            </div>

                                            @foreach ($exam_sets as $set)
                                                <div class="col-md-6 mt-3">
                                                    <label
                                                        class="form-label mb-0"><strong>{{ $set->name }}</strong></label>
                                                    <div class="num-block skin-2">
                                                        <div class="num-in">
                                                            <span class="minus dis"></span>
                                                            <input type="text" class=" second in-num border"
                                                                value="{{ get_no_of_exam_question($exam->id, $set->id) }}"
                                                                min="0" id="inputid_{{ $loop->iteration }}"
                                                                name="set_question[{{ $set->id }}]"
                                                                onchange="calculateSum(this,'{{ $set->id }}','{{ count($exam_sets) }}')"
                                                                readonly="">
                                                            <span class="plus"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </section>


                                    <div class="modal-footer mt-3">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Update</button>
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
           
            $(".datepicker").pickadate({
                selectMonths: true,
                selectYears: true,
                format: 'dd-mm-yyyy',
            });

            $('.timepicker').pickatime();

            $('#instruction').summernote({
                placeholder: 'Instruction...',
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

            $('#venue').summernote({
                placeholder: 'Address...',
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


            $('.num-in span').click(function() {
                var $input = $(this).parents('.num-block').find('input.in-num');
                if ($(this).hasClass('minus')) {
                    var count = parseFloat($input.val()) - 1;
                    count = count < 1 ? 1 : count;
                    if (count < 2) {
                        $(this).addClass('dis');
                    } else {
                        $(this).removeClass('dis');
                    }
                    $input.val(count);
                } else {
                    var count = parseFloat($input.val()) + 1
                    $input.val(count);
                    if (count > 1) {
                        $(this).parents('.num-block').find(('.minus')).removeClass('dis');
                    }
                }

                $input.change();
                return false;
            });
        });

        function calculateSum(selector, id, array_count) {
            var total_limit = $('#total_question').val();
            var current_value = $(selector).val();
            var total_sum = 0;
            for (let i = 1; i <= array_count; i++) {
                total_sum = parseInt($('#inputid_' + i).val()) + total_sum;
            }
            if (total_sum > total_limit) {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    text: "The number of questions cannot be more than " + total_limit,
                    title: "Warning",
                    showConfirmButton: true,
                }).then(() => {
                    $('#inputid_' + id).val($('#inputid_' + id).val() - 1);
                });
            }

        }
    </script>
@endsection
