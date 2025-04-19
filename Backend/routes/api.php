<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//define a route for the user controller
use App\Http\Controllers\API\UserController;
Route::get('/users', [UserController::class, 'index']);
