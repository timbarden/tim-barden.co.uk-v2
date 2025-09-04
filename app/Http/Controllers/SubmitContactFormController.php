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
            'g-recaptcha-response' => 'required|string',
        ]);

        $ip = $_SERVER['REMOTE_ADDR'];
        $url =  'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode(config('app.google_recaptcha_secret')) . '&response=' . urlencode($validated['g-recaptcha-response']) . '&remoteip=' . urlencode($ip);
        $response = file_get_contents($url);
        $responseData = json_decode($response, true);

        $g_recaptcha_allowable_score = 0.5;

        $responseData["message"] = 'Sorry, your message could not be sent.';

        if ($responseData["success"] && $responseData["action"] == 'contactFormSubmit') {
            if ($responseData["score"] >= $g_recaptcha_allowable_score) {
                // passed spam test. Send the email.
                Mail::to(config('app.contact_form_email_to'))->queue(new ContactFormSubmissionMail(
                    $validated['name'],
                    $validated['email'],
                    $validated['body'],
                ));
                $responseData["message"] = 'Thank you for your message! I\'ll get back to you as soon as I can.';
            } elseif ($responseData["score"] < $g_recaptcha_allowable_score) {
                // failed spam test. Offer the visitor the option to try again or use an alternative method of contact.
                $responseData["status"] = 403;
            }
        }

        return response()->json($responseData);
    }
}