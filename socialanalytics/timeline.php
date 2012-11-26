<html>
  <head>


  <?php



  //Make a MySQL Connection
  mysql_connect("localhost", "alpha", "csp301") or die(mysql_error());
  mysql_select_db("social_net") or die(mysql_error());

  $result = mysql_query("SELECT * FROM variables
  WHERE id=4") or die(mysql_error());
  $row = mysql_fetch_array( $result );

  $day = $row['var_value'];
$day = explode(' ',$day);
$day = $day[2].' '.$day[3].', '.$day[6];

echo($day);




  		$result = mysql_query("SELECT * FROM totaldayact
  		GROUP BY id DESC") or die(mysql_error());
  		$i=0;
  		while($row = mysql_fetch_array( $result ))
  		{
  		$day_communication[$i]=$row['num'];
  		$i++;
		}

		$lengthdays = $i;
?>




    <script type='text/javascript' src='http://www.google.com/jsapi'></script>
    <script type='text/javascript'>




      google.load('visualization', '1', {'packages':['annotatedtimeline']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Date');
        data.addColumn('number', 'Volume of Communication');
		var i=0;
		while(i<length)
		{
        data.addRows([
          [dateset(i), x[i]]
        ]);
        i++;
        }

        var chart = new google.visualization.AnnotatedTimeLine(document.getElementById('chart_div'));
        chart.draw(data, {displayAnnotations: true});
      }
    </script>
  </head>

  <body>
  <script type='text/javascript'>


var s = <?PHP echo json_encode($day); ?>;
var a=1;
var length=0;
length = <?php echo $lengthdays ?>;

var myDate=new Date(s);
//var myDate= new Date(2010,1,1);

var x = new Array();
x = <?php echo json_encode($day_communication)?>;
for(var t=0;t<length;t++) x[t]=1*x[t];

function dateset(i)
{

var newdate=new Date(s);
newdate.setDate(myDate.getDate()-i);
return newdate;
}

  </script>
    <div id='chart_div' style='width: 1550px; height: 300px;'></div>

  </body>
</html>