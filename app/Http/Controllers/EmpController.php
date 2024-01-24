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

            // Handle the image upload
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);

            // Save data and image path to session
            $employeeData = [
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'gender' => $request->input('gender'),
                'image_path' => 'images/' . $imageName,
            ];

           // dd($employeeData);
           // Store data in session
            Session::push('employees', $employeeData);

            return response()->json(['message' => 'Employee data saved into session.']);
        } 
    }


    public function fetchemployee(){
        
        $empData = Session::get('employees');

       // dd($empData);
        return response()->json(['data'=>$empData]);
    }
   
 


  


    // End Controller here...
}
