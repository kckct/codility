<?php

/**
 * 104 Exam 3
 */

class Exam3Test extends PHPUnit_Framework_TestCase {

    public function solution($S, $T)
    {
        $num = strtotime($T) - strtotime($S);
        $count = 0;
        for($i = 0; $i <= $num; $i++)
        {
            $char = str_split(date('H:i:s', strtotime($S) + $i));
            $data = [];
            foreach($char as $c)
            {
                if($c == ':') continue;
                $data[$c] = $c;
            }
            if(count($data) < 3) $count++;
        }
        return $count;
    }

    /**
     * @dataProvider data_provider
     */
    public function test_solution($S, $T, $output)
    {
        $result = $this->solution($S, $T);
        $this->assertEquals($output, $result);
    }

    public function data_provider()
    {
        return [
            ['15:15:00', '15:15:12', 1],
            ['22:22:21', '22:22:23', 3],
        ];
    }
}