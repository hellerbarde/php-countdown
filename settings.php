<?php
/* ****************************** */
/* Countdown script in PHP        */
/* settings.php                   */
/* copyright 2009 by Philip Stark */
/* ****************************** */

/* array of events */
/* Syntax:
    array("Name of event", mktime(hour, min, sec, day, month, year))
*/

$events = array(
array("Math I"                  , mktime(9 ,0,0,7,13,2009)), 
array("History"                 , mktime(9 ,0,0,7,20,2009)), 
array("Linear Algebra"          , mktime(14,0,0,8,10,2009)), 
array("International Relations" , mktime(14,0,0,8,12,2009)), 
array("Physics"                 , mktime(14,0,0,8,14,2009))
);

/* $days days, $hours hours(, $minutes minutes)$suffix */
$suffix             = " left\n";

$display_minutes    = 0;
$display_next_event = 1;
$display_event_list = 1;

?>