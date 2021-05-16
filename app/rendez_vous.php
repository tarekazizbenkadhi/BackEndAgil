<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rendez_vous extends Model
{
    protected $fillable = [
    'date_time_rv',
    'user_id',
];

    public function carte_agilis()
    {
        return $this->hasOne(User::class);
    }
}

