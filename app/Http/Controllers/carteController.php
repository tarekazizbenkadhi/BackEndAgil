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
    public function addCarte($id)
    {

       // dd($id);
        $carte = new carte_agilis([
            'num_carte' => '1512'.rand().'0210',
            'solde' => '0',
            'date_exp' => date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 730 day")),
            'code_secret' => rand(pow(10, 4-1), pow(10, 4)-1),
            'user_id' =>$id,
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

    public function get_carte_byid($id)
    {

        $carte = DB::table('carte_agilis as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->leftJoin('client', 'client.user_id', '=', 'users.id')
            ->where('c.user_id', $id)
            ->select ('users.*','client.*','c.*')
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

        DB::table('carte_agilis')
            ->where('id',$id)
            ->increment('solde',$request->solde);
        return response( 201);
    }
}
