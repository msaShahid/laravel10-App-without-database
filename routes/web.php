<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/employee', [EmpController::class, 'store']);
Route::get('/fetch-emp', [EmpController::class, 'fetchemployee']);

// save fetchSession
//Route::get('/', [EmpController::class, 'fetchSession']);
//Route::post('/session-save', [EmpController::class, 'saveSessionData']);
// show list
//Route::get('/', [EmpController::class, 'showSessionData']);
// update 
//Route::get('/edit', [EmpController::class, 'editSessionData']);



