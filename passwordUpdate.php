<?php
require "admin/db.php"; 

$id=$_REQUEST['emp_id'];
$password=$_REQUEST['password'];

$results=mysql_query("UPDATE employee SET password='$password' WHERE eid='$id'");

if($results)
{
echo "1";
}
else
{
echo "0";
}

?>