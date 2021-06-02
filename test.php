<?php
$date_str = 'Wednesday, May 19, 2021';
$date_str_fr = 'mercredi 13 janvier 2021';

$time_str = '13:15';
$workshop_full_time = $date_str . ' ' . $time_str;
$workshop_full_time_fr = $date_str_fr . ' ' . $time_str;

/* var_dump($workshop_full_time); */
/* var_dump($workshop_full_time_fr); */

$french_months_weeks = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');

$english_months_weeks = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');


$workshop_full_time_fr_to_en = str_replace($french_months_weeks, $english_months_weeks, strtolower($workshop_full_time_fr));
/* var_dump($workshop_full_time_fr_to_en); */


$timestamp = strtotime($workshop_full_time_fr_to_en);
/* var_dump($timestamp); */

$date = date('Y-m-d H:i:s', $timestamp);
/* print_r($date . "\n"); */


/* $weekarray = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"); */
/* print_r($weekarray[date('w', $timestamp)] . "\n"); */

$weekarray_fr = array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
/* print_r($weekarray_fr[date('w', $timestamp)] . "\n"); */


function isDate($date, $format = 'm-d-Y')
{
  try {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date ? true : false;
  } catch (Exception $e) {
    return false;
  }
}


var_dump(isDate('10-21-2021'));
var_dump(isDate('ps'));
