<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gerant extends Model
{
    protected $table = 'gerants';
    protected $fillable = [
        'prenom',
        'nom',
        'poste',
        'adresse_station',
        'user_id',
        'valide',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
