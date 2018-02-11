<?php
$eid=$_REQUEST['emp_id'];

require "admin/db.php";

$date=$_REQUEST['date'];
$time=$_REQUEST['time'];
$taskname=$_REQUEST['taskname'];
$taskdescription=$_REQUEST['taskdescription'];
if($date==''||$time==''||$taskname==''||$taskdescription=='')
{
echo "fields are mandatory";
}
else
{  

$query ="INSERT INTO entrytask(id,eid,date,time,task_name,task_desc) VALUES (NULL,'$eid','$date','$time','$taskname','$taskdescription')"; 
   $result = mysql_query($query,$con)or die(mysql_error());
if($result){
echo "inserted";
}
else
{
echo "not-inserted";
}
}
?>