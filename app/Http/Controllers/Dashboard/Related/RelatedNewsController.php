<?php

namespace App\Http\Controllers\Dashboard\Related;

use App\Http\Controllers\Controller;
use App\Models\RelatedNewsSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RelatedNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = RelatedNewsSite::latest()->paginate(4);
        return view('dashboard.related.index', compact('links'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(RelatedNewsSite::filterRequest());
        $link = RelatedNewsSite::create($request->only(['name', 'url']));
        if(!$link){
            Session::flash('error', 'Failed to add new link');
            return redirect()->back();
        }
        Session::flash('success', 'updated successfully');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(RelatedNewsSite::filterRequest());
        $link = RelatedNewsSite::findOrFail($id);
        $link->update($request->only(['name', 'url']));
        if(!$link){
            Session::flash('error', 'Failed to update link');
            return redirect()->back();
        }
        Session::flash('success', 'updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $link = RelatedNewsSite::findOrFail($id);
        $link->delete();
        return redirect()->back()->with('success', 'Link deleted successfully');
    }
}
