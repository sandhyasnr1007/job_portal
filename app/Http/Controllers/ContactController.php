<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function submit(Request $request)
{

    

    // Validation
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string',
    ]);

    ContactMessage::create([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
    ]);

    // Handle form submission logic here (e.g., send email or store in DB)

    return back()->with('success', 'Thank you for contacting us!');
}

public function show()
{
    
    return view('front.contactUs'); // adjust if your view path is different
}




}
