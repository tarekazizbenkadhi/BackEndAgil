<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class gerantController extends Controller
{
    public function get_gerant()
    {
        $gerant = DB::table('gerants as a')
            ->join('users', 'users.id', '=', 'a.user_id')
            ->select('a.*','users.*')->get();
        return response()->json($gerant, 200);
    }
    public function get_gerant_byid($id)
    {

        $gerant = DB::table('gerants as a')
            ->join('users', 'users.id', '=', 'a.user_id')
            ->where('a.user_id', $id)->first();
        if (is_null($gerant)) {

            return response()->json(['data' => 'admin_livraison not found'], 404);
        }


        return response()->json($gerant, 200);
    }
}
