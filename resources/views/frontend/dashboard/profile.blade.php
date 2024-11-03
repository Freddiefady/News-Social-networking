@extends('layouts.frontend.app')
@section('title', 'Profile')
@section('body')
<!-- Profile Start -->
<br><div class="dashboard container">
<!-- Sidebar -->
@include('frontend.dashboard._sidebar',['currActiveProfile'=>'active'])
    <!-- Main Content -->
    <div class="main-content">
        <!-- Profile Section -->
        <section id="profile" class="content-section active">
            <h2>User Profile</h2>
            <div class="user-profile mb-3">
                <img src="{{ asset(Auth::guard()->user()->image ) }}" alt="User Image" class="profile-img rounded-circle" style="width: 100px; height: 100px;" />
                <span class="username">{{ Auth::guard('web')->user()->name }}</span>
            </div>
            <br>

            <!-- handle errors -->
            @if (session()->has('errors'))
                <div class="alert alert-danger">
                    @foreach (session('errors')->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif
            <!-- Add Post Section -->
            <form action="{{ route('frontend.dashboard.post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <section id="add-post" class="add-post-section mb-5">
                <h2>Add Post</h2>
                <div class="post-form p-3 border rounded">
                    <!-- Post Title -->
                    <input type="text" name="title" id="postTitle" class="form-control mb-2" placeholder="Post Title" />

                    <!-- Post Content -->
                    <textarea id="postContent" name="description" class="form-control mb-2" rows="3"
                        placeholder="What's on your mind?"></textarea>

                    <!-- Small Post Content -->
                    <textarea id="smallPostContent" name="small_description" class="form-control mb-2" rows="3"
                        placeholder="Here Small Description"></textarea>

                    <!-- Image Upload -->
                    <input type="file" id="postImage" name="images[]" class="form-control mb-2" accept="image/*" multiple />
                    <div class="tn-slider mb-2">
                        <div id="imagePreview" class="slick-slider"></div>
                    </div>

                    <!-- Category Dropdown -->
                    <select id="postCategory" name="category_id" class="form-select">
                        <option value="" selected>Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select><br>

                    <!-- Enable Comments Checkbox -->
                    <label class="label">
                    Enable Comments : <input type="checkbox" name="comment_able" class="" />
                    </label><br>

                    <!-- Post Button -->
                    <button type="submit" class="btn btn-primary post-btn">Post</button>
                </div>
                </section>
            </form>
            <!-- Show Recent Posts -->
            <section id="posts" class="posts-section">
                <h2>Recent Posts</h2>
                <div class="post-list">
                    <!-- Post Item -->
                    @forelse ($showPostsOfUser as $post)
                    <div class="post-item mb-4 p-3 border rounded">
                        <div class="post-header d-flex align-items-center mb-2">
                            <img src="{{ asset(Auth::guard()->user()->image) }}" alt="User Image" class="rounded-circle" style="width: 50px; height: 50px;" />
                            <div class="ms-3">
                                <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <h4 class="post-title">{{ $post->title }}</h4>
                        <p class="post-content">{!! chunk_split($post->description,50) !!}</p>

                        <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#newsCarousel" data-slide-to="0" class="@if ($loop->index==0) active @endif"></li>
                                <li data-target="#newsCarousel" data-slide-to="1"></li>
                                <li data-target="#newsCarousel" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($post->images as $image)
                                    <div class="carousel-item @if ($loop->index==0) active @endif">
                                        <img src="{{ asset($image->path) }}" class="d-block w-100" alt="First Slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>{{ $post->title }}</h5>
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

                        <div class="post-actions d-flex justify-content-between">
                            <div class="post-stats">
                                <!-- View Count -->
                                <span class="me-3">
                                    <i class="fas fa-eye"></i> {{ $post->num_of_views }}
                                </span>
                            </div>

                            <div>
                                <a href="{{ route('frontend.dashboard.post.edit', $post->slug) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="javascript:void(0)" onclick="if(confirm('Are you want delete post.?')){document.getElementById('deleteID_{{$post->id}}').submit()} return false" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                                <button id="showComments" post-id="{{$post->id}}" class="btn btn-sm btn-outline-secondary hideBtn_{{ $post->id }}">
                                    <i class="fas fa-comment"></i> Comments
                                </button>
                                <button id="hideComments" post-id="{{$post->id}}" class="btn btn-sm btn-outline-secondary hideComments_{{ $post->id }}" style="display: none;">
                                    <i class="fas fa-comment"></i> Hide Comments
                                </button>

                                <form id="deleteID_{{$post->id}}" action="{{ route('frontend.dashboard.post.destroy', $post->slug) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="slug" value="{{ $post->slug }}">
                                </form>
                            </div>
                        </div>

                        <!-- Display Comments -->
                        <div class="comments_{{$post->id}}" post-id="{{$post->id}}" id="displayComment_{{ $post->id }}" style="display:none">

                            <!-- Add more comments here for demonstration -->
                        </div>
                    </div>

                    @empty
                    <div class="alert alert-info">No posts found.</div>
                    @endforelse
                    <!-- Add more posts here dynamically -->
                </div>
            </section>
        </section>
    </div>
</div>
<br>
<!-- Profile End -->
@push('scripts')
    <script>
    var asset = "{{asset('') }}";
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
            //show comment on recent posts
            $(document).on('click', '#showComments', function(e)
                {
                    e.preventDefault();
                    var postId = $(this).attr('post-id');
                    $.ajax({
                        type: 'GET',
                        url: "{{route('frontend.dashboard.post.show', ':postId')}}".replace(':postId', postId),
                        success: function(response)
                        {
                            $('#displayComment_'+ postId).empty();
                            $.each(response.data, function(indexInArray, comment)
                                {
                                    $('#displayComment_'+ postId).append(`
                                    <div class="comment">
                                        <img src="${asset}${comment.user.image}" alt="${comment.user.username}" class="comment-img" />
                                        <div class="comment-content">
                                            <span class="username">${comment.user.name}</span>
                                            <p class="comment-text">${comment.comment}</p>
                                        </div>
                                    </div>`).show();
                                });
                                $('.hideBtn_' + postId).hide();
                                $('.hideComments_' + postId).show();
                        }
                    });
                }
            );
            //Hide comments from the comments list
            $(document).on('click', '#hideComments', function(e)
            {
                e.preventDefault();
                var postId = $(this).attr('post-id');
                // 1- hide comments
                $('.comments_' + postId).hide();
                // hide (Hide comments Btn)
                $('.hideComments_' + postId).hide();
                // 3- show Btn Comments
                $('.hideBtn_' + postId).show();
            });
        });
    </script>
@endpush
@endsection
