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
<script type="text/javascript">





</script>
<style>
.emptdesc{
display:inline-block;
}
.emptname{
display:inline-block;
}
.ins{
display:inline-block;
}
.dup{
display:inline-block;

}
.bln{
display:inline-block;

}
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
function mouseUp(str) {
     document.getElementById(str).style.borderColor = "";

}
var app =angular.module("myApp",[]);
app.controller("ngModelCtrl",function($scope,$http,$timeout){
$scope.color="";
$scope.tname=[];
$scope.tdesc=[];
$scope.select=[];
$scope.response="";
$scope.names=["00.00am-01.00am","01.00am-02.00am","02.00am-03.00am","03.00am-04.00am","04.00am-05.00am","05.00am-06.00am","06.00am-07.00am","07.00am-08.00am","08.00am-09.00am","09.00am-10.00am","10.00am-11.00am","11.00am-12.00pm","12.00pm-01.00pm","01.00pm-02.00pm","02.00pm-03.00pm","03.00pm-04.00pm","04.00pm-05.00pm","05.00pm-06.00pm","06.00pm-07.00pm","07.00pm-08.00pm","08.00pm-09.00pm","09.00pm-10.00pm","10.00pm-11.00pm","11.00pm-00.00am"];
//$scope.date = new Date();

$scope.send=function()
{
           c=0;
           d=0;
           count1=0;
           du=0;
        for(var i=0;i<10;i++)// for data validaion
        {         
          
              if($scope.select[i]==null || $scope.select[i]=="undefined" || $scope.select[i]=="")
              {
                   continue;    
                  
              }
              else
              {
                         c=c+1;
                if($scope.tname[i]=="undefined" || $scope.tname[i]==null || $scope.tname[i]=="")
                {
                    document.getElementById("emptname").innerHTML="Enter "+(i+1) +" th task name";
          
                   $("#taskName"+i).focus();
                    document.getElementById("taskName"+i).style.borderColor="red";
                    $timeout(function() 
                    {
                           document.getElementById("emptname").innerHTML="";
  
                    }, 3000);
                    
 
                }
                else if($scope.tdesc[i]=="undefined" || $scope.tdesc[i]==null || $scope.tdesc[i]=="")
                {
                        document.getElementById("emptdesc").innerHTML="Enter "+(i+1) +" th task description";
                          
                         $("#taskDesc"+i).focus();
                      document.getElementById("taskDesc"+i).style.borderColor="red";
                      $timeout(function() 
                      {
                             document.getElementById("emptdesc").innerHTML="";
  
                      }, 3000);
                    

                }
                else{
                     d=d+1;
                 }
                
              }
           }
             if(c==d){     
                if(c==0 && d==0)  {
                    document.getElementById("blank").innerHTML="Select atleast one task"
                    $timeout(function() 
                     {
                                     document.getElementById("blank").innerHTML="";
                                                                      
                      }, 4000); 
                }
                  
                for(j=0;j<10;j++)///for data insertion
                { 
                     if($scope.select[j]==null || $scope.select[j]=="undefined" || $scope.select[i]=="" || $scope.tname[j]=="undefined" || $scope.tname[j]=="" || $scope.tname[j]==null || $scope.tdesc[j]=="undefined" ||  $scope.tdesc[j]=="" ||  $scope.tdesc[j]==null)
                     {   
                        
                        continue;    
                     }
                     else{ 
                       // alert(j+"ramu")
                 $http({
          		method  : 'POST',
          		url:'createtaskaction1.php?taskname='+$scope.tname[j]+'&taskdescription='+$scope.tdesc[j]+'&time='+$scope.select[j]+'&v='+j
     		     }).then(function(res){      
     		                      
     		               $scope.response=res.data;
     		             d1=$scope.response.split("\n").join("")
     		            
                         //      alert(d1+"lkjj")
                               if($scope.response<10){
                                    count1=count1+1;
                                    x="insert";
                                     document.getElementById(x).innerHTML=count1+" Data inserted";
       			             $timeout(function() 
                                       {
                                              document.getElementById(x).innerHTML="";
  
                                        }, 3000); 
                                      $scope.tname[d1]="";
                                      $scope.tdesc[d1]="";
                                      $scope.select[d1]="";
                                  }
                                 else {
                                     du=du+1;
                                      document.getElementById("dupl").innerHTML=du+" Duplicate Data";                     
                                      $timeout(function() 
                                       {
                                              document.getElementById("dupl").innerHTML="";
  
                                        }, 3000); 
                                 }
                         });
                                
                 }
                                    
                  }
           
                 
        }
               
              
               
             }         

});



</script>

</head>
<body ng-app="myApp" ng-controller="ngModelCtrl">



<br><br>  
<div class="container-fluid">
<h2 align="center">CREATE TASK</h2>
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
    
   
      <?php for($i=0;$i<10;$i++){ ?>
    
    <hr>
    <div class="form-group">
      <label class="control-label col-sm-3">Select Time:</label>
      <div class="col-sm-9">          
        <select class="form-control" ng-model="select[<?php echo $i;?>]" ng-options="item for item in names">
        <option value="">Select time</option>
      </select>
   
      </div>
      
    </div>

    
    <div class="form-group">
    <label class="control-label col-sm-3" for="taskName">Task Name:</label>        
      <div class=" col-sm-9">
          <input type="text" class="form-control" id="taskName<?php echo $i;?>" name="taskName" ng-model="tname[<?php echo $i;?>]" placeholder="Enter Task Name" style='borderColor=blue'  onkeypress="mouseUp(this.id)">
      </div>
    </div>
    
    <div class="form-group">
    <label class="control-label col-sm-3" for>Task Description:</label>        
      <div class="col-sm-9">
        <textarea class="form-control" rows="4" id="taskDesc<?php echo $i;?>" name="taskDesc" ng-model="tdesc[<?php echo $i;?>]" onkeypress="mouseUp(this.id)"></textarea>

      </div>
    </div>
     
     <!--     <div style="color:{{color}};font-size:18px;" class="res">{{a}}{{b}}{{c}}</div> -->

    <?php } ?>   
       
    <div class="form-group">        
      <div class="col-sm-offset-3 col-sm-9">
        <button type="submit" class="btn btn-primary res">Submit</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <div class="ins" id="insert" style='color:green;font-size:18px;'></div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <div class="dup" id="dupl" style='color:darkred;font-size:18px;'></div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <div class="bln" id='blank' style='color:darkred;font-size:18px;'></div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <div class="emptname" id="emptname" style='color:darkred;font-size:18px;'></div>
        <div class="emptdesc" id="emptdesc" style='color:darkred;font-size:18px;'></div>
        
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