<?php

/**
 * https://codility.com/programmers/lessons/2-arrays/odd_occurrences_in_array/
 */

class OddOccurrencesInArrayTestTest extends PHPUnit_Framework_TestCase {

    function solution($A)
    {
        $compare = [];
        foreach($A as $val)
        {
            if(!isset($compare[$val]))
            {
                $compare[$val] = $val;
                continue;
            }

            if(isset($compare[$val]))
            {
                unset($compare[$val]);
            }
        }

        return key($compare);
    }

    /**
     * @dataProvider data_provider
     */
    public function test_solution($array, $output)
    {
        $result = $this->solution($array);
        $this->assertEquals($output, $result);
    }

    public function data_provider()
    {
        return [
            [[9, 3, 9, 3, 9, 7, 9], 7],
        ];
    }
}