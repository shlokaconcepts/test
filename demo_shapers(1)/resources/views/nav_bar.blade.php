<nav id="navbar_top" class="navbar m-0 p-0 navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img class="nav-logo pt-2 pb-2" src="{{getImage($setting->logo)}}"
                height="50">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse  justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 ">

                

                @if (Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                      {{auth()->user()->first_name.' '.auth()->user()->last_name}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{route('candidate-status')}}">Dashboard</a>
                        </li>

                        <li>
                            <a class="dropdown-item"  href="{{ route('user_logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               <span>Logout</span>
                                <form id="logout-form" action="{{ route('user_logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </li>

                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{url('login')}}">Candidate Login</a>
                </li>
                @endif
                

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Contact Us
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="tel: +911244034795">Call +911244034795</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
