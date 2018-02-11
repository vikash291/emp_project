<?php
require "db.php";
$ename=$_REQUEST['name'];
$date=$_REQUEST['date'];
$date1=$_REQUEST['date1'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Print</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    
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
var name="<?php echo $ename; ?>";
var calander="<?php echo $date; ?>";
var calander1="<?php echo $date1; ?>";
funnew()
function funnew(){

        datearr=new Array()
	obj=new XMLHttpRequest()
	//alert(obj);
	obj.open("post",'checkTaskGraphAction.php?name='+name+'&date='+calander+'&date1='+calander1,true)
		obj.send()
	obj.onreadystatechange=function()
	{	
	    if(obj.readyState==4)
	    {
	       document.getElementById('divchat').innerHTML=""
	  
	       obj1=JSON.parse(obj.responseText)
	  	     
	       
	       dt2=calander1.split("-");
	       dm2=parseInt(dt2[1]);
	       dy2=parseInt(dt2[0]);
	       dt2=parseInt(dt2[2]);
	   
	       dt1=calander.split("-");
	       dm1=parseInt(dt1[1]);
	       dy1=parseInt(dt1[0]);
	       dt1=parseInt(dt1[2]);
               
               var totaldate=0;
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
              // alert(totaldate);

               x=0;
               ddt=obj1[x].dt.split("-");
               dtm=parseInt(ddt[1]);
               ddt=parseInt(ddt[2]);
               
               
               cdate=parseInt(dt1);
               cmon=parseInt(dm1);                 
	       lt=0;
	       lt1=0;
	       lft=0;
               arrmon=["January","February","March","April","May","June","July","August","September","October","November","December"];
               arrcol=["red","orange","green","blue"]
           
                document.getElementById('datediv').innerHTML="&nbsp;&nbsp;&nbsp;"

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

                  // alert(cdate+"--------"+ddt)
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
                  
                          ht=obj1[x].ho*25
                 // alert(ddt)
                            
                        if(totaldate>25 )
                          {   lft=lft+30
                               lt=lt+30
                               
                               document.getElementById('divchat').innerHTML+="<div class='col-md-3'style='width:25px;border:1px solid #000;background:"+arrcol[colval]+";height:"+ht+"px;float:left;margin-left:05px;color:white;padding:2px;position:absolute;font-size:10px;bottom:0;left:"+lft+"px'> "+obj1[x].ho+"</div>";
              
              document.getElementById('datediv').innerHTML+="<div class='col-md-3' style='width:25px;text-align:center;height:20px;float:left;margin:2px 2px 2px 2px;padding:3px;font-size:13px;bottom:0;position:absolute;word-wrap:normal;left:"+lt+"px'>"+cdate+"/"+cmon+"</div>";

                           }else{
                           
                              lft=lft+40;
                              lt1=lt1+40;
                              document.getElementById('divchat').innerHTML+="<div style='width:30px;border:1px solid #000;background:"+arrcol[colval]+";height:"+ht+"px;float:left;margin-left:10px;color:white;padding:2px;position:absolute;bottom:0;left:"+lft+"px'>"+obj1[x].ho+"</div>"
                                                         
                          document.getElementById('datediv').innerHTML+="<div style='width:30px;text-align:center;height:25px;float:left;margin-left:10px;padding:3px;font-size:15px;bottom:0;position:absolute;word-wrap:normal;left:"+lt1+"px'>"+cdate+"/"+cmon+"</div>";

                            }
                    x=x+1;
                     ddt=obj1[x].dt.split("-")
                     dtm=parseInt(ddt[1]);
                     ddt=parseInt(ddt[2]);                   }
                   else{
		  if(document.getElementById("rmv").checked==false){
                       if( totaldate<25 )
                       {
                           lft=lft+40;
                           lt1=lt1+40;
                           document.getElementById('divchat').innerHTML+="<div class='col-md-3'style='width:30px;background-color:black;height:1px;float:left;margin-left:10px;padding:2px;position:absolute;font-size:10px;bottom:0;left:"+lft+"px'> </div>";
              
                           document.getElementById('datediv').innerHTML+="<div style='width:30px;height:25px;text-align:center;float:left;margin-left:8px;padding:3px;font-size:15px;bottom:0;position:absolute;word-wrap:normal;left:"+lt1+"px'>"+cdate+"/"+cmon+"</div>";
         
                        }
                         else
                         {     
                             lft=lft+30;
                             lt=lt+30;
                              document.getElementById('divchat').innerHTML+="<div class='col-md-3'style='width:25px;background-color:black;height:1px;float:left;margin-left:05px;color:white;padding:2px;position:absolute;font-size:10px;bottom:0;left:"+lft+"px'> </div>";
              
                              document.getElementById('datediv').innerHTML+="<div style='width:25px;text-align:center;height:20px;float:left;margin:2px 2px 2px 2px;padding:3px;font-size:13px;bottom:0;position:absolute;word-wrap:normal;left:"+lt+"px'>"+cdate+"/"+cmon+"</div>";

                        } 
                   }
                   }
                   cdate=cdate+1;  

                  }
 
	   }
	}
  }
</script>

<input  style="margin:30px 0 0 20px"type="radio" name="rmv" id="rmv" onclick="myfun1(this.id)"><b>Remove Empty Date:</b>



<div style="clear:both"></div>
<div id="divchat" style="position:relative;height:450px;width:auto;margin-left:-20px">
</div>
<div id="datediv" style="position:relative;height:30px;width:auto;margin-left:-20px" ></div>


<button onclick="fun1()" type="button" class="btn btn-primary">Go Back</button>


<button onclick="myFunction()" type="button" class="btn btn-danger pull-right" name="prin" >Print</button>

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