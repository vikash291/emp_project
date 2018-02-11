<?php
require "db.php";

$ename=$_REQUEST['ename'];
$date=$_REQUEST['date'];
$time=$_REQUEST['time'];
$taskname=$_REQUEST['taskname'];
$taskdescription=$_REQUEST['taskdescription'];

	    $results = mysql_query("SELECT * FROM employee where name='$ename'");
 		$row = mysql_fetch_object($results);
 		$eid= $row->eid;


if($ename==''||$date==''||$time==''||$taskname==''||$taskdescription=='')
{
      echo "0";
}
else
{  

     
      $query ="INSERT INTO entrytask(id,eid,date,time,task_name,task_desc) VALUES (NULL,'$eid','$date','$time','$taskname','$taskdescription')";
      $result = mysql_query($query,$con)or die(mysql_error());
      if($result)
      {
           echo "1";
      }
      else
      {
           echo "2";
      }
}

?>