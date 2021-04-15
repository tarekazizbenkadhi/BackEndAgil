<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class SuperAdmin extends Controller
{
    public function get_super_admins()
    {
        $super_admins = DB::table('super_admin as a')
            ->join('users', 'users.id', '=', 'a.user_id')
            ->select('a.*','users.*')->get();
        return response()->json($super_admins, 200);
    }

    public function get_super_admins_byid($id)
    {

        $super_admins = DB::table('super_admin as a')
            ->join('users', 'users.id', '=', 'a.user_id')
            ->where('a.user_id', $id)->first();
        if (is_null($super_admins)) {

            return response()->json(['data' => '$super_admin not found'], 404);
        }


        return response()->json($super_admins, 200);
    }

    public function update_super_admins(Request $request, $id)
    {
        $super_admins = DB::table('$super_admin as a')
            ->join('users', 'users.id', '=', 'a.user_id')
            ->where('a.user_id', $id)->first();

        $super_admins = $request->all();
        if (is_null($super_admins)) {
            return response()->json(['message' => 'super_admins not found'], 404);
        }
        //**********************************
        $tableupdate = [];
        if (!empty($request->nom)) {$tableupdate['nom'] = $request->nom;}
        if (!empty($request->prenom)) {$tableupdate['prenom'] = $request->prenom;}
        if(!empty($request->poste)){ $tableupdate['poste'] = $request->poste;}

        DB::table('super_admin')
            ->where('user_id', $id)
            ->update($tableupdate);
        //if mta3 champs users
        $tableupdate1 = [];

        if(!empty($request->tel)){ $tableupdate1['tel'] = $request->tel;}
        if(!empty($request->fax)){ $tableupdate1['fax'] = $request->fax;}
        if(!empty($request->email)){ $tableupdate1['email'] = $request->email;}
        if(!empty($request->password)){ $tableupdate1['password'] = $request->password;}
        DB::table('user')
            ->where('id', $id)
            ->update($tableupdate1);


        //**********************************
        return response($super_admins, 201);
    }

}
