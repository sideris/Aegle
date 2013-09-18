<?php
require 'site_functions.php';
if (isset($_SESSION['uid'])){
	$user=findUser($_SESSION['uid']);
	echo "<p>You are  already connected as $user[username].</p>";
}elseif($_SESSION['level']==1){
	echo "<meta http-equiv=\"refresh\" content=\"1; URL=user.php\">";
}elseif(!empty($_POST['weight'])&&!empty($_POST['height'])&&!empty($_POST['month'])&&!empty($_POST['gender'])&&!empty($_POST['username']) && !empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['usermail'])&&!empty($_POST['password'])&&!empty($_POST['password2'])){
open();
		$weight=mysql_real_escape_string(trim($_POST['weight']));
		$height=mysql_real_escape_string(trim($_POST['height']));
		$month=mysql_real_escape_string(trim($_POST['month']));
		$day=mysql_real_escape_string(trim($_POST['day']));
		$year=mysql_real_escape_string(trim($_POST['year']));
		$gender=mysql_real_escape_string(trim($_POST['gender']));if($gender=="Gender"){$gender=NULL;}if($gender=="Gender"){$gender=NULL;}
		$first=mysql_real_escape_string(trim($_POST['fname']));
		$last=mysql_real_escape_string(trim($_POST['lname']));
		$username=mysql_real_escape_string(trim($_POST['username']));
		$email=mysql_real_escape_string(trim($_POST['usermail']));
		$password=md5(sha1(mysql_real_escape_string(trim($_POST['password']))));
		$password2=md5(sha1(mysql_real_escape_string(trim($_POST['password2']))));
close();
		$err=0;
if(!strstr($username,"@")){ 
			if(usernameTaken($username)||usernameTaken2($username)){ 
				include 'header.php';echo "<p>Username <b>$username</b> is not available.</p>";  include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";
				$err=1;
			}
		}else {
			include 'header.php';
			echo "<p>Invalid Username.</p>"; 
			include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";
			$err=1;
		}
		if(validEmail($email)){
			if(emailTaken($email)||emailTaken2($email)){
				include 'header.php';
				echo "<p>The email already exists</p>"; 
				include 'footer.php';
				echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";	
				$err=1;
			}	
		}else{ 
			include 'header.php';echo "<p>Invalid email.</p>";include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";
			$err=1;
		}
		if($password!=$password2){ 
			include 'header.php';
			echo "<p>Passwords do not match.</p>"; 
			include 'footer.php';
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";		
			$err=1;
		}
		
		if ($err==0){
			$sql = "insert into user values ('','$username','$first','$last','$password','$email',NULL,NULL,'1','$weight','$height','$gender','$month','$day','$year','default.jpg')";
			mkdir(userfolders/$username,0700);
			open();
			$result = mysql_query($sql);
			close();
			if ($result){
				include 'header.php';
				echo "<p>Your registration was succesful</p><p>You can connect now</p>"; 
				include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
			}else{
				echo "<p>Error during registration</p>";
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			}
		}
	}elseif(!empty($_POST['height'])&&!empty($_POST['month'])&&!empty($_POST['weight'])&&!empty($_POST['username']) && !empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['usermail'])&&!empty($_POST['password'])&&!empty($_POST['password2'])){

open();
		//$weight=mysql_real_escape_string(trim($_POST['weight']));
		$height=mysql_real_escape_string(trim($_POST['height']));
		$month=mysql_real_escape_string(trim($_POST['month']));
		$day=mysql_real_escape_string(trim($_POST['day']));
		$year=mysql_real_escape_string(trim($_POST['year']));
		$gender=mysql_real_escape_string(trim($_POST['gender']));if($gender=="Gender"){$gender=NULL;}
		$first=mysql_real_escape_string(trim($_POST['fname']));
		$last=mysql_real_escape_string(trim($_POST['lname']));
		$username=mysql_real_escape_string(trim($_POST['username']));
		$email=mysql_real_escape_string(trim($_POST['usermail']));
		$password=md5(sha1(mysql_real_escape_string(trim($_POST['password']))));
		$password2=md5(sha1(mysql_real_escape_string(trim($_POST['password2']))));
close();
		
		$err=0;
if(!strstr($username,"@")){ 
			if(usernameTaken($username)||usernameTaken2($username)){ 
				include 'header.php';echo "<p>Username <b>$username</b> is not available.</p>";  include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
				$err=1;
			}
		}
		else {
			include 'header.php';echo "<p>Invalid Username.</p>"; include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if(validEmail($email)){
			if(emailTaken($email)||emailTaken2($email)){
								include 'header.php';echo "<p>The email already exists</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";	
				$err=1;
			}	
		}
		else{ 
			include 'header.php';echo "<p>Invalid email.</p>";include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if($password!=$password2){ 
			include 'header.php';echo "<p>Passwords do not match.</p>"; include 'footer.php';
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";		
			$err=1;
		}
		
		if ($err==0){
			$sql = "insert into user values ('','$username','$first','$last','$password','$email',NULL,NULL,'1',NULL,'$height','$gender','$month','$day','$year','default.jpg')";
			mkdir(userfolders/$username,0700);
			open();
			$result = mysql_query($sql);
			close();
			if ($result){
				include 'header.php';echo "<p>Your registration was succesful</p><p>You can connect now</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
			}
			else{
				echo "<p>Error during registration</p>";
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			}
		}
	}
	elseif(!empty($_POST['weight'])&&!empty($_POST['month'])&&!empty($_POST['gender'])&&!empty($_POST['username']) && !empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['usermail'])&&!empty($_POST['password'])&&!empty($_POST['password2']))
{
open();
		$weight=mysql_real_escape_string(trim($_POST['weight']));
		//$height=mysql_real_escape_string(trim($_POST['height']));
		$month=mysql_real_escape_string(trim($_POST['month']));
		$day=mysql_real_escape_string(trim($_POST['day']));
		$year=mysql_real_escape_string(trim($_POST['year']));
		$gender=mysql_real_escape_string(trim($_POST['gender']));if($gender=="Gender"){$gender=NULL;}
		$first=mysql_real_escape_string(trim($_POST['fname']));
		$last=mysql_real_escape_string(trim($_POST['lname']));
		$username=mysql_real_escape_string(trim($_POST['username']));
		$email=mysql_real_escape_string(trim($_POST['usermail']));
		$password=md5(sha1(mysql_real_escape_string(trim($_POST['password']))));
		$password2=md5(sha1(mysql_real_escape_string(trim($_POST['password2']))));
close();
		
		$err=0;
if(!strstr($username,"@")){ 
			if(usernameTaken($username)||usernameTaken2($username)){ 
				include 'header.php';echo "<p>Username <b>$username</b> is not available.</p>";  include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
				$err=1;
			}
		}
		else {
			include 'header.php';echo "<p>Invalid Username.</p>"; include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if(validEmail($email)){
			if(emailTaken($email)||emailTaken2($email)){
								include 'header.php';echo "<p>The email already exists</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";	
				$err=1;
			}	
		}
		else{ 
			include 'header.php';echo "<p>Invalid email.</p>";include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if($password!=$password2){ 
			include 'header.php';echo "<p>Passwords do not match.</p>"; include 'footer.php';
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";		
			$err=1;
		}
		
		if ($err==0){
			$sql = "insert into user values ('','$username','$first','$last','$password','$email',NULL,NULL,'1','$weight',NULL,'$gender','$month','$day','$year','default.jpg')";
			mkdir(userfolders/$username,0700);
			open();
			$result = mysql_query($sql);
			close();
			if ($result){
				include 'header.php';echo "<p>Your registration was succesful</p><p>You can connect now</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
			}
			else{
				echo "<p>Error during registration</p>";
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			}
		}
}
	elseif(!empty($_POST['weight'])&&!empty($_POST['height'])&&!empty($_POST['gender'])&&!empty($_POST['username']) && !empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['usermail'])&&!empty($_POST['password'])&&!empty($_POST['password2']))
{
open();
		$weight=mysql_real_escape_string(trim($_POST['weight']));
		$height=mysql_real_escape_string(trim($_POST['height']));
		//$month=mysql_real_escape_string(trim($_POST['month']));
		//$day=mysql_real_escape_string(trim($_POST['day']));
		//$year=mysql_real_escape_string(trim($_POST['year']));
		$gender=mysql_real_escape_string(trim($_POST['gender']));if($gender=="Gender"){$gender=NULL;}
		$first=mysql_real_escape_string(trim($_POST['fname']));
		$last=mysql_real_escape_string(trim($_POST['lname']));
		$username=mysql_real_escape_string(trim($_POST['username']));
		$email=mysql_real_escape_string(trim($_POST['usermail']));
		$password=md5(sha1(mysql_real_escape_string(trim($_POST['password']))));
		$password2=md5(sha1(mysql_real_escape_string(trim($_POST['password2']))));
close();
		
		$err=0;
if(!strstr($username,"@")){ 
			if(usernameTaken($username)||usernameTaken2($username)){ 
				include 'header.php';echo "<p>Username <b>$username</b> is not available.</p>";  include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
				$err=1;
			}
		}
		else {
			include 'header.php';echo "<p>Invalid Username.</p>"; include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if(validEmail($email)){
			if(emailTaken($email)||emailTaken2($email)){
								include 'header.php';echo "<p>The email already exists</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";	
				$err=1;
			}	
		}
		else{ 
			include 'header.php';echo "<p>Invalid email.</p>";include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if($password!=$password2){ 
			include 'header.php';echo "<p>Passwords do not match.</p>"; include 'footer.php';
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";		
			$err=1;
		}
		
		if ($err==0){
			$sql = "insert into user values ('','$username','$first','$last','$password','$email',NULL,NULL,'1','$weight','$height','$gender',NULL,NULL,NULL,'default.jpg')";
			mkdir(userfolders/$username,0700);
			open();
			$result = mysql_query($sql);
			close();
			if ($result){
				include 'header.php';echo "<p>Your registration was succesful</p><p>You can connect now</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
			}
			else{
				echo "<p>Error during registration</p>";
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			}
		}
}
	elseif(!empty($_POST['weight'])&&!empty($_POST['height'])&&!empty($_POST['month'])&&!empty($_POST['username']) && !empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['usermail'])&&!empty($_POST['password'])&&!empty($_POST['password2']))
{
open();
		$weight=mysql_real_escape_string(trim($_POST['weight']));
		$height=mysql_real_escape_string(trim($_POST['height']));
		$month=mysql_real_escape_string(trim($_POST['month']));
		$day=mysql_real_escape_string(trim($_POST['day']));
		$year=mysql_real_escape_string(trim($_POST['year']));
		//$gender=mysql_real_escape_string(trim($_POST['gender']));if($gender=="Gender"){$gender=NULL;}
		$first=mysql_real_escape_string(trim($_POST['fname']));
		$last=mysql_real_escape_string(trim($_POST['lname']));
		$username=mysql_real_escape_string(trim($_POST['username']));
		$email=mysql_real_escape_string(trim($_POST['usermail']));
		$password=md5(sha1(mysql_real_escape_string(trim($_POST['password']))));
		$password2=md5(sha1(mysql_real_escape_string(trim($_POST['password2']))));
close();
		
		$err=0;
if(!strstr($username,"@")){ 
			if(usernameTaken($username)||usernameTaken2($username)){ 
				include 'header.php';echo "<p>Username <b>$username</b> is not available.</p>";  include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
				$err=1;
			}
		}
		else {
			include 'header.php';echo "<p>Invalid Username.</p>"; include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if(validEmail($email)){
			if(emailTaken($email)||emailTaken2($email)){
								include 'header.php';echo "<p>The email already exists</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";	
				$err=1;
			}	
		}
		else{ 
			include 'header.php';echo "<p>Invalid email.</p>";include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if($password!=$password2){ 
			
			include 'header.php';echo "<p>Passwords do not match.</p>"; include 'footer.php';
			
			echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";		
			$err=1;
		}
		
		if ($err==0){
			$sql = "insert into user values ('','$username','$first','$last','$password','$email',NULL,NULL,'1','$weight',NULL,'$gender','$month','$day','$year','default.jpg')";
			mkdir(userfolders/$username,0700);
			open();
			$result = mysql_query($sql);
			close();
			if ($result){
				include 'header.php';echo "<p>Your registration was succesful</p><p>You can connect now</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
			}
			else{
				echo "<p>Error during registration</p>";
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			}
		}
}
	elseif(!empty($_POST['month'])&&!empty($_POST['gender'])&&!empty($_POST['username']) && !empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['usermail'])&&!empty($_POST['password'])&&!empty($_POST['password2']))
{
open();
		//$weight=mysql_real_escape_string(trim($_POST['weight']));
		//$height=mysql_real_escape_string(trim($_POST['height']));
		$month=mysql_real_escape_string(trim($_POST['month']));
		$day=mysql_real_escape_string(trim($_POST['day']));
		$year=mysql_real_escape_string(trim($_POST['year']));
		$gender=mysql_real_escape_string(trim($_POST['gender']));if($gender=="Gender"){$gender=NULL;}
		$first=mysql_real_escape_string(trim($_POST['fname']));
		$last=mysql_real_escape_string(trim($_POST['lname']));
		$username=mysql_real_escape_string(trim($_POST['username']));
		$email=mysql_real_escape_string(trim($_POST['usermail']));
		$password=md5(sha1(mysql_real_escape_string(trim($_POST['password']))));
		$password2=md5(sha1(mysql_real_escape_string(trim($_POST['password2']))));
close();
		
		$err=0;
if(!strstr($username,"@")){ 
			if(usernameTaken($username)||usernameTaken2($username)){ 
				include 'header.php';echo "<p>Username <b>$username</b> is not available.</p>";  include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
				$err=1;
			}
		}
		else {
			include 'header.php';echo "<p>Invalid Username.</p>"; include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if(validEmail($email)){
			if(emailTaken($email)||emailTaken2($email)){
								include 'header.php';echo "<p>The email already exists</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";	
				$err=1;
			}	
		}
		else{ 
			include 'header.php';echo "<p>Invalid email.</p>";include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if($password!=$password2){ 
			include 'header.php';echo "<p>Passwords do not match.</p>"; include 'footer.php';
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";		
			$err=1;
		}
		
		if ($err==0){
			$sql = "insert into user values ('','$username','$first','$last','$password','$email',NULL,NULL,'1',NULL,NULL,'$gender','$month','$day','$year','default.jpg')";
			mkdir(userfolders/$username,0700);
			open();
			$result = mysql_query($sql);
			close();
			if ($result){
				include 'header.php';echo "<p>Your registration was succesful</p><p>You can connect now</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
			}
			else{
				echo "<p>Error during registration</p>";
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			}
		}
}
	elseif(!empty($_POST['height'])&&!empty($_POST['gender'])&&!empty($_POST['username']) && !empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['usermail'])&&!empty($_POST['password'])&&!empty($_POST['password2']))
{
open();
		//$weight=mysql_real_escape_string(trim($_POST['weight']));
		$height=mysql_real_escape_string(trim($_POST['height']));
		//$month=mysql_real_escape_string(trim($_POST['month']));
		//$day=mysql_real_escape_string(trim($_POST['day']));
		//$year=mysql_real_escape_string(trim($_POST['year']));
		$gender=mysql_real_escape_string(trim($_POST['gender']));if($gender=="Gender"){$gender=NULL;}
		$first=mysql_real_escape_string(trim($_POST['fname']));
		$last=mysql_real_escape_string(trim($_POST['lname']));
		$username=mysql_real_escape_string(trim($_POST['username']));
		$email=mysql_real_escape_string(trim($_POST['usermail']));
		$password=md5(sha1(mysql_real_escape_string(trim($_POST['password']))));
		$password2=md5(sha1(mysql_real_escape_string(trim($_POST['password2']))));
close();
		
		$err=0;
if(!strstr($username,"@")){ 
			if(usernameTaken($username)||usernameTaken2($username)){ 
				include 'header.php';echo "<p>Username <b>$username</b> is not available.</p>";  include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
				$err=1;
			}
		}
		else {
			include 'header.php';echo "<p>Invalid Username.</p>"; include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if(validEmail($email)){
			if(emailTaken($email)||emailTaken2($email)){
								include 'header.php';echo "<p>The email already exists</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";	
				$err=1;
			}	
		}
		else{ 
			include 'header.php';echo "<p>Invalid email.</p>";include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if($password!=$password2){ 
			include 'header.php';echo "<p>Passwords do not match.</p>"; include 'footer.php';
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";		
			$err=1;
		}
		
		if ($err==0){
			$sql = "insert into user values ('','$username','$first','$last','$password','$email',NULL,NULL,'1',NULL,'$height','$gender',NULL,NULL,NULL,'default.jpg')";
			mkdir(userfolders/$username,0700);
			open();
			$result = mysql_query($sql);
			close();
			if ($result){
				include 'header.php';echo "<p>Your registration was succesful</p><p>You can connect now</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
			}
			else{
				echo "<p>Error during registration</p>";
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			}
		}
}
	elseif(!empty($_POST['height'])&&!empty($_POST['month'])&&!empty($_POST['username']) && !empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['usermail'])&&!empty($_POST['password'])&&!empty($_POST['password2']))
{
open();
		//$weight=mysql_real_escape_string(trim($_POST['weight']));
		$height=mysql_real_escape_string(trim($_POST['height']));
		$month=mysql_real_escape_string(trim($_POST['month']));
		$day=mysql_real_escape_string(trim($_POST['day']));
		$year=mysql_real_escape_string(trim($_POST['year']));
		//$gender=mysql_real_escape_string(trim($_POST['gender']));if($gender=="Gender"){$gender=NULL;}
		$first=mysql_real_escape_string(trim($_POST['fname']));
		$last=mysql_real_escape_string(trim($_POST['lname']));
		$username=mysql_real_escape_string(trim($_POST['username']));
		$email=mysql_real_escape_string(trim($_POST['usermail']));
		$password=md5(sha1(mysql_real_escape_string(trim($_POST['password']))));
		$password2=md5(sha1(mysql_real_escape_string(trim($_POST['password2']))));
close();
		
		$err=0;
if(!strstr($username,"@")){ 
			if(usernameTaken($username)||usernameTaken2($username)){ 
				include 'header.php';echo "<p>Username <b>$username</b> is not available.</p>";  include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
				$err=1;
			}
		}
		else {
			include 'header.php';echo "<p>Invalid Username.</p>"; include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if(validEmail($email)){
			if(emailTaken($email)||emailTaken2($email)){
								include 'header.php';echo "<p>The email already exists</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";	
				$err=1;
			}	
		}
		else{ 
			include 'header.php';echo "<p>Invalid email.</p>";include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if($password!=$password2){ 
			include 'header.php';echo "<p>Passwords do not match.</p>"; include 'footer.php';
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";		
			$err=1;
		}
		
		if ($err==0){
			$sql = "insert into user values ('','$username','$first','$last','$password','$email',NULL,NULL,'1',NULL,'$height',NULL,'$month','$day','$year','default.jpg')";
			mkdir(userfolders/$username,0700);
			open();
			$result = mysql_query($sql);
			close();
			if ($result){
				include 'header.php';echo "<p>Your registration was succesful</p><p>You can connect now</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
			}
			else{
				echo "<p>Error during registration</p>";
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			}
		}
}
	elseif(!empty($_POST['weight'])&&!empty($_POST['gender'])&&!empty($_POST['username']) && !empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['usermail'])&&!empty($_POST['password'])&&!empty($_POST['password2']))
{
open();
		$weight=mysql_real_escape_string(trim($_POST['weight']));
		//$height=mysql_real_escape_string(trim($_POST['height']));
		//$month=mysql_real_escape_string(trim($_POST['month']));
		//$day=mysql_real_escape_string(trim($_POST['day']));
		//$year=mysql_real_escape_string(trim($_POST['year']));
		$gender=mysql_real_escape_string(trim($_POST['gender']));if($gender=="Gender"){$gender=NULL;}
		$first=mysql_real_escape_string(trim($_POST['fname']));
		$last=mysql_real_escape_string(trim($_POST['lname']));
		$username=mysql_real_escape_string(trim($_POST['username']));
		$email=mysql_real_escape_string(trim($_POST['usermail']));
		$password=md5(sha1(mysql_real_escape_string(trim($_POST['password']))));
		$password2=md5(sha1(mysql_real_escape_string(trim($_POST['password2']))));
close();
		
		$err=0;
if(!strstr($username,"@")){ 
			if(usernameTaken($username)||usernameTaken2($username)){ 
				include 'header.php';echo "<p>Username <b>$username</b> is not available.</p>";  include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
				$err=1;
			}
		}
		else {
			include 'header.php';echo "<p>Invalid Username.</p>"; include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if(validEmail($email)){
			if(emailTaken($email)||emailTaken2($email)){
								include 'header.php';echo "<p>The email already exists</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";	
				$err=1;
			}	
		}
		else{ 
			include 'header.php';echo "<p>Invalid email.</p>";include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if($password!=$password2){ 
			include 'header.php';echo "<p>Passwords do not match.</p>"; include 'footer.php';
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";		
			$err=1;
		}
		
		if ($err==0){
			$sql = "insert into user values ('','$username','$first','$last','$password','$email',NULL,NULL,'1','$weight',NULL,'$gender',NULL,NULL,NULL,'default.jpg')";
			mkdir(userfolders/$username,0700);
			open();
			$result = mysql_query($sql);
			close();
			if ($result){
				include 'header.php';echo "<p>Your registration was succesful</p><p>You can connect now</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
			}
			else{
				echo "<p>Error during registration</p>";
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			}
		}
}
	elseif(!empty($_POST['weight'])&&!empty($_POST['month'])&&!empty($_POST['username']) && !empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['usermail'])&&!empty($_POST['password'])&&!empty($_POST['password2']))
{
open();
		$weight=mysql_real_escape_string(trim($_POST['weight']));
		//$height=mysql_real_escape_string(trim($_POST['height']));
		$month=mysql_real_escape_string(trim($_POST['month']));
		$day=mysql_real_escape_string(trim($_POST['day']));
		$year=mysql_real_escape_string(trim($_POST['year']));
		//$gender=mysql_real_escape_string(trim($_POST['gender']));if($gender=="Gender"){$gender=NULL;}
		$first=mysql_real_escape_string(trim($_POST['fname']));
		$last=mysql_real_escape_string(trim($_POST['lname']));
		$username=mysql_real_escape_string(trim($_POST['username']));
		$email=mysql_real_escape_string(trim($_POST['usermail']));
		$password=md5(sha1(mysql_real_escape_string(trim($_POST['password']))));
		$password2=md5(sha1(mysql_real_escape_string(trim($_POST['password2']))));
close();
		
		$err=0;
if(!strstr($username,"@")){ 
			if(usernameTaken($username)||usernameTaken2($username)){ 
				include 'header.php';echo "<p>Username <b>$username</b> is not available.</p>";  include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
				$err=1;
			}
		}
		else {
			include 'header.php';echo "<p>Invalid Username.</p>"; include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if(validEmail($email)){
			if(emailTaken($email)||emailTaken2($email)){
								include 'header.php';echo "<p>The email already exists</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";	
				$err=1;
			}	
		}
		else{ 
			include 'header.php';echo "<p>Invalid email.</p>";include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if($password!=$password2){ 
			include 'header.php';echo "<p>Passwords do not match.</p>"; include 'footer.php';
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";		
			$err=1;
		}
		
		if ($err==0){
			$sql = "insert into user values ('','$username','$first','$last','$password','$email',NULL,NULL,'1','$weight',NULL,NULL,'$month','$day','$year','default.jpg')";
			mkdir(userfolders/$username,0700);
			open();
			$result = mysql_query($sql);
			close();
			if ($result){
				include 'header.php';echo "<p>Your registration was succesful</p><p>You can connect now</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
			}
			else{
				echo "<p>Error during registration</p>";
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			}
		}
}
	elseif(!empty($_POST['weight'])&&!empty($_POST['height'])&&!empty($_POST['username']) && !empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['usermail'])&&!empty($_POST['password'])&&!empty($_POST['password2']))
{
open();
		$weight=mysql_real_escape_string(trim($_POST['weight']));
		$height=mysql_real_escape_string(trim($_POST['height']));
		//$month=mysql_real_escape_string(trim($_POST['month']));
		//$day=mysql_real_escape_string(trim($_POST['day']));
		//$year=mysql_real_escape_string(trim($_POST['year']));
		//$gender=mysql_real_escape_string(trim($_POST['gender']));if($gender=="Gender"){$gender=NULL;}
		$first=mysql_real_escape_string(trim($_POST['fname']));
		$last=mysql_real_escape_string(trim($_POST['lname']));
		$username=mysql_real_escape_string(trim($_POST['username']));
		$email=mysql_real_escape_string(trim($_POST['usermail']));
		$password=md5(sha1(mysql_real_escape_string(trim($_POST['password']))));
		$password2=md5(sha1(mysql_real_escape_string(trim($_POST['password2']))));
close();
		
		$err=0;
if(!strstr($username,"@")){ 
			if(usernameTaken($username)||usernameTaken2($username)){ 
				include 'header.php';echo "<p>Username <b>$username</b> is not available.</p>";  include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
				$err=1;
			}
		}
		else {
			include 'header.php';echo "<p>Invalid Username.</p>"; include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if(validEmail($email)){
			if(emailTaken($email)||emailTaken2($email)){
								include 'header.php';echo "<p>The email already exists</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";	
				$err=1;
			}	
		}
		else{ 
			include 'header.php';echo "<p>Invalid email.</p>";include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if($password!=$password2){ 
			include 'header.php';echo "<p>Passwords do not match.</p>"; include 'footer.php';
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";		
			$err=1;
		}
		
		if ($err==0){
			$sql = "insert into user values ('','$username','$first','$last','$password','$email',NULL,NULL,'1','$weight','$height',NULL,NULL,NULL,NULL,'default.jpg')";
			mkdir(userfolders/$username,0700);
			open();
			$result = mysql_query($sql);
			close();
			if ($result){
				include 'header.php';echo "<p>Your registration was succesful</p><p>You can connect now</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
			}
			else{
				echo "<p>Error during registration</p>";
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			}
		}
}
elseif(!empty($_POST['gender'])&&!empty($_POST['username']) && !empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['usermail'])&&!empty($_POST['password'])&&!empty($_POST['password2']))
{
open();
		//$weight=mysql_real_escape_string(trim($_POST['weight']));
		//$height=mysql_real_escape_string(trim($_POST['height']));
		//$month=mysql_real_escape_string(trim($_POST['month']));
		//$day=mysql_real_escape_string(trim($_POST['day']));
		//$year=mysql_real_escape_string(trim($_POST['year']));
		$gender=mysql_real_escape_string(trim($_POST['gender']));if($gender=="Gender"){$gender=NULL;}
		$first=mysql_real_escape_string(trim($_POST['fname']));
		$last=mysql_real_escape_string(trim($_POST['lname']));
		$username=mysql_real_escape_string(trim($_POST['username']));
		$email=mysql_real_escape_string(trim($_POST['usermail']));
		$password=md5(sha1(mysql_real_escape_string(trim($_POST['password']))));
		$password2=md5(sha1(mysql_real_escape_string(trim($_POST['password2']))));
close();
		
		$err=0;
if(!strstr($username,"@")){ 
			if(usernameTaken($username)||usernameTaken2($username)){ 
				include 'header.php';echo "<p>Username <b>$username</b> is not available.</p>";  include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
				$err=1;
			}
		}
		else {
			include 'header.php';echo "<p>Invalid Username.</p>"; include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if(validEmail($email)){
			if(emailTaken($email)||emailTaken2($email)){
								include 'header.php';echo "<p>The email already exists</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";	
				$err=1;
			}	
		}
		else{ 
			include 'header.php';echo "<p>Invalid email.</p>";include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if($password!=$password2){ 
			include 'header.php';echo "<p>Passwords do not match.</p>"; include 'footer.php';
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";		
			$err=1;
		}
		
		if ($err==0){
			$sql = "insert into user values ('','$username','$first','$last','$password','$email',NULL,NULL,'1',NULL,NULL,'$gender',NULL,NULL,NULL,'default.jpg')";
			mkdir(userfolders/$username,0700);
			open();
			$result = mysql_query($sql);
			close();
			if ($result){
				include 'header.php';echo "<p>Your registration was succesful</p><p>You can connect now</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
			}
			else{
				echo "<p>Error during registration</p>";
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			}
		}
}
elseif(!empty($_POST['month'])&&!empty($_POST['username']) && !empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['usermail'])&&!empty($_POST['password'])&&!empty($_POST['password2']))
{open();
		//$weight=mysql_real_escape_string(trim($_POST['weight']));
		//$height=mysql_real_escape_string(trim($_POST['height']));
		$month=mysql_real_escape_string(trim($_POST['month']));
		$day=mysql_real_escape_string(trim($_POST['day']));
		$year=mysql_real_escape_string(trim($_POST['year']));
		//$gender=mysql_real_escape_string(trim($_POST['gender']));if($gender=="Gender"){$gender=NULL;}
		$first=mysql_real_escape_string(trim($_POST['fname']));
		$last=mysql_real_escape_string(trim($_POST['lname']));
		$username=mysql_real_escape_string(trim($_POST['username']));
		$email=mysql_real_escape_string(trim($_POST['usermail']));
		$password=md5(sha1(mysql_real_escape_string(trim($_POST['password']))));
		$password2=md5(sha1(mysql_real_escape_string(trim($_POST['password2']))));
close();
		
		$err=0;
if(!strstr($username,"@")){ 
			if(usernameTaken($username)||usernameTaken2($username)){ 
				include 'header.php';echo "<p>Username <b>$username</b> is not available.</p>";  include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
				$err=1;
			}
		}
		else {
			include 'header.php';echo "<p>Invalid Username.</p>"; include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if(validEmail($email)){
			if(emailTaken($email)||emailTaken2($email)){
								include 'header.php';echo "<p>The email already exists</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";	
				$err=1;
			}	
		}
		else{ 
			include 'header.php';echo "<p>Invalid email.</p>";include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if($password!=$password2){ 
			include 'header.php';echo "<p>Passwords do not match.</p>"; include 'footer.php';
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";		
			$err=1;
		}
		
		if ($err==0){
			$sql = "insert into user values ('','$username','$first','$last','$password','$email',NULL,NULL,'1',NULL,NULL,NULL,'$month','$day','$year','default.jpg')";
			mkdir(userfolders/$username,0700);
			open();
			$result = mysql_query($sql);
			close();
			if ($result){
				include 'header.php';echo "<p>Your registration was succesful</p><p>You can connect now</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
			}
			else{
				echo "<p>Error during registration</p>";
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			}
		}
}
elseif(!empty($_POST['weight'])&&!empty($_POST['username']) && !empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['usermail'])&&!empty($_POST['password'])&&!empty($_POST['password2']))
{open();
		$weight=mysql_real_escape_string(trim($_POST['weight']));
		//$height=mysql_real_escape_string(trim($_POST['height']));
		//$month=mysql_real_escape_string(trim($_POST['month']));
		//$day=mysql_real_escape_string(trim($_POST['day']));
		//$year=mysql_real_escape_string(trim($_POST['year']));
		//$gender=mysql_real_escape_string(trim($_POST['gender']));if($gender=="Gender"){$gender=NULL;}
		$first=mysql_real_escape_string(trim($_POST['fname']));
		$last=mysql_real_escape_string(trim($_POST['lname']));
		$username=mysql_real_escape_string(trim($_POST['username']));
		$email=mysql_real_escape_string(trim($_POST['usermail']));
		$password=md5(sha1(mysql_real_escape_string(trim($_POST['password']))));
		$password2=md5(sha1(mysql_real_escape_string(trim($_POST['password2']))));
close();
		
		$err=0;
if(!strstr($username,"@")){ 
			if(usernameTaken($username)||usernameTaken2($username)){ 
				include 'header.php';echo "<p>Username <b>$username</b> is not available.</p>";  include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
				$err=1;
			}
		}
		else {
			include 'header.php';echo "<p>Invalid Username.</p>"; include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if(validEmail($email)){
			if(emailTaken($email)||emailTaken2($email)){
								include 'header.php';echo "<p>The email already exists</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";	
				$err=1;
			}	
		}
		else{ 
			include 'header.php';echo "<p>Invalid email.</p>";include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if($password!=$password2){ 
			include 'header.php';echo "<p>Passwords do not match.</p>"; include 'footer.php';
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";		
			$err=1;
		}
		if ($err==0){
			$sql = "insert into user values ('','$username','$first','$last','$password','$email',NULL,NULL,'1','$weight',NULL,NULL,NULL,NULL,NULL,'default.jpg')";
			mkdir(userfolders/$username,0700);
			open();
			$result = mysql_query($sql);
			close();
			if ($result){
				include 'header.php';echo "<p>Your registration was succesful</p><p>You can connect now</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
			}else{
				echo "<p>Error during registration</p>";
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			}
		}
}
elseif(!empty($_POST['height'])&&!empty($_POST['username']) && !empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['usermail'])&&!empty($_POST['password'])&&!empty($_POST['password2'])){
open();
		//$weight=mysql_real_escape_string(trim($_POST['weight']));
		$height=mysql_real_escape_string(trim($_POST['height']));
		//$month=mysql_real_escape_string(trim($_POST['month']));
		//$day=mysql_real_escape_string(trim($_POST['day']));
		//$year=mysql_real_escape_string(trim($_POST['year']));
		//$gender=mysql_real_escape_string(trim($_POST['gender']));if($gender=="Gender"){$gender=NULL;}
		$first=mysql_real_escape_string(trim($_POST['fname']));
		$last=mysql_real_escape_string(trim($_POST['lname']));
		$username=mysql_real_escape_string(trim($_POST['username']));
		$email=mysql_real_escape_string(trim($_POST['usermail']));
		$password=md5(sha1(mysql_real_escape_string(trim($_POST['password']))));
		$password2=md5(sha1(mysql_real_escape_string(trim($_POST['password2']))));
close();
		$err=0;
if(!strstr($username,"@")){ 
			if(usernameTaken($username)||usernameTaken2($username)){ 
				include 'header.php';echo "<p>Username <b>$username</b> is not available.</p>";  include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
				$err=1;
			}
		}else{
			include 'header.php';echo "<p>Invalid Username.</p>"; include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if(validEmail($email)){
			if(emailTaken($email)||emailTaken2($email)){
								include 'header.php';echo "<p>The email already exists</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";	
				$err=1;
			}	
		}else{ 
			include 'header.php';echo "<p>Invalid email.</p>";include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if($password!=$password2){ 
			include 'header.php';echo "<p>Passwords do not match.</p>"; include 'footer.php';
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";		
			$err=1;
		}
		if ($err==0){
			$sql = "insert into user values ('','$username','$first','$last','$password','$email',NULL,NULL,'1',NULL,'$height',NULL,NULL,NULL,NULL,'default.jpg')";
			mkdir(userfolders/$username,0700);
			open();
			$result = mysql_query($sql);
			close();
			if ($result){
				include 'header.php';echo "<p>Your registration was succesful</p><p>You can connect now</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
			}else{
				echo "<p>Error during registration</p>";
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			}
		}
}elseif(!empty($_POST['username']) && !empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['usermail'])&&!empty($_POST['password'])&&!empty($_POST['password2'])){
	open();
		$first=mysql_real_escape_string(trim($_POST['fname']));
		$last=mysql_real_escape_string(trim($_POST['lname']));
		$username=mysql_real_escape_string(trim($_POST['username']));
		$email=mysql_real_escape_string(trim($_POST['usermail']));
		$password=md5(sha1(mysql_real_escape_string(trim($_POST['password']))));
		$password2=md5(sha1(mysql_real_escape_string(trim($_POST['password2']))));
		close();
		$err=0;
if(!strstr($username,"@")){ 
			if(usernameTaken($username)||usernameTaken2($username)){ 
				include 'header.php';echo "<p>Username <b>$username</b> is not available.</p>";  include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
				$err=1;
			}
		}	else {
			include 'header.php';echo "<p>Invalid Username.</p>"; include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if(validEmail($email)){
			if(emailTaken($email)||emailTaken2($email)){
								include 'header.php';echo "<p>The email already exists</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";	
				$err=1;
			}	
		}else{ 
			include 'header.php';echo "<p>Invalid email.</p>";include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			$err=1;
		}
		if($password!=$password2){ 
			include 'header.php';echo "<p>Passwords do not match.</p>"; include 'footer.php';
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";		
			$err=1;
		}
		if ($err==0){
			$sql = "insert into user values ('','$username','$first','$last','$password','$email',NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,'default.jpg')";
			mkdir(userfolders/$username,0700);
			open();
			$result = mysql_query($sql);
			close();
			if ($result){
				include 'header.php';echo "<p>Your registration was succesful</p><p>You can connect now</p>"; include 'footer.php'; 
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
			}
			else{
				echo "<p>Error during registration</p>";
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
			}
		}
	}else{
		include 'header.php';echo "<p>Please fill all the required areas (*)</p>"; include 'footer.php'; 
		echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";
	}
?>
