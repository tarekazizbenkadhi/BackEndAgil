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
        'matricule_fisc',
        'responsable',
        'mobile',
        'email_res',
        'siege',
        'rib',
        'budget',
        'prevision',
        'num_registre_commerce',
        'mat_fiscal',
        'user_id',
        'valide',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
