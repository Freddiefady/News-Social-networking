<?php

namespace App\Http\Controllers\Api\Auth\password;

use App\Http\Controllers\Controller;
use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    private $otp;
    public function __construct()
    {
        $this->otp = new Otp();
    }
    public function reset(Request $request)
    {
        $request->validate([
            'email' =>'required|email|exists:users,email|max:60',
            'token' =>'required|max:6',
            'password' =>'required|min:8|confirmed',
            'password_confirmation' =>'required'
        ]);

        $sendOtp = $this->otp->validate($request->email, $request->token);
        if($sendOtp->status == false){
            return responseApi(null, 'Codes Invalid', 401);
        }

        $user = User::whereEmail($request->email)->first();
        if (!$user) {
            return responseApi(null, 'User not found', 404);
        }

        $user->update(['password'=>$request->password]);
        return responseApi(null, 'Password Reset Successfully', 200);
    }
}
