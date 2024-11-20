<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactRequest;
use App\Models\Admin;
use App\Models\Contact;
use App\Notifications\NewContactNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function store(ContactRequest $request)
    {
        $request->validated();
        $request->merge([
            'ip_address' =>$request->ip(),
        ]);

        $contact = Contact::create($request->except('_token'));
        if(!$contact)
        {
            Session::flash('error', 'Your message has not received');
            return redirect()->back();
        }
        $admins = Admin::get();
        Notification::send($admins, new NewContactNotify($contact));
        Session::flash('success', 'Your message has been received');
        return redirect()->back();
    }
}
