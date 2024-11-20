<?php

use App\Http\Controllers\Api\SocialiteController;
use App\Http\Controllers\Frontend\Dashboard\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\frontend\PostController;
use App\Http\Controllers\frontend\SearchController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\Frontend\Dashboard\NotificationController;
use App\Http\Controllers\Frontend\Dashboard\SettingController;
use App\Http\Controllers\Frontend\NewsSubscriberController;
use Symfony\Component\CssSelector\Node\FunctionNode;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::redirect('/', '/home');
Route::group([
    'as'=> 'frontend.',
],function(){
    Route::fallback(function()
    {
        return response()->view('errors.404');
    });
    Route::get('/home',[ HomeController::class, 'index'])->name('index');
    Route::post('news.subscribe',[ NewsSubscriberController::class, 'store'])->name('news.subscribe');
    Route::get('category/{slug}', CategoryController::class)->name('category');
    Route::controller(PostController::class)->name('post.')->prefix('post')->group(function()
    {
        Route::get('/{slug}',  'show')->name('show');
        Route::get('/comments/{slug}',  'readMoreComments')->name('comments.show');
        Route::post('/comments/store',  'storeComment')->name('comments.store');

    });
    Route::prefix('contact-us')->name('contact.')->controller(ContactController::class)->group(function()
    {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
    });
    Route::match(['get', 'post'], 'search', SearchController::class)->name('search');
    // Dashboard Controllers
    Route::prefix('account/')->name('dashboard.')->middleware(['auth', 'verified', 'CheckUserStatus'])->group(function()
    {
        Route::controller(ProfileController::class)->group(function()
        {
            // Manage Profile Controller
            Route::get('profile', 'index')->name('profile');
            Route::post('post', 'store')->name('post.store');
            Route::get('post/show-comments/{id}', 'show')->name('post.show');//get comments
            Route::get('post/{slug}/edit', 'edit')->name('post.edit'); // view edit-post blade
            Route::put('post/update', 'update')->name('post.update');// edit-post blade
            Route::post('post/image/{image_id}', 'imageDestroy')->name('post.delete');
            Route::delete('post/{slug}', 'destroy')->name('post.destroy');
        });
        Route::prefix('notifications')->name('notification.')->controller(NotificationController::class)->group(function()
        {
            // Manage notifications Controller
            Route::get('/', 'index')->name('index');
            Route::get('/mark-As-Read', 'show')->name('show');
            Route::get('/deleteAll', 'destroyAll')->name('destroyAll');
            Route::delete('/delete/{id}', 'destroy')->name('destroy');
        });
        Route::prefix('settings')->name('setting.')->controller(SettingController::class)->group(function()
        {
            // Manage Setting Controller
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store'); //changePassword
            Route::post('/update', 'update')->name('update');
        });
    });
    Route::get('/wait', function()
    {
        return view('frontend.wait');
    })->name('wait');
});
Route::prefix('email')->name('verification.')->controller(VerificationController::class)->group(function()
{
    Route::get('/verify', 'show')->name('notice');
    Route::get('/verify/{id}/{hash}','verify')->name('verify');
    Route::post('/resend', 'resend')->name('resend');
});

Auth::routes();

Route::get('auth/{provider}/login', [SocialiteController::class, 'redirect'])->name('auth.google.redirect');
Route::get('auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('auth.google.callback');
