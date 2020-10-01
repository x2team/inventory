<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Intervention\Image\Facades\Image;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CustomerController extends Controller
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
        $customers = Customer::all();

        return response()->json($customers);
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
        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'email'   => 'required',
            'phone'   => 'required',
            'address' => 'required',
            'photo'   => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
            // return response()->json($validator->errors(), 200);
        }
        else{
            $data = $this->handleRequest($request);

            $customer = Customer::create($data);

            return response()->json($customer);
        }
    }
    private function handleRequest($request)
    {   
        $data = $request->all();

        /**
         * Handle Image
         */
        if($request->hasFile('photo')){
            $image = $request->file('photo');
            $fileName = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();

            $fileName = Str::slug(str_replace(".{$extension}", "", $fileName));
            $fileName = $fileName . "_" . uniqid() . ".{$extension}";
            
            // insert watermark
            // $watermark = Image::make($this->watermarkPath."/watermark.png");
            // $interventionImage = Image::make($image);
            // $interventionImage->insert($watermark, 'bottom-right', 5, 5)->save();//->save($destination . "/" . $fileName);
            
            $directory = date("Y") . '/' . date("m");
            $data['photo'] = $image->storeAs('customer/' . $directory, $fileName ,'public', 0775, true);
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
        $customer = Customer::findOrFail($id);

        return response()->json($customer);
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
        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'email'   => 'required',
            'phone'   => 'required',
            'address' => 'required',
            // 'photo'   => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
            // return response()->json($validator->errors(), 200);
        }
        else{
            $customer     = Customer::findOrFail($id);

            $oldPhoto               = $customer->photo;
            $data                   = $this->handleRequest($request);

            $customer->update($data);

            if($oldPhoto !== $customer->photo){
                $this->removeImage($oldPhoto);
            }
            return response()->json($customer);
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
        $customer = Customer::findOrFail($id);

        $this->removeImage($customer->photo);

        $customer->delete();

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
