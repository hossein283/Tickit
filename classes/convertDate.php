<?php

namespace classes;

class convertDate
{
    public function convert($date)
    {
        @$ex = explode(' ', $date);
        list($year, $month, $day) = explode('-', $ex[0]);
        list($hour, $min, $sec) = explode(':', $ex[1]);
        @$time = mktime($hour, $min, $sec, $month, $day, $year);
        return jdate('تاریخ: Y/m/d  ----   زمان: H:i:s', $time);
    }
}