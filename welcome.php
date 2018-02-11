<?php
ob_start();
session_start();  
require "../admin/db.php";
if(!$_SESSION['emp_id'])  
{  
    header("location: login.php");  
} 
?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome-employee</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
 body{
margin: 0px;
padding: 0px;
background-color:rgba(0,0,0,0.2);
 }
</style>
</head>
<body>

<?php include "navbar.php"; ?>
<br><br>  
<div class="container">
<h1 align="center">Employee welcome page</h1>
<hr>
<script>
setTimeout(function(){document.getElementById('div3').style.display = "none";}, 3000);
</script>

<?php 
	if(isset($_GET['idd']))
	{?>
        <div id="div3" class="alert alert-success">
  			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  			<strong>Successfully</strong>  you are logged in!
		</div>
		
  	<?php  
  	}?>

</div>
</body>
</html>
