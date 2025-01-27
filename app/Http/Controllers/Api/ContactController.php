<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\NewContactNotify;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\Frontend\ContactRequest;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        $request->merge([
            'ip_address'=>$request->ip()
        ]);

        $contact = Contact::create($request->all());
        if(!$contact){
            return responseApi(null, 'Invalid Contact Request', 403);
        }

        $admin = Admin::get();
        Notification::send($admin, new NewContactNotify($contact));
        return responseApi($contact, 'Contact Request Received', 201);
    }
}
