@extends('layouts.dashboard.app')
@section('title')
Realted Links
@endsection
@section('body')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Table R-Links</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Realted Managemnet</h6>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-link">
                    Create R-Links
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>URL</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>URL</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($links as $link)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$link->name}}</td>
                                <td>{{$link->url}}</td>
                                <td>
                                    <a href="javascript:void(0)"
                                        onclick="if(confirm('Do you want delete the link')){document.getElementById('deletelink_{{$link->id}}').submit()} return false"><i
                                            class="fa fa-trash" title="Delete" style="padding-right: 19px;"></i></a>
                                    <a href="javascript:void(0)" id=""><i class="fa fa-edit" title="edit"
                                            data-toggle="modal" data-target="#edit-link-{{$link->id}}"></i></a>
                                </td>
                                <form action="{{route('dashboard.related.destroy', $link->id)}}"
                                    id="deletelink_{{$link->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @include('dashboard.related.store')
                                @include('dashboard.related.edit')
                        @empty
                            <tr>
                                <td class="alert alert-info" colspan="6">No links found.</td>
                            </tr>
                        @endforelse
                        </tr>
                    </tbody>
                </table>
                {{$links->appends(request()->input())->links()}}
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
