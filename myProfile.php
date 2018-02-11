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
 
  <title>My Profile</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>

<style media="screen">
  .h2head{
    margin-top:-8px;
  }
  .table123{
    background-color: grey;
  }
 
  .imghead{
    margin-top:-20px;
  }
#btn{
margin-left:45%;
}
 body{
margin: 0px;
padding: 0px;
background-color:rgba(0,0,0,0.2);
 }

</style>

  <script>
var app = angular.module('myApp',[]);
app.controller('myctrl',function($scope,$http,$timeout){
//alert('i am in controller');


//SELECT DATA
$scope.getData = function(){
//alert('hi')
$http.get('myProfileAction.php').then(function(res){
//alert(res.data)
$scope.names=res.data;
});
};


//UPDATE PASSWORD
$scope.iid="";
$scope.editData = function(id){
$scope.iid=id
};
$scope.txtpassword="";
$scope.response="";
$scope.updateData = function(password){
$scope.txtpassword=password;
//alert($scope.iid);
//alert($scope.txtpassword);

$http.post('passwordUpdate.php?emp_id='+$scope.iid+'&password='+$scope.txtpassword)
.then(function(res){
//alert(res.data);
$scope.response=res.data;
if($scope.response==1){
   $scope.a="Password Updated";
   $timeout(function() {
                                 $scope.a="";
                                  }, 3000);
   $scope.getData();
   //jQuery.noConflict(); 
   $scope.dismissAlert();
  }
   
})
}
$scope.dismissAlert=function(){
 $('.modal').modal('toggle');
}



});



</script>

</head>
<body ng-app="myApp" ng-controller="myctrl" ng-init="getData()">
<br><br>  
<div class="container-fluid">
<h2 align="center">MY PROFILE</h2>
<hr>
</div>


<div ng-repeat="x in names">
<table class="table table-striped" border="2px">

<tr><th>NAME</th><td>{{x.name}}</td></tr>
<tr><th>ADDRESS</th><td>{{x.address}}</td></tr>
<tr><th>EMAIL ID</th><td>{{x.email}}</td></tr>
<tr><th>MOBILE</th><td>{{x.mobile}}</td></tr>
<tr><th>PASSWORD</th><td>{{x.password}}</td></tr>
<tr><th>CHANGE PASSWORD</th><td><button ng-click="editData(x.eid)" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update</button><span style="color:green"><b> {{a}}<b></span></td></tr>
</table>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div  class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Password</h4>
      </div>
      
      
      <div class="modal-body">
      
       <form class="form-horizontal" name="form1" ng-submit="updateData(txtpassword)" 
        novalidate>
         
         
        
         <div class="form-group">
         <label class="control-label col-sm-2" >New Password</label>
        <div class="col-sm-10">
            <input type="text" name="upassword" class="form-control" ng-model="txtpassword" placeholder="Enter password" ng-required="true">
            
        </div>
      </div>

 
 
    <div class="col-sm-offset-2 col-sm-10">
       <button type="submit" class="btn btn-primary" ng-disabled="form1.$invalid"
        name="button">Submit</button>
    </div>

    </form>
      </div>
      
      <br><br><br><br>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     </div>
    </div>
   </div>
  </div>


<script>
$("document").ready(function(){
$("ul.nav li a.active").removeClass("active");
$("#myProfile").addClass("active");
});
</script>
   
</body>
</html>
