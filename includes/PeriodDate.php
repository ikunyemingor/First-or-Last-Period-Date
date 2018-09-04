<?php

namespace LostCodes;

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
     * @param string    $period     The period to find the first day of. ('year', 'quarter', 'month', 'week').
     * @param \DateTime $date       The date to use instead of the current date.
     * @param string    $periodTime Previous or current periods.
     *
     * @return \DateTime
     * @throws \InvalidArgumentException Error on invalid argument.
     */
    public function firstDayOf($period, \DateTime $date = NULL, $periodTime = "this")
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
            throw new \InvalidArgumentException('Period must be one of: ' . implode(', ', $validPeriods));
        }

        $newDate = ($date === NULL) ? new \DateTime() : clone $date;

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
     * @param string    $period     The period to find the last day of. ('year', 'quarter', 'month', 'week').
     * @param \DateTime $date       The date to use instead of the current date.
     * @param string    $periodTime Previous or current periods.
     *
     * @return \DateTime
     * @throws \InvalidArgumentException Error on invalid argument.
     */
    public function lastDayOf($period, \DateTime $date = NULL, $periodTime = "this")
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
            throw new \InvalidArgumentException('Period must be one of: ' . implode(', ', $validPeriods));
        }

        $newDate = (($date === NULL) ? new \DateTime() : clone $date);

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

    /**
     * Get first day of each week between two dates.
     *
     * @param string $startDate                Start date of range.
     * @param string $endDate                  End date of range.
     * @param string $dayNumber                Day number to use as first day of week where:
     *                                         1 = Monday,
     *                                         2 = Tuesday,
     *                                         3 = Wednesday,
     *                                         4 = Thursday,
     *                                         5 = Friday,
     *                                         6 = Saturday,
     *                                         7 = Sunday.
     * @param string $returnedDateFormat       Returned date format.
     *
     * @return array
     */
    public function getWeekFirstDayBetweenDates($startDate, $endDate, $dayNumber = "1", $returnedDateFormat = "d-m-Y")
    {
        $dateArray = [];
        if (!empty($startDate)) {
            $endDate = ((empty($endDate)) ? strtotime(date('Y-m-d')) : strtotime($endDate));
            $days    = [
                '1' => 'Monday',
                '2' => 'Tuesday',
                '3' => 'Wednesday',
                '4' => 'Thursday',
                '5' => 'Friday',
                '6' => 'Saturday',
                '7' => 'Sunday',
            ];
            for ($i = strtotime($days[$dayNumber], strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 week', $i)) {
                $dateArray[] = date($returnedDateFormat, $i);
            }
        }

        return $dateArray;
    }
}