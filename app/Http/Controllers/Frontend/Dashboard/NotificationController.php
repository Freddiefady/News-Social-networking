<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function index()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return view('frontend.dashboard.notification');
    }
    public function show()
    {
        auth()->user()->unreadNotifications->markAsRead();
        Session::flash('success', 'Notification has been marked as read');
        return redirect()->back();
    }
    public function destroyAll()
    {
        auth()->user()->notifications()->delete();
        Session::flash('success', 'Notification all deleted');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->where('id',  $id)->first();
        $notification->delete();
        Session::flash('success', 'Notification deleted');
        return redirect()->back();

    }

}
