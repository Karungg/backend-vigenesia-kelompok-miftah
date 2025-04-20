<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MotivationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::get('/Get_motivasi', [MotivationController::class, 'index']);


Route::get('/Get_motivasi/{nama}', [MotivationController::class, 'getByName']);
Route::get('/Get_motivasi/getById/{id}', [MotivationController::class, 'getById']);
Route::get('/Get_user/{nama}', [MotivationController::class, 'getUser']);
Route::put('/Post_user/{nama}', [MotivationController::class, 'updateUser']);


Route::post('/Post_motivasi', [MotivationController::class, 'store']);
Route::put('/Post_motivasi/{id}', [MotivationController::class, 'update']);


Route::delete('/Delete_motivasi/{id}', [MotivationController::class, 'destroy']);
