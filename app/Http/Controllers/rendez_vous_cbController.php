<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class rendez_vous_cbController extends Controller
{
    public function get_rv_cmd_cb_by_id($id)
    {
        $rv = DB::table('rendez_vous_cbs as rv')
            ->leftJoin('users', 'users.id', '=', 'rv.user_id')
            ->where('users.id', $id)
            ->select('rv.*')->get();
        return response()->json($rv, 200);
    }

    public function update_rv_cmd_cb(Request $request, $id)
    {

        $oc = DB::table('rendez_vous_cbs as rv')
            ->select('rv.*')->where('date_time_rv', $request->date_time_rv)->get();
        $rv = $request->all();
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


            DB::table('rendez_vous_cbs')
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
