<?php
include '../../database_functions.php';
$q=intval($_GET["m"]);

$query="UPDATE  us_condition SET  current='0' WHERE  id='$q'";
open();
$result=mysql_query($query);
close();
?>