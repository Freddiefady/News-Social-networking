@extends('layouts.frontend.app')
@section('title')
Edit: {{$post->title}}
@endsection
@section('body')
<div class="dashboard container">
    <!-- Sidebar -->
    @include('frontend.dashboard._sidebar',['currActiveProfile'=>'active'])
    <!-- Main Content -->
    <div class="main-content col-md-9">
        <!-- Show/Edit Post Section -->
        <form action="{{route('frontend.dashboard.post.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <section id="posts-section" class="posts-section">
                @if (session()->has('errors'))
                    <div class="alert alert-danger">
                        @foreach (session('errors')->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <h2>Your Posts</h2>
                <ul class="list-unstyled user-posts">
                    <!-- Example of a Post Item -->
                    <li class="post-item">
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <!-- Editable Title -->
                        <input type="text" name="title" class="form-control mb-2 post-title" value="{{$post->title}}" />

                        <!-- Editable Description -->
                        <textarea id="postContent" name="description" class="form-control mb-2 post-content">{!! $post->description !!}</textarea>

                        <!-- Editable Small Description -->
                        <textarea id="smallPostContent" name="small_description" class="form-control mb-2" rows="3"
                        placeholder="Here Small Description">{{ $post->small_description ?? ''}}</textarea>

                        <!-- Image Upload Input for Editing -->
                        <input type="file" name="images[]" id="postImages" class="form-control mt-2 edit-post-image" accept="image/*"
                            multiple />

                        <!-- Editable Category Dropdown -->
                        <select class="form-control mb-2 post-category" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" @selected($category->id == $post->category_id)>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>

                        <!-- Editable Enable Comments Checkbox -->
                        <div class="form-check mb-2">
                            <input name="comment_able" @checked($post->comment_able == 1)
                                class="form-check-input enable-comments" type="checkbox" />
                            <label class="form-check-label">
                                Enable Comments
                            </label>
                        </div>

                        <!-- Post Meta: Views and Comments -->
                        <div class="post-meta d-flex justify-content-between">
                            <span name="num_of_views" class="views">
                                <i class="fas fa-eye"></i> {{$post->num_of_views}}
                            </span>
                            <span class="post-comments">
                                <i class="fas fa-comment"></i> {{$post->comments->count()}}
                            </span>
                        </div>

                        <!-- Post Actions -->
                        <div class="post-actions mt-2">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{route('frontend.dashboard.profile')}}" class="btn btn-secondary cancel-edit-btn">
                                Cancel
                            </a>

                        </div>

                    </li>
                    <!-- Additional posts will be added dynamically -->
                </ul>
            </section>
        </form>
    </div>
</div>
<br>
@endsection
@push('scripts')
    <script>
        $('#postImages').fileinput({
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
                            url: "{{ route('frontend.dashboard.post.delete' , [$image->id , '_token'=>csrf_token()]) }}",
                            key: "{{ $image->id }}",
                        },
                    @endforeach
            @endif
        ],
        });
        $('#postContent').summernote({
            height: 100,
        });
    </script>
@endpush
