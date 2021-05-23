<?php

namespace App\Http\Controllers;

use App\Mail\validation_cmd_cb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailCbController extends Controller
{
    public function sendEmail(Request $request)
    {
        Mail::to($request->mail)->send(new validation_cmd_cb($request->nom_prenom));
    }
}
