<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Feedback;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function create()
    {
        return view('feedback-form');
    }

    public function send(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'comment' => 'required|string'
        ]);
    
        $fullname = $request->input('full_name');
        $email = $request->input('email');
        $comment = $request->input('comment');


    
        Mail::to('comp3385@uwi.edu', 'COMP3385 Course Admin')
        ->send(new Feedback($fullname, $email, $comment));


        return redirect('/')->with('success', 'Feedback submitted successfully!');
    }
}
