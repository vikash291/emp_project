<?php
ob_start();
session_start();
$eid=$_SESSION['emp_id'];

require "admin/db.php";


$date=$_SESSION['date'];
//$date=$_REQUEST['date'];

$val=$_REQUEST['v'];
 $time=$_REQUEST['time'];
$taskname=$_REQUEST['taskname'];
$taskdescription=$_REQUEST['taskdescription'];


$query ="INSERT INTO entrytask(id,eid,date,time,task_name,task_desc) VALUES (NULL,'$eid','$date','$time','$taskname','$taskdescription')";

/*$query ="INSERT INTO entrytask(id,eid,date,time,task_name,task_desc) VALUES (NULL,'$eid','$date','$time','$taskname','$taskdescription') WHERE NOT EXISTS (
    SELECT * FROM entrytask WHERE date='$date' and time='$time')";*/
  
$result = mysql_query($query,$con)or die(mysql_error());
if($result)
{
echo "",$val;
}
else
   echo "0";


?>