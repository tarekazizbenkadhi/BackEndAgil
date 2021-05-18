<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rendez_vous extends Model
{
    protected $fillable = [
    'date_time_rv',
    'user_id',
    'carte_agilis_id',
];

    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function carte()
    {
        return $this->hasOne(carte_agilis::class);
    }

}

