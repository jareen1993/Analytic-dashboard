<html xmlns="http://www.w3.org/1999/xhtml">
  <head>

<?php
/**
 * To fetch given entry from place wise discussion Table
 * @param String place Name
 * @return String Placename
 */
function call($a)
{

// Make a MySQL Connection
mysql_connect("localhost", "alpha", "csp301") or die(mysql_error());
mysql_select_db("social_net") or die(mysql_error());

		$result = mysql_query("SELECT * FROM placewise_discussion
		WHERE id=1 ") or die(mysql_error());
		$row = mysql_fetch_array( $result );
		$temp1=$row[$a];

		//echo(temp1);
		return $temp1;
}

?>


    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['City', 'Communication last week'],

          ['Agartha',     <?PHP 	echo call('Agartha') ?>],
          ['Alfheim',     <?PHP 	echo call('Alfheim') ?>],
          ['Asgard',     <?PHP 	echo call('Asgard') ?>],
          ['Avalon',     <?PHP 	echo call('Avalon') ?>],
          ['Camelot',     <?PHP 	echo call('Camelot') ?>],
          ['Cockaigne',     <?PHP 	echo call('Cockaigne') ?>],
          ['Hawaiki',     <?PHP 	echo call('Hawaiki') ?>],
          ['Heaven',     <?PHP 	echo call('Heaven') ?>],
          ['Hell',     <?PHP 	echo call('Hell') ?>],
          ['Hyperborea',     <?PHP 	echo call('Hyperborea') ?>],
          ['Jotunheim',     <?PHP 	echo call('Jotunheim') ?>],
          ['Lemur',     <?PHP 	echo call('Lemur') ?>],
          ['Meropis',     <?PHP 	echo call('Meropis') ?>],
          ['Mu',     <?PHP 	echo call('Mu') ?>],
          ['Niflheim',     <?PHP 	echo call('Niflheim') ?>],
          ['Niflhel',     <?PHP 	echo call('Niflhel') ?>],
          ['Tartarus',     <?PHP 	echo call('Tartarus') ?>],
          ['Utopia',     <?PHP 	echo call('Utopia') ?>],
          ['Valhalla',     <?PHP 	echo call('Valhalla') ?>],
          ['Lemuria',     <?PHP 	echo call('Lemuria') ?>]


        ]);

        var options = {
          title: 'PlaceWise PieChart of Volume of Discussions'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>