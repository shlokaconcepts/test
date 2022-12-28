@extends("layouts.admin_app")
@section("style")
{{-- <link href="{{asset('public/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
<link href="{{asset('public/assets/plugins/highcharts/css/highcharts.css')}}" rel="stylesheet" /> --}}
<style>
    .accordion-collapse {
        position: absolute;
        top: 83%;
        z-index: 99999999999;
        background: antiquewhite;
        width: 90%;
        border-radius: 6px 6px 0px 0px;

    }
    .detail_wrapper{
        min-height: 155px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .detail_wrapper .card-body{
        display: flex;
        justify-content: center;
        align-items: center;
    }

</style>
@endsection

@section("wrapper")
<div class="page-wrapper d-none">
    <div class="page-content">
        @if(in_array(2,auth()->user()->get_allowed_menus()['view']))
        <div class="row row-cols-0 row-cols-md-3 row-cols-xl-5">
            <div class="col position-relative">
                <div class="card border radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center accordion" id="accordionExample">
                            <div class="accordion-item" id="headingOne">
                                <p class="mb-0 text-secondary">Total Registrations</p>
                                <h4 class="my-1 text-info">4805</h4>
                                <p class="mb-0 font-13" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    View More
                                </p>

                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                    class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="collapseOne" class="accordion-collapse collapse bg-primary bg-gradient"
                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-white">

                        <ul class=" list-group list-unstyled">
                            <li class=" d-flex  align-items-baseline justify-content-between">
                                <p> Temporary Worker</p>
                                <small>20</small>
                            </li>

                            <li class=" d-flex  align-items-baseline justify-content-between">

                                <p>  Contract worker</p>
                                <small>20</small>
                            </li>

                            <li class="  d-flex  align-items-baseline justify-content-between">

                                <p> Apprentice</p>
                                <small>20</small>
                            </li>

                            <li class="  d-flex  align-items-baseline justify-content-between">

                                <p> Full Time</p>
                                <small>20</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

           
            <div class="col position-relative">
                <div class="card border radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body">


                        <div class="d-flex align-items-center accordion" id="accordionExample">
                            <div class="accordion-item" id="headingThree">
                                <p class="mb-0 text-secondary">Eligible Candidates</p>
                                <h4 class="my-1 text-info">4805</h4>
                                <p class="mb-0 font-13" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    View More
                                </p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-danger text-white ms-auto"><i
                                    class='bx bxs-user'></i>
                            </div>
                        </div>



                    </div>
                </div>
                <div id="collapseThree" class="accordion-collapse collapse bg-primary bg-gradient"
                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-white">

                        <ul class=" list-group list-unstyled">
                            <li class=" d-flex  align-items-baseline justify-content-between">
                                <p> Temporary Worker</p>
                                <small>20</small>
                            </li>

                            <li class=" d-flex  align-items-baseline justify-content-between">

                                <p>  Contract worker</p>
                                <small>20</small>
                            </li>

                            <li class="  d-flex  align-items-baseline justify-content-between">

                                <p> Apprentice</p>
                                <small>20</small>
                            </li>

                            <li class="  d-flex  align-items-baseline justify-content-between">

                                <p> Full Time</p>
                                <small>20</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col position-relative">
                <div class="card border radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                    <div class="d-flex align-items-center accordion" id="accordionExample">
                        <div class="accordion-item" id="headingOne">
                            <p class="mb-0 text-secondary"> Total Assesment    </p>
                            <h4 class="my-1 text-info">4805</h4>
                            <p class="mb-0 font-13" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                View More
                            </p>

                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                class='fadeIn animated bx bx-file'></i>
                        </div>
                    </div>
                    </div>
                </div>
                <div id="collapseTwo" class="accordion-collapse collapse bg-primary bg-gradient"
                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-white">

                        <ul class=" list-group list-unstyled">
                            <li class=" d-flex  align-items-baseline justify-content-between">
                                <p> Temporary Worker</p>
                                <small>20</small>
                            </li>

                            <li class=" d-flex  align-items-baseline justify-content-between">

                                <p>  Contract worker</p>
                                <small>20</small>
                            </li>

                            <li class="  d-flex  align-items-baseline justify-content-between">

                                <p> Apprentice</p>
                                <small>20</small>
                            </li>

                            <li class="  d-flex  align-items-baseline justify-content-between">

                                <p> Full Time</p>
                                <small>20</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col position-relative">
                <div class="card border radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center accordion" id="accordionExample">
                            <div class="accordion-item" id="headingSix">
                                <p class="mb-0 text-secondary">Total Interview</p>
                                <h4 class="my-1 text-info">4805</h4>
                                <p class="mb-0 font-13" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                    View More
                                </p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i
                                    class='bx bx-broadcast'></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="collapseSix" class="accordion-collapse collapse bg-primary bg-gradient"
                    aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-white">

                        <ul class=" list-group list-unstyled">
                            <li class=" d-flex  align-items-baseline justify-content-between">
                                <p> Temporary Worker</p>
                                <small>20</small>
                            </li>

                            <li class=" d-flex  align-items-baseline justify-content-between">

                                <p>  Contract worker</p>
                                <small>20</small>
                            </li>

                            <li class="  d-flex  align-items-baseline justify-content-between">

                                <p> Apprentice</p>
                                <small>20</small>
                            </li>

                            <li class="  d-flex  align-items-baseline justify-content-between">

                                <p> Full Time</p>
                                <small>20</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col position-relative">
                <div class="card border radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center accordion" id="accordionExample">
                            <div class="accordion-item" id="headingFive">
                                <p class="mb-0 text-secondary">Total Onboarded</p>
                                <h4 class="my-1 text-info">4805</h4>
                                <p class="mb-0 font-13" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                    View More
                                </p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-info text-white ms-auto"><i
                                    class='bx bx-check-circle'></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="collapseFive" class="accordion-collapse collapse bg-primary bg-gradient"
                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-white">

                        <ul class=" list-group list-unstyled">
                            <li class=" d-flex  align-items-baseline justify-content-between">
                                <p> Temporary Worker</p>
                                <small>20</small>
                            </li>

                            <li class=" d-flex  align-items-baseline justify-content-between">

                                <p>  Contract worker</p>
                                <small>20</small>
                            </li>

                            <li class="  d-flex  align-items-baseline justify-content-between">

                                <p> Apprentice</p>
                                <small>20</small>
                            </li>

                            <li class="  d-flex  align-items-baseline justify-content-between">

                                <p> Full Time</p>
                                <small>20</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div id="chart15"></div>
                    </div>
                </div>
            </div>


            <div class="col-12 col-lg-4">
                <div class="card border radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Total Registraions</h6>
                            </div>

                        </div>
                        <div class="chart-container-2 mt-4">
                            <canvas id="chart2"></canvas>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            Temporary Worker <span class="badge bg-primary  rounded-pill">25</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            Contract worker <span class="badge bg-danger rounded-pill">10</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            Apprentice <span class="badge bg-warning  rounded-pill">65</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            Full Time <span class="badge  text-white  bg-success rounded-pill">14</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @else
       <div class="row">
        <div class="col-md-6 col-12 center-block mx-auto my-auto d-block  align-self-center mt-5">
            <img src="{{asset('public/'.$setting->logo)}}" class="img-fluid mt-5" alt="">
        </div>
       </div>
        @endif


    </div>
</div>
<div class="page-wrapper">
    <div class="page-content">
        <div class="row ">

            <div class="col-md-6">
                <div class="card border radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Registrations</p>
                                <div class=" d-flex align-items-center mt-1">
                                    <h4 class="my-1 text-primary">{{$total_reg_reg['total']}}</h4>
                                    <small class=" mx-2">
                                        <a href="{{url('admin/registrations')}}" class="">View All</a>
                                        <i class="bx bx-right-arrow-alt align-middle"></i>
                                    </small>
                                </div>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                <i class='bx bxs-group'></i>
                            </div>
                        </div>
                        <div class="row mt-3">
                            @foreach ($total_reg_reg['lists'] as $key=>$val)

                            <div class="col-md-6 radius-10 @if($loop->iteration>=3) mt-2 @endif">
                                <div class="card border detail_wrapper mb-0 registration-card">
                                    <div class="card-body text-center">
                                        <div>
                                            <p class=" mb-0"> <span class=" border-bottom">{{$key}} CATEGORY</span> </p>
                                             <p class=" mb-0 mt-1"><strong>{{$val}}</strong> <strong>Candidates</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card border radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Level One Screening</p>
                                <div class=" d-flex align-items-center mt-1">
                                    <h4 class="my-1 text-primary">{{$l_one_screen['total']}}</h4>
                                    <small class=" mx-2">
                                        <a href="{{url('admin/assign-exam')}}" class="">Current Candidate Pool : {{getTotalCurrentEligible()}} </a>
                                        <i class="bx bx-right-arrow-alt align-middle"></i>
                                    </small>
                                </div>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto">
                                <i class='fadeIn animated bx bx-buildings'></i>
                            </div>
                        </div>
                        <div class="row mt-3">
                            @foreach ($l_one_screen['lists'] as $key=>$val)
                            <div class="col-md-6 radius-10 @if($loop->iteration>=3) mt-2 @endif">
                                <div class="card border detail_wrapper mb-0 registration-card">
                                    <div class="card-body text-center">
                                        <div>
                                            <p class=" mb-0"> <span class=" border-bottom">{{$key}} CATEGORY</span> </p>
                                             <p class=" mb-0 mt-1 text-success  text-uppercase">{{$val['eligibles']}} -Total Eligible
                                            </p>
                                            <p class=" mb-0 mt-1 text-danger  text-uppercase">{{$val['not_eligible']}} -Total Not Eligible
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border radius-10 border-start border-0 border-3 border-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Admit Card</p>
                                <div class=" d-flex align-items-center mt-1">
                                    <h4 class="my-1 text-primary">{{$admit_card['total']}}</h4>
                                    <small class=" mx-2">
                                        <a href="{{url('admin/ready-for-assessment')}}" class="">View All</a>
                                        <i class="bx bx-right-arrow-alt align-middle"></i>
                                    </small>
                                </div>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-info text-white ms-auto">
                                <i class='bx bxs-group'></i>
                            </div>
                        </div>
                        <div class="row mt-3">
                            @foreach ($admit_card['lists'] as $key=>$val)
                            <div class="col-md-6 radius-10 @if($loop->iteration>=3) mt-2 @endif">
                                <div class="card border detail_wrapper mb-0 registration-card">
                                    <div class="card-body text-center">
                                        <div>
                                            <p class=" mb-0"> <span class=" border-bottom"><strong>{{$key}} CATEGORY</strong></span> </p>
                                            <p class=" mb-0 mt-1"><strong>{{$val}}</strong> <strong>Candidates</strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">

                            <div>
                                <p class="mb-0 text-secondary">Total Assessment</p>
                                <div class=" d-flex align-items-center mt-1">
                                    <h4 class="my-1 text-primary">{{$assessment['total']}}</h4>
                                    <small class=" mx-2">
                                        <a href="{{url('admin/candidate-assessment')}}" class="">View All</a>
                                        <i class="bx bx-right-arrow-alt align-middle"></i>
                                    </small>
                                </div>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                <i class='fadeIn animated bx bx-file'></i>
                            </div>
                        </div>
                        <div class="row mt-3">

                            @foreach ($assessment['lists'] as $key=>$val)
                            <div class="col-md-6 radius-10 @if($loop->iteration>=3) mt-2 @endif">
                                <div class="card border detail_wrapper mb-0 registration-card">

                                    <div class="card-body text-center">
                                        <div>
                                            <p class=" mb-0"> <span class=" border-bottom">{{$key}} CATEGORY</span> </p>
                                             <p class=" mb-0 mt-1 text-success  text-uppercase">{{$val['pass']}} -Pass
                                            </p>
                                            <p class=" mb-0 mt-1 text-danger  text-uppercase">{{$val['fail']}} -Fail
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                           
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">


                            <div>
                                <p class="mb-0 text-secondary">Total Interview</p>
                                <div class=" d-flex align-items-center mt-1">
                                    <h4 class="my-1 text-primary">{{$interview['total'] }}</h4>
                                    <small class=" mx-2">
                                        <a href="{{url('admin/candidate-interview-result')}}" class="">View All</a>
                                        <i class="bx bx-right-arrow-alt align-middle"></i>
                                    </small>
                                </div>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
                                <i class='bx bx-broadcast'></i>
                            </div>
                        </div>
                        <div class="row mt-3">
                            @foreach ($interview['lists'] as $key=>$val)
                            <div class="col-md-6 radius-10 @if($loop->iteration>=3) mt-2 @endif">
                                <div class="card border detail_wrapper mb-0 registration-card">
                                    <div class="card-body text-center">
                                        <div>
                                            <p class=" mb-0"> <span class=" border-bottom">{{$key}} CATEGORY</span> </p>
                                             <p class=" mb-0 mt-1 text-success  text-uppercase">{{$val['ok']}} -OK
                                            </p>
                                            <p class=" mb-0 mt-1 text-danger  text-uppercase">{{$val['not_ok']}} -Not OK
                                            </p>
                                            <p class=" mb-0 mt-1 text-warning text-uppercase">{{$val['hold']}} -hold
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary ">Total Onboarded</p>
                                <div class=" d-flex align-items-center mt-1">
                                    <h4 class="my-1  text-success">
                                        {{$on_boarding['total']}}
                                    </h4>
                                    <small class=" mx-2">
                                        <a href="{{url('admin/boarding-approved-candidates')}}" class="">View All</a>
                                        <i class="bx bx-right-arrow-alt align-middle"></i>
                                    </small>
                                </div>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                <i class='bx bx-check-circle'></i>
                            </div>
                        </div>
                        <div class="row mt-3">


                            @foreach ($on_boarding['lists'] as $key=>$val)
                            <div class="col-md-6 radius-10 @if($loop->iteration>=3) mt-2 @endif">
                                <div class="card border detail_wrapper mb-0 registration-card">
                                    <div class="card-body text-center">
                                        <div>
                                            <p class=" mb-0"> <span class=" border-bottom">{{$key}} CATEGORY</span> </p>
                                             <p class=" mb-0 mt-1 text-success  text-uppercase">{{$val['onboarded']}} -OnBoarded
                                            </p>
                                            <p class=" mb-0 mt-1 text-danger  text-uppercase">{{$val['absent']}} -Absent
                                            </p>
                                            <p class=" mb-0 mt-1 text-warning text-uppercase">{{$val['medical']}} -Medical-Unfit
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end row-->


    </div>
</div>
@endsection

@section("script")
{{-- <script src="{{asset('public/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('public/assets/plugins/chartjs/js/Chart.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/highcharts/js/highcharts.js')}}"></script>

<script>
    Highcharts.chart('chart15', {
        chart: {
            type: 'column',
            styledMode: true
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'Stacked column chart'
        },
        xAxis: {
            categories: ['Total registrations', 'L1 screening', 'Total assesment', 'Total interview',
                'Total onboarded'
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Number'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: ( // theme
                        Highcharts.defaultOptions.title.style && Highcharts.defaultOptions.title.style.color
                    ) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
                name: 'TW',
                data: [5, 3, 4, 7, 2]
            }, {
                name: 'CW',
                data: [2, 2, 3, 2, 1]
            }, {
                name: 'Apprentice',
                data: [3, 4, 4, 2, 5]
            },
            {
                name: 'FT',
                data: [3, 4, 4, 2, 5]
            }
        ]
    });

</script>

<script>
        $(function() {
            "use strict";
        var ctx = document.getElementById("chart2").getContext('2d');

        var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke1.addColorStop(0, '#0D6EFD');
            gradientStroke1.addColorStop(1, '#0D6EFD');

        var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke2.addColorStop(0, '#F41127');
            gradientStroke2.addColorStop(1, '#F41127');


        var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke3.addColorStop(0, '#FFC107');
            gradientStroke3.addColorStop(1, '#FFC107');

            var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke4.addColorStop(0, '#17A00E');
            gradientStroke4.addColorStop(1, '#17A00E');

            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                labels: ["TW", "CW", "Apprentice", "FT"],
                datasets: [{
                    backgroundColor: [
                    gradientStroke1,
                    gradientStroke2,
                    gradientStroke3,
                    gradientStroke4
                    ],
                    hoverBackgroundColor: [
                    gradientStroke1,
                    gradientStroke2,
                    gradientStroke3,
                    gradientStroke4
                    ],
                    data: [25, 80, 25, 25],
                    borderWidth: [1, 1, 1, 1]
                }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutoutPercentage: 75,
                    legend: {
                    position: 'bottom',
                    display: false,
                    labels: {
                        boxWidth:8
                    }
                    },
                    tooltips: {
                    displayColors:false,
                    }
                }
            });






        });

</script> --}}
@endsection
