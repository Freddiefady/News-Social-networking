<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Notifications\NewCommentNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    public function show($slug)
    {
        $singlePost = Post::active()->with(['comments'=> function($query){
            $query->latest()->limit(3);
        }])->whereSlug($slug)->first();
        $category = $singlePost->category;
        
        if(!$singlePost)
        {
            abort(404);
        }
        $posts_belongs_to_category = $category->posts()->active()->select('id', 'title', 'slug')->limit(5)->get();
        $singlePost->increment('num_of_views');

        return view('frontend.single-page', compact('singlePost', 'posts_belongs_to_category', 'category'));
    }
    public function readMoreComments($slug)
    {
        $post = Post::active()->whereSlug($slug)->first();
        $comments = $post->comments()->with('user')->get();
        return response()->json($comments);
    }

    public function storeComment(Request $request)
    {
        // Validate the comment data before saving it.
        $request->validate([
            'user_id'=>['required', 'exists:users,id'],
            'comment'=>['required', 'string', 'max:200'],
        ]);

        $comment = Comment::create([
            'user_id'=>$request->user_id,
            'post_id'=>$request->post_id,
            'comment'=>$request->comment,
            'ip_address'=>$request->ip(),
        ]);
        $post = Post::findOrFail($request->post_id);
        /**
         * //send notification for all users
         * $users = User::where('id', '!=', auth()->user()->id);
         * Notification::send($users, new NewCommentNotify($comment, $post));
         */
            // send notification for single user
            if(auth()->user()->id != $request->user_id)
            {
                $post->user->notify(new NewCommentNotify($comment, $post));
            }

        $comment->load('user');
        if(!$comment)
        {
            return response()->json([
                'data'=>'Error while adding comment.',
                'status'=> 403
            ]);
        }
        return response()->json([
            'msg'=>'Comment added successfully.',
            'comment'=>$comment,
            'status'=> 201
        ]);
    }
}
