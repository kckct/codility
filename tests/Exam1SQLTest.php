<?php

/**
 * 104 Exam 1
 */

class Exam1SQLTest extends PHPUnit_Framework_TestCase {

    function solution() {
//        $sql = '
//            select sensor_id, event_type, value from
//            (select t1.*
//            from events t1 left join events t2
//            on (t1.sensor_id = t2.sensor_id and t1.event_type = t2.event_type and t1.time < t2.time)
//            where t2.time is null)
//            order by sensor_id asc, event_type asc
//        ';

        $sql = '
            select sensor_id, event_type, (
              select value from events where sensor_id = t.sensor_id and event_type = t.event_type
              order by time desc limit 1
            ) as value 
            from events as t
            group by sensor_id, event_type
            order by sensor_id asc, event_type asc
        ';

        return $sql;
    }

    public function test_solution()
    {
        $db = new PDO('sqlite::memory:');
        $db->exec(
            "CREATE TABLE events (
              sensor_id integer not null,
              event_type integer not null,
              value integer not null,
              time timestamp unique not null
            );"
        );

        $events = [
            ['sensor_id' => 2, 'event_type' => 2, 'value' => 5, 'time' => '2014-02-13 12:42:00'],
            ['sensor_id' => 2, 'event_type' => 4, 'value' => -42, 'time' => '2014-02-13 13:19:57'],
            ['sensor_id' => 2, 'event_type' => 2, 'value' => 2, 'time' => '2014-02-13 14:48:30'],
            ['sensor_id' => 3, 'event_type' => 2, 'value' => 7, 'time' => '2014-02-13 12:54:39'],
            ['sensor_id' => 2, 'event_type' => 3, 'value' => 54, 'time' => '2014-02-13 13:32:36'],
            ['sensor_id' => 2, 'event_type' => 2, 'value' => 56, 'time' => '2014-02-13 15:42:00'],
        ];

        $insert = "
          INSERT INTO events (sensor_id, event_type, value, time) VALUES (:sensor_id, :event_type, :value, :time)
         ";
        $stmt = $db->prepare($insert);
        $stmt->bindParam(':sensor_id', $sensor_id);
        $stmt->bindParam(':event_type', $event_type);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':time', $time);

        foreach($events as $val)
        {
            $sensor_id = $val['sensor_id'];
            $event_type = $val['event_type'];
            $value = $val['value'];
            $time = $val['time'];

            $stmt->execute();
        }

        $stmt = $db->prepare($this->solution());
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        print_r($result);

        $output = [
            ['sensor_id' => 2, 'event_type' => 2, 'value' => 56],
            ['sensor_id' => 2, 'event_type' => 3, 'value' => 54],
            ['sensor_id' => 2, 'event_type' => 4, 'value' => -42],
            ['sensor_id' => 3, 'event_type' => 2, 'value' => 7],
        ];

        $this->assertEquals($output, $result);
    }
}