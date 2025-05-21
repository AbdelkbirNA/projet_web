<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;

class ContactController extends Controller
{
    public function show()
    {
        $professors = User::where('user_type', 'professor')->get();
        return view('student.contact', compact('professors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'professor_email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:10240' // Max 10MB
        ]);

        $contact = new Contact();
        $contact->student_id = auth()->id();
        $contact->professor_email = $request->professor_email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('contact-attachments');
            $contact->attachment_path = $path;
        }

        $contact->save();

        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès.');
    }
} 