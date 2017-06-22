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


}
?> 