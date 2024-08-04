<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\EnsureDomainIsValid;


Route::middleware(['guest'])->group(function () {
  Route::post('/login', [AuthController::class, 'login']);
  // Other routes that don't require authentication
});

Route::middleware([EnsureDomainIsValid::class, 'auth:sanctum'])->group(function () {
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::get('/user', [AuthController::class, 'user']);
  // Other routes that require authentication
});
