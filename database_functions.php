<?php

//db basic
function open() {
	@ $db = mysql_connect('127.0.0.1', 'root', '') or die('Could not connect');
	@ mysql_select_db('eagle') or die('Database not found');
	mysql_set_charset('utf8',$db);
}

function close() {
	@ mysql_close();
}

//user functions
function usernameTaken($username){
	$sql = "select username from user where username = '$username'"; 
	open();
	$result = mysql_query($sql);
	close();
}
function usernameTaken2($username){
	$sql = "select username from doc where username = '$username'"; 
	open();
	$result = mysql_query($sql);
	close();
}

function emailTaken($email){
	$sql = "select email from user where email = '$email'"; 
	open();
	$result = mysql_query($sql);
	close();
	return ((mysql_numrows($result) > 0)?1:0);
}

function emailTaken2($email){
	$sql = "select email from doc where email = '$email'";
	open(); 
	$result2 = mysql_query($sql);
	close();
	return ((mysql_numrows($result2) > 0)?1:0);
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

function confirmUser($username, $password){
	$sql = "select * from user where username = '$username' AND password = '$password'";
	open();
	@ $result = mysql_query($sql);
	close();
	return ((mysql_numrows($result) > 0)?1:0);
}

function confirmDoc($username, $password){
	$sql = "select * from doc where username = '$username' AND password = '$password'";
	open();
	@ $result = mysql_query($sql);
	close();
	return ((mysql_numrows($result) > 0)?1:0);
}

function findUser($id){
	$sql = "select * from user where id = '$id'";
	open();
	@ $result = mysql_fetch_array(mysql_query($sql));
	close();
	return $result;
}

function findDoc($id){
	$sql = "select * from doc where id = '$id'";
	open();
	@ $result = mysql_fetch_array(mysql_query($sql));
	close();
	return $result;
}

function history($id,$sec){
	$sql="select * from us_".$sec." where uid='$id'";
	open();
	@ $result=mysql_query($sql);
	close();
	return $result;
}

function history2($fileid,$sec){
	$sql="select * from us_".$sec." where id='$fileid'";
	open();
	@ $result=mysql_query($sql);
	close();
	return $result;
}

function findUsername($email){
	$sql = "select * from user where email = '$email'";
	open();
	@ $result = mysql_fetch_array(mysql_query($sql));
	close();
	return $result['username'];
}

function findUsername2($email){
	$sql = "select * from doc where email = '$email'";
	open();
	@ $result = mysql_fetch_array(mysql_query($sql));
	close();
	return $result['username'];
}

function findEmail($username){
	$sql = "select * from user where username = '$username'";
	open();
	@ $result = mysql_fetch_array(mysql_query($sql));
	close();
	return $result['email'];
}

function findEmail2($username){
	$sql = "select * from doc where username = '$username'";
	open();
	@ $result = mysql_fetch_array(mysql_query($sql));
	close();
	return $result['email'];
}

function resetPassword($username, $email){
	$random_string=md5(uniqid(rand(), true));
	$new_password=substr($random_string, 0, 8);
	$sha1_password=md5(sha1($new_password));
	$subject = "New password";
	$message = "Username: $username\nNew Password: $new_password\n\nAeglea";
	$headers = 'From: Aeglea <webmaster@aegle.com>' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
	$message = preg_replace("#(?<!\r)\n#si","\r\n", $message);
	if(@ mail( $email, $subject, $message, $headers)){
		$sql="update user set password='$sha1_password' where username='$username'";
		open();
		@ $result = mysql_query($sql);
		close();
		echo "Your new passowrd has been sent at <b>$email</b>.";
	}
}

function resetPassword2($username, $email){
	$random_string=md5(uniqid(rand(), true));
	$new_password=substr($random_string, 0, 8);
	$sha1_password=md5(sha1($new_password));
	$subject = "New password";
	$message = "Username: $username\nNew Password: $new_password\n\nAeglea";
	$headers = 'From: Aeglea <webmaster@aegle.com>' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
	$message = preg_replace("#(?<!\r)\n#si","\r\n", $message);
	if(@ mail( $email, $subject, $message, $headers)){
		$sql="update doc set password='$sha1_password' where username='$username'";
		open();
		@ $result = mysql_query($sql);
		close();
		echo "Your new password has been sent at <b>$email</b>.";
	}
}

function throw404(){
echo <<<a
<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Object not found!</title>
<link rev="made" href="mailto:you@example.com" />
<style type="text/css"><!--/*--><![CDATA[/*><!--*/ 
    body { color: #000000; background-color: #FFFFFF; }
    a:link { color: #0000CC; }
    p, address {margin-left: 3em;}
    span {font-size: smaller;}
/*]]>*/--></style>
</head>

<body>
<h1>Object not found!</h1>
<p>


    The requested URL was not found on this server.

  

    If you entered the URL manually please check your
    spelling and try again.

  

</p>
<p>
If you think this is a server error, please contact
the <a href="mailto:you@example.com">webmaster</a>.

</p>

<h2>Error 404</h2>
<address>
  <a href="/">localhost</a><br />
  
  <span>Tue 04 Sep 2012 06:43:03 PM EEST<br />
  Apache/2.2.21 (Unix) DAV/2 mod_ssl/2.2.21 OpenSSL/1.0.0c PHP/5.3.8 mod_apreq2-20090110/2.7.1 mod_perl/2.0.5 Perl/v5.10.1</span>
</address>
</body>
</html>
a;
}
?>
