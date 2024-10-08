<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([

    'middleware' => 'jwt',
   

], function ($router) {

    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    Route::get('checklist', [TodoController::class,'list']);
    Route::post('checklist', [TodoController::class,'store']);
    Route::delete('checklist/{id}', [TodoController::class,'delete']);
    Route::get('checklist/{id}/item', [TodoController::class,'items']);
    Route::post('checklist/{id}/item', [TodoController::class,'itemsStore']);
    Route::get('checklist/{id}/item/{iditem}', [TodoController::class,'itemGet']);
    Route::put('checklist/{id}/item/{iditem}', [TodoController::class,'itemStatus']);
    Route::delete('checklist/{id}/item/{iditem}', [TodoController::class,'itemDelete']);
    Route::put('checklist/{id}/item/rename/{iditem}', [TodoController::class,'itemRename']);
    


});
Route::post('login', [AuthController::class,'login']);
Route::post('register', [UserController::class,'register']);
