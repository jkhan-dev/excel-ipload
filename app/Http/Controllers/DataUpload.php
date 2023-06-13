<?php

namespace App\Http\Controllers;

use App\Imports\EmployeesImport;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
class DataUpload extends Controller
{
   public function upload_data(Request $request){
        
       $validator =  Validator::make($request->all(),[
            'file'=>'required'
        ]);
// dd($request->file);
        if($validator->fails())
        {
            dd($validator->errors());
            return redirect()->back()->withErrors($validator->errors());
        }

        \Excel::import(new EmployeesImport,$request->file);
        return redirect()->back()->with('success','successfully uploaded');

    }

    public function getUploadedData() {
        $employees = employee::all();
        $requested_params = $_GET;
        if(empty($requested_params)) return $employees;


        foreach ($requested_params as $key => $value) {
        
            if($key == 'from_hiring_date')
            {
                $employees = $employees->filter(function ($employee) use ($value) {
                    return $employee->hire_date >= $value;
                });
            }
            elseif($key == 'to_hiring_date')
            {
                $employees = $employees->filter(function ($employee) use ($value) {
                    return $employee->hire_date <= $value;
                });
            }
          
            else{
                   $employees = $employees->where($key,$value);
            }
        }
        if(isset($requested_params['sort_by_hire_date']))
        {
            $employees = $employees->sortByDesc('hire_date');
            
        }
            // Convert the collection to an array
        $employeesArray = $employees->toArray();

        // Create the API response
        $responseData = [
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $employeesArray
        ];

        // Set the HTTP status code for the response
        $statusCode = 200;

        // Return the API response as JSON
        return response()->json($responseData, $statusCode);
    }
}
