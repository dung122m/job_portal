@extends('front.account.profile')

@section('content')

    <div class="col-lg-9">
        <div class="card border-0 shadow mb-4 p-3">
            <div class="card-body card-form">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fs-4 mb-1">Saved Jobs</h3>
                    </div>


                </div>
                <div class="table-responsive">
                    <table class="table ">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Job Created</th>
                            <th scope="col">Applicants</th>

                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody class="border-0">

                        @foreach($savedJobs as $job)
                            <tr class="active">
                                <td>
                                    <div class="job-name fw-500">{{$job->title}}</div>
                                    <div class="info1">{{$job->jobType->name}} . {{$job->location}}</div>
                                </td>
                                <td>{{\Carbon\Carbon::parse($job->created_at)->format('d M, Y')}}</td>
                                <td>130 Applications</td>

                                <td>
                                    <div class="action-dots float-end">
                                        <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="{{route('job.details',$job->id)}}"> <i class="fa fa-eye"
                                                                                                                      aria-hidden="true"></i>
                                                    View</a></li>

                                                <form action="{{ route('job.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fa fa-trash" aria-hidden="true"></i> Remove
                                                    </button>
                                                </form>
                                            </li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>

                    </table>
                </div>
            </div>
        </div>

@endsection
