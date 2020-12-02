<?php

namespace App\Puzzles\Solutions;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

class BaseSolution
{
    protected $name;
    protected $date;
    protected $input;

    protected function getDisplayName() {
        return $this->date . ' - ' . $this->name;
    }
    protected function getInput($day, $part = null) {
        if (!is_null($part)) {
            $filename = $day . '-' . $part . '.txt';
        } else {
            $filename = $day . '.txt';
        }

        if (Storage::disk('puzzle-inputs')->exists($filename)) {
            return Storage::disk('puzzle-inputs')->get($filename);
        } else {
            throw new FileNotFoundException("Puzzle input not found.");
        }
    }
}
