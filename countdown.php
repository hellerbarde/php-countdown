<?php
/* ****************************** */
/* Countdown script in PHP        */
/* countdown.php                  */
/* copyright 2009 by Philip Stark */
/* ****************************** */

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
echo $suffix."</div>\n";

/* display the next upcoming event */
if ($display_next_event == 1){
	echo "<div class=\"next_event_wrapper\">\n";
	echo "<div class=\"next_event_header\">next up:</div>".
	"<div class=\"next_event\">".
	$nextevent[0].
	"</div>"."\n";
	echo "</div>\n";
}
    
/* display the list of events
   upcoming events in red (as in omg exams still to go)
   past events in green   (as in omg exams already done) 
   next upcoming event in blue (omg it's teh next one!!) */
   
if ($display_event_list == 1){
	echo "<div class=\"event_list_wrapper\">\n\t<ul class=\"event_list\">\n";
	$i = 0;
	foreach ($events as $event) {
		if ($i == $nexteventindex){
			/* next upcoming event */
			echo "\t\t<li class=\"next_event\">".
			"<img src=\"next-event.png\"/>".
			$event[0].
			" <span class=\"event_date\">".
			date("D, d. F - H:i", $event[1]).
			"</span></li>\n";
			$before = 0;
		}
		else{
			if ($before == 1){
				/* old events */
				echo "\t\t<li class=\"old_event\">".
				"<img src=\"old-event.png\"/>".
				$event[0].
				" <span class=\"event_date\">".
				date("D, d. F - H:i", $event[1]).
				"</span></li>\n";
			}
			else{
				/* upcoming events */
				echo "\t\t<li class=\"event_to_come\">".
				"<img src=\"upcoming-event.png\"/>".
				$event[0].
				" <span class=\"event_date\">".
				date("D, d. F - H:i", $event[1]).
				"</span></li>\n";
			}
		}
		$i++;
	}
	echo "\t</ul>\n</div>\n";
}
?>