<html>
<head>
<style>
</style>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
.logotext{

margin-top: 10px;


}
.col{
color:white;
}
body{

background-image: url(img/backlogin.jpg);
background-repeat: no-repeat;
 background-size:100%;


}
a{
color: #dfe5ea !important;
    text-decoration: blink;
    font-weight: bolder;
}

a:hover{
color:#8bb6dc !important;
text-decoration: none;
}
</style>
  
<script>
function validateEmail(email) {
  //var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}


function fun1()
{
var x=$("#email").val()
var y=$("#password").val()

document.getElementById("vali").innerHTML="";

if(validateEmail(x)){
if(y==''){
document.getElementById('password').focus();
document.getElementById('passvali').innerHTML="<b>* Password can't be empty</b>";
}else{
forward(x,y);
}
}
else{
document.getElementById("vali").innerHTML="<b>* Enter valid Email</b>";
//e.preventDefault();
}
if(x == ''|| x=='undefined' ){
document.getElementById('email').focus();
document.getElementById('vali').innerHTML="<b>* Enter valid email</b>";
}
}

function forward(x,y){

$.post("loginAction.php",{email:x,password:y},function(data){
data=data.split(" ").join("")
//alert(data);
//arr=data.split("&")
//var z = arr[1];
//alert(z);
//if(arr[0] == 1)
//alert(z);
if(data == 1)
{
//alert(data);
window.location="createEmp.php";
//window.location="welcome.php";
}
else
{
//alert("login-failed");
window.location="index.php?id=1";
}
});
}
</script>
</head>
<body>
<div class="container-fluid">


<h1 style=" color: white;text-shadow:3px 3px 0 #000,-1px -1px 0 #000,1px -1px 0 #000,-1px  1px 0 #000,1px  1px 0 #000; margin-left:30%">ADMIN LOGIN</h1>
</div>

<div class="col-sm-12">
  <form class="form-horizontal " name="loginform" id="loginform">
 <?php 
	if(isset($_GET['lo'])==true)
	{?>
    	<div id="div1" class="alert alert-danger">
  			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  			<strong>Successfully</strong> logout !
		       <script>
                       setTimeout(function(){document.getElementById('div1').style.display = "none";}, 3000);
                       </script>
        </div>
  	<?php  
  	}?>
<?php 
	if(isset($_GET['id'])==true)
	{?>
    	<div id="div2" class="alert alert-danger">
  			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  			<strong>Oops!</strong> user name or password may be wrong !
                       <script>
                       setTimeout(function(){document.getElementById('div2').style.display = "none";}, 3000);
                       </script>
        </div>
		
  	<?php  
  	}?>
      
 <?php 
	if(isset($_REQUEST['er'])==1)
	{?>
    	<div id="div3" class="alert alert-danger">
  			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  			<strong>Update link expire !
		       <script>
                       setTimeout(function(){document.getElementById('div3').style.display = "none";}, 3000);
                       </script>
        </div>
  	<?php  
  	}?>

  
       <div class="form-group">
          <label class="control-label col-sm-1 col-xs-3 col">Email Id:</label>
            <div class="col-sm-3 col-xs-5">
               <input type="email" class="form-control" id="email"> <p id='vali' style='color:#e65c5c'></p>

            </div>
            
       </div>
       
       
  <div class="form-group">
    <label for="password" class="control-label col-sm-1 col-xs-3 col">Password:</label>
     <div class="col-sm-3 col-xs-5">
         <input type="password" class="form-control " id="password">   <p id='passvali' style='color:#e65c5c'></p>
           </div>
     
  </div>
  
  
  <div class="col-sm-offset-3 col-sm-9">
       <button type="button" value="submit" onclick="fun1()" class="btn btn-danger">SUBMIT</button>
  </div>

</form>
   <a class="forgotpwd" href="forgotpassword.php">Forgot Password?</a>


</body>
</html>