
<?php


	mysql_connect("localhost", "alpha", "csp301") or die(mysql_error());
	mysql_select_db("social_net") or die(mysql_error());
	$f_week_month_day="";	
	$week_month_day="day_";
	$num=7;
	$f_week_month_day=$week_month_day.'1';
	for($r=2;$r<=$num;$r++)
	{
		$f_week_month_day=$f_week_month_day."+".$week_month_day.$r;
	}
	$temp="";
	if($week_month_day=="day_"){$temp ="cumtable";}
	if($week_month_day=="month_"){$temp ="monthtable";}
	if($week_month_day=="week_"){$temp ="week";}
	$result = mysql_query("SELECT * FROM $temp ORDER BY ($f_week_month_day) desc ") 
	or die(mysql_error());
	$count=0;	
	$top10list;
	
	while($count<=9)
	{
		
		$row = mysql_fetch_array( $result );
		$top10list[$count]= $row['topic_name'];	
		//echo $top10list[$count]."44444444444";
		$count++;
	}
		$result = mysql_query("SELECT * FROM cumtable ORDER BY ($f_week_month_day) desc ") 
		or die(mysql_error());
		$count=1;		
		
		$sarray_1[0]=0;$sarray_2[0]=0;$sarray_3[0]=0;$sarray_4[0]=0;$sarray_5[0]=0;
		$sarray_6[0]=0;$sarray_7[0]=0;$sarray_0[0]=0;
		
		while($count<=10)
		{
			$sarray_0[$count]=0;
			$row = mysql_fetch_array( $result );
			$sarray_1[$count]=$row['day_1'];
			$sarray_2[$count]=$row['day_2'];
			$sarray_3[$count]=$row['day_3'];
			$sarray_4[$count]=$row['day_4'];
			$sarray_5[$count]=$row['day_5'];
			$sarray_6[$count]=$row['day_6'];
			$sarray_7[$count]=$row['day_7'];
			$count++;			
		}
		
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
	
	var x= new Array();
	var xy= new Array();
	x[0]=new Array();
	x[0][0]=0;
	xy[0] = <?php echo json_encode($top10list)?>;
	for(var t=0;t<10;t++) x[0][t+1]=xy[0][t];
	x[1]=new Array();
	x[1] = <?php echo json_encode($sarray_1)?>;
	for(var t=0;t<=10;t++) x[1][t]=1*x[1][t];
	x[1][0]=1;
	x[2]=new Array();
	x[2] = <?php echo json_encode($sarray_2)?>;
	for(var t=0;t<=10;t++) x[2][t]=1*x[2][t];
	x[2][0]=2;
	x[3]=new Array();
	x[3] = <?php echo json_encode($sarray_3)?>;
	for(var t=0;t<=10;t++) x[3][t]=1*x[3][t];
	x[3][0]=3;
	x[4]=new Array();
	x[4] = <?php echo json_encode($sarray_4)?>;
	for(var t=0;t<=10;t++) x[4][t]=1*x[4][t];
	x[4][0]=4;
	x[5]=new Array();
	x[5] = <?php echo json_encode($sarray_5)?>;
	x[5][0]=5;
	for(var t=0;t<=10;t++) x[5][t]=1*x[5][t];
	x[6]=new Array();
	x[6] = <?php echo json_encode($sarray_6)?>;
	for(var t=0;t<=10;t++) x[6][t]=1*x[6][t];
	x[6][0]=6;
	x[7]=new Array();
	x[7] = <?php echo json_encode($sarray_7)?>;
	for(var t=0;t<=10;t++) x[7][t]=1*x[7][t];
	x[7][0]=7;
	
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(x);

        var options = {
          title: 'Top 10 topics for last 7 Days',
          hAxis: {title: 'Day',  titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>

