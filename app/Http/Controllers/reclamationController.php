<?php

namespace App\Http\Controllers;

use App\reclamtion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reclamationController extends Controller
{
    public function addReclamation(Request $request , $id)
    {

        // dd($id);

        $reclamation = new reclamtion([
            'text_reclamation' => $request->text_reclamation,
            'user_id'=>$id,
        ]);

        $reclamation->save();

        return response()->json([
            'message' => 'reclamation created!'
        ], 201);
    }
    public function get_reclamation()
    {

        $reclamation = DB::table('reclamtions as c')
            ->leftJoin('users', 'users.id', '=', 'c.user_id')
            ->select ('users.*','c.*')
            ->get();
        if (is_null($reclamation)) {

            return response()->json(['data' => 'reclamation not found'], 404);
        }


        return response()->json($reclamation, 200);
    }
}
