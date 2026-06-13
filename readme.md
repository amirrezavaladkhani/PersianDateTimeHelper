# 🗓️ PHP Persian DateTime Manager

A lightweight and developer-friendly PHP helper for working with **Persian (Jalali)** and **Gregorian** dates, time calculations, timestamps, and date range operations.

Designed for ERP systems, business applications, and any PHP project that requires reliable date and time manipulation.

---

## ✨ Features

* 📅 Persian (Jalali) date support via **JDF**
* ⏱️ Convert `HH:MM` strings to minutes and vice versa
* 📆 Convert time values to working days
* 🔄 Convert Jalali dates to Unix timestamps
* 📌 Get the first and last day of a month or year
* 📊 Calculate total days in a month or year
* ⏰ Detect overlapping time ranges
* 🔢 Automatic two-digit number formatting
* 🚀 Lightweight with zero unnecessary dependencies

---

## 📦 Installation

Clone the repository or copy the `DateTimeHelper.php` file into your project.

```php
require_once 'jdf.php';
require_once 'DateTimeHelper.php';

$helper = new DateTimeHelper();
```

---

## 🚀 Usage Examples

### Convert Time to Minutes

```php
echo $helper->convertTimeToMinute("02:30");
// Output: 150
```

---

### Convert Minutes to Time

```php
echo $helper->convertMinuteToTime(135);
// Output: 02:15
```

---

### Convert Time to Days

```php
echo $helper->convertTimeToDay("12:00");
// Output: 0.5
```

With custom working hours:

```php
echo $helper->convertTimeToDay("08:00", true, 8);
// Output: 1
```

---

### Check Time Range Overlap

```php
$helper->checkTimeRangeOverlap(
    ["09:00", "12:00"],
    ["11:00", "15:00"]
);

// true
```

---

### Get First Day of Current Year

```php
$timestamp = $helper->getFirstDayOfYear();
```

---

### Get Last Day of Current Year

```php
$timestamp = $helper->getLastDayOfYear();
```

---

### Get First Day of a Month

```php
$timestamp = $helper->getFirstDayOfMonth(5, 1404);
```

---

### Get Last Day of a Month

```php
$timestamp = $helper->getLastDayOfMonth(5, 1404, true);
```

---

### Total Days of a Month

```php
echo $helper->totalDaysOfMonth(12, 1403);
```

---

### Total Days of a Year

```php
echo $helper->totalDaysOfThisYear(1403);
```

---

### Convert Jalali Date to Timestamp

```php
echo $helper->convertPersianDateToTimestamp("1403/05/15");
```

---

### Format Numbers

```php
echo $helper->fixTwoDigitsNumber(7);
// Output: 07
```

---

## 📚 Available Methods

| Method                            | Description                           |
| --------------------------------- | ------------------------------------- |
| `convertTimeToMinute()`           | Convert `HH:MM` to minutes            |
| `convertMinuteToTime()`           | Convert minutes to `HH:MM`            |
| `convertTimeToDay()`              | Convert time to fractional days       |
| `checkTimeRangeOverlap()`         | Check whether two time ranges overlap |
| `getFirstDayOfYear()`             | Get the first day of a Jalali year    |
| `getLastDayOfYear()`              | Get the last day of a Jalali year     |
| `totalDaysOfThisYear()`           | Return total days in a Jalali year    |
| `getFirstDayOfMonth()`            | Get the first day of a month          |
| `getLastDayOfMonth()`             | Get the last day of a month           |
| `totalDaysOfMonth()`              | Return total days in a month          |
| `convertPersianDateToTimestamp()` | Convert Jalali date to Unix timestamp |
| `fixTwoDigitsNumber()`            | Pad numbers with leading zero         |

---

## 🎯 Use Cases

* ERP Systems
* HR & Attendance Management
* Payroll Applications
* Accounting Software
* Scheduling Systems
* Reporting Dashboards
* Persian Calendar Utilities

---

## 🛠️ Requirements

* PHP 8.0+
* JDF (Jalali Date Functions) library

---

## 🤝 Contributing

Contributions, issues, and feature requests are welcome!

Feel free to fork the project and submit a pull request.

---

## 📄 License

This project is released under the **MIT License**.

---

## 👨‍💻 Author

**Amirreza Valadkhani**

GitHub: https://github.com/amirrezavaladkhani
