<?php
session_start();
require "admin/db.php";
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$email=addslashes($email);
$password=addslashes($password);
if($email == '' || $password== ''){
echo "0";
}
else{
$sql ="SELECT * FROM  employee WHERE email='$email' and password='$password'";
$result = mysql_query($sql,$con)or die(mysql_error());
$num_rows = mysql_num_rows($result);
if($num_rows > 0){ 
    $sql1 = mysql_query("SELECT eid FROM  employee WHERE email='$email'");
    $value = mysql_fetch_object($sql1);
    $eid=$value->eid;
    $_SESSION["emp_id"] = $eid;
    echo "1";
}
else
{
echo "2";
}
}
?>