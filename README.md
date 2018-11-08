# EasyTime
PHP Library to manage time

## Installation
- With composer run `composer require weblabormx/easy-time` 

### Basics
First to use the package you will need to add the namespace:
```php
use WeblaborMX\EasyTime\EasyTime;
```

## Creation
To create an object you have the next options.
```php
$time = EasyTime::createFromSeconds(20465);
$time = EasyTime::createFromFormat('10:30:00');
$time = EasyTime::createFromFormat('2:10:30:00'); // With days
$time = EasyTime::create(0, 10, 30, 00); // Days, Hours, Minutes, Seconds
```

## Getting Data
You can get the exact second, minute, hour or day, or if you prefer you can convert all data just for one and get for example, the total minutes only.
```php
$time = EasyTime::createFromFormat('2:10:30:00');
$time->second; 		// 0
$time->getSeconds(); 	// 210600 (Total seconds in all that time)
$time->minute; 		// 30
$time->getMinutes(); 	// 3510 (Total minutes in all that time)
$time->hour; 		// 10
$time->getHours(); 	// 58.5 (Total hours in all that time)
$time->day; 		// 2
$time->getDays(); 	// 2.42 (Total days in all that time)
$time->format(); 	// '58:30:00'
$time->format('full'); 	// '2:10:30:00'
```

## Sum of two objects
There are two options to do it
```php
$time = EasyTime::createFromFormat('00:30:30');
$time2 = EasyTime::createFromFormat('01:03:05');

// First way
$sum = EasyTime::sum($time, $time2);	// 01:33:35

// Second Way
$time = $time->addTime($time2); 	// 01:33:35
```

## Additions and Substractions
If you want to add or substract any time you can do it.
```php
$time = EasyTime::createFromFormat('00:30:30');
$time = $time->addSeconds(5);		// 0:00:30:35
$time = $time->addSecond();		// 0:00:30:36
$time = $time->addMinutes(6);		// 0:00:36:36
$time = $time->addMinute();		// 0:00:37:36
$time = $time->addHours(2);		// 0:02:37:36
$time = $time->addHour(); 		// 0:03:37:36
$time = $time->addDays(2);		// 2:03:37:36
$time = $time->addDay();		// 3:03:37:36
$time = $time->subDays(2);		// 1:03:37:36
$time = $time->subDay();		// 0:03:37:36
$time = $time->subHours(2);		// 0:01:37:36
$time = $time->subHour();		// 0:00:37:36
$time = $time->subMinutes(6);		// 0:00:31:36
$time = $time->subMinute();		// 0:00:30:36
$time = $time->subSeconds(5);		// 0:00:30:31
$time = $time->subSecond();		// 0:00:30:30
```

## Multiply and Divide
```php
$time = EasyTime::createFromFormat('00:30:31');
$time = $time->multiply(2); 		// 01:01:02
$time = $time->divide(2); 		// 00:30:31

$time = EasyTime::createFromFormat('00:30:31');
$time = $time->multiply(10.5); 		// 05:20:26
$time = $time->divide(2); 		// 02:40:13
```

## Human Readable
Get the human readable of a time
```php
$time = EasyTime::createFromFormat('2:10:30:00');
$time->diffForHumans(); // 2 days, 10 hours, 30 minutes

$time = EasyTime::createFromFormat('00:30:02');
$time->diffForHumans(); // 30 minutes

$time = EasyTime::createFromFormat('02:10:32');
$time->diffForHumans(); // 2 hours, 10 minutes

$time = EasyTime::createFromFormat('01:01:32');
$time->diffForHumans(); // 1 hour, 1 minute
```

### Location
If you want the text in any other language you can specify it. Now its available only English (en) and Spanish (es).
```php
$time = EasyTime::createFromFormat('2:10:30:00');
$time->diffForHumans('en'); // 2 days, 10 hours, 30 minutes
$time->diffForHumans('es'); // 2 días, 10 horas, 30 minutos
```
If you want to have it available in your language please email me to carlosescobar@weblabor.mx with translations with the next format.
```php
'es' => [
    'days' => 'días',
    'day' => 'día',
    'minutes' => 'minutos',
    'minute' => 'minuto',
    'hours' => 'horas',
    'hour' => 'hora',
]
```