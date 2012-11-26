<?php
echo nl2br("A motion graph showing how the topic emerges and spread over different clusters"."\n\n");
echo nl2br("Choose among the following top 10 topics of the last week"."\n\n");

// Make a MySQL Connection
mysql_connect("localhost", "alpha", "csp301") or die(mysql_error());
mysql_select_db("social_net") or die(mysql_error());



$result = mysql_query("SELECT * FROM current_week ORDER BY total desc ")
or die(mysql_error());
$count=1;
$top10list;
while($count<=10)
{

	$row = mysql_fetch_array( $result );
	$top10list[$count]= $row['topic_name'];
	$count++;
}


		?>

<form action="movie_cluster.php" method="post">

<?php for($i=1;$i<=10;$i++) : ?>  <?php echo $top10list[$i] ?>: <input type="radio" name="topic" value="<?php echo $top10list[$i] ?>" /><br/><br/><?php endfor; ?>
 <br/>


  <input type="submit" value="submit" />

</form>

