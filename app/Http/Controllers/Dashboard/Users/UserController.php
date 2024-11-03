<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Models\User;
use App\Utils\ImageManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:users');
    }
    public function index()
    {
        $users = User::when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%')
                ->orWhere('email', 'LIKE', '%' . request()->keyword . '%');
        })->when(!is_null(request()->status), function ($query) {
            $query->where('status', request()->status);
        })
            ->orderBy(request('sorted_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 5));
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminUserRequest $request)
    {
        try{
            DB::beginTransaction();

            $request->validated();
            $request->merge([
                'email_verified_at'=>$request->email_verified_at == 1 ? now() : null
            ]);
            $user = User::create($request->except(['_token', 'password_confirmation']));
            ImageManager::UploadImages($request, $user, null);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
        Session::flash('success', 'User created successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.users.show', compact('user'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        ImageManager::deleteImageFromLocal($user->image);
        Session::flash('success', 'User deleted successfully');
        return redirect()->route('dashboard.users.index');
    }
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
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
