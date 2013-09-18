<?php
require('../../site_functions.php');
require '../../js/jfuctions_user.php';
$id=$_SESSION['uid'];
echo "<div id=\"conditions\" style=\"height:1070px;color:#00205e;overflow:auto;\">";
$sql="SELECT * from us_condition where uid='$id' ORDER BY current DESC";
open();
$result=mysql_query($sql);
close();
echo "<u><b><h2 style=\"font-family:verdana;color:#00205e;\">Medical Conditions</h2></b></u></label><br/>";
if($result && mysql_numrows($result)>0){
	while($cond=mysql_fetch_array($result)){
		$year=$cond['year'];
		$curr=$cond['current'];	
		if($curr==1){$str="<br/><label style=\"font-size:0.8em;color:#a10a00a00;\">Current Condition</label>";}else{$str="<br/><label style=\"font-size:0.8em;color:#a10a00a00;\">Past Condition</label>";}
		if($year==0){
		echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$cond['name']."</b><br/>".$str."<br/><br/><button onclick=\"$('#cont1').load('user_ajax/myhr/addcond.php?a=$cond[id]');\" style=\"width:30px;height:15px;background-color:gray;\" type=\"button\">Edit</button></p>";
		}else{
			echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$cond['name']."</b><br/>".$str."<br/><font size=\"em\">Year:"." "."$year</font><br/><br/><button onclick=\"$('#cont1').load('user_ajax/myhr/addcond.php?a=$cond[id]');\" style=\"width:32px;height:18px;background-color:gray;\" type=\"button\">Edit</button></p>";
		}
	}
}else{
	echo "<br/><br/>You do not have any health related condition!";
}
echo "<br/><br/><button onclick=\"$('#cont1').load('user_ajax/myhr/addcond.php');\" style=\"width:150px;height:25px;background-color:#61A0a0;\"  type=\"button\">Add</button>";
echo "</div>";

?>
