<?php
require "db.php";
$eid=$_REQUEST['eid'];

$output = array();
$query= "select * from entrytask where eid='$eid' order by date asc";
$result = mysql_query($query) or die(mysql_error());
$num_rows = mysql_num_rows($result);


$que="select name from employee where eid='$eid'";
$res=mysql_query($que) or die(mysql_error());
$row1=mysql_fetch_object($res);
$name=$row1->name;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  function update(id){
  alert(id);
  }
  </script>
</head>
<body>
<div class="container">
<br>
<table border="1" align="center">
<tr>
<td>NAME: <?php echo $name;?></td>
</tr>
</table>
<br>

<table>
<td></td>
<td></td>
</table>
<table class='table table-stripped' border='1'>
<thead>
<th>DATE</th>
<th>TIME</th>
<th>TASK NAME</th>
<th>TASK DESCRIPTION</th>
<th>MODIFY</th>
</thead>
<?php
if($num_rows > 0)
{
while($row = mysql_fetch_row($result))
{?>
<tbody>
<tr>
<td><?php echo $row[2];?></td>
<td><?php echo $row[3];?></td>
<td><?php echo $row[4];?></td>
<td><?php echo $row[5];?></td>
<td><input class="btn btn-primary" type="button" value="modify" onclick="update(<?php echo $row[0];?>)"></td>
</tr>
</tbody>
<?php
}
}
?>
<table><br>
<button onclick="fun1()" type="button" class="btn btn-primary">Go Back</button>
<button onclick="myFunction()" type="button" class="btn btn-danger pull-right">Print</button>

<script>
function myFunction() {
    window.print();
}
function fun1(){
window.location.href='employeeList.php';
}
</script>

</body>
</html>