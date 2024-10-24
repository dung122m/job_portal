@extends('front.layouts.app')

@section('main')
    @include('front.layouts.banner')

    <section class="section-1 py-5 ">
        <div class="container">
            <div class="card border-0 shadow p-5">
                <div class="row">
                    <form action="{{ route('job.index') }}" method="GET" class="w-100 row"> <!-- Thêm form và method GET -->
                        <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                            <input type="text" class="form-control" name="keywords" id="search" placeholder="Keywords">
                        </div>
                        <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                            <input type="text" class="form-control" name="location" id="location" placeholder="Location">
                        </div>
                        <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                            <select name="category" id="category" class="form-control">
                                <option value="">Select a Category</option>
                                @foreach($categories as $category) <!-- Lấy danh sách category từ controller -->
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-xs-3 mb-sm-3 mb-lg-0">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-block">Search</button> <!-- Thay đổi link thành button -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="section-2 bg-2 py-5">
        <div class="container">
            <h2>Popular Categories</h2>

                <div class="row pt-5">
                    @foreach($categories as $category)
                    <div class="col-lg-4 col-xl-3 col-md-6">
                        <div class="single_catagory">
                            <a href="{{route('job.index',['category' => $category->id])}}"><h4 class="pb-2">{{$category->name}}</h4></a>
                        </div>
                    </div>
                    @endforeach
                </div>


        </div>
    </section>

    <section class="section-3  py-5">
        <div class="container">
            <h2>Featured Jobs</h2>
            <div class="row pt-5">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @foreach($randomJobs as $job)
                                <div class="col-md-4">
                                    <div class="card border-0 p-3 shadow mb-4" >
                                        <div class="card-body">
                                            <h3 class="border-0 fs-5 pb-2 mb-0 text-truncate">{{$job->title}}</h3>
                                            <p>{{$job->company_name}}</p>
                                            <div class="bg-light p-3 border">
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                    <span class="ps-1 text-truncate">{{$job->company_location}}</span>
                                                </p>
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                    <span class="ps-1">{{$job->jobType->name}}</span>
                                                </p>
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                    <span class="ps-1">{{$job->salary}}</span>
                                                </p>
                                            </div>

                                            <div class="d-grid mt-3">
                                                <a href="{{route('job.details',$job->id)}}}" class="btn btn-primary btn-lg">Details</a>
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
    </section>

    <section class="section-3 bg-2 py-5">
        <div class="container">
            <h2>Latest Jobs</h2>
            <div class="row pt-5">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @foreach($lastestJobs as $job)
                                <div class="col-md-4">
                                    <div class="card border-0 p-3 shadow mb-4" >
                                        <div class="card-body">
                                            <h3 class="border-0 fs-5 pb-2 mb-0 text-truncate">{{$job->title}}</h3>
                                            <p>{{$job->company_name}}</p>
                                            <div class="bg-light p-3 border">
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                    <span class="ps-1 text-truncate">{{$job->company_location}}</span>
                                                </p>
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                    <span class="ps-1">{{$job->jobType->name}}</span>
                                                </p>
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                    <span class="ps-1">{{$job->salary}}</span>
                                                </p>
                                            </div>

                                            <div class="d-grid mt-3">
                                                <a href="{{route('job.details',$job->id)}}}" class="btn btn-primary btn-lg">Details</a>
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
    </section>
@endsection


@include('front.layouts.slide')
