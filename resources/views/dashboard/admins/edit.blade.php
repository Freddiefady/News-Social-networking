@extends('layouts.dashboard.app')
@section('title')
Users
@endsection
@section('body')
<div class="card-header">
    <h2>Edit admin: {{$admin->name}}</h2>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="{{route('dashboard.admins.index')}}" class="btn btn-primary">Back</a>
    </div>
</div>
<div class="container card mb-4">
    <form action="{{route('dashboard.admins.update', $admin->id)}}" method="POST">
        @csrf
        @method("PUT")
        <div class="card-body shadow mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label">Name:</label>
                        <input class="form-control" name="name" value="{{$admin->name}}">
                        @error('name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label">Username:</label>
                        <input class="form-control" name="username" value="{{$admin->username}}">
                        @error('username')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label">Email:</label>
                        <input class="form-control" name="email" value="{{$admin->email}}">
                        @error('email')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Select Status</label>
                        <select class="form-control" name="status">
                            <option disabled>Select Status</option>
                            <option value="1" @selected($admin->status == 1)>Active</option>
                            <option value="0" @selected($admin->status == 0)>Not Active</option>
                        </select>
                        @error('status')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label">Select Role:</label>
                        <select class="form-control" name="role_id">
                            <option disabled>Select Role</option>
                            @forelse ($roles as $role)
                                <option value="{{$role->id}}" @selected($admin->role_id == $role->id)>{{$role->role}}
                                </option>
                            @empty
                                <option>Not Found.</option>
                            @endforelse($roles as $role)
                        </select>
                        @error('role_id')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label">Password:</label>
                        <input class="form-control" name="password" type="password" placeholder="Enter password..">
                        @error('password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label">Password confirmation:</label>
                        <input class="form-control" name="password_confirmation" type="password"
                            placeholder="Enter password confirmation..">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection
