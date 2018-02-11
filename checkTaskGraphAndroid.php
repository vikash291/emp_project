<?php
require "admin/db.php";
$eid=$_REQUEST['emp_id'];
$date=$_REQUEST['date'];
//$date2=$_REQUEST['date2'];
$query = "select count(id) as 'ho',date as 'dt' from entrytask where  date in (select date from entrytask where eid='$eid' and date like '$date%') and eid='$eid' group by date";
//$query = "select count(id) as 'ho',date as 'dt' from entrytask where  date between '$date' and '$date2' and eid=$eid group by date ";
$result=mysql_query($query);
$arr=array();
while($row = mysql_fetch_assoc($result)) 
	{
	$data[]=$row; 	 	
    }
//print_r($data);	
echo json_encode($data);



/*$output = array();

$query = "SELECT date,time FROM entrytask where eid='$eid' ORDER BY id";

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
}*/
?>