<?php

namespace App\Http\Controllers;

use App\CarteBancaire;
use Illuminate\Http\Request;

class CBContoller extends Controller
{
    public function addCarte()
    {

        $carte = new CarteBancaire([
            'numero' => '2006'.rand().'2403',
            'solde' => '1215',
            'date_exp' => date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 730 day")),
            'code' => rand(pow(10, 8-1), pow(10, 8)-1),
            'crypto'=>'210',
        ]);
        $carte->save();
        return response()->json([
            'message' => 'carte created!'
        ], 201);


    }
}
