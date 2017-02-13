<?php

/**
 * https://codility.com/programmers/lessons/3-time_complexity/frog_jmp/
 */

class FrogJumpTest extends PHPUnit_Framework_TestCase {

    function solution($X, $Y, $D) {
        if($X == $Y) return 0;
        return (int)ceil(($Y - $X) / $D);
    }

    /**
     * @dataProvider data_provider
     */
    public function test_solution($X, $Y, $D, $output)
    {
        $result = $this->solution($X, $Y, $D);
        $this->assertEquals($output, $result);
    }

    public function data_provider()
    {
        return [
            [10, 85, 30, 3],
        ];
    }
}