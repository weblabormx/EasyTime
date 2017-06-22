# EasyTime
PHP Library to manage time

## Installation
- With composer run `composer require weblabormx/easy-time` 

## Creation
To create an object you have the next options.
```php
$time = EasyTime::createFromSeconds(20465);
$time = EasyTime::createFromFormat('10:30:00');
$time = EasyTime::createFromFormat('2:10:30:00'); // With days
$time = EasyTime::create(0, 10,30,00); // Days, Hours, Minutes, Seconds
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