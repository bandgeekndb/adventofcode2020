<?php

use App\Http\Controllers\PuzzleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{day}/{part}', [PuzzleController::class, 'show']);
