@extends('front.account.profile')

@section('content')
    <div class="col-lg-9">
        <div class="card border-0 shadow mb-4 p-3">
            <div class="card-body card-form">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fs-4 mb-1">Applicants</h3>
                    </div>
                </div>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($applicants->isEmpty())
                    <p>No one has applied for this job yet.</p>
                @else
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Applied Date</th>
                            <th>Phone</th>
                            <th>CV</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($applicants as $application)
                            <tr>
                                <td>{{ $application->user->name }}</td>
                                <td>{{ $application->user->email }}</td>
                                <td>{{ $application->applied_date }}</td>
                                <td>{{ $application->user->mobile }}</td>
                                <td>
                                    @if($application->user->cv)
                                        <a href="{{ asset('storage/' . $application->user->cv) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                        <a href="{{ asset('storage/' . $application->user->cv) }}" download class="btn btn-primary btn-sm">Download</a>

                                    @else
                                        No CV uploaded
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>




@endsection
