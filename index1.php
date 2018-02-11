<?php

header("location:login.php");

?>

<!---<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
  <script>
  var app=angular.module("myApp",[]);
  app.controller("myCtrl",function($scope,$http,$window){
	  $scope.email="";
	  $scope.password="";
	  $scope.send=function(){
		  $http({
			  method:"POST",
			  url:'loginAction.php?em='+$scope.email+'&pwd='+$scope.password
		  }).then(function(res){
			  //alert(res.data);
			  if(res.data=="0"){
				  alert("fields_are_mandatory");
			  }else if(res.data=="1"){
				  $window.location.href = 'welcome.php';
			  }else{
				  $window.location.href = 'index.php';
			  }
		  });
	  };
  });
  </script>
</head>
<body ng-app="myApp" ng-controller="myCtrl">

<div class="container">
  <h2>Admin-login</h2>
<form class="form-horizontal" ng-submit="send()">
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="email" ng-model="email" placeholder="Enter email">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="pwd" ng-model="password" placeholder="Enter password">
    </div>
  </div>
  <!--<div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label><input type="checkbox"> Remember me</label>
      </div>
    </div>
  </div>--
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
</div>

</body>
</html>--->
