@extends('front.account.profile')

@section('content')
    <div class="col-lg-9">
        <div class="card border-0 shadow mb-4 ">
            <div class="card-body card-form p-4">
                <h3 class="fs-4 mb-1">Job Details</h3>
                <form action="{{ route('job.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="title" class="mb-2">Title<span class="req">*</span></label>
                            <input type="text" placeholder="Job Title" id="title" name="title" class="form-control @error('title') is-invalid @enderror" required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="category" class="mb-2">Category<span class="req">*</span></label>
                            <select name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror" required>
                                <option value="">Select a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="job_type" class="mb-2">Job Nature<span class="req">*</span></label>
                            <select name="job_type_id" id="job_type" class="form-select @error('job_type_id') is-invalid @enderror" required>
                                <option value="">Select Job Type</option>
                                @foreach($jobTypes as $jobType)
                                    <option value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                @endforeach
                            </select>
                            @error('job_type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="vacancy" class="mb-2">Vacancy<span class="req">*</span></label>
                            <input type="number" min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control @error('vacancy') is-invalid @enderror" required>
                            @error('vacancy')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="vacancy" class="mb-2">Experience<span class="req">*</span></label>
                            <input type="number" min="1" placeholder="Experience" id="experience" name="experience" class="form-control @error('experience') is-invalid @enderror" required>
                            @error('experience')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-4 col-md-6">
                            <label for="salary" class="mb-2">Salary</label>
                            <input type="text" placeholder="Salary" id="salary" name="salary" class="form-control @error('salary') is-invalid @enderror">
                            @error('salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-md-6">
                            <label for="location" class="mb-2">Location<span class="req">*</span></label>
                            <input type="text" placeholder="Location" id="location" name="location" class="form-control @error('location') is-invalid @enderror" required>
                            @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="mb-2">Description<span class="req">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="5" rows="5" placeholder="Description" required></textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="benefits" class="mb-2">Benefits</label>
                        <textarea class="form-control @error('benefits') is-invalid @enderror" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits"></textarea>
                        @error('benefits')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="responsibility" class="mb-2">Responsibility</label>
                        <textarea class="form-control @error('responsibility') is-invalid @enderror" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility"></textarea>
                        @error('responsibility')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="qualifications" class="mb-2">Qualifications</label>
                        <textarea class="form-control @error('qualifications') is-invalid @enderror" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications"></textarea>
                        @error('qualifications')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="keywords" class="mb-2">Keywords<span class="req">*</span></label>
                        <input type="text" placeholder="Keywords" id="keywords" name="keywords" class="form-control @error('keywords') is-invalid @enderror" required>
                        @error('keywords')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                    <div class="row">
                        <div class="mb-4 col-md-6">
                            <label for="company_name" class="mb-2">Name<span class="req">*</span></label>
                            <input type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control @error('company_name') is-invalid @enderror" required>
                            @error('company_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 col-md-6">
                            <label for="company_location" class="mb-2">Location</label>
                            <input type="text" placeholder="Location" id="company_location" name="company_location" class="form-control @error('company_location') is-invalid @enderror">
                            @error('company_location')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="website" class="mb-2">Website</label>
                        <input type="text" placeholder="Website" id="website" name="website" class="form-control @error('website') is-invalid @enderror">
                        @error('website')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="card-footer p-4">
                        <button type="submit" class="btn btn-primary">Save Job</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
