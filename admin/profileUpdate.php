<?php
require "db.php";
  
$id=$_REQUEST['id'];
$name=$_REQUEST['name'];
$address=$_REQUEST['address'];
$mobile=$_REQUEST['mobile'];
$email=$_REQUEST['email'];

$char ="1234567890";
$pass = str_shuffle($char);
$password = "EMP".$pass;
$results=mysql_query("UPDATE employee SET name='$name',address='$address',mobile='$mobile',email='$email' WHERE eid='$id'");

if($results)
{
echo "Updated";
}
else
{
echo "not-update";
}
	
?>
