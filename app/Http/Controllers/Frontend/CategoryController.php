<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($slug)
    {
        $category = Category::active()->whereSlug($slug)->first();
        if(!$category)
        {
            abort(404);
        }
        $posts = $category->posts()->active()->paginate(9);

        return view('frontend.category', compact('posts', 'category'));
    }
}
