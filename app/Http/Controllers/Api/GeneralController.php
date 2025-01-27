<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CommentsCollection;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostsResoucre;
use App\Http\Resources\PostsCollection;
use App\Http\Resources\CategoryCollection;

class GeneralController extends Controller
{
    public function index()
    {
        $query = Post::query()->with(['user', 'category', 'admin', 'images'])
        ->activeUser()
        ->activeCategory()
        ->active();

        if(request()->query('keyword'))
        {
            $query->where(['title', 'description'], 'LIKE', '%'.request()->query('keyword').'%');
        }
        $posts = clone $query->latest()->paginate(4);

        $latest_posts           = $this->latestPosts(clone $query);
        $oldest_posts           = $this->oldestPosts(clone $query);
        $most_read_posts        = $this->mostReadPosts(clone $query);
        $popular_posts          = $this->popularPosts(clone $query);
        $categories_with_posts  = $this->categoriesWithPosts();

        $data = [
            'all_posts'             => (new PostsCollection($posts))->response()->getData(true),
            'latest_posts'          => new PostsCollection($latest_posts),
            'oldest_posts'          => new PostsCollection($oldest_posts),
            'categories_with_posts' => new CategoryCollection($categories_with_posts),
            'most_read_posts'       => new PostsCollection($most_read_posts),
            'popular_posts'         => new PostsCollection($popular_posts),
        ];
        return responseApi($data, 'Response data successfully', 200);
    }
    public function showPosts($slug)
    {
        $post = Post::with(['admin', 'user', 'images', 'category'])->active()->whereSlug($slug)->first();
        if(!$post)
        {
            return responseApi(null, 'Not found post', 404);
        }
        return responseApi(PostsResoucre::make($post), 'Response posts data successfully', 200);
    }
    public function getPostsComments($slug)
    {
        $post = Post::active()->whereSlug($slug)->first();
        if(!$post){
            return responseApi(null, 'Not found post', 404);
        }

        $comments = $post->comments;
        if(!$comments){
            return responseApi(null, 'Not found comments', 404);
        }

        return responseApi(new CommentsCollection($comments), 'Response comments data successfully', 200);
    }
    public function latestPosts($query)
    {
        $latest_posts = $query->latest()->take(4)->get();
        if(!$latest_posts){
            return responseApi(null, 'Not found latest posts', 404);
        }
        return $latest_posts;
    }
    public function oldestPosts($query)
    {
        $oldest_posts = $query->oldest()->take(3)->get();
        if(!$oldest_posts){
            return responseApi(null, 'Not found oldest posts', 404);
        }
        return $oldest_posts;
    }
    public function categoriesWithPosts()
    {
        $categories = Category::active()->get();
        $categories_with_posts = $categories->map(function($category)
        {
            $category->posts = $category->posts()->active()->limit(4)->get();
            return $category;
        });
        if(!$categories_with_posts){
            return responseApi(null, 'Not found categories with posts', 404);
        }
        return $categories_with_posts;
    }
    public function mostReadPosts($query)
    {
        $most_read_posts = $query->orderBy('num_of_views', 'desc')->take(3)->get();
        if(!$most_read_posts){
            return responseApi(null, 'Not found most read posts', 404);
        }
        return $most_read_posts;
    }
    public function popularPosts($query)
    {
        $popular_posts = $query->active()->withCount('comments')
        ->orderBy('comments_count', 'desc')->take(3)->get();
        if(!$popular_posts){
            return responseApi(null, 'Not found popular posts', 404);
        }
        return $popular_posts;
    }
}
