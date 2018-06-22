<?php

/**
 * Class PeriodDate - Get the First or Last Day of a Week, Month, Quarter or Year.
 *
 * @category Class
 * @author   Ikunyemi Ngor
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @link     http://www.lostCodes.com/
 *
 */

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