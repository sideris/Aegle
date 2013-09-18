<?php
require 'site_functions.php';
if (isset($_SESSION['uid'])){
	$user=findDoc($_SESSION['uid']);
	echo "<p>You are  already connected as $user[username].</p>";
}elseif($_SESSION['level']==2){
	echo "<meta http-equiv=\"refresh\" content=\"1; URL=doctor.php\">";
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
			include 'header.php';echo "<p>Username <b>$username</b> is not available.</p>"; include 'footer.php';  
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=signup.php\">";
			$err=1;
		}
	}else {
		include 'header.php';echo "<p>Invalid Username.</p>";  include 'footer.php'; 
		echo "<meta http-equiv=\"refresh\" content=\"2; URL=signup.php\">";
		$err=1;
	}
	if(validEmail($email)){
		if(emailTaken($email)||emailTaken2($email)){
			include 'header.php';echo "<p>The email already exists</p>"; include 'footer.php';  
			echo "<meta http-equiv=\"refresh\" content=\"2; URL=signup.php\">";	
			$err=1;
		}	
	}else{ 
		include 'header.php';echo "<p>Invalid email.</p>";include 'footer.php';  
		echo "<meta http-equiv=\"refresh\" content=\"2; URL=signup.php\">";
		$err=1;
	}
	if($password!=$password2){ 
		include 'header.php';echo "<p>Passwords do not match.</p>"; include 'footer.php'; 
		echo "<meta http-equiv=\"refresh\" content=\"2; URL=signup.php\">";		
		$err=1;
	}
	if ($err==0){
		$sql = "insert into doc values (NULL,'$username','$first','$last','$password','$email','docdef.png','2',NULL,NULL,NULL)";
		open();
		$result = mysql_query($sql);
		close();
		if ($result){
			include 'header.php';echo "<p>Your registration was succesful</p><p>You can connect now</p>"; include 'footer.php';  
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
		}else{
			include 'header.php';echo "<p>Error during registration</p>"; include 'footer.php'; 
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=signup.php\">";
		}
	}
}else{
	include 'header.php';echo "<p>Please fill all the required areas (*)</p>"; include 'footer.php'; 
	echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
}
?>
