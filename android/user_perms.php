<?php  
require 'db.php';

if(isset($_POST['session_id'])){
	$sessid=clear($_POST['session_id']);
	$uid=intval($_POST['uid']);
	
	$db=open();
	$check = $db->prepare('SELECT * FROM us_session WHERE uid=? and hex=?');
	$check->setFetchMode(PDO::FETCH_ASSOC);  //associative array
	$check->execute(array($uid,$sessid));
	$count=count($check->fetchAll(PDO::FETCH_ASSOC));
	
	if($count==1){	
		if(isset($_POST['parmassions'])){
			$perm=array();	
			$uid=intval($_POST['uid']);
			$db=open();
			$q=$db->prepare('SELECT * FROM doc_perm WHERE uid=?');
			$q->setFetchMode(PDO::FETCH_ASSOC);  //associative array
			$q->execute(array($uid));
			
			$i=0;
			while($res=$q->fetch(PDO::FETCH_ASSOC)){
				$perm['perms'][$i]=$res;
				$i++;
			}
			$perm['success']=1;
			echo json_encode($perm);
			$db=null;
		}
	}
}
?>
