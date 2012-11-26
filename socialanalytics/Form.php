<form action="top10.php" method="post">
<h3>Top 10 Topics</h3>
<h4>Top 10 Topics By Day:</h4> <br />
<?php for($i=1;$i<8;$i++) : ?> for <?php echo $i." ".'days' ?>: <input type="radio" name="ans" value=<?php echo 'day_'.$i ?> /><br /><?php endfor; ?>
<h4>Top 10 Topics By Week:</h4> <br />
<?php for($i=1;$i<5;$i++) : ?> for <?php echo $i." ".'weeks' ?>: <input type="radio" name="ans" value=<?php echo 'week_'.$i ?> /><br /><?php endfor; ?>
<h4>Top 10 Topics By Month:</h4> <br />
<?php for($i=1;$i<7;$i++) : ?> for <?php echo $i." ".'months' ?>: <input type="radio" name="ans" value=<?php echo 'month_'.$i ?> /><br /><?php endfor; ?>
<br />
<input type="submit"  />
</form>


<form action="draw_graphs.php" method="post">
<h3>Type Topic Name to see its Behaviour</h3>
Name Of Topic: <input type="text" name="topic" /><br /><br />
Type Of Output:<select name="dropdown" value="options">
<option value="day">per day</option>
<option value="week">per week</option>
<option value="month">per month</option>
</select><br /><br />
Number: <input type="text" name="num" /><br /><br />

<input type="submit" />
</form>