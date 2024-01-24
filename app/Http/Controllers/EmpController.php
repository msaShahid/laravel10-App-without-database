<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class EmpController extends Controller
{
    public function saveSessionData(){

        session_start();

        $data = request()->all();

        if (is_array($data)) {
            if (session()->has('data')) {
                $existingData = session()->get('data');
                $existingData[] = $data;
                session()->put('data', $existingData);
            } else {
                session()->put('data', [$data]);
            }
        
            return response()->json([
                'status' => true,
                'message' => 'Session data saved successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid data format.',
            ]);
        }

    }

    
    public function showSessionData(){

        $empData = Session::get('data');

       // dd($empData);

        return view('welcome', compact('empData'));
    }
}
