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