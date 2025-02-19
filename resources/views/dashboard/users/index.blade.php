@extends('layouts.dashboard.app')
@section('title')
Users
@endsection
@section('body')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Users</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables for Users</h6>
    </div>
    @include('dashboard.users.filter')
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Country</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Country</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->status == 0 ? 'Not Active' : 'Active'}}</td>
                        <td>{{$user->country}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="if(confirm('Do you want delete the user')){document.getElementById('DeleteUser_{{$user->id}}').submit()} return false"
                            ><i class="fa fa-trash" title="Delete" style="padding-right: 19px;"></i></a>
                            <a href="{{route('dashboard.status.users', $user->id)}}"><i class="fa @if ($user->status == 1)fa-ban @else fa-stop @endif" title="@if ($user->status == 1)Block @else Active @endif" style="padding-right: 19px;"></i></a>

                            <a href="{{route('dashboard.users.show',$user->id)}}"><i class="fa fa-eye" title="Show"></i></a>
                        </td>
                        <form action="{{route('dashboard.users.destroy', $user->id)}}" id="DeleteUser_{{$user->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        @empty
                        <tr>
                            <td class="alert alert-info" colspan="6">No users found.</td>
                        </tr>
                        @endforelse
                    </tr>
                </tbody>
            </table>
            {{$users->appends(request()->input())->links()}}
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
@endsection
