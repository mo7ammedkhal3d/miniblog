<?php

namespace App\Custom;
class DateTime
{
    public static function toDate($dateAsString, $format)
    {
        $date = date_create($dateAsString);

        return date_format($date, $format);
    }

}