<?php

require_once "src/jdf.php";

/**
 * @name DateTimeHelper
 * @Author https://github.com/amirrezavaladkhani
 * @Version 0.0.1
 */
class DateTimeHelper
{
    #region Date Methods

    /**
     * convert time format to minute format
     * @param string $time
     * @param string $separator
     * @return float|int
     */
    public
    function convertTimeToMinute(string $time = '00:00', string $separator = ':'): float|int
    {
        $explodeTime = explode($separator, $time);

        if (count($explodeTime) > 1) {
            $result = ((intval($explodeTime[0]) * 60) + (((str_contains($explodeTime[0], '-')) ? -1 : 1) * intval($explodeTime[1])));
        }

        return $result ?? 0;
    }

    /**
     * convert minute format to time format
     * @param int $time
     * @param string $separator
     * @return string
     */
    public
    function convertMinuteToTime(int $time, string $separator = ':'): string
    {
        $hours = floor(abs($time) / 60);
        $minutes = abs($time) % 60;

        $formattedTime = $this->fixTwoDigitsNumber($hours) . $separator . $this->fixTwoDigitsNumber($minutes);

        return $time < 0 ? '-' . $formattedTime : $formattedTime;
    }
    #endregion
    #region Year Methods
    /**
     * Receives the solar year as input and returns the timestamp of the first day of that solar year.
     * Example: Input year 1403, Output: 1711890600 (timestamp for 1403-01-01 00:00:00)
     * @param int|null $year
     * @return false|int
     */
    public
    function getFirstDayOfYear(int|null $year = null): false|int
    {
        return jmktime(0, 0, 0, '01', '01', (($year) ?: jdate("Y")));
    }

    /**
     * Receives the solar year as input and returns the timestamp of the last day of that solar year.
     * Example: Input year 1403, Output: 1742416200 (timestamp for 1403-12-30 23:59:59)
     * @param int|null $year
     * @return int
     */
    public
    function getLastDayOfYear(int|null $year = null): int
    {
        return jmktime(0, 0, 0, '01', '01', ((($year) ?: jdate("Y")) + 1)) - 1;
    }

    /**
     * Calculates the total number of days in a given solar year, accounting for leap years.
     * Example: Input year 1402 (non-leap), Output: 365
     * Example: Input year 1403 (leap), Output: 366
     * @param int|null $year
     * @return array|int|string
     */
    public
    function totalDaysOfThisYear(int|null $year = null): array|int|string
    {
        if (!$year) {
            return jdate('z') + jdate('Q') + 1;
        }
        return (($year + 1) % 4 == 0) ? 366 : 365;
    }
    #endregion
    #region Number Methods

    /**
     * Formats a number into a two-digit string, padding with a leading zero if necessary.
     * Example: 1 => "01", 12 => "12"
     * @param int $number
     * @return string
     */
    public
    function fixTwoDigitsNumber(int $number): string
    {
        return (strlen(strval($number)) == 1) ? '0' . $number : strval($number);
    }

    #endregion
}