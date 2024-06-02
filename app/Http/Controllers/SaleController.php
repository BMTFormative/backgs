<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Customer;
use App\Models\totalpayment;
use App\Models\totalamount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
    public function index()
    {
        // Fetch all sales with related customer and product details loaded
        $sales = Sale::with(['customer', 'saledetail.product'])->get();

        // Temporary array to hold formatted data
        $groupedData = [];

        // Iterate over each sale to format and group them
        foreach ($sales as $sale) {
            $key = $sale->SaleNumber; // Group by SaleNumber

            if (!isset($groupedData[$key])) {
                $groupedData[$key] = [
                    'id' => $sale->id,
                    'SaleNumber' => $sale->SaleNumber,
                    'CustomerId' => $sale->CustomerId,
                    'CustomerName' => $sale->customer ? $sale->customer->Nom : 'Unknown',
                    'DateSale' => $sale->DateSale, // Ensure the date format is correct
                    'OrderType' => $sale->OrderType,
                    'DynamicFields' => [],
                    'TotalPayment' => 0, // Initialize TotalPayment
                    'TotalAmount' => $sale->TotalAmount, 
                ];
            }

            // Process each sale detail item
            if ($sale->saledetail) {
                $detail = $sale->saledetail; // Access the Saledetail directly since it's not a collection
                $groupedData[$key]['DynamicFields'][] = [
                    'ProductId' => $detail->ProductId,
                    'Designation' => $detail->product ? $detail->product->Designation : 'Unknown',
                    'Qty' => $detail->Qty,
                    'PrixVente' => $detail->PrixVente,
                    'Montant' => $detail->Montant, // Calculate Montant
                ];
    
            }

            // You might need additional data handling to calculate TotalPayment, assuming it's from a different model or calculation
        }

        // Optionally calculate total global for each group, if necessary
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
        DB::beginTransaction();
        try {
            // Initialize the sale with the initial data
            $sale = new Sale([
                'SaleNumber' => $request->SaleNumber,
                'CustomerId' => $request->CustomerId,
                'DateSale' => $request->DateSale,
                'OrderType' => $request->OrderType,
            ]);
            $sale->save();

            $totalAmount = 0; // Initialize total amount
            $totaltax = 0; // Initialize total tax
            $totaldiscount = 0; // Initialize total discount
            // Verify if sale details are provided and are in an array format
            if (isset($request->DynamicFields) && is_array($request->DynamicFields)) {
                foreach ($request->DynamicFields as $item) {
                    // Calculate Montant for each item
                    $montant = $item['Qty'] * $item['PrixVente'];

                    // Create each sale detail
                    $saleDetail = new SaleDetail([
                        'SaleId' => $sale->id,
                        'ProductId' => $item['ProductId'],
                        'Qty' => $item['Qty'],
                        'PrixVente' => $item['PrixVente'],
                        'Montant' => $montant, // Use the calculated Montant
                    ]);
                    $saleDetail->save();

                    // Accumulate the total amount
                    $totalAmount += $montant;
                }

                // Update the sale's total amount if needed
                $sale->TotalAmount = $totalAmount;
                $sale->TotalAmountWith = $totalAmount + $totaltax - $totaldiscount;
                $sale->save();
            } else {
                throw new Exception("Invalid or missing dynamic fields");
            }

            DB::commit();
            return response()->json(['message' => 'Sale and details added successfully', 'TotalAmount' => $totalAmount], 201);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
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

