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
}