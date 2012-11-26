<html xmlns="http://www.w3.org/1999/xhtml">
  <head>

<?php
/**
 * get data from form clustermatrix
 * @param INT cluster Number
 * @param INT cluster number
 * @return String cluster entry
 */
function call($a,$b)
{

// Make a MySQL Connection
mysql_connect("localhost", "alpha", "csp301") or die(mysql_error());
mysql_select_db("social_net") or die(mysql_error());

$aa=$a-1;
$bb=$b-1;

$x ="Cluster_".$aa;
$y ="Cluster_".$bb;

$temp1=0;
if($aa==$bb)
{		$result = mysql_query("SELECT * FROM clustermatrix
		WHERE cluster LIKE '%$x%' ") or die(mysql_error());
		$row = mysql_fetch_array( $result );
		$temp1=$row[$y];
}

else
{
		$result = mysql_query("SELECT * FROM clustermatrix
		WHERE cluster LIKE '%$x%' ") or die(mysql_error());
		$row = mysql_fetch_array( $result );
		$temp1=$row[$y];

		$result = mysql_query("SELECT * FROM clustermatrix
		WHERE cluster LIKE '%$y%' ") or die(mysql_error());
		$row = mysql_fetch_array( $result );
		$temp1= $temp1+ $row[$x];

}

		//echo(temp1);
		return $temp1;
}

?>

    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
          // Create and populate the data table.
          var data = google.visualization.arrayToDataTable([


            ['ClusterID','Cluster No.' ,'Cluster No.', 'Info'  , 'Communication Activity'],
            ['',1,1,' Cluster Communication' , <?PHP 	echo call(1,1) ?>],
            ['',1,2,' Cluster Communication' ,  <?PHP 	echo call(1,2) ?>],
            ['',1,3,' Cluster Communication' ,  <?PHP 	echo call(1,3) ?>],
            ['',1,4,' Cluster Communication' ,  <?PHP 	echo call(1,4) ?>],
            ['',1,5,' Cluster Communication' ,  <?PHP 	echo call(1,5) ?>],
            ['',1,6,' Cluster Communication' ,  <?PHP	echo call(1,6) ?>],
            ['',1,7,' Cluster Communication' ,  <?PHP 	echo call(1,7) ?>],
            ['',1,8,' Cluster Communication' ,  <?PHP 	echo call(1,8) ?>],

            ['',2,1,' Cluster Communication' , <?PHP 	echo call(2,1) ?>],
            ['',2,2,' Cluster Communication' ,  <?PHP 	echo call(2,2) ?>],
            ['',2,3,' Cluster Communication' ,  <?PHP 	echo call(2,3) ?>],
            ['',2,4,' Cluster Communication' ,  <?PHP 	echo call(2,4) ?>],
            ['',2,5,' Cluster Communication' ,  <?PHP 	echo call(2,5) ?>],
            ['',2,6,' Cluster Communication' ,  <?PHP	echo call(2,6) ?>],
            ['',2,7,' Cluster Communication' ,  <?PHP 	echo call(2,7) ?>],
            ['',2,8,' Cluster Communication' ,  <?PHP 	echo call(2,8) ?>],

            ['',3,1,' Cluster Communication' , <?PHP 	echo call(3,1) ?>],
            ['',3,2,' Cluster Communication' ,  <?PHP 	echo call(3,2) ?>],
            ['',3,3,' Cluster Communication' ,  <?PHP 	echo call(3,3) ?>],
            ['',3,4,' Cluster Communication' ,  <?PHP 	echo call(3,4) ?>],
            ['',3,5,' Cluster Communication' ,  <?PHP 	echo call(3,5) ?>],
            ['',3,6,' Cluster Communication' ,  <?PHP	echo call(3,6) ?>],
            ['',3,7,' Cluster Communication' ,  <?PHP 	echo call(3,7) ?>],
            ['',3,8,' Cluster Communication' ,  <?PHP 	echo call(3,8) ?>],

            ['',4,1,' Cluster Communication' , <?PHP 	echo call(4,1) ?>],
            ['',4,2,' Cluster Communication' ,  <?PHP 	echo call(4,2) ?>],
            ['',4,3,' Cluster Communication' ,  <?PHP 	echo call(4,3) ?>],
            ['',4,4,' Cluster Communication' ,  <?PHP 	echo call(4,4) ?>],
            ['',4,5,' Cluster Communication' ,  <?PHP 	echo call(4,5) ?>],
            ['',4,6,' Cluster Communication' ,  <?PHP	echo call(4,6) ?>],
            ['',4,7,' Cluster Communication' ,  <?PHP 	echo call(4,7) ?>],
            ['',4,8,' Cluster Communication' ,  <?PHP 	echo call(4,8) ?>],

            ['',5,1,' Cluster Communication' , <?PHP 	echo call(5,1) ?>],
            ['',5,2,' Cluster Communication' ,  <?PHP 	echo call(5,2) ?>],
            ['',5,3,' Cluster Communication' ,  <?PHP 	echo call(5,3) ?>],
            ['',5,4,' Cluster Communication' ,  <?PHP 	echo call(5,4) ?>],
            ['',5,5,' Cluster Communication' ,  <?PHP 	echo call(5,5) ?>],
            ['',5,6,' Cluster Communication' ,  <?PHP	echo call(5,6) ?>],
            ['',5,7,' Cluster Communication' ,  <?PHP 	echo call(5,7) ?>],
            ['',5,8,' Cluster Communication' ,  <?PHP 	echo call(5,8) ?>],

            ['',6,1,' Cluster Communication' , <?PHP 	echo call(6,1) ?>],
            ['',6,2,' Cluster Communication' ,  <?PHP 	echo call(6,2) ?>],
            ['',6,3,' Cluster Communication' ,  <?PHP 	echo call(6,3) ?>],
            ['',6,4,' Cluster Communication' ,  <?PHP 	echo call(6,4) ?>],
            ['',6,5,' Cluster Communication' ,  <?PHP 	echo call(6,5) ?>],
            ['',6,6,' Cluster Communication' ,  <?PHP	echo call(6,6) ?>],
            ['',6,7,' Cluster Communication' ,  <?PHP 	echo call(6,7) ?>],
            ['',6,8,' Cluster Communication' ,  <?PHP 	echo call(6,8) ?>],

            ['',7,1,' Cluster Communication' , <?PHP 	echo call(7,1) ?>],
            ['',7,2,' Cluster Communication' ,  <?PHP 	echo call(7,2) ?>],
            ['',7,3,' Cluster Communication' ,  <?PHP 	echo call(7,3) ?>],
            ['',7,4,' Cluster Communication' ,  <?PHP 	echo call(7,4) ?>],
            ['',7,5,' Cluster Communication' ,  <?PHP 	echo call(7,5) ?>],
            ['',7,6,' Cluster Communication' ,  <?PHP	echo call(7,6) ?>],
            ['',7,7,' Cluster Communication' ,  <?PHP 	echo call(7,7) ?>],
            ['',7,8,' Cluster Communication' ,  <?PHP 	echo call(7,8) ?>],

            ['',8,1,' Cluster Communication' , <?PHP 	echo call(8,1) ?>],
            ['',8,2,' Cluster Communication' ,  <?PHP 	echo call(8,2) ?>],
            ['',8,3,' Cluster Communication' ,  <?PHP 	echo call(8,3) ?>],
            ['',8,4,' Cluster Communication' ,  <?PHP 	echo call(8,4) ?>],
            ['',8,5,' Cluster Communication' ,  <?PHP 	echo call(8,5) ?>],
            ['',8,6,' Cluster Communication' ,  <?PHP	echo call(8,6) ?>],
            ['',8,7,' Cluster Communication' ,  <?PHP 	echo call(8,7) ?>],
            ['',8,8,' Cluster Communication' ,  <?PHP 	echo call(8,8) ?>],

            ['',9,9,' Ignore' ,0],
            ['',0,0,' Ignore' ,0]

          ]);

          var options = {
            title: 'Graph showing inter and intra cluster communication till date',
            hAxis: {title: 'Cluster No.'},
            vAxis: {title: 'Cluster No.'},
            bubble: {textStyle: {fontSize: 11}}
          };

          // Create and draw the visualization.
          var chart = new google.visualization.BubbleChart(
              document.getElementById('visualization'));
          chart.draw(data, options);
      }


      google.setOnLoadCallback(drawVisualization);
    </script>
  </head>
  <body style="font-family: Arial;border: 0 none;">
    <div id="visualization" style="width: 600px; height: 400px;"></div>
  </body>
</html>
