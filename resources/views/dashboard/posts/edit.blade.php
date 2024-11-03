@extends('layouts.dashboard.app')
@section('title')
Edit Post
@endsection
@section('body')
<center>
<div class="container-fluid">
<div class="card-header">
    <h2>Edit Post</h2>
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
<form action="{{route('dashboard.posts.update',$post->id)}}" method="post" enctype="multipart/form-data" >
    @csrf
    @method("PUT")
<div class="card shadow mb-4">
    <div class="card-body shadow mb-4">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="{{@old('title',$post->title)}}" placeholder="Enter post title">
                    @error('title')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <textarea type="text" class="form-control" id="postContent" name="description" placeholder="Enter post descriptrion">{!! $post->description !!}</textarea>
                    @error('description')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <textarea type="text" class="form-control" name="small_description" placeholder="Enter small descritption">{{$post->small_description}}</textarea>
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
                    <select name="status" class="form-control">
                        <option selected disabled value="">Status</option>
                        <option value="1" @selected($post->status == 1)>Active</option>
                        <option value="0" @selected($post->status == 0)>Not Active</option>
                    </select>
                    @error('status')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <select name="comment_able" class="form-control">
                        <option selected disabled>Status Comment able</option>
                        <option value="1" @selected($post->comment_able == 1)>Comment able</option>
                        <option value="0" @selected($post->comment_able == 0)>Not commentable</option>
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
                <select name="category_id" class="form-control">
                        <option selected disabled>Select Categories:</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" @selected($category->id == $post->category_id)>{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <strong class="text-danger">{{$message}}</strong>
                    @enderror
            </div>
        </div>
        </div>
        <button type="submit" class="btn btn-success text-center">Update Post</button>
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
            enableResumableUpload: false,
            showUpload: false,
            initialPreviewAsData: true,
            initialPreview: [
                @if ($post->images->count() > 0)
                    @foreach ($post->images as $image)
                        "{{ asset($image->path) }}",
                    @endforeach
                @endif
            ],
            initialPreviewConfig: [
                @if($post->images->count() > 0)
                    @foreach ($post->images as $image)
                        {
                            caption: "{{ $image->path }}",
                            width: '120px',
                            url: "{{ route('dashboard.post.delete' , [$image->id , '_token'=>csrf_token()]) }}",
                            key: "{{ $image->id }}",
                        },
                    @endforeach
            @endif
        ],
        });
            $('#postContent').summernote({
                height: 100,
            });
        });
</script>

@endpush
