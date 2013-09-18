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
		
		if(isset($_POST['uid'])){
			$uid=intval($_POST['uid']);
			$doctor=array();
			
			$db=open();
			$q=$db->prepare('SELECT * FROM user_docs WHERE uid=?');
			$q->setFetchMode(PDO::FETCH_ASSOC);  //associative array
			$q->execute(array($uid));
			
			$u = $q->fetch();
			$count = count($u);	
			//if there are doctors to be added return them
			if($count>0){
				$q->execute(array($uid));
				$i=0;
				while($r=$q->fetch(PDO::FETCH_ASSOC)){
					$query=$db->prepare('SELECT * FROM doc WHERE id=?');
					$query->setFetchMode(PDO::FETCH_ASSOC);  //associative array
					$query->execute(array($r['did']));
					
					$p[$i]=$query->fetch(PDO::FETCH_ASSOC);
					$doctor['doctor'][$i]['id']=$p[$i]['id'];
					$doctor['doctor'][$i]['first']=$p[$i]['first'];
					$doctor['doctor'][$i]['last']=$p[$i]['last'];
					$doctor['doctor'][$i]['email']=$p[$i]['email'];
					$doctor['doctor'][$i]['field']=$p[$i]['field'];
					$doctor['doctor'][$i]['place']=$p[$i]['place'];
					$doctor['doctor'][$i]['phone']=$p[$i]['phone'];
					$i++;				
				}
				$doctor['success']=1;
			}else{
				$doctor['success']=2;
			}
			echo json_encode($doctor);
			$db=null;
		}
	}
}
?>
