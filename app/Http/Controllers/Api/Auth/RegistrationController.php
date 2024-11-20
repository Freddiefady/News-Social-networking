<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Notifications\SendOtpNotify;
use App\Utils\ImageManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserRequest;

class RegistrationController extends Controller
{
    public function register(AdminUserRequest $request)
    {
        $request->validated();
        try{
            DB::beginTransaction();
            $user = User::create([
                'name'=>$request->post('name'),
                'username'=>$request->post('username'),
                'phone'=>$request->post('phone'),
                'email'=>$request->post('email'),
                'password'=>$request->post('password'),
                'country'=>$request->post('country'),
                'city'=>$request->post('city'),
                'street'=>$request->post('street'),
            ]);

            if($request->hasFile('image')){
                ImageManager::UploadImages($request, $user, null);
            }
            $token = $user->createToken('user_token')->plainTextToken;

            $user->notify(new SendOtpNotify());
            DB::commit();
            return responseApi(['token' => $token], 'User Created Successfully', 201);
        }catch(\Exception $e){
            DB::rollBack();
            Log::error('Error Message From Registration Proccess : '. $e->getMessage());
            return responseApi(null, 'Internal Server Error', 500);
        }
    }
}
