# First or Last Period Date
Get the First or Last Day of a Week, Month, Quarter or Year in PHP is a slight retouched of <a href="https://github.com/davgothic" target="_blank">@davgothic</a> First/Last Day Period <a href="https://davidhancock.co/2013/11/get-the-firstlast-day-of-a-week-month-quarter-or-year-in-php/" target="_blank">2013 Work</a>.

If you've ever needed to find the first or last day of a given period and you're rocking a PHP version greater than or equal to 5.2, today is your lucky day!<br>
Both functions used returns a DateTime object, so you can output the date in any format available to the PHP date() function.

## Demo and Examples
Please see <a href="https://codepad.remoteinterview.io/VNCISPZJVS" target="_blank">CodePad</a> for a demo.

## Installation
### Requirements
PHP >= 5.2

### With Composer - Basic Usage
```sh
$ composer require ikunyemingor/first-or-last-period-date
```
OR
```json
{
    "require": {
        "ikunyemingor/first-or-last-period-date": ">=0.1.0"
    }
}
```
```php
<?php

require 'vendor/autoload.php';

use LostCodes\PeriodDate;

$pd = new PeriodDate();

// Get current week first day.
$date = $pd->firstDayOf('week');
echo 'The first day of the current week is: ' . $date->format('l, jS F Y') . "\n";

// Get current week last day.
$date = $pd->lastDayOf('week');
echo 'The last day of the current week is: ' . $date->format('l, jS F Y') . "\n\n";

?>
```

### Without Composer - Basic Usage
```php
<?php

use LostCodes\PeriodDate;

require_once "includes/PeriodDate.php";

$pd = new PeriodDate();

// Get current week first day.
$date = $pd->firstDayOf('week');
echo 'The first day of the current week is: ' . $date->format('l, jS F Y') . "\n";

// Get current week last day.
$date = $pd->lastDayOf('week');
echo 'The last day of the current week is: ' . $date->format('l, jS F Y') . "\n\n";

?>
```

### More Examples
```php
<?php

$pd = new PeriodDate();
// Get today.
echo 'Today is: ' . date("l, jS F Y", strtotime("today")) . "\n\n";
// Get current week first and last day.
$date = $pd->firstDayOf('week');
echo 'The first day of the current week is: ' . $date->format('l, jS F Y') . "\n";
$date = $pd->lastDayOf('week');
echo 'The last day of the current week is: ' . $date->format('l, jS F Y') . "\n\n";

// Get current month first and last day.
$date = $pd->firstDayOf('month');
echo 'The first day of the current month is: ' . $date->format('l, jS F Y') . "\n";
$date = $pd->lastDayOf('month');
echo 'The last day of the current month is: ' . $date->format('l, jS F Y') . "\n\n";

// Get current year first and last day.
$date = $pd->firstDayOf('year');
echo 'The first day of the current year is: ' . $date->format('l, jS F Y') . "\n";
$date = $pd->lastDayOf('year');
echo 'The last day of the current year is: ' . $date->format('l, jS F Y') . "\n\n";

// Get yesterday.
echo 'Yesterday is: ' . date("l, jS F Y", strtotime("yesterday")) . "\n\n";
// Get previous week first and last day.
$specifiedDate = new DateTime(date('Y'));
$date          = $pd->firstDayOf('week', $specifiedDate, "last");
echo 'The first day of the previous week is: ' . $date->format('l, jS F Y') . "\n";
$date = $pd->lastDayOf('week', $specifiedDate, "last");
echo 'The last day of the previous week is: ' . $date->format('l, jS F Y') . "\n\n";

// Get previous month first and last day.
$specifiedDate = new DateTime(date('Y'));
$date          = $pd->firstDayOf('month', $specifiedDate, "last");
echo 'The first day of the previous month is: ' . $date->format('l, jS F Y') . "\n";
$date = $pd->lastDayOf('month', $specifiedDate, "last");
echo 'The last day of the previous month is: ' . $date->format('l, jS F Y') . "\n\n";

// Get previous year first and last day.
$specifiedDate = new DateTime(date('Y') - 1);
$date          = $pd->firstDayOf('year', $specifiedDate, "last");
echo 'The first day of the previous year is: ' . $date->format('l, jS F Y') . "\n";
$date = $pd->lastDayOf('year', $specifiedDate, "last");
echo 'The last day of the previous year is: ' . $date->format('l, jS F Y') . "\n\n";

?>
```
## Changes
View change log <a href="https://github.com/ikunyemingor/First-or-Last-Period-Date/blob/master/CHANGES.md" target="_blank">here</a>

## Contributors
Ikunyemi Ngor

## License
Released under the <a href="http://www.apache.org/licenses/LICENSE-2.0" target="_blank">Apache License 2.0</a>
