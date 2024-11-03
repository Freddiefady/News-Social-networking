@extends('layouts.dashboard.app')
@section('title')
Users
@endsection
@section('body')
<div class="card-header">
    <h2>User: {{$user->name}}</h2>
</div>
<div class="container-fluid card shadow mb-4">
    <div class="card-body shadow mb-4">
    <div class="row">
            <h3>User Profile</h3>
            <img src="{{asset($user->image)}}" style="width: 20vw;height: 27vh;border-radius: 50% !important;">
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                <label class="form-label">Name:</label>
                <input class="form-control" disabled  value="{{$user->name}}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">Username:</label>
                    <input class="form-control" disabled  value="{{$user->username}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                <label class="form-label">Email:</label>
                    <input class="form-control" disabled value="{{$user->email}}">
                </div>
            </div>
            <div class="col-6">
                <div div class="form-group">
                <label class="form-label">Phone:</label>
                    <input class="form-control" disabled value="{{$user->phone}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                <label class="form-label">Status:</label>
                    <input class="form-control" disabled value="{{$user->status == 1 ? 'Active':'Not active'}}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                <label class="form-label">Email Verified:</label>
                    <input class="form-control" disabled value="{{$user->email_verified_at == null ? 'Not Verify':'Verify'}}">
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                <label class="form-label">Country:</label>
                    <input class="form-control" disabled value="{{$user->country}}">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                <label class="form-label">City:</label>
                    <input class="form-control" disabled value="{{$user->city}}">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                <label class="form-label">Street:</label>
                    <input class="form-control" disabled value="{{$user->street}}">
                </div>
            </div>
        </div>

    <a href="{{route('dashboard.status.users',$user->id)}}" class="btn btn-warning">{{$user->status == 1 ? "Pan": "Active"}}</a>
    <a href="javascript:void(0)" onclick="if(confirm('Do you want delete the user')){document.getElementById('DeleteUser_{{$user->id}}').submit()} return false"
        class="btn btn-danger">Delete</a>
    <form action="{{route('dashboard.users.destroy', $user->id)}}" id="DeleteUser_{{$user->id}}" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection
