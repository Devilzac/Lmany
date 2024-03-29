<?php

use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CharacterController::class, "index"])->name('character.index');
Route::get('/character/{id}', [CharacterController::class, "show"]);

Route::get('/add-char', [CharacterController::class, "create"]);
Route::post('/adding-char', [CharacterController::class, "store"]);


