<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php include 'userLocationPie.php';
include 'dashboardEssentials.php';
?>

<html><head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>Social network analytics</title>

<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1.1', {packages: ['controls']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
    	  var obj=<?php placeDistribution(); ?>;
    	  for (var i=1;i< 95 ; i++)
    	  {
    	  obj[i][1]=1*obj[i][1];
    	  obj[i][2]=1*obj[i][2];
    	  }
        // Prepare the data
        var data = google.visualization.arrayToDataTable(obj);
      
     // Define a slider control for the number of users column.
        var slider = new google.visualization.ControlWrapper({
          'controlType': 'NumberRangeFilter',
          'containerId': 'control1',
          'options': {
            'filterColumnLabel': 'number of users',
          'ui': {'labelStacking': 'vertical'}
          }
        });

        // Define a category picker control for the Cluster column
        var categoryPicker = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'control2',
          'options': {
            'filterColumnLabel': 'Cluster',
            'ui': {
            'labelStacking': 'vertical',
              'allowTyping': false,
              'allowMultiple': false
            }
          }
        });

        // Define a Pie chart
        var pie = new google.visualization.ChartWrapper({
          'chartType': 'PieChart',
          'containerId': 'chart1',
          'options': {
            'width': 600,
            'height': 600,
            'legend': 'none',
            'title': 'Number of users (for locations present in clusters)',
            'chartArea': {'left': 15, 'top': 50, 'right': 0, 'bottom': 0},
            'pieSliceText': 'label'
          },
          // Instruct the piechart to use colums 0 (Location) and 3 (Activity (past week))
          // from the 'data' DataTable.
          'view': {'columns': [0, 2]}
        });
        // Create a dashboard
        new google.visualization.Dashboard(document.getElementById('dashboard')).
            // Establish bindings, declaring the both the slider and the category
            // picker will drive both charts.
            bind([slider, categoryPicker], [pie]).
            // Draw the entire dashboard.
            draw(data);
      }
      google.setOnLoadCallback(drawVisualization);
    </script>
</head>

<body>

<div style="text-align:right" id="logo">
	<font size="7" face="fantasy"><a href="homepage.php">Social network analytics</a></font>
</div>
<br>
<!-- end header -->
<div class="timeline" style="width:100%; background:Azure">
	<iframe src="timeline.php" width="1650" height="400"></iframe>
</div>
<div id="container" style="width:100%">
	<div class="header" style="width:100%; height:35px; background:RoyalBlue">
		<p><h1>Overview</h1></p>
	</div>
	<div class="leftCol" style="width:20%; background:Azure; float:left">
		<h1> Time: <?php displaytimestamp(); ?>
		</h1><p>*of last activity recorded</p>
	</div>
	<div class="centerCol" style="width:40%; background:Lavender; float:left">
		<p>  </p>
	</div>
	<div class="rightCol" style="width:40%; background:Orange; float:right"><h3>
		<?php echo displayData(); ?></h3>
	</div>
	<div class="locale" style="width:100%; clear:both; background:RoyalBlue; height:35px">
		<p> <h1>Demographics (Clusters and Locations) </h1></p>
	</div>
	<div id="dashboard" style="width:100%; clear:both; background:Azure">
      <table>
        <tr style='vertical-align: top'>
          <td style='width: 300px; font-size: 0.9em;'>
            <div id="control1"></div>
            <div id="control2"></div>
          </td>
          <td style='width: 600px'>
            <div style="float: left;" id="chart1"></div>
          </td>
        </tr>
      </table>
    </div>
	<div class="trendvis" style="width:100%; clear:both; background:RoyalBlue; height:35px">
		<h1> Visualizations of trending topics </h1>
	</div>
</div>
<div id="container2" style="width:100%">
	<div class="leftCol" style="width:50%; background:Azure; float:left">
		<iframe src="Form.php" width="850" height="600"></iframe>
	</div>
	<div class="rightCol" style="width:50%; background:Azure; float:right">
		<p><iframe src="dashboard_graph.php" width="900" height="600"></iframe></p>
	</div>
</div>
<div class="mtitle" style="width:100%; clear:both; background:RoyalBlue; height:55px; float:left">
	<h1> Motion chart for topic activity in clusters and Slideshow of trending topics </h1>
</div>
<div id="container3" style="width:100%">
	<div class="mgraph" style="width:60%; background:Azure; float:left">
		<iframe src="formMotionGraph.php" width="950" height="650"></iframe>
	</div>
	<div class="chart3" style="width:40%; background:Azure; float:right">
		<iframe src="trendingfinal.php" width="650" height="500"></iframe>
	</div>
</div>
<div class="popColTitle" style="width:100%; clear:both; background:RoyalBlue; height:35px">
	<h1> Popularity trend for topics discussed in the week </h1>
</div>
<div class="popCol" style="width:100%; background:Azure">
	<iframe src="popularity.php" width="1550" height="850"></iframe>
</div>
<div id="menu">
	<ul>
		<h1><li class="first"><a href="clusterGraphs.php">More visualizations</a></h1></li>
		<!-- <li><a href="#">Destinations</a></li> -->
		<h3><li><a href="http://en.wikipedia.org/wiki/Moving_average">Moving average (measure used for growth rate of a topic)</a></h3></li>
		<li><a href="intro.php">About Us</a></li>
	</ul>
</div>
<!-- end menu -->
<div id="content">
	<div><a href="http://www.mcescher.com/"><img src="LW303.jpg" alt="" height="360" width="740" /></a></div>
	<div class="boxed">
	<h1 class="title2">Social Network Analytics</h1>
	<p><strong>Introduction: </strong>Given live data from a hypothetical social media website, build a web based analytics dashboard to get a birds eye view of the activity on the website,
such as the features provided by Google analytics. This hypothetical website has 2,500 users with approximately 65,000 edges between them.
They come from interesting places such as Heaven and Hell and Asgard! And they don't sleep or eat or drink, they only gossip with each other on a wide variety of topics!
	<h3>Hierarchical filter</h3>
	<h3>Minimum energy based clusters</h3>
</div>
<!-- end content -->
<!-- end page -->
<div style="font-size: 0.8em; text-align: center; margin-top: 1em; margin-bottom: 4em;">
</div>
</body></html>