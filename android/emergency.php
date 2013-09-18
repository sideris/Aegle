<?php  
require 'db.php';
//if(isset($_POST['SUPER_SECRET_KEY']){
//$key=clear($_POST['SUPER_SECRET_KEY']);
//here we have to check the key along a list of trusted keys(but we don't so don't search)
	if(isset($_POST['uid'])){
		$uid=intval($_POST['uid']);
		$type=clear($_POST['type']);
		
		$db=open();
		$q =$db->prepare('SELECT * FROM us_'.$type.' WHERE uid=?');
		$q->setFetchMode(PDO::FETCH_ASSOC);  //associative array
		$q->execute(array($uid));
		$response=array();
		$count=count($q->fetch());
		
		if($count>0){
			$q->execute(array($uid));
			$i=0;
			while($data=$q->fetch(PDO::FETCH_ASSOC)){
				$response['values'][$i]=$data['name'];
				$i++;
			}
			$response['success']=1;
		}else{
			$response['success']=0;
		}
		echo json_encode($response);
		$db=null;
	}
//}
?>