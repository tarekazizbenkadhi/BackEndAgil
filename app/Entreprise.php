<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    protected $table = 'entreprise';
    protected $fillable = [
        'raison_sociale',
        'activite',
        'forme_juridique',
        'responsable',
        'mobile',
        'email_res',
        'siege',
        'rib',
        'prevision',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
