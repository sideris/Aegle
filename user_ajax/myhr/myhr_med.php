<?php
require('../../site_functions.php');
require '../../js/jfuctions_user.php';
$id=$_SESSION['uid'];
echo "<div id=\"medures\" style=\"height:1070px;color:#00205e;overflow:auto;\">";
$sql="SELECT * from us_medication where uid='$id'";
open();
$result=mysql_query($sql);
close();
echo "<u><b><h2 style=\"font-family:verdana;color:#00205e;\">My Medication</h2></b></u></label><br/>";
if($result && mysql_numrows($result)>0){
	while($med=mysql_fetch_array($result)){
		echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$med['name']."</b>";
		if($med['current']==1){$str="<br/><label style=\"font-size:0.8em;color:#a10a00a00;\">Currently Taking</label>";echo $str;}
		if($med['uptake']){echo "<br/><br/>Dosage Intervals: ".$med['uptake'];}
		if($med['started']){echo "<br/><br/><label style=\"font-size:0.9em;color:gray;\">Started taking medicine: ".$med['started']."</label>";}
		echo "<br/><br/><button onclick=\"$('#cont1').load('user_ajax/myhr/addmed.php?me=".$med['id']."');\" style=\"width:32px;height:18px;background-color:gray;\" type=\"button\">Edit</button></p>";
	}
}else{
	echo "<br/><br/>You are not under any medication";
}
echo "<br/><br/><button onclick=\"$('#cont1').load('user_ajax/myhr/addmed.php');\" style=\"width:150px;height:25px;background-color:#61A0a0;\"  type=\"button\">Add More</button>";
echo "</div>";

?>
