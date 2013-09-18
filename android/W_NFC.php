<?php  
require 'db.php';

if(isset($_POST['NFC'])){
	$uid=intval($_POST['uid']);
	$db=open();
	//return the bloodtype
	if($_POST['NFC']=='write'){
		$q=$db->prepare('SELECT btype FROM user WHERE id=?');
		$q->setFetchMode(PDO::FETCH_ASSOC);  //associative array
		$q->execute(array($uid));
		if($q){
			$a=$q->fetch(PDO::FETCH_ASSOC);
			$response['btype']=$a['btype'];
			$response['success']=1;
		}else{
			$response['success']=0;
		}
		echo json_encode($response);
	}
}
?>