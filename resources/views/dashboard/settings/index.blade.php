@extends('layouts.dashboard.app')
@section('title')
Settings
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@section('body')
<div class="d-flex justify-content-center">
    <div class="container-fluid">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <!-- Button trigger modal -->
            <a href="{{route('dashboard.users.index')}}" class="btn btn-primary">
                View All Users
            </a>
        </div>
        <div class="card-header">
            <h2>Create New User</h2>
        </div>
        <form action="{{route('dashboard.settings.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card shadow mb-4">
                <div class="card-body shadow mb-4">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="hidden" name="settings_id" value="{{$getSetting->id}}">
                                <input type="text" class="form-control" name="site_name" value="{{$getSetting->site_name}}" placeholder="Enter Site name">
                                @error('site_name')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" value="{{$getSetting->email}}" placeholder="Enter email">
                                @error('email')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <textarea type="text" name="small_description" class="form-control"
                                    placeholder="Enter your small description..">{{$getSetting->small_description}}</textarea>
                                @error('small_description')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div div class="form-group">
                                <input type="text" name="phone" class="form-control" value="{{$getSetting->phone}}" placeholder="Enter Phone Number">
                                @error('phone')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div div class="form-group">
                                <input type="text" name="youtube" class="form-control" value="{{$getSetting->youtube}}" placeholder="Enter youtube">
                                @error('youtube')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" name="facebook" class="form-control" value="{{$getSetting->facebook}}"
                                    placeholder="Enter facebook page..">
                                @error('facebook')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" name="instagram" class="form-control" value="{{$getSetting->instagram}}"
                                    placeholder="Enter instagram page..">
                                @error('instagram')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" name="twitter" class="form-control" value="{{$getSetting->twitter}}"
                                    placeholder="Enter twitter page..">
                                @error('twitter')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="">favicon</label>
                            <input type="file" name="favicon" class="form-control mb-2 dropify" />
                            @error('favicon')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            <br>
                            <img src="{{asset($getSetting->favicon)}}" class="img-thumbnail">
                        </div>
                        <div class="col-6">
                            <label for="">logo</label>
                            <input type="file" name="logo" class="form-control mb-2 dropify" />
                            <br>
                            <img src="{{asset($getSetting->logo)}}" class="img-thumbnail">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" name="country" class="form-control" value="{{$getSetting->country}}"
                                    placeholder="Enter your country..">
                                @error('country')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" name="city" class="form-control" value="{{$getSetting->city}}"
                                placeholder="Enter your city..">
                                @error('city')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" name="street" class="form-control" value="{{$getSetting->street}}"
                                placeholder="Enter your street..">
                                @error('street')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success text-center">Update settings</button>
                </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
    </script>
@endpush
