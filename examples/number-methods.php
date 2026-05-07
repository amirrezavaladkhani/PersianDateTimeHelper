<?php

require_once "../src/DateTimeHelper.php";

$helper = new DateTimeHelper();

/**
 * =========================================
 * Number Methods Examples
 * =========================================
 *
 * Methods:
 * - fixTwoDigitsNumber()
 */

echo PHP_EOL;

/**
 * Format single digit number
 */

$number = 5;

var_dump([
    'input' => $number,
    'formatted' => $helper->fixTwoDigitsNumber($number)
]);

echo PHP_EOL;

/**
 * Format already valid number
 */

$number = 12;

var_dump([
    'input' => $number,
    'formatted' => $helper->fixTwoDigitsNumber($number)
]);

echo PHP_EOL;