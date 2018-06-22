# First-or-Last-Period-Date
Get the First or Last Day of a Week, Month, Quarter or Year in PHP is slight retouched of <a href="https://github.com/davgothic" target="_blank">davgothic's</a> First/Last Day Period <a href="https://davidhancock.co/2013/11/get-the-firstlast-day-of-a-week-month-quarter-or-year-in-php/" target="_blank">2013 Work</a>.

If you've ever needed to find the first or last day of a given period and you're rocking a PHP version greater than or equal to 5.2, today is your lucky day!<br>
Both functions used returns a DateTime object, so you can output the date in any format available to the PHP date() function.

## Demo and Examples
Please see <a href="https://codepad.remoteinterview.io/VNCISPZJVS" target="_blank">CodePad</a> for a demo.

## Usage
### Requirements
PHP >= 5.2

### Basic Usage
```
<?php
class PeriodDate
{

    /**
     * PeriodDate constructor.
     *
     * @param string $timeZone Specified time zone.
     */
    public function __construct($timeZone = 'Europe/London')
    {
        // Set timezone.
        ini_set('date.timezone', $timeZone);
    }

    /**
     * Return the first day of the Week/Month/Quarter/Year that the current/provided date falls within.
     *
     * @param string   $period     The period to find the first day of. ('year', 'quarter', 'month', 'week').
     * @param DateTime $date       The date to use instead of the current date.
     * @param string   $periodTime Previous or current periods.
     *
     * @return DateTime
     * @throws InvalidArgumentException Error on invalid argument.
     */
    public function firstDayOf($period, DateTime $date = NULL, $periodTime = "this")
    {
        $period       = strtolower($period);
        $periodTime   = strtolower($periodTime);
        $validPeriods = [
            'year',
            'quarter',
            'month',
            'week',
        ];

        if (!in_array($period, $validPeriods)) {
            throw new InvalidArgumentException('Period must be one of: ' . implode(', ', $validPeriods));
        }

        $newDate = ($date === NULL) ? new DateTime() : clone $date;

        switch ($period) {
            case 'year':
                $newDate->modify('first day of january ' . (($periodTime == "last") ? (intval($newDate->format('Y')) - 1) : $newDate->format('Y')));
                break;

            case 'quarter':
                $month = $newDate->format('n');
                if ($month < 4) {
                    $newDate->modify('first day of january ' . (($periodTime == "last") ? (intval($newDate->format('Y')) - 1) : $newDate->format('Y')));
                } else if ($month > 3 && $month < 7) {
                    $newDate->modify('first day of april ' . (($periodTime == "last") ? (intval($newDate->format('Y')) - 1) : $newDate->format('Y')));
                } else if ($month > 6 && $month < 10) {
                    $newDate->modify('first day of july ' . (($periodTime == "last") ? (intval($newDate->format('Y')) - 1) : $newDate->format('Y')));
                } else if ($month > 9) {
                    $newDate->modify('first day of october ' . (($periodTime == "last") ? (intval($newDate->format('Y')) - 1) : $newDate->format('Y')));
                }
                break;

            case 'month':
                $newDate->modify('first day of ' . $periodTime . ' month');
                break;

            case 'week':
            default:
                $newDate->modify(($newDate->format('w') === '0') ? 'monday last week' : 'monday ' . $periodTime . ' week');
                break;
        }

        return $newDate;
    }

    /**
     * Return the last day of the Week/Month/Quarter/Year that the current/provided date falls within.
     *
     * @param string   $period     The period to find the last day of. ('year', 'quarter', 'month', 'week').
     * @param DateTime $date       The date to use instead of the current date.
     * @param string   $periodTime Previous or current periods.
     *
     * @return DateTime
     * @throws InvalidArgumentException Error on invalid argument.
     */
    public function lastDayOf($period, DateTime $date = NULL, $periodTime = "this")
    {
        $period       = strtolower($period);
        $periodTime   = strtolower($periodTime);
        $validPeriods = [
            'year',
            'quarter',
            'month',
            'week',
        ];

        if (!in_array($period, $validPeriods)) {
            throw new InvalidArgumentException('Period must be one of: ' . implode(', ', $validPeriods));
        }

        $newDate = (($date === NULL) ? new DateTime() : clone $date);

        switch ($period) {
            case 'year':
                $newDate->modify('last day of december ' . (($periodTime == "last") ? (intval($newDate->format('Y')) - 1) : $newDate->format('Y')));
                break;

            case 'quarter':
                $month = $newDate->format('n');
                if ($month < 4) {
                    $newDate->modify('last day of march ' . (($periodTime == "last") ? (intval($newDate->format('Y')) - 1) : $newDate->format('Y')));
                } else if ($month > 3 && $month < 7) {
                    $newDate->modify('last day of june ' . (($periodTime == "last") ? (intval($newDate->format('Y')) - 1) : $newDate->format('Y')));
                } else if ($month > 6 && $month < 10) {
                    $newDate->modify('last day of september ' . (($periodTime == "last") ? (intval($newDate->format('Y')) - 1) : $newDate->format('Y')));
                } else if ($month > 9) {
                    $newDate->modify('last day of december ' . (($periodTime == "last") ? (intval($newDate->format('Y')) - 1) : $newDate->format('Y')));
                }
                break;

            case 'month':
                $newDate->modify('last day of ' . $periodTime . ' month');
                break;

            case 'week':
            default:
                $newDate->modify(($newDate->format('w') === '0') ? 'now' : 'sunday ' . $periodTime . ' week');
                break;
        }

        return $newDate;
    }
}
```
```
$pd = new PeriodDate();
// Get today.
echo 'Today is: ' . date("l, jS F Y", strtotime("today")) . "\n\n";
// Get current week.
$date = $pd->firstDayOf('week');
echo 'The first day of the current week is: ' . $date->format('l, jS F Y') . "\n";
$date = $pd->lastDayOf('week');
echo 'The last day of the current week is: ' . $date->format('l, jS F Y') . "\n\n";

// Get current month.
$date = $pd->firstDayOf('month');
echo 'The first day of the current month is: ' . $date->format('l, jS F Y') . "\n";
$date = $pd->lastDayOf('month');
echo 'The last day of the current month is: ' . $date->format('l, jS F Y') . "\n\n";

// Get current year.
$date = $pd->firstDayOf('year');
echo 'The first day of the current year is: ' . $date->format('l, jS F Y') . "\n";
$date = $pd->lastDayOf('year');
echo 'The last day of the current year is: ' . $date->format('l, jS F Y') . "\n\n";

// Get yesterday.
echo 'Yesterday is: ' . date("l, jS F Y", strtotime("yesterday")) . "\n\n";
// Get previous week.
$specifiedDate = new DateTime(date('Y'));
$date          = $pd->firstDayOf('week', $specifiedDate, "last");
echo 'The first day of the previous week is: ' . $date->format('l, jS F Y') . "\n";
$date = $pd->lastDayOf('week', $specifiedDate, "last");
echo 'The last day of the previous week is: ' . $date->format('l, jS F Y') . "\n\n";

// Get previous month.
$specifiedDate = new DateTime(date('Y'));
$date          = $pd->firstDayOf('month', $specifiedDate, "last");
echo 'The first day of the previous month is: ' . $date->format('l, jS F Y') . "\n";
$date = $pd->lastDayOf('month', $specifiedDate, "last");
echo 'The last day of the previous month is: ' . $date->format('l, jS F Y') . "\n\n";

// Get previous year.
$specifiedDate = new DateTime(date('Y') - 1);
$date          = $pd->firstDayOf('year', $specifiedDate, "last");
echo 'The first day of the previous year is: ' . $date->format('l, jS F Y') . "\n";
$date = $pd->lastDayOf('year', $specifiedDate, "last");
echo 'The last day of the previous year is: ' . $date->format('l, jS F Y') . "\n\n";
```
## Contributors
Ikunyemi Ngor

## License
Released under the Apache License
