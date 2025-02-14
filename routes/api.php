<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/auth/register', [UserController::class, 'createUser']);
Route::post('/auth/login', [UserController::class, 'loginUser']);


Route::post('/e-n-d-o-p-o-i-n-t-o', [ApiController::class, 'relationing']);
Route::post('/c-p-h-2024', [ApiController::class, 'clearPendingCharacter']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/auth/login', [UserController::class, 'logout']);
});