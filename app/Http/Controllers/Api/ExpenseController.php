<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Expense;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all();

        return response()->json($expenses);
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
            'detail'     => 'required|max:255|min:3',
            'amount'     => 'required|max:255',            
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
            // return response()->json($validator->errors(), 200);
        }
        else{
            $data = $request->all();

            $data['expense_date'] = date('d/m/Y');
            
            $expense = Expense::create($data);

            return response()->json($expense);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::findOrFail($id);

        return response()->json($expense);
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
            'detail'     => 'required|max:255|min:3',
            'amount'     => 'required|max:255', 
        ]);
        
        if ($validator->fails()) {

            return response()->json(['errors'=>$validator->errors()]);
        }
        else{
            $data = $request->all();

            $data['expense_date'] = date('d/m/Y');

            $expense     = Expense::findOrFail($id);

            $expense->update($data);

            return response()->json($expense);
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
        $expense = Expense::findOrFail($id);

        $expense->delete();
    }
}
