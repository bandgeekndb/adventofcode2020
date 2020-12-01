<?php


namespace App\Puzzles\Solutions;


use Illuminate\Support\Str;

class Day1 extends BaseSolution implements SolutionTemplate
{
    function part1() {
        $input = $this->getInput(1,1);

        $puzzleNumbers = Str::of($input)->explode(PHP_EOL)
            ->reject(function ($item) {
                return $item == "";
            })->map(function ($item) {
                return (int)$item;
            });

        $solution = "";

        for ($i = 0; $i < $puzzleNumbers->count(); $i++) {
            for ($j = $i+1; $j < $puzzleNumbers->count(); $j++) {
                if ($puzzleNumbers[$i] + $puzzleNumbers[$j] == 2020) {
                    $solution = "Puzzle inputs $puzzleNumbers[$i] + $puzzleNumbers[$j] = 2020\n";
                    $solution .= "Puzzle solution is $puzzleNumbers[$i] * $puzzleNumbers[$j] = " . ($puzzleNumbers[$i] * $puzzleNumbers[$j]);
                }
            }
        }

        return $solution ?: 'No solution found';
    }

    function part2() {
        // Same inputs for both parts today
        $input = $this->getInput(1,1);

        $puzzleNumbers = Str::of($input)->explode(PHP_EOL)
            ->reject(function ($item) {
                return $item == "";
            })->map(function ($item) {
                return (int)$item;
            });

        $solution = "";

        for ($i = 0; $i < $puzzleNumbers->count(); $i++) {
            for ($j = $i+1; $j < $puzzleNumbers->count(); $j++) {
                for ($k = $j+1; $k < $puzzleNumbers->count(); $k++) {
                    if ($puzzleNumbers[$i] + $puzzleNumbers[$j] + $puzzleNumbers[$k] == 2020) {
                        $solution = "Puzzle inputs $puzzleNumbers[$i] + $puzzleNumbers[$j] + $puzzleNumbers[$k] = 2020\n";
                        $solution .= "Puzzle solution is $puzzleNumbers[$i] * $puzzleNumbers[$j] * $puzzleNumbers[$k] = ".($puzzleNumbers[$i] * $puzzleNumbers[$j] * $puzzleNumbers[$k]);
                    }
                }
            }
        }

        return $solution ?: 'No solution found';
    }
}
