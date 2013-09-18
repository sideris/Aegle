<?php
session_start();
error_reporting(E_PARSE); 
	require 'database_functions.php';
	
	if (isset($_GET['logout'])) {
		session_unset();
		session_destroy();
		session_start();
		session_regenerate_id();
		setcookie('username','',0);
		setcookie('password','',0);
		unset($_COOKIE);
	}
	if(isset($_GET['delrel'])){
		open();
		$_GET['delrel']=mysql_real_escape_string(trim($_GET['delrel']));
		$sql="DELETE from relation WHERE uid='$_GET[uid]' AND rid='$_GET[delrel]'";
		$sql2="DELETE from permission WHERE uid='$_GET[uid]' AND pid='$_GET[delrel]'";
		$sql1_2="DELETE from relation WHERE uid='$_GET[delrel]' AND rid='$_GET[uid]'";
		$sql2_2="DELETE from permission WHERE uid='$_GET[delrel]' AND pid='$_GET[uid]'";
		$result=mysql_query($sql);
		$result2=mysql_query($sql2);
		$result3=mysql_query($sql1_2);
		$result4=mysql_query($sql2_2);
		close();
	}
	if(isset($_GET['delrel2'])){
		open();
		$_GET['delrel2']=mysql_real_escape_string(trim($_GET['delrel2']));
		$_GET['delrel3']=mysql_real_escape_string(trim($_GET['delrel3']));
		$sql="DELETE from relation WHERE uid='$_GET[delrel2]' AND rid='$_GET[delrel3]'";
		$sql2="DELETE from permission WHERE uid='$_GET[delrel2]' AND pid='$_GET[delrel3]'";
		$sql1_2="DELETE from relation WHERE uid='$_GET[delrel3]' AND rid='$_GET[delrel2]'";
		$sql2_2="DELETE from permission WHERE uid='$_GET[delrel3]' AND pid='$_GET[delrel2]'";
		$result=mysql_query($sql);
		$result2=mysql_query($sql2);
		$result3=mysql_query($sql1_2);
		$result4=mysql_query($sql2_2);
		close();
	}
	if(!isset($_SESSION['username']) && isset($_COOKIE['username'])){
		$username=addslashes($_COOKIE['username']);
		$password=addslashes($_COOKIE['password']);
		if (confirmUser($username,$password)){
			$sql = "select * from user where username = '$username'";
			open();
			@ $result = mysql_fetch_array(mysql_query($sql));
			close();
			$_SESSION['uid']=$result['id'];
			$_SESSION['level']=$result['level'];
		}elseif (confirmUser2($username,$password)){
			$sql = "select * from doc where username = '$username'";
			open();
			@ $result = mysql_fetch_array(mysql_query($sql));
			close();
			$_SESSION['uid']=$result['id'];
			$_SESSION['level']=$result['level'];
		}else {
			setcookie('username','$username',time()-36000);
			setcookie('password','$password',time()-36000);
			unset($_COOKIE);
		}
	}
?>
