<?php
ob_start();
session_start();  
require "db.php";
if(!$_SESSION['login'])  
{  
    header("location: login.php");  
}
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
  <script src="angular.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
<style>
   body{
margin: 0px;
padding: 0px;
background-color:rgba(0,0,0,0.2);
 }
  #div{
  margin-top:10%;
  
  }
    </style>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
        </button>
        <a class="active navbar-brand" href="welcome.php">Admin-Pannel</h2></a>
      </div>
	  <div class="collapse navbar-collapse" id="myNavbar"> 
      <ul class="nav navbar-nav">
              <li class=""><a href="createEmp.php"><span class="glyphicon glyphicon-user">CreateEmployee</span></a></li>
      <li><a href="createTask.php"><span class="glyphicon glyphicon-tasks">Create-Task</span></a></li>      
      <li  class=""><a href="checkTask.php"><span class="glyphicon glyphicon-tasks">Check-Task</span></a></li>

      <li  class=""><a href="checkTaskGraph.php"><span class="glyphicon glyphicon-stats">Bar-Chart</span></a></li>

      <li><a href="employeeList.php"><span class="glyphicon glyphicon-list-alt">Employee-List</span></a></li>
        </ul>
       
      <div class="navbar-form navbar-right">
           <a href="logout.php"><button class="btn btn-danger">
<span class="glyphicon glyphicon-off" style="font-size:18px">Logout</span></button></a>
      
    </div>
	</div>
  </div>
  </div>
</nav>


<br><br>
<h1 align="center">Admin pannel welcome page</h1>
<hr>
</body>
</html>
