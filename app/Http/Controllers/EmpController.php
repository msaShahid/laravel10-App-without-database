<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class EmpController extends Controller
{

    public function store(Request $request){
        session_start();

        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:191',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'address'=>'required|max:191',
            'gender' => 'required|in:male,female'
        ]);

        if($validator->fails()){
            return response()->json(['status'=>400,'errors'=>$validator->messages()]);
        }else{

            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);

            $employeeData = [
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'gender' => $request->input('gender'),
                'image_path' => 'images/' . $imageName,
            ];

            Session::push('employees', $employeeData);

            return response()->json(['message' => 'Employee data saved into session.']);
        } 
    }


    public function fetchemployee(){
        
        $empData = Session::get('employees');

        return response()->json(['data'=>$empData]);
    }
   
    public function editemployee(Request $request){

        $empID = $request->empID;
        $sessionData = Session::get('employees');
        $singleRecord = $sessionData[$empID]; 

        if($singleRecord) {
            return response()->json(['status'=>200,'data'=> $singleRecord,'empID' => $empID ]);
        }else{
            return response()->json(['status'=>404,'message'=>'No Data Found.']);
        }
    }

    public function updateemployee(Request $request) {

        $validator = Validator::make($request->all(), [
            'name'=>'required|max:191',
            'address'=>'required|max:191',
            'gender'=>'required|in:male,female',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->messages()]);
        }else{

            $empID = $request->empID;
            $sessionData = Session::get('employees', []);

            if (array_key_exists($empID, $sessionData)) {

                $singleRecord = $sessionData[$empID];

                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . '.' . $image->extension();
                    $image->move(public_path('images'), $imageName);

                    $updatedEmployeeData = [
                        'name' => $request->input('name'),
                        'address' => $request->input('address'),
                        'gender' => $request->input('gender'),
                        'image_path' => 'images/' . $imageName,
                    ];
                } else {
                    $updatedEmployeeData = [
                        'name' => $request->input('name'),
                        'address' => $request->input('address'),
                        'gender' => $request->input('gender'),
                        'image_path' => $singleRecord['image_path'],
                    ];
                }

                $sessionData[$empID] = $updatedEmployeeData;

                Session::put('employees', $sessionData);

                return response()->json(['status' => 200, 'message' => 'Employee Updated Successfully.']);
            } else {
                return response()->json(['status' => 404, 'message' => 'No Employee Found.']);
            }
        }
    }

    public function deleteEmployee(Request $request){
        $empID = $request->empID;
        $sessionData = Session::get('employees');
        $singleRecord = $sessionData[$empID]; 

        if($singleRecord) {
            Session::forget('employees.' . $empID);
            return response()->json(['status'=>200,'message'=>'Student Deleted Successfully.']);
        }else{
            return response()->json(['status'=>404,'message'=>'No Data Found.']);
        }
    }
 


  


    // End Controller here...
}
