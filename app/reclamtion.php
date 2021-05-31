<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reclamtion extends Model
{
    protected $fillable = [
        'text_reclamation',
        'objet',
        'user_id',
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
