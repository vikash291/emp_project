<?php
$con=mysql_connect("localhost","root","");
mysql_select_db("dbchat");
if($con)
{
/*****************ADMIN TABLE CREATED ************/
$admin=mysql_query("CREATE TABLE IF NOT EXISTS admin
(id int NOT NULL AUTO_INCREMENT,  
email varchar(8),     
password varchar(50),  
PRIMARY KEY (id))");
/*****************ADMIN TABLE CREATED ************/

/*******DATA INSERTED IN ADMIN TABLE**************/
/*if($admin)
{
mysql_query("INSERT INTO admin(id,email,password)VALUES(NULL,'a','b')");
}*/
/*******DATA INSERTED IN ADMIN TABLE**************/




/**********EMPLOYEE TABLE CREATED*************/
mysql_query("CREATE TABLE IF NOT EXISTS employee
(eid int NOT NULL AUTO_INCREMENT,
name varchar(30),  
address varchar(50),
mobile int(10),
email varchar(30),     
password varchar(30),  
PRIMARY KEY (eid))");
/**********EMPLOYEE TABLE CREATED*************/



/**************ENTRYTASK TABLE CREATED**********************/
/*mysql_query("CREATE TABLE IF NOT EXISTS entrytask
(id int NOT NULL AUTO_INCREMENT,
ename
date date,  
time varchar(50),
task_name varchar(30),
task_desc varchar(100),     
CONSTRAINTS pk_entrytask PRIMARY KEY(eid,date,time))");*/
/**************ENTRYTASK TABLE CREATED**********************/
}
?>

