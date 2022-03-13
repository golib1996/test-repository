<?php

use App\Http\Controllers\HouseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/',[HouseController::class,'index']);
Route::get('/{id}',[HouseController::class,'show']);
Route::post('/',[HouseController::class,'store']);
Route::put('/{id}',[HouseController::class,'update']);
Route::delete('/{id}',[HouseController::class,'destroy']);

