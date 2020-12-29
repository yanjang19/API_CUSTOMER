<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MngCustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create',[MngCustomerController::class,'create']);

Route::get('/getByEmail/{email}',[MngCustomerController::class,'findCusDtlByEmail']);

Route::get('/getByPhoneNo/{phoneNo}',[MngCustomerController::class,'findCusDtlByPhoneNo']);

Route::get('/getAll',[MngCustomerController::class,'listAllCustomer']);

Route::put('/updateName' ,[MngCustomerController::class ,'updateNameById']);

Route::delete('/delete/{id}',[MngCustomerController::class,'deleteById']);
