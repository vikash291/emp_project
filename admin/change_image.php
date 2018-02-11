<?php
ob_start();
session_start();  
require "db.php";
include "navbar.php";
if(!$_SESSION['login'])  
{  
    header("location: index.php");  
} 

if(isset($_REQUEST['id'])){
session_start();
$id= $_REQUEST['id'];
$quee=mysql_query("select * from employee where eid=$id");
echo "select * from employee where eid=$id";
if(mysql_num_rows($quee)> 0){

  $rec= mysql_fetch_row($quee);
  print_r($rec);
  $img_name = $rec[6];
  echo  $rec[6];
}else{
echo "<script>alert('Sorry! Current ID is not available.')</script>";
echo "<script>window.location='employeeList.php'</script>";

}
}

if(isset($_REQUEST['button'])){
$fname=$_FILES['f1']['name'];
$eid= $_REQUEST['eid'];
$query ="update employee set photo = '$fname' where eid= $eid"; 
echo $query;
         $result = mysql_query($query,$con); //or die(mysql_error());
         if($result)
        {
move_uploaded_file($_FILES['f1']['tmp_name'],"profpic/$fname");
          echo "1";
echo "<script>window.location='employeeList.php'</script>";
}else{
echo mysql_error($result);
//echo "<script>window.location='createEmp.php?subid=1'</script>";
}
 }
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    
  <title>Employee List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="angular.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<style>

#main_div{
position: absolute;
top: 20%;
left: 30%;
}
</style>
</head>
<body>
<div class="form-group" id="main_div">
<label>Requested for Change Image</label>
<?php
if(isset($img_name)){
$img =  "profpic/".img_name;
echo "<img src='profpic/".$img_name."' width=100 height=100  style='position: absolute;left: -50%;'  />";
}
//else{echo "<img src='profpic/close.png'>";}
?>

<form method="post" name="formCP" class="form-horizontal" enctype="multipart/form-data">
<input type="text" name="eid" value="<?php echo $id; ?>" hidden>
<div class="form-group">
        <label class="control-label col-sm-3">Photo</label>
        <div class="col-sm-9">
         <input type="file" class="form-control" file-input="files" name="f1" id="emp_photo" ng-required="true"/>  
        </div>
  </div>
<div class="col-sm-offset-3 col-sm-9">
<button type="submit" class="btn btn-primary res" name="button" id="button">Submit</button> <p id="mand" style='color:Red;font-size:18px'></p>
</div>
    </form>
<div>
</body>
</html>