<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::get('/players', [App\Http\Controllers\Api\PlayerController::class, 'index']);
Route::post('/players', [App\Http\Controllers\Api\PlayerController::class, 'store']);
Route::get('/players/{player}', [App\Http\Controllers\Api\PlayerController::class, 'show']);
Route::put('/players/{player}', [App\Http\Controllers\Api\PlayerController::class, 'update']);
Route::delete('/players/{player}', [App\Http\Controllers\Api\PlayerController::class, 'destroy']);


Route::get('/matches', [App\Http\Controllers\Api\MatchController::class, 'index']);
Route::post('/matches', [App\Http\Controllers\Api\MatchController::class, 'store']);
Route::get('/matches/{match}', [App\Http\Controllers\Api\MatchController::class, 'show']);
Route::put('/matches/{match}', [App\Http\Controllers\Api\MatchController::class, 'update']);
Route::delete('/matches/{match}', [App\Http\Controllers\Api\MatchController::class, 'destroy']);


Route::get('/stadiums', [App\Http\Controllers\Api\StadiumController::class, 'index']);
Route::post('/stadiums', [App\Http\Controllers\Api\StadiumController::class, 'store']);
Route::get('/stadiums/{stadium}', [App\Http\Controllers\Api\StadiumController::class, 'show']);
Route::put('/stadiums/{stadium}', [App\Http\Controllers\Api\StadiumController::class, 'update']);
Route::delete('/stadiums/{stadium}', [App\Http\Controllers\Api\StadiumController::class, 'destroy']);

Route::get('/match-details', [App\Http\Controllers\MatchDetailController::class, 'index']);
Route::post('/match-details', [App\Http\Controllers\MatchDetailController::class, 'store']);
Route::get('/match-details/{matchDetail}', [App\Http\Controllers\MatchDetailController::class, 'show']);
Route::put('/match-details/{matchDetail}', [App\Http\Controllers\MatchDetailController::class, 'update']);
Route::delete('/match-details/{matchDetail}', [App\Http\Controllers\MatchDetailController::class, 'destroy']);
