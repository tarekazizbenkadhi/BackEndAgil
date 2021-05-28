<?php

namespace App\Http\Controllers;

use App\Mail\supressionMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailSupController extends Controller
{
    public function sendEmail(Request $request)
    {
        Mail::to($request->mail)->send(new supressionMail($request->nom_prenom));
    }
}
