<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\PostsCollection;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $category = Category::active()->get();
        if(!$category){
            return responseApi($category, 'Not Found Category', 404);
        }
        return responseApi(new CategoryCollection($category), 'Response categories data successfully', 200);
    }
    public function getCategoryPosts($slug)
    {
        $category = Category::active()->whereSlug($slug)->first();
        if(!$category){
            return responseApi(null, 'Not Found post', 404);
        }
        $posts = $category->posts;
        if(!$posts){
            return responseApi(null, 'Not found category', status: 404);
        }
        return responseApi(new PostsCollection($posts), 'Response post data successfully', 200);
    }
}
