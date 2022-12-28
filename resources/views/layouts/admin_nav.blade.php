<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class=" position-relative">
            <img src="{{ getImage($setting->logo) }}" class="img-fluid" style="height: 55px !important;" alt="logo icon">
        </div>

        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <ul class="metismenu" id="menu">
        @if(auth()->user()->interviewer_type=='' || auth()->user()->interviewer_type==null)
        <li @if (Request::is('admin/dashboard')) class="mm-active" @endif>
            <a href="{{ url('admin/dashboard') }}">
                <div class="parent-icon"><i class="bx bx-home-circle"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @endif
        @if (in_array(3,
            auth()->user()->get_allowed_menus()['view']))
            <li @if (Request::is('admin/company-list')) class="mm-active" @endif>
                <a href="{{ url('admin/company-list') }}">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-git-compare"></i>
                    </div>
                    <div class="menu-title">Company List</div>
                </a>
            </li>
        @endif

        @if (in_array(11,
            auth()->user()->get_allowed_menus()['view']))
            <li @if (Request::is('admin/registration-list')) class="mm-active" @endif>
                <a href="{{ url('admin/registration-list') }}">
                    <div class="parent-icon"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">Registrations</div>
                </a>
            </li>
        @endif

        @if (in_array(12,
            auth()->user()->get_allowed_menus()['view']))
            <li @if (Request::is('admin/candidate-tracking-system')) class="mm-active" @endif>
                <a href="{{ url('admin/candidate-tracking-system') }}">
                    <div class="parent-icon"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">{{(auth()->user()->type==1)?'Master Data':'Candidate Tracking System'}}</div>
                </a>
            </li>
        @endif

        @if (in_array(1,
            auth()->user()->get_allowed_menus()['view']) ||
            in_array(
                2,
                auth()->user()->get_allowed_menus()['view']))
            <li @if (Request::is('admin/departments-list') || Request::is('admin/menu-list')) class="mm-active" @endif>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-bookmark-heart"></i>
                    </div>
                    <div class="menu-title">Security Matrix</div>
                </a>
                <ul class="mm-collapse">
                    @if (in_array(1,
                        auth()->user()->get_allowed_menus()['view']))
                        <li @if (Request::is('admin/menu-list')) class="mm-active" @endif>
                            <a href="{{ url('admin/menu-list') }}"><i class="bx bx-right-arrow-alt"></i>Menu List</a>
                        </li>
                    @endif
                    @if (in_array(2,
                        auth()->user()->get_allowed_menus()['view']))
                        <li @if (Request::is('admin/departments-list')) class="mm-active" @endif>
                            <a href="{{ url('admin/departments-list') }}"><i class="bx bx-right-arrow-alt"></i>Roles</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (in_array(4,
            auth()->user()->get_allowed_menus()['view']))
            <li @if (Request::is('admin/employee-list')) class="mm-active" @endif>
                <a href="{{ url('admin/employee-list') }}">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-user"></i>
                    </div>
                    <div class="menu-title">Manage Users</div>
                </a>
            </li>
        @endif
        @if (in_array(4,
            auth()->user()->get_allowed_menus()['view']))
            <li @if (Request::is('admin/link-list')) class="mm-active" @endif>
                <a href="{{ route('admin.link-list') }}" aria-expanded="true">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-link-external"></i>
                    </div>
                    <div class="menu-title">Registration Link</div>
                </a>
            </li>
        @endif

        @if (in_array(6,
            auth()->user()->get_allowed_menus()['view']))
            <li @if (Request::is('admin/exam-list')) class="mm-active" @endif>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-collection"></i>
                    </div>
                    <div class="menu-title">Exam</div>
                </a>
                <ul class="mm-collapse">
                    @if (in_array(6,
                        auth()->user()->get_allowed_menus()['view']))
                        <li @if (Request::is('admin/exam-list')) class="mm-active" @endif>
                            <a href="{{ route('admin.exam-list') }}"><i class="bx bx-right-arrow-alt"></i>Exam
                                Details</a>
                        </li>
                    @endif

                    @if (in_array(9,
                        auth()->user()->get_allowed_menus()['view']))
                        <li @if (Request::is('admin/exam-question-list')) class="mm-active" @endif>
                            <a href="{{ route('admin.exam-question-list') }}"><i class="bx bx-right-arrow-alt"></i>Exam
                                Question</a>
                        </li>
                    @endif
                    @if (in_array(10,
                        auth()->user()->get_allowed_menus()['view']))
                        <li @if (Request::is('admin/exam-batch-list')) class="mm-active" @endif>
                            <a href="{{ route('admin.exam-batch-list') }}"><i class="bx bx-right-arrow-alt"></i>Exam
                                Batch
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif



        @if (in_array(7,
            auth()->user()->get_allowed_menus()['view']))
            <li @if (Request::is('admin/trade-list')) class="mm-active" @endif>
                <a href="{{ route('admin.trade-list') }}" aria-expanded="true">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-link-alt"></i>
                    </div>
                    <div class="menu-title">Company Trade</div>
                </a>
            </li>
        @endif
        @if (in_array(8,
            auth()->user()->get_allowed_menus()['view']))
            <li @if (Request::is('admin/rg-category-list')) class="mm-active" @endif>
                <a href="{{ route('admin.rg-category-list') }}" aria-expanded="true">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-link-alt"></i>
                    </div>
                    <div class="menu-title">Registration Category</div>
                </a>
            </li>
        @endif


        @if (in_array(13,
            auth()->user()->get_allowed_menus()['view']) ||
            in_array(
                15,
                auth()->user()->get_allowed_menus()['view']))
            <li @if (Request::is('admin/eligible-candidates-list') || Request::is('admin/ready-for-assessment')) class="mm-active" @endif>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-collection"></i>
                    </div>
                    <div class="menu-title">Eligible Candidates</div>
                </a>
                <ul class="mm-collapse">
                    @if (in_array(13,
                        auth()->user()->get_allowed_menus()['view']))
                        <li @if (Request::is('admin/eligible-candidates-list')) class="mm-active" @endif>
                            <a href="{{ route('admin.eligible-candidates-list') }}"><i
                                    class="bx bx-right-arrow-alt"></i>
                                Eligible Candidates List
                            </a>
                        </li>
                    @endif

                    @if (in_array(15,
                        auth()->user()->get_allowed_menus()['view']))
                        <li @if (Request::is('admin/ready-for-assessment')) class="mm-active" @endif>
                            <a href="{{ route('admin.ready-for-assessment') }}"><i class="bx bx-right-arrow-alt"></i>
                                Ready For Assessment
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif



        @if (in_array(16,
            auth()->user()->get_allowed_menus()['view']) ||
            in_array(
                17,
                auth()->user()->get_allowed_menus()['view']) ||
            in_array(
                18,
                auth()->user()->get_allowed_menus()['view']))
            <li @if (Request::is('admin/candidate-document/un-approve') ||
                Request::is('admin/candidate-document/final-status') ||
                Request::is('admin/candidate-document/view-candidate')) class="mm-active" @endif>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-folder"></i>
                    </div>
                    <div class="menu-title">Documentation</div>
                </a>
                <ul class="mm-collapse">
                    @if (in_array(16,
                        auth()->user()->get_allowed_menus()['view']))
                        <li @if (Request::is('admin/candidate-document/un-approve')) class="mm-active" @endif>
                            <a href="{{ url('admin/candidate-document/un-approve') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Document Verification</a>
                        </li>
                    @endif

                    @if (in_array(17,
                        auth()->user()->get_allowed_menus()['view']))
                        <li @if (Request::is('admin/candidate-document/final-status')) class="mm-active" @endif>
                            <a href="{{ url('admin/candidate-document/final-status') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Send Exam Link</a>
                        </li>
                    @endif

                    @if (in_array(18,
                        auth()->user()->get_allowed_menus()['view']))
                        <li @if (Request::is('admin/candidate-document/view-candidate')) class="mm-active" @endif>
                            <a href="{{ url('admin/candidate-document/view-candidate') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Candidate Documentation Status</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif


        @if (in_array(20,
            auth()->user()->get_allowed_menus()['view']) ||
            in_array(
                21,
                auth()->user()->get_allowed_menus()['view']) ||
            in_array(
                21,
                auth()->user()->get_allowed_menus()['view']))
            <li @if (Request::is('admin/pending-assessment') ||
                Request::is('admin/assessment-result') ||
                Request::is('admin/check-candidate')) class="mm-active" @endif>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-folder"></i>
                    </div>
                    <div class="menu-title">Assessment</div>
                </a>
                <ul class="mm-collapse">
                    @if (in_array(20,
                        auth()->user()->get_allowed_menus()['view']))
                        <li @if (Request::is('admin/pending-assessment')) class="mm-active" @endif>
                            <a href="{{ url('admin/pending-assessment') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Pending Assessment</a>
                        </li>
                    @endif

                    @if (in_array(21,
                        auth()->user()->get_allowed_menus()['view']))
                        <li @if (Request::is('admin/assessment-result')) class="mm-active" @endif>
                            <a href="{{ url('admin/assessment-result') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Assessment Result</a>
                        </li>
                    @endif

                    @if (in_array(22,
                        auth()->user()->get_allowed_menus()['view']))
                        <li @if (Request::is('admin/check-candidate')) class="mm-active" @endif>
                            <a href="{{ url('admin/check-candidate') }}"><i class="bx bx-right-arrow-alt"></i>Check
                                Candidate</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (in_array(23,
            auth()->user()->get_allowed_menus()['view']))
            <li @if (Request::is('admin/interviewer-list')) class="mm-active" @endif>
                <a href="{{ url('admin/interviewer-list') }}">
                    <div class="parent-icon"><i class="bx bx-user-check"></i>
                    </div>
                    <div class="menu-title">Interviewer</div>
                </a>
            </li>
        @endif


        @if (in_array(24,
            auth()->user()->get_allowed_menus()['view']) ||
            in_array(
                25,
                auth()->user()->get_allowed_menus()['view']))
            <li @if (Request::is('admin/initiate-interview') || Request::is('admin/interview-result')) class="mm-active" @endif>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-user"></i>
                    </div>
                    <div class="menu-title">Interview</div>
                </a>
                <ul class="mm-collapse">
                    @if (in_array(24,
                        auth()->user()->get_allowed_menus()['view']))
                        <li @if (Request::is('admin/initiate-interview')) class="mm-active" @endif>
                            <a href="{{ url('admin/initiate-interview') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Initiate Interview
                            </a>
                        </li>
                    @endif
                    @if (in_array(25,
                        auth()->user()->get_allowed_menus()['view']))
                        <li @if (Request::is('admin/interview-result')) class="mm-active" @endif>
                            <a href="{{ url('admin/interview-result') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Interview Result
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif


        @if (in_array(26,
            auth()->user()->get_allowed_menus()['view']))
            <li @if (Request::is('admin/onboarding-venue-list')) class="mm-active" @endif>
                <a href="{{ url('admin/onboarding-venue-list') }}">
                    <div class="parent-icon"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">Onboarding Venue</div>
                </a>
            </li>
        @endif

        @if (in_array(27,auth()->user()->get_allowed_menus()['view']) || in_array(28,auth()->user()->get_allowed_menus()['view']))
        <li @if (Request::is('admin/boarding-unapproved-candidates') || Request::is('admin/boarding-approved-candidates')) class="mm-active" @endif>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="fadeIn animated bx bx-user"></i>
                </div>
                <div class="menu-title">OnBoarding Details</div>
            </a>
            <ul class="mm-collapse">
                @if (in_array(27,auth()->user()->get_allowed_menus()['view']))
                <li @if (Request::is('admin/boarding-unapproved-candidates')) class="mm-active" @endif>
                    <a href="{{url('admin/boarding-unapproved-candidates')}}"><i class="bx bx-right-arrow-alt"></i>Selected Candidates
                    </a>
                </li>
                @endif

                @if (in_array(28,auth()->user()->get_allowed_menus()['view']))
                <li @if (Request::is('admin/boarding-approved-candidates')) class="mm-active" @endif>
                    <a href="{{url('admin/boarding-approved-candidates')}}"><i class="bx bx-right-arrow-alt"></i>OnBoarded Candidates
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif


        @if (in_array(19,
            auth()->user()->get_allowed_menus()['view']))
            <li @if (Request::is('admin/absent-candidate')) class="mm-active" @endif>
                <a href="{{ route('admin.absent-candidate') }}" aria-expanded="true">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-link-alt"></i>
                    </div>
                    <div class="menu-title">Absent Candidate</div>
                </a>
            </li>
        @endif



        @if (in_array(14,
            auth()->user()->get_allowed_menus()['view']))
            <li @if (Request::is('admin/site-setting')) class="mm-active" @endif>
                <a href="{{ route('admin.site-setting') }}">
                    <div class="parent-icon"><i class="bx bx-cog bx-spin"></i>
                    </div>
                    <div class="menu-title">Site Setting</div>
                </a>
            </li>
        @endif
    </ul>
</div>
