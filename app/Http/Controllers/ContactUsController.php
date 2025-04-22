<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the contact messages.
     */
    public function index()
    {
        $contacts = ContactUs::all();
        return view('contact-us.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new contact message.
     */
    public function create()
    {
        return view('contact-us.create');
    }

    /**
     * Store a newly created contact message in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'description' => 'required|string'
        ]);

        ContactUs::create($request->all());

        return redirect()->route('contact-us.index')
            ->with('success', 'Contact message created successfully.');
    }

    /**
     * Display the specified contact message.
     */
    public function show(ContactUs $contactUs)
    {
        return view('contact-us.show', compact('contactUs'));
    }

    /**
     * Show the form for editing the specified contact message.
     */
    public function edit(ContactUs $contactUs)
    {
        return view('contact-us.edit', compact('contactUs'));
    }

    /**
     * Update the specified contact message in storage.
     */
    public function update(Request $request, ContactUs $contactUs)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'description' => 'required|string'
        ]);

        $contactUs->update($request->all());

        return redirect()->route('contact-us.index')
            ->with('success', 'Contact message updated successfully.');
    }

    /**
     * Remove the specified contact message from storage.
     */
    public function destroy(ContactUs $contactUs)
    {
        $contactUs->delete();

        return redirect()->route('contact-us.index')
            ->with('success', 'Contact message deleted successfully.');
    }
} 