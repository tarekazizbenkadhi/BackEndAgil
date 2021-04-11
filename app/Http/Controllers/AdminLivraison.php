<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLivraison extends Controller
{
    public function get_admin_livraisons()
    {
        $admin_livraisons = DB::table('admin_livraisons as a')
            ->join('users', 'users.id', '=', 'a.user_id')
            ->select('a.*','users.*')->get();
        return response()->json($admin_livraisons, 200);
    }

    public function get_admin_livraisons_byid($id)
    {

        $admin_livraisons = DB::table('admin_livraisons as a')
            ->join('users', 'users.id', '=', 'a.user_id')
            ->where('a.user_id', $id)->first();
        if (is_null($admin_livraisons)) {

            return response()->json(['data' => 'admin_livraisons not found'], 404);
        }


        return response()->json($admin_livraisons, 200);
    }

    public function update_admin_livraisons(Request $request, $id)
    {
        $admin_livraisons = DB::table('admin_livraisons as a')
            ->join('users', 'users.id', '=', 'a.user_id')
            ->where('a.user_id', $id)->first();

        $admin_livraisons = $request->all();
        if (is_null($admin_livraisons)) {
            return response()->json(['message' => 'admin_livraisons not found'], 404);
        }
        //**********************************
        $tableupdate = [];
        if (!empty($request->nom)) {$tableupdate['nom'] = $request->nom;}
        if (!empty($request->prenom)) {$tableupdate['prenom'] = $request->prenom;}
        if(!empty($request->poste)){ $tableupdate['poste'] = $request->poste;}

        DB::table('admin_livraisons')
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
        return response($admin_livraisons, 201);
    }

}
