<?php

namespace App\Http\Controllers;
use App\Models\totalpayment;
use Illuminate\Http\Request;

class TotalpaymentController extends Controller
{
    public function index()
    {
        $AllPayment = totalpayment::all();
        return response()->json($AllPayment);
    }
    public function totalpaymentBySaleNumber($saleNumber)
    {
        $TotalPayment = totalpayment::where('SaleNumber', $saleNumber)->first();
        return response()->json($TotalPayment);
    }
    
}
