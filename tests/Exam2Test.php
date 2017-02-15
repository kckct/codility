<?php

/**
 * 104 Exam 2
 */

class Exam2Test extends PHPUnit_Framework_TestCase {

    public function solution($T)
    {
        $time = explode(':', date('H:i:s', $T));
        $str = '%dh%dm%ds';
        return sprintf($str, $time[0], $time[1], $time[2]);
    }

    /**
     * @dataProvider data_provider
     */
    public function test_solution($input, $output)
    {
        $result = $this->solution($input);
        $this->assertEquals($output, $result);
    }

    public function data_provider()
    {
        return [
            [7500, '2h5m0s'],
            [83643, '23h14m3s'],
        ];
    }
}