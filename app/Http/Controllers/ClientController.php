<?php

namespace App\Http\Controllers;

use App\Client;
use http\Env\Response;
use Illuminate\Http\Request;
use DB;
class ClientController extends Controller
{

    public function get_client(){
        return response()->json(Client::all(),200);
    }

    public function get_client_byid($id){

        $client= DB::table('client')
            ->join('users', 'users.id', '=', 'client.user_id')
            ->where('client.user_id',$id)->first();
        if (is_null($client))
        {

            return response()->json(['data'=>'client not found'],404);
        }


        return response()->json($client,200);
    }

    public function update_client(Request $request,$id)
    {
        $client= DB::table('client')
            ->join('users', 'users.id', '=', 'client.user_id')
            ->where('client.user_id',$id)->first();
        if (is_null($client))
        {
            return response()->json(['message'=>'client not found'],404);
        }
        $client->update($request->all());
        return response($client,201);
    }

   /* public function desactive_client(Request $request,$id)
    {

    }*/
}
