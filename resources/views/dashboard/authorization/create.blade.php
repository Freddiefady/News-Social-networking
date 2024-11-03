@extends('layouts.dashboard.app')
@section('title')
Create permission
@endsection
@section('body')
<center>
    <div class="container-fluid">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <!-- Button trigger modal -->
            <a href="{{route('dashboard.authorization.index')}}" class="btn btn-primary">
                Return all roles
            </a>
        </div>
        <div class="card-header">
            <h2>Create New User</h2>
        </div>
        <form action="{{route('dashboard.authorization.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card shadow mb-4">
                <div class="card-body mb-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="role" placeholder="Enter Role name">
                                @error('role')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach (config('authorization.permissions') as $key => $value)
                            <div class="col-4">
                                <div class="form-group">
                                    {{$value}} : <input type="checkbox" name="permissions[]" value="{{$key}}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-success text-center">Add role</button>
                </div>
            </div>
        </form>
    </div>
</center>
@endsection
