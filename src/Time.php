<?php

namespace WeblaborMX\EasyTime;

class Time {

    public $day;
    public $hour;
    public $minute;
    public $second; 

    public function __construct($day, $hour, $minute, $second) {
        if($second >= 60 || $minute >= 60 || $hour >= 24)
            throw new \Exception("Error Format", 1);
            
        $this->day = $day;
        $this->hour = $hour;
        $this->minute = $minute;
        $this->second = $second;
    }

    public function format($format = 'normal') {
        if($format=='full')
            return $this->day.':'.sprintf('%02d', $this->hour).':'.sprintf('%02d', $this->minute).':'.sprintf('%02d', $this->second);
        $hour = $this->day * 24;
        $hour = $hour + $this->hour;
        return sprintf('%02d', $hour).':'.sprintf('%02d', $this->minute).':'.sprintf('%02d', $this->second);
    }
}

