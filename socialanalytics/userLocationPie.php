
<?php



/*
 * Create Place,clusterID,Countarray 
 * @param 
 * @param Array_String created Array
 * @return
 */
function placeDistribution()
{
mysql_connect("localhost", "alpha", "csp301") or die(mysql_error());
mysql_select_db("social_net") or die(mysql_error());
$result = mysql_query("SELECT Place,ClusterID , COUNT(ClusterID) FROM cluster GROUP BY Place,ClusterID")
or die(mysql_error()); 
$r=0; 
$distPlace[$r][0]="Location";
$distPlace[$r][1]="Cluster";
$distPlace[$r][2]="number of users";
while($row = mysql_fetch_array( $result ))
{
	$r=$r+1;
	$distPlace[$r][0]=$row['Place'];
	$distPlace[$r][1]=$row['ClusterID'];
	$distPlace[$r][2]=$row['COUNT(ClusterID)'];
}
echo json_encode($distPlace);
}
?>

