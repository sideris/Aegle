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
		if(isset($_POST['delete'])){
			
			$uid=intval($_POST['uid']);
			$did=intval($_POST['did']);
			$del=clear($_POST['delete']);
			//types of deleting permissions
			
			//one record
			if($del=="specific"){
				$type=clear($_POST['type']);
				$fileid=intval($_POST['fileid']);
				
				$data=array($uid,$did,$type,$fileid);
				$q=$db->prepare('DELETE FROM doc_perm WHERE uid=? AND did=? AND type=? AND fileid=?');
				$q->execute($data);

				if($q){
					$response['success']=1;		
				}else{
					$response['success']=0;				
				}
				echo json_encode($response);
			}
			//a group of them
			if($del=='group'){
				$type=clear($_POST['type']);
				
				$data=array($uid,$did,$type);
				$q=$db->prepare('DELETE FROM doc_perm WHERE uid=? AND did=? AND type=?');
				$q->execute($data);
				
				if($q){
					$response['success']=1;		
				}else{
					$response['success']=0;				
				}
				echo json_encode($response);
			}
			//if doctor is deleted
			if($del=='doctor'){
				$data=array($did,$uid);
				$q=$db->prepare('DELETE FROM doc_perm WHERE did=? AND uid=?');
				$q->execute($data);
				if($q){
					$response['success']=1;		
				}else{
					$response['success']=0;				
				}
				echo json_encode($response);
			}
			//temporary from nfc
			if($del=='nfc'){
				$data=array($did,$uid);
				$q=$db->prepare('DELETE FROM nfc_perm WHERE did=? AND uid=?');
				$q->execute($data);
				if($q){
					$response['success']=1;		
				}else{
					$response['success']=0;				
				}
				echo json_encode($response);
			}
		}
	}
	$db=null;
}
?>
