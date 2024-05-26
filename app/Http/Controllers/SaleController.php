<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['supplier', 'product'])->get();
        return response()->json($sales);
    }

    public function store(Request $request)
    {
        $sale = Sale::create($request->all());
        return response()->json($sale, 201);
    }

    public function show(Sale $sale)
    {
        return response()->json($sale->load(['supplier', 'product']));
    }

    public function update(Request $request, Sale $sale)
    {
        $sale->update($request->all());
        return response()->json($sale);
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return response()->json(null, 204);
    }
}

