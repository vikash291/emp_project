<?php
ob_start();
session_start();  
require "db.php";
include "navbar.php";
if(!$_SESSION['login'])  
{  
    header("location: login.php");  
} 
?>  
<html lang="en">
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
    <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">-->
  
  
   <!DOCTYPE html>
<html lang="en">
<head>
    
  <title>Bootstrap Example</title>  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
         <script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script>
var  datearr=[];

var googleArr= [];
       function drawStuff() {
      var data = new google.visualization.arrayToDataTable(googleArr);
/*data.addColumn('string', 'Dates');
data.addColumn('number', 'Hours');
//data.addColumn('string',{role:'style'})
$.each(googleArr, function(i,d){
var value=d[0];
var name=d[1];
data.addRows([ [name, value]]);
});*/
        var options = {
        height:400,
          chart: {
            title: 'Employee Workhours',
            subtitle: 'Per date hours are shown'
          },
          bars: 'vertical', // Required for Material Bar Charts.
series: {
            0: { axis: 'Total Hours' }, // Bind series 0 to an axis named 'distance'.
          },
          axes: {
            x: {
              Hours: {side: 'top', label: 'Total Hours'}, // Bottom x-axis.
            }
          },
          bar: { groupWidth: "90%" }

        };

      var chart = new google.charts.Bar(document.getElementById('dual_x_div'));
      chart.draw(data, options);
    }
 
		
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
name=(document.getElementById('ename').value);
//alert(name);

calander=(document.getElementById('monthpic').value);
	//alert(calander);
  
calander1=(document.getElementById('monthpic1').value);
//alert(calander1);
window.open('graphPrint.php?name='+name+'&date='+calander+'&date1='+calander1);
};

function funnew(){
name=(document.getElementById('ename').value);
//alert(name);
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
       
        
        $.post("checkTaskGraphAction.php",{name:name,date:calander,date1:calander1},function(resp){
        googleArr =[];
        googleArr.push(['Dates',  'Hours',{ role: 'style' }, { role: 'annotation' }]);
	       obj1=JSON.parse(resp);
              
               
	       dt2=calander1.split("-");
	       dm2=parseInt(dt2[1]);
	       dy2=parseInt(dt2[0]);
	       dt2=parseInt(dt2[2]);
	   
	       dt1=calander.split("-");
	       dm1=parseInt(dt1[1]);
	       dy1=parseInt(dt1[0]);
	       dt1=parseInt(dt1[2]);
               
               var totaldate=0;
               //total date difference
               for(i=dm1;i<=dm2;i++){
                        if(i==dm1 && i!=dm2)
               		{
               			if([1,3,5,7,8,10,12].includes(dm1))
               			{
               				totaldate=32-dt1;
               			}
               			else if([4,6,9,11].includes(dm1))
               			{
               			        totaldate=31-dt1;
               			}
               			if([2].includes(dm1))
               			{
               			   if(dy1%4==0){
               			     if(dy1%100==0){
               			        if(dy1%400==0){
               			           totaldate=30-dt1;
               			        }
               			        else{ totaldate=29-dt1;}
               			     }else{ totaldate=30-dt1;}
               			    }else{totaldate=29-dt1;}
               			}
               			
               		}
               		else if(i==dm2){
               			totaldate+=dt2;
               		}
               		else if([1,3,5,7,8,10,12].includes(i)){
               		      totaldate+=31;
               		}
               		else if([4,6,9,11].includes(i)){
               		      totaldate+=30;
               		}
               		else{
             		   if(dy1%4==0){
             		     if(dy1%100==0){
              		        if(dy1%400==0){
               		           totaldate+=29;
               		        }
             		        else{ totaldate+=28;}
               		     }else{ totaldate+=29;}
               		    }else{totaldate+=28;}
               		}
               		
               }
             //  alert(totaldate);
	      
	       x=0;
               ddt=obj1[x].dt.split("-")
               ddt=parseInt(ddt[2])
               
               cdate=parseInt(dt1);
               cmon=parseInt(dm1);                 
	       lt=8;
	       lt1=10;
	       lft=0;
               arrmon=["January","February","March","April","May","June","July","August","September","October","November","December"];
               arrcol=["red","orange","green","blue"];
               colval=0;
               for(i=0;i<totaldate;i++){
                     if(cdate>28 && [2].includes(cmon))
           	     {
           	        if(dy1%4==0)
           	        {           	        
           	        	if(dy1%100==0){
           	        	   if(dy1%400==0){
           	        	        alert(cdate+"--")
           	        		if(cdate>29)
           	        		{   cdate=1;}
           	      		  	
           	        	    }else{
           	        		cdate=1;
           	        	    }
           	       		}
           	        	else{
           	          		if(cdate>29)
           	        		{ 
           	        		  cdate=1;
           	      			}
           	        	}
           	        }else{
           	                cdate=1;
           	        }
           	     }               
                     if(cdate>30)
                     {
                        if([1,3,5,7,8,10,12].includes(cmon)){
                              if(cdate>31)
                              {
                                 cdate=1;
                                 cmon+=1; 
                              }
                        }else if([4,6,9,11].includes(cmon)){ 
                        
                                 cdate=1;
                                 cmon+=1; 
                             
                        }  
                     }
                   //alert(cdate+"--------"+ddt)
                      if(cdate==ddt){	    
                         if(obj1[x].ho<4)
                         {
                                colval=0;
                                
                         }
                         else if(obj1[x].ho>=4 && obj1[x].ho<=6){
                              colval=1;
                         }else if(obj1[x].ho>6 && obj1[x].ho<=9){ 
                              colval=2;}
                         else{
                                 colval=3;
                          } 
                          datearr = [];
                          datearr
                          googleArr.push([cdate+"/"+cmon,parseInt(obj1[x].ho),'color:#76A7FA','Month']);                 
                          ht=obj1[x].ho*25

                    x=x+1;
                     ddt=obj1[x].dt.split("-")
                     ddt=ddt[2] 
                   }
                   else{
                      googleArr.push([cdate+"/"+cmon,parseInt("0"),'color: #090','ddyas']); 
                   }
                   cdate=cdate+1;  

                  }
                  google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawStuff);
                        console.log(datearr)
        });
    }
};




</script>
</head>
<body ng-app="myApp" ng-controller="demo">
 
  <br><br>

<div class="container-fluid">
<h2 align="center">CHECK TASK GRAPH</h2>
<hr>
</div>

<form class="form-inline" class="class">
<div class="form-group">
          <label class="control-label">Emp Name:</label>
              <?php 
                  $sql = "SELECT name from employee";
                  $result = mysql_query($sql);
                  echo "<select id='ename' class='form-control'>";
                  echo "<option value=''>Select name</option>";
                  while ($row = mysql_fetch_array($result)) {
                  echo "<option  value='" . $row['name'] ."'>" . $row['name'] ."</option>";
                  }
                  echo "</select>"; 
             ?>
             </div>


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
<div id="dual_x_div" style="width: 100%; height: auto;"></div>
</body>
</html>

