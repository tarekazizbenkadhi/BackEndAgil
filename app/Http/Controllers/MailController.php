<?php

namespace App\Http\Controllers;

use App\Mail\ValidationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail()
    {
        Mail::to('mezenbay@gmail.com')->send(new ValidationEmail('mezen'));
    }
}
