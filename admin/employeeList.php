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
    
  <title>Employee List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="angular.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  
<style>
  .c1{
color:red;
}
body{
margin: 0px;
padding: 0px;
background-color:rgba(0,0,0,0.2);
 }


.showImg {
  position: relative;

}
.showImg img{
  z-index:-1;
}
.showImg figure {
  width:150px;
  height:150px;
  display: none;
  position: absolute;
  top: 2em;
  left: 1em;
  padding: 0;
  margin: 0;
  background: transparent;
  border-radius: 1em;
}

.showImg figure img {
  display: block;
  border-radius: 0.8em;
  max-width: 100%;
  height: auto;
}

/*.showImg img {
  display: block;
  border-radius: 0.8em;
  max-width: 100%;
  height: auto;
}*/

.showImg:focus figure,
.showImg:hover figure {
  display: block;
  z-index:10;
}
/*.showImg:focus ,
.button:hover p {
  background: red;
}
.showImg{


}*/
</style>

<script>
var app = angular.module('myApp',[]);
app.controller('myctrl',function($scope,$http,$window){
$scope.search="";
$scope.hide=false;


$scope.checkTask=function(eid){
$window.location.href='checkTask.php?eid='+eid;
//alert(eid);
}


$scope.checkTaskGraph=function(eid){
$window.location.href='checkTaskGraph.php?eid='+eid;
//alert(eid);
}

$scope.changePic=function(val){
//alert(val);
window.location = "change_image.php?id="+val;
}

//SELECT DATA
$scope.getData = function(){
//alert('hi')
$http.get('employeeListAction.php').then(function(res){
//alert(res.data)
$scope.names=res.data;
});
};



//UPDATE DATA
$scope.iid;
$scope.editData = function(id,name,address,mobile,email){

$scope.iid=id
$scope.txtuname=name;
  $scope.txtaddress=address;
  $scope.txtmobile=mobile;
  $scope.txtemail=email;

//alert($scope.iid);
//alert($scope.txtuname);
//alert($scope.txtaddress);
//alert($scope.txtmobile);
//alert($scope.txtemail);


  };
$scope.updateData = function(name,address,mobile,email){
$http.post('profileUpdate.php?id='+$scope.iid+'&name='+name+'&address='+address+'&mobile='+mobile+'&email='+email)
.then(function(res){
alert(res.data);
$scope.getData();
$scope.txtuname="";
  $scope.txtaddress="";
  $scope.txtmobile="";
  $scope.txtemail="";
 $scope.hide=true;
 jQuery.noConflict();
 $scope.dismissAlert();
  
})
}
$scope.dismissAlert=function(){
 $('.modal').modal('toggle');
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

$scope.print=function(){
//alert($scope.ename);
$window.open('employeeListPrint.php');

};

});
</script>

</head>
<body ng-app="myApp" ng-controller="myctrl" ng-init="getData()">


<br><br>
<h2 align="center">EMPLOYEE LIST</h2>
<hr>

<div class="container tbl">
<div class="pull-right">Search by name:<input type="text" ng-model="search"></div><br><br>
<table class="table table-responsive table-stripped ">
     <thead class="table table-inverse">
    	 <tr>
         <th>Photo</th>
         <th>NAME</th>
         <th>ADDRESS</th>
         <th>MOBILE</th>
         <th>EMAIL</th>
         <th>PASSWORD</th>
         <th>TASK</th>
         <th>GRAPH</th>
         <th>UPDATE</th>
         <th>DELETE</th>
         </tr>

       </thead>
       <tbody>
	<tr ng-repeat="x in names | filter:{'name':search}">
        <td class="showImg"><img ng-src="profpic/{{x.photo}}" width="50" height="50"><figure>
    <img ng-src="profpic/{{x.photo}}" alt="photo" ng-click="changePic(x.eid)">
    </figure></td>
        <td>{{x.name}}</td>
        <td>{{x.address}}</td>
        <td>{{x.mobile}}</td>
        <td>{{x.email}}</td>
        <td>{{x.password}}</td>
        <!--<td><input class="btn btn-primary" type="button" value="TASK" ng-click="checkTask(x.eid)"></td>--->
        <!--<td><input class="btn btn-success" type="button" value="GRAPH" ng-click="checkTaskGraph(x.eid)"></td>-->
	<!--<td><img src="update1.jpg" style="height:40;width:50;" ng-click="editData(x.eid,x.name,x.address,x.mobile,x.email)" class="btn btn-primary" data-toggle="modal" data-target="#myModal"></button></td>-->
<!---  <img src="delete.jpg" style="height:40;width:50;" ng-click="deleteData(x.eid)" class="btn btn-danger">  --->

        
        <td><i style="color:cornflowerblue" class="fa fa-tasks fa-lg" ng-click="checkTask(x.eid)"></i></td>
        <td><i style="color:#ea8436" class="fa fa-bar-chart fa-lg" ng-click="checkTaskGraph(x.eid)"></i></td>
        <td><i style="color:teal" class="fa fa-pencil-square-o fa-lg" ng-click="editData(x.eid,x.name,x.address,x.mobile,x.email)" data-toggle="modal" data-target="#myModal"></i></td>
        <td><i style="color:#e05454" class="fa fa-trash fa-lg" ng-click="deleteData(x.eid)"></i></td>
	</tr>
      </tbody>
</table>
<input type="submit" ng-click="print()" value="Print" class="btn btn-danger">
</div>

   
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div  class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Employees Data</h4>
      </div>
      
      
      
      
      
      <div class="modal-body">
      
       <form class="form-horizontal" name="form1" ng-submit="updateData(txtuname,txtaddress,txtmobile,txtemail)" 
        novalidate>
         <div class="form-group">
         <label class="control-label col-sm-2" >Name</label>
        <div class="col-sm-10">
            <input type="text" name="uname" class="form-control" ng-model="txtuname" 
            placeholder="Enter username" ng-required="true">
            <span class="c1" ng-show="form1.uname.$error.required && form1.uname.$dirty">Employee name is required</span>
        </p>
        </div>
      </div>

      
      <div class="form-group">
        <label class="control-label col-sm-2">Address</label>
        <div class="col-sm-10">
        <textarea name="address" class="form-control" ng-model="txtaddress"placeholder="Enter Address"  
        ng-required="true" ></textarea>
        <span class="c1" ng-show="form1.address.$error.required && form1.address.$dirty">Address is required</span>
        </div>
      </div>



     <div class="form-group">
        <label class="control-label col-sm-2">Mobile Number</label>
        <div class="col-sm-10">
        <input  type="text" name="mobile" class="form-control" ng-pattern="/^[7-9][0-9]{9}$/" ng-model="txtmobile" 
        placeholder="Enter mobile number" ng-required="true">
          <span class="c1" ng-show="form1.mobile.$error.required && form1.mobile.$dirty">mobile number is required</span>
<span class="c1" ng-show="form1.mobile.$error.pattern && form1.mobile.$dirty">enter 10 digit valid mobile number</span>
        </div>
        </div>
     



     <div class="form-group">
        <label class="control-label col-sm-2">email Id</label>
        <div class="col-sm-10">
        <input  type="email" name="email" class="form-control" ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/" ng-model="txtemail" 
         placeholder="Enter valid email" ng-required="true">
         <span class="c1" ng-show="form1.email.$error.required && form1.email.$dirty"> email Id is required</span>
<span class="c1" ng-show="form1.email.$error.pattern && form1.email.$dirty"> enter valid email Id</span>
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



  
    
