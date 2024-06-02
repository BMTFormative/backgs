<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taxe;
class TaxeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Taxe::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tax = Taxe::create($request->all());
        return response()->json($tax, 201);
        
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
        $tax = Taxe::find($id);
        if (!$tax) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $tax->update($request->all());
        return response()->json($tax);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tax = Taxe::find($id);
        if (!$tax) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $tax->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
