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
 
  <script>
 
var app = angular.module('myApp',[]);
app.controller('myctrl',function($scope,$http){


//SELECT DATA
$scope.getData = function(){
//alert('hi')
$http.get('employeeListAction.php').then(function(res){
//alert(res.data)
$scope.names=res.data;
});
};



//UPDATE DATA
$scope.editData = function(id,name,address,mobile,email){
$scope.iid=id;
$scope.txtuname=name;
  $scope.txtaddress=address;
  $scope.txtmobile=mobile;
  $scope.txtemail=email;
  };
$scope.updateData = function(name,address,mobile,email){
$http.post('empProfileUpdate.php?id='+$scope.iid+'&name='+name+'&address='+address+'&mobile='+mobile+'&email='+email)
.then(function(res){
alert(res.data);
$scope.getData();
$scope.txtuname="";
  $scope.txtaddress="";
  $scope.txtmobile="";
  $scope.txtemail="";
})
}



//DELETE DATA
$scope.deleteData = function(id){
//alert(id);
if(confirm("Are you sure you want to delete this data ?"))
{
$http.post('profileDelete.php?id='+id)
.then(function(response){
alert(response.data);
$scope.getData();
});
}
else
{
return false;
}
}

});
</script>

</head>
<body ng-app="myApp" ng-controller="myctrl" ng-init="getData()">
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
  
<div class="container">

<table class="table table-striped">
<tr>
<th>eid</th>
<th>name</th>
<th>address</th>
<th>mobile</th>
<th>email</th>
<th>password</th>
<th>update</th>
<th>delete</th>
</tr>
<tr ng-repeat="x in names">
<td>{{x.eid}}</td>
<td>{{x.name}}</td>
<td>{{x.address}}</td>
<td>{{x.mobile}}</td>
<td>{{x.email}}</td>
<td>{{x.password}}</td>
<td><button ng-click="editData(x.id,x.name,x.address,x.mobile,x.email)" class="btn btn-primary" data-toggle="modal" data-target="#myModal">update</button></td>
<td><button ng-click="deleteData(x.id)" class="btn btn-danger">Delete</button></td>
</tr>
</table><br>

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
      
       <form class="form-horizontal" name="form1" ng-submit="updateData(txtuname,txtaddress,txtmobile,txtemail)" 
        novalidate >
         
         
         
         <div class="form-group">
         <label class="control-label col-sm-2" >Name</label>
        <div class="col-sm-10">
            <input type="text" name="uname" class="form-control" ng-model="txtuname" 
            placeholder="Enter username" ng-required="true">
        </div>
      </div>

      
      <div class="form-group">
        <label class="control-label col-sm-2">Address</label>
        <div class="col-sm-10">
        <textarea name="address" class="form-control" ng-model="txtaddress"placeholder="Enter Address"  
        ng-required="true" ></textarea>
        </div>
      </div>



     <div class="form-group">
        <label class="control-label col-sm-2">Mobile Number</label>
        <div class="col-sm-10">
        <input  type="text" name="mobile" class="form-control" ng-model="txtmobile" 
        placeholder="Enter mobile number" ng-required="true">
        </div>
     </div>



     <div class="form-group">
        <label class="control-label col-sm-2">email Id</label>
        <div class="col-sm-10">
        <input  type="email" name="email" class="form-control"  ng-model="txtemail" 
         placeholder="Enter valid email" ng-required="true">
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


