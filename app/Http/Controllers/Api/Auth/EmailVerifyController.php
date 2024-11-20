<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\SendOtpNotify;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerifyController extends Controller
{
    public function __construct(public Otp $otp){}
    public function verify(Request $request)
    {
        $request->validate(['token' =>'required|max:6']);
        $user = $request->user();
        $sendOtp = $this->otp->validate($user->email, $request->token);
        if ($sendOtp->status == false)
        {
            return responseApi(null, 'Codes Invalid', 400);
        }
        $user->update(['email_verified_at'=> now()]);
        return responseApi(null, 'Email Verification Successfully', 200);
    }
    public function resend(Request $request)
    {
        $user = $request->user();
        $user->notify(new SendOtpNotify());
        return responseApi(null, 'Verification Code Sent', 200);
    }
}
