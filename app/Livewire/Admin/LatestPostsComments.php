<?php

namespace App\Livewire\Admin;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class LatestPostsComments extends Component
{
    public function render()
    {
        $latest_post = Post::with('user')->withCount('comments')->whereStatus(1)->latest()->take(5)->get();
        $latest_comments = Comment::with(['user', 'post'])->latest()->take(5)->get();
        return view('livewire.admin.latest-posts-comments', compact('latest_post','latest_comments'));
    }
}
