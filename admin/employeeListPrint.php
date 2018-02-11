<?php
require_once "db.php";
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

<body>

<div class="container">
<h2 align="center">Employee List</h2><hr>

<table border="2" id="example" class="display" cellspacing="0" width="100%">
	 <thead>
    	 <tr> 
             <th>emp_id</th>
             <th>emp_name</th>
             <th>emp_address</th>
             <th>emp_mobile</th>
             <th>emp_email</th>
             <th>emp_password</th>
         </tr>
  	 </thead>
     <tbody>
	 <?php 
	        $results = mysql_query("SELECT * FROM employee");
                while($row = mysql_fetch_object($results))
		{
	 ?>
	 <tr>
            <td><?php echo $row->eid; ?></td>
            <td><?php echo $row->name; ?></td>
            <td><?php echo $row->address; ?></td>
            <td><?php echo $row->mobile; ?></td>
            <td><?php echo $row->email; ?></td>
            <td><?php echo $row->password; ?></td>
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
window.location.href='employeeList.php';
}
</script>

</body>
</html>