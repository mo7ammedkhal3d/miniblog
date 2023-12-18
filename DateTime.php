<?php

class DateHelper
{
    public static function toDate($dateAsString, $format)
    {
        $date = date_create($dateAsString);

        return date_format($date, $format);
    }

}