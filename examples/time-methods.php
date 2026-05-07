<?php

require_once "../src/DateTimeHelper.php";

$helper = new DateTimeHelper();

/**
 * =========================================
 * Time Methods Examples
 * =========================================
 *
 * Methods:
 * - convertTimeToDay()
 * - checkTimeRangeOverlap()
 */

echo PHP_EOL;

/**
 * Convert working hours into work days
 */

$workingTime = "12:00";

var_dump([
    'time' => $workingTime,
    'days' => $helper->convertTimeToDay($workingTime, true, 8)
]);

echo PHP_EOL;

/**
 * Handle negative work balance
 */

$negativeTime = "-04:00";

var_dump([
    'time' => $negativeTime,
    'days' => $helper->convertTimeToDay($negativeTime, true, 8)
]);

echo PHP_EOL;

/**
 * Check overlapping meeting schedules
 */

$meetingA = ["08:00", "12:00"];
$meetingB = ["10:00", "14:00"];

var_dump([
    'meeting_a' => $meetingA,
    'meeting_b' => $meetingB,
    'overlap' => $helper->checkTimeRangeOverlap($meetingA, $meetingB)
]);

echo PHP_EOL;

/**
 * Check non-overlapping schedules
 */

$shiftA = ["08:00", "12:00"];
$shiftB = ["13:00", "18:00"];

var_dump([
    'shift_a' => $shiftA,
    'shift_b' => $shiftB,
    'overlap' => $helper->checkTimeRangeOverlap($shiftA, $shiftB)
]);

echo PHP_EOL;