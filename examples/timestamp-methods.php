<?php

require_once "../src/DateTimeHelper.php";

$helper = new DateTimeHelper();

/**
 * =========================================
 * Timestamp Methods Examples
 * =========================================
 *
 * Methods:
 * - convertPersianDateToTimestamp()
 */

echo PHP_EOL;

/**
 * Convert Jalali date into Unix timestamp
 */

$persianDate = "1405/02/17";

$timestamp = $helper->convertPersianDateToTimestamp($persianDate);

var_dump([
    'jalali_date' => $persianDate,
    'timestamp' => $timestamp,
    'gregorian_date' => date('Y-m-d H:i:s', $timestamp)
]);

echo PHP_EOL;