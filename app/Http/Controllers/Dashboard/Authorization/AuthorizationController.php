<?php

namespace App\Http\Controllers\Dashboard\Authorization;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorizationRequest;
use App\Models\Authorizations;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:authorizations');
    }
    public function index()
    {
        $authorizations = Authorizations::paginate(5);
        return view('dashboard.authorization.index', compact('authorizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.authorization.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorizationRequest $request)
    {
        $authorization = new Authorizations();
        $this->role($request, $authorization);
        return redirect()->back()->with('success', 'created successfully');
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
        $authorization = Authorizations::findOrFail($id);
        $this->role($request, $authorization);
        return redirect()->route('dashboard.authorization.index')->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Authorizations::findOrFail($id);
        if($role->admins->count() > 0)
        {
            return redirect()->back()->with('error', 'Please delete Related admin first');
        }
        $roles = $role->delete();
        if(!$roles)
        {
            return redirect()->back()->with('error', 'Role not found');
        }
        return redirect()->back()->with('success', 'Deleted successfully');
    }
    /**
     * Summary of role
     * @param mixed $request
     * @param mixed $authorization
     * @return void
     */
    private function role($request, $authorization)
    {
        $authorization->role = $request->role;
        $authorization->permissions = json_encode($request->permissions);
        $authorization->save();
    }
}
