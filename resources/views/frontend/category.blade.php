@extends('layouts.frontend.app')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
    <li class="breadcrumb-item">{{$category->name}}</li>
@endsection
@section('title')
{{ $category->name }}
@endsection
@section('body')
<div class="main-news">
    <br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @forelse ($posts as $post)
                        <div class="col-md-4">
                            <div class="mn-img">
                                <img src="{{ $post->images->first()->path }}" />
                                <div class="mn-title">
                                    <a href="{{ route('frontend.post.show', $post->slug) }}" title="{{ $post->title }}">{{ $post->title }}</a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="container-fluid">
                            <div class="text-center" style="top: 50%;position: absolute;right: 50%;">
                                No posts found.
                            </div>
                        </div>
                        @endforelse
                    </div>
                    {{ $posts->links() }}
                </div>
                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Other More</h2>
                        <ul>
                            @foreach ($categories as $category)
                            <li><a href="{{ route('frontend.category', $category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
