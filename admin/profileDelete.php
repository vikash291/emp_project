<?php
require "db.php";
$delete = $_GET['id'];
$results = mysql_query("DELETE FROM employee WHERE eid='$delete'");
if($results)
{
echo "deleted";
}
else
{
echo "not-deleted";
}
?>