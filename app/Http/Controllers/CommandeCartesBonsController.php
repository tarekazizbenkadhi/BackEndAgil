<?php

namespace App\Http\Controllers;

use App\cmd_bons_litre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommandeCartesBonsController extends Controller
{
    public function addCommandeCarteBon(Request $request , $id)
    {

        $BonsLitres = new cmd_bons_litre([
            'qte_litres' => $request->qte_litres,
            'nb_cartes_bons' => $request->nb_cartes_bons,
            'montant_litres' => $request->montant_litres,
            'etat_litres' => $request->etat_litres,
            'reglement_litres' => $request->reglement_litres,
            'user_id' => $id,
        ]);
        $BonsLitres->save();

        $BonsLitres->rendez_vous_cb()->create([
            'user_id' => $id,
            'date_time_rv' => $request->date_time_rv,
            'cmd_bons_litre_id' => $BonsLitres->id,

        ]);
        return response()->json([
            'message' => 'Commande de bons litres created!'
        ], 201);
    }


    public function get_cmd_litres_entreprise_byid($id)
    {

        $cmd = DB::table('cmd_bons_litres as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('entreprise', 'entreprise.user_id', '=', 'users.id')
            ->where('c.user_id', $id)
            ->select ('users.*','entreprise.*','c.*')
            ->get();
        if (is_null($cmd)) {

            return response()->json(['data' => 'commande not found'], 404);
        }


        return response()->json($cmd, 200);
    }

    public function get_cmd_litres_entreprise_cb()
    {

        $cmd = DB::table('cmd_bons_litres as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('entreprise', 'entreprise.user_id', '=', 'users.id')
            ->select ('users.*','entreprise.*','c.*')
            ->get();
        if (is_null($cmd)) {

            return response()->json(['data' => 'commande not found'], 404);
        }


        return response()->json($cmd, 200);
    }

    public function update_commande_litres(Request $request, $id)
    {

        $cmdupdate = [];
        if (!empty($request->valide)) {$cmdupdate['etat_litres'] = $request->etat_litres;}
        DB::table('cmd_bons_litres')
            ->where('id',$id)
            ->update($cmdupdate);
        return response( 201);
    }
}
