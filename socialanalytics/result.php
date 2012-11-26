
<?php

mysql_connect("localhost", "alpha", "csp301") or die(mysql_error());
mysql_select_db("social_net") or die(mysql_error());
	$recieveq=$_POST['ans'];
	$type1q=explode('_',$recieveq);
	$typeq=$type1q[0];
	$boundq=$type1q[1];
	$topic_nameq =  	$type1q[2];
	
/*
 * Returns ith entry
 * @param INT Entry from DB query
 * @return
 */
function return_data($i)
{	
 	 	
	$recieve=$_POST['ans'];
	$type1=explode('_',$recieve);
	$type=$type1[0];
	$bound=$type1[1];
	$topic_name =  	$type1[2];
	
	
	
	
	if($type=="day")
	{
		$result = mysql_query("SELECT * FROM cumtable
		WHERE topic_name = '$topic_name'") or die(allert());  
		$row = mysql_fetch_array($result);
		$temp="day_";
		if($i>$bound) 
		{
			$totable=0;
		}
		else
		{
			$temp="day_";
			$temp=$temp.$i;			
			$totable=$row[$temp];			
		
		}
		return $totable;		
	}
	elseif($type=="week")
	{
		$result = mysql_query("SELECT * FROM week
		WHERE topic_name = '$topic_name'") or die(mysql_error());  
		$row = mysql_fetch_array( $result );
		
		if($i>$bound) 
		{
			$totable=0;
		}
		else
		{
			$temp="week_";
			$temp=$temp.$i;			
			$totable=$row[$temp];			
		
		}
		return $totable;
	}
	elseif($type=="month")
	{
		$result = mysql_query("SELECT * FROM monthtable
		WHERE topic_name = '$topic_name'") or die(mysql_error());  
		$row = mysql_fetch_array( $result );
		if($i>$bound) 
		{
			$totable=0;
		}
		else
		{
			$temp="month_";
			$temp=$temp.$i;			
			$totable=$row[$temp];			
		
		}
		return $totable;		
	}		
}







?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
	var xy=new Array();
xy[0]=new Array();
xy[1]=new Array();
xy[2]=new Array();
xy[4]=new Array();
xy[5]=new Array();
xy[6]=new Array();
xy[7]=new Array();
xy[3]=new Array();
xy[0][0]=1;
xy[0][1]=<?PHP echo (return_data(1)) ?>;
xy[1][0]=1;
xy[1][1]=<?PHP echo (return_data(1)) ?>;
xy[2][0]=2;
xy[2][1]=<?PHP echo (return_data(2)) ?>;
xy[3][0]=3;
xy[3][1]=<?PHP echo (return_data(3)) ?>;
xy[4][0]=4;
xy[4][1]=<?PHP echo (return_data(4)) ?>;
xy[5][0]=5;
xy[5][1]=<?PHP echo (return_data(5)) ?>;
xy[6][0]=6;
xy[6][1]=<?PHP echo (return_data(6)) ?>;
xy[7][0]=7;
xy[7][1]=<?PHP echo (return_data(7)) ?>;
var t=1;
var x=new Array();
x[0]=new Array();
x[0][0]='X';
x[0][1]="<?php echo $topic_nameq; ?>";

while(t<=<?PHP echo $boundq ?>)
{
	x[t]=new Array();
	x[t][0]=xy[t][0];
	x[t][1]=xy[t][1];
	t++;
}
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(x);

        var options = {
          title: 'Topic Report',
          hAxis: {title: 'per <?php echo $typeq;?>',  titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
<body style="background-color:#B0C4DE;">
<script type="text/javascript">
    
    
    </script>
     
   <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
