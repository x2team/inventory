<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $uploadPath;
    protected $storagePath;

    public function __construct()
    {
        // parent::__construct();
        
        $this->uploadPath = public_path(config('cms.image.directory'));
        $this->storagePath = storage_path(config('cms.image.directory'));

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $directory = glob($this->storagePath);
        // dd($directory);

        // array_filter($directory, function($file){
        //     Storage::deleteDirectory($file);
        // });
        // Storage::deleteDirectory($file);

        // $data = array();
        // $filesForDelete = array_filter(glob($this->uploadPath."/*"), function($file) {
        //     $data = strpos($file, '*');
        // });

        // dd('success');

        $products = DB::table('products')
                        ->join('categories', 'products.category_id', 'categories.id')
                        ->join('suppliers', 'products.supplier_id', 'suppliers.id')
                        ->select('categories.category_name', 'suppliers.name', 'products.*')
                        ->orderBy('products.id', 'DESC')
                        ->get();
        // dd($products);
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
            'root'             => 'required',
            'buying_price'     => 'required',
            'selling_price'    => 'required',

            'category_id'      => 'required',
            'supplier_id'      => 'required',
            'buying_date'      => 'required',
            'image'            => 'required',
            'product_quantity' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
            // return response()->json($validator->errors(), 200);
        }
        else{
            $data = $this->handleRequest($request);

            $product = Product::create($data);

            return response()->json($product);
        }
        

    }
    private function handleRequest($request)
    {   
        $data = $request->all();

        /**
         * Handle Image
         */
        if($request->hasFile('image')){
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();

            $fileName = Str::slug(str_replace(".{$extension}", "", $fileName));
            $fileName = $fileName . "_" . uniqid() . ".{$extension}";
            
            // insert watermark
            // $watermark = Image::make($this->watermarkPath."/watermark.png");
            // $interventionImage = Image::make($image);
            // $interventionImage->insert($watermark, 'bottom-right', 5, 5)->save();//->save($destination . "/" . $fileName);
            
            $directory = date("Y") . '/' . date("m");
            $data['image'] = $image->storeAs('product/' . $directory, $fileName ,'public', 0775, true);
        }
        
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json($product);
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
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'product_name'     => 'required|max:255',
            'product_code'     => 'required',
            'root'             => 'required',
            'buying_price'     => 'required',
            'selling_price'    => 'required',

            'category_id'      => 'required',
            'supplier_id'      => 'required',
            'buying_date'      => 'required',
            // 'image'            => 'required',
            'product_quantity' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
            // return response()->json($validator->errors(), 200);
        }
        else{
            $product     = Product::findOrFail($id);

            $oldImage               = $product->image;
            $data                   = $this->handleRequest($request);

            $product->update($data);

            if($oldImage !== $product->image){
                $this->removeImage($oldImage);
            }
            return response()->json($product);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $this->removeImage($product->image);
        
        $product->delete();

        return true;
    }
    private function removeImage($oldImage)
    {
        if( ! empty($oldImage)){
            $imageFilePath = $this->uploadPath . '/' . $oldImage;
            if( file_exists($imageFilePath)) unlink($imageFilePath);
        }
    }
}
