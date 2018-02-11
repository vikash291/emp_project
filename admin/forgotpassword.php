<?php
require_once "db.php";
include "../commonvars.php";

if(isset($_POST['sub']))
{
$em=$_POST['txtemail'];
$data=mysql_query("select * from admin where email='$em'");
date_default_timezone_set("America/New_York");
$encryptStr = $em.date("Y/m/d");
$encstr=crypt($encryptStr);
//echo $encstr;
mysql_query("update admin set astr ='$encstr' where email='$em'");
$str="Click on link to change password <a href='".$site_url."admin/newpassword.php?mail=$encstr'>CLICK</a>";
if(mysql_num_rows($data)==1)
{
   if(mail($em,"Forgot Password","$str","From:admin\r\nContent-type:text/html"))
   {
      echo "<script>alert('Mail sent to your mail id');</script>";
   }
   else
   {
      echo "Error";
   }
}
else
{
   echo "<script>alert('Invalid email entered');</script>";
}
}
?>
<!Doctype html>
<head>
  <title>Forget Password</title>
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
.labelStyle{
font-weight: normal;
    font-size: x-large;
    color: aliceblue;
}
.backLogin{
   color: #fff;
   text-decoration: underline;
   font-size: medium;
   top: 85%;
   position: absolute;
}
a :hover{
color :#d5d8e8
}
</style>
</head>
<body>
<div class="container" style="position:absolute;left:30%;top:30%;width:30%" >
<form method="post" class="form-horizontal">
<label class="labelStyle"> Enter Email Id:</label>
<input type="text" class="form-control" name="txtemail">
<br>
<input class="form-control pull-right" style="width:30%" type="submit" name="sub" value="Forgot"/>
<a class="backLogin" href="index.php" >Back to Login</a>
</form>
<div>
</body>