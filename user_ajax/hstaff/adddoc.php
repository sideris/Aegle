<?php
require '../../site_functions.php';
if($_GET['did3']){
	$id=$_SESSION['uid'];
	$did=intval($_GET['did3']);
	$q="insert into user_docs values ($id,$did)";
	open();
	$result=mysql_query($q);
	close();
}
if($result){
	echo "Added!";
}
?>
