<?php 
	require 'site_functions.php'; 
	if(isset($_SESSION['uid'])||isset($_SESSION['did'])){
		if($_SESSION['level']==1){
			echo "<meta http-equiv=\"refresh\" content=\"0; URL=user.php?uid=$_SESSION[uid]\">";
		}elseif($_SESSION['level']==2){
			echo "<meta http-equiv=\"refresh\" content=\"0; URL=doctor.php?did=$_SESSION[did]\">";
		}
	}
	
	if(!isset($_SESSION['uid']) && !empty($_POST['usermail']) && !empty($_POST['password'])){
		open();
		if(strstr($_POST['usermail'],"@")){
			$email=mysql_real_escape_string(trim($_POST['usermail']));
			$username=findUsername($email);
			$username2=findUsername2($email);
		}else{
			$username=mysql_real_escape_string(trim($_POST['usermail']));
			$username2=$username;
		}
		open();
		$password=md5(sha1(mysql_real_escape_string(trim($_POST['password']))));
		close();
		$signin=0;
		if (confirmUser(trim($username),trim($password))){
			$sql = "select * from user where username = '$username'";
			open();
			@ $result = mysql_fetch_array(mysql_query($sql));
			close();
			$_SESSION['uid']=$result['id'];
			$_SESSION['level']=$result['level'];
			$class=1;
			$signin=1;
			open();
			if(isset($_POST['remember'])) $remember=mysql_real_escape_string($_POST['remember']);
			close();				
			if ($remember==1){
				setcookie('username',"$username",time()+24*36000);
				setcookie('password',"$password",time()+24*36000);
			}
		}elseif(confirmDoc(trim($username2),trim($password))){
			$sql = "select * from doc where username = '$username2'";
			open();
			@ $result2 = mysql_fetch_array(mysql_query($sql));
			close();
			$_SESSION['did']=$result2['id'];
			$_SESSION['level']=$result2['level'];
			$class=2;
			$signin=1;
			open();
			if(isset($_POST['remember'])) $remember=mysql_real_escape_string($_POST['remember']);
			close();				
			if ($remember==1){
				setcookie('username',"$username",time()+24*36000);
				setcookie('password',"$password",time()+24*36000);
			}
		}
	}
	require 'header.php';
	echo "<div id=\"signin\" class=\"form\">";

	 if (!isset($_POST['hidden']) && empty($_POST['usermail']) && empty($_POST['password']) ){
		echo <<< SIGNIN
			<form method="post">
				<h1>Connect</h1>
				<p></p>
				<input type="hidden" name="hidden">
				<label>Username <span class="formsmall" style="color:#666666;font-size:0.6em;">or Email</span></label>
				<input type="text" name="usermail" style="margin-right:-2px;" tabindex=1/>
				<br><label>
					Password
					<span class="formsmall"style="font-size:11px;color:#666666;"><a href="reset.php" tabindex=5 >Recover</a></span>
				</label>
				<input type="password" name="password" tabindex=2 />
				<p><label>Save</label>
				<input id="remember" name="remember" type="checkbox" value="1" tabindex=3  />				
				<button  type="submit" tabindex=4>Send</button>
				</p>
				<div class="spacer"></div>
			</form>
SIGNIN;
	}elseif(isset($username) && isset($password) && isset($signin)){
		if ($signin==1){
			echo "<label>Welcome <b>$username</b></label>";
			if($class==1){
				$id=$_SESSION['uid'];
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=user.php?uid=$id\">";
			}
			if($class==2){
				$id=$_SESSION['did'];
				echo "<meta http-equiv=\"refresh\" content=\"1; URL=doctor.php?did=$id\">";
			}
		}elseif($signin==0){
			echo "<p>Wrong username or password</p>";
			echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
		}
	}else{
		echo "<p>You have to input username and password</p>";
		echo "<meta http-equiv=\"refresh\" content=\"1; URL=signin.php\">";
	}
	echo "</div><div style=\"height:500px;\"></div>";
	require 'footer.php'; 
?>
