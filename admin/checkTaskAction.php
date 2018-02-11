<?php
require "db.php";
$ename=$_REQUEST['ename'];
$date = $_REQUEST['calander'];
$date1 = $_REQUEST['calander1'];

$results = mysql_query("SELECT eid FROM employee where name='$ename'");
$row = mysql_fetch_object($results);
$eid= $row->eid;

if($eid==''||$date==''||$date1=='')
{
echo "0";
}
else
{
$output = array();
$query= "select * from entrytask where date between '$date' and '$date1' and eid='$eid' order by date asc";
$result = mysql_query($query) or die(mysql_error());
$num_rows = mysql_num_rows($result);
if($num_rows > 0){
while($row = mysql_fetch_array($result)){
$output[]=$row;
}
echo json_encode($output);
}else{
echo "1";
}
}
?>
 


 