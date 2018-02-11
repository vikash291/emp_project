<?php
ob_start();
session_start();  
require "admin/db.php";
include "navbar.php";
if(!$_SESSION['emp_id'])  
{  
    header("location: index.php");  
} 
?>  
<!DOCTYPE html>
<html lang="en">
<head>
<title>Check Task</title>
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
.res{
display:inline-block;
}
  /*th{
background-color:blue;
color:white;
}
/*
table tr:nth-child(odd) {
  background-color: red;
}
table tr:nth-child(even) {
  background-color: lightgray;
}*/

  
  #div
  {
  margin-top:0%;
 
  }
</style>
<script>
var app =angular.module("myApp",[]);
$("document").ready(function(){

$("ul.nav li a.active").removeClass("active");
$("#checkTask").addClass("active");

$("#frm").datepicker({

dateFormat:"yy-mm-dd",
maxDate:0,
changeYear:true,
changeMonth:true,

onClose:function(sdt){
$("#rtn").datepicker({
dateFormat:"yy-mm-dd",
maxDate:0,
changeYear:true,
changeMonth:true
})
$("#rtn").datepicker("option","minDate",sdt)


}
})
})

/*app.directive('datepicker', function() {
    return {
        restrict: 'EA',
        require : 'ngModel',
        link : function (scope, element, attrs, ngModelCtrl) {
            $(function(){
                element.datepicker({
                    
                    changeYear:true,
                    changeMonth:true,
                    yearRange:"2017:+2",
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

app.directive('datepicker1', function() {
    return {
        restrict: 'EA',
        require : 'ngModel',
        link : function (scope, element, attrs, ngModelCtrl) {
            $(function(){
                element.datepicker({
                    
                    changeYear:true,
                    changeMonth:true,
                    yearRange:"2017:+2",
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
});*/
app.controller("myCtrl",function($scope,$http,$timeout,$window){
$scope.selectDate="";
$scope.selectDate1="";
$scope.xx=true;
$scope.name="";
$scope.hide="";
$scope.resDate="";

$scope.date = new Date();

$scope.print=function(){
$window.open('checkTaskPrint.php?calander='+$scope.selectDate+'&calander1='+$scope.selectDate1);
};

   
	$scope.send=function(){
	$scope.currentDate=(document.getElementById('div1').innerHTML);
    //alert($scope.currentDate);
   // alert($scope.selectDate1);
    
                     $http({
          		method  : 'POST',
          		url:'checkTaskAction.php?currentDate='+$scope.selectDate+'&currentDate1='+$scope.selectDate1
     		     }).then(function(res1)
     			{
     			//alert(res1.data);
     			//alert(res1.data.length);

     			//alert($scope.resDate);
     			                         
     			
     			if(res1.data == 0)
     			{
     			//alert("no records is present in database");
     			   $scope.name="";
     			   $scope.hide="No records found";
     			   $timeout(function() {
                           $scope.hide='';
                           }, 3000);
     			}
                        else if(res1.data==1)
                        {
                           $scope.a="Please select from date";
                           $timeout(function() {
                           $scope.a='';
                           }, 3000);
                        }
                        else if(res1.data==2)
                        {
                           $scope.a="Please select to date";
                           $timeout(function() {
                           $scope.a='';
                           }, 3000);
                        }
                        else
                        {
                           $scope.name=res1.data; 
                           
                           
                        } 
                       
                                                   
       			});
       		
       		
        	
};


//UPDATE DATA
$scope.editData = function(id,task_name,task_desc)
                  {
                      $scope.iid=id
                      $scope.txtTaskName=task_name;
                      $scope.txtTaskDesc=task_desc;
                  };
$scope.updateData = function(task_name,task_desc)
                    {
                     // alert($scope.iid);
                      //alert(task_desc);
                      //alert(task_name);
                   $http({
                   method:'POST',
                   url:'taskUpdate.php?id='+$scope.iid+'&task_name='+task_name+'&task_desc='+task_desc
                   }).then(function(res){
                   //alert(res.data);
                   
                   $scope.send();
                    $scope.txtTaskName="";
                      $scope.txtTaskDesc="";
                      jQuery.noConflict(); 
                   $scope.dismissAlert();
                   
                   
                  })
                   }
               
 $scope.dismissAlert=function(){
 $('.modal').modal('toggle');
}



});
</script>
</head>
<body ng-app="myApp" ng-controller="myCtrl">
 

<br><br>  
<div class="container">
<h2 align="center">CHECK TASK</h2>
<hr>
</div>





  
<div class="container" id="div">

<form ng-submit="send()" class="form-horizontal">
    
      <span ng-hide="true"> Current Date:<span id="div1">{{date | date:'yyyy-MM-dd'}}</span></span>

        <div class="form-group">
        <label  class="control-label col-sm-2">From Date:</label>
        <div class="col-sm-10">
        <input type="text" id="frm" ng-model="selectDate">
        
        </div>
        </div>
         <div class="form-group">
        <label  class="control-label col-sm-2">To Date:</label>
        <div class="col-sm-10">
        <input type="text" id="rtn" ng-model="selectDate1">
        
        </div>
        </div>
        
        
       <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" value="submit" class="btn btn-primary res">Submit</button>
        <input type="submit" ng-click="print()" value="Print" class="btn btn-danger">
        <div class="res" style="color:darkred;font-size:18px;">{{hide}}{{a}}</div>

      </div>
    </div>

</form>

<?php include_once "navbar.php"; ?>



<div class="container">
<table class="table table-striped">
<tr>
<th>DATE</th>
<th>TIME</th>
<th>TASK NAME</th>
<th>TASK  DESCRIPTION</th>
<th>MODIFY TASK</th>

</tr>
<tr ng-repeat="x in name">

<td>{{x.date}}</td>
<td>{{x.time}}</td>
<td>{{x.task_name}}</td>
<td>{{x.task_desc}}</td>

<td><button ng-if='currentDate==x.date' ng-click="editData(x.id,x.task_name,x.task_desc)" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update</button></td>

</tr>
</table>
</div>



<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modify Task</h4>
      </div>
      
      
      
      
      
      <div class="modal-body">
      
       <form class="form-horizontal" name="form1" ng-submit="updateData(txtTaskName,txtTaskDesc)" 
        novalidate >
         
         
         
         <div class="form-group">
         <label class="control-label col-sm-2" >Task Name</label>
        <div class="col-sm-10">
            <input type="text" name="taskname" class="form-control" ng-model="txtTaskName" 
            placeholder="Task Name" ng-required="true">
        </div>
      </div>

      
      <div class="form-group">
        <label class="control-label col-sm-2">Task Description</label>
        <div class="col-sm-10">
        <textarea name="taskdesc" class="form-control" ng-model="txtTaskDesc"placeholder="Task Description"  
        ng-required="true" ></textarea>
        </div>
      </div>





 
    <div class="col-sm-offset-2 col-sm-10">
       <button type="submit" class="btn btn-primary" 
        name="button">Submit</button>
    </div>

    </form>
      </div>
      
      <br><br>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
   </div>
  </div>
  
  
  </div>
<script>
$(function() {
$("ul.nav li a.active").removeClass("active");
$("#checkTask").addClass("active");
});
</script>
</body>
</html>