<?php

require_once "../src/DateTimeHelper.php";

$helper = new DateTimeHelper();

/**
 * =========================================
 * Date Methods Examples
 * =========================================
 *
 * Methods:
 * - convertTimeToMinute()
 * - convertMinuteToTime()
 */

echo PHP_EOL;

/**
 * Convert work duration into minutes
 */

$workDuration = "02:30";

var_dump([
    'time' => $workDuration,
    'minutes' => $helper->convertTimeToMinute($workDuration)
]);

echo PHP_EOL;

/**
 * Handle negative time values
 */

$delayDuration = "-01:45";

var_dump([
    'time' => $delayDuration,
    'minutes' => $helper->convertTimeToMinute($delayDuration)
]);

echo PHP_EOL;

/**
 * Convert minutes into HH:MM format
 */

$totalMinutes = 150;

var_dump([
    'minutes' => $totalMinutes,
    'formatted' => $helper->convertMinuteToTime($totalMinutes)
]);

echo PHP_EOL;

/**
 * Convert negative minutes into formatted time
 */

$negativeMinutes = -105;

var_dump([
    'minutes' => $negativeMinutes,
    'formatted' => $helper->convertMinuteToTime($negativeMinutes)
]);

echo PHP_EOL;