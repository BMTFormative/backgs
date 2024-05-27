<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\totalpayment;
use App\Models\totalamount;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        // Fetch all sales
        $sales = Sale::with(['customer', 'product'])->get();
     
        // Temporary array to hold grouped data
        $groupedData = [];

        // Iterate over sales to group and format them
        foreach ($sales as $sale) {
            $key = $sale->SaleNumber; // Group by SaleNumber
            // Fetch total payments grouped by SaleNumber
            $TotalPay = totalpayment::where('SaleNumber', $key)->first();
            $TotalSale = totalamount::where('SaleNumber', $key)->first();
            // Initialize group if it doesn't exist
            if (!isset($groupedData[$key])) {
                $groupedData[$key] = [
                    'SaleNumber' => $sale->SaleNumber,
                    'CustomerId' => $sale->CustomerId,
                    'DateSale' => $sale->DateSale,
                    'OrderType' => $sale->OrderType,
                    'DynamicFields' => [],
                    'TotalPayment' => $TotalPay->totalpayment ?? 0, // Default to 0 if no payment exists
                    'TotalAmount' => $TotalSale->totalamount ?? 0, // Default to 0 if no payment exists
                    'CustomerName' => $sale->customer ? $sale->customer->Nom : 'Unknown', // Accessing customer's name
                    //'id' => $sale->id, // Assuming the ID remains relevant
                ];
            }

            // Add product to DynamicFields
            $groupedData[$key]['DynamicFields'][] = [
                'ProductId' => $sale->ProductId,
                'Designation' => $sale->product->Designation, // Assuming 'Designation' is the name of the field in the Product model
                'Qty' => $sale->Qty,
                'PrixVente' => $sale->Prix,
                'Montant' => $sale->Qty * $sale->Prix // Calculate Montant based on Qty and PrixDetail
            ];
        }

        // Calculate total global for each group
        foreach ($groupedData as $key => $value) {
            $totalGlobal = 0;
            foreach ($value['DynamicFields'] as $item) {
                $totalGlobal += $item['Montant'];
            }
            $groupedData[$key]['TotalGlobal'] = $totalGlobal;
        }

        // Return response
        return response()->json(array_values($groupedData)); // Convert to array values to reindex keys
    }

    public function store(Request $request)
    {
        $jsonData = json_decode($request->getContent(), true); // Assuming the JSON is sent in the request body

        // Loop through each item in the JSON array (DynamicFields)
        foreach ($jsonData['DynamicFields'] as $item) {
            $sale = new Sale();
            $sale->SaleNumber = $jsonData['SaleNumber'];
            $sale->DateSale = $jsonData['DateSale'];
            $sale->OrderType = $jsonData['OrderType'];
            $sale->CustomerId = $jsonData['CustomerId']; // Assuming CustomerId is the CustomerId
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

