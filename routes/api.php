<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SpecController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;

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
// routes/api.php

use App\Http\Controllers\AuthController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['sortResponse'])->group(function () {
    // Routes within this group will use the 'sortResponse' middleware

    Route::get('/example', function () {
        // Your route logic here 
    });
});

Route::post('/register', [RegistrationController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/me', [AuthController::class, 'me']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('order/get_all', [OrderController::class, 'get_all']);
Route::get('order/{id}', [OrderController::class, 'item']);
Route::post('order', [OrderController::class, 'create']);
Route::put('order/{id}', [OrderController::class, 'update']);
Route::delete('order/{id}', [OrderController::class, 'destroy']);

Route::get('spec/get_all_Respoce', [SpecController::class, 'get_all_Respoce']);
Route::post('spec/create_Respoce', [SpecController::class, 'create_Respoce']);
Route::post('spec/create', [SpecController::class, 'create']);
Route::get('spec/get_all', [SpecController::class, 'get_all']);
Route::put('spec/{id}', [SpecController::class, 'update']);
Route::delete('spec/{id}', [SpecController::class, 'destroy']);

Route::get('category/get_all', [CategoryController::class, 'get_all']);
Route::post('category', [CategoryController::class, 'create']);
Route::put('category/{id}', [CategoryController::class, 'update']);
Route::delete('category/{id}', [CategoryController::class, 'destroy']);

Route::get('review/get_all', [ReviewController::class, 'get_all']);
Route::post('review', [ReviewController::class, 'create']);
Route::put('review/{id}', [ReviewController::class, 'update']);
Route::delete('review/{id}', [ReviewController::class, 'destroy']);