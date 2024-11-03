@extends('layouts.dashboard.app')
@section('title')
Create Post
@endsection
@section('body')
<center>
<div class="container-fluid">
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <!-- Button trigger modal -->
                <a href="{{route('dashboard.posts.index')}}" class="btn btn-primary">
                    View All Posts
                </a>
            </div>
<div class="card-header">
    <h2>Create New Post</h2>
    @if(session()->has('errors'))
    <div class="alert alert-danger">
        <ul>
            @foreach (session('errors')->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<form action="{{route('dashboard.posts.store')}}" method="post" enctype="multipart/form-data" >
    @csrf
<div class="card shadow mb-4">
    <div class="card-body shadow mb-4">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="{{@old('title')}}" placeholder="Enter post title">
                    @error('title')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <textarea type="text" class="form-control" id="postContent" name="description" value="{{@old('description')}}" placeholder="Enter post descriptrion"></textarea>
                    @error('description')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <textarea type="text" class="form-control" name="small_description" value="{{@old('small_description')}}" placeholder="Enter small descritption"></textarea>
                    @error('small_description')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            <input type="file" id="postImage" name="images[]" class="form-control mb-2" multiple/>
            @error('images[]')
            <strong class="text-danger">{{$message}}</strong>
            @enderror
            </div>
        </div><br>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <select name="status" value="{{@old('status')}}" class="form-control">
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
                    <select name="comment_able" value="{{@old('comment_able')}}" class="form-control">
                        <option selected disabled>Status Comment able</option>
                        <option value="1">Comment able</option>
                        <option value="0">Not commentable</option>
                    </select>
                    @error('comment_able')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                <select name="category_id" value="{{@old('category_id')}}" class="form-control">
                        <option selected disabled>Select Categories:</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
            </div>
        </div>
        </div>
        <button type="submit" class="btn btn-success text-center">Create Post</button>
    </div>
</div>
</form>
</div>
</center>
@endsection
@push('scripts')
<script>
    $(function()
        {
            $('#postImage').fileinput({
                theme: 'fa5',
                allowedFileTypes: ['image'],
                maxFileCount: 5,
                showUpload:false,
            });
            $('#postContent').summernote({
                height: 100,
            });
        });
</script>

@endpush
