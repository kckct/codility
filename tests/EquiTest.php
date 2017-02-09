<?php

class EquiTest extends PHPUnit_Framework_TestCase {

    public function solution($A)
    {
        $left = 0;
        $right = 0;

        for($i = 0; $i < count($A); $i++)
        {
            $right += $A[$i];
        }

        for($i = 0; $i < count($A); $i++)
        {
            $right = $right - $A[$i];
            if($left == $right) return $i;
            $left += $A[$i];
        }

        return -1;
    }

    public function test_binarygap()
    {
        $input = [-1, 3, -4, 5, 1, -6, 2, 1];

        $result = $this->solution($input);
        $this->assertEquals(1, $result);
    }

}