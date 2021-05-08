<?php

namespace App\Http\Controllers;

use App\vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class vehiculeController extends Controller
{
    public function addVehicule(Request $request , $id)
    {

        // dd($id);
        $vehicule = new vehicule([
            'immatriculation' => $request->immatriculation,
            'marque' => $request->marque,
            'user_id'=>$id,
        ]);



        $vehicule->save();
        return response()->json([
            'message' => 'vehicule created!'
        ], 201);


    }
    public function get_vehicule_client_byid($id)
    {
        $vehicule = DB::table('vehicules as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->where('c.user_id', $id)
            ->select('c.*')->get();
        return response()->json($vehicule, 200);
    }

}
