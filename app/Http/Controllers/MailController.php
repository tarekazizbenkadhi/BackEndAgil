<?php

namespace App\Http\Controllers;

use App\Mail\ValidationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail()
    {
        Mail::to('shiraz.besrour@gmail.com')->send(new ValidationEmail('shiraz'));
    }
}
