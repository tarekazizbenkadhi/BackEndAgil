<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class commandeBonValeur extends Model
{
    protected $fillable = [
'user_id',
'nb_carnet15_ss',
'nb_carnet30_ss',
'nb_carnet50_ss',
'nb_carnet15_g',
'nb_carnet30_g',
'nb_carnet50_g',
'nb_carnet15_g50',
'nb_carnet30_g50',
'nb_carnet50_g50',
'etat',
'reglemment',
'montant',
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function rendez_vous_bv()
    {
        return $this->hasMany(rendez_vous_bv::class);
    }
}
