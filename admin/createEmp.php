<?php
ob_start();
session_start();  
require "db.php";
require "navbar.php";
if(!$_SESSION['login'])  
{  
    header("location: index.php");  
}

?>  
<!DOCTYPE html>
<html lang="en">
<head>
    
  <title>Create Employee</title>
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
.c1{
color:red;
}
body{
margin: 0px;
padding: 0px;
background-color:rgba(0,0,0,0.2);
 }
 .res{
 display:inline-block;
 }
 #div{
 margin-top:3%;
 }

  
</style>

  <script>

  var app=angular.module("myApp",[]);
         
        

  $("document").ready(function(){

$("ul.nav li a.active").removeClass("active");
$("#createEmp").addClass("active");
});

 
  app.controller("demoCtrl",function($scope,$http,$timeout){
  $scope.txtuname="";
  $scope.txtaddress="";
  $scope.txtmobile="";
  $scope.txtemail="";
  $scope.a="";
  $scope.color="";
  
 
  
 $scope.submitForm = function() 
{
alert("hi");
/*var name = $("#emp_uname").val();
var email = $("#emp_email).val();
var addr $("#)
var mobile_num*/

           
    $http({
          method  : 'POST',
 url     : 'createEmpAction.php?name='+$scope.txtuname+'&address='+$scope.txtaddress+'&mobile='+$scope.txtmobile+'&email='+$scope.txtemail
        
                        

         }).then(function(response) {
         alert(response.data);
if(response.data == 0){
$scope.b="Fields are mandatory";
$timeout(function() {
            $scope.b='';
    }, 3000);


$scope.color="darkred";

}        else if(response.data == 1){
        $scope.a="Employee created";
        $scope.color="darkgreen";
	//$(".formData").trigger("reset");
	$( '.formData' ).each(function(){
    this.reset();
     $timeout(function() {
            $scope.a='';
    }, 3000);
});
}
else
{
$scope.c="Duplicate emails are not allowed";
  $timeout(function() {
            $scope.c='';
    }, 3000);
   $scope.color="darkred";
}
          });

        }
       
       
    });    
    
    
  
</script>

</head>
<body ng-app="myApp">
<br><br>
<h2 align="center">CREATE EMPLOYEE</h2>
<hr>

<div class="container-fluid" id="div">
<div class="col-sm-6 col-sm-offset-3">
<form method="post" action="createEmpAction.php" name="form1" class="form-horizontal" enctype="multipart/form-data" novalidate >
<div class="form-group">
        <label class="control-label col-sm-3" >Name</label>
        <div class="col-sm-9">
        <input type="text" name="uname" id="emp_uname" class="form-control" ng-model="txtuname" placeholder="Enter Username" ng-required="true" <?php if(isset($_REQUEST['subid'])){echo "value=".$_SESSION['emp_name'];}else{echo"value=''";}?>>
        <span class="c1" ng-show="form1.uname.$error.required && form1.uname.$dirty">Employee name is required</p>
        </span>
  </div></div>

<div class="form-group">
        <label class="control-label col-sm-3">Photo</label>
        <div class="col-sm-9">
         <input type="file" class="form-control" file-input="files" name="f1" id="emp_photo" ng-required="true"/>  
	  <span class="c1" ng-show="form1.address.$error.required && form1.address.$dirty">Address is required</span>

        </div>
  </div>


<div class="form-group">
        <label class="control-label col-sm-3">Address</label>
        <div class="col-sm-9">
        <textarea name="address" class="form-control" id="emp_address" ng-model="txtaddress" placeholder="Enter Address"  ng-required="true" <?php if(isset($_REQUEST['subid'])){echo "value=".$_SESSION['emp_add'];}else{echo"value=''";}?> ></textarea>
         <span class="c1" ng-show="form1.address.$error.required && form1.address.$dirty">Address is required</span>

        </div>
  </div>

<div class="form-group">
        <label class="control-label col-sm-3">Mobile Number</label>
        <div class="col-sm-9">
        <input  type="text" ng-pattern="/^[7-9][0-9]{9}$/" name="mobile" class="form-control" id="emp_mobile" ng-model="txtmobile" placeholder="Enter Mobile Number" ng-required="true" maxlength="10" <?php if(isset($_REQUEST['subid'])){echo "value=".$_SESSION['emp_name'];}else{echo"value=''";}?>>
        <span class="c1" ng-show="form1.mobile.$error.required && form1.mobile.$dirty">mobile number is required</span>
<span class="c1" ng-show="form1.mobile.$error.pattern && form1.mobile.$dirty">enter 10 digit valid mobile number</span>
        </div>
  </div>




<div class="form-group">
        <label class="control-label col-sm-3">Email Id</label>
       <div class="col-sm-9">
        <input  type="email" name="email" class="form-control"
ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/" ng-model="txtemail" id="emp_email" placeholder="Enter Valid Email"
ng-required="true" <?php if(isset($_REQUEST['subid'])){echo "value=".$_SESSION['emp_name'];}else{echo"value=''";}?>>
        <span class="c1" ng-show="form1.email.$error.required && form1.email.$dirty"> email Id is required</span>
<span class="c1" ng-show="form1.email.$error.pattern && form1.email.$dirty"> enter valid email Id</span>
  </div>
  </div>
 <div class="col-sm-offset-3 col-sm-9">
<button type="submit" class="btn btn-primary res" name="button" id="button" ng-disabled="form1.$invalid">Submit</button> <p class="res" id="mand" style='color:darkred;font-size:18px'></p>
<?php
if(isset($_REQUEST['subid'])){
echo "<span style='color:red;font-size:18px'>Field need new entry</span>";

} ?>
</div>
<div class="res"style="font-size:18px;color:{{color}}">{{a}}{{b}}{{c}}</div>
</div>
    </form>
</div>


</body>
</html>
