<?php 
require 'site_functions.php';
require("header.php");
require ('js/jq_funs.php');

if(!isset($_SESSION['did'])){		
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=signin.php\">";
}else{
	$user=findDoc(intval($_GET['did']));
}

if($_GET['did']==$_SESSION['did']){
	include 'js/jfuctions_user.php';
	$id=$_SESSION['did'];
	//start posting settings
		$oldfile=$user['prof'];
		$first=$user['first'];
		$last=$user['last'];
		$email=$user['email'];
		$email=$user['email'];
		$field=$user['field'];
		$place=$user['place'];
		$phone=$user['phone'];

	if (isset($_POST['hiddendoc']) && $err==0){
		open();
			$t_first=mysql_real_escape_string(trim($_POST['first']));
			$t_last=mysql_real_escape_string(trim($_POST['last']));
			$t_email=mysql_real_escape_string(trim($_POST['email']));
			$password=mysql_real_escape_string(trim($_POST['password']));
			$password2=mysql_real_escape_string(trim($_POST['password2']));
			$t_field=mysql_real_escape_string(trim($_POST['field']));
			$t_place=mysql_real_escape_string(trim($_POST['place']));		
			$t_phone=mysql_real_escape_string(trim($_POST['phone']));
			$filename=$_FILES['picd']['name'];
			$tmpfilename=$_FILES['picd']['tmp_name'];
		close();
		$change=0;
			if ((!($first==$t_first))&&$t_first!=""){
				$change=1;
				$sql="update doc set first='$t_first' where id='$id'";
				open();
				@ $result = mysql_query($sql);
				close();
				if(!$result) echo "<p>Error during Name Change</p>";
			}
	
			if ((!($last==$t_last))&&$t_last!=""){
				$change=1;
				$sql="update doc set last='$t_last' where id='$id'";
				open();
				@ $result = mysql_query($sql);
				close();
					if(!$result) echo "<p>Error during last name Change</p>";
			}
			if (!($email==$t_email)){
				$change=1;
				if(validEmail($t_email)){
					if(emailTaken($t_email)||emailTaken2($t_email)){
						echo "<p>Email already exists</p>";
					}else{
						$sql="update doc set email='$t_email' where id='$id'";
						open();
						@ $result = mysql_query($sql);
						close();
						if(!$result){
							echo "<p>Error during email Change</p>";
						}
					}
				}else{ 
					echo "<p>Invalid email</p>";
				}
			}
		
			if (!empty($password) || !empty($password)){
				$change=1;
				if (!empty($password) && !empty($password)){
					$password=md5(sha1($password));
					$password2=md5(sha1($password2));
					if ($password==$password2){
						$sql="update doc set password='$password' where id='$id'";
						open();
						@ $result = mysql_query($sql);
						close();		
					
						if(!$result) echo "<p>Error during email Change</p>";

					}
					else echo"<script>alert(\"Passwords do not match\");</script>";
				}
				else echo"<script>alert(\"Please fill both password fields\");</script>";
			}
				if (!($field==$t_field)){
				$change=1;
				$sql="update doc set field='$t_field' where id='$id'";
				open();
				@ $result = mysql_query($sql);
				close();
				if(!$result) echo "<p>Error during Field of Work change</p>";
			}
		
			if (!(empty($filename))){
				$change=1;
				$err1=0; $err2=0; $err3=0;
				if(isset($filename) & is_uploaded_file($tmfilename)) $err1=1;
				if (!preg_match('/\.(jpg|jpeg|png|bmp)$/i', $filename)) $err2=1;
				
				if ($err1==0 && $err2==0 && $err3==0){
					$userimages=$_SERVER{'DOCUMENT_ROOT'}."/aeglea/profile";

					$name_prepend=0;
					$destination_file_name=$name_prepend."_".$filename;
					while (file_exists("$userimages/$destination_file_name")) {
						$name_prepend+=rand();
						$destination_file_name=$name_prepend."_".$filename;
					}
					$filename=$destination_file_name;
					createthumb("$filename","$tmpfilename","$userimages/$filename",155,155);	
					unlink($tmpfilename);
					$sql="update doc set prof='$filename' where id='$id'";
					open();
					@ $result = mysql_query($sql);
					close();
					if($oldfile!="docdef.png"){
					unlink($_SERVER{'DOCUMENT_ROOT'}.'/aeglea/profile/'.$oldfile);}
					if(!$result) echo "<p>Error uploading profile picture</p>";
				}
				if ($err1==1) { echo"<script>alert(\"Error Uploading images\");</script>";}
				if ($err2==1){ echo"<script>alert(\"Upload only png,bmp or jpg\");</script>";}
				echo"<script type=\"text/javascript\">window.onload=home();</script>";
			}
			if (!($place==$t_place)){
				$change=1;
				$sql="update doc set place='$t_place' where id='$id'";
				open();
				@ $result = mysql_query($sql);
				close();
				if(!$result) echo "<p>Error in changing working place</p>";
			}
			if (!($phone==$t_phone)){
				$change=1;
				$sql="update doc set phone='$t_phone' where id='$id'";
				open();
				@ $result = mysql_query($sql);
				close();
				if(!$result) echo "<p>Error in changing Contact details</p>";
			}
		}
	//end posting settings
	?>
	<div id="loading"><img id="loading-image" src="images/ajax_loader.gif" alt="Loading..." /></div>
	<table align="center">
	<td>
	<div id="left">
	<?php 
	echo<<<A
	 <div id="pic2"><img src="profile/$user[prof]" style="width:155px;height:155px;cursor:auto;border:2px solid #0d2342;margin-top:30px;"/></div>
		<div id="info"> 
		   <table align="left" cellpadding="3">
			<tr align="left">
				<label style="font-size:120%;cursor: text;">$user[first]  $user[last]</label>
			</tr>
			<tr>
				<td align="left"><label style="color:#202020;"><u>Username</u>:  </label><label style="font-style:italic;">$user[username]</label></td>
			</tr><br/>
			<tr align="left">
				<td><label style="color:#202020;"><u>ID</u>: </label><label style="font-style:italic;">$user[id]</label></td>
			</tr>
		   </table>
		</div>
		<div id="info2"></div>
		<div id="l_content">adverts</div>	
	</div>
	</td>
	<td>
		<div id="center_div">
			<div id="au">
			<div id="preview">
			</div>
			</div>
			<div id="navigation">
				<table class="nav2">
					<tr class="nav2">
					<th class="home2" ><div id="home2"><a><button>Home</button></a></div></th>
					<th class="patients"><div id="patients"><a><button>Patients</button></a></div></th>
					<th class="settings2"><div id="sett2"><a><button>Settings</button></a></div></th>
					</tr>
				</table>
			</div>
			<div id="center_cont"><div id="cont1"></div><div id="cont2"></div><div id="cont3"></div><div id="cont4"></div><div id="cont5"></div></div>
		</div>
	</td>
	</table>
A;
}elseif($_SESSION['did']!=$_GET['did']){
	echo "Illegal Access, Sending Report";
	echo "<meta http-equiv=\"refresh\" content=\"2; URL=signin.php?logout\">";
}
require 'footer.php';?>
