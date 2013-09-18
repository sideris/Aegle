<?php
//this function connects to the database and returns the instance
function open(){
	try{
		$host="127.0.0.1";//namehost. It is better to give IP and not "localhost" or etc, 
						  //because it does not have to undergo a name check, which it slows it down significantly
		$dbname="eagle"; //DB name(it's a letter play aegle-eagle)
		$user="root"; //user name
		$pass=""; //user pswd
		//connect callback as PDO
		$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); 
		return $db;
	}catch(PDOException $e){
		echo $e->getMessage();
	}
}
//this functions escapes some characters
function clear($str){
	$str=trim($str);
	$escape=array("#","\\","_","SELECT ","/");
	$ret=str_replace($escape,"",$str);
	return $ret;
}

function validEmail($email){
	$result = true;
	$atIndex = strrpos($email, "@");
	if (is_bool($atIndex) && !$atIndex) $result = false;
	else{
	$domain = substr($email, $atIndex+1);
	$local = substr($email, 0, $atIndex);
	$localLen = strlen($local);
	$domainLen = strlen($domain);
	if ($localLen < 1 || $localLen > 64) $result = false;
	else if ($domainLen < 1 || $domainLen > 255) $result = false;
	else if ($local[0] == '.' || $local[$localLen-1] == '.') $result = false;
	else if (preg_match('/\\.\\./', $local)) $result = false;
	else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) $result = false;
	else if (preg_match('/\\.\\./', $domain)) $result = false;
	else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local))) if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\","",$local))) $result = false;
	if ($result && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) $result = false;
	}
	return $result;
}

//this checks if an email is taken by other user
function emailTaken($email){
	$db=open();
	$sql =$db->prepare('select email from user where email=?');
	$sql->setFetchMode(PDO::FETCH_ASSOC);  //associative array
	$sql->execute(array($email));
	$result=$sql->fetch();
	$count=count($result);
	$db=null;

	if($count>0){
		$ret=1;
	}else{
		$ret=0;
	}
	return $ret;
}
//this checks if the email is taken by a doctor
function emailTaken2($email){
	$db=open();
	$sql =$db->prepare('select email from doc where email=?');
	$sql->setFetchMode(PDO::FETCH_ASSOC);  //associative array
	$sql->execute(array($email));
	$result=$sql->fetch();
	$count=count($result);
	$db=null;
	
	if($count>0){
		$ret=1;
	}else{
		$ret=0;
	}
	return $ret;
}
?>