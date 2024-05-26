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
        // Fetch all stocks
        $stocks = Stock::all();

        // Temporary array to hold grouped data
        $groupedData = [];

        // Iterate over stocks to group and format them
        foreach ($stocks as $stock) {
            $key = $stock->ArrivalNumber; // Group by ArrivalNumber

            // Initialize group if it doesn't exist
            if (!isset($groupedData[$key])) {
                $groupedData[$key] = [
                    'ArrivalNumber' => $stock->ArrivalNumber,
                    'SupplierId' => $stock->SupplierId,
                    'DateArrival' => $stock->DateArrival,
                    'lineItems' => [],
                    //'id' => $stock->id, // Assuming the ID remains relevant
                ];
            }

            // Add product to lineItems
            $groupedData[$key]['lineItems'][] = [
                'ProductId' => $stock->ProductId,
                'Qty' => $stock->Qty,
                'PrixAchat' => $stock->PrixAchat,
                'PrixGros' => $stock->PrixGros,
                'PrixDetail' => $stock->PrixDetail,
                'Montant' => $stock->Qty * $stock->PrixDetail // Calculate Montant based on Qty and PrixDetail
            ];
        }

        // Calculate total global for each group
        foreach ($groupedData as $key => $value) {
            $totalGlobal = 0;
            foreach ($value['lineItems'] as $item) {
                $totalGlobal += $item['Montant'];
            }
            $groupedData[$key]['TotalGlobal'] = $totalGlobal;
        }

        // Return response
        return response()->json(array_values($groupedData)); // Convert to array values to reindex keys
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

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            // Retrieve all stock entries with the given ArrivalNumber
            $stocks = Stock::where('ArrivalNumber', $request->ArrivalNumber)->get();

            if ($stocks->isEmpty()) {
                return response()->json(['message' => 'No stock found with the provided Arrival Number'], 404);
            }

            foreach ($stocks as $stock) {
                foreach ($request->lineItems as $item) {
                    // Update each stock entry if ProductId matches
                    if ($stock->ProductId == $item['ProductId']) {
                        $stock->update([
                            'DateArrival' => $request->DateArrival,
                            'SupplierId' => $request->SupplierId,
                            'Qty' => $item['Qty'],
                            'PrixAchat' => $item['PrixAchat'],
                            'PrixGros' => $item['PrixGros'],
                            'PrixDetail' => $item['PrixDetail']
                        ]);
                    }
                }
            }

            DB::commit();
            return response()->json(['message' => 'Stock updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function destroy(Stock $stock)
    {
        $stock->delete();
        return response()->json(null, 204);
    }
}
