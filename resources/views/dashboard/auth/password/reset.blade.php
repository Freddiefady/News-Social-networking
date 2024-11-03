@extends('layouts.dashboard.auth.app')
@section('title')
Reset Password
@endsection
@section('body')
<!-- Outer Row -->
<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Enter New Password</h1>
                            </div>
                            <form action="{{route('dashboard.password.reset.update')}}" method="POST" class="user">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="email" class="form-control form-control-user"
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        value="{{$email}}">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password">
                                        @error('password')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control form-control-user"
                                        id="exampleInputPasswordConfirm" placeholder="Confirm Password">
                                        @error('password')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Reset
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
