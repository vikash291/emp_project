<?php
ob_start();
session_start();  
require "db.php";
include "navbar.php";
if(!$_SESSION['login'])  
{  
    header("location: index.php");  
} 
?>  
<!DOCTYPE html>
<html lang="en">
<head>
<title>Create Task</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   
  <script src="angular.js"></script>
   <style media="screen">
   body{
margin: 0px;
padding: 0px;
background-color:rgba(0,0,0,0.2);
 }
  #div{
  margin-top:1.5%;
  }
.res{
display:inline-block;
}
 
 
  
 
  </style>
<script>
var app =angular.module("myApp",[]);
$("document").ready(function(){

$("ul.nav li a.active").removeClass("active");
$("#createTask").addClass("active");
});

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
app.controller("ngModelCtrl",function($scope,$http,$timeout){

$scope.response="";
$scope.ename="";
$scope.calander="";
$scope.select="";
$scope.tname="";
$scope.tdesc="";
$scope.names=["00.00am-01.00am","01.00am-02.00am","02.00am-03.00am","03.00am-04.00am","04.00am-05.00am","05.00am-06.00am","06.00am-07.00am","07.00am-08.00am","08.00am-09.00am","09.00am-10.00am","10.00am-11.00am","11.00am-12.00pm","12.00pm-01.00pm","01.00pm-02.00pm","02.00pm-03.00pm","03.00pm-04.00pm","04.00pm-05.00pm","05.00pm-06.00pm","06.00pm-07.00pm","07.00pm-08.00pm","08.00pm-09.00pm","09.00pm-10.00pm","10.00pm-11.00pm","11.00pm-00.00am"];
$scope.send=function(){
  
       	$http({
          		method  : 'POST',
          		url:'createTaskAction.php?ename='+$scope.ename+'&date='+$scope.calander+'&taskname='+$scope.tname+'&taskdescription='+$scope.tdesc+'&time='+$scope.select
     		     }).then(function(res)
     			{
                          $scope.response=res.data;
       			  //alert($scope.response);
                          if($scope.response==0)
       			  {
       			     $scope.a="Fields are mandatory";
                             $scope.color="darkred";
                             $timeout(function() {
                                 $scope.a='';
                                  }, 3000);
       			     
       			  }
       			  else if($scope.response==1)
       			  {
                            //alert($scope.response);
       			    $scope.b="Task inserted ";
       			    $scope.ename="";
       			    $scope.calander="";
                            $scope.tname="";
                            $scope.tdesc="";
                            $scope.select="";
                            $scope.color="darkgreen";
                            $timeout(function(){
                              $scope.b="";},3000);
                            
                          
       			}else{
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
  

  




<br><br>
<h2 align="center">EMPLOYEE CREATE TASK</h2>
<hr>




<section>
<div id="div" class="col-sm-6 col-sm-offset-3">
	<form class="form-horizontal" ng-submit="send()">
   
    <div class="form-group">
          <label class="control-label col-sm-3">Emp Name:</label>
            <div class="col-sm-9">
            <select class='form-control' name='date' ng-model='ename'>
            <option value="">Select Name</option> 
             <?php 
                  $sql = "SELECT name from employee";
                  $result = mysql_query($sql);
                  while ($row = mysql_fetch_assoc($result)) {
                  echo "<option value='" . $row['name'] ."'>" . $row['name'] ."</option>";
                  } 
             ?>
             </select>
           </div> 
        </div>
   
    <div class="form-group">
          <label class="control-label col-sm-3">Task Date:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" datepicker 
                placeholder="Choose Date" ng-model="calander">
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
          <input type="text" class="form-control" id="taskName"  ng-model="tname" placeholder="Enter Task Name" name="taskName">
      </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for>Task Description:</label>        
      <div class="col-sm-9">
        <textarea class="form-control" rows="4" id="comment"  ng-model="tdesc"></textarea>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-3 col-sm-9">
        <button type="submit" class="btn btn-primary res">Submit</button>
        <div class="res" style="font-size:18px;color:{{color}}">{{a}}{{b}}{{c}}</div>
      </div>
    </div>
  </form>
</div>
</section>
</body>
</html>