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
////////
	mysql_query("ALTER TABLE cumtable ADD trending FLOAT AFTER day_7");
$result = mysql_query("SELECT * FROM cumtable") or die(mysql_error()); 
while($row = mysql_fetch_array($result))	
{
$type = "day_";
$i = 1;
$aggregate =0;
$max = $row["day_1"];
	
	$j = 2;
	while($j<8)
	{
		if($max<$row[$type.$j])
		{
		//echo $max;
		$max = $row[$type.$j];
		$type = "day_";
		}
		$j++;
	}
	
	while($i<8)
	{
		$aggregate = ($aggregate*0.25) + ((($row[$type.$i])/($max+1))*0.75);
		$i = $i+1;
		$type = "day_";
	}

$sd = $row["id"];
$result1 = mysql_query("UPDATE cumtable SET trending='$aggregate' WHERE id = '$sd'");
}
$result = mysql_query("SELECT * FROM cumtable ORDER BY trending DESC ") 
	or die(mysql_error());
	
	
	///////////////////
	$count=0;	
	$top10list;
	while($count<=9)
	{
		
		$row = mysql_fetch_array( $result );
		$top10list[$count]= $row['topic_name'];	
		
		$count++;
	}
		$result = mysql_query("SELECT * FROM cumtable ORDER BY trending desc ") 
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
		mysql_query("ALTER TABLE current_week DROP trending");
?>



<script type='text/javascript' src='https://www.google.com/jsapi'></script>
 <script type='text/javascript'>

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
	
	var xxz = new Array();
	for (var t=0;t<=7;t++)
	{
		xxz[t]=new Array();
		xxz[t][0]=t;
	}
	
	xxz[0][1]=<?php echo $sarray_0[1] ?>;	
	xxz[1][1]=<?php echo $sarray_1[1] ?>;	
	xxz[2][1]=<?php echo $sarray_2[1] ?>;	
	xxz[3][1]=<?php echo $sarray_3[1] ?>;	
	xxz[4][1]=<?php echo $sarray_4[1] ?>;	
	xxz[5][1]=<?php echo $sarray_5[1] ?>;	
	xxz[6][1]=<?php echo $sarray_6[1] ?>;	
	xxz[7][1]=<?php echo $sarray_7[1] ?>;
	
	
	var xxz1 = new Array();
	for (var t=0;t<=7;t++)
	{
		xxz1[t]=new Array();
		xxz1[t][0]=t;
	}
	xxz1[0][1]=<?php echo $sarray_0[2] ?>;	
	xxz1[1][1]=<?php echo $sarray_1[2] ?>;	
	xxz1[2][1]=<?php echo $sarray_2[2] ?>;	
	xxz1[3][1]=<?php echo $sarray_3[2] ?>;	
	xxz1[4][1]=<?php echo $sarray_4[2] ?>;	
	xxz1[5][1]=<?php echo $sarray_5[2] ?>;	
	xxz1[6][1]=<?php echo $sarray_6[2] ?>;	
	xxz1[7][1]=<?php echo $sarray_7[2] ?>;	
	
	
	
	var xxz2 = new Array();
	for (var t=0;t<=7;t++)
	{
		xxz2[t]=new Array();
		xxz2[t][0]=t;
	}
	
	xxz2[0][1]=<?php echo $sarray_0[3] ?>;	
	xxz2[1][1]=<?php echo $sarray_1[3] ?>;	
	xxz2[2][1]=<?php echo $sarray_2[3] ?>;	
	xxz2[3][1]=<?php echo $sarray_3[3] ?>;	
	xxz2[4][1]=<?php echo $sarray_4[3] ?>;	
	xxz2[5][1]=<?php echo $sarray_5[3] ?>;	
	xxz2[6][1]=<?php echo $sarray_6[3] ?>;	
	xxz2[7][1]=<?php echo $sarray_7[3] ?>;
	

	
	var xxz3 = new Array();
	for (var t=0;t<=7;t++)
	{
		xxz3[t]=new Array();
		xxz3[t][0]=t;
	}
	xxz3[0][1]=<?php echo $sarray_0[4] ?>;	
	xxz3[1][1]=<?php echo $sarray_1[4] ?>;	
	xxz3[2][1]=<?php echo $sarray_2[4] ?>;	
	xxz3[3][1]=<?php echo $sarray_3[4] ?>;	
	xxz3[4][1]=<?php echo $sarray_4[4] ?>;	
	xxz3[5][1]=<?php echo $sarray_5[4] ?>;	
	xxz3[6][1]=<?php echo $sarray_6[4] ?>;	
	xxz3[7][1]=<?php echo $sarray_7[4] ?>;
	
	var xxz4 = new Array();
	for (var t=0;t<=7;t++)
	{
		xxz4[t]=new Array();
		xxz4[t][0]=t;
	}
	xxz4[0][1]=<?php echo $sarray_0[5] ?>;	
	xxz4[1][1]=<?php echo $sarray_1[5] ?>;	
	xxz4[2][1]=<?php echo $sarray_2[5] ?>;	
	xxz4[3][1]=<?php echo $sarray_3[5] ?>;	
	xxz4[4][1]=<?php echo $sarray_4[5] ?>;	
	xxz4[5][1]=<?php echo $sarray_5[5] ?>;	
	xxz4[6][1]=<?php echo $sarray_6[5] ?>;	
	xxz4[7][1]=<?php echo $sarray_7[5] ?>;

	
		var xxz5 = new Array();
	for (var t=0;t<=7;t++)
	{
		xxz5[t]=new Array();
		xxz[t][0]=t;
	}
	xxz5[0][1]=<?php echo $sarray_0[6] ?>;	
	xxz5[1][1]=<?php echo $sarray_1[6] ?>;	
	xxz5[2][1]=<?php echo $sarray_2[6] ?>;	
	xxz5[3][1]=<?php echo $sarray_3[6] ?>;	
	xxz5[4][1]=<?php echo $sarray_4[6] ?>;	
	xxz5[5][1]=<?php echo $sarray_5[6] ?>;	
	xxz5[6][1]=<?php echo $sarray_6[6] ?>;	
	xxz5[7][1]=<?php echo $sarray_7[6] ?>;
	
	
		var xxz6 = new Array();
	for (var t=0;t<=7;t++)
	{
		xxz6[t]=new Array();
		xxz6[t][0]=t;
	}
	xxz6[0][1]=<?php echo $sarray_0[7] ?>;	
	xxz6[1][1]=<?php echo $sarray_1[7] ?>;	
	xxz6[2][1]=<?php echo $sarray_2[7] ?>;	
	xxz6[3][1]=<?php echo $sarray_3[7] ?>;	
	xxz6[4][1]=<?php echo $sarray_4[7] ?>;	
	xxz6[5][1]=<?php echo $sarray_5[7] ?>;	
	xxz6[6][1]=<?php echo $sarray_6[7] ?>;	
	xxz6[7][1]=<?php echo $sarray_7[7] ?>;
	
		var xxz7 = new Array();
	for (var t=0;t<=7;t++)
	{
		xxz7[t]=new Array();
		xxz7[t][0]=t;
	}
	xxz7[0][1]=<?php echo $sarray_0[8] ?>;	
	xxz7[1][1]=<?php echo $sarray_1[8]?>;	
	xxz7[2][1]=<?php echo $sarray_2[8] ?>;	
	xxz7[3][1]=<?php echo $sarray_3[8] ?>;	
	xxz7[4][1]=<?php echo $sarray_4[8] ?>;	
	xxz7[5][1]=<?php echo $sarray_5[8] ?>;	
	xxz7[6][1]=<?php echo $sarray_6[8] ?>;	
	xxz7[7][1]=<?php echo $sarray_7[8] ?>;
	var xxz8 = new Array();
	for (var t=0;t<=7;t++)
	{
		xxz8[t]=new Array();
		xxz8[t][0]=t;
	}
	xxz8[0][1]=<?php echo $sarray_0[9] ?>;	
	xxz8[1][1]=<?php echo $sarray_1[9] ?>;	
	xxz8[2][1]=<?php echo $sarray_2[9] ?>;	
	xxz8[3][1]=<?php echo $sarray_3[9] ?>;	
	xxz8[4][1]=<?php echo $sarray_4[9] ?>;
	xxz8[5][1]=<?php echo $sarray_5[9] ?>;
	xxz8[6][1]=<?php echo $sarray_6[9] ?>;
	xxz8[7][1]=<?php echo $sarray_7[9] ?>;
	
google.load('visualization', '1', {'packages': ['geomap', 'geochart']});
google.setOnLoadCallback(drawVisualization);
var charts = new Array();
var currentSlide = -1;
var changeTime = 5000;
var drawChainId;

function drawVisualization() {


var data1 = google.visualization.arrayToDataTable(x);
var data2 = google.visualization.arrayToDataTable(xxz);
var data3= google.visualization.arrayToDataTable(xxz1);
var data4 = google.visualization.arrayToDataTable(xxz2);
var data5=google.visualization.arrayToDataTable(xxz3);
var data6 = google.visualization.arrayToDataTable(xxz4);
var data7= google.visualization.arrayToDataTable(xxz5);
var data8 = google.visualization.arrayToDataTable(xxz6);
var data9 = google.visualization.arrayToDataTable(xxz7);
var data10 = google.visualization.arrayToDataTable(xxz8);

charts[0] = new google.visualization.ChartWrapper({
        chartType: 'AreaChart',
        dataTable: data1,
        options: {     
        	title:'Trending Topic',
            showLegend: true,
            width: 800,
            height: 400,
            
        },
        containerId: 'visualization'
    });



charts[1] = new google.visualization.ChartWrapper({
        chartType: 'AreaChart',
        dataTable: data2,
        options: {     
        	title:'Trending Topic: <?php echo $top10list[0];?>',
            showLegend: true,
            width: 800,
            height: 400,
            
        },
        containerId: 'visualization'
    });



charts[2] = new google.visualization.ChartWrapper({
        chartType: 'AreaChart',
        dataTable: data3,
        options: {     
        	title:'Trending Topic: <?php echo $top10list[1];?>',
            showLegend: true,
            width: 800,
            height: 400,
            
        },
        containerId: 'visualization'
    });

charts[3] = new google.visualization.ChartWrapper({
        chartType: 'AreaChart',
        dataTable: data4,
        options: {     
        	title:'Trending Topic: <?php echo $top10list[2];?>',
            showLegend: true,
            width: 800,
            height: 400,
            
        },
        containerId: 'visualization'
    });

charts[4] = new google.visualization.ChartWrapper({
        chartType: 'AreaChart',
        dataTable: data5,
        options: {     
        	title:'Trending Topic: <?php echo $top10list[3];?>',
            showLegend: true,
            width: 800,
            height: 400,
            
        },
        containerId: 'visualization'
    });

charts[5] = new google.visualization.ChartWrapper({
        chartType: 'AreaChart',
        dataTable: data6,
        options: {     
        	title:'Trending Topic: <?php echo $top10list[4];?>',
            showLegend: true,
            width: 800,
            height: 400,
            
        },
        containerId: 'visualization'
    });

charts[6] = new google.visualization.ChartWrapper({
        chartType: 'AreaChart',
        dataTable: data7,
        options: {     
        	title:'Trending Topic: <?php echo $top10list[5];?>',
            showLegend: true,
            width: 800,
            height: 400,
            
        },
        containerId: 'visualization'
    });

charts[7] = new google.visualization.ChartWrapper({
        chartType: 'AreaChart',
        dataTable: data8,
        options: {     
        	title:'Trending Topic: <?php echo $top10list[6];?>',
            showLegend: true,
            width: 800,
            height: 400,
            
        },
        containerId: 'visualization'
    });

charts[8] = new google.visualization.ChartWrapper({
        chartType: 'AreaChart',
        dataTable: data9,
        options: {     
        	title:'Trending Topic: <?php echo $top10list[7];?>',
            showLegend: true,
            width: 800,
            height: 400,
            
        },
        containerId: 'visualization'
    });



charts[9] = new google.visualization.ChartWrapper({
        chartType: 'AreaChart',
        dataTable: data10,
        options: {     
        	title:'Trending Topic: <?php echo $top10list[8];?>',
            showLegend: true,
            width: 800,
            height: 400,
            
        },
        containerId: 'visualization'
    });

drawNext(true);	
	
	
	

}




function drawNext(newChain) {
    // if this is a new chain, cancel the old chain
    if(newChain && drawChainId != null) {
        clearTimeout(drawChainId);
    }
    
    //Check the current slide is less then total length of the array
    //if yes then increament the currentslide.
    if (currentSlide < (charts.length - 1)) {
        currentSlide++;
    }
    //set current slide = 0 otherwise
    else {
        currentSlide = 0;
    }
    //Draw the slide
    charts[currentSlide].draw();
    //Set timeout to change outmetically
    drawChainId = setTimeout("drawNext(false)", changeTime);
}

//Draws the previous slide of the geoChart
function drawPrevious(newChain) {
    // if this is a new chain, cancel the old chain
    if(newChain && drawChainId != null) {
        clearTimeout(drawChainId);
    }
    
    //Check if the current slide is greater than zero
    //If yes then decreament the currentSlide
    if (currentSlide > 0) {
        currentSlide--;
    }
    //otherwise set it to the maximum
    else {
        currentSlide = (charts.length - 1);
    }
    //Draw the slide
    charts[currentSlide].draw();
    //Set timeout to change outmetically
    drawChainId = setTimeout("drawNext(false)", changeTime);
}
</script>

<table align="left" width="600">
    <tr>
        <td align="right" WIDTH="10%"><input type="button" onclick="javascript: drawPrevious(true)" height="29px" width="33px">Previous</td>
        <td align="center" WIDTH="80%">
            <div id='visualization'></div>
        </td>
        <td align="left" WIDTH="10%"><input type="button" onclick="javascript: drawNext(true)" height="29px" width="33px">Next</td>
    </tr>
</table>