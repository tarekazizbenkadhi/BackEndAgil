<?php

namespace App\Http\Controllers;

use App\Client;
use http\Env\Response;
use Illuminate\Http\Request;
use DB;

class ClientController extends Controller
{

    public function get_client()
    {
        $client = DB::table('client as c')
            ->join('users', 'users.id', '=', 'c.user_id')
            ->select('c.*','users.*')->get();
             return response()->json($client, 200);
    }

    public function get_client_byid($id)
    {

        $client = DB::table('client')
            ->join('users', 'users.id', '=', 'client.user_id')
            ->where('client.user_id', $id)->first();
        if (is_null($client)) {

            return response()->json(['data' => 'client not found'], 404);
        }


        return response()->json($client, 200);
    }

    public function update_client(Request $request, $id)
    {
        $client = DB::table('client')
            ->join('users', 'users.id', '=', 'client.user_id')
            ->where('client.user_id', $id)->first();

        $client = $request->all();
        if (is_null($client)) {
            return response()->json(['message' => 'client not found'], 404);
        }
        //**********************************
        $tableupdate = [];
        if (!empty($request->nom)) {$tableupdate['nom'] = $request->nom;}
        if (!empty($request->prenom)) {$tableupdate['prenom'] = $request->prenom;}
        if(!empty($request->cin)){ $tableupdate['cin'] = $request->cin;}
        if(!empty($request->lieu_cin)){ $tableupdate['lieu_cin'] = $request->lieu_cin;}
        if(!empty($request->date_cin)){ $tableupdate['date_cin'] = $request->date_cin;}
        if(!empty($request->adresse)){ $tableupdate['adresse'] = $request->adresse;}
        if(!empty($request->code_postal)){ $tableupdate['code_postal'] = $request->code_postal;}
        if(!empty($request->ville)){ $tableupdate['ville'] = $request->ville;}
        DB::table('client')
            ->where('user_id', $id)
            ->update($tableupdate);
        //if mta3 champs users
        $tableupdate1 = [];

        if(!empty($request->tel)){ $tableupdate1['tel'] = $request->tel;}
        if(!empty($request->fax)){ $tableupdate1['fax'] = $request->fax;}
        if(!empty($request->email)){ $tableupdate1['email'] = $request->email;}
        if(!empty($request->password)){ $tableupdate1['password'] = $request->password;}
        DB::table('users')
            ->where('id', $id)
            ->update($tableupdate1);


        //**********************************
        return response($client, 201);
    }

    /* public function desactive_client(Request $request,$id)
     {

     }*/
}
