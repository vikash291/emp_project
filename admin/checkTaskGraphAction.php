<?php
require "db.php";
$name=$_REQUEST['name'];
$date=$_REQUEST['date'];
$date1=$_REQUEST['date1'];

$que="select eid from employee where name='$name'";
$res=mysql_query($que) or die(mysql_error());
$row1=mysql_fetch_object($res);
$eid=$row1->eid;


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


