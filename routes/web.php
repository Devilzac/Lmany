<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\PendingCharacterController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/add-char', [CharacterController::class, "create"]);
    Route::post('/adding-char', [CharacterController::class, "store"]);
    Route::post('/a-tor-2024', [PendingCharacterController::class, 'autoRelationing']);
    Route::get('/pnd-char-2024', [PendingCharacterController::class, 'index']);
});

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/auth/login', [UserController::class, 'loginUser'])->name('login.usr');

Route::get('/registerino', [UserController::class, 'registerino'])->name('register');
Route::post('/auth/registerino', [UserController::class, 'createUser'])->name('register.usr');;


Route::get('/', [CharacterController::class, "index"])->name('character.index');
Route::get('/character/{id}', [CharacterController::class, "show"]);


Route::get('/search', [CharacterController::class, 'search'])->name('character.search');
Route::post('/filter-search', [CharacterController::class, 'filterSearch'])->name('character.filtersearch');
Route::get('/server/{serverid?}/{chartype?}', [CharacterController::class, 'fServer'])->name('character.filterserv');


Route::get('/relation-f-2024', [CharacterController::class, 'relationIndex']);
Route::post('/relationship', [CharacterController::class, 'relationing']);

