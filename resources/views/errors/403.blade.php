@extends('layouts.dashboard.app')
@section('title')
403
@endsection
@section('body')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- 403 Error Text -->
                    <div class="text-center">
                        <div class="error mx-auto" data-text="403">403</div>
                        <p class="lead text-gray-800 mb-5">THIS IS ACTION UNAUTHORIZED</p>
                        <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
                        <a href="{{route('dashboard.index')}}">&larr; Back to Dashboard</a>
                    </div>

                </div>
                <!-- /.container-fluid -->
@endsection
