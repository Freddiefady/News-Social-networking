<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\SendOtpNotify;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{

    public function __construct(public Otp $otp)
    {
        // No need to create a new instance of Otp here Constructor property promotion
    }
    public function index()
    {
        return view('dashboard.auth.password.email');
    }
    public function verifyEmailShow(Request $request)
    {
        $request->validate(['email'=>'required|email']);
        $admin = Admin::where('email', $request->email)->first();
        if(!$admin)
        {
            return redirect()->back()->withErrors(['email'=> 'Try again later']);
        }
        $admin->notify(new SendOtpNotify($this->otp));
        return redirect()->route('dashboard.password.sendOtp',['email'=>$admin->email]);
    }
    public function sendOtp($email)
    {
        return view('dashboard.auth.password.confirm',['email'=>$email]);
    }
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'token'=>'required|digits:6',
        ]);
        $OTP = $this->otp->validate($request->email, $request->token);
        if($OTP->status == false)
        {
            return redirect()->back()->withErrors(['otp'=>'OTP is not valid']);
        }
        return redirect()->route('dashboard.password.reset.show',['email'=> $request->email]);
    }
}
