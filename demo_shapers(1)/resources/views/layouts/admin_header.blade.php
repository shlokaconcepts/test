<!--start header -->
<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu">
                <i class="bx bx-menu"></i>
            </div>
            <div class="search-bar flex-grow-1">

            </div>

            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">

                    <li class="nav-item dropdown dropdown-large">

                    </li>
                    <li class="nav-item dropdown dropdown-large">

                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">

                            </a>
                            <div class="header-notifications-list">

                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-large">

                        <div class="dropdown-menu dropdown-menu-end">

                            <div class="header-message-list">

                            </div>

                        </div>
                    </li>
                </ul>
            </div>
            <div class="user-box  dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('public/assets/images/avatars/user.png')}}" class="user-img" alt="user avatar">
                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{(Auth::user()->phone!=null)?Auth::user()->name:"";}}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{route('admin.profile')}}">
                            <i class="bx bx-user"></i><span>Profile</span>
                        </a>
                    </li>

                    <li><div class="dropdown-divider mb-0"></div>
                    </li>
                    <li>
                        <a class="dropdown-item"  href="{{ route('admin_logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class='bx bx-log-out-circle'></i><span>Logout</span>
                            <form id="logout-form" action="{{ route('admin_logout') }}" method="POST" class="d-none">
                                @csrf
                             </form>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!--end header -->
