<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Display the form and products list
    public function index() {
        return view('products.index');
    }

    // Store submitted form data
    public function store(Request $request) {
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->quantity_in_stock = $request->quantity_in_stock;
        $product->price_per_item = $request->price_per_item;
        $product->save();

        return response()->json(['message' => 'Product saved successfully']);
    }

    // Retrieve products for display
    public function getProducts() {
        $products = Product::orderBy('created_at', 'desc')->get();
        return response()->json($products);
    }

    // Edit product entry (for extra credit)
    public function edit(Request $request, $id) {
        $product = Product::find($id);
        if ($product) {
            $product->product_name = $request->product_name;
            $product->quantity_in_stock = $request->quantity_in_stock;
            $product->price_per_item = $request->price_per_item;
            $product->save();
            return response()->json(['message' => 'Product updated successfully']);
        }
        return response()->json(['message' => 'Product not found'], 404);
    }
}
