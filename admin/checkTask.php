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
    
  <title>Check Task</title>  <meta charset="utf-8">
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
  #div{
  margin-top:3%;
  }

  .ename{
  
  position: absolute;
    /*left: 30%;*/
    padding-top: 4px;
    font-weight: 400;
    font-size: larger;
  }
  </style>



<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="angular.js"></script>
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
app.directive('datepicker1', function() {
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
});*/

app.controller("ngModelCtrl",function($scope,$http,$timeout,$window){
//$scope.ename="";


//alert(name);

$scope.calander="";
$scope.calander1="";
$scope.name="";
$scope.response="";
$scope.hide="";
$scope.aa="";
$scope.send=function(){
name=$('.ename').val();
//alert($scope.emname);
                      $http({
		        method :'POST',
          		url:'checkTaskAction.php?ename='+name+'&calander='+$scope.calander+'&calander1='+$scope.calander1
     		     }).then(function(res)
     			{
     			//alert(res.data);
     			$scope.response=res.data;
     			//alert($scope.response);
     				if($scope.response == 1)
     				{
     			
     			         
     			          $scope.name="";
                                  $scope.hide="No data present";
                                  $timeout(function() {
                                 $scope.hide='';
                                  }, 3000);

                               }
                               else if($scope.response == 0)
                               {
                                  $scope.a="Fields are mandatory";
                                   $timeout(function() {
                                 $scope.a='';
                                  }, 3000);
                               }
                               else
                               {
                                  $scope.name=$scope.response; 
                                  

                               }                      
       			});
};

$scope.print=function(){
//alert(name);
$window.open('taskPrint.php?ename='+name+'&calander='+$scope.calander+'&calander1='+$scope.calander1);
};

//UPDATE DATA
$scope.editData = function(id,taskname,taskdesc){
$scope.iid=id
$scope.txt_task_name=taskname;
  $scope.txt_task_desc=taskdesc;
  };
$scope.updateData = function(task_name,task_desc){
$http.post('taskUpdate.php?id='+$scope.iid+'&task_name='+task_name+'&task_desc='+task_desc)
.then(function(res){
alert(res.data);
$scope.send();
$scope.txt_task_name="";
  $scope.txt_task_desc="";
  jQuery.noConflict();
 $scope.dismissAlert();

  })
};
$scope.dismissAlert=function(){

 $('#myModal').modal('toggle');
}
});


</script>
</head>

<body ng-app="myApp" ng-controller="ngModelCtrl">



<br><br>
<h2 align="center">EMPLOYEE CHECK TASK</h2>
<hr>


<div class="container-fluid" id="div">
<div class="col-sm-6 col-sm-offset-3">
 
<form class="form-horizontal" ng-submit="send()">

<!--Employee Id:<input type="number" ng-model="id" id="d2" ><br>-->


         
        <div class="form-group">
          <label class="control-label col-sm-3">Emp Name:</label>
            <div class="col-sm-9">
               <?php 
if(!isset($_REQUEST['eid'])){
                  $sql = "SELECT name from employee";
                  $result = mysql_query($sql);
                  echo "<select class='ename form-control'>";
                 
                  while ($row = mysql_fetch_array($result)) {
                  echo "<option  value='" . $row['name'] ."'>" . $row['name'] ."</option>";
                  }
                  echo "</select>"; 
}
else{
$qs=$_REQUEST['eid'];
$sql = "SELECT name from employee where eid=$qs";
$data1=mysql_query($sql);
$rec1=mysql_fetch_row($data1);
$em_name=$rec1[0];
echo $em_name;
echo "<input type='hidden' class='ename form-control' value=$em_name>";
}
             ?>
           </div> 
        </div>
        
    
  
        <div class="form-group">
          <label class="control-label col-sm-3">From Date:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="frm" ng-model="calander">
            </div>
       </div>
       
 <div class="form-group">
          <label class="control-label col-sm-3">To Date:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="rtn" ng-model="calander1">
            </div>
       </div>
       
       
       <div class="form-group">
          <label class="control-label col-sm-3" ></label>
            <div class="col-sm-9">
               <input type="submit" value="Submit" class="btn btn-primary">
               <input type="submit" ng-click="print()" value="Print" class="btn btn-danger">
           </div>
       </div>
</form>
</div>
</div>
<br>


<div class="container">
<h2 style="color:darkred">{{a}}</h2>
<h2 style="color:darkred">{{hide}}</h2>
<h2 style="color:darkred">{{aa}}</h2>
<table id="example" class="table table-striped" style="">
     <thead>
    	 <tr>
    	 <th>DATE</th>
         <th>TIME</th>
         <th>TASK NAME</th>
         <th>TASK DESCRIPTION</th>
         <th>MODIFY</td>
         
         </tr>
     </thead>
     <tbody>
	<tr ng-repeat="x in name">
	<td>{{x.date}}</td>
        <td>{{x.time}}</td>
        <td>{{x.task_name}}</td>
        <td>{{x.task_desc}}</td>
        <td><button ng-click="editData(x.id,x.task_name,x.task_desc)" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update</button>
        </td>
        
	</tr>
      </tbody>
</table>

</div>



<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Employees Data</h4>
      </div>
      
      
      
      
      
      <div class="modal-body">
      
       <form class="form-horizontal" name="form1" ng-submit="updateData(txt_task_name,txt_task_desc)" 
        novalidate>
         
         
         
         <div class="form-group">
         <label class="control-label col-sm-2" >Task name</label>
        <div class="col-sm-10">
            <input type="text" name="taskname" class="form-control" ng-model="txt_task_name" 
            placeholder="Enter task name" ng-required="true">
        </div>
      </div>

      
      <div class="form-group">
        <label class="control-label col-sm-2">Task description</label>
        <div class="col-sm-10">
        <textarea name="taskdesc" class="form-control" ng-model="txt_task_desc" placeholder="Enter task description"  
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

    

  
</body>
</html>
