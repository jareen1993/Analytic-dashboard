<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php include 'userLocationPie.php';
include 'dashboardEssentials.php';
?>

<html><head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>Social network analytics</title>

<meta name="keywords" content="" />
<meta name="description" content="" />
</head>
<body>

<div style="text-align:right" id="logo">
	<font size="7" face="fantasy"><a href="homepage.php">Social network analytics</a></font>
</div>
<br>
<!-- end header -->
<div class="title" style="width:100%; clear:both; background:RoyalBlue; height:35px">
<h1> Cluster-based graphs </h1>
</div>
<div class="chart1" style="width:100%; background:Azure">
<iframe src="intercluster.php" width="650" height="600"></iframe>
</div>
<div class="chart2" style="width:100%; background:Azure">
<iframe src="placewise_piechart.php" width="950" height="600"></iframe>
</div>
<!-- end content -->
<!-- end page -->
<div style="font-size: 0.8em; text-align: center; margin-top: 1em; margin-bottom: 4em;">
</div>
</body></html>