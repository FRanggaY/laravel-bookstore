<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Your message has been sent to the admin.');
    }

    // Admin view
    public function adminIndex()
    {
        $contacts = Contact::with('user')->latest()->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function adminCreate()
    {
        return view('admin.contacts.create');
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'resolved', // Manual entries are usually resolved
        ]);

        return redirect()->route('admin.contacts.index')->with('success', 'Contact entry added successfully.');
    }

    public function updateStatus($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->status = 'resolved';
        $contact->save();

        return redirect()->back()->with('success', 'Message marked as resolved.');
    }
}
