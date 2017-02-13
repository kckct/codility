<?php

/**
 * https://codility.com/programmers/lessons/2-arrays/cyclic_rotation/
 */

class CyclicRotationTest extends PHPUnit_Framework_TestCase {

    public function solution($A, $K)
    {
        if($K == 0 || count($A) == 0) return $A;

        for($i = 0; $i < $K; $i++)
        {
            $last = $A[count($A) - 1];
            unset($A[count($A) - 1]);
            $reverse = array_reverse($A);
            array_push($reverse, $last);
            $A = array_reverse($reverse);
        }

        return $A;
    }

    /**
     * @dataProvider data_provider
     */
    public function test_cyclicrotation($array, $num, $output)
    {
        $result = $this->solution($array, $num);
        $this->assertEquals($output, $result);
    }

    public function data_provider()
    {
        return [
            [[3, 8, 9, 7, 6], 1, [6, 3, 8, 9, 7]],
            [[3, 8, 9, 7, 6], 3, [9, 7, 6, 3, 8]],
        ];
    }
}