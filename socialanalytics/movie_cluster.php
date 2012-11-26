<html>
<head>
<?php

$topicin = $_POST["topic"];
//echo($topicin);
//echo("try");
/**
 * get data in clusterdata_week table from db
 * @param int $a
 * @param int $topicday
 * @param int $clusterid
 * @return entry in mysql db
 */
function call($a,$topicday , $clusterid)
{

// Make a MySQL Connection
mysql_connect("localhost", "alpha", "csp301") or die(mysql_error());
mysql_select_db("social_net") or die(mysql_error());

$topic = $a ."_";
$topicid = $topic . $topicday;

		$result = mysql_query("SELECT * FROM clusterdata_week
		WHERE topic_name ='$topicid' ") or die(mysql_error());
		$row = mysql_fetch_array( $result );
		$temp1=$row[$clusterid];

		//echo(temp1);
		return $temp1;
}

?>




<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    document.write("A motion graph showing how the topic emerges and spread over different clusters");

      google.load('visualization', '1', {'packages':['motionchart']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

	var a = "Thu";
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'CLUSTER');
        data.addColumn('date', 'Day');
        data.addColumn('number', 'Communication activity');
        data.addColumn('number', 'Nothing');
        data.addRows([
          ['Cluster1',  new Date (1989,0,1), 0, 100],
          ['Cluster2',  new Date (1989,0,1), 0, 200],
          ['Cluster3',  new Date (1989,0,1), 0, 300],
          ['Cluster4',  new Date (1989,0,1), 0, 400],
          ['Cluster5',  new Date (1989,0,1), 0, 500],
          ['Cluster6',  new Date (1989,0,1), 0, 600],
          ['Cluster7',  new Date (1989,0,1), 0, 700],
          ['Cluster8',  new Date (1989,0,1), 0, 800],


          ['Cluster1',  new Date (1990,0,1), <?PHP 	echo call($topicin,"Thu",'Cluster_0') ?>, 100],
          ['Cluster2',  new Date (1990,0,1), <?PHP 	echo call($topicin,"Thu",'Cluster_1') ?>, 200],
          ['Cluster3',  new Date (1990,0,1), <?PHP 	echo call($topicin,"Thu",'Cluster_2') ?>, 300],
          ['Cluster4',  new Date (1990,0,1), <?PHP 	echo call($topicin,"Thu",'Cluster_3') ?>, 400],
          ['Cluster5',  new Date (1990,0,1), <?PHP 	echo call($topicin,"Thu",'Cluster_4') ?>, 500],
          ['Cluster6',  new Date (1990,0,1), <?PHP 	echo call($topicin,"Thu",'Cluster_5') ?>, 600],
          ['Cluster7',  new Date (1990,0,1), <?PHP 	echo call($topicin,"Thu",'Cluster_6') ?>, 700],
          ['Cluster8',  new Date (1990,0,1), <?PHP 	echo call($topicin,"Thu",'Cluster_7') ?>, 800],

          ['Cluster1',  new Date (1991,0,1), <?PHP echo call($topicin,"Fri",'Cluster_0') ?>, 100],
          ['Cluster2',  new Date (1991,0,1), <?PHP echo call($topicin,"Fri",'Cluster_1') ?>, 200],
          ['Cluster3',  new Date (1991,0,1), <?PHP echo call($topicin,"Fri",'Cluster_2') ?>, 300],
          ['Cluster4',  new Date (1991,0,1), <?PHP echo call($topicin,"Fri",'Cluster_3') ?>, 400],
          ['Cluster5',  new Date (1991,0,1), <?PHP echo call($topicin,"Fri",'Cluster_4') ?>, 500],
          ['Cluster6',  new Date (1991,0,1), <?PHP echo call($topicin,"Fri",'Cluster_5') ?>, 600],
          ['Cluster7',  new Date (1991,0,1), <?PHP echo call($topicin,"Fri",'Cluster_6') ?>, 700],
          ['Cluster8',  new Date (1991,0,1), <?PHP echo call($topicin,"Fri",'Cluster_7') ?>, 800],

          ['Cluster1',  new Date (1992,0,1), <?PHP echo call($topicin,"Sat",'Cluster_0') ?>, 100],
          ['Cluster2',  new Date (1992,0,1), <?PHP echo call($topicin,"Sat",'Cluster_1') ?>, 200],
          ['Cluster3',  new Date (1992,0,1), <?PHP echo call($topicin,"Sat",'Cluster_2') ?>, 300],
          ['Cluster4',  new Date (1992,0,1), <?PHP echo call($topicin,"Sat",'Cluster_3') ?>, 400],
          ['Cluster5',  new Date (1992,0,1), <?PHP echo call($topicin,"Sat",'Cluster_4') ?>, 500],
          ['Cluster6',  new Date (1992,0,1), <?PHP echo call($topicin,"Sat",'Cluster_5') ?>, 600],
          ['Cluster7',  new Date (1992,0,1), <?PHP echo call($topicin,"Sat",'Cluster_6') ?>, 700],
          ['Cluster8',  new Date (1992,0,1), <?PHP echo call($topicin,"Sat",'Cluster_7') ?>, 800],

          ['Cluster1',  new Date (1993,0,1), <?PHP echo call($topicin,"Sun",'Cluster_0') ?>, 100],
          ['Cluster2',  new Date (1993,0,1), <?PHP echo call($topicin,"Sun",'Cluster_1') ?>, 200],
          ['Cluster3',  new Date (1993,0,1), <?PHP echo call($topicin,"Sun",'Cluster_2') ?>, 300],
          ['Cluster4',  new Date (1993,0,1), <?PHP echo call($topicin,"Sun",'Cluster_3') ?>, 400],
          ['Cluster5',  new Date (1993,0,1), <?PHP echo call($topicin,"Sun",'Cluster_4') ?>, 500],
          ['Cluster6',  new Date (1993,0,1), <?PHP echo call($topicin,"Sun",'Cluster_5') ?>, 600],
          ['Cluster7',  new Date (1993,0,1), <?PHP echo call($topicin,"Sun",'Cluster_6') ?>, 700],
          ['Cluster8',  new Date (1993,0,1), <?PHP echo call($topicin,"Sun",'Cluster_7') ?>, 800],

          ['Cluster1',  new Date (1994,0,1), <?PHP echo call($topicin,"Mon",'Cluster_0') ?>, 100],
          ['Cluster2',  new Date (1994,0,1), <?PHP echo call($topicin,"Mon",'Cluster_1') ?>, 200],
          ['Cluster3',  new Date (1994,0,1), <?PHP echo call($topicin,"Mon",'Cluster_2') ?>, 300],
          ['Cluster4',  new Date (1994,0,1), <?PHP echo call($topicin,"Mon",'Cluster_3') ?>, 400],
          ['Cluster5',  new Date (1994,0,1), <?PHP echo call($topicin,"Mon",'Cluster_4') ?>, 500],
          ['Cluster6',  new Date (1994,0,1), <?PHP echo call($topicin,"Mon",'Cluster_5') ?>, 600],
          ['Cluster7',  new Date (1994,0,1), <?PHP echo call($topicin,"Mon",'Cluster_6') ?>, 700],
          ['Cluster8',  new Date (1994,0,1), <?PHP echo call($topicin,"Mon",'Cluster_7') ?>, 800],

          ['Cluster1',  new Date (1995,0,1), <?PHP echo call($topicin,"Tue",'Cluster_0') ?>, 100],
          ['Cluster2',  new Date (1995,0,1), <?PHP echo call($topicin,"Tue",'Cluster_1') ?>, 200],
          ['Cluster3',  new Date (1995,0,1), <?PHP echo call($topicin,"Tue",'Cluster_2') ?>, 300],
          ['Cluster4',  new Date (1995,0,1), <?PHP echo call($topicin,"Tue",'Cluster_3') ?>, 400],
          ['Cluster5',  new Date (1995,0,1), <?PHP echo call($topicin,"Tue",'Cluster_4') ?>, 500],
          ['Cluster6',  new Date (1995,0,1), <?PHP echo call($topicin,"Tue",'Cluster_5') ?>, 600],
          ['Cluster7',  new Date (1995,0,1), <?PHP echo call($topicin,"Tue",'Cluster_6') ?>, 700],
          ['Cluster8',  new Date (1995,0,1), <?PHP echo call($topicin,"Tue",'Cluster_7') ?>, 800],

          ['Cluster1',  new Date (1996,0,1), <?PHP echo call($topicin,"Wed","Cluster_1") ?>, 100],
          ['Cluster2',  new Date (1996,0,1), <?PHP echo call($topicin,"Wed","Cluster_1") ?>, 200],
          ['Cluster3',  new Date (1996,0,1), <?PHP echo call($topicin,"Wed","Cluster_2") ?>, 300],
          ['Cluster4',  new Date (1996,0,1), <?PHP echo call($topicin,"Wed","Cluster_3") ?>, 400],
          ['Cluster5',  new Date (1996,0,1), <?PHP echo call($topicin,"Wed","Cluster_4") ?>, 500],
          ['Cluster6',  new Date (1996,0,1), <?PHP echo call($topicin,"Wed","Cluster_5") ?>, 600],
          ['Cluster7',  new Date (1996,0,1), <?PHP echo call($topicin,"Wed","Cluster_6") ?>, 700],
          ['Cluster8',  new Date (1996,0,1), <?PHP echo call($topicin,"Wed","Cluster_7") ?>, 800],


        ]);
        var chart = new google.visualization.MotionChart(document.getElementById('chart_div'));
        chart.draw(data, {width: 900, height:600});
      }
    </script>

</head>
<body>
<div id="chart_div" style="width: 600px; height: 300px;"></div>
</body>
</html>