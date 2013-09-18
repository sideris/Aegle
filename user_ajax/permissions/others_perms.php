<?php
require('../../site_functions.php');
require '../../js/jfuctions_user.php';
$user=findUser(intval($_SESSION['uid']));

$sql="SELECT * from permission where pid='$user[id]'";
open();
$result=mysql_query($sql);
close();
echo "<u><b><h2 style=\"font-family:verdana;color:#00205e;\">Permisssions given to me</h2></b></u></label>";
if($result && mysql_numrows($result)>0){
		echo "<table align=\"center\">";
		open();
		while($perms=mysql_fetch_array($result)){
			$man=findUser($perms['pid']);
			echo "<tr><td>".$man['last']." ".$man['name']."</td></tr><br/>";
			if($perms['day']!=0&&$perms['month']!=0){
			echo "<tr><td><label style=\"font-size:0.9em;color:gray;\">Valid until:"." ".$perms['day']."/".$perms['day']."</label></td></tr>";}
			if($perms['forever']==1){echo "<tr><td><label style=\"font-size:0.9em;color:gray;\">Valid until: "."indefinite</label></td></tr>";}
		}
		close();
		echo "</table>";
}else{
		echo "<label style=\"color:#00205e;\">You have not been given any permissions</label>";
echo "</table>";
}
?>
