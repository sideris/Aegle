<?php require '../../site_functions.php';?>	
	
	<div id="index1" >
		<button onclick="$('#ind_cont').load('user_ajax/index/register.php #index1');">Users</button><button onclick="$('#ind_cont').load('user_ajax/index/register.php #index2');">doctors</button>
		<table>
		<td><img id="reg_img1" style="float:left;opacity:0.95;cursor:default;" src="images/user2.jpg"></img></td>
		<?php
if (isset($_SESSION['uid'])){
	$user=findUser($_SESSION['uid']);
	echo "<p>You are  already connected as $user[username].</p>";
}elseif(!isset($_POST['hidden'])&&empty($_POST['weight'])&&empty($_POST['height'])&&empty($_POST['month'])&&empty($_POST['gender'])&&empty($_POST['username']) && empty($_POST['fname'])&&empty($_POST['lname'])&&empty($_POST['usermail'])&&empty($_POST['password'])&&empty($_POST['password2'])){
echo <<< M
<td>
<form action="use.php" method="post">
			<br/><br/><br/><h2 style="font-family:verdana;color:#3B558C;">Users</h2><br/>
			<label style="background-color:gray;color:white;">Fields with (*) are required</label><br/>
			<table class="form" align="center" cellpadding="10" style="font-weight:900;font-family:Verdana;color:#3B558C;">
			<input type="hidden" name="hidden">
			<tr><td align="right"><label >*Username</label></td><td align="left"><input type="text" name="username"/></td></tr>
			<tr><td align="right"><label >*First Name</label></td><td align="left"><input type="text" name="fname"/><td></tr>
			<tr><td align="right"><label >*Last Name</label></td><td align="left"><input type="text" name="lname"/></td></tr>
			<tr><td align="right"><label>*Email</label></td><td align="left"><input type="text" name="usermail"/></td></tr>
			<tr><td align="right"><label >*Password</label></td><td align="left"><input type="password" name="password"/></td></tr>
			<tr><td  align="right"><label>*Confirm</label></td><td align="left"><input type="password" name="password2" /></td></tr>
			<tr><td align="right"><label style="margin-left:-90px;">Weight</label></td><td align="left">
M;
			selweight(0);
			echo "</td></tr>";
			echo"<tr><td align=\"right\"><label>Height</label></td><td align=\"left\">";
			selheight(0);
			echo "</td></tr>";
			echo	"<tr><td align=\"right\"><label>Birth Day</label></td><td>";
			seldate(0,0,0);
			echo "</td></tr>";

echo <<< B
			<tr><td align="right"><label>I am</label></td><td align="left"><select name="gender"><option>Gender</option><option>Male</option><option>Female</option></select></td></tr></table>
			<br/><br/><button  type="submit"style="width:70px;height:35px;margin-left:-23px;cursor:pointer">Sign Up!</button>
			<br/><label>By Signing Up I Agree to the <a href="tou.php">Terms of Use</a></label>
			</form></td></table>
					
B;
}
elseif($_SESSION['level']==1){
	echo "<meta http-equiv=\"refresh\" content=\"1; URL=user.php\">";
}
?>
		</div>
		<div id="index2">
		<button onclick="$('#ind_cont').load('user_ajax/index/register.php #index1');">Users</button><button onclick="$('#ind_cont').load('user_ajax/index/register.php #index2');">doctors</button>
		<table>
		<td><img id="reg_img2" style="float:left;opacity:0.9;cursor:default;" src="images/doctor4.jpg"></img></td>
<?php
if (isset($_SESSION['uid'])){
	$user=findDoc($_SESSION['uid']);
	echo "<p>You are  already connected as $user[username].</p>";
}elseif(!isset($_POST['hidden'])&&empty($_POST['username']) && empty($_POST['fname'])&&empty($_POST['lname'])&&empty($_POST['usermail'])&&empty($_POST['password'])&&empty($_POST['password2'])){
echo <<< F
<td>
<form action="doc.php" method="POST" class="form">
<h2 style="font-family:verdana;color:#3B558C;">Doctors</h2>
<input type="hidden" name="hidden">
			<label style="background-color:gray;color:white;">Fields with (*) are required</label>
			<table  align="center" cellpadding="10" style="font-weight:900;font-family:Verdana;color:#3B558C;"></td></tr>
			<tr><td align="right"><label>*Username</label></td><td><input type="text" name="username"/></td></tr>
			<tr><td align="right"><label>*First Name</label></td><td><input type="text" name="fname"/></td></tr>
			<tr><td align="right"><label>*Last Name</label></td><td><input type="text" name="lname"/></td></tr>
			<tr><td align="right"><label>*Email</label></td><td><input type="text" name="usermail"/></td></tr>
			<tr><td align="right"><label>*Password</label></td><td><input type="password" name="password"/></td></tr>
			<tr><td align="right"><label>*Confirm</label></td><td><input type="password" name="password2"/></td></tr></table>
			
			<br/><br><button  type="submit" style="width:70px;height:35px;">Sign Up!</button><br/>
			<label>By Signing Up I Agree to the <a href="tou.php">Terms of Use</a></label>
</form>
</td></table>
F;
}elseif($_SESSION['level']==2){
	echo "<meta http-equiv=\"refresh\" content=\"1; URL=doctor.php\">";
}
?>
</div>
