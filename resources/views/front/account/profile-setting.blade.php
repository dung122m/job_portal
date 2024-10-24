@extends('front.account.profile')

@section('content')

    <div class="col-lg-9">
        <div class="card border-0 shadow mb-4">
            <div class="card-body p-4">
                <h3 class="fs-4 mb-1">My Profile</h3>
                <form method="POST" action="{{ route('account.updateProfile') }}"> <!-- Route to update information -->
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="mb-2">Name*</label>
                        <input type="text" id="name" name="name" placeholder="Enter Name" class="form-control" value="{{ $user->name }}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="mb-2">Email*</label>
                        <input type="email" id="email" name="email" placeholder="Enter Email" class="form-control" value="{{ $user->email }}">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="designation" class="mb-2">Designation*</label>
                        <input type="text" id="designation" name="designation" placeholder="Designation" class="form-control" value="{{ $user->designation }}">
                        @error('designation')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="mobile" class="mb-2">Mobile*</label>
                        <input type="text" id="mobile" name="mobile" placeholder="Mobile" class="form-control" value="{{ $user->mobile }}">
                        @error('mobile')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="card-footer p-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow mb-4">
            <div class="card-body p-4">
                <h3 class="fs-4 mb-1">Change Password</h3>

                <!-- Display error messages for change password -->


                <form method="POST" action="{{ route('account.changePassword') }}"> <!-- Route to change password -->
                    @csrf
                    <div class="mb-4">
                        <label for="old_password" class="mb-2">Old Password*</label>
                        <input type="password" id="old_password" name="old_password" placeholder="Old Password" class="form-control">
                        @error('old_password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="new_password" class="mb-2">New Password*</label>
                        <input type="password" id="new_password" name="new_password" placeholder="New Password" class="form-control">
                        @error('new_password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="confirm_password" class="mb-2">Confirm Password*</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="form-control">
                        @error('confirm_password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="card-footer p-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
