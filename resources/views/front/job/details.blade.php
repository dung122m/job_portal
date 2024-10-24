@extends('front.layouts.app')

@section('main')
    <section class="section-4 bg-2">
        <div class="container pt-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{route('job.my-job')}}"><i class="fa fa-arrow-left"
                                                                                             aria-hidden="true"></i>
                                    &nbsp;Back to Jobs</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container job_details_area">
            <div class="row pb-5">
                <div class="col-md-8">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card shadow border-0">
                        <div class="job_details_header">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">

                                    <div class="jobs_conetent">
                                        <a href="#">
                                            <h4>{{$job->title}}</h4>
                                        </a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p><i class="fa fa-map-marker"></i> {{$job->location}}</p>
                                            </div>
                                            <div class="location">
                                                <p><i class="fa fa-clock-o"></i> {{$job->jobType->name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="descript_wrap white-bg">
                            <div class="single_wrap">
                                <h4>Job description</h4>
                                <p>{{$job->description}}</p>
                            </div>
                            <div class="single_wrap">
                                <h4>Responsibility</h4>
                                <p>{{$job->responsibility}}</p>
                            </div>
                            <div class="single_wrap">
                                <h4>Qualifications</h4>
                                <p>{{$job->qualifications}}</p>
                            </div>
                            <div class="single_wrap">
                                <h4>Benefits</h4>
                                <p>{{$job->benefits}}</p>
                            </div>
                            <div class="border-bottom"></div>
                            <div class="pt-3 text-end">

                                @if(auth()->check())
                                    <div class="d-flex gap-2">
                                        <form action="{{ route('job.save', $job->id) }}"  method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary">Save</button>
                                        </form>

                                        <form action="{{ route('job.apply', $job->id) }}" method="POST" class="d-inline">
                                            @csrf <!-- Thêm token CSRF để bảo mật -->
                                            <button type="submit" class="btn btn-primary">Apply</button>
                                        </form>
                                    </div>


                                @else
                                    <a href="{{route('login')}}" class="btn btn-primary">Login to Apply</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow border-0">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Job Summery</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li>Published on:
                                        <span>{{\Carbon\Carbon::parse($job->created_at)->format('d M, Y')}}</span></li>
                                    <li>Vacancy: <span>{{$job->vacancy}} Position</span></li>
                                    <li>Salary: <span>$ {{$job->salary}}</span></li>
                                    <li>Location: <span>{{$job->location}}</span></li>
                                    <li>Job Nature: <span>{{$job->jobType->name}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow border-0 my-4">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Company Details</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li>Name: <span>{{$job->company_name}}</span></li>
                                    <li>Locaion: <span>{{$job->company_location}}</span></li>
                                    <li>Website: <a href="{{ $job->company_website }}" target="_blank"
                                                    rel="noopener noreferrer">{{ $job->company_website }}</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
