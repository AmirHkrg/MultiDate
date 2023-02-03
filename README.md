# MultiDate
Convert different types of dates (Jalali-Gregorian-Hijri) to each other.

---

# Example
#### With Optional input :
```php
MultiDate::Gregorian_To_Jalali();
```
###### OutPut: 1041-11-14 
---
#### With yout input :
```php
MultiDate::Gregorian_To_Jalali('y/m/d w G:i:s', date('y-m-d'), 'Asia/Tehran', 'fa', 'fa', 'fa');
```
###### OutPut: ۱۴۰۱/۱۱/۱۴ جمعه ۱۹:۲۳:۳۱ 

---

## Input

| Order | Input | Description | Default | Optional |
| --- | --- | --- | --- | --- |
| 1 | Format | The desired format for displaying the date <br> (acceptable characters [Here](https://github.com/AmirHkrg/MultiDate/edit/main/README.md#format)) | `'y-m-d'` | True |
| 2 | Date | The date you want to convert | `date('y-m-d')` | True |
| 3 | TimeZone | Desired time zone | `'Asia/Tehran'` for Jalali, <br> `'Asia/Riyadh'` for Hijri, <br> PHP Default for Gregorian | True |
| 4 | Writing Style | Writing Language | `'fa'` for Jalali, <br> `'en'` for Gregorian, <br> `'ar'` for Hijri  | True |
| 5 | Month Style | Writing language of the month | `'fa'` for Jalali, <br> `'en'` for Gregorian, <br> `'ar'` for Hijri | True |
| 6 | Week Style | Writing language of the week | `'fa'` for Jalali, <br> `'en'` for Gregorian, <br> `'ar'` for Hijri | True |

---

## Format

| Character | Description | Example |
| --- | --- | --- |
| y | Digits of the year | 23 |
| Y | The last two digits of the year | 2023 | 
| m | Digits of the month | 11 |
| M | Name of the month | February |
| d | Digits of the day | 03 |
| w | Name of the week | Friday |
| W | Digits of the week | 7 |
| g | 1 - 12 Hour | 05 |
| G | 00- 24 Hour | 17 |
| i | Digits of the minute | 18 |
| s | Digits of the second | 24 |
| a | Abbreviation AM-PM | am > ب.ظ |
| A | AM-PM | PM > قبل از ظهر |
| e | Time Zone | Asia/Tehran |

---

* Author  : AmirH_Krg
* Version : 1.0 => Last modify : 2 February 2023
* GitHub  : Https://Github.com/AmirHkrg

