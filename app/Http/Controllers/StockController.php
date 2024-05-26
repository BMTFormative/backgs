<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;  // Ensure Log facade is imported
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return response()->json($stocks);
    }

    public function store(Request $request)
{
    DB::beginTransaction();
    try {
        foreach ($request->lineItems as $item) {
            $stock = new Stock([
                'ArrivalNumber' => $request->ArrivalNumber,
                'DateArrival' => $request->DateArrival,
                'SupplierId' => $request->SupplierId,
                'ProductId' => $item['ProductId'],
                'Qty' => $item['Qty'],
                'PrixAchat' => $item['PrixAchat'],
                'PrixGros' => $item['PrixGros'],
                'PrixDetail' => $item['PrixDetail']
            ]);
            $stock->save();
        }
        DB::commit();
        return response()->json(['message' => 'Stock added successfully'], 201);
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function show(Stock $stock)
    {
        return response()->json($stock);
    }

    public function update(Request $request, Stock $stock)
    {
        $stock->update($request->all());
        return response()->json($stock);
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return response()->json(null, 204);
    }
}
