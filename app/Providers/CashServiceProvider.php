<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CashServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Cache::forget('read_more_posts');
        //Cache latest_posts in index blade page
        if(!Cache::has('latest_posts'))
        {
            $latest_posts = Post::select('id', 'title', 'slug')->latest()->limit(5)->get();
            Cache::remember('latest_posts', 3600, function() use($latest_posts)
            {
                return $latest_posts;
            });
        }
        //Cache Greatest Posts With Comment Count in Single Page Blade & popular
        if(!Cache::has('greatest_posts_comments'))
        {
            $greatest_posts_comments = Post::select('id', 'title','slug')->withCount('comments')
            ->orderBy('comments_count', 'desc')->take(5)->get();
            Cache::remember('greatest_posts_comments', 3600, function() use($greatest_posts_comments)
            {
                return $greatest_posts_comments;
            });
        }
        //Cache Read More Posts in index page
        if(!Cache::has('read_more_posts')){
            $read_more_posts = Post::select('id', 'slug', 'title')->latest()->limit(10)->get();
            Cache::remember('read_more_posts', 3600, function () use ($read_more_posts) {
                return $read_more_posts;
            });
        }
        //Get Data From cache
        $latest_posts = Cache::get('latest_posts');
        $greatest_posts_comments = Cache::get('greatest_posts_comments');
        $read_more_posts = Cache::get('read_more_posts');

        view()->share([
            'read_more_posts' => $read_more_posts,
            'latest_posts'=> $latest_posts,
            'greatest_posts_comments'=> $greatest_posts_comments,
        ]);
    }
}
