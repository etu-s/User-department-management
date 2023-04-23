<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user_index', [UserController::class, 'index']);
Route::get('/user_search', [UserController::class, 'search']);
Route::get('/user_create', [UserController::class, 'create']);
Route::post('/user_add', [UserController::class, 'store']);
Route::get('/user_edit/{id}', [UserController::class, 'edit']);
Route::post('/user_update/{id}', [UserController::class, 'update']);
Route::post('/uesr_delete/{id}', [UserController::class, 'destroy']);

Route::get('/department_index', [DepartmentController::class, 'index']);
Route::post('/department_add', [DepartmentController::class, 'store']);
Route::get('/department_edit/{id}', [DepartmentController::class, 'edit']);
Route::post('/department_update/{id}', [DepartmentController::class, 'update']);
Route::post('/department_delete/{id}', [DepartmentController::class, 'destroy']);




