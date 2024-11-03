<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Post;

class GeneralSearchController extends Controller
{
    public function GeneralSearch(Request $request)
    {
        if($request->option == 'user')
        {
            return $this->searchUsers($request);

        }elseif($request->option == 'category')
        {
            return $this->searchCategories($request);

        }elseif($request->option == 'post')
        {
            return $this->searchPosts($request);

        }elseif($request->option == 'contact')
        {
            return $this->searchContact($request);
        }else{
            return redirect()->route('dashboard.index')->with('error', 'Invalid try again!');
        }
    }
    private function searchUsers($request){
        $users = User::where('name', 'LIKE', '%'.$request->keyword.'%')->paginate();
        return view('dashboard.users.index', compact('users'));
    }
    private function searchCategories($request){
        $categories = Category::where('name', 'LIKE', '%'.$request->keyword.'%')->paginate();
        return view('dashboard.categories.index', compact('categories'));
    }
    private function searchPosts($request){
        $posts = Post::where('title', 'LIKE', '%'.$request->keyword.'%')->paginate();
        return view('dashboard.posts.index', compact('posts'));
    }
    private function searchContact($request){
        $contacts = Contact::where('name', 'LIKE', '%'.$request->keyword.'%')->paginate();
        return view('dashboard.contacts.index', compact('contacts'));
    }
}
