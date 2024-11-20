<?php

namespace App\Http\Controllers\Dashboard\Posts;

use App\Models\Post;
use App\Models\Image;
use App\Models\Category;
use App\Utils\ImageManager;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:posts');
    }
    public function index()
    {
        $posts = Post::when(request()->keyword, function ($query) {
            $query->where('title', 'LIKE', '%' . request()->keyword . '%')
                ->orWhere('description', 'LIKE', '%' . request()->keyword . '%');
        })->when(!is_null(request()->status), function ($query) {
            $query->where('status', request()->status);
        })
            ->orderBy(request('sorted_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 5));
        return view('dashboard.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::active()->select('id', 'name')->get();
        return view('dashboard.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $request->validated();
        try{
            DB::beginTransaction();

            $post = Auth::guard('admin')->user()->posts()->create($request->except(['_token', 'images']));
            //Optimization for getting the Post Images
            ImageManager::UploadImages($request, $user=null, $post);

            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('latest_posts');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['errors', $e->getMessage()]);
        }
        Session::flash('success', 'Created post successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with(['comments'=> function($query){
            $query->latest()->limit(3);
        }])->findOrFail($id);

        return view('dashboard.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('dashboard.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $request->validated();
        try{
            DB::beginTransaction();

            $post = Post::findOrFail($id);
            $post->update($request->except('_token', '_method', 'images'));
            //check if old post has image or no
            if ($request->hasFile('images'))
            {
                ImageManager::deleteImages($post);
                ImageManager::UploadImages($request, null, $post);
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
        }
        Session::flash('success', 'Post Updated successfully!');
        return redirect()->route('dashboard.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        ImageManager::deleteImages($post);
        $post->delete();
        Session::flash('success', 'Post deleted successfully');
        return redirect()->route('dashboard.posts.index');
    }
    public function toggleStatus($id)
    {
        $post = Post::findOrFail($id);
        if($post->status == 1)
        {
            $post->update([
                'status' => 0,
            ]);
            Session::flash('success', 'post status changed to inactive');
        }else{
            $post->update([
                'status' => 1,
            ]);
            Session::flash('success', 'post status changed to active');
        }
        return redirect()->back();
    }
    public function imageDestroy(Request $request, $image_id)
    {
        $image = Image::find($request->key);
        if (!$image)
        {
            return response()->json([
                'status'=>201,
                'msg'=>'Image Not Found',
            ]);
        }
        // delete image from local
        ImageManager::deleteImageFromLocal($image->path);
        // delete image from database
        $image->delete();
        return response()->json([
            'status'=>200,
            'msg'=>'Image Deleted Successfully',
        ]);
    }
    public function deleteComment($id)
    {
    try {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        Session::flash('success', 'Comment deleted successfully');
        } catch (\Exception $e) {
        Session::flash('error', 'Comment not found');
        }
    return redirect()->back();
    // return response()->json([
        //     'status'=>true,
        //     'msg'=>'Comment deleted successfully',
        //     'commentId'=>$comment->id,
        // ]);
    }
    public function readMoreComments($slug)
    {
        $post = Post::active()->whereSlug($slug)->first();
        $comments = $post->comments()->with('user')->get();
        return response()->json($comments);
    }
}
