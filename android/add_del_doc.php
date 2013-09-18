<?php  
require 'db.php';

if(isset($_POST['session_id'])){
	//getting POST data
	$sessid=clear($_POST['session_id']);
	$uid=intval($_POST['uid']);
	//opening DB(function from db.php)
	$db=open();
	//preparing query, binding return method, executing query with dtata
	$check = $db->prepare('SELECT * FROM us_session WHERE uid=? and hex=?');
	$check->setFetchMode(PDO::FETCH_ASSOC);  //associative array
	$check->execute(array($uid,$sessid));
	//count if there is a session
	$count=count($check->fetchAll(PDO::FETCH_ASSOC));
	
	if($count==1){	
		if(isset($_POST["kind"])){
			$k=clear($_POST["kind"]);
			$uid=intval($_POST["uid"]);
			$did=intval($_POST["did"]);
			//if we want to add
			if($k=="add"){
				//preparing query, binding return method, executing query with dtata
				$data=array($uid,$did);
				$q=$db->prepare('INSERT INTO user_docs VALUES (?,?)');
				$q->execute($data);
				
				//preparing query, binding return method, executing query with dtata
				$q2=$db->prepare('SELECT * FROM doc WHERE id=?');
				$q2->setFetchMode(PDO::FETCH_ASSOC);  //associative array
				$q2->execute(array($did));
				//fetching all the data of the Doctor
				$res=$q2->fetch(PDO::FETCH_ASSOC);
				//adding data to array	
				$doctor["doctor"]["id"]=$res["id"];
				$doctor["doctor"]["first"]=$res["first"];
				$doctor["doctor"]["last"]=$res["last"];
				$doctor["doctor"]["email"]=$res["email"];
				$doctor["doctor"]["field"]=$res["field"];
				$doctor["doctor"]["place"]=$res["place"];
				$doctor["doctor"]["phone"]=$res["phone"];	
				$doctor["success"]=1;
				//send back data
				echo json_encode($doctor);
				//if we want to delete
			}elseif($k=="delete"){
				//preparing query, binding return method, executing query with dtata
				$q=$db->prepare('DELETE FROM user_docs WHERE uid=? AND did=?');
				//we also need to delete the given permissions
				$q2=$db->prepare('DELETE FROM doc_perm WHERE uid=? AND did=?');
				$q->execute(array($uid,$did));
				$q2->execute(array($uid,$did));
				$doctor["success"]=1;
				echo json_encode($doctor);
			}else{
				$result["success"]=0;
				echo json_encode($result);
			}
		}
	}
	$db=null;
}
?>
