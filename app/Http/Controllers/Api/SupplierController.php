<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    protected $uploadPath;

    public function __construct()
    {        
        $this->uploadPath = public_path(config('cms.image.directory'));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();

        return response()->json($suppliers);
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
        $validateData = $request->validate([
            'name' => 'required|unique:suppliers|max:255',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required|unique:suppliers',
            'shopname' => 'required',

        ]);

        $data = $this->handleRequest($request);
        
        Supplier::create($data);

        return response()->json('success');
    }

    private function handleRequest($request)
    {   
        $data = $request->all();

        /**
         * Handle Image
         */
      
        if($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;

            $img = Image::make($request->photo)->resize(240,200);
            $data['photo'] = "supplier/".$name;
            $path = storage_path("app/public/" . $data['photo']);
            
            Storage::disk('public')->makeDirectory('supplier');
            $img->save($path);


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
        $supplier = Supplier::findOrFail($id);

        return response()->json($supplier);
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
        $supplier = Supplier::findOrFail($id);

        $oldImage               = $supplier->photo;

        if($request->photo !== $oldImage){
            $data = $this->handleRequest($request);
        }
        else{
            $data = $request->all();
        }

        $supplier->update($data);

        if($oldImage !== $supplier->photo){
            $this->removeImage($oldImage);
        }

        return response()->json($supplier);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        $this->removeImage($supplier->photo);

        $supplier->delete();

        return response()->json('Xoa thanh cong');
    }
    private function removeImage($oldImage)
    {
        if( ! empty($oldImage)){
            $imageFilePath = $this->uploadPath . '/' . $oldImage;
            if( file_exists($imageFilePath)) unlink($imageFilePath);
        }
    }
}
