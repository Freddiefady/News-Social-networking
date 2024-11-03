<?php

namespace App\Http\Controllers\Dashboard\Auth;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Logout;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest:admin'])->only(['index', 'store']);
        $this->middleware(['auth:admin'])->only('destroy');
    }
    public function index()
    {
        return view('dashboard.auth.login');
    }
    public function store(Request $request)
    {
        $request->validate($this->validateFilter());

        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=> $request->password],$request->remember))
        {
            // if admin has permission home redirect->home, else redirect the first page in has permission
            $permissions = Auth::guard('admin')->user()->role->permissions;
            $firstPermission = $permissions[0];
            if(!in_array('home', $permissions))
            {
                return redirect()->intended('admin/'.$firstPermission);
            }
            return redirect()->intended(RouteServiceProvider::AdminHome);
        }
        Session::flash('error', 'credentials required for login');
        return redirect()->back();
    }
    public function destroy()
    {
        Auth::guard('admin')->logout();
        Session::flash('success', 'logout successful');
        return redirect()->route('dashboard.admin.store');
    }
    private function validateFilter()
    {
        return [
            'email' =>'required|email',
            'password' => 'required|min:7|',
            'remember'=>'in:on,off'
        ];
    }
}
//regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
