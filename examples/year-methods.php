<?php

require_once "../src/DateTimeHelper.php";

$helper = new DateTimeHelper();

/**
 * =========================================
 * Year Methods Examples
 * =========================================
 *
 * Methods:
 * - getFirstDayOfYear()
 * - getLastDayOfYear()
 * - totalDaysOfThisYear()
 */

echo PHP_EOL;

/**
 * Get first day of Jalali year
 */

$year = 1405;

var_dump([
    'year' => $year,
    'timestamp' => $helper->getFirstDayOfYear($year),
    'date' => date('Y-m-d H:i:s', $helper->getFirstDayOfYear($year))
]);

echo PHP_EOL;

/**
 * Get last day of Jalali year
 */

var_dump([
    'year' => $year,
    'timestamp' => $helper->getLastDayOfYear($year),
    'date' => date('Y-m-d H:i:s', $helper->getLastDayOfYear($year))
]);

echo PHP_EOL;

/**
 * Calculate total days of year
 */

var_dump([
    'year' => $year,
    'days' => $helper->totalDaysOfThisYear($year)
]);

echo PHP_EOL;