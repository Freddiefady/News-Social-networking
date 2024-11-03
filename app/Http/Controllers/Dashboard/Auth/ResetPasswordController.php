<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends Controller
{
    public function resetPasswordShow($email)
    {
        return view('dashboard.auth.password.reset',['email'=>$email]);
    }
    public function resetPasswordUpdate(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8|confirmed',
            'password_confirmation'=>'required',
        ]);
        $admin = Admin::where('email', $request->email)->first();
        if(!$admin)
        {
            Session::flash('error','Password does not match');
            return redirect()->back()->with(['error'=>'Password does not match']);
        }
        $admin->update([
                'password'=>bcrypt($request->password)
            ]);
            return redirect()->route('dashboard.admin.index')->with(['success'=>'Successfully updated']);
    }
}
