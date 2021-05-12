<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rendez_vous extends Model
{
    protected $fillable = [
'8:30',
'8:40',
'8:50',
'9:00',
'9:10',
'9:20',
'9:30',
'9:40',
'9:50',
'10:00',
'10:10',
'10:20',
'10:30',
'10:40',
'10:50',
'11:00',
'11:10',
'11:20',
'11:30',
'11:40',
'11:50',
'12:00',
'12:10',
'12:20',
'12:30',
'12:40',
'12:50',
'14:10',
'14:20',
'14:30',
'14:40',
'14:50',
'15:00',
'15:10',
'15:20',
'15:30',
'15:40',
'15:50',
'16:00',
'16:10',
'16:20',
'16:30',
];

    public function carte_agilis()
    {
        return $this->hasMany(carte_agilis::class);
    }
}

