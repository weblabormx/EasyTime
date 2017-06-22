<?php

namespace WeblaborMX\EasyTime;

class EasyTime {

    public static $time;
    public static $pointer;

    

    public static function create($days, $hours, $minutes, $seconds) {
        self::$time = new Time($days, $hours, $minutes, $seconds);
        self::$pointer = new self;
        return self::$pointer;
    }

    public static function createFromFormat($data) {
        $data = explode(':', $data);
        if(count($data)==3)
            self::$time = new Time(0, $data[0], $data[1], $data[2]);
        if(count($data)>3)
            self::$time = new Time($data[0], $data[1], $data[2], $data[3]);
        self::$pointer = new self;
        return self::$pointer;
    }

    public static function createFromSeconds($seconds) {
        $result = self::secondsToTime($seconds);
        self::$time = new Time($result['d'], $result['h'], $result['m'], $result['s']);
        self::$pointer = new self;
        return self::$pointer;
    }

    public function format($format = null) {
        if(is_null($format))
            $format = 'H:i:s';
        return self::$time->format($format);

    }

    public static function secondsToTime($inputSeconds) {

        $secondsInAMinute = 60;
        $secondsInAnHour  = 60 * $secondsInAMinute;
        $secondsInADay    = 24 * $secondsInAnHour;

        // extract days
        $days = floor($inputSeconds / $secondsInADay);

        // extract hours
        $hourSeconds = $inputSeconds % $secondsInADay;
        $hours = floor($hourSeconds / $secondsInAnHour);

        // extract minutes
        $minuteSeconds = $hourSeconds % $secondsInAnHour;
        $minutes = floor($minuteSeconds / $secondsInAMinute);

        // extract the remaining seconds
        $remainingSeconds = $minuteSeconds % $secondsInAMinute;
        $seconds = ceil($remainingSeconds);

        // return the final array
        $obj = array(
            'd' => (int) $days,
            'h' => (int) $hours,
            'm' => (int) $minutes,
            's' => (int) $seconds,
        );
        return $obj;
    }

}

