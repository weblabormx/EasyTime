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
}

