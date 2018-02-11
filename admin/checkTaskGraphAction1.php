<?php
require "db.php";
$eid=$_REQUEST['eid'];

echo $query = "select count(id) as 'ho',date as 'dt' from entrytask where eid=$eid group by date union select ho,dt from emptyentry";exit();


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


