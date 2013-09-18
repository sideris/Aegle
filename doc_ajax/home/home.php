<?php
require ('../../site_functions.php');
$user=findDoc($_SESSION['did']);
$id=$user['id'];

echo <<< A
<table align="left">
	<tr><td align="left"><b><label style="color:#00205e;">Dr. $user[first] $user[last]</label></b></td></tr>
	<tr><td align="left"><label style="color:#00205e;">Medical Field:</label> $user[field]</td></tr>
	<tr><td align="left"><label style="color:#00205e;">Aeglea id:</label> $user[id]</td></tr>
	<tr><td align="left"><br/><label style="color:#00205e;"><b>Contact Details</b></label>:
		<tr><td align="left"><label style="color:#00205e;">e-mail:</label> $user[email]</td></tr>
		<tr><td align="left"><label style="color:#00205e;">Phone:</label> $user[phone]</td></tr>
		<tr><td align="left"><label style="color:#00205e;">P.O. Box:</label> $user[place]</td></tr>
	</td></tr>

</table>
A;
?>
