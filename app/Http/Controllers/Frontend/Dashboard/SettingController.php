<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UserSettingsRequest;
use App\Utils\ImageManager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('frontend.dashboard.setting', compact('user'));
    }
    public function update(UserSettingsRequest $request)
    {
        $request->validated();
        // code to update user settings goes here
        $user = User::findOrFail(auth()->user()->id);
        $user->update($request->except(['_token, image']));
        ImageManager::UploadImages($request, $user, null);

        return redirect()->back()->with('success', 'User settings updated successfully');
    }
    public function store(Request $request)
    {
        $request->validate([
            'current_password' =>'required',
            'password' => 'confirmed|min:6',
            'password_confirmation' => 'required'
        ]);
        if(!Hash::check($request->current_password, auth()->user()->password))
        {
            Session::flash('error', 'Invalid password');
            return redirect()->back();
        }
        $user = User::findOrFail(auth()->user()->id);
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        Session::flash('success', 'Changed Password successfully');
        return redirect()->back();
    }
}

