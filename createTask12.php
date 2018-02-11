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
<title>create task</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   
  <script src="angular.js"></script>
  
 <style>
 body{
margin: 0px;
padding: 0px;
background-color:rgba(0,0,0,0.2);
 }
  #div1{
  	position: relative;
    top: 6px;
  }
  #div{
  margin-top:0%;
  }
  
   .res{
   display:inline-block;
   } 
</style>

  
    
<?php 
$_SESSION['date'] = @date("Y-m-d");
 ?>

<script>
var app =angular.module("myApp",[]);
app.controller("ngModelCtrl",function($scope,$http,$timeout){
$scope.a=""
$scope.id="";
$scope.color="";
//$scope.calander="";
$scope.tname='';
$scope.tdesc='';
$scope.select='';
$scope.response="";
$scope.names=["00.00am-01.00am","01.00am-02.00am","02.00am-03.00am","03.00am-04.00am","04.00am-05.00am","05.00am-06.00am","06.00am-07.00am","07.00am-08.00am","08.00am-09.00am","09.00am-10.00am","10.00am-11.00am","11.00am-12.00pm","12.00pm-01.00pm","01.00pm-02.00pm","02.00pm-03.00pm","03.00pm-04.00pm","04.00pm-05.00pm","05.00pm-06.00pm","06.00pm-07.00pm","07.00pm-08.00pm","08.00pm-09.00pm","09.00pm-10.00pm","10.00pm-11.00pm","11.00pm-00.00am"];
//$scope.date = new Date();

$scope.send=function(){
	//$scope.calander=(document.getElementById('div1').innerHTML);
    
       	
                   $http({
          		method  : 'POST',
          		url:'createTaskAction.php?taskname='+$scope.tname+'&taskdescription='+$scope.tdesc+'&time='+$scope.select
     		     }).then(function(res)
     			{
       			  
                           
     			$scope.response=res.data;
     			if($scope.response == 0)
     				{
     			
     			          $scope.a="Fields are mandatory"; 
                                  $scope.color="darkred";

     			           $timeout(function() {
                                 $scope.a="";
                                  }, 3000);
                               }
                               
                               else if($scope.response==1)
                               {  $scope.color="darkgreen";
                                  $scope.b="Task Inserted";
                                  $scope.calander="";
                                  $scope.tname="";
                                  $scope.tdesc="";
                                  $scope.select="";
                                  
                             
                                   $timeout(function() {
                                 $scope.b='';
                                  }, 3000);
                               }
                              else{
                           $scope.c="Duplicate times are not allowed";
                           $scope.color="darkred";
                           
                            $timeout(function() {
                                 $scope.c='';
                                  }, 3000);
                           }

                                                            
                	});
      
};

});



</script>

</head>
<body ng-app="myApp" ng-controller="ngModelCtrl">

<?php include "navbar.php"; ?>  

<br><br>  
<div class="container-fluid">
<h1 align="center">Create Task</h1>
<hr>
</div>
  
    <section>
  
  <div id="div" class="col-sm-6 col-sm-offset-3">
	<form class="form-horizontal" ng-submit="send()">
   
      
    <div class="form-group">
      <label class="control-label col-sm-3">Current Date:</label>
      <div class="col-sm-9">
        <!--<span id="div1" class="form-control-static">{{date | date:'yyyy-MM-dd'}}</span></td>-->
        <span id="div1" class="form-control-static"><?php echo $_SESSION['date']; ?></span>
      </div>
    </div>
    
    
    <div class="form-group">
      <label class="control-label col-sm-3">Select Time:</label>
      <div class="col-sm-9">          
        <select class="form-control" ng-model="select" ng-options="item for item in names">
        <option value="">Select time</option>
      </select>
      </div>
    </div>
    
    
    <div class="form-group">
    <label class="control-label col-sm-3" for="taskName">Task Name:</label>        
      <div class=" col-sm-9">
          <input type="text" class="form-control" id="taskName"  ng-model="tname" placeholder="Enter Task Name">
      </div>
    </div>
    
    
    <div class="form-group">
    <label class="control-label col-sm-3" for>Task Description:</label>        
      <div class="col-sm-9">
        <textarea class="form-control" rows="4" id="comment" name="coment" ng-model="tdesc"></textarea>
      </div>
    </div>
 
    
    
    <div class="form-group">        
      <div class="col-sm-offset-3 col-sm-9">
        <button type="submit" class="btn btn-primary res">Submit</button>
        <div style="color:{{color}};font-size:18px;" class="res">{{a}}{{b}}{{c}}</div>
     </div>
    </div>

  </form>
  
  

</div>
</section>
<script>
$(function() {
$("ul.nav li a.active").removeClass("active");
$("#Createtask").addClass("active");
});
</script>
</body>

</html>