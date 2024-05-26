<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['customer', 'product'])->get();
        return response()->json($sales);
    }

    public function store(Request $request)
    {
        $jsonData = json_decode($request->getContent(), true); // Assuming the JSON is sent in the request body

        // Loop through each item in the JSON array (DynamicFields)
        foreach ($jsonData['DynamicFields'] as $item) {
            $sale = new Sale();
            $sale->SaleNumber = $jsonData['SaleNumber'];
            $sale->DateSale = $jsonData['Datesale'];
            $sale->OrderType = $jsonData['OrderType'];
            $sale->SupplierId = $jsonData['CustomerId']; // Assuming CustomerId is the SupplierId
            $sale->ProductId = $item['ProductId'];
            $sale->Qty = $item['Qty'];
            $sale->Prix = $item['PrixVente'];

            $sale->save();
        }

        return response()->json(['message' => 'Data stored successfully!']);
    }

    public function show(Sale $sale)
    {
        return response()->json($sale->load(['customer', 'product']));
    }

    public function update(Request $request, Sale $sale)
    {
        $sale->update($request->all());
        return response()->json($sale);
    }

    public function destroy($saleNumber)
    {
        $sale = Sale::where('SaleNumber', $saleNumber);

        if (!$sale) {
            return response()->json(['message' => 'Sale not found'], 404);
        }

        $sale->delete();
        return response()->json(null, 204); // 204 No Content for successful deletion without response body
    }
    public function fetchBySaleNumber($saleNumber)
        {
            $sale = Sale::where('SaleNumber', $saleNumber)->first();

            if (!$sale) {
                return response()->json(['message' => 'Sale not found', 'found' => false]); // Return 200 with message
            }

            return response()->json($sale);
        }


}

