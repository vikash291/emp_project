<?php  
 include "db.php";
 $output = '';  
 $query = "SELECT * FROM employee ORDER BY id DESC";  
 $result = mysql_query($query);  
 while($row = mysql_fetch_array($result))  
 {  
      $output[] = $row;  
 }  
 echo json_encode($output);  
 ?>  