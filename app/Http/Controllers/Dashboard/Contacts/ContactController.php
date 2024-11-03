<?php

namespace App\Http\Controllers\Dashboard\Contacts;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:contacts');
    }
    public function index()
    {
        $contacts = Contact::when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%')
                ->orWhere('title', 'LIKE', '%' . request()->keyword . '%');
            })->when(!is_null(request()->status), function ($query) {
                $query->where('status', request()->status);
            })
            ->orderBy(request('sorted_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 5));
        return view('dashboard.contacts.index', compact('contacts'));
    }
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['status'=>1]);
        return view('dashboard.contacts.show', compact('contact'));
    }
    public function destroy($id)
    {
        $contacts = Contact::findOrFail($id);
        $contacts->delete();
        return redirect()->route('dashboard.contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
