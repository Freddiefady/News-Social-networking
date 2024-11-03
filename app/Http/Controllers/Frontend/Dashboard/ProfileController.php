<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Utils\ImageManager;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        $showPostsOfUser = auth()->user()->posts()->with(['images'])->latest()->get();
        return view('frontend.dashboard.profile', compact('showPostsOfUser'));
    }
    public function store(PostRequest $request)
    {
        $request->validated();
        try{
            DB::beginTransaction();

            $this->commentAble($request);
            $post = auth()->user()->posts()->create($request->except('_token', 'images'));
            //Optimization for getting the Post Images
            ImageManager::UploadImages($request, $user=null, $post);

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->withErrors(['errors', $e->getMessage()]);
        }
        Session::flash('success', 'Created post successfully');
        return redirect()->back();
    }
    public function edit($slug)
    {
        $post = Post::with(['images'])->whereSlug($slug)->first();
        if(!$post)
        {
            abort(404);
        }
        return view('frontend.dashboard.edit-post', compact('post'));
    }
    public function destroy(Request $request)
    {
        $post = Post::where('slug', $request->slug)->first();
        if(!$post)
        {
            // return redirect()->back()->with('error', 'Try Again Later!');
            abort(404);
        }
        ImageManager::deleteImages($post);

        $post->delete();
        return redirect()->back()->with('success', 'Post Deleted Successfully');
    }
    public function show($id)
    {
        // Anthor method to get comment with recent post
        // $post = Post::findOrFail($id);
        // $comments = $post->comments();
        $comments = Comment::with(['user'])->where('post_id', $id)->get();
        // return $comments;
        if(!$comments)
        {
            return response()->json([
                'data'=>null,
                'msg'=>'No Found Comments',
            ]);
        }
        return response()->json([
            'data'=>$comments,
            'msg'=>'Contain Comments',
        ]);
    }
    public function update(PostRequest $request)
    {
        $request->validated();
        try{
            DB::beginTransaction();

            $post = Post::findOrFail($request->post_id);
            $this->commentAble($request);
            $post->update($request->except('_token', '_method', 'images', 'post_id'));
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
        return redirect()->route('frontend.dashboard.profile');
    }
    private function commentAble($request)
    {
        $request->comment_able == "on" ? $request->merge(['comment_able' => 1]) : $request->merge(['comment_able' => 0]);
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

}
