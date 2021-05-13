<?php

namespace App\Http\Controllers;

use App\rendez_vous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Rendez_vousAgilisController extends Controller
{
    public function addRVAgilis()
    {

        $rv = new rendez_vous([

            'a830'=>false,
            'a840'=>false,
            'a850'=>false,
            'a900'=>false,
            'a910'=>false,
            'a920'=>false,
            'a930'=>false,
            'a940'=>false,
            'a950'=>false,
            'a1000'=>false,
            'a1010'=>false,
            'a1020'=>false,
            'a1030'=>false,
            'a1040'=>false,
            'a1050'=>false,
            'a1100'=>false,
            'a1110'=>false,
            'a1120'=>false,
            'a1130'=>false,
            'a1140'=>false,
            'a1150'=>false,
            'a1200'=>false,
            'a1210'=>false,
            'a1220'=>false,
            'a1230'=>false,
            'a1240'=>false,
            'a1250'=>false,
            'a1410'=>false,
            'a1420'=>false,
            'a1430'=>false,
            'a1440'=>false,
            'a1450'=>false,
            'a1500'=>false,
            'a1510'=>false,
            'a1520'=>false,
            'a1530'=>false,
            'a1540'=>false,
            'a1550'=>false,
            'a1600'=>false,
            'a1610'=>false,
            'a1620'=>false,
            'a1630'=>false,
        ]);
        $rv->save();
        return response()->json([
            'message' => 'rendez-vous created!'
        ], 201);
    }

    public function get_rv_agilis()
    {
        $rv=DB::table('rendez_vouses as rv')
            ->select('rv.*')->get();
        return response()->json($rv, 200);
    }

    public function update_rv_agilis(Request $request, $id)
    {


        $rv = $request->all();
        if (is_null($rv)) {
            return response()->json(['message' => 'rendez_vous not found'], 404);
        }
        //**********************************
        $tableupdate = [];
        if (!empty($request->a830)) {$tableupdate['a830'] = $request->a830;}
        if (!empty($request->a840)) {$tableupdate['a840'] = $request->a840;}
        if (!empty($request->a850)) {$tableupdate['a850'] = $request->a850;}
        if (!empty($request->a900)) {$tableupdate['a900'] = $request->a900;}
        if (!empty($request->a910)) {$tableupdate['a910'] = $request->a910;}
        if (!empty($request->a920)) {$tableupdate['a920'] = $request->a920;}
        if (!empty($request->a930)) {$tableupdate['a930'] = $request->a930;}
        if (!empty($request->a940)) {$tableupdate['a940'] = $request->a940;}
        if (!empty($request->a950)) {$tableupdate['a950'] = $request->a950;}
        if (!empty($request->a1000)) {$tableupdate['a1000'] = $request->a1000;}
        if (!empty($request->a1010)) {$tableupdate['a1010'] = $request->a1010;}
        if (!empty($request->a1020)) {$tableupdate['a1020'] = $request->a1020;}
        if (!empty($request->a1030)) {$tableupdate['a1030'] = $request->a1030;}
        if (!empty($request->a1040)) {$tableupdate['a1040'] = $request->a1040;}
        if (!empty($request->a1050)) {$tableupdate['a1050'] = $request->a1050;}
        if (!empty($request->a1100)) {$tableupdate['a1100'] = $request->a1100;}
        if (!empty($request->a1110)) {$tableupdate['a1110'] = $request->a1110;}
        if (!empty($request->a1120)) {$tableupdate['a1120'] = $request->a1120;}
        if (!empty($request->a1130)) {$tableupdate['a1130'] = $request->a1130;}
        if (!empty($request->a1140)) {$tableupdate['a1140'] = $request->a1140;}
        if (!empty($request->a1150)) {$tableupdate['a1150'] = $request->a1150;}
        if (!empty($request->a1200)) {$tableupdate['a1200'] = $request->a1200;}
        if (!empty($request->a1210)) {$tableupdate['a1210'] = $request->a1210;}
        if (!empty($request->a1220)) {$tableupdate['a1220'] = $request->a1220;}
        if (!empty($request->a1230)) {$tableupdate['a1230'] = $request->a1230;}
        if (!empty($request->a1240)) {$tableupdate['a1240'] = $request->a1240;}
        if (!empty($request->a1250)) {$tableupdate['a1250'] = $request->a1250;}
        if (!empty($request->a1300)) {$tableupdate['a1300'] = $request->a1300;}
        if (!empty($request->a1410)) {$tableupdate['a1410'] = $request->a1410;}
        if (!empty($request->a1420)) {$tableupdate['a1420'] = $request->a1420;}
        if (!empty($request->a1430)) {$tableupdate['a1430'] = $request->a1430;}
        if (!empty($request->a1440)) {$tableupdate['a1440'] = $request->a1440;}
        if (!empty($request->a1450)) {$tableupdate['a1450'] = $request->a1450;}
        if (!empty($request->a1500)) {$tableupdate['a1500'] = $request->a1500;}
        if (!empty($request->a1510)) {$tableupdate['a1510'] = $request->a1510;}
        if (!empty($request->a1520)) {$tableupdate['a1520'] = $request->a1520;}
        if (!empty($request->a1530)) {$tableupdate['a1530'] = $request->a1530;}
        if (!empty($request->a1540)) {$tableupdate['a1540'] = $request->a1540;}
        if (!empty($request->a1550)) {$tableupdate['a1550'] = $request->a1550;}
        if (!empty($request->a1600)) {$tableupdate['a1600'] = $request->a1600;}
        if (!empty($request->a1610)) {$tableupdate['a1610'] = $request->a1610;}
        if (!empty($request->a1620)) {$tableupdate['a1620'] = $request->a1620;}
        if (!empty($request->a1630)) {$tableupdate['a1630'] = $request->a1630;}



        DB::table('rendez_vouses')
            ->where('id', $id)
            ->update($tableupdate);



        //**********************************
        return response($rv, 201);
    }

}
