<?php
namespace controllers\tools\form_tools;

function is_date_valid($date, $format = 'Y-m-d'){
    $d = \DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}
?>