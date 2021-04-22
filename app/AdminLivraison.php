<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLivraison extends Model
{
    protected $table = 'admin_livraison';
    protected $fillable = [
        'prenom',
        'nom',
        'poste',
        'user_id',
        'valide',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
