<!DOCTYPE html>
<html lang="en" id="paginate_ajax">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} | @yield('title', 'Home')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Bootstrap News Template - Free HTML Templates" name="keywords" />
    <meta content="@yield('meta_description')" name="description" />

    <!-- Favicon -->
    <link href="{{ asset($getSetting->favicon) }}" rel="icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet" />

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/frontend') }}/lib/slick/slick-theme.css" rel="stylesheet" />
    <link href="{{ asset('assets/frontend') }}/lib/slick/slick.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/frontend/css/style.css') }}" rel="stylesheet" />
    <!-- file input -->
    <link href="{{ asset('assets/vendor/file-input/css/fileinput.min.css') }}" rel="stylesheet" />
    <!-- summernote -->
    <link href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}" rel="stylesheet" />
</head>

<body>
    @include('layouts.frontend.header')

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                @section('breadcrumb')
                @show
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->
    @yield('body')
    @include('layouts.frontend.footer')

    @auth
    <script>
        role = "user";
        userId = "{{auth()->user()->id}}";
        routeShowPost = "{{route('frontend.post.show', ':slug')}}";
    </script>
    @endauth
    <script src="{{ asset('build/assets/app-6757301e.js') }}"></script>
    <!-- Back to Top -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/lib/slick/slick.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>
    <!-- file input -->
    <script src="{{ asset('assets/vendor/file-input/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/file-input/themes/fa5/theme.min.js') }}"></script>
    <!-- summernote -->
    <script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>

    @stack('scripts')
</body>

</html>
