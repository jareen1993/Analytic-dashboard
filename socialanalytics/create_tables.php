<?php
// Make a MySQL Connection
mysql_connect("localhost", "alpha", "csp301") or die(mysql_error());
mysql_select_db("social_net") or die(mysql_error());
/**
 * To create all Important Tables Related to Clusters
 * @param
 * @return 
 */
function create()
{
	mysql_query("CREATE TABLE clusterdata_week(
	id INT NOT NULL AUTO_INCREMENT,	PRIMARY KEY(id),
	topic_name VARCHAR(30),
	Cluster_0 INT,	Cluster_1 INT,	Cluster_2 INT,	Cluster_3 INT,	Cluster_4 INT,	Cluster_5 INT,	Cluster_6 INT,	Cluster_7 INT)")
	or die(mysql_error());
	echo "Table Created!";

	mysql_query("CREATE TABLE clusterdata(
	id INT NOT NULL AUTO_INCREMENT,	PRIMARY KEY(id),	topic_name VARCHAR(30),
	Cluster_0 INT,	Cluster_1 INT,	Cluster_2 INT,	Cluster_3 INT,	Cluster_4 INT,	Cluster_5 INT,	Cluster_6 INT,	Cluster_7 INT)")
	or die(mysql_error());
	echo "Table Created!";

	mysql_query("CREATE TABLE clustermatrix(
	id INT NOT NULL AUTO_INCREMENT,	PRIMARY KEY(id),
	cluster VARCHAR(30),
	Cluster_0 INT,	Cluster_1 INT,	Cluster_2 INT,	Cluster_3 INT,	Cluster_4 INT,	Cluster_5 INT,	Cluster_6 INT,	Cluster_7 INT)")
	or die(mysql_error());

	mysql_query("INSERT INTO clustermatrix(cluster, Cluster_0,Cluster_1,Cluster_2,Cluster_3,Cluster_4,Cluster_5,Cluster_6,Cluster_7) VALUES('Cluster_0',0,0,0,0,0,0,0,0) ") or die(mysql_error());
	mysql_query("INSERT INTO clustermatrix(cluster, Cluster_0,Cluster_1,Cluster_2,Cluster_3,Cluster_4,Cluster_5,Cluster_6,Cluster_7) VALUES('Cluster_1',0,0,0,0,0,0,0,0) ") or die(mysql_error());
	mysql_query("INSERT INTO clustermatrix(cluster, Cluster_0,Cluster_1,Cluster_2,Cluster_3,Cluster_4,Cluster_5,Cluster_6,Cluster_7) VALUES('Cluster_2',0,0,0,0,0,0,0,0) ") or die(mysql_error());
	mysql_query("INSERT INTO clustermatrix(cluster, Cluster_0,Cluster_1,Cluster_2,Cluster_3,Cluster_4,Cluster_5,Cluster_6,Cluster_7) VALUES('Cluster_3',0,0,0,0,0,0,0,0) ") or die(mysql_error());
	mysql_query("INSERT INTO clustermatrix(cluster, Cluster_0,Cluster_1,Cluster_2,Cluster_3,Cluster_4,Cluster_5,Cluster_6,Cluster_7) VALUES('Cluster_4',0,0,0,0,0,0,0,0) ") or die(mysql_error());
	mysql_query("INSERT INTO clustermatrix(cluster, Cluster_0,Cluster_1,Cluster_2,Cluster_3,Cluster_4,Cluster_5,Cluster_6,Cluster_7) VALUES('Cluster_5',0,0,0,0,0,0,0,0) ") or die(mysql_error());
	mysql_query("INSERT INTO clustermatrix(cluster, Cluster_0,Cluster_1,Cluster_2,Cluster_3,Cluster_4,Cluster_5,Cluster_6,Cluster_7) VALUES('Cluster_6',0,0,0,0,0,0,0,0) ") or die(mysql_error());
	mysql_query("INSERT INTO clustermatrix(cluster, Cluster_0,Cluster_1,Cluster_2,Cluster_3,Cluster_4,Cluster_5,Cluster_6,Cluster_7) VALUES('Cluster_7',0,0,0,0,0,0,0,0) ") or die(mysql_error());
	echo "Table Created!";
	
	mysql_query("CREATE TABLE placewise_discussion(
	id INT NOT NULL AUTO_INCREMENT,	PRIMARY KEY(id),
	Agartha INT,Alfheim INT,Asgard INT,Avalon INT,Camelot INT,Cockaigne INT,Hawaiki INT,Heaven INT,Hell INT,Hyperborea INT,Jotunheim INT,Lemur INT,Meropis INT,Mu INT,Niflheim INT,Niflhel INT,Tartarus INT,Utopia INT,Valhalla INT,Lemuria INT,total INT)")
	or die(mysql_error());
	
	mysql_query("CREATE TABLE trending10table(
	id INT NOT NULL AUTO_INCREMENT, 
	PRIMARY KEY(id),
	topic_1 VARCHAR(30), 
	topic_2 VARCHAR(30), 
	topic_3 VARCHAR(30), 
	topic_4 VARCHAR(30), 
	topic_5 VARCHAR(30), 
	topic_6 VARCHAR(30), 
	topic_7 VARCHAR(30), 
	topic_8 VARCHAR(30), 
	topic_9 VARCHAR(30), 
	topic_10 VARCHAR(30))")
	or die(mysql_error()); 
}


create();
createcumtable();
createtable10table();
create_logactivitytable();
create_var_table();
mysql_query("INSERT INTO variables
(variable_name,var_value) VALUES('week_conter','0') ") 
or die(mysql_error()); 
mysql_query("INSERT INTO variables
(variable_name,var_value) VALUES('day_conter','0') ") 
or die(mysql_error());  
mysql_query("INSERT INTO variables
(variable_name,var_value) VALUES('rem_conter','0') ") 
or die(mysql_error()); 
mysql_query("INSERT INTO variables
(variable_name,var_value) VALUES('timestamp','0') ")
or die(mysql_error());
create_month_table();
createtable();
create_week_table();

/**
 * To create Table for Variables
 * @param 
 * @return 
 */
function create_var_table()
{
	mysql_query("CREATE TABLE variables(
	id INT NOT NULL AUTO_INCREMENT, 
	PRIMARY KEY(id),
	variable_name VARCHAR(30),
	var_value VARCHAR(30))")
	or die(mysql_error());  
	
}
/**
 * To create Table for log activity
 * @param 
 * @return 
 */
function create_logactivitytable()
{
	mysql_query("CREATE TABLE totaldayact(
	id INT NOT NULL AUTO_INCREMENT, 
	PRIMARY KEY(id),
	num INT)")
	or die(mysql_error());  

}
/**
 * To create Table for month activity
 * @param 
 * @return 
 */
function create_month_table()
{
	mysql_query("CREATE TABLE monthtable(
	id INT NOT NULL AUTO_INCREMENT, 
	PRIMARY KEY(id),
	topic_name VARCHAR(30),
	month_1 INT,
	month_2 INT,
	month_3 INT,
	month_4 INT,
	month_5 INT,
	month_6 INT,
	month_7 INT,
	month_8 INT,
	month_9 INT,
	month_10 INT,
	month_11 INT,
	month_12 INT,
	total INT)")
	or die(mysql_error());  

}

/**
 * To create Table for Topic Wise entries of last four Days
 * @param 
 * @return 
 */
function create_week_table()
{
	mysql_query("CREATE TABLE week(
	id INT NOT NULL AUTO_INCREMENT, 
	PRIMARY KEY(id),
	topic_name VARCHAR(30), 
	week_1 INT,
	week_2 INT,
	week_3 INT,
	week_4 INT,
	total INT)")
	or die(mysql_error());  
	
}

/**
 * To create Table for Topic Wise entries of last seven days
 * @param 
 * @return 
 */

function createcumtable()
{
	mysql_query("CREATE TABLE cumtable(
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


/**
 * To create Table for Topic Wise entries of Current week 
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

/**
 * To create Table for History of Top 10 topics 
 * @param 
 * @return 
 */


function createtable10table()
{
	mysql_query("CREATE TABLE top10table(
	id INT NOT NULL AUTO_INCREMENT, 
	PRIMARY KEY(id),
	topic_1 VARCHAR(30), 
	topic_2 VARCHAR(30), 
	topic_3 VARCHAR(30), 
	topic_4 VARCHAR(30), 
	topic_5 VARCHAR(30), 
	topic_6 VARCHAR(30), 
	topic_7 VARCHAR(30), 
	topic_8 VARCHAR(30), 
	topic_9 VARCHAR(30), 
	topic_10 VARCHAR(30))")
	or die(mysql_error());  
	
}



?>







?>