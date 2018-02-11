<?php
ob_start();
session_start();  
require "../admin/db.php";
$eid=$_SESSION['emp_id'];
$date=$_REQUEST['calander'];
$date1=$_REQUEST['calander1'];



$query2="select name from employee where eid='$eid'";
$result2=mysql_query($query2) or die(mysql_error());
$row2 = mysql_fetch_object($result2);
$ename=$row2->name;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Print</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<body>

<div class="container">
<table class="display" cellspacing="0"  align="center">
<tr><td><th align="right">NAME :</th></td><td><?php echo $ename; ?></td></tr>
<tr><td><th align="right">FROM :</th></td><td><?php echo $date; ?></td></tr>
<tr><td><th align="right">TO :</th></td><td><?php echo $date1; ?></td></tr>
</table>
<br>
<script>
var calander="<?php echo $date; ?>";
var calander1="<?php echo $date1; ?>";
//alert(calander);
//alert(calander1);
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

        $.post("checkTaskGraphAction.php",{date:calander,date1:calander1},function(resp){
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
                  x=0;
               ddt=obj1[x].dt.split("-");
               dtm=parseInt(ddt[1]);
               ddt=parseInt(ddt[2]);
               
               cdate=parseInt(dt1);
               cmon=parseInt(dm1);                 
	       
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
           	        		{   cdate=1;cmon+=1;}
           	      		  	
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
                       if(cdate==ddt && cmon==dtm){	    
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
//                          datearr["color"] ='color:"arrcol[colval]"';
  //                        datearr[hours]=obj1[x].ho;
                          googleArr.push([cdate+"/"+cmon,parseInt(obj1[x].ho),'color:#76A7FA','Month']);                 
                          ht=obj1[x].ho*25

                    x=x+1;
                     ddt=obj1[x].dt.split("-");
                     dtm=parseInt(ddt[1]);
                     ddt=parseInt(ddt[2]);
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
        </script>
<div id="dual_x_div" style="width: 100%; height: auto;"></div>

<button onclick="fun1()" type="button" class="btn btn-primary">Go Back</button>
<button onclick="myFunction()" type="button" class="btn btn-danger pull-right">Print</button>

<script>
function myFunction() {
    window.print();
}
function fun1(){
window.location.href='checkTaskGraph.php';
}
</script>

</body>
</html>