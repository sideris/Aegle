<?php
require '../../site_functions.php';
$did=$_SESSION['did'];

$q="SELECT * FROM user_docs WHERE did='$did'";
$q2="SELECT * FROM nfc_perm WHERE did='$did'";
open();
$result=mysql_query($q);
$result2=mysql_query($q2);
echo<<<a
<label><b style="size:2em;font-family:verdana;color:#00205e;"><u>Users that have added you</u></b></label><br/><br/>
<label class="form">Search:(not working)<input type="text"/></label>
<br/>
<table align="left">
a;
while($added=mysql_fetch_array($result)){
	$user=findUser($added['uid']);
	echo <<<a
	<tr align="left"><td><img src="profile/$user[prof]" style="height:70px;width:60px;"/><label style="font-family:Verdana;color:#00205e;"><b>$user[name] $user[last]</b></label></td></tr>
	<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">email:</label> $user[email]</td></tr>
	<tr><td><button onclick="$('#cont1').load('doc_ajax/patients/user_perm.php?uid9=$user[id]')">View Permissions</button></td></tr>
a;
}
while($added2=mysql_fetch_array($result2)){
	$user2=findUser($added2['uid']);
	echo <<<a
	<tr align="left"><td><img src="profile/$user2[prof]" style="height:70px;width:60px;"/><label style="font-family:Verdana;color:#00205e;"><b>$user2[name] $user2[last](temp)</b></label></td></tr>
	<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">email:</label> $user2[email]</td></tr>
	<tr><td><button onclick="$('#cont1').load('doc_ajax/patients/user_perm.php?uid9=$user2[id]')">View Permissions</button></td></tr>
a;
}
echo <<<a
</table>
a;
close();
?>
