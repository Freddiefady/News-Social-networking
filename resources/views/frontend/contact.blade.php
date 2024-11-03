@extends('layouts.frontend.app')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
    <li class="breadcrumb-item">Contact</li>
@endsection
@section('title', 'Contact-Us')
@section('body')


<!-- Contact Start -->
<div class="contact">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="contact-form">
                    <form action="{{ route('frontend.contact.store') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" />
                                <strong class="text-danger">
                                @error('name')
                                        {{ $message }}
                                    @enderror
                                </strong>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="email" name="email" class="form-control" placeholder="Your Email" />
                                <strong class="text-danger">
                                @error('email')
                                        {{ $message }}
                                    @enderror
                                </strong>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" name="phone" class="form-control" placeholder="Your phone" />
                                <strong class="text-danger">
                                @error('phone')
                                        {{ $message }}
                                    @enderror
                                </strong>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Subject" />
                            <strong class="text-danger">
                                @error('title')
                                        {{ $message }}
                                    @enderror
                                </strong>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="body" rows="5" placeholder="Message"></textarea>
                            <strong class="text-danger">
                                @error('body')
                                        {{ $message }}
                                    @enderror
                                </strong>
                        </div>
                        <div>
                            <button class="btn" type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-info">
                    <h3>Get in Touch</h3>
                    <p class="mb-4">
                        The contact form is currently inactive. Get a functional and
                        working contact form with Ajax & PHP in a few minutes. Just copy
                        and paste the files, add a little code and you're done.
                        <a href="">Download Now</a>.
                    </p>
                    <h4><i class="fa fa-map-marker"></i>{{$getSetting->street}},{{$getSetting->city}}, {{$getSetting->country}}</h4>
                    <h4><i class="fa fa-envelope"></i>{{$getSetting->email}}</h4>
                    <h4><i class="fa fa-phone"></i>{{$getSetting->phone}}</h4>
                    <div class="social">
                        <a href="{{$getSetting->twitter}}"><i class="fab fa-twitter"></i></a>
                        <a href="{{$getSetting->facebook}}"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{$getSetting->instgram}}"><i class="fab fa-instagram"></i></a>
                        <a href="{{$getSetting->youtube}}"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

@endsection
