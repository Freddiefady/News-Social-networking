<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="{{config('app.name')}}">

    <title>{{ config('app.name') }} | @yield('title', 'Dashboard')</title>
    <!-- favicon -->
    <link href="{{ asset($getSetting->favicon) }}" rel="icon" />

    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{asset('assets/dashboard/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!-- file input -->
    <link href="{{ asset('assets/vendor/file-input/css/fileinput.min.css') }}" rel="stylesheet" />
    <!-- summernote -->
    <link href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}" rel="stylesheet" />
    <!-- dropify js -->
    @stack('css')
    @livewireStyles
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('layouts.dashboard.sidebar')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        @include('layouts.dashboard.header')
        @yield('body')
    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2021</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{route('dashboard.admin.destroy')}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @auth
    <script>
        role = "admin";
        adminId = "{{auth('admin')->user()->id}}";
    </script>
    @endauth
    <script src="{{ asset('build/assets/app-84615d0a.js') }}"></script>
        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('assets/dashboard')}}/vendor/jquery/jquery.min.js"></script>
        <script src="{{asset('assets/dashboard')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{asset('assets/dashboard')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{asset('assets/dashboard')}}/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="{{asset('assets/dashboard')}}/vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('assets/dashboard')}}/js/demo/chart-area-demo.js"></script>
        <script src="{{asset('assets/dashboard')}}/js/demo/chart-pie-demo.js"></script>
        <!-- file input -->
        <script src="{{ asset('assets/vendor/file-input/js/fileinput.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/file-input/themes/fa5/theme.min.js') }}"></script>
        <!-- summernote -->
        <script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
        @stack('scripts')
        @livewireScripts
    </body>
</html>
