<?php
require '../../site_functions.php';
if($_GET['type']){
	$did=intval($_GET['did8']);
	open();
	$type=mysql_real_escape_string($_GET['type']);
	$fileid=intval($_GET['fid']);
	$q="DELETE FROM doc_perm WHERE did='$did' AND fileid='$fileid' AND type='$type'";
	$result=mysql_query($q);
	close();
}
else{
	echo "Access forbidden";
}
?>
