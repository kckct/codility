<?php

/**
 * https://codility.com/programmers/lessons/3-time_complexity/perm_missing_elem/
 */

class PermMissingElemTest extends PHPUnit_Framework_TestCase {

    function solution($A) {
        $max = count($A) + 1;
        $total_sum = (1 + $max) * $max / 2;

        $sum = 0;
        foreach($A as $val)
        {
            $sum += $val;
        }

        return $total_sum - $sum;
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
            [[2, 3, 1, 5], 4],
        ];
    }
}