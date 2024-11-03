<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:categories');
    }
    public function index()
    {
        $categories = Category::withCount('posts')->when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%');
        })->when(!is_null(request()->status), function ($query) {
            $query->where('status', request()->status);
        })
            ->orderBy(request('sorted_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 5));
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|max:100',
            'status' =>'in:0,1',
        ]);
        $category = Category::create($request->only(['name', 'status']));
        if(!$category)
        {
            Session::flash('error', 'Failed to create categories');
            return redirect()->back();
        }
        Session::flash('success', 'categories Created successfully');
        return redirect()->route('dashboard.categories.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' =>'required|max:100',
            'status' =>'in:0,1',
        ]);
        $category = Category::findOrFail($id);
        $category->update($request->except('_token', '_method'));
        if(!$category)
        {
            Session::flash('error', 'Failed to update categories');
            return redirect()->back();
        }
        Session::flash('success', 'Update categories successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();
        Session::flash('success', 'categories deleted successfully');
        return redirect()->route('dashboard.categories.index');
    }
    public function toggleStatus($id)
    {
        $categories = Category::findOrFail($id);
        if($categories->status == 1)
        {
            $categories->update([
                'status' => 0,
            ]);
            Session::flash('success', 'category status changed to inactive');
        }else{
            $categories->update([
                'status' => 1,
            ]);
            Session::flash('success', 'category status changed to active');
        }
        return redirect()->back();
    }
}
