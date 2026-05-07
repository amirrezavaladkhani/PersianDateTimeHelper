<?php

require_once "../src/DateTimeHelper.php";

$helper = new DateTimeHelper();

/**
 * =========================================
 * Month Methods Examples
 * =========================================
 *
 * Methods:
 * - getFirstDayOfMonth()
 * - getLastDayOfMonth()
 * - totalDaysOfMonth()
 */

echo PHP_EOL;

$month = 7;
$year = 1405;

/**
 * Get first day of month
 */

var_dump([
    'month' => $month,
    'year' => $year,
    'timestamp' => $helper->getFirstDayOfMonth($month, $year),
    'date' => date('Y-m-d H:i:s', $helper->getFirstDayOfMonth($month, $year))
]);

echo PHP_EOL;

/**
 * Get last day of month
 */

var_dump([
    'month' => $month,
    'year' => $year,
    'timestamp' => $helper->getLastDayOfMonth($month, $year, true),
    'date' => date('Y-m-d H:i:s', $helper->getLastDayOfMonth($month, $year, true))
]);

echo PHP_EOL;

/**
 * Get total days of month
 */

var_dump([
    'month' => $month,
    'year' => $year,
    'days' => $helper->totalDaysOfMonth($month, $year)
]);

echo PHP_EOL;