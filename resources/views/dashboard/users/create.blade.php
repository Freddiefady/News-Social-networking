@extends('layouts.dashboard.app')
@section('title')
Users
@endsection
@section('body')
<center>
<div class="container-fluid">
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <!-- Button trigger modal -->
                <a href="{{route('dashboard.users.index')}}" class="btn btn-primary">
                    View All Users
                </a>
            </div>
<div class="card-header">
    <h2>Create New User</h2>
</div>
<form action="{{route('dashboard.users.store')}}" method="post" enctype="multipart/form-data" >
    @csrf
<div class="card shadow mb-4">
    <div class="card-body shadow mb-4">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Enter your name">
                    @error('name')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Enter your username">
                    @error('username')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="email">
                    @error('email')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div div class="form-group">
                    <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number">
                    @error('phone')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            <input type="file" name="image" class="form-control mb-2"/>
            @error('image')
            <strong class="text-danger">{{$message}}</strong>
            @enderror
            </div>
        </div><br>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <input type="text" name="country" class="form-control" placeholder="Enter your country..">
                    @error('country')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <input type="text" name="city" class="form-control" placeholder="Enter your city..">
                    @error('city')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <input type="text" name="street" class="form-control" placeholder="Enter your street..">
                    @error('street')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option selected disabled value="">Status</option>
                        <option value="1">Active</option>
                        <option value="0">Not Active</option>
                    </select>
                    @error('status')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <select name="email_verified_at" class="form-control">
                        <option selected disabled>Status Email Verify</option>
                        <option value="1">Active</option>
                        <option value="0">Not Active</option>
                    </select>
                    @error('email_verified_at')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Enter password">
                    @error('password')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Enter confirm password">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success text-center">Add User</button>
    </div>
</div>
</form>
</div>
</center>
@endsection
