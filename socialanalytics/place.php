<html>

<body>
<?php
// Make a MySQL Connection
mysql_connect("localhost", "alpha", "csp301") or die(mysql_error());
mysql_select_db("social_net") or die(mysql_error());
/**
 * To read log-graph.out.txt
 * @param
 * @return 
 */
function placing()
{
	$myFile = "log-graph.out.txt";
	$fh = fopen($myFile, 'r');
	$check=0;
	$count=0;
	while(!feof($fh))
	{
		$count++;
		ini_set('max_execution_time', 900);
		$line = fgets($fh);

		$line_parts = explode(":", $line);
		$info = explode(",", $line_parts[1]);
		$place = $info[1];
		$info = explode(" ", $info[0]);
		$nodeid=$info[2];
		$place =substr($place, 1, -2);
		//echo($place);
		$result = mysql_query("UPDATE cluster SET Place='$place' WHERE NodeID='$nodeid'") or die(mysql_error());
	}

	fclose($fh);
}

placing();

?>
</body>
</html>