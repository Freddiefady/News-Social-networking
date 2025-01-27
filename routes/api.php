<?php

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\EmailVerifyController;
use App\Http\Controllers\Api\Auth\RegistrationController;
use App\Http\Controllers\Api\Auth\Account\PostsController;
use App\Http\Controllers\Api\Auth\Account\ProfileController;
use App\Http\Controllers\Api\Auth\Account\NotificationsContoller;
use App\Http\Controllers\Api\Auth\password\ResetPasswordController;
use App\Http\Controllers\Api\Auth\password\ForgetPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('account/')->middleware(['auth:sanctum', 'CheckUserStatus', 'checkEmailVerify'])->group(function(){
    Route::get('user', function (Request $request) {
        return UserResource::make($request->user());
    });
    Route::prefix('posts/')->controller(PostsController::class)->group(function(){
        Route::get('/', 'index');
        Route::post('store', 'store');
        Route::put('update/{post_id}', 'update');
        Route::delete('destroy/{post_id}', 'destroy');
        Route::post('comment/', 'addComment')->middleware('throttle:addComment');
        Route::get('comments/{post_id}', 'getComments');
    });
    Route::put('settings/profile/{user_id}',[ProfileController::class, 'update']);
    Route::put('change-password/{user_id}',[ProfileController::class, 'changePassword']);
    Route::get('notifications',[NotificationsContoller::class, 'notify']);
    Route::get('notifications/{id}',[NotificationsContoller::class, 'readNotify']);

});
// General Proccess Methods
Route::prefix('posts/')->controller(GeneralController::class)->group(function () {
    Route::get('{keyword?}',  'index');
    Route::get('show/{slug}',  'showPosts');
    Route::get('comments/{slug}',  'getPostsComments');
});

Route::get('categories', [CategoryController::class, 'getCategories']);
Route::get('categories/{slug}', [CategoryController::class, 'getCategoryPosts']);
Route::post('contact/store', [ContactController::class, 'store'])->middleware('throttle:contact');
Route::get('settings', [SettingsController::class, 'getSettings']);
Route::get('related-site', [SettingsController::class, 'relatedNews']);

// Authentication Proccess Methods
Route::post('auth/register', [RegistrationController::class, 'register']);
Route::prefix('auth/')->controller(LoginController::class)->group(function () {
    Route::post('login',  'login')->middleware('throttle:login');
    Route::delete('logout',  'logout')->middleware('auth:sanctum');
    Route::delete('logoutAllDevices',  'logoutAllDevices')->middleware('auth:sanctum');
});
// Email Verification Proccess Methods
Route::prefix('auth/')->middleware(['auth:sanctum', 'throttle:emailVerify'])->controller(EmailVerifyController::class)->group(function(){
    Route::post('email/verify',  'verify');
    Route::get('email/verify',  'resend');
});
Route::post('forget/password', [ForgetPasswordController::class, 'forget']);
Route::post('reset/password', [ResetPasswordController::class, 'reset']);
