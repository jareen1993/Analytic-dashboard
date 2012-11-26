<html>
<body>


<?php

mysql_connect("localhost", "alpha", "csp301") or die(mysql_error());
mysql_select_db("social_net") or die(mysql_error());
	
	
	
	//$recieve="month_3";
	$recieve1=$_POST['ans'];
	
	$f_week_month_day="";
	$recieve=explode("_", $recieve1);
	$week_month_day=$recieve[0].'_';
	$num=$recieve[1];
	$f_week_month_day=$week_month_day.'1';
	for($r=2;$r<=$num;$r++)
	{
	
		$f_week_month_day=$f_week_month_day."+".$week_month_day.$r;
		
	}
	//echo $f_week_month_day;
	$temp="";
	if($week_month_day=="day_"){$temp ="cumtable";}
	if($week_month_day=="month_"){$temp ="monthtable";}
	if($week_month_day=="week_"){$temp ="week";}
	$result = mysql_query("SELECT * FROM $temp ORDER BY ($f_week_month_day) desc ") 
	or die(mysql_error());
	$count=0;	
	
	while($count<=10)
	{
		
		$row = mysql_fetch_array( $result );
		$top10list[$count]= $row['topic_name'];	
		$count++;
	}


?>
<h3>Top 10 Topics in last <?php echo $num.' '.$recieve[0]  ?> are: </h3>
<form action="result.php" method="post">
 <?php for($i=0;$i<10;$i++) : ?>  <?php echo $top10list[$i] ?>: <input type="radio" name="ans" value="<?php echo $recieve1.'_'.$top10list[$i] ?>" /><br /><?php endfor; ?>
 <br/>
 <strong>Select checkbox and click submit to see behavior </strong><br/><br/>
 <input type="submit" value="submit" />
</form>

</body>
</html>