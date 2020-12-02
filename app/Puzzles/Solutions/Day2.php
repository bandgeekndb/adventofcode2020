<?php


namespace App\Puzzles\Solutions;


use Illuminate\Support\Str;

class Day2 extends BaseSolution implements SolutionTemplate
{
    protected $name = "Day 2: Password Philosophy";
    protected $date = "12/2/2020";

    public function __construct()
    {
        $this->input = $this->getInput(2);
    }

    function part1() {
        $puzzleInputs = Str::of($this->input)->explode(PHP_EOL)
            ->reject(function ($item) {
                return $item == "";
            })->map(function ($item) {
                $parts = Str::of($item)->explode(" ");

                $pwd = new \stdClass();
                $pwd->range = Str::of($parts[0])->explode('-');
                $pwd->needle = substr($parts[1],0,1);
                $pwd->haystack = $parts[2];

                return $pwd;
            });

        $solution = $puzzleInputs->filter(function ($item) {
            $countOfNeedle = substr_count($item->haystack, $item->needle);

            if ($countOfNeedle >= $item->range[0] && $countOfNeedle <= $item->range[1]) { return true; }
            else { return false; }
        })->count();

        return $solution ?: 'No solution found';
    }

    function part2() {
        $puzzleInputs = Str::of($this->input)->explode(PHP_EOL)
            ->reject(function ($item) {
                return $item == "";
            })->map(function ($item) {
                $parts = Str::of($item)->explode(" ");

                $pwd = new \stdClass();
                $pwd->searchPositions = Str::of($parts[0])->explode('-');
                $pwd->needle = substr($parts[1],0,1);
                $pwd->haystack = $parts[2];

                return $pwd;
            });

        $solution = $puzzleInputs->filter(function ($item) {
            $searchA = substr($item->haystack, $item->searchPositions[0]-1, 1);
            $searchB = substr($item->haystack, $item->searchPositions[1]-1, 1);

            if (($searchA == $item->needle || $searchB == $item->needle) && $searchA !== $searchB) {
                return true;
            } else { return false; }
        })->count();

        return $solution ?: 'No solution found';
    }
}
