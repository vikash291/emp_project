<?php
require "admin/db.php";
$id=$_REQUEST['emp_id'];
$task_name=$_REQUEST['emp_taskname'];
$task_desc=$_REQUEST['emp_taskDesc'];
$str="UPDATE entrytask SET task_name='$task_name',task_desc='$task_desc' WHERE id='$id'";
$results=mysql_query($str);
if($results)
{
echo "updated";
}
else
{
echo "not-update";
}
	
?>