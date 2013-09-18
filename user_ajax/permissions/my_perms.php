<?php
require('../../site_functions.php');
require '../../js/jfuctions_user.php';
$user=findUser(intval($_SESSION['uid']));

$sql="SELECT * FROM permission WHERE uid='$user[id]'";
$sql2="SELECT * FROM doc_perm WHERE uid='$user[id]'";
open();
$result=mysql_query($sql);
$result2=mysql_query($sql2);
close();
echo "<u><b><h2 style=\"font-family:verdana;color:#00205e;\">Bestowed Permisssions</h2></b></u></label>";

if($result && mysql_numrows($result)>0){
	echo "<table style=\"color:#00205e;\">
	<tr align=\"left\"><td><b style=\"size:2em;\"><u>Permissions to users(full)</u></b></td></tr>";
	open();
	while($perms=mysql_fetch_array($result)){
		$man=findUser($perms['pid']);
		echo "<tr align=\"left\"><td>".$man['last']." ".$man['name']."</td></tr>";	
	}
	close();
	echo "</table>";
}
else{
	echo "<table style=\"color:#00205e;\">
		<tr align=\"left\"><td><b style=\"size:2em;\"><u>Permissions to other users(full)</u></b></td></tr>
		<tr align=\"left\"><td>You have not given any permissions to any users</td></tr>
		<tr align=\"left\"><td>You can add them in <b>Permissions->Personal Relations</b></td></tr>
	</table>";
}
echo "<br/>";

if($result2 && mysql_numrows($result2)>0){
	echo "<table style=\"color:#00205e;\">
	<tr align=\"left\"><td><b style=\"size:2em;\"><u>Permissions to Physicians</u></b></td></tr>";
	open();$i=0;
	while($docs=mysql_fetch_array($result2)){
		$a=findDoc($docs['did']);
		$doctor[$i]=$a['id'];
		$i++;
	}
	$doc2=array_unique($doctor);
	foreach($doc2 as $boc){
		$doc=findDoc($boc);
		echo <<<A
		<tr align="left"><td><img src="profile/$doc[prof]" style="height:40px;width:40px;"/><label style="font-family:Verdana;color:#00205e;"><b>$doc[first] $doc[last]</b></label></td></tr>
		<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">Field of Medicine:</label> $doc[field]</td></tr>
		<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">Contact:</label> $doc[email] $doc[phone]</td></tr>
		<tr align="left"><td><button onclick="$('#cont1').load('user_ajax/permissions/doc_perm.php?did9=$doc[id]')">Show</button></td></tr>
A;
	}
	close();
	echo "</table>";
}else{
echo "<table style=\"color:#00205e;\">
		<tr align=\"left\"><td><b style=\"size:2em;\"><u>Permissions to to Physicians</u></b></td></tr>
		<tr align=\"left\"><td>You have not given any permissions to any Physicians</td></tr>
		<tr align=\"left\"><td>You can add them from <b>Health Specialists->Search</b> and then from Add button in this page</td></tr>
	</table>";
}
?>
<button onclick="$('#cont1').load('user_ajax/permissions/give_perm.php');">Add Permissions</button>
