<?php

namespace App\Http\Controllers;

use App\Models\Paycustomer;
use Illuminate\Http\Request;

class PaycustomerController extends Controller
{
    public function index()
    {
        $paycustomers = Paycustomer::all();
        return response()->json($paycustomers);
    }

    public function store(Request $request)
    {
        $paycustomer = Paycustomer::create($request->all());
        return response()->json($paycustomer, 201);
    }

    public function show(Paycustomer $paycustomer)
    {
        return response()->json($paycustomer);
    }

    public function update(Request $request, Paycustomer $paycustomer)
    {
        $paycustomer->update($request->all());
        return response()->json($paycustomer);
    }

    public function destroy(Paycustomer $paycustomer)
    {
        $paycustomer->delete();
        return response()->json(null, 204);
    }
}
