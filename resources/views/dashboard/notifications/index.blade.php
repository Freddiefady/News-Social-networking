@extends('layouts.dashboard.app')
@section('title')
All notifications
@endsection
@section('body')
<div class="container-fluid card shadow mb-4">
    <!-- Main Content -->
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h3 class="h3 mb-0 text-gray-800">Notifications</h3>
                    <a href="{{route('dashboard.alertify.destroyAll')}}"
                        class="d-none d-md-inline-block btn btn-md btn-danger shadow-md">
                        Delete all alerts</a>
                </div>
            </div>
        </div>
        @forelse ($alerts as $alert)
            <div class="alert alert-info">
                <!-- <img src="" class="img-thumbnail rounded-3" width="50px"> -->
                <strong><a class="text-decoration-none"
                        href="{{$alert->data['url']}}?notifyAdmin={{$alert->id}}">{{$alert->data['user_name']}}</a> :
                </strong> {{$alert->data['contact_title']}}
                <strong>{{$alert->created_at->diffForHumans()}}</strong>
                <div class="float-right">
                    <a href="{{route('dashboard.alertify.destroy', $alert->id)}}"
                        class="btn btn-outline-danger btn-sm deleteBtnComment">Delete</a>
                </div>
            </div>
        @empty
            <div class="alert alert-info">
                No alerts found.
            </div>
        @endforelse
    </div>
</div>
@endsection
