<?php  
require 'db.php';

if(isset($_POST['type'])){
	$type = $_POST['type'];
	$uid = intval($_POST['uid']);
	
	$db=open();
	//for login
	if($type=='get'){
		$q=$db->prepare('SELECT * FROM pin WHERE uid=?');
		$q->setFetchMode(PDO::FETCH_ASSOC);  //associative array
		$q->execute(array($uid));
		
		$result= $q->fetch();
		$count = count($result);
		
		if($count>0){
			$response['pin']=$result['pin'];
			$response['success']=1;
		}else{
			$response['success']=0;
		}
	//for setting the pin
	}else if($type=='set'){
		$pin = intval($_POST['pin']);
		
		$q=$db->prepare('INSERT INTO pin VALUES (?,?))');
		$q->execute(array($uid,$pin));
		$response['success']=1;
	}
	$db=null;
	echo json_encode($response);
}
?>