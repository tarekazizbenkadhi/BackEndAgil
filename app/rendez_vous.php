<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rendez_vous extends Model
{
    protected $fillable = [
'a830',
'a840',
'a850',
'a900',
'a910',
'a920',
'a930',
'a940',
'a950',
'a1000',
'a1010',
'a1020',
'a1030',
'a1040',
'a1050',
'a1100',
'a1110',
'a1120',
'a1130',
'a1140',
'a1150',
'a1200',
'a1210',
'a1220',
'a1230',
'a1240',
'a1250',
'a1410',
'a1420',
'a1430',
'a1440',
'a1450',
'a1500',
'a1510',
'a1520',
'a1530',
'a1540',
'a1550',
'a1600',
'a1610',
'a1620',
'a1630',
];

    public function carte_agilis()
    {
        return $this->hasMany(carte_agilis::class);
    }
}

