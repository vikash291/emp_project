<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>    
<style>
body{
margin: 0px;
padding: 0px;
font-size: 14px;    
background: #176f98;        
}    
.panel-heading{
font-size: 24px;
padding: 25px 10px 10px;

} 
.panel-heading .glyphicon{
 color: #176f98;  
padding: 0px 10px;    
}
    .form-group{
    margin-bottom: 25px;    
    }
.panel{
margin-top: 30%;   
border-radius: 8px;
border: 10px solid #0f6289;    
}
.form-control{
    height: 50px;
    padding: 10px;
    border-width: 2px; 
    border-left: none;
    font-size: 18px;
}
    .input-group-addon{
       font-size: 20px;
    background: transparent;
    border-width: 2px;
    color: #ddd; 
            font-weight: bold;
    }
    .form-group a{
        color: #ccc; 
            font-weight: bold;
    }
    .btn-primary{
        background: #26aff0;
    border: 2px solid #26aff0;
    color: #fff !important;
    font-weight: bold;
    font-size: 18px;
    }
</style>    
<script>
function fun1()
{
x=$("#email").val()
y=$("#password").val()
$.post("loginAction.php",{email:x,password:y},function(data){
data=data.split(" ").join("")
//alert(data);
if(data == 1)
{
window.location="createTask.php?idd=1";
}
else
{
window.location="index.php?id=1";
} 
});
}


</script>    
</head>
<body>
<div class="container">
 <form class="form-horizontal">

<div class="row">
<div class="col-md-6 col-md-offset-3">

<div class="panel">
<?php 
 if(isset($_REQUEST['er'])==1)
{?>
           <div id="div3" class="alert alert-danger">
  			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  			<strong>Update link expired!
  			<script>
  			setTimeout(function(){document.getElementById('div3').style.display = "none";}, 3000);
  			</script>
		</div>


<?php }
?>
<?php 
	if(isset($_GET['id'])==true)
	{?>
    	<div id="div1" class="alert alert-danger">
  			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  			<strong>Sorry!</strong> User Name or Password may be wrong !
  			<script>
  			setTimeout(function(){document.getElementById('div1').style.display = "none";}, 3000);
  			</script>
		</div>
  	<?php  
  	}?>
  	
  	

<?php 
	if(isset($_GET['lo'])==true)
	{?>
    	<div id="div2" class="alert alert-danger">
  			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  			<strong>Successfully</strong> logout !
  			<script>
  			setTimeout(function(){document.getElementById('div2').style.display = "none";}, 3000);
  			</script>
		</div>
  	<?php  
  	}?>



<div class="panel-heading">
 <span class="glyphicon glyphicon-user"></span> Employee login 
</div>    
<div class="panel-body">
  <div class="col-md-10 col-md-offset-1">
  
    <div class="input-group form-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input type="text" class="form-control" id="email" placeholder="Enter email">
  </div>
  <div class="input-group form-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input id="password" type="password" class="form-control" placeholder="Password">
  </div>  

<div class="form-group ">
<input type="button" value="Login" onclick="fun1()" class="btn btn-primary">   <span id="sp1"></span>   
</div>
<a href='forgotpassword.php'>Forgot password?</a>       

</div>
</div>
</div>
</div> 
 
</div>  
 </form>
</div>    
  
</body>
</html>
