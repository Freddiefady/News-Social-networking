<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\RelatedNewsSite;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        $relatedSites = RelatedNewsSite::select('name', 'url')->get();
        $categories = Category::select('id', 'slug', 'name')->active()->get();

        view()->share([
            'relatedSites' => $relatedSites,
            'categories'=>$categories,
        ]);
    }
}
