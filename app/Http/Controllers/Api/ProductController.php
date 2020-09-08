<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::all();
        $products = DB::table('products')
                        ->join('categories', 'products.category_id', 'categories.id')
                        ->join('suppliers', 'products.supplier_id', 'suppliers.id')
                        ->select('categories.category_name', 'suppliers.name', 'products.*')
                        ->orderBy('products.id', 'DESC')
                        ->get();
        dd($products);
        return response()->json($products);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validateData = $request->validate([
        //     'product_name'     => 'required|max:255',
        //     'product_code'     => 'required|unique:products|max:255',
        // ]);

        
        $validator = Validator::make($request->all(), [
            'product_name'     => 'required|max:255',
            'product_code'     => 'required|unique:products|max:255',
            // 'root'             => 'required',
            // 'buying_price'     => 'required|unique:suppliers',
            // 'selling_price'    => 'required',

            // 'category_id'      => 'required',
            // 'supplier_id'      => 'required',
            // 'buying_date'      => 'required',
            // 'image'            => 'required',
            // 'product_quantity' => 'required',
        ]);

      

        // return response('co loi', Response::HTTP_OK);

        // if ($validator->fails()) {
        //     return response()->json($validator->messages(), 200);
        // }
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }
        

        // return response(null, Response::HTTP_NO_CONTENT);
        // dd($request->all());
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
