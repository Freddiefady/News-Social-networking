<?php

namespace App\Http\Controllers\Dashboard\Admins;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Authorizations;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:admins');
    }
    public function index()
    {
        $roles = Authorizations::select('id','role')->get();
        $admins = Admin::where('id','!=', Auth::guard('admin')->user()->id)->when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%')
                ->orWhere('email', 'LIKE', '%' . request()->keyword . '%')
                ->orWhere('username', 'LIKE', '%' . request()->keyword . '%');
        })->when(!is_null(request()->status), function ($query) {
            $query->where('status', request()->status);
        })
            ->orderBy(request('sorted_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 5));
        return view('dashboard.admins.index', compact('admins','roles'));
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
    public function store(AdminsRequest $request)
    {
        $request->validated();
        $admin = Admin::create($request->only(['name', 'username', 'email', 'password', 'status', 'role_id']));
        if(!$admin)
        {
            return redirect()->back()->with('error', 'Invalid Try again');
        }
        return redirect()->back()->with('success', 'Created admin Successfully');
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
        $admin = Admin::findOrFail($id);
        $roles = Authorizations::select('id', 'role')->get();
        return view('dashboard.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminsRequest $request, string $id)
    {
        $request->validated();
        $admins = Admin::findOrFail($id);
        if($request->password)
        {
            $admin = $admins->update($request->only(['name', 'username', 'email', 'password', 'status', 'role_id']));
        }else{
            $admin = $admins->update($request->only(['name', 'username', 'email', 'status', 'role_id']));
        }
        if(!$admin)
        {
            return redirect()->back()->with('error', 'Invalid Try again');
        }
        return redirect()->back()->with('success', 'Updated admin Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);
        if(!$admin)
        {
            return redirect()->back()->with('error', 'Invalid Try again');
        }
        $admin->delete();
        Session::flash('success', 'Deleted Successfully');
        return redirect()->back();
    }
    public function toggleStatus($id)
    {
        $user = Admin::findOrFail($id);
        if($user->status == 1)
        {
            $user->update([
                'status' => 0,
            ]);
            Session::flash('success', 'User status changed to inactive');
        }else{
            $user->update([
                'status' => 1,
            ]);
            Session::flash('success', 'User status changed to active');
        }
        return redirect()->back();
    }
}
