<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct(){
        $this->middleware('can:home');
    }
    public function __invoke(Request $request)
    {
        // Posts chart
        $posts_chart_options = [
            'chart_title' => 'Posts by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Post',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',
            'filter_field' => 'created_at',
            'filter_days' => 360,
        ];
        $posts_chart = new LaravelChart($posts_chart_options);
        // Users chart
        $users_chart_options = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 360,
        ];
        $users_chart = new LaravelChart($users_chart_options);
        // Comments chart
        $comment_chart_options = [
            'chart_title' => 'Comments by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Comment',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 30, // show only transactions for last 30 days
        ];
        $comment_chart = new LaravelChart($comment_chart_options);
        // Contact chart
        $contact_chart_options = [
            'chart_title' => 'Contact by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Contact',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            'filter_days' => 30,
        ];
        $contact_chart = new LaravelChart($contact_chart_options);

        return view('dashboard.index', compact('posts_chart', 'users_chart', 'comment_chart', 'contact_chart'));
    }
}
