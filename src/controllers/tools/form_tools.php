<?php
namespace form_tools;

require_once 'vendor/autoload.php';

function is_date_valid($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

?>