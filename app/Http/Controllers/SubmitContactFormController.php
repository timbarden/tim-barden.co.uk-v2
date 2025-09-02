<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmissionMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubmitContactFormController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'body' => 'required|string|max:1024',
        ]);

        // Here you would typically send the email using a Mailable class
        // For example:
        Mail::to('timbarden@outlook.com')->queue(new ContactFormSubmissionMail(
            $validated['name'],
            $validated['email'],
            $validated['body'],
        ));
        // For this example, we'll just return a success response
        return response()->json([
            'status' => 'success',
            'message' => 'Form submitted successfully!'
        ]);
    }
}