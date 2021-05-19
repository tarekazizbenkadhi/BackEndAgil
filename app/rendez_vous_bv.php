<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rendez_vous_bv extends Model
{
    protected $fillable = [
        'date_time_rv',
        'user_id',
        'commande_bon_valeur_id',
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function carte()
    {
        return $this->hasOne(commandeBonValeur::class);
    }
}
