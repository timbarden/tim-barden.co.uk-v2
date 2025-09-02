<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmitContactFormController;

Route::get('/', function () {
    return view('app');
});

Route::post('/contact/submit', SubmitContactFormController::class)->name('contact-form.submit');
