<?php

namespace App\Http\Controllers;
use App\Models\Globalpayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class GlobalpaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Globalpayment::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                // Validate the request data
            $validatedData = $request->validate([
                'Amount' => 'required|numeric',
                'CustomerId' => 'required|integer',
                'DatePayment' => 'required|date'  // Validate as date
            ]);

            // Create the global payment record
            $globalPayment = Globalpayment::create([
                'Amount' => $validatedData['Amount'],
                'CustomerId' => $validatedData['CustomerId'],
                'DatePayment' => $validatedData['DatePayment']
            ]);

            // Call the PostgreSQL function to allocate the payment
            DB::select('SELECT allocate_global_payment(?, ?)', [$globalPayment->id, $validatedData['Amount']]);

            // Return a JSON response with the global payment record
            return response()->json($globalPayment, 201);
        
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
