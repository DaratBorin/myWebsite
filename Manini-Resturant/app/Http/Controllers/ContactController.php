<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Feedback;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email',
            'message'    => 'required|string|min:10',
        ]);

        Enquiry::create($request->only(['first_name', 'last_name', 'email', 'subject', 'message']));

        return back()->with('success', 'Thank you! We will get back to you within 24 hours.');
    }

    public function submitFeedback(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'nullable|email',
            'rating'   => 'required|integer|min:1|max:5',
            'category' => 'required|string',
            'message'  => 'required|string|min:5',
        ]);

        Feedback::create($request->only(['name', 'email', 'rating', 'category', 'message']));

        return back()->with('feedback_success', 'Thank you for your feedback!');
    }
}