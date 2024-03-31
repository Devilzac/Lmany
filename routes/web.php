<?php

use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CharacterController::class, "index"])->name('character.index');
Route::get('/character/{id}', [CharacterController::class, "show"]);


Route::get('/add-char', [CharacterController::class, "create"]);
Route::post('/adding-char', [CharacterController::class, "store"]);


Route::get('/search', [CharacterController::class, 'search'])->name('character.search');
Route::post('/filter-search', [CharacterController::class, 'filterSearch'])->name('character.filtersearch');


Route::get('/relation', [CharacterController::class, 'relationIndex']);
Route::post('/relationship', [CharacterController::class, 'relationing']);