<?php

use App\Http\Controllers\BabnnerController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\TSHController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('v1/data', [DataUserController::class, 'xuLyDuLieu'::class]);
Route::resource('v1/banner', BabnnerController::class);
Route::resource('v1/datathanso', TSHController::class);
