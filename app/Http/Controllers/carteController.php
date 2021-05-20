<?php

namespace App\Http\Controllers;

use App\carte_agilis;
use App\rendez_vous;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class carteController extends Controller
{
    //
    public function addCarte(Request $request, $id)
    {

        // dd($id);

        $carte = new carte_agilis([
            'mere_ss' => $request->mere_ss,
            'mere_g' => $request->mere_g,
            'mere_g50' => $request->mere_g50,
            'nb_carte_ss' => $request->nb_carte_ss,
            'nb_carte_g' => $request->nb_carte_g,
            'etat' => 0,
            'nb_carte_g50' => $request->nb_carte_g50,
            'user_id' => $id,

        ]);
        $carte->save();


        $carte->rendez_vous()->create([
            'user_id' => $id,
            'date_time_rv' => $request->date_time_rv,
            'carte_agilis_id' => $carte->id,

        ]);


        return response()->json([
            'message' => 'carte created!'
        ], 201);


    }

    public function get_carte_client()
    {
        $carte = DB::table('carte_agilis as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('client', 'client.user_id', '=', 'users.id')
            ->where('client.cin', '!=', 'null')
            ->where('c.etat', '=', 'false')
            ->select('c.*', 'users.*', 'client.*')->get();
        return response()->json($carte, 200);
    }


    public function get_valide_carte_client()
    {
        $carte = DB::table('carte_agilis as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('client', 'client.user_id', '=', 'users.id')
            ->where('client.cin', '!=', 'null')
            ->where('c.etat', '=', '1')
            ->select('c.*', 'users.*', 'client.*')->get();
        return response()->json($carte, 200);
    }
    public function get_valide_carte_client_by_cin($cin)
    {
        $carte = DB::table('carte_agilis as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('client', 'client.user_id', '=', 'users.id')
            ->where('client.cin', '!=', 'null')
            ->where('client.cin', $cin)
            ->where('c.etat', '=', '1')
            ->select('c.*', 'users.*', 'client.*')->get();
        return response()->json($carte, 200);
    }

    public function get_carte_client_by_cin($cin)
    {
        $carte = DB::table('carte_agilis as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('client', 'client.user_id', '=', 'users.id')
            ->where('c.etat', '=', 'false')
            ->where('client.cin', $cin)
            ->select('c.*', 'users.*', 'client.*')->get();
        return response()->json($carte, 200);
    }

    public function get_carte_entreprise()
    {
        $carte = DB::table('carte_agilis as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('entreprise', 'entreprise.user_id', '=', 'users.id')
            ->where('entreprise.raison_sociale', '!=', 'null')
            ->where('c.etat', '=', 'false')
            ->select('c.*', 'users.*', 'entreprise.*')->get();
        return response()->json($carte, 200);
    }

    public function get_valide_carte_entreprise()
    {
        $carte = DB::table('carte_agilis as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('entreprise', 'entreprise.user_id', '=', 'users.id')
            ->where('entreprise.raison_sociale', '!=', 'null')
            ->where('c.etat', '=', '1')
            ->select('c.*', 'users.*', 'entreprise.*')->get();
        return response()->json($carte, 200);
    }
    public function get_valide_carte_entreprise_by_matFiscal($mat_fiscal)
    {
        $carte = DB::table('carte_agilis as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('entreprise', 'entreprise.user_id', '=', 'users.id')
            ->where('entreprise.raison_sociale', '!=', 'null')
            ->where('entreprise.mat_fiscal', $mat_fiscal)
            ->where('c.etat', '=', '1')
            ->select('c.*', 'users.*', 'entreprise.*')->get();
        return response()->json($carte, 200);
    }

    public function get_carte_entreprise_by_matFiscal($mat_fiscal)
    {
        $carte = DB::table('carte_agilis as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('entreprise', 'entreprise.user_id', '=', 'users.id')
            ->where('c.etat', '=', 'false')
            ->where('entreprise.mat_fiscal', $mat_fiscal)
            ->select('c.*', 'users.*', 'entreprise.*')->get();
        return response()->json($carte, 200);
    }

    public function get_carte_client_byid($id)
    {

        $carte = DB::table('carte_agilis as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('client', 'client.user_id', '=', 'users.id')
            ->where('c.user_id', $id)
            ->select('c.*', 'users.*', 'client.*')
            ->get();
        if (is_null($carte)) {

            return response()->json(['data' => 'carte not found'], 404);
        }


        return response()->json($carte, 200);
    }

    public function get_carte_entreprise_byid($id)
    {

        $carte = DB::table('carte_agilis as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('entreprise', 'entreprise.user_id', '=', 'users.id')
            ->where('c.user_id', $id)
            ->select('c.*', 'users.*', 'entreprise.*')
            ->get();
        if (is_null($carte)) {

            return response()->json(['data' => 'carte not found'], 404);
        }


        return response()->json($carte, 200);
    }

    public function update_carte(Request $request, $id)
    {
        /*$carte = DB::table('carte_agilis')
            ->where('id',$id)->first();*/
        $tableupdate = [];
        if (!empty($request->etat)) {
            $tableupdate['etat'] = $request->etat;
        }
        DB::table('carte_agilis')
            ->where('user_id', $id)
            ->update($tableupdate);
        return response(201);
    }
}
