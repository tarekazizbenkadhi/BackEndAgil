<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminCommercial extends Model
{
    protected $table = 'admin_commercial';
    protected $fillable = [
        'prenom',
        'nom',
        'poste',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
