<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('clients', ClientController::class);
Route::resource('services', ServiceController::class);

Route::post('clients/services', [ClientController::class , 'attach']);
Route::delete('clients/services/detach', [ClientController::class , 'detach']);

Route::post('services/clients', [ServiceController::class , 'clients']);