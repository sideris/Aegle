<?php
require('../../site_functions.php');
require '../../js/jfuctions_user.php';

$user=findUser($_SESSION['uid']);
$id=$_SESSION['uid'];
$oldfile=$user['prof'];
echo "<div id=\"settings1\" class=\"form\" style=\"float:middle;\">";
$first=$user['name'];
$last=$user['last'];
$email=$user['email'];
$gender=$user['gender'];
$day=$user['day'];
$month=$user['month'];
$year=$user['year'];
$btype=$user['btype'];
$ins=$user['insurance'];
	
if ((!isset($_POST['hidden'])) && $err==0){
	echo <<<SETTINGS
	<div id="profset" style="width:90%;">
			<form method="post" id="setform" action="user.php?uid=$id" enctype='multipart/form-data'>
				<br><br><h1>User Information</h1>
				<p></p>
				<input type="hidden" name="hidden">				
				<label>First Name</label>
				<input type="text" name="name" value="$first"/>
				<label>Last Name</label>
				<input type="text" name="last" value="$last"/>
				<label>Email</label>
				<input type="text" name="email" value="$email"/>
				<label>Password</label>
				<input type="password" name="password"/>
				<label>Confirm Password</label>
				<input type="password" name="password2" />
				<label>Insurance</label>
				<input type="text" name="insure" value="$ins"/>
				<div class="spacer"></div>
				<p></p>
				<label>User Photo</label>
				<input type="file" name="pic" id="pic2" size="5" />		
				<label>Blood Type</label>
				<select name="btype">
SETTINGS;
				echo "<option value=\"\"";
				if ($btype==NULL) echo "selected=\"selected\"";
				echo ">select:</option>";
					
				echo "<option value=\"0+\"";
				if ($btype=="0+") echo "selected=\"selected\"";
				echo ">0+</option>";
				echo "<option value=\"0-\"";
				if ($btype=="0-") echo "selected=\"selected\"";
				echo ">0-</option>";
				echo "<option value=\"A+\"";
				if ($btype=="A+") echo "selected=\"selected\"";
				echo ">A+</option>";
				echo "<option value=\"A-\"";
				if ($btype=="A-") echo "selected=\"selected\"";
				echo ">A-</option>";
				echo "<option value=\"B+\"";
				if ($btype=="B+") echo "selected=\"selected\"";
				echo ">B+</option>";
				echo "<option value=\"B-\"";
				if ($btype=="B-") echo "selected=\"selected\"";
				echo ">B-</option>";
				echo "<option value=\"AB+\"";
				if ($btype=="AB+") echo "selected=\"selected\"";
				echo ">AB+</option>";
				echo "<option value=\"AB-\"";
				if ($btype=="AB-") echo "selected=\"selected\"";
				echo ">AB-</option>";
				echo "<option value=\"other\"";
				if ($btype=="other") echo "selected=\"selected\"";
				echo ">other</option>";		
				echo "</select>";
				echo "<label>gender</label><select name=\"gender\">";
				echo "<option value=\"\"";
				if ($gender==NULL) echo "selected=\"selected\"";
				echo ">select:</option>";
				echo "<option value=\"Male\"";
				if ($gender=="Male") echo "selected=\"selected\"";
				echo ">Male</option>";
				echo "<option value=\"Female\"";
				if ($gender=="Female") echo "selected=\"selected\"";
				echo ">Female</option>";
				echo "</select>";
				echo "<label>Birth Day</label>";
				seldate($day,$month,$year);
		echo <<< SETTINGS2
				<button type="submit" style="margin-top:190px;margin-left:-320px;" >Save</button>
				<div class="spacer"></div>
			</form>
			</div>
SETTINGS2;
	}else echo "<meta http-equiv=\"refresh\" content=\"0; URL=../../user.php?uid=$id\">";
	if ($err==1){
		echo "<p>User not found</p>";
		echo "<meta http-equiv=\"refresh\" content=\"1; URL=../../user.php?uid=$id\">";
	}
	if ($err==2){
		echo "<p>No access</p>";
		echo "<meta http-equiv=\"refresh\" content=\"1; URL=../../user.php?uid=$id\">";
	}
	echo "</div>";
?>
