<?php
session_start();
require "db.php";
$email = addslashes($_REQUEST['email']);
$password = addslashes($_REQUEST['password']);
if($email == '' || $password== ''){
echo "please_give_email_and_password";
}
else{
$sql ="SELECT * FROM  admin WHERE email='$email' and password='$password'";
$result = mysql_query($sql,$con)or die(mysql_error());
$num_rows = mysql_num_rows($result);
if($num_rows > 0){ 
    $sql1 = mysql_query("SELECT id FROM  admin WHERE email='$email'");
    $value = mysql_fetch_object($sql1);
    $id=$value->id;
    $_SESSION['login'] = $id;
    echo "1";
}
else
{
echo "0";
}
}
?>