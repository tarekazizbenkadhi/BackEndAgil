<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';
    protected $fillable = [
        'prenom',
        'nom',
        'cin',
        'lieu_cin',
        'date_cin',
        'adresse',
        'code_postal',
        'ville',
        'image_cin',
        'user_id',
        'valide',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
