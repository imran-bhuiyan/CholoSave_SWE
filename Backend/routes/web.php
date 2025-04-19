<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';

use App\Models\User;

Route::get('/users', function () {
    return User::all();
});

