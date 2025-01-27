<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NoificationReadAt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->query('notify'))
        {
            if(Auth::guard('sanctum')->check()) {
                $notification = auth('sanctum')->user()->unreadNotifications->where('id',$request->query('notify'))->first();
            }else {
                $notification = auth('web')->user()->unreadNotifications->where('id',$request->query('notify'))->first();
            }
            if($notification)
            {
                $notification->markAsRead();
            }
        }
        // contact admin
        if($request->query('notifyAdmin'))
        {
            $notification = auth('admin')->user()->unreadNotifications->where('id',$request->query('notifyAdmin'))->first();
            if($notification)
            {
                $notification->markAsRead();
            }
        }
        return $next($request);
    }
}
