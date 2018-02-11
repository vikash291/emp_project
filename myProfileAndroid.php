<?php
ob_start();
session_start();  
$id=$_REQUEST['emp_id'];
require "admin/db.php"; 
$output = array();
$query= "select * from employee where eid='$id'";
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
?>  
