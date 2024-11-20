<?php

namespace App\Http\Controllers\Api\Auth\Account;

use App\Utils\ImageManager;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentsResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostsCollection;
use App\Models\Post;
use App\Notifications\NewCommentNotify;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        // Retrieve all posts
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return responseApi(null, 'No users found.', 404);
        }

        $posts = $user->posts()->active()->activeCategory()->get();
        if (!$posts) {
            return responseApi(null, 'No posts found.', 404);
        }
        return responseApi(new PostsCollection($posts), 'Response posts data successfully', 200);
    }
    public function store(PostRequest $request)
    {
        $request->validated();
        try{
            DB::beginTransaction();
            $post = auth()->user()->posts()->create($request->except('images'));
            ImageManager::UploadImages($request,null,$post);
            if (!$post) {
                return responseApi(null, 'Failed to create post.', 500);
            }
            DB::commit();
            Cache::forget('read_more_posts');
            cache::forget('last_post');
            return responseApi($post, 'Post created successfully', 201);
        }catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to store post'. $e->getMessage());
            return responseApi(null, 'Failed to create post.', 500);
        }
    }
    public function update(PostRequest $request, $post_id)
    {
        $request->validated();
        try{
            DB::beginTransaction();
            $post = auth()->user()->posts()->whereId($post_id)->first();
            if (!$post) {
                return responseApi(null, 'Post not found.', 404);
            }
            $post->update($request->except(['_method', 'images']));
            //check if old post has image or no
            if ($request->hasFile('images'))
            {
                ImageManager::deleteImages($post);
                ImageManager::UploadImages($request, null, $post);
            }
            DB::commit();
            return responseApi($post, 'Post updated successfully', 200);
        }catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update post'. $e->getMessage());
            return responseApi(null, 'Failed to update post.', 500);
        }
    }
    public function destroy($post_id)
    {
        $post = auth()->user()->posts()->whereId($post_id)->first();
        if (!$post) {
            return responseApi(null, 'Post not found.', 404);
        }
        ImageManager::deleteImages($post);
        $post->delete();
        return responseApi(null, 'Post deleted successfully', 204);
    }
    public function getComments($post_id)
    {
        $post = auth()->user()->posts()->whereId($post_id)->first();
        if (!$post) {
            return responseApi(null, 'Post not found.', 404);
        }

        if ($post->comments->count() > 0) {
            return responseApi(CommentsResource::collection($post->comments), 'There are comments for the post', 200);
        }
        return responseApi(null, 'There are no comments for the post.', 404);
    }
    public function addComment(Request $request)
    {
        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'comment' => 'required|string|max:200',
        ]);

        $post = Post::find($request->post_id);
        if (!$post) {
            return responseApi(null, 'Post not found.', 404);
        }

        $comment = $post->comments()->create([
            'user_id' => auth()->user()->id,
            'comment' => $request->comment,
            'ip_address' => $request->ip(),
        ]);
        if (!$comment) {
            return responseApi(null, 'Failed to add comment.', 500);
        }
        // send notification for single user
        if(auth()->user()->id != $post->user_id) {
            $post->user->notify(new NewCommentNotify($comment, $post));
        }
        return responseApi(null, 'Comment added successfully', 201);
    }
}
