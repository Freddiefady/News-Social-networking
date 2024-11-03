<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Posts\PostController;
use App\Http\Controllers\Dashboard\Users\UserController;
use App\Http\Controllers\Dashboard\Admins\AdminController;
use App\Http\Controllers\Dashboard\Contacts\ContactController;
use App\Http\Controllers\Dashboard\Settings\SettingsController;
use App\Http\Controllers\Dashboard\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\Auth\ForgetPasswordController;
use App\Http\Controllers\Dashboard\Categories\CategoryController;
use App\Http\Controllers\Dashboard\Notifications\NotificationsController;
use App\Http\Controllers\Dashboard\Authorization\AuthorizationController;
use App\Http\Controllers\Dashboard\GeneralSearchController;

Route::group(['as'=>'dashboard.', 'prefix'=>'admin', 'middleware'=>['auth:admin','CheckAdminStatus']],
function(){
    Route::fallback(function()
    {
        return response()->view('errors.404');
    });
    Route::get('/home', HomeController::class)->name('index');
    // General Search Management
    Route::get('/search',[ GeneralSearchController::class, 'GeneralSearch'])->name('search');
    // Authorization Management
    Route::resource('authorization', AuthorizationController::class);
    // Settings Management
    Route::prefix('settings')->name('settings.')->controller(SettingsController::class)->group(function()
    {
        Route::get('/', 'index')->name('index');
        Route::post('/Update', 'update')->name('update');
    });
    // Admin Management
    Route::resource('admins', AdminController::class);
    Route::get('admins/toggle/status/{id}', [AdminController::class, 'toggleStatus'])->name('status.admins');
    // Users Management
    Route::resource('users', UserController::class);
    Route::get('users/toggle/status/{id}', [UserController::class, 'toggleStatus'])->name('status.users');
    // Categories Management
    Route::resource('categories', CategoryController::class);
    Route::get('category/toggle/status/{id}', [CategoryController::class, 'toggleStatus'])->name('status.category');
    // Posts Management
    Route::resource('posts', PostController::class);
    Route::get('post/toggle/status/{id}', [PostController::class, 'toggleStatus'])->name('status.post');
    Route::get('posts/comments/{slug}',  [PostController::class, 'readMoreComments'])->name('comments.show');
    Route::get('post/comment/deleted/{id}', [PostController::class, 'deleteComment'])->name('comment.deleted');
    Route::post('post/image/{image_id}', [PostController::class, 'imageDestroy'])->name('post.delete');
    // Contact Management
    Route::prefix('contacts')->name('contacts.')->controller(ContactController::class)->group(function()
    {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
    });
    // Notifications Management
    Route::prefix('alerts')->name('alertify.')->controller(NotificationsController::class)->group(function()
    {
        Route::get('/', 'index')->name('index');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
        Route::get('/destroyAll', 'destroyAll')->name('destroyAll');
    });
});

    Route::prefix('admin')->name('dashboard.')->controller(LoginController::class)->group(function()
    {
        Route::name('admin.')->group(function()
        {
            Route::get('/login', 'index')->name('index')->middleware('guest:admin');
            Route::post('/login', 'store')->name('store')->middleware('guest:admin');
            Route::delete('/logout', 'destroy')->name('destroy')->middleware('auth:admin');
        });
        Route::prefix('password')->name('password.')->controller(ForgetPasswordController::class)->middleware('guest:admin')->group(function()
        {
            Route::get('forget-password', 'index')->name('forget.index');//Forget Password Anchor view
            Route::post('Verify-Email','verifyEmailShow')->name('verify.show');//email password page write logic and redirect to confirm
            Route::get('verification-code/{email}', 'sendOtp')->name('sendOtp');// confirm password page
            Route::post('verification-code/', 'verifyOtp')->name('verifyOtp');// verify code Otp form
        });
        Route::prefix('password')->name('password.')->controller(ResetPasswordController::class)->middleware('guest:admin')->group(function(){
            Route::get('reset-password/{email}', 'resetPasswordShow')->name('reset.show');// reset password page
            Route::post('resetPassword', 'resetPasswordUpdate')->name('reset.update');// reset password logic
        });
    });
    Route::get('admin/wait', function()
    {
        return view('dashboard.wait');
    })->name('dashboard.wait');
