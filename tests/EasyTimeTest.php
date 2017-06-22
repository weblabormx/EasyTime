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

}
?> 