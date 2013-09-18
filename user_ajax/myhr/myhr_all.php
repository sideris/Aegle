<?php
require('../../site_functions.php');
require '../../js/jfuctions_user.php';
$id=$_SESSION['uid'];
echo "<div id=\"allergies\" style=\"height:1070px;color:#00205e;overflow:auto;\">";
$sql="SELECT * from us_allergy where uid='$id'";
open();
$result=mysql_query($sql);
close();
echo "<u><b><h2 style=\"font-family:verdana;color:#00205e;\">My Allergies</h2></b></u></label><br/>";
if($result && mysql_numrows($result)>0){
	while($all=mysql_fetch_array($result)){
		echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$all['name']."</b><br/><br/><button onclick=\"$('#cont1').load('user_ajax/myhr/addall.php?al=$all[id]');\" style=\"width:32px;height:18px;background-color:gray;\" type=\"button\">Edit</button></p>";
		}
}else{
	echo "<tr><br/><br/>You have not added any allergies</tr>";
}
echo "<br/><br/><button onclick=\"$('#cont1').load('user_ajax/myhr/addall.php');\" style=\"width:150px;height:25px;background-color:#61A0a0;\"  type=\"button\">Add</button>";
echo "</div>";

?>
