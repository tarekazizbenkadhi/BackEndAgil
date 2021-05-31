<?php

namespace App\Http\Controllers;

use App\commandeBonValeur;
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

        $Commande->rendez_vous_bv()->create([
            'user_id' => $id,
            'date_time_rv' => $request->date_time_rv,
            'commande_bon_valeur_id' => $Commande->id,

        ]);
        return response()->json([
            'message' => 'Commande created!'
        ], 201);


    }
    public function get_commande_client_byid($id)
    {

        $carte = DB::table('commande_bon_valeurs as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('client', 'client.user_id', '=', 'users.id')
            ->leftJoin('rendez_vous_bvs','rendez_vous_bvs.commande_bon_valeur_id', '=', 'c.id')
            ->where('c.user_id', $id)
            ->where('client.cin', '!=', 'null')
            ->select ('users.*','client.*','c.*','rendez_vous_bvs.*')
            ->get();
        if (is_null($carte)) {

            return response()->json(['data' => 'commande not found'], 404);
        }


        return response()->json($carte, 200);
    }
    public function get_commande_client_bv()
    {

        $bv = DB::table('commande_bon_valeurs as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('client', 'client.user_id', '=', 'users.id')
            ->leftJoin('rendez_vous_bvs','rendez_vous_bvs.commande_bon_valeur_id', '=', 'c.id')
            ->where('c.etat', '=', '0')
            ->where('client.cin', '!=', 'null')
            ->select ('users.*','client.*','c.*','rendez_vous_bvs.*')
            ->get();
        if (is_null($bv)) {

            return response()->json(['data' => 'commande not found'], 404);
        }


        return response()->json($bv, 200);
    }
    public function get_valid_commande_client_bv()
    {

        $bv = DB::table('commande_bon_valeurs as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('client', 'client.user_id', '=', 'users.id')
            ->leftJoin('rendez_vous_bvs','rendez_vous_bvs.commande_bon_valeur_id', '=', 'c.id')
            ->where('c.etat', '=', '1')
            ->where('client.cin', '!=', 'null')
            ->select ('users.*','client.*','c.*','rendez_vous_bvs.*')
            ->get();
        if (is_null($bv)) {

            return response()->json(['data' => 'commande not found'], 404);
        }


        return response()->json($bv, 200);
    }
    public function get_commande_entreprise_byid($id)
    {

        $bv = DB::table('commande_bon_valeurs as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('entreprise', 'entreprise.user_id', '=', 'users.id')
            ->leftJoin('rendez_vous_bvs','rendez_vous_bvs.commande_bon_valeur_id', '=', 'c.id')
            ->where('c.user_id', $id)
            ->where('entreprise.raison_sociale', '!=', 'null')
            ->select ('users.*','entreprise.*','c.*','rendez_vous_bvs.*')
            ->get();
        if (is_null($bv)) {

            return response()->json(['data' => 'commande not found'], 404);
        }


        return response()->json($bv, 200);
    }
    public function get_commande_entreprise_bv()
    {
        $bv = DB::table('commande_bon_valeurs as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('entreprise', 'entreprise.user_id', '=', 'users.id')
            ->leftJoin('rendez_vous_bvs','rendez_vous_bvs.commande_bon_valeur_id', '=', 'c.id')
            ->where('entreprise.raison_sociale', '!=', 'null')
            ->where('c.etat', '=', '0')
            ->select ('users.*','entreprise.*','c.*','rendez_vous_bvs.*')
            ->get();
        if (is_null($bv)) {

            return response()->json(['data' => 'commande not found'], 404);
        }


        return response()->json($bv, 200);
    }
    public function get_valid_commande_entreprise_bv()
    {

        $bv = DB::table('commande_bon_valeurs as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('entreprise', 'entreprise.user_id', '=', 'users.id')
            ->leftJoin('rendez_vous_bvs','rendez_vous_bvs.commande_bon_valeur_id', '=', 'c.id')
            ->where('entreprise.raison_sociale', '!=', 'null')
            ->where('c.etat', '=', '1')
            ->select ('users.*','entreprise.*','c.*','rendez_vous_bvs.*')
            ->get();
        if (is_null($bv)) {

            return response()->json(['data' => 'commande not found'], 404);
        }


        return response()->json($bv, 200);
    }

    public function update_commande(Request $request, $id)
    {
        /*$carte = DB::table('carte_agilis')
            ->where('id',$id)->first();*/
        $tableupdate = [];
        if (!empty($request->etat)) {$tableupdate['etat'] = $request->etat;}
        DB::table('commande_bon_valeurs')
            ->where('id',$id)
            ->update($tableupdate);
        return response( 201);
    }
}
