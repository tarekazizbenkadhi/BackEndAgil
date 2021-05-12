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

            '8:30'=>false,
            '8:40'=>false,
            '8:50'=>false,
            '9:00'=>false,
            '9:10'=>false,
            '9:20'=>false,
            '9:30'=>false,
            '9:40'=>false,
            '9:50'=>false,
            '10:00'=>false,
            '10:10'=>false,
            '10:20'=>false,
            '10:30'=>false,
            '10:40'=>false,
            '10:50'=>false,
            '11:00'=>false,
            '11:10'=>false,
            '11:20'=>false,
            '11:30'=>false,
            '11:40'=>false,
            '11:50'=>false,
            '12:00'=>false,
            '12:10'=>false,
            '12:20'=>false,
            '12:30'=>false,
            '12:40'=>false,
            '12:50'=>false,
            '14:10'=>false,
            '14:20'=>false,
            '14:30'=>false,
            '14:40'=>false,
            '14:50'=>false,
            '15:00'=>false,
            '15:10'=>false,
            '15:20'=>false,
            '15:30'=>false,
            '15:40'=>false,
            '15:50'=>false,
            '16:00'=>false,
            '16:10'=>false,
            '16:20'=>false,
            '16:30'=>false,
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
        if (!empty($request->a830)) {$tableupdate['8:30'] = $request->a830;}
        if (!empty($request->a840)) {$tableupdate['8:40'] = $request->a840;}
        if (!empty($request->a850)) {$tableupdate['8:50'] = $request->a850;}
        if (!empty($request->a900)) {$tableupdate['9:00'] = $request->a900;}
        if (!empty($request->a910)) {$tableupdate['9:10'] = $request->a910;}
        if (!empty($request->a920)) {$tableupdate['9:20'] = $request->a920;}
        if (!empty($request->a930)) {$tableupdate['9:30'] = $request->a930;}
        if (!empty($request->a940)) {$tableupdate['9:40'] = $request->a940;}
        if (!empty($request->a950)) {$tableupdate['9:50'] = $request->a950;}
        if (!empty($request->a1000)) {$tableupdate['10:00'] = $request->a1000;}
        if (!empty($request->a1010)) {$tableupdate['10:10'] = $request->a1010;}
        if (!empty($request->a1020)) {$tableupdate['10:20'] = $request->a1020;}
        if (!empty($request->a1030)) {$tableupdate['10:30'] = $request->a1030;}
        if (!empty($request->a1040)) {$tableupdate['10:40'] = $request->a1040;}
        if (!empty($request->a1050)) {$tableupdate['10:50'] = $request->a1050;}
        if (!empty($request->a1100)) {$tableupdate['11:00'] = $request->a1100;}
        if (!empty($request->a1110)) {$tableupdate['11:10'] = $request->a1110;}
        if (!empty($request->a1120)) {$tableupdate['11:20'] = $request->a1120;}
        if (!empty($request->a1130)) {$tableupdate['11:30'] = $request->a1130;}
        if (!empty($request->a1140)) {$tableupdate['11:40'] = $request->a1140;}
        if (!empty($request->a1150)) {$tableupdate['11:50'] = $request->a1150;}
        if (!empty($request->a1200)) {$tableupdate['12:00'] = $request->a1200;}
        if (!empty($request->a1210)) {$tableupdate['12:10'] = $request->a1210;}
        if (!empty($request->a1220)) {$tableupdate['12:20'] = $request->a1220;}
        if (!empty($request->a1230)) {$tableupdate['12:30'] = $request->a1230;}
        if (!empty($request->a1240)) {$tableupdate['12:40'] = $request->a1240;}
        if (!empty($request->a1250)) {$tableupdate['12:50'] = $request->a1250;}
        if (!empty($request->a1300)) {$tableupdate['13:00'] = $request->a1300;}
        if (!empty($request->a1410)) {$tableupdate['14:10'] = $request->a1410;}
        if (!empty($request->a1420)) {$tableupdate['14:20'] = $request->a1420;}
        if (!empty($request->a1430)) {$tableupdate['14:30'] = $request->a1430;}
        if (!empty($request->a1440)) {$tableupdate['14:40'] = $request->a1440;}
        if (!empty($request->a1450)) {$tableupdate['14:50'] = $request->a1450;}
        if (!empty($request->a1500)) {$tableupdate['15:00'] = $request->a1500;}
        if (!empty($request->a1510)) {$tableupdate['15:10'] = $request->a1510;}
        if (!empty($request->a1520)) {$tableupdate['15:20'] = $request->a1520;}
        if (!empty($request->a1530)) {$tableupdate['15:30'] = $request->a1530;}
        if (!empty($request->a1540)) {$tableupdate['15:40'] = $request->a1540;}
        if (!empty($request->a1550)) {$tableupdate['15:50'] = $request->a1550;}
        if (!empty($request->a1600)) {$tableupdate['16:00'] = $request->a1600;}
        if (!empty($request->a1610)) {$tableupdate['16:10'] = $request->a1610;}
        if (!empty($request->a1620)) {$tableupdate['16:20'] = $request->a1620;}
        if (!empty($request->a1630)) {$tableupdate['16:30'] = $request->a1630;}



        DB::table('rendez_vouses')
            ->where('id', $id)
            ->update($tableupdate);



        //**********************************
        return response($rv, 201);
    }

}
