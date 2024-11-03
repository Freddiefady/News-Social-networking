@extends('layouts.frontend.app')
@section('breadcrumb')
    @parent
@endsection
@section('body')
@php
    $lastest_three_posts = $posts->take(3);
@endphp
    <!-- Top News Start-->
    <div class="top-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6 tn-left">
                    <div class="row tn-slider">
                        @foreach ($lastest_three_posts as $post)
                        <div class="col-md-6">
                            <div class="tn-img">
                                <img src="{{ asset($post->images->first()->path) }}" />
                                <div class="tn-title">
                                    <a href="{{ route('frontend.post.show', $post->slug) }}" title="{{ $post->title }}">{{ $post->title }}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 tn-right">
                    @php
                    $four_posts = $posts->take(4);
                    @endphp
                    <div class="row">
                        @foreach ($four_posts as $post)
                        <div class="col-md-6">
                            <div class="tn-img">
                                <img src="{{ $post->images->first()->path }}" />
                                <div class="tn-title">
                                    <a href="{{ route('frontend.post.show', $post->slug) }}" title="{{ $post->title }}">{{ $post->title }}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top News End-->

    <!-- Category News Start-->
    <div class="cat-news">
        <div class="container">
            <div class="row">
                @foreach ($categories_with_posts as $category)
                    <div class="col-md-6">
                        <h2>{{ $category->name }}</h2>
                        <div class="row cn-slider">
                            @foreach ($category->posts as $post)
                            <div class="col-md-6">
                                <div class="cn-img">
                                    <img src=" {{ asset($post->images->first()->path) }}" />
                                    <div class="cn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}" title="{{ $post->title }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Category News End-->

    <!-- Tab News Start-->
    <div class="tab-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#featured">oldest News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#popular">Popular News</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="featured" class="container tab-pane active">
                            @foreach ($oldest_posts_news as $post)
                            <div class="tn-news">
                                <div class="tn-img">
                                    <img src="{{ asset($post->images->first()->path) }}" />
                                </div>
                                <div class="tn-title">
                                    <a href="{{ route('frontend.post.show', $post->slug) }}" title="{{ $post->title }}">{{ $post->title }}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div id="popular" class="container tab-pane fade">
                            @foreach ($greatest_posts_comments as $post)
                            <div class="tn-news">
                                <div class="tn-img">
                                    <img src="{{ asset($post->images->first()->path) }}" />
                                </div>
                                <div class="tn-title">
                                    <a href="{{ route('frontend.post.show', $post->slug) }}" title="{{ $post->title }}">{{ $post->title }}({{ $post->comments_count }})</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#m-viewed">Most Viewed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#m-read">Lastest News</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="m-viewed" class="container tab-pane active">
                            @foreach ($greatest_posts_views as $view)
                            <div class="tn-news">
                                <div class="tn-img">
                                    <img src=" {{ asset($view->images->first()->path) }}" />
                                </div>
                                <div class="tn-title">
                                    <a href="{{ route('frontend.post.show', $post->slug) }}" title="{{ $post->title }}">{{ $view->title }}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div id="m-read" class="container tab-pane fade">
                            @foreach ($lastest_three_posts as $post)
                            <div class="tn-news">
                                <div class="tn-img">
                                    <img src=" {{ asset($post->images->first()->path) }}" />
                                </div>
                                <div class="tn-title">
                                    <a href="{{ route('frontend.post.show', $post->slug) }}" title="{{ $post->title }}">{{ $post->title }}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tab News Start-->

    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @foreach ($posts as $post)
                        <div class="col-md-4">
                            <div class="mn-img">
                                <img src="{{ asset($post->images->first()->path) }}" />
                                <div class="mn-title">
                                    <a href="{{ route('frontend.post.show', $post->slug) }}" title="{{ $post->title }}">{{ $post->title }}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div id="paginate">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Read More</h2>
                        <ul>
                            @foreach ($read_more_posts as $post)
                            <li><a href="{{ route('frontend.post.show', $post->slug) }}" title="{{ $post->title }}">{{ $post->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
    @endsection
    @push('scripts')
    <script type="text/javascript">
        $(document).on('click', '#paginate a', function(e)
        {
            e.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
                success: function(data)
                {
                    $('#paginate_ajax').html(data);
                }
            });
        });
    </script>
    @endpush
