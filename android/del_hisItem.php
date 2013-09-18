<?php
require 'db.php';
if(isset($_POST['session_id'])){
	$sessid=clear($_POST['session_id']);
	$uid=intval($_POST['uid']);
	//opening DB(function from db.php)
	$db=open();
	//preparing query, binding return method, executing query with dtata
	$check = $db->prepare('SELECT * FROM us_session WHERE uid=? and hex=?');
	$check->setFetchMode(PDO::FETCH_ASSOC);  //associative array
	$check->execute(array($uid,$sessid));
	//count if session exists
	$count=count($check->fetchAll(PDO::FETCH_ASSOC));
	
	if($count==1){	
		if(isset($_POST['norton'])){
			$fid=intval($_POST['fileid']);
			$type=clear($_POST['norton']);
			//preparing query, binding return method, executing query with dtata
			$q=$db->prepare('DELETE FROM us_'.$type.' WHERE uid=? AND id=?');
			$q1=$db->prepare('DELETE FROM doc_perm WHERE uid=? AND fileid=? AND type=?');
			$q->execute(array($uid,$fid));
			$q1->execute(array($uid,$fid,$type));
			
			$response['success']=1;		
			echo json_encode($response);
		}
	}
	$db=null;
}
?>