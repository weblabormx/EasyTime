<?php

namespace WeblaborMX\EasyTime;

class Time {

    public $day;
    public $hour;
    public $minute;
    public $second; 
    private $lang = [
        'en' => [
            'days' => 'days',
            'day' => 'day',
            'minutes' => 'minutes',
            'minute' => 'minute',
            'hours' => 'hours',
            'hour' => 'hour',
        ],
        'es' => [
            'days' => 'días',
            'day' => 'día',
            'minutes' => 'minutos',
            'minute' => 'minuto',
            'hours' => 'horas',
            'hour' => 'hora',
        ]
    ];

    public function __construct($day, $hour, $minute, $second) {
        if($second >= 60 || $minute >= 60 || $hour >= 24)
            throw new \Exception("Error Format", 1);
            
        $this->day = (int) $day;
        $this->hour = (int) $hour;
        $this->minute = (int) $minute;
        $this->second = (int) $second;
    }

    public function format($format = 'normal') {
        if($format=='full')
            return $this->day.':'.sprintf('%02d', $this->hour).':'.sprintf('%02d', $this->minute).':'.sprintf('%02d', $this->second);
        $hour = $this->day * 24;
        $hour = $hour + $this->hour;
        return sprintf('%02d', $hour).':'.sprintf('%02d', $this->minute).':'.sprintf('%02d', $this->second);
    }

    /**
     * Convert to one kind of time
     */

    public function getSeconds() {
        $seconds = $this->day*24*60*60;
        $seconds += $this->hour*60*60;
        $seconds += $this->minute*60;
        $seconds += $this->second;
        return $seconds;
    }

    public function getMinutes() {
        $minutes = $this->day*24*60;
        $minutes += $this->hour*60;
        $minutes += $this->minute;
        $minutes += round(((100 / 60) * $this->second) * 0.01, 2);
        return $minutes;
    }

    public function getHours() {
        $hours = $this->day*24;
        $hours += $this->hour;
        $hours += round(((100 / 60) * $this->minute) * 0.01, 2);
        return $hours;
    }

    public function getDays() {
        $hours = $this->day;
        $hours += round(((100 / 24) * $this->hour) * 0.01, 2);
        return $hours;
    }

    /**
     * Humans
     */

    public function diffForHumans($lang = 'en') {
        $result = '';
        if($this->day > 1) {
            $result .= $this->day.' '.$this->lang[$lang]['days'];
        } elseif($this->day == 1) {
            $result .= $this->day.' '.$this->lang[$lang]['day'];
        }
        if($this->hour > 1) {
            if(strlen($result) > 0)
                $result .= ', ';
            $result .= $this->hour.' '.$this->lang[$lang]['hours'];
        } elseif($this->hour == 1) {
            if(strlen($result) > 0)
                $result .= ', ';
            $result .= $this->hour.' '.$this->lang[$lang]['hour'];
        }
        if($this->minute > 1) {
            if(strlen($result) > 0)
                $result .= ', ';
            $result .= $this->minute.' '.$this->lang[$lang]['minutes'];
        } elseif($this->minute == 1) {
            if(strlen($result) > 0)
                $result .= ', ';
            $result .= $this->minute.' '.$this->lang[$lang]['minute'];
        }
        return $result;
    }

    /**
     * Sum of objects
     */

    public function addTime($time) {
        $seconds = $this->getSeconds();
        $seconds += $time->getSeconds();
        return EasyTime::createFromSeconds($seconds);
    }

    /**
     * Additions
     */

    public function addSeconds($seconds) {
        $seconds += $this->getSeconds();
        return EasyTime::createFromSeconds($seconds);
    }

    public function addSecond() {
        return $this->addSeconds(1);
    }

    public function addMinutes($minutes) {
        $seconds = $minutes*60;
        $seconds += $this->getSeconds();
        return EasyTime::createFromSeconds($seconds);
    }

    public function addMinute() {
        return $this->addMinutes(1);
    }

    public function addHours($hours) {
        $seconds = $hours*60*60;
        $seconds += $this->getSeconds();
        return EasyTime::createFromSeconds($seconds);
    }

    public function addHour() {
        return $this->addHours(1);
    }

    public function addDays($day) {
        $seconds = $day*24*60*60;
        $seconds += $this->getSeconds();
        return EasyTime::createFromSeconds($seconds);
    }

    public function addDay() {
        return $this->addDays(1);
    }

    /**
     * Substractions
     */

    public function subSeconds($seconds) {
        $result = $this->getSeconds();
        $result -= $seconds;
        return EasyTime::createFromSeconds($result);
    }

    public function subSecond() {
        return $this->subSeconds(1);
    }

    public function subMinutes($minutes) {
        $seconds = $this->getSeconds();
        $seconds -= $minutes*60;
        return EasyTime::createFromSeconds($seconds);
    }

    public function subMinute() {
        return $this->subMinutes(1);
    }

    public function subHours($hours) {
        $seconds = $this->getSeconds();
        $seconds -= $hours*60*60;
        return EasyTime::createFromSeconds($seconds);
    }

    public function subHour() {
        return $this->subHours(1);
    }

    public function subDays($day) {
        $seconds = $this->getSeconds();
        $seconds -= $day*24*60*60;
        return EasyTime::createFromSeconds($seconds);
    }

    public function subDay() {
        return $this->subDays(1);
    }

}

