@extends('layouts.dashboard.app')
@section('title')
Roles
@endsection
@section('body')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Roles</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables for roles</h6>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <!-- Button trigger modal -->
            <a href="{{route('dashboard.authorization.create')}}" class="btn btn-primary">
                Create new role
            </a>
        </div>
    </div>
    <!-- @include('dashboard.admins.filter') -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Role name</th>
                        <th>Permissions</th>
                        <th>Related admins</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Role name</th>
                        <th>Permissions</th>
                        <th>Related admins</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse($authorizations as $authorization)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $authorization->role }}</td>
                            <td>
                                @foreach ($authorization->permissions as $permission)
                                    {{$permission}},
                                @endforeach
                            </td>
                            <td>{{ $authorization->admins->count()}}</td>
                            <td>{{ $authorization->created_at->format('d-m-y h:m a') }}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="if(confirm('Do you want delete the authorization')){document.getElementById('deleteAuthorizations_{{ $authorization->id }}').submit()} return false">
                                    <i class="fa fa-trash" title="Delete" style="padding-right: 19px;"></i></a>

                                <a href="javascript:void(0)">
                                    <i class="fa fa-edit" data-toggle="modal" data-target="#edit-roles_{{$authorization->id}}" title="Edit"></i></a>
                            </td>
                            <form action="{{ route('dashboard.authorization.destroy', $authorization->id) }}"
                                id="deleteAuthorizations_{{ $authorization->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            @include('dashboard.authorization.edit')
                        @empty
                        <tr>
                            <td class="alert alert-info" colspan="6">No roles found.</td>
                        </tr>
                    @endforelse
                    </tr>
                </tbody>
            </table>
            {{ $authorizations->appends(request()->input())->links() }}
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
@endsection
