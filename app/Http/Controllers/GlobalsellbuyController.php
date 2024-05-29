<?php

namespace App\Http\Controllers;
use App\Models\globalsellbuy;
use Illuminate\Http\Request;

class GlobalsellbuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $globalamount = GlobalSellBuy::with('customer')->get();

            $globalSellBuys = $globalamount->map(function ($item) {
                return [
                    'CustomerId' => $item->CustomerId,
                    'CustomerName' => $item->customer ? $item->customer->Nom : null, // assuming 'name' is the attribute in Customer
                    'GlobalPayments' => $item->globalpayments,
                    'GlobalSales' => $item->globalsales
                ];
            });

            return response()->json($globalSellBuys);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
