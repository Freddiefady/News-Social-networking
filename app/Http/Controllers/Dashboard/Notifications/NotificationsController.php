<?php

namespace App\Http\Controllers\Dashboard\Notifications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:alertify');
    }
    public function index()
    {
        Auth::guard('admin')->user()->unreadNotifications->markAsRead();
        // Display notifications page
        $alerts = Auth::guard('admin')->user()->notifications()->get();
        return view('dashboard.notifications.index', compact('alerts'));
    }
    public function destroy($id)
    {
        $alert = Auth::guard('admin')->user()->notifications()->where('id', $id)->first();
        if (!$alert) {
            abort(404);
            return redirect()->back()->with('error', 'Try again later');
        }
        $alert->delete();
        return redirect()->back()->with('success', 'Deleted alert successfully');
    }
    public function destroyAll()
    {
        auth('admin')->user()->notifications()->delete();
        return redirect()->back()->with('success', 'Deleted all alerts successfully');
    }
}
