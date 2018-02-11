<?php
ob_start();
session_start();  
require "db.php";
if(!$_SESSION['login'])  
{  
    header("location: login.php");  
} 
?>  
<html>
<head>
<title>Admin-EmpCheckTask</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--<script src="jquery-1.10.2.js"></script>
<script src="jquery.min.js"></script> 

<script src="jquery-ui.js"></script>
<link href="jquery-ui.css" rel="stylesheet">-->


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>

  
<!--<script src="angular.js"></script>-->

<script>


var app =angular.module("myApp",[]);

app.directive('datepicker', function() {
    return {
        restrict: 'EA',
        require : 'ngModel',
        link : function (scope, element, attrs, ngModelCtrl) {
            $(function(){
                element.datepicker({
                    
                    changeYear:true,
                    changeMonth:true,
                    yearRange:"2000:+0",
                    dateFormat:"yy-mm-dd",
                    maxDate:0,
                    onSelect:function (date) {
                        scope.$apply(function () {
                            ngModelCtrl.$setViewValue(date);
                        });
                    }
                });
            });
        }
    }
});

app.controller("ngModelCtrl",function($scope,$http){
//alert("hello");
$scope.id="";
$scope.calander="";
$scope.name="";
$scope.send=function(){
                      $http({
		        method :'POST',
          		url:'checkTaskAction.php?id='+$scope.id+'&calander='+$scope.calander
     		     }).then(function(res)
     			{
     			//alert(res.data);
     			$scope.name=res.data;
       			});
};

});

</script>
</head>
<body ng-app="myApp" ng-controller="ngModelCtrl">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="welcome.php">Admin Pannel</a>
    </div>
    <ul class="nav navbar-nav">
      <!--<li class="active"><a href="#">Home</a></li>-->
      <li><a href="createEmp.php">create employee</a></li>
      <li><a href="checkTask1.php">check task</a></li>
      <li><a href="employeeList1.php">employee list</a></li>
      <li class="pull-right"><a href="logout.php">logout</a></li>
    </ul>
  </div>
</nav>

<h1>Select Employee Details</h1>
<hr>
<div class="container-fluid">
<div class="col-md-6">
 
<form class="form-horizontal" ng-submit="send()">

<!--Employee Id:<input type="number" ng-model="id" id="d2" ><br>-->

        <div class="form-group">
          <label class="control-label col-sm-2" >Emp Id:</label>
            <div class="col-sm-2">
              <?php 
                  $sql = "SELECT eid from employee";
                  $result = mysql_query($sql);
                  echo "<select class='form-control' name='date' ng-model='id'>";
                  while ($row = mysql_fetch_array($result)) {
                  echo "<option value='" . $row['eid'] ."'>" . $row['eid'] ."</option>";
                  }
                  echo "</select>"; 
             ?>
           </div> 
        </div>
        
        
        <div class="form-group">
          <label class="control-label col-sm-2" >Task date:</label>
            <div class="col-sm-2">
                <input type="text" datepicker ng-model="calander">
            </div>
       </div>
       
       
       <div class="form-group">
          <label class="control-label col-sm-2" ></label>
            <div class="col-sm-2">
               <input type="submit" value="send" class="btn btn-info">
           </div>
       </div>
</form>
</div>
</div>
<br>


<div class="container">
<table class="table table-striped">
<tr>
<th>emp id</th>
<th>date</th>
<th>time</th>
<th>task name</th>
<th>task description</th>
</tr>
<tr ng-repeat="x in name">
<td>{{x.eid}}</td>
<td>{{x.date}}</td>
<td>{{x.time}}</td>
<td>{{x.task_name}}</td>
<td>{{x.task_desc}}</td>
</tr>
</table>
</div>
</div>
</body>
</html>
