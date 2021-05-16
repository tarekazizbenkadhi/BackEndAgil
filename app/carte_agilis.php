<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class carte_agilis extends Model
{
    protected $fillable = [
       'mere_ss',
        'user_id',
        'mere_g',
        'mere_g50',
        'nb_carte_ss',
        'nb_carte_g',
        'nb_carte_g50',
        'etat',



    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }



}
