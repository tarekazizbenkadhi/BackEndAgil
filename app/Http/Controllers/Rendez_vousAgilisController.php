<?php

namespace App\Http\Controllers;

use App\rendez_vous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Rendez_vousAgilisController extends Controller
{
//    public function addRVAgilis(Request $request, $id)
//    {
//
//        $rv = DB::table('rendez_vouses as rv')
//            ->select('rv.*')->where('date_time_rv', $request->date_time_rv)->get();
//        if (count($rv) > 0) {
//
//              return response()->json([
//                'message' => 'rendez-vous exists!'
//            ], 201);
//
//        } else {
//            $rv = new rendez_vous([
//                'date_time_rv' => $request->date_time_rv,
//                'user_id' => $id,
//            ]);
//            $rv->save();
//            return response()->json([
//                'message' => 'rendez-vous created!'
//            ], 201);
//        }
//    }

    public function get_rv_agilis()
    {
        $rv = DB::table('rendez_vouses as rv')
            ->Join('carte_agilis', 'carte_agilis.id', '=', 'rv.carte_agilis_id')
            ->select('rv.*','carte_agilis.*')->get();
        return response()->json($rv, 200);
    }
    public function get_rv_agilis_by_id($id)
    {
        $rv = DB::table('rendez_vouses as rv')
            ->leftJoin('users', 'users.id', '=', 'rv.user_id')
            ->where('users.id',$id)
            ->select('rv.*')->get();
        return response()->json($rv, 200);
    }

    public function update_rv_agilis(Request $request, $id)
    {

        $oc = DB::table('rendez_vouses as rv')
            ->select('rv.*')->where('date_time_rv', $request->date_time_rv)->get();
        $rv=$request->all();
        if (count($oc) > 0) {

            return response()->json([
                'message' => 'rendez-vous exists!'
            ], 401);

        } else {
            $tableupdate = [];
            if (!empty($request->date_time_rv)) {
                $tableupdate['date_time_rv'] = $request->date_time_rv;
            }
//            dd($tableupdate);





            DB::table('rendez_vouses')
               // ->leftJoin('users', 'users.id', '=', 'rendez_vouses.user_id')
                ->where('id', $id)
                ->update($tableupdate);


            //**********************************
            return response()->json([$rv,
                'message' => 'updated succesfully!'
            ], 201);
        }
    }

}
