<?php  
 include "db.php";
 if(!empty($_FILES))  
 {  
      $path = 'img/' . $_FILES['file']['name'];  
      if(move_uploaded_file($_FILES['file']['tmp_name'], $path))  
      {  
           $insertQuery = "INSERT INTO epmloyee(photo) VALUES ('".$_FILES['file']['name']."')";  
           if(mysql_query($insertQuery))  
           {  
                echo 'File Uploaded';  
           }  
           else  
           {  
                echo 'File Uploaded But not Saved';  
           }  
      }  
 }  
 else  
 {  
      echo 'Some Error';  
 }  
 ?>  