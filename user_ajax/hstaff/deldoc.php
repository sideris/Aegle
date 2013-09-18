<?php
require '../../site_functions.php';
if($_GET['did3']){
	$id=$_SESSION['uid'];
	$did=intval($_GET['did3']);
	$q="DELETE FROM user_docs WHERE uid='$id' AND did='$did'";
	$q2="DELETE FROM doc_perm WHERE uid='$id' AND did='$did'";
	open();
	$result=mysql_query($q);
	$result2=mysql_query($q2);
	close();
}
?>
