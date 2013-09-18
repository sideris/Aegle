<?php  
require 'db.php';
//login with session
if(isset($_POST['sessid'])){
	$uid=intval($_POST['uid']);
	$sessid=clear($_POST['sessid']);

	//connect to the db  
	$db=open();
	$q=$db->prepare('SELECT * FROM us_session WHERE uid=? AND hex=?');	
	$q->setFetchMode(PDO::FETCH_ASSOC);  //associative array
	$q->execute(array($uid,$sessid));
	//fetch the correspodent session
	$rows = $q->fetch();
	//since they match we are good to go
	if($sessid==$rows['hex']){
		//if correct sessid session send data
		$query =$db->prepare('SELECT * FROM user WHERE id=?');
		$query->setFetchMode(PDO::FETCH_ASSOC);  //associative array
		$query->execute(array($uid));
		//fetch the user
		$man=$query->fetch();
		
		$user['id']=$uid;
		$user['name']=$man['name'];
		$user['last']=$man['last'];
		$user['username']=$man['username'];
		$user['email']=$man['email'];
		$user['success']=1;	
		echo json_encode($user);				
	}else{  
		// for incorrect login response
		$user['success']=0;
		echo json_encode($user);
	}  

	$db=null;
//login with username/password
}elseif(isset($_POST['username'])){
	$un=clear($_POST['username']);  
	$pw=md5(sha1($_POST['password']));
	
	//connect to the db  
	$db=open();
	//run the query to search for the username and password the match  
	$query =$db->prepare('SELECT * FROM user WHERE username=? AND password =?');
	$query->setFetchMode(PDO::FETCH_ASSOC);  //associative array
	$query->execute(array($un,$pw));
	$man=$query->fetch(PDO::FETCH_ASSOC);
	
	if($man){ 
		//create the session id
		$rand=sha1(microtime(true).mt_rand(10000,90000));
		
		$user['id']=$man['id'];
		$iad=$man['id'];
		$user['name']=$man['name'];
		$user['last']=$man['last'];
		$user['email']=$man['email'];
		$user['session']=$rand;
		$user['username']=$man['username'];
		$user['success']=1;
		
		$sql0=$db->prepare('DELETE FROM us_session WHERE uid=?');
		$sql0->execute(array($iad));
		
		$sql=$db->prepare('INSERT INTO us_session VALUES (?,?)');
		$sql->execute(array($iad,$rand));
		
		echo json_encode($user);
	}else{
		// for incorrect login response 	
		$user['success']=0;
		echo json_encode($user);
	}
	$db=null;
}

?>  
