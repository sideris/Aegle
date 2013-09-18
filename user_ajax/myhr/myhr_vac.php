<?php
require('../../site_functions.php');
require '../../js/jfuctions_user.php';
$id=$_SESSION['uid'];
echo "<div id=\"vaccines\" style=\"height:1070px;color:#00205e;overflow:auto;\">";
$sql="SELECT * from us_vaccine where uid='$id'";
open();
$result=mysql_query($sql);
close();
echo "<u><b><h2 style=\"font-family:verdana;color:#00205e;\">My Vaccinations</h2></b></u></label><br/>";
if($result && mysql_numrows($result)>0){
	while($vac=mysql_fetch_array($result)){
		$year=$vac['year'];	
		if($year==0){
			echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$vac['name']."</b><br/><br/><br/><button onclick=\"$('#cont1').load('user_ajax/myhr/addvac.php?v=$vac[id]');\" style=\"width:30px;height:15px;background-color:gray;\" type=\"button\">Edit</button></p>";
		}else{
			echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$vac['name']."</b><br/><br/><font size=\"em\">Year:"." "."$year</font><br/><br/><button onclick=\"$('#cont1').load('user_ajax/myhr/addvac.php?v=$vac[id]');\" style=\"width:32px;height:18px;background-color:gray;\" type=\"button\">Edit</button></p>";}
		}
}else{
	echo "<br/><br/>You haven't added any vaccinations";
}
echo "<br/><br/><button onclick=\"$('#cont1').load('user_ajax/myhr/addvac.php');\" style=\"width:150px;height:25px;background-color:#61A0a0;\"  type=\"button\">Add</button>";
echo "</div>";
?>
