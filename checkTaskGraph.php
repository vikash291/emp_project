<?php
ob_start();
session_start();  
require "admin/db.php";
if(!$_SESSION['emp_id'])  
{  
    header("location: index.php");  
} 
?>    
<!DOCTYPE html>
<html lang="en">
<head>
    
  <title>Check Task Graph</title>  <meta charset="utf-8">
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
  width:auto;
  
  }
  .class={
display: inline-block;
}
  
 
  </style>
<script>
chk=0;
function myfun1(str){
	if(chk==0){
		document.getElementById("rmv").checked=true;
		chk=1;
	}else{
		document.getElementById("rmv").checked=false;
 		chk=0
	}
	funnew()
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


function fun_print(){
 $(".fomrClass").hide();
$("#rmvDiv").hide();
setTimeout(function(){
 window.print();
},0);

  setTimeout(function(){
 $(".fomrClass").show();  
$("#rmvDiv").show();
},300);
}

function funnew(){

document.getElementById('divchat').innerHTML="";
document.getElementById('datediv').innerHTML="";
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
console.log(calander1,calander,'calander');
        datearr=new Array()
	obj=new XMLHttpRequest()

	obj.open("post",'checkTaskGraphAction.php?date='+calander+'&date1='+calander1,true)
		obj.send()
	obj.onreadystatechange=function()
	{		  	   

	    if(obj.readyState==4)
	    {
	       document.getElementById('divchat').innerHTML=""
	  
	       obj1=JSON.parse(obj.responseText)
	       console.log(obj1,'oo')
	       dt2=calander1.split("-");
	       dm2=parseInt(dt2[1]);
	       dy2=parseInt(dt2[0]);
	       dt2=parseInt(dt2[2]);
	   
	       dt1=calander.split("-");
	       dm1=parseInt(dt1[1]);
	       dy1=parseInt(dt1[0]);
	       dt1=parseInt(dt1[2]);
               
               var totaldate=0;
       /*        for(i=dm1;i<=dm2;i++){
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
               		
               }*/
               
               var date1 = new Date(dm1+"/"+dt1+"/"+dy1);
               var date2 = new Date(dm2+"/"+dt2+"/"+dy2);
               var timeDiff = Math.abs(date2.getTime() - date1.getTime());
               var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
              // alert(diffDays); 
               totaldate=diffDays;
               x=0;
               ddt=obj1[x].dt.split("-")
               dtm=parseInt(ddt[1])
               ddt=parseInt(ddt[2])
               
               
               cdate=parseInt(dt1);
               cmon=parseInt(dm1);                 
	       lt=0;
	       lt1=0;
	       lft=0;
               arrmon=["January","February","March","April","May","June","July","August","September","October","November","December"];
               arrcol=["red","orange","green","blue"]
           
                document.getElementById('datediv').innerHTML="&nbsp;&nbsp;&nbsp;"

               colval=0;
               for(i=0;i<=totaldate;i++){
               
           	    if(cdate>28 && [2].includes(cmon))
           	     {
           	        if(dy1%4==0)
           	        {           	        
           	        	if(dy1%100==0){
           	        	   if(dy1%400==0){
           	        	        //alert(cdate+"--")
           	        		if(cdate>29)
           	        		{   cdate=1;}
           	      		  	
           	        	    }else{
           	        		cdate=1;
                                        cmon+=1
           	        	    }
           	       		}
           	        	else{
           	          		if(cdate>29)
           	        		{ 
           	        		  cdate=1;
                                          cmon+=1
           	      			}
           	        	}
           	        }else{
           	                cdate=1;
                                cmon+=1
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

                  // alert(cdate+"/"+cmon+"--------"+ddt)
                      if(cdate==ddt && cmon==dtm){	    

                         if(obj1[x].ho<4)
                         {
                                colval=0;}
                         else if(obj1[x].ho>=4 && obj1[x].ho<=6){
                              colval=1;
                         }else if(obj1[x].ho>6 && obj1[x].ho<=9){ 
                              colval=2;}
                         else{
                                 colval=3;
                          }
                  
                          ht=obj1[x].ho*15
                 // alert(ddt)
                            
                        if(totaldate>25 )
                          {   lft=lft+37
                               lt=lt+37
                               
                               document.getElementById('divchat').innerHTML+="<div class='col-md-3'style='width:32px;border:1px solid #000;background-color:"+arrcol[colval]+";height:"+ht+"px;float:left;margin-left:05px;color:white;padding:2px;position:absolute;font-size:10px;bottom:0;left:"+lft+"px'> "+obj1[x].ho+"</div>";
              
              document.getElementById('datediv').innerHTML+="<div class='col-md-3' style='width:32px;text-align:center;height:20px;float:left;margin:2px 2px 2px 2px;padding:3px;font-size:13px;bottom:0;position:absolute;word-wrap:normal;left:"+lt+"px'>"+cdate+"/"+cmon+"</div>";

                           }else{
                           
                              lft=lft+47;
                              lt1=lt1+47;
                              document.getElementById('divchat').innerHTML+="<div style='width:37px;border:1px solid #000;background-color:"+arrcol[colval]+";height:"+ht+"px;float:left;margin-left:10px;color:white;padding:2px;position:absolute;bottom:0;left:"+lft+"px'>"+obj1[x].ho+"</div>"
                                                         
                          document.getElementById('datediv').innerHTML+="<div style='width:37px;text-align:center;height:25px;float:left;margin-left:10px;padding:3px;font-size:15px;bottom:0;position:absolute;word-wrap:normal;left:"+lt1+"px'>"+cdate+"/"+cmon+"</div>";

                            }
                    x=x+1;
                     ddt=obj1[x].dt.split("-")
                     dtm=parseInt(ddt[1])
                     ddt=parseInt(ddt[2]) 
                   }
                   else{
		  if(document.getElementById("rmv").checked==false){
                       if( totaldate<25 )
                       {
                           lft=lft+47;
                           lt1=lt1+47;
                           document.getElementById('divchat').innerHTML+="<div class='col-md-3'style='width:37px;background-color:black;height:1px;float:left;margin-left:10px;padding:2px;position:absolute;font-size:10px;border:1px solid #000;bottom:0;left:"+lft+"px'> </div>";
              
                           document.getElementById('datediv').innerHTML+="<div style='width:30px;height:25px;text-align:center;float:left;margin-left:8px;padding:3px;font-size:15px;bottom:0;position:absolute;word-wrap:normal;left:"+lt1+"px'>"+cdate+"/"+cmon+"</div>";
         
                        }
                         else
                         {     
                             lft=lft+37;
                             lt=lt+37;
                              document.getElementById('divchat').innerHTML+="<div class='col-md-3'style='width:32px;background-color:black;height:1px;float:left;margin-left:05px;color:white;padding:2px;position:absolute;font-size:10px;border:1px solid #000;bottom:0;left:"+lft+"px'> </div>";
              
                              document.getElementById('datediv').innerHTML+="<div style='width:32px;text-align:center;height:20px;float:left;margin:2px 2px 2px 2px;padding:3px;font-size:13px;bottom:0;position:absolute;word-wrap:normal;left:"+lt+"px'>"+cdate+"/"+cmon+"</div>";

                        } 
                   }
                   }
                   cdate=cdate+1;  

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
               <li ><a href="createTask.php"><span class="glyphicon glyphicon-tasks">Create-Task</span></a></li>
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
<h1 align="center">Check Task Graph</h1>
<hr>
</div>

<form class="form-inline fomrClass">

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
<input type="button" onclick="fun_print()" value="Print Page" class="btn btn-danger">
<span id="res" style="color:darkred;font-size:18px"></span>
</div>
<div class="form-group">
<h2 class="class" id="resdt"></h2>
</div>
<!--Current Date:<span id="div1">{{date  | date:'yyyy-MM'}}</div>
<br>-->

</form>
<div class="form-group" id="rmvDiv">
<input  style="margin:30px 0 0 20px"type="radio" name="rmv" id="rmv" onclick="myfun1(this.id)"><b>Remove empty date:</b>
</div>
<div style="clear:both"></div>
<div id="divchat" style="position:relative;height:450px;width:auto;margin-left:-20px">
</div>
<div id="datediv" style="position:relative;height:30px;width:auto;margin-left:-20px" ></div>

</body>
</html>

