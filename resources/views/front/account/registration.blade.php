@extends('front.layouts.app')

@section('main')

    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">Register</h1>

                        <!-- Form đăng ký -->
                        <form action="{{ route('account.processRegistration') }}" name="registrationForm" id="registrationForm" method="POST">
                            @csrf <!-- Token CSRF bảo mật -->

                            <!-- Name Field -->
                            <div class="mb-3">
                                <label for="name" class="mb-2">Name*</label>
                                <input type="text" name="name" id="name"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       placeholder="Enter Name" value="{{ old('name') }}">

                                <!-- Hiển thị lỗi nếu có -->
                                @error('name')
                                <span class="text-danger mt-2 small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="mb-2">Email*</label>
                                <input type="text" name="email" id="email"
                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       placeholder="Enter Email" value="{{ old('email') }}">

                                <!-- Hiển thị lỗi nếu có -->
                                @error('email')
                                <span class="text-danger mt-2 small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3">
                                <label for="password" class="mb-2">Password*</label>
                                <input type="password" name="password" id="password"
                                       class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                       placeholder="Enter Password">

                                <!-- Hiển thị lỗi nếu có -->
                                @error('password')
                                <span class="text-danger mt-2 small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="mb-3">
                                <label for="confirm_password" class="mb-2">Confirm Password*</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                       class="form-control {{ $errors->has('confirm_password') ? 'is-invalid' : '' }}"
                                       placeholder="Please confirm Password">

                                <!-- Hiển thị lỗi nếu có -->
                                @error('confirm_password')
                                <span class="text-danger mt-2 small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Nút đăng ký -->
                            <button class="btn btn-primary mt-2">Register</button>
                        </form>
                    </div>

                    <div class="mt-4 text-center">
                        <p>Have an account? <a href="login.html">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
