<?php

namespace App\Http\Controllers;

use App\tarif_essence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TarifEssenceController extends Controller

{
    public function add_tarif_essence(Request $request)
    {
        $tarif = new tarif_essence([
            'tarif_essence' => $request->tarif_essence,

        ]);
        $tarif->save();

        return response()->json([
            'message' => 'tarif essence'
        ], 201);
    }

    public function get_tarif_essence()
    {
        {
            $tarif = DB::table('tarif_essences')
                ->select('tarif_essences.*')->first();
            return response()->json($tarif, 200);
        }
    }

    public function update_tarif_essence(Request $request, $id)
    {
        $tarif = [];
        if (!empty($request->tarif_essence)) {
            $tarif['tarif_essence'] = $request->tarif_essence;
        }

        DB::table('tarif_essences')
            ->where('id', $id)
            ->update($tarif);
        return response(201);
    }
}
