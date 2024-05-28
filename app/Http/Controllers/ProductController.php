<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET /products
    public function index()
    {
        // Assuming you have established a relationship in your Product model
            $products = Product::with('qtyChange')->get(); // 'qtyChange' is the relation defined in Product model
            // Map each product to include net_change directly
            $products = $products->map(function ($product) {
                // Add net_change directly to the product array
                $product->net_change = $product->qtyChange ? $product->qtyChange->net_change : 0;
                unset($product->qtyChange);  // Optionally remove the qtyChange relation from the response
                return $product;
            });

            return response()->json($products);
    }

    // POST /products
    public function store(Request $request)
    {
        $request->validate([
            'Reference' => 'required|string|unique:products,Reference',
            'Designation' => 'required|string',
            'Marque' => 'nullable|string',
            'Prix' => 'required|numeric|min:0',
            'Quantity' => 'nullable|integer',
            'Rayon' => 'nullable|string',
        ]);

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    // GET /products/{id}
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    // PUT /products/{id}
    public function update(Request $request, $id)
    {
        $request->validate([
            'Reference' => 'required|string|unique:products,Reference,' . $id,
            'Designation' => 'required|string',
            'Marque' => 'nullable|string',
            'Prix' => 'required|numeric|min:0',
            'Quantity' => 'required|integer|min:0',
            'Rayon' => 'nullable|string',
        ]);

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->update($request->all());
        return response()->json($product);
    }

    // DELETE /products/{id}
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
