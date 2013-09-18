<?php
include '../../database_functions.php';
$q=intval($_GET["q"]);

$query="UPDATE  us_medication SET  current='0' WHERE  id='$q'";
open();
$result=mysql_query($query);
close();
?>