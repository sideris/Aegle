<?php
require('../../site_functions.php');
require '../../js/jfuctions_user.php';
$id=$_SESSION['uid'];
echo "<div id=\"tests2\" style=\"height:1070px;color:#00205e;overflow:auto;\">";
$sql="SELECT * from us_test where uid='$id'";
open();
$result=mysql_query($sql);
close();
echo "<u><b><h2 style=\"font-family:verdana;color:#00205e;\">My Medical Tests</h2></b></u></label><br/>";
if($result && mysql_numrows($result)>0){
	while($tes=mysql_fetch_array($result)){
		
		$q="SELECT * FROM file_test WHERE uid='$id' AND tid='$tes[id]'";
		open();
		$files=mysql_query($q);	
		close();
		echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$tes['name']."</b><br/><label class=\"formsmall\">$tes[day]/$tes[month]/$tes[year]</label>";
		if($tes['value']!=0){
			echo "<br/><br/>$tes[value]";
			if($tes['unit']){
				echo "<label style=\"font-size:0.8em;\"> ($tes[unit])</label>";
			}
		}
		if($tes['comments']){
			echo "<br/><br/><u>Comments</u><br/>$tes[comments]<br/><br/>";
		}
		
		open();
			while($file=mysql_fetch_array($files)){
				echo "<a href=\"users/tests/$file[fname]\" rel=\"lightbox\"><img src=\"users/tests/$file[fname]\" style=\"height:80px;width:80px;\" /></a>";
			}
		close();
		
		echo "<br/><br/><button onclick=\"$('#cont1').load('user_ajax/myhr/addtes.php?tes=$tes[id]');\" style=\"width:32px;height:18px;background-color:gray;\" type=\"button\">Edit</button></p>";
	}
}else{
	echo "<tr><br/><br/>You have not added any medical tests</tr>";
}
echo "<br/><br/><button onclick=\"$('#cont1').load('user_ajax/myhr/addtes.php');\" style=\"width:150px;height:25px;background-color:#61A0a0;\"  type=\"button\">Add</button>";
echo "</div>";
?>
