@extends('layouts.frontend.app')
@section('title', 'Notification')
@section('body')
<!-- Dashboard Start-->
<div class="dashboard container">
@include('frontend.dashboard._sidebar',['currActiveNotify'=>'active'])
    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h3 class="page-title">Notifications</h3>
                </div>
                <div class="col-6 d-md-flex justify-content-md-end mb-2">
                    <a href="{{route('frontend.dashboard.notification.destroyAll')}}" class="btn btn-md btn-danger">Delete All</a>
                </div>
            </div>
        </div>
        @forelse (auth()->user()->notifications as $notify)
        <a href="{{$notify->data['url']}}?notify={{$notify->id}}">
            <div class="notification alert alert-info">
                <strong class="color">You have a notification from : {{$notify->data['user_name']}}</strong> Post title : {{ $notify->data['post_title'] }}
                <pre></pre>{{$notify->created_at->diffForHumans()}}
                <div class="float-right">
                <form action="{{route('frontend.dashboard.notification.destroy', $notify->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
            </form>
                </div>
            </div>
        </a>

        @empty
        <div class="alert alert-info">
            No new notifications found.
        </div>
        @endforelse
    </div>
</div>
<br>
<!-- Dashboard End-->
@endsection
