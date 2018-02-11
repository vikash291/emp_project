<?php
ob_start();
session_start();  
require "../admin/db.php";
if(!$_SESSION['emp_id'])  
{  
    header("location: login.php");  
} 
?>  
/*<html lang="en">
<head>
  <title>check task graph</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>

</style>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">*/
  
  
   <!DOCTYPE html>
<html lang="en">
<head>
    
  <title>Bootstrap Example</title>  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   

  <style>
  body{
  background-color:rgba(0,0,0,0.2);
  height:100%;
  width:100%;
  
  }
  .class={
display: inline-block;
}
  
 
  </style>
<script>
		
		
$("document").ready(function(){
$("#monthpic").datepicker({

dateFormat:"yy-mm-dd",
maxDate:0,
changeYear:true,
changeMonth:true,

onClose:function(sdt){
$("#monthpic1").datepicker({
dateFormat:"yy-mm-dd",
maxDate:0,
changeYear:true,
changeMonth:true,
})
$("#monthpic1").datepicker("option","minDate",sdt)


}
})
});




function print(){
window.open('taskPrint.php');
};

function funnew(){

document.getElementById('divchat').innerHTML=""
document.getElementById('datediv').innerHTML=""
	calander=(document.getElementById('monthpic').value);
	//alert(calander);
  
calander1=(document.getElementById('monthpic1').value);
//alert(calander1);
var disdate=calander +" to " +calander1;
if(calander!="" && calander1!=""){
document.getElementById('resdt').innerHTML=disdate;
}

var a="Select Dates";
    if(calander.length==0  || calander1.length==0){
document.getElementById('res').innerHTML=a;
setTimeout(function(){document.getElementById('res').innerHTML=""}, 3000);
}
else{
//alert(calander);
//alert(calander1);
        datearr=new Array()
	obj=new XMLHttpRequest()
	obj.open("post",'checkTaskGraphAction.php?emp_name='+name+'&date='+calander+'&date1='+calander1,true)
	obj.send()
	obj.onreadystatechange=function()
	{
	    if(obj.readyState==4)
	    {
	       document.getElementById('divchat').innerHTML=""
	       //alert(obj.responseText)
	       obj1=JSON.parse(obj.responseText)
	       // alert(obj1)
	       dt2=calander1.split("-");
	       dt2=dt2[2];
	       
	       dt1=calander.split("-");
	       dt1=dt1[2];
               x=0;
               ddt=obj1[x].dt.split("-");
	       ddt=ddt[2];
	    
	       lt=8;
	       lt1=10;
	       
	       lft=0
               arrcol=["red","orange","green","blue"]
              // alert("hi")
              document.getElementById('datediv').innerHTML="&nbsp;&nbsp;&nbsp;"

               colval=0;
               for(x=0;x<obj1.length;x++)
               {
       
                  if(obj1[x].ho<4)
                  {
                      colval=0;
                  }
                  else if(obj1[x].ho>=4 && obj1[x].ho<=6)
                  { 
                      colval=1;
                  }
                  else if(obj1[x].ho>6 && obj1[x].ho<=9)
                  { 
                      colval=2;
                  }
                  else
                  {
                      colval=3;
                  }
                 
                  ht=obj1[x].ho*25
                  lft=lft+35
                  ddt=obj1[x].dt.split("-")
                  //alert(ddt)
                  ddt=ddt[2]
                  
              
	                         
document.getElementById('divchat').innerHTML+="<div style='width:25;background-color:"+arrcol[colval]+";height:"+ht+";float:left;margin-left:10px;color:white;padding:2px;position:absolute;bottom:0;left:"+lft+"'>"+obj1[x].ho+"</div>"
datearr.push(ddt)

colval++
if(colval==8)
colval=0;
               }
                document.getElementById('datediv').innerHTML="&nbsp;&nbsp;&nbsp;"
                for(i=0;i<datearr.length;i++)
                {
                   document.getElementById('datediv').innerHTML+="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+datearr[i]
                   
                }

	   }
	}
    }
};
</script>
</head>
<body ng-app="myApp" ng-controller="demo">
 
   <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
        </button>
        <a class="navbar-brand" href="welcome.php">Employee-Pannel</h2></a>
      </div>
	  <div class="collapse navbar-collapse" id="myNavbar"> 
      <ul class="nav navbar-nav">
               <li class="active"><a href="createTask.php"><span class="glyphicon glyphicon-tasks">Create-Task</span></a></li>
        <li><a href="checkTask.php"><span class="glyphicon glyphicon-tasks">Check-Task</span></a></li>
        <li class="active"><a href="checkTaskGraph.php"><span class="glyphicon glyphicon-tasks">CheckTask-Graph</span></a></li>
        <li ><a href="myProfile.php"><span class="glyphicon glyphicon-user">My-Profile</span></a></li>
        </ul>
       
	  <div class="navbar-form navbar-right">
      <a href="logout.php"><button class="btn btn-danger"><span class="glyphicon glyphicon-off">logout</span></button></a>
      
    </div>
	</div>
  </div>
  </nav>

  
    
    
    
    
    <br><br>
 
<div class="container-fluid">
<h1 align="center">Create Task Graph</h1>
<hr>
</div>

<form class="form-inline" class="class">

<div class="form-group">        
      <label class="control-label" for="month">From Date: </label>
<input type="text" id="monthpic" name="month"  class="monthPicker form-control" placeholder="From Date"/>
      </div>
      
      
<div class="form-group">        
      <label class="control-label" for="month">To Date: </label>
<input type="text" name="month" id="monthpic1" class="monthPicker1 form-control" placeholder="To Date"/>
      </div>


<div class="form-group">
<input type="button" value="Submit" class="btn btn-primary res" onclick="funnew()">
<input type="submit" onclick="print()" value="Print" class="btn btn-danger">
<span id="res" style="color:darkred;font-size:18px"></span>
</div>
<div class="form-group">
<h2 class="class" id="resdt"></h2>
</div>
<!--Current Date:<span id="div1">{{date  | date:'yyyy-MM'}}</div>
<br>-->

</form>

<div style="clear:both"></div>
<div id="divchat" style="position:relative;height:450px;margin-left:-20">
</div>
<div id="datediv" "></div>
</html>

