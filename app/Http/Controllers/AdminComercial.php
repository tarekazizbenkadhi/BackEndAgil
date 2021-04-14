<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminComercial extends Controller
{
    public function get_admin_commercials()
    {
        $admin_commercials = DB::table('admin_commercial as a')
            ->join('users', 'users.id', '=', 'a.user_id')
            ->select('a.*','users.*')->get();
        return response()->json($admin_commercials, 200);
    }

    public function get_admin_commercials_byid($id)
    {

        $admin_commercials = DB::table('admin_commercial as a')
            ->join('users', 'users.id', '=', 'a.user_id')
            ->where('a.user_id', $id)->first();
        if (is_null($admin_commercials)) {

            return response()->json(['data' => 'admin_commercial not found'], 404);
        }


        return response()->json($admin_commercials, 200);
    }

    public function update_admin_commercials(Request $request, $id)
    {
        $admin_commercials = DB::table('admin_commercial as a')
            ->join('users', 'users.id', '=', 'a.user_id')
            ->where('a.user_id', $id)->first();

        $admin_commercials = $request->all();
        if (is_null($admin_commercials)) {
            return response()->json(['message' => 'admin_commercial not found'], 404);
        }
        //**********************************
        $tableupdate = [];
        if (!empty($request->nom)) {$tableupdate['nom'] = $request->nom;}
        if (!empty($request->prenom)) {$tableupdate['prenom'] = $request->prenom;}
        if(!empty($request->poste)){ $tableupdate['poste'] = $request->poste;}

        DB::table('admin_commercial')
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
        return response($admin_commercials, 201);
    }

}
