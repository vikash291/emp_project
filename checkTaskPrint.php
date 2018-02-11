<?php
ob_start();
session_start();  
require "admin/db.php";
$eid=$_SESSION['emp_id'];
$date=$_REQUEST['calander'];
$date1=$_REQUEST['calander1'];


$query= "select * from entrytask where date between '$date' and '$date1' and eid='$eid' order by date asc";
$result=mysql_query($query) or die(mysql_error());

$query2="select name from employee where eid='$eid'";
$result2=mysql_query($query2) or die(mysql_error());
$row2 = mysql_fetch_object($result2);
$ename=$row2->name;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Print</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<body>

<div class="container">
<table class="display" cellspacing="0"  align="center">
<tr><td><th align="right">NAME :</th></td><td><?php echo $ename; ?></td></tr>
<tr><td><th align="right">FROM :</th></td><td><?php echo $date; ?></td></tr>
<tr><td><th align="right">TO :</th></td><td><?php echo $date1; ?></td></tr>
</table>
<br>
<table border="2" id="example" class="display" cellspacing="0" width="100%">
	 <thead>
    	 <tr> 
             <th>Date</th>
             <th>Time</th>
             <th>Task Name</th>
             <th>Task Description</th>
         </tr>
  	 </thead>
     <tbody>
	 <?php 
		while($row = mysql_fetch_object($result))
		{
	 ?>
	 <tr>
            <td><?php echo $row->date; ?></td>
            <td><?php echo $row->time; ?></td>
            <td><?php echo $row->task_name; ?></td>
            <td><?php echo $row->task_desc; ?></td>
        </tr>

	   <?php
  	}
	  ?>
      </tbody>
	</table><br>
<button onclick="fun1()" type="button" class="btn btn-primary">Go Back</button>
<button onclick="myFunction()" type="button" class="btn btn-danger pull-right">Print</button>

<script>
function myFunction() {
    window.print();
}
function fun1(){
window.location.href='checkTask.php';
}
</script>

</body>
</html>