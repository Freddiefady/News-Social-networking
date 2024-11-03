@extends('layouts.dashboard.app')
@section('title')
Admins
@endsection
@section('body')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Admins</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables for admins</h6>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAdmins">
                Add admin
            </button>
        </div>
    </div>
    @include('dashboard.admins.filter')
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Roles</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Roles</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse($admins as $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->username }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->status == 0 ? 'Not Active' : 'Active' }}
                            <td>{{ $admin->role->role }}</td>
                            </td>
                            <td>{{ $admin->created_at->format('d-m-y h:m a') }}</td>
                            <td>
                                <a href="javascript:void(0)"
                                    onclick="if(confirm('Do you want delete the admin')){document.getElementById('deleteAdmins_{{ $admin->id }}').submit()} return false">
                                    <i class="fa fa-trash" title="Delete" style="padding-right: 19px;"></i></a>

                                <a href="{{ route('dashboard.status.admins', $admin->id) }}">
                                    <i class="fa @if ($admin->status == 1)fa-ban @else fa-stop @endif"
                                        title="@if ($admin->status == 1)Block @else Active @endif"
                                        style="padding-right: 19px;"></i></a>

                                <a href="{{ route('dashboard.admins.edit',$admin->id) }}">
                                    <i class="fa fa-edit" title="edit"></i></a>
                            </td>
                            <form action="{{ route('dashboard.admins.destroy', $admin->id) }}"
                                id="deleteAdmins_{{ $admin->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            @include('dashboard.admins.store')

                        @empty
                        <tr>
                            <td class="alert alert-info text-center" colspan="9">No admins found.</td>
                        </tr>
                    @endforelse
                    </tr>
                </tbody>
            </table>
            {{ $admins->appends(request()->input())->links() }}
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
@endsection
