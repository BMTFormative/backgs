<?php

namespace App\Http\Controllers;
use App\Models\totalamount;
use Illuminate\Http\Request;

class TotalamountController extends Controller
{
    public function index()
    {
        $AllAmount = totalamount::all();
        return response()->json($AllAmount);
    }
    public function totalamountBySaleNumber($saleNumber)
    {
        $TotalAmount = totalamount::where('SaleNumber', $saleNumber)->first();
        return response()->json($TotalAmount);
    }
}
