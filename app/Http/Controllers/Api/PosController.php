<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class PosController extends Controller
{
    public function getProducts($id)
    {
        $products = Product::where('category_id', $id)->get();

        return response()->json($products);
    }
}
