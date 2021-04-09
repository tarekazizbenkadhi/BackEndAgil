<?php

namespace App\Http\Controllers;

use App\Client;
use http\Env\Response;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function get_client(){
        return response()->json(Client::all(),200);
    }

    public function get_client_byid($id){

        $client=Client::find($id);
        if (is_null($client))
        {
            return response()->json(['message'=>'client not found'],404);
        }
        return response()->json(Client::find($id),200);
    }

    public function update_client(Request $request,$id)
    {
        $client=Client::find($id);
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
