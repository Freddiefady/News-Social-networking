@extends('layouts.dashboard.app')
@section('title')
Posts
@endsection
@section('body')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Posts Management</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables post</h6>
    </div>
    @include('dashboard.posts.filter')
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Post title</th>
                        <th>Users</th>
                        <th>Categories</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Post title</th>
                        <th>Users</th>
                        <th>Categories</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse ($posts as $post)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->user->name ?? $post->admin->name}}</td>
                        <td>{{$post->category->name}}</td>
                        <td>{{$post->status == 0 ? 'Not Active' : 'Active'}}</td>
                        <td>{{$post->num_of_views}}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="if(confirm('Do you want delete the post')){document.getElementById('deletePost_{{$post->id}}').submit()} return false"
                            ><i class="fa fa-trash" title="Delete" style="padding-right: 19px;"></i></a>

                            <a href="{{route('dashboard.status.post', $post->id)}}"><i class="fa @if ($post->status == 1)fa-ban @else fa-stop @endif" title="@if ($post->status == 1)Block @else Active @endif" style="padding-right: 19px;"></i></a>

                            <a href="{{route('dashboard.posts.show',['post'=>$post->id, 'page'=>request()->page])}}"><i class="fa fa-eye" title="Show" style="padding-right: 19px;"></i></a>
                            @if ($post->user_id == null)
                            <a href="{{route('dashboard.posts.edit',$post->id)}}"><i class="fa fa-edit" title="Edit"></i></a>
                            @endif
                        </td>
                        <form action="{{route('dashboard.posts.destroy', $post->id)}}" id="deletePost_{{$post->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        @empty
                        <tr>
                            <td class="alert alert-info" colspan="6">No posts found.</td>
                        </tr>
                        @endforelse
                    </tr>
                </tbody>
            </table>
            {{$posts->appends(request()->input())->links()}}
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
@endsection
