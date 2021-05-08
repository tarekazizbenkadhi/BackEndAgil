<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicule extends Model
{
    protected $fillable = [
    'immatriculation',
    'user_id',
    'marque',
];
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
