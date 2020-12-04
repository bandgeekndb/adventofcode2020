<?php


namespace App\Puzzles\Solutions;


use Illuminate\Support\Str;

class Day3 extends BaseSolution implements SolutionTemplate
{
    protected $name = "Day 3: Toboggan Trajectory";
    protected $date = "12/3/2020";

    public function __construct()
    {
        $this->input = $this->getInput(3);
    }

    function part1() {
        $testInput = <<<INPUT
..##.......
#...#...#..
.#....#..#.
..#.#...#.#
.#...##..#.
..#.##.....
.#.#.#....#
.#........#
#.##...#...
#...##....#
.#..#...#.#
INPUT;

        $puzzleInputs = Str::of($this->input)->explode(PHP_EOL)
        //$puzzleInputs = Str::of($testInput)->explode(PHP_EOL)
            ->reject(function ($item) {
                return $item == "";
            });

        //dd($puzzleInputs);

        $trees = $this->calculateSlope($puzzleInputs, 3, 1);

        return $trees ?: 'No solution found';
    }

    function part2() {
        $puzzleInputs = Str::of($this->input)->explode(PHP_EOL)
            ->reject(function ($item) {
                return $item == "";
            });

        //dd($puzzleInputs);

        $treesA = $this->calculateSlope($puzzleInputs, 1, 1);
        $treesB = $this->calculateSlope($puzzleInputs, 3, 1);
        $treesC = $this->calculateSlope($puzzleInputs, 5, 1);
        $treesD = $this->calculateSlope($puzzleInputs, 7, 1);
        $treesE = $this->calculateSlope($puzzleInputs, 1, 2);

        var_dump($treesA, $treesB, $treesC, $treesD, $treesE);

        $solution = $treesA * $treesB * $treesC * $treesD * $treesE;

        return $solution ?: 'No solution found';
    }

    private function calculateSlope($input, $right, $down) {
        $currx = 0;
        $curry = 0;
        $trees = 0;
        
        while($curry < $input->count()) {
            $row = $input[$curry];

            $check = substr($input[$curry], $currx % strlen($row), 1);

            // Debug statement
            //var_dump([$curry+1, $currx, $currx % strlen($row), $check]);

            $currx += $right;
            $curry += $down;

            if ($check == '#') {
                $trees++;
            }
        }

        return $trees;
    }
}
