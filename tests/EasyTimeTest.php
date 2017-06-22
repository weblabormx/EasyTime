<?php

use \WeblaborMX\EasyTime\EasyTime;
include_once 'tests/loader.php';

class EasyTimeTest extends \PHPUnit_Framework_TestCase {

	public function testCreateFromSeconds() {

		$time = EasyTime::createFromSeconds(20465);
		$this->assertEquals('05:41:05', $time->format());

		$time = EasyTime::createFromSeconds(1640467);
		$this->assertEquals('18:23:41:07', $time->format('full'));

	}

	public function testCreateFromFormat() {

		$time = EasyTime::createFromFormat('10:30:00');
		$this->assertEquals('10:30:00', $time->format());

		$time = EasyTime::createFromFormat('2:10:30:00');
		$this->assertEquals('58:30:00', $time->format());
		$this->assertEquals('2:10:30:00', $time->format('full'));

	}

	public function testCreate() {

		$time = EasyTime::create(0, 10,30,00);
		$this->assertEquals('10:30:00', $time->format());

		$time = EasyTime::create(2, 10,30,00);
		$this->assertEquals('58:30:00', $time->format());
		$this->assertEquals('2:10:30:00', $time->format('full'));

	}

	public function testGetFunctions() {

		$time = EasyTime::createFromFormat('2:10:30:00');
		$this->assertEquals(0, $time->second);
		$this->assertEquals(210600, $time->getSeconds());
		$this->assertEquals(30, $time->minute);
		$this->assertEquals(3510, $time->getMinutes());
		$this->assertEquals(10, $time->hour);
		$this->assertEquals(58.5, $time->getHours());
		$this->assertEquals(2, $time->day);
		$this->assertEquals(2.42, $time->getDays());

	}

	public function testHumanFunctions() {

		$time = EasyTime::createFromFormat('2:10:30:00');
		$this->assertEquals('2 days, 10 hours, 30 minutes', $time->diffForHumans());
		$this->assertEquals('2 days, 10 hours, 30 minutes', $time->diffForHumans('en'));
		$this->assertEquals('2 días, 10 horas, 30 minutos', $time->diffForHumans('es'));
		
		$time = EasyTime::createFromFormat('00:30:02');
		$this->assertEquals('30 minutes', $time->diffForHumans());
		$this->assertEquals('30 minutos', $time->diffForHumans('es'));

		$time = EasyTime::createFromFormat('02:10:32');
		$this->assertEquals('2 hours, 10 minutes', $time->diffForHumans());
		$this->assertEquals('2 horas, 10 minutos', $time->diffForHumans('es'));

		$time = EasyTime::createFromFormat('01:01:32');
		$this->assertEquals('1 hour, 1 minute', $time->diffForHumans());
		$this->assertEquals('1 hora, 1 minuto', $time->diffForHumans('es'));

	}

	public function testSumOfObjects() {

		$time = EasyTime::createFromFormat('00:30:30');
		$time2 = EasyTime::createFromFormat('01:03:05');
		$sum = EasyTime::sum($time, $time2);
		$this->assertEquals('01:33:35', $sum->format());

		$time = $time->addTime($time2);
		$this->assertEquals('01:33:35', $time->format());

	}

	public function testAdditionsAndSubstractions() {

		$time = EasyTime::createFromFormat('00:30:30');
		$time = $time->addSeconds(5);
		$time = $time->addSecond();
		$this->assertEquals('00:30:36', $time->format());
		$time = $time->addMinutes(6);
		$time = $time->addMinute();
		$this->assertEquals('00:37:36', $time->format());
		$time = $time->addHours(2);
		$time = $time->addHour();
		$this->assertEquals('03:37:36', $time->format());
		$time = $time->addDays(2);
		$time = $time->addDay();
		$this->assertEquals('3:03:37:36', $time->format('full'));
		$time = $time->subDays(2);
		$time = $time->subDay();
		$this->assertEquals('03:37:36', $time->format());
		$time = $time->subHours(2);
		$time = $time->subHour();
		$this->assertEquals('00:37:36', $time->format());
		$time = $time->subMinutes(6);
		$time = $time->subMinute();
		$this->assertEquals('00:30:36', $time->format());
		$time = $time->subSeconds(5);
		$time = $time->subSecond();
		$this->assertEquals('00:30:30', $time->format());

	}

	public function testOperations() {

		$time = EasyTime::createFromFormat('00:30:31');
		$time = $time->multiply(2); 
		$this->assertEquals('01:01:02', $time->format());
		$time = $time->divide(2); 
		$this->assertEquals('00:30:31', $time->format());

		$time = EasyTime::createFromFormat('00:30:31');
		$time = $time->multiply(10.5); 
		$this->assertEquals('05:20:26', $time->format());
		$time = $time->divide(2); 
		$this->assertEquals('02:40:13', $time->format());

	}

}
?> 