<?php

use App\Http\Controllers as Ctrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'prefix' => 'auth',
], function(){
    Route::post('register', [Ctrl\AuthController::class, 'register'])->name('auth.register');
    Route::post('login', [Ctrl\AuthController::class, 'login'])->name('auth.login');
});


Route::middleware('auth:api')->group(function () {
    Route::apiResource('checklist', Ctrl\ChecklistController::class);   
    Route::apiResource('todo', Ctrl\TodoController::class);   
});