<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try{
            $socialite = Socialite::driver($provider)->user();
            $user_db = user::whereEmail($socialite->getEmail())->first();

            if ($user_db) {
                Auth::login($user_db);
                return redirect()->route('frontend.dashboard.profile');
            }

            $username = $this->generateUniqueUserName($socialite->name);

            $user = User::create([
                'name'=>$socialite->name,
                'username'=>$username.time(),
                'email'=>$socialite->email,
                'email_verified_at'=>now(),
                'image'=>$socialite->avatar,
                'status'=>1,
                'country'=>'updated',
                'city'=>'updated',
                'street'=>'updated',
                'password'=>Hash::make(Str::random(8)),
            ]);

            Auth::login($user);
            return redirect()->route('frontend.dashboard.profile');

        } catch(\Exception $e) {
            return redirect()->route('login');
        }
    }

    public function generateUniqueUserName($name)
    {
        $username = Str::slug($name);
        $count = 1;
        while (User::where('username', $username)->exists()) {
            $userName = $username . $count++;
        }
        return $username;
    }
}
