<?php

namespace App\Http\Controllers;

use App\CarteBancaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CBContoller extends Controller
{
    public function addCarte()
    {

        $carte = new CarteBancaire([
            'numero' => '2006'.rand().'2403',
            'solde' => '1215',
            'date_exp' => date('Y-m',strtotime(date("Y-m", time()) . " + 24 month")),
            'code' => rand(pow(10, 8-1), pow(10, 8)-1),
            'crypto'=>'210',
        ]);
        $carte->save();
        return response()->json([
            'message' => 'carte created!'
        ], 201);


    }
    public function getCBbynum($num)
    {

        $carte = DB::table('carte_bancaires')

            ->where('carte_bancaires.numero', $num)->first();
        if (is_null($carte)) {

            return response()->json(['data' => 'carte not found'], 404);
        }


        return response()->json($carte, 200);
    }
    public function debiter_montant(Request $request)
    {
        DB::table('carte_bancaires')
            ->where('numero',$request->numero)
        ->decrement('solde',$request->montant);
        return response(201);
    }
}
