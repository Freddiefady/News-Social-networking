@extends('layouts.dashboard.app')
@section('title')
@section('body')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    @livewire('admin.statistics')
    <!-- Content Row -->
    <div class="row">
        <!-- Post Chart -->
        <div class="shadow col-6 mb-4">
            <div class="card-body">
                <h1>{{ $posts_chart->options['chart_title'] }}</h1>
                {!! $posts_chart->renderHtml() !!}
            </div>
        </div>
        <!-- Users Chart -->
        <div class="shadow col-6 mb-4">
            <div class="card-body">
                <h1>{{ $users_chart->options['chart_title'] }}</h1>
                {!! $users_chart->renderHtml() !!}
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Comments Chart -->
        <div class="shadow col-6 mb-4">
            <div class="card-body">
                <h1>{{ $comment_chart->options['chart_title'] }}</h1>
                {!! $comment_chart->renderHtml() !!}
            </div>
        </div>
        <!-- Contact Chart -->
        <div class="shadow col-6 mb-4">
            <div class="card-body">
                <h1>{{ $contact_chart->options['chart_title'] }}</h1>
                {!! $contact_chart->renderHtml() !!}
            </div>
        </div>

    </div>
        <!-- Posts && Comments -->
        @livewire('admin.latest-posts-comments')

    <!-- /.container-fluid -->
    @endsection
    @push('scripts')
        {!! $posts_chart->renderChartJsLibrary() !!}
        {!! $posts_chart->renderJs() !!}
        {!! $users_chart->renderJs() !!}
        {!! $comment_chart->renderJs() !!}
        {!! $contact_chart->renderJs() !!}
    @endpush
