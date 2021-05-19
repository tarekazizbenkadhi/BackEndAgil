<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rendez_vous_cb extends Model
{
    protected $fillable = [
        'date_time_rv',
        'user_id',
        'cmd_bons_litre_id',
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function carte()
    {
        return $this->hasOne(cmd_bons_litre::class);
    }
}
