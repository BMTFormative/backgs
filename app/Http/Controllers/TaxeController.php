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
        // Assume all other fields are appropriately validated or handled
        $data = $request->all();

        // Set default status if not provided
        if (!$request->has('status')) {
            $data['status'] = true;  // Default status, e.g., 'true' for active
        }

        $tax = Taxe::create($data);
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
            return response()->json(['message' => 'Tax not found'], 404);
        }

        // Get all input data, consider listing fields explicitly for safety
        $data = $request->only(['status', 'other_field1', 'other_field2']);

        // Optionally handle the 'status' field manually if you still need to ensure it's a boolean
        if (isset($data['status'])) {
            $data['status'] = filter_var($data['status'], FILTER_VALIDATE_BOOLEAN);
        }

        // Update the tax record with the provided fields
        $tax->update($data);

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
    public function updateStatus(Request $request, $id)
    {
        $tax = Taxe::find($id);
        if (!$tax) {
            return response()->json(['message' => 'Tax not found'], 404);
        }

        // Directly assign the Status value from the request
        // It's important to ensure that 'Status' is being sent in the request
        $tax->Status = $request->Status;

        // Save the updated model to the database
        $tax->save();

        // Return the updated tax object
        return response()->json($tax);
    }
}
