<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();

        $data = [];
        $data['pro_id'] = $id;
        $data['pro_name'] = $product->product_name;
        $data['pro_quantity'] = 1;
        $data['product_price'] = $product->selling_price;
        $data['sub_total'] = $product->selling_price;

        DB::table('pos')->insert($data);

        return response()->json($data);
    }
}
