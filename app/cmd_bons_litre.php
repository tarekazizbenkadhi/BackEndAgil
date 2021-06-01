<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cmd_bons_litre extends Model
{
    protected $fillable = [
        'user_id',
        'qte_litres',
        'nb_cartes_bons',
        'montant_litres',
        'etat_litres',
        'reglement_litres',

        ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function rendez_vous_cb()
    {
        return $this->hasMany(rendez_vous_cb::class);
    }
    public function CateBons()
    {
        return $this->hasMany(bons_litre::class);
    }
}
