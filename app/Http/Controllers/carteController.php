<?php

namespace App\Http\Controllers;

use App\carte_agilis;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class carteController extends Controller
{
    //
    public function addCarte(Request $request , $id)
    {

       // dd($id);

        $carte = new carte_agilis([
            'mere_ss' => $request->mere_ss,
            'mere_g' => $request->mere_g,
            'mere_g50' => $request->mere_g50,
            'nb_carte_ss' =>$request->nb_carte_ss,
            'nb_carte_g' =>$request->nb_carte_g,
            'valide' => 0,
            'nb_carte_g50' =>$request->nb_carte_g50,
            'user_id'=>$id,
        ]);



        $carte->save();
        return response()->json([
            'message' => 'carte created!'
        ], 201);


    }
    public function get_carte()
    {
              $carte=DB::table('carte_agilis as c')
                  ->leftJoin('users', 'users.id', '=', 'c.user_id')
                ->leftJoin('client', 'client.user_id', '=', 'users.id')
              ->select ('users.*','client.*','c.*')->get();
        return response()->json($carte, 200);
    }

    public function get_carte_client_byid($id)
    {

        $carte = DB::table('carte_agilis as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('client', 'client.user_id', '=', 'users.id')
            ->where('c.user_id', $id)
            ->select ('users.*','client.*','c.*')
            ->first();
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
            ->select ('users.*','entreprise.*','c.*')
            ->first();
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
        if (!empty($request->valide)) {$tableupdate['valide'] = $request->valide;}
        DB::table('carte_agilis')
            ->where('id',$id)
            ->update($tableupdate);
        return response( 201);
    }
}
