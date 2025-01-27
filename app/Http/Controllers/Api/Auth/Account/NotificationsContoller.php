<?php

namespace App\Http\Controllers\Api\Auth\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\notificationsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsContoller extends Controller
{
    public function notify()
    {
        $post = auth()->user();
        $notifications = $post->notifications;
        $unreadNotify = $post->unreadNotifications;

        return responseApi(['notifications' => notificationsResource::collection($notifications),
        'unreadNotifications' => notificationsResource::collection($unreadNotify)],
        'Response posts data successfully', 200);
    }
    public function readNotify($id)
    {
        $notifications = auth('sanctum')->user()->unreadNotifications->whereId($id)->first();
        if (!$notifications) {
            return responseApi(null, 'Not found notification', 404);
        }
        $notifications->markAsRead();
        return responseApi(null, 'Notification marked as read successfully', 200);
    }
}
