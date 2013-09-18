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
	//count if there is a session
	$count=count($check->fetchAll(PDO::FETCH_ASSOC));
	
	if($count==1){	

		if(isset($_POST['uid'])){
			$uid=intval($_POST['uid']);
			$response=array();
			//the below methods clear the POST data and then they check if there exists individually a POST request
			
			if(isset($_POST['name'])){
				$new_name=clear($_POST['name']);
				$data=array($new_name,$uid);
				$sql=$db->prepare('update user set name=? where id=?');
				$sql->execute($data);
				$response["name"]=$new_name;
			}
			
			if(isset($_POST['last'])){
				$new_last=clear($_POST['last']);
				
				$data=array($new_last,$uid);
				$sql=$db->prepare('update user set last=? where id=?');
				$sql->execute($data);
				$response["last"]=$new_last;
			}

			if(isset($_POST['email'])){
				$new_email=clear($_POST['email']);
				//check if email exists and is valid
				if(validEmail($new_email)){
					if(emailTaken($new_email)==1&&emailTaken2($new_email)==1){		
						$sql=$db->prepare('update user set email=? where id=?');
						$sql->execute(array($new_email,$uid));
						$response["email"]=$new_email;
					}else{
						//callbacks fot the application to handle
						$response["warning"]="2";
					}	
				}else{
					//callbacks fot the application to handle
					$response["warning"]="1";
				}
			}

			if(isset($_POST['password'])){
				$new_pwd=md5(sha1($_POST['password']));
				$sql=$db->prepare('update user set password=? where id=?');
				$sql->execute(array($new_pwd,$uid));
			}
			
			$response["success"]=1;
			echo json_encode($response);
		}
	}
	$db=null;
}
?>
