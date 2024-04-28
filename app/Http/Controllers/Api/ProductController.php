<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productsList() {
        $products = Product::all();

        return response()->json($products);
    }

    public function productShow(Request $request) {
        $product = Product::find($request->id);

        return response()->json($product);
    }
}
