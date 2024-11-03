<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $posts = Post::active()->with('images')->latest()->paginate(9);
        $greatest_posts_views = Post::active()->orderBy('num_of_views', 'desc')->limit(3)->get();
        $oldest_posts_news = Post::active()->oldest()->limit(3)->get();

        $greatest_posts_comments = Post::active()->withCount('comments')
        ->orderBy('comments_count', 'desc')
        ->take(3)->get();

        $categories = Category::has('posts', '>=', 2)->active()->get();
        $categories_with_posts = $categories->map(function($category){
            $category->posts = $category->posts()->active()->limit(4)->get();
            return $category;
        });

        return view('frontend.index', compact('posts' , 'greatest_posts_views', 'oldest_posts_news', 'greatest_posts_comments', 'categories_with_posts'));
    }
}
