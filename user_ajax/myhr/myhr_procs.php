<?php
require('../../site_functions.php');
require '../../js/jfuctions_user.php';
$id=$_SESSION['uid'];
echo "<div id=\"procedures\" style=\"height:1070px;color:#00205e;overflow:auto;\">";
$sql="SELECT * from us_procedure where uid='$id' ORDER BY year DESC";
open();
$result=mysql_query($sql);
close();
echo "<u><b><h2 style=\"font-family:verdana;color:#00205e;\">Procedures</h2></b></u></label><br/>";
if($result && mysql_numrows($result)>0){
	while($proced=mysql_fetch_array($result)){
		$year=$proced['year'];	
		$q="SELECT * FROM file_proc WHERE uid='$id' AND prid='$proced[id]'";
		open();
		$files=mysql_query($q);	
		close();
		if($year==0){
			echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$proced['name']."</b><br/><br/>".$proced['comments']."<br/><br/>";
			open();
			while($file=mysql_fetch_array($files)){
				echo "<a href=\"users/procedures/$file[fname]\" rel=\"lightbox\"><img src=\"users/procedures/$file[fname]\" style=\"height:80px;width:80px;\" /></a>";
			}
			close();
			echo "<br/><br/><button onclick=\"$('#cont1').load('user_ajax/myhr/addproc.php?a=$proced[id]')\" style=\"width:30px;height:18px;background-color:gray;\" type=\"button\">Edit</button></p>";
		}else{
			echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$proced['name']."</b><br/><br/><font size=\"em\">Year:"." "."$year</font><br/><br/>".$proced['comments']."<br/><br/>";
			open();
			while($file=mysql_fetch_array($files)){
				echo "<a href=\"users/procedures/$file[fname]\" rel=\"lightbox\"><img src=\"users/procedures/$file[fname]\" style=\"height:80px;width:80px;\" /></a>";
			}
			close();
			echo "<br/><br/><button onclick=\"$('#cont1').load('user_ajax/myhr/addproc.php?a=$proced[id]');\" style=\"width:32px;height:18px;background-color:gray;\" type=\"button\">Edit</button></p>";
		}
	}
}else{
	echo "<br/><br/>You have not added any procedures";
}
echo "<br/><br/><button onclick=\"$('#cont1').load('user_ajax/myhr/addproc.php');\" style=\"width:150px;height:25px;background-color:#61A0a0;\"  type=\"button\">Add More</button>";
echo "</div>";

?>
