<?php

namespace App\Http\Controllers\Api\Auth\Account;

use App\Models\User;
use App\Utils\ImageManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UserSettingsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(UserSettingsRequest $request, $user_id)
    {
        // Update user profile
        $request->validated();
        try{
            DB::beginTransaction();
            $user = User::find($user_id);
            if(!$user) {
                return responseApi(null, 'Something went wrong', 404);
            }
            $user->update($request->except(['_method', 'image']));
            ImageManager::UploadImages($request, $user);
            DB::commit();
            return responseApi(null, 'Profile updated successfully', 200);
        }catch(\Exception $e){
            DB::rollBack();
            Log::error('something went wrong, Would you unique data'. $e->getMessage());
            return responseApi(null, 'Internet Server Error', 500);
        }
    }
    public function changePassword(Request $request, $user_id)
    {
        $request->validate($this->filterPasswordRequest());
        $user = User::find($user_id);
        if(!$user) {
            return responseApi(null, 'Something went wrong', 404);
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return responseApi(null, 'Password doesn\'t match', 404);
        }
        $user->update([
            'password' => $request->password
        ]);
        return responseApi(null, 'Password updated successfully', 200);
    }
    private function filterPasswordRequest()
    {
        return [
            'current_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ];
    }
}
