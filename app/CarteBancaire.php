<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarteBancaire extends Model
{
    protected $fillable = [
        'numero',
        'crypto',
        'date_exp',
        'solde',
        'code',


    ];
}
