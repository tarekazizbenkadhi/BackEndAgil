<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntrepriseController extends Controller
{
    public function get_valide_entreprise() //valide
    {
        $entreprise = DB::table('entreprise as e')
            ->join('users', 'users.id', '=', 'e.user_id')
            ->where('e.valide', '=', '1')
            ->select('e.*', 'users.*')->get();
        return response()->json($entreprise, 200);
    }

    public function get_entreprise()
    {
        $entreprise = DB::table('entreprise as e')
            ->join('users', 'users.id', '=', 'e.user_id')
            ->where('e.valide', '=', 'false')
            ->select('e.*', 'users.*')->get();
        return response()->json($entreprise, 200);
    }

    public function get_entreprise_byid($id)
    {
        $entreprise = DB::table('entreprise')
            ->join('users', 'users.id', '=', 'entreprise.user_id')
            ->where('entreprise.user_id', $id)->first();
        if (is_null($entreprise)) {

            return response()->json(['data' => 'client not found'], 404);
        }
        return response()->json($entreprise, 200);
    }

    public function update_entreprise(Request $request, $id)
    {
        $entreprise = DB::table('entreprise')
            ->join('users', 'users.id', '=', 'entreprise.user_id')
            ->where('entreprise.user_id', $id)->first();

        $entreprise = $request->all();
        if (is_null($entreprise)) {
            return response()->json(['message' => 'entreprise not found'], 404);
        }
        //**********************************
        $tableupdate = [];
        if (!empty($request->raison_sociale)) {
            $tableupdate['raison_sociale'] = $request->raison_sociale;
        }
        if (!empty($request->activite)) {
            $tableupdate['activite'] = $request->activite;
        }
        if (!empty($request->forme_juridique)) {
            $tableupdate['forme_juridique'] = $request->forme_juridique;
        }
        if (!empty($request->responsable)) {
            $tableupdate['responsable'] = $request->responsable;
        }
        if (!empty($request->mobile)) {
            $tableupdate['mobile'] = $request->mobile;
        }
        if (!empty($request->email_res)) {
            $tableupdate['email_res'] = $request->email_res;
        }
        if (!empty($request->siege)) {
            $tableupdate['siege'] = $request->siege;
        }
        if (!empty($request->rib)) {
            $tableupdate['rib'] = $request->rib;
        }
        if (!empty($request->prevision)) {
            $tableupdate['prevision'] = $request->prevision;
        }
        if(!empty($request->valide)){ $tableupdate['valide'] = $request->valide;}
        DB::table('entreprise')
            ->where('user_id', $id)
            ->update($tableupdate);
        //if mta3 champs users
        $tableupdate1 = [];

        if (!empty($request->tel)) {
            $tableupdate1['tel'] = $request->tel;
        }
        if (!empty($request->fax)) {
            $tableupdate1['fax'] = $request->fax;
        }
        if (!empty($request->email)) {
            $tableupdate1['email'] = $request->email;
        }
        if (!empty($request->password)) {
            $tableupdate1['password'] = $request->password;
        }
        DB::table('users')
            ->where('id', $id)
            ->update($tableupdate1);


        //**********************************
        return response($entreprise, 201);
    }

}
