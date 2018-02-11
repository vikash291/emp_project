<?php
session_start();
unset($_SESSION['login']);  
if(session_destroy())
{
header("location:index.php?lo=1");
}
?>
