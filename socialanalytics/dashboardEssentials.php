
<?php
/**
 * To display the data
 * @param 
 * @return 
 */
function displayData()
{
mysql_connect("localhost", "alpha", "csp301") or die(mysql_error());
mysql_select_db("social_net") or die(mysql_error());
$result = mysql_query("SELECT * FROM cumtable ORDER BY total DESC") 
or die(mysql_error());
echo nl2br('Hot topics of the week'."\n\n");
for ($r=0;$r<5;$r++)
{
	$row = mysql_fetch_array( $result );
	$topc[$r]=$row['topic_name'];	
	$num[$r]=$row['total'];
	$string=$topc[$r].': '.$num[$r].' conversations';
	echo nl2br($string."\n");
}
$totalAct=0;
while($row = mysql_fetch_array( $result ))
{
	$totalAct+=$row['total'];
}
echo nl2br("\n".'Total activity in the week: '.$totalAct."\n");
}
/**
 * get display the timestamp
 * @param 
 * @return 
 */
function displaytimestamp()
{
mysql_connect("localhost", "alpha", "csp301") or die(mysql_error());
mysql_select_db("social_net") or die(mysql_error());
$result = mysql_query("SELECT * FROM variables WHERE id=4") ;
$row = mysql_fetch_array( $result );
$timestamp=$row['var_value'];	
echo($timestamp);
}

?>
