<?php
ob_start();
session_start();
require "admin/db.php";
$eid=$_REQUEST['emp_id'];
$date = $_REQUEST['date'];
$date2 = $_REQUEST['date2'];
$output = array();
//$query= "select * from entrytask where date='$date'and eid='$id'";
$query = "select * from entrytask where date between '$date' and '$date2' and eid='$eid' order by date asc";
$result = mysql_query($query) or die(mysql_error());
$num_rows = mysql_num_rows($result);
if($num_rows > 0)
{
while($row = mysql_fetch_assoc($result))
{
$output[]=$row;
}
echo json_encode($output);
}
 //echo "okieeeesdfsdfdscseeee";
?> 