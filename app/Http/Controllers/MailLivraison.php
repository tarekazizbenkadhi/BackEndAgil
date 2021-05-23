<?php

namespace App\Http\Controllers;

use App\Mail\livraison_mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailLivraison extends Controller
{
    //
    public function sendEmail(Request $request)
    {
        Mail::to($request->mail)->send(new livraison_mail($request->nom_prenom));
    }
}
