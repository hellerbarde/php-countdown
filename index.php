<?php
/* ****************************** */
/* Countdown script in PHP        */
/* Settings                       */
/* Copyright 2009 by Philip Stark */
/* ****************************** */


/******************/
/*                */
/*    Settings    */
/*                */
/******************/

/* Array of events */
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
$suffix             = " left";

$display_minutes    = 0;
$display_next_event = 1;
$display_event_list = 1;


/*******************/
/*                 */
/*    Main Part    */
/*                 */
/*******************/
function main($events, $suffix, $display_minutes, 
              $display_next_event, $display_event_list) {
	echo "<div class=\"countdown\">";
	$nexteventindex = 0;
	$i = 0;
	/* *** find the next upcoming event *** */
	foreach ($events as $event) {
		if (mktime() < $event[1]){
			$nexteventindex = $i;
			break;
		}
		$i=$i+1;
	}
	$nextevent = $events[$nexteventindex];

	/* calculate the remaining weeks */
	$delta_t = $nextevent[1]-mktime();
	$weeks   = floor($delta_t/(7*24*60*60));
	if ($weeks != 0){
			echo $weeks." week";
		if ($weeks > 1)
			echo "s";
	}

	/* calculate the remaining days */
	$delta_t = $delta_t - $weeks*7*24*60*60;
	$days    = floor($delta_t/(24*60*60));
	if ($days != 0){
		if ($weeks == 0)
			echo $days." day";
		else
			echo ", ".$days." day";
		if ($days > 1)
			echo "s";
	}
	
	/* calculate the remaining hours */
	$delta_t = $delta_t - $days*24*60*60;
	$hours   = floor($delta_t/(60*60));
	if ($hours != 0){
		if (($days == 0) && ($weeks == 0))
			echo $hours." hour";
		else
			echo ", ".$hours." hour";
		if ($hours > 1)
			echo "s";
	}


	/* set the $minutes variables to 1 to include minutes */
	if ($display_minutes == 1){
		/* calculate the remaining minutes */
		$delta_t = $delta_t - $hours*60*60;
		$minutes   = floor($delta_t/60);
		if ($minutes != 0){
			if (($days == 0) && ($weeks == 0) && ($hours == 0))
				echo $minutes." minute";
			else
				echo ", ".$minutes." minute";
			if ($minutes > 1)
				echo "s";
		}
		if (($weeks == 0) && ($days == 0) && ($hours == 0) && ($minutes == 0))
			echo "less than one minute";
	}
	else{
		/* fallback if no minutes are to be displayed and no hour left */
		if (($weeks == 0) && ($days == 0) && ($hours == 0))
			echo "less than one hour";
	}
	$before = 1;
	echo $suffix."\n</div>\n";

	/* display the next upcoming event */
	if ($display_next_event == 1){
		echo "<div class=\"next_event_wrapper\">\n".
		"<div class=\"next_event_header\">next up:</div>\n".
		"<div class=\"next_event\">".
		$nextevent[0].
		"</div>"."\n".
		"</div>\n";
	}
		
	/* display the list of events
	   upcoming events in red (as in omg exams still to go)
	   past events in green   (as in omg exams already done) 
	   next upcoming event in blue (omg it's teh next one!!) */
	   
	if ($display_event_list == 1){
		echo "<div class=\"event_list_wrapper\">\n";
		$i = 0;
		foreach ($events as $event) {
			if ($i == $nexteventindex){
				/* next upcoming event */
				echo "\t\t<div class=\"next_event_list\">".
				" <span class=\"event_status\">".
				"<img src=\"next-event.png\"/>".
				"</span>".
				"<span class=\"event_name\">".
				$event[0].
				"</span>".
				"<span class=\"event_date\">".
				date("D, d. F - H:i", $event[1]).
				"</span></div></br>\n";
				$before = 0;
			}
			else{
				if ($before == 1){
					/* old events */
					echo "\t\t<div class=\"old_event\">".
					" <span class=\"event_status\">".
					"<img src=\"old-event.png\"/>".
					"</span>".
					"<span class=\"event_name\">".
					$event[0].
					"</span>".
					"<span class=\"event_date\">".
					date("D, d. F - H:i", $event[1]).
					"</span></div></br>\n";
				}
				else{
					/* upcoming events */
					echo "\t\t<div class=\"event_to_come\">".
					" <span class=\"event_status\">".
					"<img src=\"upcoming-event.png\"/>".
					"</span>".
					"<span class=\"event_name\">".
					$event[0].
					"</span>".
					"<span class=\"event_date\">".
					date("D, d. F - H:i", $event[1]).
					"</span></div></br>\n";
				}
			}
			$i++;
		}
		echo "</div>\n";
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Countdown</title>
<meta name="author" content="Philip Stark" />
<link rel="stylesheet" type="text/css" media="screen" href="style.css" />
</head>
<body>
<?php
main($events, $suffix, $display_minutes, 
     $display_next_event, $display_event_list)
?>
<div class="copyright">copyright 2009 Phil</div>
</body>
</html>
