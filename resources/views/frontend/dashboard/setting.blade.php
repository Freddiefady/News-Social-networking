@extends('layouts.frontend.app')
@section('title','Settings')
@section('body')
<br>
<!-- Dashboard Start-->
<div class="dashboard container">
@include('frontend.dashboard._sidebar',['currActiveSettings'=>'active'])
    <!-- Main Content -->
    <div class="main-content">
        <!-- Settings Section -->
        <h2>Settings</h2>
        <section id="settings" class="content-section">
        <form class="settings-form" action="{{route('frontend.dashboard.setting.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="username">Name:</label>
                <input type="text" name="name" id="username" value="{{$user->name}}" />
                @error('name')
                    <strong class="text-danger">{{$message}}</strong>
                @enderror
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="{{$user->username}}" />
                @error('username')
                    <strong class="text-danger">{{$message}}</strong>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{$user->email}}" />
                @error('email')
                    <strong>{{$message}}</strong>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" value="{{$user->phone}}" />
                @error('phone')
                    <strong class="text-danger">{{$message}}</strong>
                @enderror
            </div>
            <div class="form-group">
                <label for="profileImage">Profile Image:</label>
                <input type="file" name="image" id="profileImage" accept="image/*" />
                @error('image')
                    <strong class="text-danger">{{$message}}</strong>
                @enderror
            </div>
            <div class="form-group">
                <img src="{{ asset($user->image) }}" width="180px" alt="{{$user->username}}"
                    id="profileImagePreview" class="img-thumbnail">
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" name="country" id="country" placeholder="Enter your country" value="{{$user->country}}" />
                @error('country')
                    <strong class="text-danger">{{$message}}</strong>
                @enderror
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" name="city" id="city" placeholder="Enter your city" value="{{$user->city}}"/>
                @error('city')
                    <strong class="text-danger">{{$message}}</strong>
                @enderror
            </div>
            <div class="form-group">
                <label for="street">Street:</label>
                <input type="text" name="street" id="street" placeholder="Enter your street" value="{{$user->street}}"/>
                @error('street')
                    <strong class="text-danger">{{$message}}</strong>
                @enderror
            </div>
            <button type="submit" class="save-settings-btn">
                Save Changes
            </button>
        </form>

        <!-- Form to change the password -->
        <form class="change-password-form" action="{{route('frontend.dashboard.setting.store')}}" method="POST">
            @csrf
            <h2>Change Password</h2>
            <div class="form-group">
                <label for="current-password">Current Password:</label>
                <input type="password" name="current_password" id="current-password" placeholder="Enter Current Password" />
                @error('current_password')
                    <strong class="text-danger">{{$message}}</strong>
                @enderror
            </div>
            <div class="form-group">
                <label for="new-password">New Password (8 characters minimum):</label>
                <input type="password" name="password" id="new-password" placeholder="Enter New Password" autocomplete="new-password"/>
                @error('password')
                    <strong class="text-danger">{{$message}}</strong>
                @enderror
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm New Password:</label>
                <input type="password" name="password_confirmation" id="confirm-password" placeholder="Enter Confirm New " autocomplete="new-password"/>
            </div>
            <button type="submit" class="change-password-btn">
                Change Password
            </button>
        </form>
        </section>
    </div>
</div>
<br>
<!-- Dashboard End-->
@endsection
@push('scripts')
<script>
    $(document).on('change', '#profileImage', function(){
        var file = $this.files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                $('#profileImagePreview').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
