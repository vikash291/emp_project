<?php 
require "db.php"; 
$output = array();
$query= "select * from employee";
$result = mysql_query($query) or die(mysql_error());
$num_rows = mysql_num_rows($result);
if($num_rows > 0)
{
while($row = mysql_fetch_array($result))
{
$output[]=$row;
}
echo json_encode($output);
}
?>  
