@extends('layouts.master-without-nav')

@section('title')
@lang('translation.Recover_Password') 2
@endsection

@section('css')
<!-- owl.carousel css -->
<link rel="stylesheet" href="{{ URL::asset('build/libs/owl.carousel/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('build/libs/owl.carousel/assets/owl.theme.default.min.css') }}">
@endsection

@section('body')

<body class="auth-body-bg">
    @endsection

    @section('content')

    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary-subtle">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary"> Reset Password</h5>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{ URL::asset('build/images/profile-img.png') }}" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div>
                                <a href="index">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ URL::asset('build/images/logo.svg') }}" alt=""
                                                class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>
                            </div>

                            <div class="p-2">
                                @if (session('status'))
                                <div class="alert alert-success text-center mb-4" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                                <div class="alert alert-success text-center mb-4" role="alert">
                                    Enter your Email and instructions will be sent to you!
                                </div>
                                <div class="mt-4">
                                    <form class="form-horizontal" method="POST" action="{{ route('password.update') }}">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="useremail" name="email" placeholder="Enter email" value="{{ $email ?? old('email') }}" id="email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="userpassword">Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="userpassword" placeholder="Enter password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="userpassword">Confirm Password <span class="text-danger">*</span></label>
                                            <input id="password-confirm" type="password" name="password_confirmation" class="form-control" placeholder="Enter confirm password">
                                        </div>

                                        <div class="text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
                                        </div>

                                    </form>
                                    <div class="mt-5 text-center">
                                        <p>Remember It ? <a href="{{ url('login') }}" class="font-weight-medium text-primary"> Sign In here</a> </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>Remember It ? <a href="/login" class="fw-medium text-primary"> Sign In here</a> </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @endsection
    @section('script')
    <!-- owl.carousel js -->
    <script src="{{ URL::asset('build/libs/owl.carousel/owl.carousel.min.js') }}"></script>
    <!-- auth-2-carousel init -->
    <script src="{{ URL::asset('build/js/pages/auth-2-carousel.init.js') }}"></script>
    @endsection
