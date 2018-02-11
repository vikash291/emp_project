<?php
require "admin/db.php";
$id=$_REQUEST['id'];
$task_name=$_REQUEST['task_name'];
$task_desc=$_REQUEST['task_desc'];
$str="UPDATE entrytask SET task_name='$task_name',task_desc='$task_desc' WHERE id='$id'";
$results=mysql_query($str);
if($results)
{
echo "Updated";
}
else
{
echo "not-update";
}
	
?>