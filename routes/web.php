<?php

use App\Http\Controllers\PuzzleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('puzzles.index');
});

Route::get('/{day}/{part}', [PuzzleController::class, 'show']);
