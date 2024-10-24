<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home')}}">Career Viet</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('job.index')}}">Find Jobs</a>
                    </li>
                </ul>
                @if(auth()->check())
                    <a href="{{ route('account.profile') }}" class="d-flex align-items-center text-decoration-none">
                        <span class="navbar-text me-2">{{ auth()->user()->name }}</span>
                        @if(auth()->user()->image)
                            <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="Profile Picture" class="rounded-circle mx-2" style="width: 40px; height: 40px;">
                        @else
                            <div class="d-flex align-items-center justify-content-center rounded-circle mx-2" style="background-color: #A8DF8E; color: white;width: 40px; height: 40px;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </a>



                    <a class="btn btn-outline-primary me-2" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a class="btn btn-outline-primary me-2" href="{{ route('login') }}">Login</a>
                    <a class="btn btn-primary" href="{{ route('registration') }}">Register</a>
                @endif
            </div>
        </div>
    </nav>
</header>
