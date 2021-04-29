<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function createStock(Request $request)
    {
        $request->validate([
            'quinze' => 'required',
            'trente' => 'required',
            'cinquante' => 'required',]);

        $stock = new Stock([
            'quinze' => $request->quinze,
            'trente' => $request->trente,
            'cinquante' => $request->cinquante,
        ]);
        $stock->save();
        return response()->json([
            'message' => 'Successfully created stock!'
        ], 201);
    }

    public function AddStock(Request $request)
    {
        DB::table('stocks')
            ->where('id', 1)
            ->increment('quinze', $request->quinze);
        DB::table('stocks')
            ->where('id', 1)
            ->increment('trente', $request->trente);
        DB::table('stocks')
            ->where('id', 1)
            ->increment('cinquante', $request->cinquante);
        return response(201);
    }

    public function SubStock(Request $request)
    {
        DB::table('stocks')
            ->where('id', 1)
            ->decrement('quinze', $request->quinze);
             DB::table('stocks')
                 ->where('id', 1)
            ->decrement('trente', $request->trente);
                  DB::table('stocks')
                      ->where('id', 1)
            ->decrement('cinquante', $request->cinquante);
        return response(201);
    }
}
