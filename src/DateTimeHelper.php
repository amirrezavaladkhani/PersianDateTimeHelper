<?php

require_once "jdf.php";

/**
 * @name DateTimeHelper
 * @Author https://github.com/amirrezavaladkhani
 * @Version 0.0.1
 */
class DateTimeHelper
{
    #region Date Methods
    /**
     * Converts a time string (e.g., "HH:MM" or "H:MM") into minutes.
     * Handles negative time values if the hour part is negative.
     * @param string $time The time string to convert. Defaults to '00:00'.
     * @param string $separator The separator character used in the time string. Defaults to ':'.
     * @return float|int The total number of minutes represented by the time string. Returns 0 if the format is invalid or cannot be parsed.
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
     * Converts a total number of minutes into a time format (HH:MM).
     * The hours and minutes are padded with leading zeros if necessary.
     * If the input time is negative, the output time will be prefixed with a minus sign.
     * @param int $time The total number of minutes to convert.
     * @param string $separator The separator to use between hours and minutes. Defaults to ':'.
     * @return string The formatted time string (e.g., "02:30", "-01:15").
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
    #region Time Methods
    /**
     * Converts a time string in HH:MM format into its equivalent number of days.
     * Supports negative time values and allows optional rounding of the result.
     *
     * @param string $time The time value in HH:MM format (e.g., "12:30" or "-05:15").
     * @param bool $roundOutput Whether to round the result to 2 decimal places.
     * @param float $hoursInDays The number of working hours that represent one day. Defaults to 24.
     *
     * @return float|int The calculated number of days, or 0 if the input format is invalid.
     */
    public
    function convertTimeToDay(string $time = "00:00", bool $roundOutput = false, float $hoursInDays = 24): float|int
    {
        $isNegative = false;
        if (str_starts_with($time, '-')) {
            $isNegative = true;
            $time = ltrim($time, '-');
        }

        if (!preg_match('/^\d{1,3}:\d{2}$/', $time)) {
            return 0;
        }

        $explodeTime = explode(':', $time);

        if (count($explodeTime) === 2) {
            $hours = intval($explodeTime[0]);
            $minutes = intval($explodeTime[1]);

            if ($minutes < 0 || $minutes >= 60) {
                return 0;
            }

            $totalHours = $hours + ($minutes / 60);

            if ($isNegative) {
                $totalHours *= -1;
            }

            $calculate = $totalHours / $hoursInDays;

            if ($roundOutput) {
                $calculate = round($calculate, 2);
            }

            return $calculate;
        }

        return 0;
    }

    /**
     * Checks whether two time intervals overlap.
     * Each interval must contain exactly two time values in H:i format.
     * If the start time is greater than the end time, the values are swapped automatically.
     *
     * @param array $searchInterval The first time interval as [startTime, endTime].
     * @param array $comparisonInterval The second time interval as [startTime, endTime].
     *
     * @return bool Returns true if the two intervals overlap; otherwise, false.
     */
    public
    function checkTimeRangeOverlap(array $searchInterval = ["00:00", "00:00"], array $comparisonInterval = ["00:00", "00:00"]): bool
    {
        if (count($searchInterval) !== 2 || count($comparisonInterval) !== 2) {
            return false;
        }

        $s1 = DateTime::createFromFormat('H:i', $searchInterval[0]);
        $e1 = DateTime::createFromFormat('H:i', $searchInterval[1]);
        $s2 = DateTime::createFromFormat('H:i', $comparisonInterval[0]);
        $e2 = DateTime::createFromFormat('H:i', $comparisonInterval[1]);

        if (!$s1 || !$e1 || !$s2 || !$e2) {
            return false;
        }

        if ($s1 > $e1) {
            [$s1, $e1] = [$e1, $s1];
        }

        if ($s2 > $e2) {
            [$s2, $e2] = [$e2, $s2];
        }

        return $s1 < $e2 && $s2 < $e1;
    }
    #endregion
    #region Year Methods
    /**
     * Gets the timestamp for the first day of a given solar year.
     * If the year is not provided, it defaults to the current solar year.
     * @param int|null $year The solar year. Defaults to the current solar year.
     * @return false|int The timestamp of the first day of the year (00:00:00 on 1st Farvardin), or false on failure.
     */
    public
    function getFirstDayOfYear(int|null $year = null): false|int
    {
        return jmktime(0, 0, 0, '01', '01', (($year) ?: jdate("Y")));
    }

    /**
     * Receives the solar year as input and returns the timestamp of the last day of that solar year.
     * Example: Input year 1403, Output: 1742416200 (timestamp for 1403-12-30 23:59:59)
     * @param int|null $year The solar year. Defaults to the current solar year if not provided.
     * @return int The timestamp of the last day of the solar year.
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
     * @param int|null $year The solar year to calculate the number of days for. Defaults to the current solar year if not provided.
     * @return array|int|string Returns the total number of days (365 or 366) as an integer, or potentially other types based on internal logic if year is not provided (though the primary documented return is int).
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
    #region Month Methods
    /**
     * Gets the timestamp for the first day of a given month and year.
     * If month or year are not provided, it defaults to the current month and year.
     * Ensures month is a valid two-digit number (defaults to '01' if invalid).
     * Adjusts the year if the month exceeds 12.
     * @param int|null $month The month (1-12). Defaults to the current solar month.
     * @param int|null $year The solar year. Defaults to the current solar year.
     * @return false|int The timestamp of the first day of the month, or false on failure.
     */
    public
    function getFirstDayOfMonth(int|null $month = null, int|null $year = null): false|int
    {
        if (is_null($month)) {
            $month = jdate('m');
        }
        if (is_null($year)) {
            $year = jdate("Y");
        }
        $month = ($month <= 12 ? $this->fixTwoDigitsNumber($month) : "1");
        $year += ($month > 12 ? 1 : 0);
        return jmktime(0, 0, 0, $month, '01', $year);
    }

    /**
     * Gets the timestamp for the last day of a given month and year.
     * If month or year are not provided, it defaults to the current month and year.
     * Calculates the first day of the *next* month and subtracts a day (or exactly one second if $returnExactTime is true) to get the last day of the current month.
     * @param int|null $month The month (1-12). Defaults to the current solar month.
     * @param int|null $year The solar year. Defaults to the current solar year.
     * @param bool $returnExactTime If true, returns the timestamp of the very end of the last day (23:59:59). If false (default), returns the timestamp of the beginning of the last day (effectively, the start of the next day minus 1 day).
     * @return false|int The timestamp of the last day of the month, or false on failure.
     */
    public
    function getLastDayOfMonth(int|null $month = null, int|null $year = null, bool $returnExactTime = false): false|int
    {
        if (is_null($month)) {
            $month = jdate('m');
        }
        if (is_null($year)) {
            $year = jdate("Y");
        }
        $month = ($month < 12 ? (intval($this->fixTwoDigitsNumber($month)) + 1) : 1);
        $year += ($month < 12 ? 0 : 1);
        return jmktime(0, 0, 0, $month, '01', $year) - (($returnExactTime) ? 1 : 86400);
    }

    /**
     * Returns the total number of days in a given month and year.
     * If the month or year is not provided, the current month and year are used.
     *
     * @param int|null $month The month (1–12). Defaults to the current month if null.
     * @param int|null $year The year. Defaults to the current year if null.
     *
     * @return int|string The total number of days in the specified month (e.g., 31, 30, or 29).
     */
    public
    function totalDaysOfMonth(int|null $month = null, int|null $year = null): int|string
    {
        if (is_null($month)) {
            $month = jdate('n');
        }

        if (is_null($year)) {
            $year = jdate("Y");
        }

        return jdate('t', $this->getFirstDayOfMonth($month, $year));
    }
    #endregion
    #region Number Methods
    /**
     * Formats a number into a two-digit string, padding with a leading zero if necessary.
     * Example: 1 => "01", 12 => "12"
     * @param int $number The number to format.
     * @return string The two-digit formatted string.
     */
    public
    function fixTwoDigitsNumber(int $number): string
    {
        return (strlen(strval($number)) == 1) ? '0' . $number : strval($number);
    }

    #endregion
    #region Timestamp Methods
    /**
     * Converts a Jalali (Persian) date string to a Unix timestamp.
     * If the input format is invalid or conversion fails, returns today's timestamp.
     *
     * The input date must be in `Y/m/d` Jalali format (e.g., "1403/02/16").
     * Internally, the date is converted to Gregorian using `jalali_to_gregorian()`
     * and then passed to `strtotime()` to obtain the Unix timestamp.
     *
     * @param string $date The Jalali date string in `Y/m/d` format.
     *
     * @return int|false The Unix timestamp for the given date, or today's timestamp
     *                   if conversion fails. May return false if `strtotime()` fails.
     */
    public
    function convertPersianDateToTimestamp(string $date): false|int
    {
        $explode = explode('/', $date);
        if (count($explode) == 3) {
            $convertToGregorian = jalali_to_gregorian($explode[0], $explode[1], $explode[2], '/');
            $output = strtotime($convertToGregorian);
        }
        return $output ?? strtotime('today');
    }
    #endregion
}