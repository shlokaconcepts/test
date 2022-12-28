@extends('html_master')
@section('style')
    <style>
        .btn-circle {
            width: 28px;
            height: 28px;
            line-height: 28px;
            text-align: center;
            font-size: 13px;
            padding: 0;
            border-radius: 18%;

        }

        nav {
            padding: 6px 0px !important;
        }

        .heading {
            font-size: 18px;
            border-bottom: 2.5px solid !important;
            line-height: 51px;
            font-weight: 600;
        }

        .side-questions-wrapper {
            background: #bef4ff99 !important;
        }

        .count-btn {
            margin: 5px 8px;
            border-radius: 0px;
            width: 34px;
            height: 34px;
            line-height: 32px;
            text-align: center;
            font-size: 13px;
            padding: 0;
        }

        .sample-btn {
            border-radius: 5px;
            width: 34px;
            height: 34px;
            line-height: 32px;
            text-align: center;
            font-size: 13px;
            padding: 0;
        }

        .sample-skipped-btn-wrapper {
            margin-left: 4px;
        }

        .finish_exam_btn {
            width: 84%;
        }

        .question-number {
            background-color: #f91313cc;
            border-color: transparent;
            border-radius: 0px;
            color: whitesmoke;
            min-width: 42px;
            height: 42px;
            line-height: 42px;
            text-align: center;
            font-size: 14px;
            padding: 0;
        }

        .question-number:hover {
            color: whitesmoke;
        }

        .question-answer {
            background-color: #2fde6fcc;
            border-color: transparent;
            border-radius: 0px;
            color: whitesmoke;
            width: 42px;
            height: 42px;
            line-height: 42px;
            text-align: center;
            font-size: 14px;
            padding: 0;
        }

        .question-answer:hover {
            color: whitesmoke;
        }

        .nexttab {
            border-radius: 0px;
            min-width: 126px;
        }

        .prevtab {
            border-radius: 0px;
            min-width: 126px;
        }

        @media only screen and (max-width: 768px) {

            .checkbox-wrapper {
                margin-left: 27px;
            }

            .side-questions-wrapper {
                margin-top: 24px;
            }

            .prevtab_col {
                margin: 10px 0px;
            }

            .nexttab_col {
                margin: 10px 0px;
            }

            .navbar-nav li {
                text-align: inherit !important;
                border: none !important;
            }

            .navbar-nav small {
                margin-left: 11px;
            }

            .navbar-nav li .custome_pading {
                border-bottom: 1px solid #f4f4f4;
                margin-bottom: 10px;
                border-top: 1px solid #f4f4f4;
            }

            .start_time_end_time_wrapper {
                margin-left: 9px;

            }
        }

        .headeristrip {
            /* background: #3cca42; */
        }

        .border-white-dashed {
            color: #fff !important;
            border: 2px dashed !important;
            border-radius: 5px;
        }

        .btn-review {
            color: #fff !important;
            background-color: #673ab7;
            border-color: #3f51b5;
        }

        .btn-set {
            min-width: 40%;
            margin: 1%;
        }

        li.btn.btn-border.col-lg-2 {
            border: 1px solid lightgray;
            margin: 10px;
            cursor: pointer;
        }

        .hidden {
            display: none;
        }

        .qtn-active {
            border-color: green !important;
            border-width: 1.5px;
            border-radius: 3px;
        }

        .radio_btn {
            padding: 5px;
            border: 1px solid;
            width: 100%;
            cursor: pointer;
        }

        .btn-answered {
            background-color: #65ca7c;
            color: #008000e0;

        }

        .btn-reviewed {
            background-color: #673ab7;
        }

        .btn {
            cursor: pointer;
        }

        .modal-open .modal {
            background: #ffffffe3 !important;
        }

        .heading_border {
            border-top: 2.5px solid #32393F !important;
            margin-left: 10px;
            width: 98%;
        }

        .sample-btn-wrapper {
            padding: 10px 8px;
        }

        .custome_pading {
            padding: 0px 16px;
        }

        .loader-wrapper {
            position: fixed;
            z-index: 999999 !important;
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

        .success_message {
            position: absolute;
            top: 57%;
            margin-left: 40px;
        }

        .overflow-hidden {
            overflow: hidden;
        }

        #myTab2 {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endsection


@section('wrapper')
<nav id="navbar_top" class="navbar  navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img class="nav-logo" src="{{ getImage($setting->logo) }}" height="60">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse  justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav ">

                <li class="nav-item text-center border-start">
                    <div class=" custome_pading">
                        <p class=" mb-0">Answered Questions</p>
                        <button
                            class=" btn btn-outline-success btn-circle btn-circle-lg m-1 answered_questions">{{ $total_answered }}</button>
                    </div>
                </li>

                <li class="nav-item text-center border-start mx-1">
                    <div class="custome_pading">
                        <p class=" mb-0">Time Left</p>
                        <div class=" d-flex">
                            <div>
                                <button class=" btn btn-outline-danger btn-circle btn-circle-lg m-1 hours">0</button>
                                <small class=" d-block">H</small>
                            </div>
                            <div class=" mx-3">
                                <button class=" btn btn-outline-danger btn-circle btn-circle-lg m-1 minutes">0</button>
                                <small class=" d-block">M</small>
                            </div>
                            <div>
                                <button class=" btn btn-outline-danger btn-circle btn-circle-lg m-1 seconds">0</button>
                                <small class=" d-block">S</small>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item text-center border-start">
                    <div class="custome_pading start_time_end_time_wrapper">
                        <p class=" mb-0">Start Time</p>
                        <p><b class=" text-success">{{ date('h:i A', strtotime(Session::get('start_time'))) }}</b>
                        </p>
                    </div>
                </li>

                <li class="nav-item text-center border-start border-end">
                    <div class="custome_pading start_time_end_time_wrapper">
                        <p class=" mb-0">End Time</p>
                        <p><b class=" text-danger">{{ date('h:i A', strtotime(Session::get('end_time'))) }}</b></p>
                    </div>
                </li>
                <li class="nav-item text-center border-start border-end">
                    <div class="custome_pading start_time_end_time_wrapper">
                        <p class=" mb-0">Current Time</p>
                        <p><b class=" text-info current_time"></b></p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row ">
        <div class="col-md-8 col-12 main-wrapper">
            <ul class=" listing_questions_div list-unstyled">

                <div class=" mt-4">
                    <h4 class="  text-uppercase heading">{{(isset($category->name))?$category->name:'' }}</h4>
                </div>

                <form id="exam_form">

                    <input type="hidden" name="user_id" value="{{ $user_id }}">


                    @php
                        $lt = 1;
                    @endphp
                    @foreach ($questions as $question)
                        <li
                            class="question_line question_line_{{ $lt }} @if ($lt != 1) hidden @endif">
                            <div class="row">
                                <div class="col-lg-12 mb-2">
                                    <div>
                                        <h5>Section : {{ $question->getQuestion->getExamSetName->name }}</h5>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-2">
                                    <div class=" d-flex align-items-center align-content-center mt-3">
                                        <button class=" btn radius-0 question-number">
                                            Q{{ $lt }}
                                        </button>
                                        <span class=" mx-3">
                                            {{ $question->getQuestion->english_question }} ?
                                            {{ $question->getQuestion->hindi_question ? $question->getQuestion->hindi_question . '?' : '' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-3 row">
                                    <div class="col-md-11 col-6 p-0 checkbox-wrapper">
                                        <div class="form-check">
                                            <input class="form-check-input question_id_{{ $question->id }}"
                                                id="option_1_chk_{{ $lt }}"
                                                name="question_id[{{ $question->id }}]"
                                                question-no="{{ $lt }}" question-id="{{ $question->id }}"
                                                value="1"
                                                {{ $question->attempt == '1' && $question->user_option == 1 ? 'checked' : '' }}
                                                type="radio">
                                            <label class="form-check-label" for="option_1_chk_{{ $lt }}">
                                                A : {{ $question->getQuestion->english_option_one }} |
                                                {{ $question->getQuestion->hindi_option_one }}
                                            </label>
                                        </div>



                                        <div class="form-check">
                                            <input class="form-check-input question_id_{{ $question->id }}"
                                                id="option_2_chk_{{ $lt }}"
                                                name="question_id[{{ $question->id }}]"
                                                question-no="{{ $lt }}" question-id="{{ $question->id }}"
                                                value="2"
                                                {{ $question->attempt == '1' && $question->user_option == 2 ? 'checked' : '' }}
                                                type="radio">
                                            <label class="form-check-label" for="option_2_chk_{{ $lt }}">
                                                B : {{ $question->getQuestion->english_option_two }} |
                                                {{ $question->getQuestion->hindi_option_two }}
                                            </label>
                                        </div>



                                        <div class="form-check">
                                            <input class="form-check-input question_id_{{ $question->id }}"
                                                id="option_3_chk_{{ $lt }}"
                                                name="question_id[{{ $question->id }}]"
                                                question-no="{{ $lt }}" question-id="{{ $question->id }}"
                                                value="3"
                                                {{ $question->attempt == '1' && $question->user_option == 3 ? 'checked' : '' }}
                                                type="radio">
                                            <label class="form-check-label" for="option_3_chk_{{ $lt }}">
                                                C : {{ $question->getQuestion->english_option_three }} |
                                                {{ $question->getQuestion->hindi_option_three }}
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input question_id_{{ $question->id }}"
                                                id="option_4_chk_{{ $lt }}"
                                                name="question_id[{{ $question->id }}]"
                                                question-no="{{ $lt }}" question-id="{{ $question->id }}"
                                                value="4"
                                                {{ $question->attempt == '1' && $question->user_option == 4 ? 'checked' : '' }}
                                                type="radio">
                                            <label class="form-check-label" for="option_4_chk_{{ $lt }}">
                                                D : {{ $question->getQuestion->english_option_four }} |
                                                {{ $question->getQuestion->hindi_option_four }}
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="mt-2 heading_border">
                                    <div class="row mt-2 text-center">
                                        <div class="col-md-4 col-sm-12 col-12 prevtab_col  text-left">
                                            @if ($lt != 1)
                                                <div class="w-75 btn btn-primary" question-no="{{ $lt }}"
                                                    question-id="{{ $question->id }}"
                                                    onclick="prev_btn(this,'question_line_{{ $lt - 1 }}','{{ $lt - 1 }}')">
                                                    <i class=" fadeIn animated bx bx-skip-previous"></i>Previous
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-md-4 col-sm-12  col-12  nexttab_col">
                                            @if ($lt != count($questions))
                                                <div class="w-75 btn btn-primary  text-center"
                                                    question-no="{{ $lt }}"
                                                    question-id="{{ $question->id }}"
                                                    onclick="next_btn(this,'question_line_{{ $lt + 1 }}','{{ $lt + 1 }}')">
                                                    Next <i class=" fadeIn animated bx bx-skip-next"></i></div>
                                            @else
                                                {{-- <button type="submit" class="btn btn-success submit_btn" >Final Submit</button> --}}
                                            @endif
                                        </div>

                                        <div class="col-md-4 col-sm-12 col-12  text-right">
                                            <button class=" btn btn-success w-75 finish_exam_btn submit_btn">Submit
                                                Exam</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </li>
                        <input type="hidden" id="review_qtn_id_{{ $question->id }}"
                            name="review[{{ $question->id }}]" value="0">
                        @php
                            $lt++;
                        @endphp
                    @endforeach
                    <input type="hidden" id="time_executed" name="time_executed" value="1">
                </form>
            </ul>
        </div>
        <div class="col-md-4 col-12 side-questions-wrapper bg-info">
            <div class="  mt-4">
                <h4 class="text-uppercase heading">Questions</h4>
            </div>
            <ul class="nav nav-tabs mt-3 border-0" id="myTab2">
                @php
                    $qt = 1;
                @endphp
                @foreach ($questions as $question)
                    <button
                        class="btn  shadow @if ($qt == 1) qtn-active @endif  @if ($question->mark_review == 'mark_review') btn-warning  @elseif($question->mark_review == 'review') btn-reviewed  @elseif($question->attempt == '1')  btn-answered @else btn-light @endif qtn_btn  count-btn"
                        id="qtn_btn_{{ $qt }}" type="button"
                        onclick="view_by_btn('question_line_{{ $qt }}',this)">{{ $qt }}</button>
                    @php
                        $qt++;
                    @endphp
                @endforeach
            </ul>

            <div class="row mt-4  mb-3 d-flex sample-btn-wrapper">
                <div class="col-md-6 col-12 "
                    style="display: flex;
                    justify-content: center;
                    align-items: center;">
                    <button class=" btn btn-light sample-btn"></button>
                    <span class=" mx-2">Not Answered</span>
                </div>

                <div class="col-md-6 col-12"
                    style="display: flex;
                    justify-content: center;
                    align-items: center;">
                    <button class=" btn btn-success sample-btn"></button>
                    <span class=" mx-2">Answered</span>
                </div>
            </div>

        </div>
    </div>
</div>



<input type="hidden" id="exam_duration" value="{{ $exam->duration . ':00' }}">
<input type="hidden" id="total_duration" value="{{ $exam->duration . ':00' }}">


<input type="hidden" id="start_time" value="{{(Session::get('start_time'))?date('h:i A',strtotime(Session::get('start_time'))):'' }}">
<input type="hidden" id="end_time" value="{{(Session::get('end_time'))?date('h:i A',strtotime(Session::get('end_time'))):''}}">
@endsection
@section('script')
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        countdownTimer();

        $(".submit_btn").on("click", function(e) {
            e.preventDefault();
            var postData = new FormData(document.getElementById("exam_form"));
            $.ajax({
                type: "POST",
                async: true,
                contentType: false,
                dataType: "json",
                data: postData,
                processData: false,
                url: "{{ route('submit_exam') }}",
                beforeSend: function() {
                    $('body').addClass("overflow-hidden");
                    $(".loader-wrapper").removeClass("d-none");
                },
                complete: function() {
                    $('body').removeClass("overflow-hidden");
                    $(".loader-wrapper").addClass("d-none");
                },
                success: function(response) {
                    if (response.status == true) {
                        window.location.href = "{{ route('assessment-submitted') }}";
                    }
                }
            });
        });

    });

    // Countdown Timer
    function countdownTimer() {
        var timer2 = $('#exam_duration').val();
        intervals = setInterval(function() {
            var timer = timer2.split(':');
            var hours = parseInt(timer[0], 10);
            var minutes = parseInt(timer[1], 10);
            var seconds = parseInt(timer[2], 10);

            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            hours = (minutes < 0) ? --hours : hours;


            if (hours < 0 && minutes < 0 && seconds < 0) {
                clearInterval(intervals);
                clearInterval(storeTime);
                $('.submit_btn').click();
            } else {
                seconds = (seconds < 0) ? 59 : seconds;
                minutes = (minutes < 0) ? 59 : minutes;
                timer2 = hours + ':' + minutes + ':' + seconds;
                seconds = (seconds < 10) ? '0' + seconds : seconds;
                minutes = (minutes < 10) ? '0' + minutes : minutes;
                $('.minutes').html(minutes);
                $('.seconds').html(seconds);
                $('.hours').html(hours);
                var total_duration = hours + ':' + minutes + ':' + seconds;
                $('#total_duration').val(total_duration);
                $('.answered_questions').html($('#myTab2 .btn-answered').length);

                let start_time = $('#start_time').val();
                let end_time = $('#end_time').val();
                let current_time = "{{ date('g:i A', strtotime(now())) }}";
                if (current_time >= end_time) {
                    $('.submit_btn').click();
                }
                const now = new Date();
                const withPmAm = now.toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                });
                $('.current_time').html(withPmAm);
            }

        }, 1000);

    }

    // View By Btn
    function view_by_btn(question_li, current_btn) {
        $('.qtn_btn').removeClass('qtn-active');
        $(current_btn).addClass('qtn-active');
        $('.question_line').addClass('hidden');
        $('.' + question_li).removeClass('hidden');
    }
    // End View By Btn

    $("input[type=radio]").on("change", function() {
        var current_question_no = $(this).attr('question-no');
        var current_question_id = $(this).attr('question-id');
        $.ajax({
            type: 'POST',
            async: true,  
            cache: false, 
            url: "{{ route('submit-question-answer') }}",
            data: {
                id: current_question_id,
                option: $(this).val(),
                user_id: "{{ $user_id }}",
            },
            datatype: 'json',
            success: function(response) {
                $('#qtn_btn_' + current_question_no).removeClass('btn-reviewed');
                $('#qtn_btn_' + current_question_no).removeClass('btn-warning');
                $('#qtn_btn_' + current_question_no).addClass('btn-answered');
            }
        });
    });



    function next_btn(selector, question_li, next_qtn_no) {
        $('.qtn_btn').removeClass('qtn-active');
        $('#qtn_btn_' + next_qtn_no).addClass('qtn-active');
        $('.question_line').addClass('hidden');
        $('.' + question_li).removeClass('hidden');
        var current_question_no = $(selector).attr('question-no');
        var current_question_id = $(selector).attr('question-id');

    }

    function prev_btn(selector, question_li, next_qtn_no) {
        $('.qtn_btn').removeClass('qtn-active');
        $('#qtn_btn_' + next_qtn_no).addClass('qtn-active');
        $('.question_line').addClass('hidden');
        $('.' + question_li).removeClass('hidden');
        var current_question_no = $(selector).attr('question-no');
        var current_question_id = $(selector).attr('question-id');


    }


    function mark_not_answer(selector) {
        var current_question_no = $(selector).attr('question-no');
        var current_question_id = $(selector).attr('question-id');
        $('#qtn_btn_' + current_question_no).removeClass('btn-answered');
        $('.question_id_' + current_question_id + ':checked').prop('checked', false);

    }


    var start_time = $('#start_time').val();
    var end_time = $('#end_time').val();
    var current_time = "{{ date('g:i A', strtotime(now())) }}";

    var storeTime = setInterval(function() {
        if (current_time >= end_time) {
            $('.submit_btn').click();
        }
    }, 30000);
</script>
@endsection
