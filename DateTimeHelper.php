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
    function convertTimeToMinute(
        string $time = '00:00',
        string $separator = ':'
    ): float|int
    {
        $explodeTime = explode($separator, $time);

        if (count($explodeTime) > 1) {
            $result = ((intval($explodeTime[0]) * 60) + (((str_contains($explodeTime[0], '-')) ? -1 : 1) * intval($explodeTime[1])));
        }

        return $result ?? 0;
    }
    #endregion

}