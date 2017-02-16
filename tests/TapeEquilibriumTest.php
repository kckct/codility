<?php

/**
 * https://codility.com/programmers/lessons/3-time_complexity/tape_equilibrium/
 */

class TapeEquilibriumTest extends PHPUnit_Framework_TestCase {

    function solution($A) {
        $num = count($A);
        $left = 0;
        $right = 0;
        $result = 0;
        for($i = 0; $i < $num; $i++)
        {
            $right += $A[$i];
        }
        for($i = 0; $i < $num - 1; $i++)
        {
            $left += $A[$i];
            $right -= $A[$i];
            $tmp = abs($left - $right);
            if($i == 0 || $tmp < $result) $result = $tmp;
        }
        return $result;
    }

    /**
     * @dataProvider data_provider
     */
    public function test_solution($A, $output)
    {
        $result = $this->solution($A);
        $this->assertEquals($output, $result);
    }

    public function data_provider()
    {
        return [
            [[3, 1, 2, 4, 3], 1],
        ];
    }
}