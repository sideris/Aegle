<?php
require('../../site_functions.php');
$id=$_SESSION['uid'];
?>
<script type="text/javascript" src="js/jquery-1.8.0.js" charset="utf-8"></script>
<?php
if(!isset($_POST['hidden2'])){
echo <<<SETTINGS3
<div id="settings23"  style="float:middle;">
<br\><br\>
		<form method="post" action="user.php?uid=$id" enctype="multipart/form-data"  >
			<h1 style="font-family:verdana;color:#00205e;">User's Relations' Information</h1><br/><br/>
			<label><b style="color:red;">Warning!</b><br/>When you add a relation this person has rights to view,edit,delete <b>all</b> of your information.<br/>
			You should have intimate knowledge of the person you are about to add.<br/> Make sure that the person's ID and Username is the corresponding of your beloved<br/>
			<label class="formsmall">Aeglea is not responsible in any case if you add the wrong person</label></label><br/><br/><br/>
				
			<div id="settings2" class="form">
			<input type="hidden" name="hidden2">				
			<table align="center">
			<tr>
				<td><label>User's Username</label></td>
				<td align="left"><input type="text" name="othername" id="othername" /></td>
			</tr>
			<tr>
				<td><label>User's Id</label></td><td align="left"><input type="text" name="otherid"  /></td>
			</tr>					
			<tr>
				<td><label>Relation type</label></td>
				<td align="left">
					<select name="relation">
						<option value="spouce">Spouce</option>
						<option value="child">Child</option>
						<option value="family">family</option>
						<option value="other">Other</option>
					</select>
				</td>
			</tr>
			<tr>
			<td><label style="font-size:0.8em;" class="formsmall">I agree that I have every responsibility for the validity of this relation(needs confirmation)</label></td>
			<td align="left"><input id="confirm" name="confirm" type="checkbox" value="1"/></td>
			</tr>
			</table>
			<br/><button  type="submit">Save</button>
			</div>
	</form>
SETTINGS3;
}
echo "</div>";
?>
