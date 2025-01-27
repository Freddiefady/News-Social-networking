<?php

namespace App\Http\Controllers\Api\Auth\password;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SendOtpNotify;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    public function forget(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email|max:60']);
        $user = User::whereEmail($request->email)->first();
        if (!$user) {
            return responseApi(null, 'Not Found User', 404);
        }
        $user->notify(new SendOtpNotify());
        return responseApi(null, 'OTP Sent Successfully, check your email', 200);
    }
}
