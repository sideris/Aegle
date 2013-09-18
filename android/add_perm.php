<?php
require 'db.php';

if(isset($_POST['session_id'])){
	$sessid=clear($_POST['session_id']);
	$uid=intval($_POST['uid']);
	
	//creating connection and opening DB
	$db=open();
	//preparing query, binding return method, executing query with dtata
	$check = $db->prepare('SELECT * FROM us_session WHERE uid=? and hex=?');
	$check->setFetchMode(PDO::FETCH_ASSOC);  //associative array
	$check->execute(array($uid,$sessid));
	//count if there is a session
	$count=count($check->fetchAll(PDO::FETCH_ASSOC));
	
	if($count==1){	
	
		if(isset($_POST['add'])){
			$uid=intval($_POST['uid']);
			$did=intval($_POST['did']);
			$add=clear($_POST['add']);
			
			//check way of adding permissions
			if($add=="specific"){
				$type=clear($_POST['type']);
				$fileid=intval($_POST['fileid']);
				//making insert array		
				$data = array($uid, $did, $type, $fileid);
				//prepare the query
				$state =$db->prepare('INSERT INTO doc_perm VALUES(?,?,?,?)');
				//execute query
				$state->execute($data);
				//return result
				$response['success']=1;		
				echo json_encode($response);
			}
			if($add=="group"){
				$type=clear($_POST['type']);
				//preparing query, binding return method, executing query with dtata
				$q0=$db->prepare('SELECT * FROM us_'.$type.' WHERE uid=?');
				$q0->setFetchMode(PDO::FETCH_ASSOC);  //associative array
				$q0->execute(array($uid));
				//check if there is anything like this to add
				$count=count($q0->fetch());
				
				if($count>0){
					//re-do the post in order to reset the pointer
					$q0->execute(array($uid));
					//fetch all results adding to a "return array"
					while($res=$q0->fetch(PDO::FETCH_ASSOC)){
						$file=$res['id'];
						$data=array($uid,$did,$type,$file);
						$q=$db->prepare('INSERT INTO doc_perm VALUES(?,?,?,?)');
						$q->execute($data);
						//testing
						if($q->rowCount()>0) $bool=1;
					}
					$response['success']=1;		
				}else{
					$response['success']=0;				
				}
				echo json_encode($response);
			}
			// if($add=='doctor'){
				// $q="DELETE FROM doc_perm WHERE did='$did' AND uid='$uid'";
				// open();
				// $result=mysql_query($q);
				// close();
					// if($result){
					// $response['success']=1;		
				// }else{
					// $response['success']=0;				
				// }
				// echo json_encode($response);
			// }
			if($add=='nfc'){
				$q0=$db->prepare('DELETE FROM nfc_perm WHERE uid=? AND did=?');
				$q0->execute(array($uid,$did));
				
				$q=$db->prepare('INSERT INTO nfc_perm VALUES (?,?)');
				$q->execute(array($uid,$did));
				
				$response['success']=1;	
				echo json_encode($response);
			}
		}
	}
	$db=null;
}
?>
