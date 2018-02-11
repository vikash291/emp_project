<?php
ob_start();
session_start();  
require "db.php";
if(!$_SESSION['login'])  
{  
    header("location: login.php");  
} 
?>  
<html lang="en">
<head>
  <title>Welcome-employee</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">

    <style>
  body{
  background-color:rgba(0,0,0,0.2);
  height:100%;
  width:100%;
  font-size:14px;
  }

.ui-datepicker-calendar {
        display: none;
        }
  
  </style>

    <script>

function print(){
window.open('taskPrint.php');
};

 
$(document).ready(function()
{   
    $(".monthPicker").datepicker({
       dateFormat:"yy-mm",
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
maxDate:0,
       

        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate("yy-mm", new Date(year, month, 1)));
        }
    });

    $(".monthPicker").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
});


function funnew(){
	calander=(document.getElementById('monthpic').value);
	name=$('.ename').val();
	document.getElementById('name').innerHTML=name;
	//alert(calander)
       // alert(name)
	var date = new Date(calander);  
var options = {  
    year: "numeric", month: "short",  
      
};  


var format=(date.toLocaleDateString("en-us", options));  
// alert(format)
 document.getElementById('resdt').innerHTML=format;

var a="Select Month and Year";
    if(calander.length==0){
document.getElementById('res').innerHTML=a;
setTimeout(function(){document.getElementById('res').innerHTML=""}, 3000);
}
else{
        datearr=new Array()
	obj=new XMLHttpRequest()
	obj.open("post",'checkTaskGraphAction.php?date='+calander+'&emp_name='+name,true)
		obj.send()
	obj.onreadystatechange=function()
	{
	    if(obj.readyState==4)
	    {
	       document.getElementById('divchat').innerHTML=""
	      // alert(obj.responseText)
	       obj1=JSON.parse(obj.responseText)
	       // alert(obj1)
	    
	       lft=0
               arrcol=["red","green","#16A085","#34495E","orange","brown","#884EA0","#2980B9"]
              // alert("hi")

               colval=0;
               for(x=0;x<obj1.length;x++)
               {
       
                  ht=obj1[x].ho*25
                  lft=lft+35
                  ddt=obj1[x].dt.split("-")
                  //alert(ddt)
                  ddt=ddt[2]
document.getElementById('divchat').innerHTML+="<div style='width:30;background-color:"+arrcol[colval]+";height:"+ht+";float:left;margin-left:10px;color:white;padding:2px;position:absolute;bottom:0;left:"+lft+"'>"+obj1[x].ho+"hr</div>"
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
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
        </button>
        <a class="navbar-brand" href="welcome.php">Admin-Pannel</h2></a>
      </div>
	  <div class="collapse navbar-collapse" id="myNavbar"> 
      <ul class="nav navbar-nav">
              <li class=""><a href="createEmp.php"><span class="glyphicon glyphicon-user">CreateEmployee</span></a></li>
      <li><a href="createTask.php"><span class="glyphicon glyphicon-tasks">Create-Task</span></a></li>      
      <li  class=""><a href="checkTask.php"><span class="glyphicon glyphicon-tasks">Check-Task</span></a></li>

      <li  class="active"><a href="checkTaskGraph.php"><span class="glyphicon glyphicon-stats">Bar-Chart</span></a></li>

      <li><a href="employeeList.php"><span class="glyphicon glyphicon-list-alt">Employee-List</span></a></li>
        </ul>
       
      <div class="navbar-form navbar-right">
           <a href="logout.php"><button class="btn btn-danger">
<span class="glyphicon glyphicon-off" style="font-size:18px">Logout</span></button></a>
      
    </div>
	</div>
  </div>
  </div>
</nav><br><br>

<h1 align="center">Employee Task Graph</h1>
<hr>
             
             
<form class="form-inline">
 <div class="form-group">
          <label class="control-label">Emp Name:</label>
              <?php 
                  $sql = "SELECT name from employee";
                  $result = mysql_query($sql);
                  echo "<select class='ename form-control'>";
                  while ($row = mysql_fetch_array($result)) {
                  echo "<option  value='" . $row['name'] ."'>" . $row['name'] ."</option>";
                  }
                  echo "</select>"; 
             ?>
             </div>
             
             
             
             
             
             
           


<div class="form-group">        
      <label class="control-label" for="month">Select month and year: </label>
<input type="text" id="monthpic" name="month"  class="monthPicker form-control" placeholder="Select Month"/>
      </div>
      


<div class="form-group">
<input type="button" value="Submit" class="btn btn-primary res" onclick="funnew()">
<input type="submit" onclick="print()" value="Print" class="btn btn-danger">
<!--<span id="res" style="color:darkred;font-size:18px"></span>-->
</div>
<div class="form-group">
<span align="center" style="font-size:18px" id="resdt"></span>
</div>
<div class="form-group">
<span align="center" style="font-size:18px" id="name"></span>
</div>
<!--Current Date:<span id="div1">{{date  | date:'yyyy-MM'}}</div>
<br>-->

</form>
<div style="clear:both"></div>
<div id="divchat" style="position:relative;height:450px;margin-left:-20">
</div>
<div id="datediv"></div>
</html>