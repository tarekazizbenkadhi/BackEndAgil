<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class carte_agilis extends Model
{
    protected $fillable = [
       'num_carte',
        'user_id',
        'solde',
        'date_exp',
        'code_secret',
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
