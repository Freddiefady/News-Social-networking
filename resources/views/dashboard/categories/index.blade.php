@extends('layouts.dashboard.app')
@section('title')
Categories
@endsection
@section('body')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Table Categories</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Categories Managemnet</h6>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-category">
                    Create Category
                </button>
            </div>
        </div>
        @include('dashboard.categories.filter')
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Posts Count</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Posts Count</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->status == 0 ? 'Not Active' : 'Active'}}</td>
                                <td>{{$category->posts_count}}</td>
                                <td>{{$category->created_at}}</td>
                                <td>
                                    <a href="javascript:void(0)"
                                        onclick="if(confirm('Do you want delete the category')){document.getElementById('deleteCategory_{{$category->id}}').submit()} return false"><i
                                            class="fa fa-trash" title="Delete" style="padding-right: 19px;"></i></a>
                                    <a href="{{route('dashboard.status.category', $category->id)}}">
                                        <i class="fa @if($category->status == 1) fa-ban @else fa-stop @endif "
                                            title="@if($category->status == 1) Block @else Active @endif "
                                            style="padding-right: 19px;"></i></a>
                                    <a href="javascript:void(0)" id=""><i class="fa fa-edit" title="edit"
                                            data-toggle="modal" data-target="#edit-category-{{$category->id}}"></i></a>
                                </td>
                                <form action="{{route('dashboard.categories.destroy', $category->id)}}"
                                    id="deleteCategory_{{$category->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @include('dashboard.categories.store')
                                @include('dashboard.categories.edit')
                        @empty
                            <tr>
                                <td class="alert alert-info" colspan="6">No Categories found.</td>
                            </tr>
                        @endforelse
                        </tr>
                    </tbody>
                </table>
                {{$categories->appends(request()->input())->links()}}
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
