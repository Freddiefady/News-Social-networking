<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' =>'required|email|max:50',
            'password' =>'required|min:8|max:255',
        ]);

        if (RateLimiter::tooManyAttempts($request->ip(), 2)){
            $time = RateLimiter::availableIn($request->ip());
            return responseApi(null, 'Invalid, Try again after : ' . $time . 'Minutes', 429);
        }
        RateLimiter::increment($request->ip());
        $remaining = RateLimiter::remaining($request->ip(), 2);

        $user = User::whereEmail($request->email)->first();
        if($user->email && Hash::check($request->password, $user->password))
        {
            $token = $user->createToken('user_token', [], now()->addMinutes(60))->plainTextToken;
            RateLimiter::clear($request->ip());
            return responseApi(['token' => $token], 'User logged in successfully', 200);
        }
        return responseApi(['remaining'=>$remaining], 'Credentials doesn\'t match, Try again', 401);
    }
    public function logout()
    {
        $user = Auth::guard('sanctum')->user();
        $user->currentAccessToken()->delete();
        return responseApi(null, 'User Logged out successfully', 200);
    }
    public function logoutAllDevices()
    {
        $user = Auth::guard('sanctum')->user();
        $user->tokens()->delete();
        return responseApi(null, 'User Logged out from all devices successfully', 200);
    }
}
