@extends('layouts.dashboard.app')
@section('title')
{{$post->title}}
@endsection
@section('body')
<!-- Page Heading -->
<div class="card-header">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-800">Post: {{$post->title}}</h3>
        <a href="{{route('dashboard.posts.index', ['post' => request()->page])}}"
            class="d-none d-md-inline-block btn btn-md btn-primary shadow-md">
            Back to Posts</a>
    </div>
</div>
<div class="container-fluid card shadow mb-4">
    <div class="card-body shadow mb-4">
        <div class="row">
            <!-- <h3>post Profile</h3>
            <img src="{{asset($post->images()->first()->path)}}" style="width: 20vw;height: 27vh;border-radius: 50% !important;"> -->
            <!-- Carousel -->
            <div id="newsCarousel" class="carousel slide" data-ride="carousel" style="height: 80ch;">
                <ol class="carousel-indicators">
                    <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#newsCarousel" data-slide-to="1"></li>
                    <li data-target="#newsCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    @foreach ($post->images as $image)
                        <div class="carousel-item @if($loop->index == 0) active @endif" style="width: 120ch;">
                            <img src="{{ asset($image->path) }}" class="d-block w-100" alt="First Slide">
                            <div class="carousel-caption d-none d-md-block">
                            </div>
                        </div>
                    @endforeach
                    <!-- Add more carousel-item blocks for additional slides -->
                </div>
                <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="row">
            {{$post->created_at->format('d-m-y h:m')}}
        </div><br>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">Title:</label>
                    <input class="form-control" disabled value="{{$post->title}}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">Slug:</label>
                    <input class="form-control" disabled value="{{$post->slug}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">Descritpion:</label>
                    <textarea class="form-control" disabled value="">{!! $post->description !!}</textarea>
                    <!-- <textarea name="" id="">{!! $post->description !!}</textarea> -->
                </div>
            </div>
            <div class="col-6">
                <div div class="form-group">
                    <label class="form-label">Number of Views:</label>
                    <input class="form-control" disabled value="{{$post->num_of_views}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">Status:</label>
                    <input class="form-control" disabled value="{{$post->status == 1 ? 'Active' : 'Not active'}}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">Comment able:</label>
                    <input class="form-control" disabled
                        value="{{$post->comment_able == 1 ? 'Comment able' : 'Not commentable'}}">
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">Name of the person the post belongs to:</label>
                    <input class="form-control" disabled value="{{$post->user->name ?? $post->admin->name}}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">Name of the category the post belongs to:</label>
                    <input class="form-control" disabled value="{{$post->category->name}}">
                </div>
            </div>
        </div>
        <center>
            <a href="{{route('dashboard.posts.edit', $post->id)}}" class="btn btn-primary">Edit Post <i
                    class="fa fa-edit"></i></a>
            <a href="{{route('dashboard.status.post', $post->id)}}"
                class="btn btn-warning">{{$post->status == 1 ? "Pan" : "Active"}} <i class="fa fa-ban"></i> </a>
            <a href="javascript:void(0)"
                onclick="if(confirm('Do you want delete the post')){document.getElementById('deletePost_{{$post->id}}').submit()} return false"
                class="btn btn-danger">Delete <i class="fa fa-trash"></i></a>
        </center>
        <form action="{{route('dashboard.posts.destroy', $post->id)}}" id="deletePost_{{$post->id}}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
<div class="container-fluid card shadow mb-4">
    <!-- Main Content -->
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <h3 class="page-title">Comments</h3>
            </div>
        </div>
        @if ($post->comment_able == true)
            <div class="comments">

                @forelse ($post->comments as $comment)
                    <div class="alert alert-info">
                        <img src="{{asset($comment->user->image)}}" class="img-thumbnail rounded-3" width="50px">
                        <strong><a class="text-decoration-none"
                                href="{{route('dashboard.users.show', $comment->post->id)}}">{{$comment->user->name}}</a> :
                        </strong> {{$comment->comment}}
                        <strong>{{$comment->created_at->diffForHumans()}}</strong>
                        <div class="float-right">
                            <a href="{{route('dashboard.comment.deleted', $comment->id)}}" id="deleteComment"
                                class="btn btn-outline-danger btn-sm deleteBtnComment">Delete</a>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        Not comments found.
                    </div>
                @endforelse
            </div>
            @if ($post->comments->count() > 2)
                <button id="showMoreBtn" class="btn btn-danger">Show more</button>
            @endif
        </div>
    @else
        <div class="alert alert-info">
            Comments are currently disabled for this post.
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
const asset = "{{asset('')}}";
// const createdAt = "2023-10-01T12:00:00"; // Example date from your backend
// const humanReadable = moment(createdAt).fromNow(); // e.g., "3 days ago"
$(document).on('click', '#showMoreBtn', function (e) {
    e.preventDefault();
    $.ajax({
        url: "{{ route('dashboard.comments.show', parameters: $post->slug) }}",
        type: "GET",
        success: function (data) {
            $('.comments').empty();
            $.each(data, function (key, comment) {
                $('.comments').append(`
                    <div class="alert alert-info">
                    <img src="${asset}${comment.user.image}" class="img-thumbnail rounded-3" width="50px">
                    <strong><a class="text-decoration-none"
                    href="{{route('dashboard.posts.show', $post->id)}}">${comment.user.name}</a> :
                    </strong> ${comment.comment}
                    <strong>${moment(comment.created_at).fromNow()}</strong>
                    <div class="float-right">
                    <a href="{{route('dashboard.comment.deleted', '')}}"/${comment.id}
                    class="btn btn-outline-danger btn-sm">Delete</a>
                    </div>
                    </div>`);
            });
            $('#showMoreBtn').hide();
        }
    });
});
    // delete comment
    //     $(document).on('click', '#deleteComment', function(e)
    //         {
    //             e.preventDefault();
    //             let commentId = $(this).attr('commentId');
    //             $.ajax({
    //                 url: "",
    //                 type: "GET",
    //                 data: {
    //                     '_token':"{{csrf_token()}}",
    //                     'id':commentId
    //                 },
    //                 success: function(data) {
    //                     $('.deleteBtnComment'+data.commentId).remove();
    //                 }
    //             });
    //         });
    </script>
@endpush
