<?php
$qs=$_REQUEST['mail'];
require_once "admin/db.php";
if(isset($_REQUEST['mail']))
{
    $str=$_REQUEST['mail'];
    $q1=mysql_query("select * from employee where astr='$str'");
    $res=mysql_fetch_assoc($q1);
    $upeid=$res['eid'];
    $nrow=mysql_num_rows($q1);
    if($nrow>0){
          
          if(isset($_POST['sub']))
          {
              $qs=$_REQUEST['mail'];
              $npw=$_POST['txtemail'];
              $query=mysql_query("update employee set password='$npw',astr='' where eid='$upeid'");
              if(mysql_affected_rows() > 0){
              echo "<script>alert('Password Changed Successfully')</script>";
              echo "<script>window.location='index.php'</script>";
          }else{
              echo "<script>alert('Something went wrong! Please try again.')</script>";
            }
          }         
     }
     else{
        echo "<script>window.location='index.php?er=1'</script>";
     }
}

?>
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
.labelStyle{
font-weight: normal;
    font-size: x-large;
    color: aliceblue;
}

</style>    
</head>
<body>
<div class="container" style="position:absolute;left:30%;top:30%;width:30%" >
 <form method="post" class="form-horizontal">
    <label class="labelStyle">Reset Password</label>
    <input type="text" class="form-control" name="txtemail" placeholder="Enter  new password">
  
  <input type="submit" name="sub" value="Save" class="btn btn-primary pull-right" style="margin-top:2%">

 </form>
 </div>
</body>
</html>














