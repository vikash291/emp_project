<?php
ob_start();
session_start();
require "admin/db.php";
$eid=$_SESSION['emp_id'];
$date=$_REQUEST['date'];
$date1=$_REQUEST['date1'];

$query = "select count(id) as 'ho',date as 'dt' from entrytask where  date between '$date' and '$date1' and eid=$eid group by date union select ho,dt from emptyentry";
$result=mysql_query($query);
$num_rows = mysql_num_rows($result);
if($num_rows > 0){

$arr=array();
while($row = mysql_fetch_assoc($result)) 
	{
	$data[]=$row; 	 	
    }	

echo json_encode($data);
}else{
echo "0";
}
?>


