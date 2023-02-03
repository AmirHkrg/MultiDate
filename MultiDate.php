<?php

/*
 *  Name    : MultiDate => Jalali-Gregorian-Hijri
 *  Author  : AmirH_Krg
 *  License : GNU/LGPL => Open Source AND Free
 *  Version : 1.0 => Last modify : 2 February 2023
 *  GitHub  : Https://Github.com/AmirHkrg
 */

class MultiDate
{
    private static function toDigitNumber($number)
    {
        return ($number < 10) ? $number = '0' . $number : $number;
    }

    private static function enToFa($string)
    {
        return strtr($string, array('0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴', '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹'));
    }

    private static function faToEn($string)
    {
        return strtr($string, array('۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9', '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'));
    }

    private static function dateFormatter($format, $timeStamp, $year, $month, $days, $lang, $monthStyle, $weekStyle, $to)
    {
        $am_pm = date('a');
        $AM_PM = date('A');

        if ($lang == 'fa') {
            if ($am_pm == 'am') {
                $am_pm = 'ب.ظ';
            } elseif ($am_pm == 'pm') {
                $am_pm = 'ق.ظ';
            }
            if ($AM_PM == 'AM') {
                $AM_PM = 'قبل از ظهر';
            } elseif ($AM_PM == 'PM') {
                $AM_PM = 'بعد از ظهر';
            }
        }

        if ($to == 'G2J') {
            $monthName = self::JMonth($monthStyle)[$month - 1];
            $weekName = self::JWeek($weekStyle)[date('w', $timeStamp) + 1];
        } elseif ($to == 'J2G') {
            $monthName = self::GMonth($monthStyle)[$month - 1];
            $weekName = self::GWeek($weekStyle)[date('w', $timeStamp) + 1];
        }

        $second = date('s');
        $minute = date('i');
        $hour12 = date('g');
        $hour24 = date('G');
        $timezone = date('e');

        $format_char = str_split($format);
        $accepted_char = ['y', 'M', 'm', 'd', 'w', 's', 'i', 'a', 'A', 'g', 'G', 'e'];
        $date_format = '';
        foreach ($format_char as $char) {
            if (in_array($char, $accepted_char)) {
                $date_format .= '%%' . $char;
            } else {
                $date_format .= $char;
            }
        }

        $date_format = str_replace('%%y', $year, $date_format);                // Year
        $date_format = str_replace('%%M', $monthName, $date_format);          // Month Name
        $date_format = str_replace('%%m', $month, $date_format);             // Month Number
        $date_format = str_replace('%%d', $days, $date_format);             // Day
        $date_format = str_replace('%%w', $weekName, $date_format);        // Week Name
        $date_format = str_replace('%%s', $second, $date_format);         // Second
        $date_format = str_replace('%%i', $minute, $date_format);        // Minute
        $date_format = str_replace('%%a', $am_pm, $date_format);        // Abbreviation AM-PM
        $date_format = str_replace('%%A', $AM_PM, $date_format);       // AM-PM
        $date_format = str_replace('%%g', $hour12, $date_format);     // 1 - 12 Hour
        $date_format = str_replace('%%G', $hour24, $date_format);    // 00 - 24 Hour
        $date_format = str_replace('%%e', $timezone, $date_format); // Time Zone

        if ($lang == 'fa') {
            return self::enToFa($date_format);
        } elseif ($lang == 'en') {
            return self::faToEn($date_format);
        }
    }

    private static function GMonth($lang)
    {
        if ($lang == 'en') {
            return ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',];
        } else {
            return ['ژانویه', 'فوریه', 'مارس', 'آوریل', 'مه', 'ژوئن', 'ژوئیه', 'اوت', 'سپتامبر', 'اکتبر', 'نوامبر', 'دسامبر'];

        }
    }

    private static function JMonth($lang)
    {
        if ($lang == 'en') {
            return ['Farvardin', 'Ordibehesht', 'Khordad', 'Tir', 'Mordad', 'Shahrivar', 'Mehr', 'Aban', 'Azar', 'Dey', 'Bahman', 'Esfand',];
        } else {
            return ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'];

        }
    }

    private static function JWeek($lang)
    {
        if ($lang == 'en') {
            return ['Shanbe', 'Yek Shanbe', 'Do Shanbe', 'Se Shanbe', 'Chahar Shanbe', 'Panj Shanbe', 'Jomme'];
        } else {
            return ['شنبه', 'یک شنبه', 'دو شنبه', 'سه شنبه', 'چهار شنبه', 'پنج شنبه', 'جمعه'];
        }
    }

    private static function GWeek($lang)
    {
        if ($lang == 'en') {
            return ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        } else {
            return ['ستردی', 'ساندی', 'ماندی', 'توزدی', 'ونزدی', 'ترزدی', 'فرایدی'];
        }
    }

    public static function Gregorian_To_Jalali($format = 'y-m-d', $date = '', $timeZone = 'Asia/Tehran', $writingStyle = 'fa', $monthStyle = '', $weekStyle = '')
    {
        date_default_timezone_set($timeZone);
        if ($date == '') {
            $date = date('Y-m-d');
        }
        if (is_numeric($date)) {
            $timeStamp = $date;
        } else {
            $timeStamp = strtotime($date);
        }

        if ($monthStyle == '') {
            $monthStyle = $writingStyle;
        }
        if ($weekStyle == '') {
            $weekStyle = $writingStyle;
        }

        $daysPassed = floor($timeStamp / 86400) + 1;
        $days = $daysPassed;
        $month = 11;
        $year = 1348;
        $days -= 19;

        $daysInMonths = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];

        while (true) {
            if ($days > $daysInMonths[$month - 1]) {
                $days -= $daysInMonths[$month - 1];
                $month++;
                if ($month == 13) {
                    $year++;
                    if (($year - 1347) % 4 == 0) {
                        $days--;
                    }
                    $month = 1;
                }
            } else {
                break;
            }
        }

        $month = self::toDigitNumber($month);
        $days = self::toDigitNumber($days);

        $fullDate = self::dateFormatter($format, $timeStamp, $year, $month, $days, $writingStyle, $monthStyle, $weekStyle, 'G2J');
        return $fullDate;
    }
}