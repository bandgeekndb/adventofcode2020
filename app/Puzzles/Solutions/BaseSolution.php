<?php

namespace App\Puzzles\Solutions;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

class BaseSolution
{
    protected function getInput($day, $part) {
        $filename = $day . '-' . $part . '.txt';

        if (Storage::disk('puzzle-inputs')->exists($filename)) {
            return Storage::disk('puzzle-inputs')->get($filename);
        } else {
            throw new FileNotFoundException("Puzzle input not found.");
        }
    }
}
