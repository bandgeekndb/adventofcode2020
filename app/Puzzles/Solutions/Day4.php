<?php


namespace App\Puzzles\Solutions;


use Illuminate\Support\Str;

class Day4 extends BaseSolution implements SolutionTemplate
{
    protected $name = "Day 4: Passport Processing";
    protected $date = "12/4/2020";

    public function __construct()
    {
        $this->input = $this->getInput(4);
    }

    function part1() {
        $testInput = <<<INPUT
ecl:gry pid:860033327 eyr:2020 hcl:#fffffd
byr:1937 iyr:2017 cid:147 hgt:183cm

iyr:2013 ecl:amb cid:350 eyr:2023 pid:028048884
hcl:#cfa07d byr:1929

hcl:#ae17e1 iyr:2013
eyr:2024
ecl:brn pid:760753108 byr:1931
hgt:179cm

hcl:#cfa07d eyr:2025 pid:166559648
iyr:2011 ecl:brn hgt:59in
INPUT;

        $passports = Str::of($this->input)->explode("\n\n")
        //$passports = Str::of($testInput)->explode("\n\n")
            ->reject(function ($item) {
                return $item == "";
            })->map(function ($passport) {
                return Str::of($passport)->replace("\n", " ")
                    ->explode(" ")
                    ->reject(function ($item) {
                        return $item == "";
                    })->mapWithKeys(function ($passportDetail) {
                        $passportDetailArray = Str::of($passportDetail)->explode(":");
                        return [$passportDetailArray[0] => $passportDetailArray[1]];
                    });
            });

        $validPassports = $passports->filter(function ($passport) {
            return $passport->has([
                'byr','iyr','eyr', 'hgt', 'hcl', 'ecl', 'pid',
            ]);
        });

        return $validPassports->count() ?: 'No solution found';
    }

    function part2() {
        $passports = Str::of($this->input)->explode("\n\n")
            //$passports = Str::of($testInput)->explode("\n\n")
            ->reject(function ($item) {
                return $item == "";
            })->map(function ($passport) {
                return Str::of($passport)->replace("\n", " ")
                    ->explode(" ")
                    ->reject(function ($item) {
                        return $item == "";
                    })->mapWithKeys(function ($passportDetail) {
                        $passportDetailArray = Str::of($passportDetail)->explode(":");
                        return [$passportDetailArray[0] => $passportDetailArray[1]];
                    });
            });

        $validPassports = $passports->filter(function ($passport) {
            return $passport->has([
                'byr','iyr','eyr', 'hgt', 'hcl', 'ecl', 'pid',
            ]);
        })->filter(function ($passport) {
            // byr (Birth Year) - four digits; at least 1920 and at most 2002.
            if (strlen($passport['byr']) != 4 || (int)$passport['byr'] < 1920 || (int)$passport['byr'] > 2002) { return false; }

            // iyr (Issue Year) - four digits; at least 2010 and at most 2020.
            if (strlen($passport['iyr']) != 4 || (int)$passport['iyr'] < 2010 || (int)$passport['iyr'] > 2020) { return false; }

            // eyr (Expiration Year) - four digits; at least 2020 and at most 2030.
            if (strlen($passport['eyr']) != 4 || (int)$passport['eyr'] < 2020 || (int)$passport['eyr'] > 2030) { return false; }

            // hgt (Height) - a number followed by either cm or in:
            //     If cm, the number must be at least 150 and at most 193.
            //     If in, the number must be at least 59 and at most 76.
            switch(substr($passport['hgt'], -2)) {
                case "cm":
                    $height = substr($passport['hgt'], 0, -2);
                    if ($height < 150 || $height > 193) { return false; }
                    break;

                case "in":
                    $height = substr($passport['hgt'], 0, -2);
                    if ($height < 59 || $height > 76) { return false; }
                    break;

                default:
                    return false;
            }

            // hcl (Hair Color) - a # followed by exactly six characters 0-9 or a-f.
            if (!preg_match("/^#[0-9a-f]{6}$/", $passport['hcl'])) { return false; }

            // ecl (Eye Color) - exactly one of: amb blu brn gry grn hzl oth.
            $validEyeColors = ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'];
            if (!in_array($passport['ecl'], $validEyeColors)) { return false; }

            // pid (Passport ID) - a nine-digit number, including leading zeroes.
            if (!preg_match("/^\d{9}$/", $passport['pid'])) { return false; }

            return true;
        });

        return $validPassports->count() ?: 'No solution found';
    }
}
