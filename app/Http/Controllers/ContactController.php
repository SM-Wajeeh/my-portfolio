<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:3000',
        ]);

        try {
            Mail::to('syedmuhammadzaidi51214@gmail.com')
                ->send(new ContactMail($validated));

            return redirect()->route('home')->withFragment('contact')
                ->with('success', 'Message sent! I\'ll get back to you soon.');
        } catch (\Exception $e) {
            \Log::error('Mail sending failed: ' . $e->getMessage());
            return redirect()->route('home')->withFragment('contact')
                ->with('error', 'Something went wrong. Please try again or email me directly.');
        }
    }
}
