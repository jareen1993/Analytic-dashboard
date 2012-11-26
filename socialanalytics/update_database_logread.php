<html>
<body>
<?php
include 'file.php';
// Make a MySQL Connection
mysql_connect("localhost", "alpha", "csp301") or die(mysql_error());
mysql_select_db("social_net") or die(mysql_error());

/**
 * To Repetitivly call file parsing function 
 * @param INT Number of Log files to add
 * @return 
 */
function uptodatedatabase($week)
{
	$filenum=0;
	if($week<10)
	{
		for($i=2;$i<$week;$i++)
		{
			update($filenum.$i);//type cast i to string
		}
	}
	else
	{
		/*for($i=30;$i<10;$i++)
		{
		update($filenum.$i);
		}*/
		for($i=35;$i<$week;$i++)
		{
		update($i);
		}
	}
}
uptodatedatabase(36);
/**
 * To parse file  
 * @param STRING  Name of File to be parsed
 * @return 
 */
function update($filenum)
{
	geturlfile($filenum);
	$myFile = 'log'. $filenum .'.txt';
	$fh = fopen($myFile, 'r');
	$check1=0;
	$check2=0;
	$count=0;
	$result = mysql_query("DELETE FROM placewise_discussion WHERE id=1") or die(mysql_error());
	insertplace();

	
	$line = fgets($fh);
	
	while(!feof($fh))
	{
	
		$count++;
		ini_set('max_execution_time', 900);
		$lineprev = $line;
		$line = fgets($fh);
		if(strlen($line)>2)
		{
		$line_parts = explode(":", $line);
		$topic_info = explode(",", $line_parts[3]);

		$tem = $topic_info[1];
		//echo($tem);
		$tem1 = explode("-", $tem);
		$tem2 = explode(" ", $tem1[0]);
		$source_node = $tem2[1];
		$target_node = $tem1[1];
		//discusiion is between node source and targets
		$ttopic_name=$topic_info[2];
		if($count==0){echo(strlen($ttopic_name));}
		$ttopic_name =substr($ttopic_name, 1, -2);
		if(strlen($ttopic_name)>25){$a=strlen($ttopic_name);$ttopic_name =substr($ttopic_name, 0, 25 - $a);}

		$day_info = explode(" ", $line_parts[1]);
		$day_name=$day_info[1];
		//echo "Name Of the day ".($day_name). "<br />";
		//echo "Name Of topic".($ttopic_name). "<br />";
		$f=$ttopic_name . "_" . $day_name;

		//echo($f);

		$get1 = mysql_query("SELECT * FROM clusterdata_week WHERE topic_name = '$f'");
		$get=0;
		$get = mysql_num_rows($get1);

		//echo($get)."<br/>";

		$col1 = mysql_query("SELECT * FROM cluster WHERE NodeID = '$source_node'");
		$col2 = mysql_query("SELECT * FROM cluster WHERE NodeID = '$target_node'");

		$row = mysql_fetch_array( $col1 );
		$col1 = $row['ClusterID']; $col_1 = $row['Place'];
		$row = mysql_fetch_array( $col2 );
		$col2 = $row['ClusterID']; $col_2 = $row['Place'];

		$col1 = "Cluster_" . $col1;
		$col2 = "Cluster_" . $col2;

		
		$check2=updatemain_volume($ttopic_name,$day_name,$check2);
		update_placematrix($col_1,$col_2);
		update_clustermatrix($col1,$col2);
		$check1 = update_clusterdiscussion_daywise($get,$ttopic_name,$check1,$day_name,$f,$col1,$col2);
		
		//codes forr clusterdata..
		update_clusterdiscussion($ttopic_name,$col1,$col2);
		}
	}

	$line_parts = explode(",", $lineprev);
	$timestamp = explode(":", $line_parts[0]);
	$timestamp = $timestamp[1].':'.$timestamp[2].':'.$timestamp[3];
	$result = mysql_query("UPDATE variables SET var_value='$timestamp' WHERE id=4") or die(mysql_error());
	
	
	fclose($fh);
}

/**
 * To Update placematrix 
 * @param String first Topic
 * @param String Second Topic
 * @return 
 */
function update_placematrix($col_1,$col_2)
{
		$result = mysql_query("SELECT * FROM placewise_discussion
		WHERE id=1") or die(mysql_error());
		$row = mysql_fetch_array( $result );
		$temp1=$row[$col_1] + 1;
		$temp2=$row[$col_2] + 1;
		$temp3=$row['total'] + 1;
		$result = mysql_query("UPDATE placewise_discussion SET $col_1='$temp1' WHERE id=1") or die(mysql_error());
		$result = mysql_query("UPDATE placewise_discussion SET $col_2='$temp2' WHERE id=1") or die(mysql_error());
		$result = mysql_query("UPDATE placewise_discussion SET total='$temp3' WHERE id=1") or die(mysql_error());
}
/**
 * To Update clustermatrix 
 * @param String Cluster Name
 * @param String Cluster Name
 * @return 
 */
function update_clustermatrix($col1,$col2)
{
		$result = mysql_query("SELECT * FROM clustermatrix
		WHERE cluster='$col1'") or die(mysql_error());
		$row = mysql_fetch_array( $result );
		$temp1=$row[$col2] + 1;
		$result = mysql_query("UPDATE clustermatrix SET $col2='$temp1' WHERE cluster='$col1'") or die(mysql_error());
}
/**
 * To Update update clusterdiscussion day wise
 * @param INT 
 * @param String Name Of topic
 * @param INT 
 * @param String Day Name
 * @param String 
 * @param String Cluster Name
 * @param String Cluster Name
 * @return 
 */
function update_clusterdiscussion_daywise($get,$ttopic_name,$check1,$day_name,$f,$col1,$col2)
{
$check = $check1;
if($get==0)
		{
			insertweek($ttopic_name . "_Thu" ,0,0,0,0,0,0,0,0);
			insertweek($ttopic_name . "_Fri" ,0,0,0,0,0,0,0,0);
			insertweek($ttopic_name . "_Sat" ,0,0,0,0,0,0,0,0);
			insertweek($ttopic_name . "_Sun" ,0,0,0,0,0,0,0,0);
			insertweek($ttopic_name . "_Mon" ,0,0,0,0,0,0,0,0);
			insertweek($ttopic_name . "_Tue" ,0,0,0,0,0,0,0,0);
			insertweek($ttopic_name . "_Wed" ,0,0,0,0,0,0,0,0);

		}
		if($check==0 or $day_name=="Wed")
		{
		$result = mysql_query("SELECT * FROM clusterdata_week
		WHERE topic_name='$f'") or die(mysql_error());
		$row = mysql_fetch_array( $result );
		$temp1=$row[$col1] + 1;
		$result = mysql_query("UPDATE clusterdata_week SET $col1='$temp1' WHERE topic_name='$f'") or die(mysql_error());

		$result = mysql_query("SELECT * FROM clusterdata_week
		WHERE topic_name='$f'") or die(mysql_error());
		$row = mysql_fetch_array( $result );
		$temp1=$row[$col2] + 1;
		$result = mysql_query("UPDATE clusterdata_week SET $col2='$temp1' WHERE topic_name='$f'") or die(mysql_error());

		if($day_name=="Wed"){$check=1;}
		}

		else
		{

		$check=0;
		mysql_query("DROP TABLE clusterdata_week");

	mysql_query("CREATE TABLE clusterdata_week(
	id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(id),
	topic_name VARCHAR(30),
	Cluster_0 INT,
	Cluster_1 INT,
	Cluster_2 INT,
	Cluster_3 INT,
	Cluster_4 INT,
	Cluster_5 INT,
	Cluster_6 INT,
	Cluster_7 INT)")
	or die(mysql_error());
	echo "Table Created!";

			insertweek($ttopic_name . "_Thu" ,0,0,0,0,0,0,0,0);
			insertweek($ttopic_name . "_Fri" ,0,0,0,0,0,0,0,0);
			insertweek($ttopic_name . "_Sat" ,0,0,0,0,0,0,0,0);
			insertweek($ttopic_name . "_Sun" ,0,0,0,0,0,0,0,0);
			insertweek($ttopic_name . "_Mon" ,0,0,0,0,0,0,0,0);
			insertweek($ttopic_name . "_Tue" ,0,0,0,0,0,0,0,0);
			insertweek($ttopic_name . "_Wed" ,0,0,0,0,0,0,0,0);

			$result = mysql_query("SELECT * FROM clusterdata_week
			WHERE topic_name='$f'") or die(mysql_error());
			$row = mysql_fetch_array( $result );
			$temp1=$row[$col1] + 1;
			$result = mysql_query("UPDATE clusterdata_week SET $col1='$temp1' WHERE topic_name='$f'") or die(mysql_error());

			$result = mysql_query("SELECT * FROM clusterdata_week
			WHERE topic_name='$f'") or die(mysql_error());
			$row = mysql_fetch_array( $result );
			$temp1=$row[$col2] + 1;
			$result = mysql_query("UPDATE clusterdata_week SET $col2='$temp1' WHERE topic_name='$f'") or die(mysql_error());

		}
		return $check;
}

/**
 * To Update update clusterdata
 * @param String Name Of topic
 * @param String Cluster Name
 * @param String Cluster Name
 * @return 
 */
function update_clusterdiscussion($ttopic_name,$col1,$col2)
{
		$get = mysql_query("SELECT * FROM clusterdata WHERE topic_name = '$ttopic_name'");
		$get = mysql_num_rows($get);
		if($get==0)
		{
		insertcluster($ttopic_name,0,0,0,0,0,0,0,0);
		}
		$result = mysql_query("SELECT * FROM clusterdata
		WHERE topic_name='$ttopic_name'") or die(mysql_error());
		$row = mysql_fetch_array( $result );
		$temp1=$row[$col1] + 1;
		$result = mysql_query("UPDATE clusterdata SET $col1='$temp1' WHERE topic_name='$ttopic_name'") or die(mysql_error());

		$result = mysql_query("SELECT * FROM clusterdata
		WHERE topic_name='$ttopic_name'") or die(mysql_error());
		$row = mysql_fetch_array( $result );
		$temp1=$row[$col2] + 1;
		$result = mysql_query("UPDATE clusterdata SET $col2='$temp1' WHERE topic_name='$ttopic_name'") or die(mysql_error());
}



/**
 * To Update update current_week
 * @param String Name Of topic
 * @param String Day Name
 * @param INT
 * @return 
 */
function updatemain_volume($topic,$ret_day,$check2)
{
$check=$check2;
$tem="";
	$result = mysql_query("SELECT * FROM variables
				WHERE variable_name='rem_conter'") or die(mysql_error());  
				$row = mysql_fetch_array( $result );
				$tem=$row['var_value'];

		
			
		
			$ttopic_name=$topic;
			$day_name=$ret_day;		
			if($tem!=$day_name && $tem!='0')
			{
				insert_cum($ttopic_name,$day_name,1);
			}
			else 
			{
				insert_cum($ttopic_name,$day_name,0);
			}
			$tem=$day_name;
			$f=$ttopic_name;
			$get1 = mysql_query("SELECT * FROM current_week WHERE topic_name = '$ttopic_name'");
			$get=0;
			$get = mysql_num_rows($get1);	
			 
			$result1 = mysql_query("UPDATE variables SET var_value='$tem' WHERE variable_name='rem_conter'") 
			or die(mysql_error()); 
			
			
			
			if($get==1)
			{			
				$result = mysql_query("SELECT * FROM current_week
				WHERE topic_name='$ttopic_name'") or die(mysql_error());  
				$row = mysql_fetch_array( $result );
			
				if($day_name=="Fri" and $check==0)
				{		
				
					$temp=$row['day_2'];
					$temp=$temp+1;
				
					$result1 = mysql_query("UPDATE current_week SET day_2='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());  
				
					$temp=$row['total'];
					$temp=$temp+1;
			
					$result1 = mysql_query("UPDATE current_week SET total='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());  
				
				}
				elseif($day_name=="Thu" and $check==0)
				{

					$temp=$row['day_1'];
					$temp=$temp+1;
					$result1 = mysql_query("UPDATE current_week SET day_1='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());  

					$temp=$row['total'];
					$temp=$temp+1;
				
					$result1 = mysql_query("UPDATE current_week SET total='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());  				
				}
				elseif($day_name=="Wed" )
				{
				
					$check=1;
					$temp=$row['day_7'];
					$temp=$temp+1;
					$result1 = mysql_query("UPDATE current_week SET day_7='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());  	
					
					$temp=$row['total'];
					$temp=$temp+1;
					
					$result1 = mysql_query("UPDATE current_week SET total='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error()); 
					
				}
				elseif($day_name=="Sat" and $check==0)
				{
				
					$temp=$row['day_3'];
					$temp=$temp+1;
					$result1 = mysql_query("UPDATE current_week SET day_3='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());  	
					
					$temp=$row['total'];
					$temp=$temp+1;
					
					$result1 = mysql_query("UPDATE current_week SET total='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error()); 
				}
				elseif($day_name=="Sun" and $check==0)
				{
				
					$temp=$row['day_4'];
					$temp=$temp+1;
					$result1 = mysql_query("UPDATE current_week SET day_4='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());  

					$temp=$row['total'];
					$temp=$temp+1;
				
					$result1 = mysql_query("UPDATE current_week SET total='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error()); 				
				}
				elseif($day_name=="Mon" and $check==0)
				{
				
					$temp=$row['day_5'];
					$temp=$temp+1;
					$result1 = mysql_query("UPDATE current_week SET day_5='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());  	
					
					$temp=$row['total'];
					$temp=$temp+1;
					
					$result1 = mysql_query("UPDATE current_week SET total='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error()); 
				}
				elseif($day_name=="Tue" and $check==0)
				{
				
					$temp=$row['day_6'];
					$temp=$temp+1;
					$result1 = mysql_query("UPDATE current_week SET day_6='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());  	
					
					$temp=$row['total'];
					$temp=$temp+1;
					
					$result1 = mysql_query("UPDATE current_week SET total='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error()); 
				}
				elseif($check == 1) 
				{
					
					$check = 0;
					DO_IT();
					mysql_query("DROP TABLE current_week");
					createtable();
					insert($ttopic_name,1,0,0,0,0,0,0);
					$temp=$row['total'];
					$temp=$temp+1;
				
					$result1 = mysql_query("UPDATE current_week SET total='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());
				}
				
			}
			else
			{
				$result = mysql_query("SELECT * FROM current_week
				WHERE topic_name='$ttopic_name'") or die(mysql_error());  
				$row = mysql_fetch_array( $result );
				if($day_name=="Fri" and $check==0)
				{
					insert($ttopic_name,0,1,0,0,0,0,0);
					$temp=0;
					$temp=$temp+1;
				
					$result1 = mysql_query("UPDATE current_week SET total='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());
				}
				elseif($day_name=="Sat" and $check==0)
				{
					insert($ttopic_name,0,0,1,0,0,0,0);
					$temp=0;
					$temp=$temp+1;
				
					$result1 = mysql_query("UPDATE current_week SET total='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());
				}
				elseif($day_name=="Sun" and $check==0)
				{
					insert($ttopic_name,0,0,0,1,0,0,0);
					$temp=0;
					$temp=$temp+1;
					
					$result1 = mysql_query("UPDATE current_week SET total='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());
				}
				elseif($day_name=="Mon" and $check==0)
				{
					insert($ttopic_name,0,0,0,0,1,0,0);
					$temp=0;
					$temp=$temp+1;
				
					$result1 = mysql_query("UPDATE current_week SET total='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());
				}
				elseif($day_name=="Tue" and $check==0)
				{
					insert($ttopic_name,0,0,0,0,0,1,0);
					$temp=0;
					$temp=$temp+1;
					
					$result1 = mysql_query("UPDATE current_week SET total='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());
				}
				elseif($day_name=="Wed")
				{
					$check=1;
					insert($ttopic_name,0,0,0,0,0,0,1);
					$temp=0;
					$temp=$temp+1;
					
					$result1 = mysql_query("UPDATE current_week SET total='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());
				}
				elseif($day_name=="Thu" and $check==0)
				{
					insert($ttopic_name,1,0,0,0,0,0,0);
					$temp=0;
					$temp=$temp+1;
					
					$result1 = mysql_query("UPDATE current_week SET total='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());
				}
				elseif($check == 1) 
				{
					
					$check = 0;
					DO_IT();
					mysql_query("DROP TABLE current_week");
					createtable();
					insert($ttopic_name,1,0,0,0,0,0,0);
					$temp=0;
					$temp=$temp+1;
				
					$result1 = mysql_query("UPDATE current_week SET total='$temp' WHERE topic_name='$ttopic_name'") 
					or die(mysql_error());
				}			
			}	
		
	
	
	
	return $check;
}




/**
 * To Update Trending(Calculated Using Moving Average Model) week Table
 * @param
 * @return 
 */
function trending_topic()
{
//mysql_query("ALTER TABLE current_week DROP trending");
mysql_query("ALTER TABLE current_week ADD trending FLOAT AFTER day_7");
$result = mysql_query("SELECT * FROM current_week") or die(mysql_error()); 
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
		$aggregate = ($aggregate*0.25) + ((($row[$type.$i])/$max)*0.75);
		$i = $i+1;
		$type = "day_";
	}

$sd = $row["id"];
$result1 = mysql_query("UPDATE current_week SET trending='$aggregate' WHERE id = '$sd'");
}
$result = mysql_query("SELECT * FROM current_week ORDER BY trending DESC ") 
	or die(mysql_error());
	$e=1;
	while($e<=10)
	{
		$row = mysql_fetch_array( $result )	;
		$temp= $row['topic_name'];
		if($e==1)
		{
			mysql_query("INSERT INTO trending10table	(topic_1) VALUES('$temp')")
			or die(mysql_error());  
		}
		else
		{
			$clm="topic_".$e;
			$result1 = mysql_query("SELECT * FROM `trending10table` WHERE id=(select max(id) from trending10table) ")
			or die(mysql_error());
		$row1 = mysql_fetch_array( $result1 )	;
		$sd=$row1['id'];
			$result1 = mysql_query("UPDATE trending10table SET $clm='$temp' WHERE id = '$sd'");
		}
		$e=$e+1;
	}
	mysql_query("ALTER TABLE current_week DROP trending");

}



/**
 * To insert element into clusterdata_week
 * @param String Name Of topic
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @return 
 */
function insertweek($Name,$day1,$day2,$day3,$day4,$day5,$day6,$day7,$day8)
{
	// Insert a row of information into the table "example"
	mysql_query("INSERT INTO clusterdata_week
	(topic_name, Cluster_0,Cluster_1,Cluster_2,Cluster_3,Cluster_4,Cluster_5,Cluster_6,Cluster_7) VALUES('$Name', '$day1', '$day2', '$day3', '$day4', '$day5', '$day6', '$day7','$day8' ) ")
	or die(mysql_error());
	//echo "Data Inserted!";
}



/**
 * To insert element into clusterdata
 * @param String Name Of topic
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @return 
 */
function insertcluster($Name,$day1,$day2,$day3,$day4,$day5,$day6,$day7,$day8)
{
	// Insert a row of information into the table "example"
	mysql_query("INSERT INTO clusterdata
	(topic_name, Cluster_0,Cluster_1,Cluster_2,Cluster_3,Cluster_4,Cluster_5,Cluster_6,Cluster_7) VALUES('$Name', '$day1', '$day2', '$day3', '$day4', '$day5', '$day6', '$day7','$day8' ) ")
	or die(mysql_error());
	//echo "Data Inserted!";
}

/**
 * To initialise placewise_discussion table
 * @param 
 * @return 
 */
function insertplace()
{
	mysql_query("INSERT INTO placewise_discussion
	(id,Agartha,Alfheim,Asgard,Avalon,Camelot,Cockaigne,Hawaiki,Heaven,Hell,Hyperborea,Jotunheim,Lemur,Meropis,Mu,Niflheim,Niflhel,Tartarus,Utopia,Valhalla,Lemuria,total) VALUES(1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0) ")
	or die(mysql_error());

}
/**
 * To insert in Cumulitave table
 * @param String Topic Name
 * @param String Day Name
 * @param INT Day Name
 * @return 
 */



function insert_cum($ttopic_name,$day_name,$h)
{
	if($h==1)
	{
	
	
	
		$result = mysql_query("SELECT * FROM cumtable") or die(mysql_error());  
		$total_communication = 0;

		while($row = mysql_fetch_array($result))	
		{
			$total_communication = $total_communication + $row['day_1'];
		}	
	
	
		mysql_query("INSERT INTO totaldayact
		(num) VALUES('$total_communication')") 
		or die(mysql_error());
	
	
	
		mysql_query("ALTER TABLE cumtable DROP day_7");	
		mysql_query("ALTER TABLE cumtable CHANGE day_6 day_7 VARCHAR(30)");
		mysql_query("ALTER TABLE cumtable CHANGE day_5 day_6 VARCHAR(30)");
		mysql_query("ALTER TABLE cumtable CHANGE day_4 day_5 VARCHAR(30)");
		mysql_query("ALTER TABLE cumtable CHANGE day_3 day_4 VARCHAR(30)");
		mysql_query("ALTER TABLE cumtable CHANGE day_2 day_3 VARCHAR(30)");
		mysql_query("ALTER TABLE cumtable CHANGE day_1 day_2 VARCHAR(30)");
		mysql_query("ALTER TABLE cumtable ADD day_1 INT AFTER topic_name");
		$result1 = mysql_query("UPDATE cumtable SET day_1='0' ") ;
		
		$query = "SELECT * FROM cumtable"; 
		$result = mysql_query($query) or die(mysql_error());
		
		while($row = mysql_fetch_array($result))
		{
			$nam=$row['topic_name'];
			$final_addition=$row['day_1']+$row['day_2']+$row['day_3']+$row['day_4']+$row['day_5']+$row['day_6']+$row['day_7'];
			$result1 = mysql_query("UPDATE cumtable SET total='$final_addition' WHERE topic_name = '$nam'");
		}
	
	
	}

	$get1 = mysql_query("SELECT * FROM cumtable WHERE topic_name = '$ttopic_name'");
	$get=0;
	$get = mysql_num_rows($get1);	
	if($get==1)
	{
		//topic exists
		$result = mysql_query("SELECT * FROM cumtable
		WHERE topic_name='$ttopic_name'") or die(mysql_error());  
		$row = mysql_fetch_array( $result );
		
		
		$temp=$row['day_1'];
		$temp=$temp+1;
				
		$result1 = mysql_query("UPDATE cumtable SET day_1='$temp' WHERE topic_name='$ttopic_name'") 
		or die(mysql_error());  
				
		$temp=$row['total'];
		$temp=$temp+1;
			
		$result1 = mysql_query("UPDATE cumtable SET total='$temp' WHERE topic_name='$ttopic_name'") 
		or die(mysql_error());  
		
	}
	else
	{
	
		mysql_query("INSERT INTO cumtable
		(topic_name, day_1,day_2,day_3,day_4,day_5,day_6,day_7) VALUES('$ttopic_name', '1','0','0','0','0','0','0') ") 
		or die(mysql_error()); 
		
		$temp=0;
		$temp=$temp+1;
				
		$result1 = mysql_query("UPDATE cumtable SET total='$temp' WHERE topic_name='$ttopic_name'") 
		or die(mysql_error());
	
	
	
	}
	
	

}

/**
 * To insert in Cumulitave table
 * @param String Topic Name
 * @param INT Week_1 communication Number
 * @param INT Week_2 communication Number
 * @param INT Week_3 communication Number
 * @param INT Week_4 communication Number
 * @return 
 */

function insertinweek($ne,$w1,$w2,$w3,$w4)
{

	mysql_query("INSERT INTO week
	(topic_name,week_1,week_2,week_3,week_4) VALUES('$ne','$w1','$w2','$w3','$w4')") 
	or die(mysql_error());  
	
}
/**
 * Internal Function to insert Day data in Week data
 * @param 
 * @return 
 */
function DO_IT()
{
	
	Update_top10();
	trending_topic();
	mysql_query("ALTER TABLE week DROP week_4");	
	mysql_query("ALTER TABLE week CHANGE week_3 week_4 VARCHAR(30)");
	mysql_query("ALTER TABLE week CHANGE week_2 week_3 VARCHAR(30)");
	mysql_query("ALTER TABLE week CHANGE week_1 week_2 VARCHAR(30)");
	mysql_query("ALTER TABLE week ADD week_1 INT AFTER topic_name");
	$result1 = mysql_query("UPDATE week SET week_1=0 ");
	$query = "SELECT * FROM current_week"; 	 
	$result = mysql_query($query) or die(mysql_error());

	while($row = mysql_fetch_array($result))
	{
		$name= $row['topic_name'];
		$tot=$row['total'];
	
	
		$get1 = mysql_query("SELECT * FROM week WHERE topic_name = '$name'");
		$get=0;
		$get = mysql_num_rows($get1);
		
		
	if($get==1)
	{
	
		$result1 = mysql_query("UPDATE week SET week_1='$tot' WHERE topic_name='$name'") 
		or die(mysql_error());  	
		}
	else
	{
		insertinweek($name,$tot,0,0,0);
	}
}
	do_total();
	month_update();
	
}
/**
 * Internal Function to insert week data in MonthTable data
 * @param 
 * @return 
 */
function do_it_month()
{



	mysql_query("ALTER TABLE monthtable DROP month_12");	
	mysql_query("ALTER TABLE monthtable CHANGE month_11 month_12 VARCHAR(30)");
	mysql_query("ALTER TABLE monthtable CHANGE month_10 month_11 VARCHAR(30)");
	mysql_query("ALTER TABLE monthtable CHANGE month_9 month_10 VARCHAR(30)");
	mysql_query("ALTER TABLE monthtable CHANGE month_8 month_9 VARCHAR(30)");
	mysql_query("ALTER TABLE monthtable CHANGE month_7 month_8 VARCHAR(30)");
	mysql_query("ALTER TABLE monthtable CHANGE month_6 month_7 VARCHAR(30)");
	mysql_query("ALTER TABLE monthtable CHANGE month_5 month_6 VARCHAR(30)");
	mysql_query("ALTER TABLE monthtable CHANGE month_4 month_5 VARCHAR(30)");
	mysql_query("ALTER TABLE monthtable CHANGE month_3 month_4 VARCHAR(30)");
	mysql_query("ALTER TABLE monthtable CHANGE month_2 month_3 VARCHAR(30)");
	mysql_query("ALTER TABLE monthtable CHANGE month_1 month_2 VARCHAR(30)");
	mysql_query("ALTER TABLE monthtable ADD month_1 INT AFTER topic_name");
	$result1 = mysql_query("UPDATE monthtable SET month_1='0' ") ;
	$query = "SELECT * FROM week"; 	 
	$result = mysql_query($query) or die(mysql_error());

	while($row = mysql_fetch_array($result))
	{
		$name= $row['topic_name'];
		$tot=$row['total'];
		//$get1 = mysql_query("SELECT * FROM current_week WHERE topic_name = '$ttopic_name'"); 
		$get1 = mysql_query("SELECT * FROM monthtable WHERE topic_name = '$name'");
		$get=0;
		$get = mysql_num_rows($get1);
		
		
		if($get==1)
		{
	
			$result1 = mysql_query("UPDATE monthtable SET month_1='$tot' WHERE topic_name='$name'") 
			or die(mysql_error());  	
		}
		else
		{
			mysql_query("INSERT INTO monthtable
			(topic_name, month_1,month_2,month_3,month_4,month_5,month_6) VALUES('$name', '$tot', '0', '0', '0','0','0' ) ") 
			or die(mysql_error());  
	
		}
}


	$query = "SELECT * FROM monthtable"; 
	$result = mysql_query($query) or die(mysql_error());
	$result1 = mysql_query("UPDATE monthtable SET month_1=0 WHERE month_1='NULL'");
	while($row = mysql_fetch_array($result))
	{
		$nam=$row['topic_name'];
		$final_addition=$row['month_1']+$row['month_2']+$row['month_3']+$row['month_4']+$row['month_5']+$row['month_6'];
		$result1 = mysql_query("UPDATE monthtable SET total='$final_addition' WHERE topic_name = '$nam'");
	}




}

/**
 * Internal Function to handle monthtable database
 * @param 
 * @return 
 */
function month_update()
{
	$query = "SELECT * FROM variables"; 
	$result = mysql_query($query) or die(mysql_error());
	$result1 = mysql_query("UPDATE week SET week_1=0 WHERE weak_1='NULL'");
	$row = mysql_fetch_array($result);
	$count=$row['var_value'];
	
	$count = ($count + 1)%4;
	$result1 = mysql_query("UPDATE variables SET var_value='$count' WHERE variable_name = 'week_conter'");
	
	if($count == 0)
	{
		do_it_month();
	}
}
/**
 * Internal Function to sum entries for last four weeks and store in db
 * @param 
 * @return 
 */
function do_total()
{
	$query = "SELECT * FROM week"; 
	$result = mysql_query($query) or die(mysql_error());
	$result1 = mysql_query("UPDATE week SET week_1=0 WHERE weak_1='NULL'");
	while($row = mysql_fetch_array($result))
	{
		$nam=$row['topic_name'];
		$final_addition=$row['week_1']+$row['week_2']+$row['week_3']+$row['week_4'];
		$result1 = mysql_query("UPDATE week SET total='$final_addition' WHERE topic_name = '$nam'");
	}
}

/**
 * To insert element into current_week
 * @param String Name Of topic
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @param String Day Name
 * @return 
 */

function insert($Name,$day1,$day2,$day3,$day4,$day5,$day6,$day7)
{
	// Insert a row of information into the table "example"
	mysql_query("INSERT INTO current_week
	(topic_name, day_1,day_2,day_3,day_4,day_5,day_6,day_7) VALUES('$Name', '$day1', '$day2', '$day3', '$day4', '$day5', '$day6', '$day7' ) ") 
	or die(mysql_error());  
	
}

/**
 * To update top10 topic list
 * @param 
 * @return 
 */
function Update_top10()
{
	$result = mysql_query("SELECT * FROM current_week ORDER BY total DESC ") 
	or die(mysql_error());
	$e=1;
	while($e<=10)
	{
		$row = mysql_fetch_array( $result )	;
		$temp= $row['topic_name'];
		echo($temp);
		if($e==1)
		{
			mysql_query("INSERT INTO top10table
			(topic_1) VALUES('$temp')")
			or die(mysql_error());  
		}
		else
		{
			$clm="topic_".$e;
			
			$result1 = mysql_query("SELECT * FROM `top10table` WHERE id=(select max(id) from top10table) ") 
			
			or die(mysql_error());
		$row1 = mysql_fetch_array( $result1 )	;

$sd=$row1['id'];
			$result1 = mysql_query("UPDATE top10table SET $clm='$temp' WHERE id = '$sd'");
		}
		$e=$e+1;
	}
	

}
/**
 * Internal Function to create current_week Table in social_net database
 * @param 
 * @return 
 */
function createtable()
{
	mysql_query("CREATE TABLE current_week(
	id INT NOT NULL AUTO_INCREMENT, 
	PRIMARY KEY(id),
	topic_name VARCHAR(30), 
	day_1 INT,
	day_2 INT,
	day_3 INT,
	day_4 INT,
	day_5 INT,
	day_6 INT,
	day_7 INT,
	total INT)")
	or die(mysql_error());  
	
}





?>
</body>
</html>