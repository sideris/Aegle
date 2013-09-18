<?php 
	require 'site_functions.php'; 
	require 'header.php';
	echo "<div id=\"remind\" class=\"form\">";
	if (isset($_SESSION['uid'])){
		$user=findUser($_SESSION['uid']);
		echo "<p>You are already connected as $user[username].</p>";
	}else if (!isset($_POST['hidden']) && empty($_POST['usermail'])){
		echo <<< REMIND
			<form method="post">
				<h1>Remind Password</h1>
				<p></p>
				<input type="hidden" name="hidden">
				<label>Username <label class="formsmall">or Email</formsmall></label>
				<input type="text" name="usermail" />
				<button  type="submit">Send</button>
				<div class="spacer"></div>
			</form>
REMIND;
	}else if(!empty($_POST['usermail'])){
		if(strstr($usermail,"@")){
			open();
			$email=mysql_real_escape_string(trim($_POST['usermail']));
			close();
			if (emailTaken($email)){
				$username=findUsername($email);
				$ok=1;
			}elseif(emailTaken2($email)){
				$username=findUsername2($email);
				$ok=1;
			}else echo "<p>No user found with email: <b>$email</b>.</p>";
		}else{
			open();
			$username=mysql_real_escape_string(trim($_POST['usermail']));
			close();
			if (usernameTaken($username)){
				$email=findEmail($username);
				$ok=1;
			}elseif (usernameTaken2($username)){
				$email=findEmail2($username);
				$ok=1;
			}else echo "<p>No user with username: <b>$username</b>.</p>";
		}
		if ($ok=1){
			resetPassword($username, $email);
		}
	}
	else echo "<p>You have to complete username or email</p>";
	echo "</div>";
	require 'footer.php'; 
?>
