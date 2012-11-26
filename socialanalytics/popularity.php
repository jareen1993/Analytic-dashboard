
<?php

mysql_connect("localhost", "alpha", "csp301") or die(mysql_error());
mysql_select_db("social_net") or die(mysql_error());
$result = mysql_query("SELECT * FROM cumtable ORDER BY total ") 
or die(mysql_error()); 
$r=0; 
while($row = mysql_fetch_array( $result ))
{
	$topc[$r]=$row['topic_name'];	
	$num[$r]=$row['total'];
	$r=$r+1;
}

?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script>
var x=new Array();
x[0]=new Array();
x[0][0]="X";
x[0][1]="Y";
var obj = <?php echo json_encode($num)?>;
var topicCount=0;
for (var i=0;i< <?PHP echo $r ?> ; i++)
{
	if(obj[i]>0)
	{
		x[topicCount]=new Array();
		x[topicCount][0]=topicCount;
		x[topicCount][1]=1*obj[i];
		topicCount++;
	}
}

google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart()
{    	  
   	var data = google.visualization.arrayToDataTable(x);
	var title1= "topic";
	var title2= "activity";
   	var options = {
    	title: title1+" vs "+ title2,
       	hAxis: {title: title1, minValue: 0, maxValue: 15},
        vAxis: {title: title2, minValue: 0, maxValue: 15},
        pointSize:10,
        backgroundColor:'#FFF5EE',
        legend: 'none'
        };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}
      //google.setOnLoadCallback(drawChart);
</script>
<body style="background-color:#B0C4DE;">
<script type="text/javascript">
    
    
    </script>
     
    <div id="chart_div" style="width: 1500px; height: 800px; align:center;"></div>
  </body>
