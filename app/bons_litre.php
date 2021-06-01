<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bons_litre extends Model
{
    protected $fillable = [
        'consumed_at',
        'etat_bon',
        'cmd_bons_litre_id',
    ];
    public function carte()
    {
        return $this->hasOne(cmd_bons_litre::class);
    }
}
