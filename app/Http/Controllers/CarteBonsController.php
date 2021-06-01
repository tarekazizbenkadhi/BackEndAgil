<?php

namespace App\Http\Controllers;

use App\bons_litre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarteBonsController extends Controller
{
    public function addCommandeCarteBon(Request $request, $id)
    {

        $BonsLitres = new bons_litre([
            'consumed_at'=>$request->consumed_at,
            'etat_bon'=>0,
            'cmd_bons_litre_id' =>$id,
        ]);
        $BonsLitres->save();

        return response()->json([
            'message' => 'bons litres created!'
        ], 201);
    }
    public function get_bon_litres_entreprise_byid($id)
    {

        $bon = DB::table('bons_litres as c')
            ->join('cmd_bons_litres','cmd_bons_litres.id','=','c.cmd_bons_litre_id')
            ->where('cmd_bons_litres.user_id', $id)
            ->select( 'c.*')
            ->get();
        if (is_null($bon)) {

            return response()->json(['data' => 'commande not found'], 404);
        }

        return response()->json($bon, 200);
    }
    public function update_bonsLitres(Request $request,$num_bon)
    {
        /*$carte = DB::table('carte_agilis')
            ->where('id',$id)->first();*/
        $tableupdate = [];
        if (!empty($request->etat_bon)) {
            $tableupdate['etat_bon'] = $request->etat_bon;
        }
        if (!empty($request->consumed_at)) {
            $tableupdate['consumed_at'] = $request->consumed_at;
        }
        DB::table('bons_litres')
            ->where('num_bon', $num_bon)
            ->update($tableupdate);
        return response(201);
    }
}
