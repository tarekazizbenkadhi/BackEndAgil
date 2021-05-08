<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommandeBonValeurController extends Controller
{
    public function addCommandeBonValeur(Request $request , $id)
    {

        // dd($id);

        $Commande = new commandeBonValeur([
            'nb_carnet15_ss' => $request->nb_carnet15_ss,
            'nb_carnet30_ss' => $request->nb_carnet30_ss,
            'nb_carnet50_ss' => $request->nb_carnet50_ss,
            'nb_carnet15_g' =>$request->nb_carnet15_g,
            'nb_carnet30_g' =>$request->nb_carnet30_g,
            'nb_carnet50_g' =>$request->nb_carnet50_g,
            'nb_carnet15_g50' =>$request->nb_carnet15_g50,
            'nb_carnet30_g50' =>$request->nb_carnet30_g50,
            'nb_carnet50_g50' =>$request->nb_carnet50_g50,
            'etat' =>$request->etat,
            'reglemment' =>$request->reglemment,
            'montant' =>$request->montant,
            'user_id'=>$id,
        ]);
        $Commande->save();
        return response()->json([
            'message' => 'Commande created!'
        ], 201);


    }
    public function get_commande_client_byid($id)
    {

        $carte = DB::table('commande_bon_valeurs as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('client', 'client.user_id', '=', 'users.id')
            ->where('c.user_id', $id)
            ->select ('users.*','client.*','c.*')
            ->first();
        if (is_null($carte)) {

            return response()->json(['data' => 'commande not found'], 404);
        }


        return response()->json($carte, 200);
    }
    public function get_commande_entreprise_byid($id)
    {

        $carte = DB::table('commande_bon_valeurs as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('entreprise', 'entreprise.user_id', '=', 'users.id')
            ->where('c.user_id', $id)
            ->select ('users.*','entreprise.*','c.*')
            ->first();
        if (is_null($carte)) {

            return response()->json(['data' => 'commande not found'], 404);
        }


        return response()->json($carte, 200);
    }
    public function update_commande(Request $request, $id)
    {
        /*$carte = DB::table('carte_agilis')
            ->where('id',$id)->first();*/
        $tableupdate = [];
        if (!empty($request->valide)) {$tableupdate['etat'] = $request->etat;}
        DB::table('commande_bon_valeurs')
            ->where('id',$id)
            ->update($tableupdate);
        return response( 201);
    }
}
