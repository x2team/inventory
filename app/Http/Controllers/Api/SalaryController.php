<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Salary;
use Illuminate\Support\Facades\DB;


class SalaryController extends Controller
{
    public function paid(Request $request, $id)
    {
        // $validateData = $request->validate([
        //     'salary_month' => 'required',

        // ]);
        $validator = Validator::make($request->all(), [
            'salary_month' => 'required',
            'email' => 'required',
            'salary' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }
        else{
            $data = $validator->validated();

            $check = Salary::where('employee_id', $id)->where('salary_month', $request->salary_month)->first();

            if($check){
                return response()->json(['errors'=> 'Salary already Paid.']);
                // return response()->json('Salary already Paid.');
            }
            else{
                $data['employee_id'] = $request->id;
                $data['amount'] = $request->salary;
                $data['salary_date'] = date('d/m/Y');
                $data['salary_month'] = $request->salary_month;
                $data['salary_year'] = date('Y');
    
                $salary = Salary::create($data);

                return response()->json($salary);
            }
        }
    }
    
    public function allSalary()
    {
        $salaries = Salary::all(); // Chua co group by theo month

        return response()->json($salaries);
    }

    public function viewSalary($id)
    {
        // dd($id);
        $view = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.name', 'salaries.*')
            ->where('salaries.salary_month', $id)
            ->get();

        return response()->json($view);
    }


}
