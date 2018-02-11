<?php
ob_start();
session_start();
require "admin/db.php";
$eid=$_SESSION['emp_id'];
$date = $_REQUEST['currentDate'];
$date1 = $_REQUEST['currentDate1'];
if($date=='')
{
echo "1";
}
else if($date1=='')
{
echo "2";
}
else
{
$output = array();
$query= "select * from entrytask where date between '$date' and '$date1' and eid='$eid' order by date asc";
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
else
{
echo "0";
}
}

?> 
