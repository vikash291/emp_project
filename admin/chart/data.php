<?php
//include_once "../db.php";
$con=mysql_connect("localhost","crazyuser","Crazy@123");
mysql_select_db("dbchat");
header("Content-type:application/json");

$name=$_REQUEST['ename'];
$date=$_REQUEST['date'];
$date1=$_REQUEST['date1'];

$results = mysql_query("SELECT * FROM employee where name='$name'");
$row = mysql_fetch_object($results);
$eid= $row->eid;
$query = "select count(id) as 'ho',date as 'dt' from entrytask where  date between '$date' and '$date1' and eid=$eid group by date ";
$result=mysql_query($query);
$arr=array();

while($row = mysql_fetch_assoc($result)){
$output[]=$row;
}
echo json_encode($output);
//}
?>