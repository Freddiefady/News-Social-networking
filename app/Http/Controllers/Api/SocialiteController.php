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

            $user = User::updateOrCreate([
                'email'=>$socialite->getEmail(),
            ],[
                'google_id'=>$socialite->id,
                'name'=>$socialite->name,
                'username'=>Str::replace('' ,'' ,$socialite->name).time(),
                'email'=>$socialite->email,
                'email_verified_at'=>now(),
                'phone'=>'updated',
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
}
