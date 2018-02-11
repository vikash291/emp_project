<?php
session_start();
require "db.php";
//print_r($_FILES);
$_SESSION['emp_name']=$name=$_REQUEST['uname'];

$_SESSION['emp_add']=$address=$_REQUEST['address'];
$_SESSION['phn']=$phone=$_REQUEST['mobile'];
$_SESSION['emp_mail']=$mail=$_REQUEST['email'];
$char ="1234567890";
$pass = str_shuffle($char);
$fname=$_FILES['f1']['name'];
$password = "EMP".$pass;


        $query ="INSERT INTO employee(eid, name, address, mobile, email, password,photo)VALUES(NULL,'$name','$address','$phone','$mail','$password','$fname')"; 
         $result = mysql_query($query,$con); //or die(mysql_error());
         if($result)
        {
move_uploaded_file($_FILES['f1']['tmp_name'],"profpic/$fname");
          echo "1";
echo "<script>window.location='employeeList.php'</script>";
      }
else{
echo "<script>window.location='createEmp.php?subid=1'</script>";

}
 ?>
   

