<?php
namespace App\Services;

class MyService
{
    public function applyFilter($value)
    {
        if ($value == 0) {
            $result = 0;
        } else {
            $result = round(($value + 50 / 2) / 50) * 50;
        }
        return $result;
        // return round(($value + 50 / 2) / 50) * 50;
    }

    public function findFactorial($num)
    {
        $factorial = 1;
        for ($x = $num; $x >= 1; $x--) {
            $factorial = $factorial * $x;
        }
        return $factorial;
    }

}
