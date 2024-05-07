<?php
namespace tools;

class form_tools {
    public static function is_date_valid($date, $format = 'Y-m-d'){
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}
?>