<html>
<head>
</head>
<body>
<?php
// Make a MySQL Connection
mysql_connect("localhost", "alpha", "csp301") or die(mysql_error());
mysql_select_db("social_net") or die(mysql_error());

$result= mysql_query("SELECT Place,ClusterID,COUNT(1) NoOfNodes
FROM
    cluster
GROUP BY
    Place,ClusterID") or die(mysql_error());

$ii=0;$prevplace="Default";
	while($row = mysql_fetch_array($result))
	{
		$place=$row['Place']; $nodeid = $row['ClusterID']; $no=$row['NoOfNodes'];
		$info[$ii][0] =$place;
		$info[$ii][1] =$nodeid;
		$info[$ii][2] =$no;
		$ii++;$prevplace=$place;
	}

	echo("PLACE"."--"."CLUSTER"."--"."No. of such Nodes")."<br/>"."<br/>";
	for($i=0;$i<$ii;$i++)
	{
	echo($info[$i][0]."--".$info[$i][1]."--".$info[$i][2])."<br/>";
	}





?>
</body>
</html>