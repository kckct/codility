<?php

/**
 * https://codility.com/programmers/lessons/1-iterations/binary_gap/
 */

class BinarygapTest extends PHPUnit_Framework_TestCase {

    public function solution($N)
    {
        $bin = decbin($N);

        preg_match_all('/10+/', $bin, $matches);

        if(count($matches[0]) == 0) return 0;

        $final = 0;
        foreach($matches[0] as $key => $val)
        {
            preg_match_all('/'. $val . '1/', $bin, $m);
            if(count($m[0]) > 0)
            {
                $tmp = strlen($val) - 1;
                if($tmp > $final) $final = $tmp;
            }
        }

        return $final;
    }

    /**
     * @dataProvider data_provider
     */
    public function test_binarygap($input, $output)
    {
        $result = $this->solution($input);
        $this->assertEquals($output, $result);
    }

    public function data_provider()
    {
        return [
            [9, 2],
            [529, 4],
            [20, 1],
            [15, 0],
        ];
    }
}