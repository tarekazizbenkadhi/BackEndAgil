<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    protected $table = 'super_admin';
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
