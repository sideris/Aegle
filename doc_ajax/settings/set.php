<?php
require('../../site_functions.php');
require '../../js/jfuctions_user.php';
?>
<?php
$user=findDoc($_SESSION['did']);
$id=$_SESSION['did'];
$oldfile=$user['prof'];
echo "<div id=\"settings1\" class=\"form\" style=\"float:middle;\">";
	$first=$user['first'];
	$last=$user['last'];
	$email=$user['email'];
	$field=$user['field'];
	$place=$user['place'];
	$phone=$user['phone'];
	
if ((!isset($_POST['hiddendoc'])) && $err==0){
		echo <<<SETTINGS
		<div id="profset" style="width:90%;">
				<form method="post" id="setform" action="doctor.php?did=$id" enctype="multipart/form-data">

					<br><br><h1>User Information</h1>
					<p></p>

					<input type="hidden" name="hiddendoc">				

					<label>First Name</label>
					<input type="text" name="first" value="$first"/>

					<label>Last Name</label>
					<input type="text" name="last" value="$last"/>
					
					<label>Email</label>
					<input type="text" name="email" value="$email"/>
							
					<label>Password</label>
					<input type="password" name="password"/>
					
					<label>Confirm Password</label>
					<input type="password" name="password2" />
					<label>Field of Medicine</label>
					<input type="text" name="field" value="$field"/>
					<label>Place of work</label>
					<input type="text" name="place" value="$place"/>
					<label>Contact Phone</label>
					<input type="text" name="phone" value="$phone"/>
					<div class="spacer"></div>					
					<p></p>
					
					<label>Profile Photo</label>
					<input type="file" name="picd" id="picd2" size="5" />		
					
					
					
					<button type="submit" style="margin-top:80px;margin-left:-320px;" >Save</button>
					<div class="spacer"></div>
				</form>
				</div>
SETTINGS;
	}
	else echo "<meta http-equiv=\"refresh\" content=\"0; URL=../../doctor.php?did=$id\">";
	if ($err==1){
		echo "<p>User not found</p>";
		echo "<meta http-equiv=\"refresh\" content=\"1; URL=../../doctor.php?did=$id\">";
	}
	if ($err==2){
		echo "<p>No access</p>";
		echo "<meta http-equiv=\"refresh\" content=\"1; URL=../../doctor.php?did=$id\">";
	}echo "</div>";
?>
