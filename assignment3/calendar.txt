<html>
<title>Calender</title>
<link href="css/calendar.css" rel="stylesheet" type="text/css">
<body>

<?php
date_default_timezone_set('America/New_York');
$hours_to_show = 12;
$date = $i = "";
$person = array("Michael S.", "Jenifer A.", "Kennedy S.", "Madison S.");
$firstCol = get_hour_string($date);

function get_hour_string($date) {
	// get the hours for the first column of the calendar table
	// takes a single argument of a timestamp and returns a string indicating hour
	$date= date("g:00a");
	return $date;
}

function mod_hours($data, $i) {
	$data = new DateTime($data);
	$data->modify("+$i hours");
	return $data->format("g:00a");
}

function display_rows($data){
	$string = "<td>&nbsp</td>";
	for($i=0; $i<$data+9; $i++){
		$string .= "<td>&nbsp</td>";
	}
	return $string;
}

?>

<h2><center>
	<br><?php echo "Today is " . date("m/d/Y") . " at " . date("h:i a"); ?>
</center></h2>

 <br><br><br>

<table id="event_table" border="1">
	<tr class="hr_td">
		<th>Name:</th>
		<?php for($i=0; $i<$hours_to_show+1; $i++){
			echo "<th>".mod_hours($firstCol, $i)."</th>";
		}
		?>
	</tr>
	<tr>
		<?php foreach($person as $name){
			echo "<tr><td>".$name."</td>".display_rows($firstCol)."</tr>";
		}
		?>
	</tr>
</table>

</body>
</html>