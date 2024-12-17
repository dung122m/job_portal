@extends('front.layouts.app')

@section('main')

    <section class="section-5 bg-2">
        <div class="container py-5">
            @include('front.layouts.message')
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href={{ route('home') }}>Home</a></li>
                            <li class="breadcrumb-item active">Account Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="s-body text-center mt-3">
                            <div class="d-flex align-items-center justify-content-center">
                                @if($user->image)
                                    <img src="{{ asset('storage/' . $user->image) }}" alt="Profile" class=" img-fluid" style="width: 150px;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center rounded-circle" style="background-color: #A8DF8E; color: white; width: 150px; height: 150px; font-size: 60px;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }} <!-- First letter of the name -->
                                    </div>
                                @endif
                            </div>
                            <h5 class="mt-3 pb-0">{{ $user->name }}</h5>
                            <p class="text-muted mb-1 fs-6">{{ $user->designation ?? 'No Designation' }}</p>
                            <div class="d-flex flex-column mb-2 gap-3">
                                <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary">Change Profile Picture</button>
                                @if($user->image)
                                    <form action="{{ route('account.deleteProfilePicture') }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100">Delete Profile Picture</button>
                                    </form>
                                @endif
                            </div>

                            <div class="d-flex flex-column mb-2 mt-3 gap-3">
                                <button data-bs-toggle="modal" data-bs-target="#cvmodal" type="button" class="btn btn-primary">Upload CV</button>
                                @if($user->cv)
                                    <a href="{{ asset('storage/' . $user->cv) }}" target="_blank" class="btn btn-primary btn-sm">View your CV</a>
                                    <form action="{{ route('account.deleteCV') }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100">Delete CV</button>
                                    </form>


                                @endif
                            </div>


                        </div>


                    </div>
                    <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush ">
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <a href="{{route('account.profile')}}">Profile Settings</a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <a href="{{route('job.create')}}">Post a Job</a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <a href="{{route('job.my-job')}}">My Jobs</a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <a href="{{route('job.applied')}}">Jobs Applied</a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <a href="{{route('job.saved')}}">Saved Jobs</a>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
    </section>

@endsection
