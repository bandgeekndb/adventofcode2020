<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PuzzleController extends Controller
{
    public function show($day, $part) {
        $daynum = ltrim($day);
        $partnum = ltrim($part);

        $solutionName = '\App\Puzzles\Solutions\Day' . $daynum;

        if (class_exists($solutionName)) {
            $solution = new $solutionName;
        } else {
            abort(404);
        }

        switch($part) {
            case '1':
                return $solution->part1();
                break;
            case '2':
                return $solution->part2();
                break;
            default:
                abort(404);
        }
    }
}
