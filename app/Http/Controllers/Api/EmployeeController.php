<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    
    protected $uploadPath;

    public function __construct()
    {
        // parent::__construct();
        
        $this->uploadPath = public_path(config('cms.image.directory'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();

        return response()->json($employee);
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
        //     'name' => 'required|unique:employees|max:255',
        //     'email' => 'required',
        //     'phone' => 'required|unique:employees',

        // ]);

        $data = $this->handleRequest($request);
        
        Employee::create($data);

        return response()->json('success');
    }
    private function handleRequest($request)
    {   
        $data = $request->all();

        /**
         * Handle Image
         */
        // if($request->newPhoto){
        //     $position = strpos($request->newPhoto, ';');
        //     $sub = substr($request->newPhoto, 0, $position);
        //     $ext = explode('/', $sub)[1];
        //     $name = time().".".$ext;

        //     $img = Image::make($request->newPhoto)->resize(240,200);
        //     $data['newPhoto'] = "employee/".$name;
        //     $path = storage_path("app/public/" . $data['newPhoto']);
            
        //     Storage::disk('public')->makeDirectory('employee');
        //     $img->save($path);
        // }
        if($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;

            $img = Image::make($request->photo)->resize(240,200);
            $data['photo'] = "employee/".$name;
            $path = storage_path("app/public/" . $data['photo']);
            
            Storage::disk('public')->makeDirectory('employee');
            $img->save($path);

            // Storage::putFileAs('app/public/employee/', new File($img), 'photo.jpg');

        }        
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $employee = Employee::findOrFail($id);

        $oldImage               = $employee->photo;

        if($request->photo !== $oldImage){
            $data = $this->handleRequest($request);
        }
        else{
            $data = $request->all();
        }

        $employee->update($data);

        if($oldImage !== $employee->photo){
            $this->removeImage($oldImage);
        }

        return response()->json($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        $this->removeImage($employee->photo);

        $employee->delete();

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
