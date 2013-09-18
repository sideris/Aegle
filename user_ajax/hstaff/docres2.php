<script type="text/javascript">
$('#res_se').mouseover(function(){
	$('#res_se').css("background-color","#C0C0D4");
});
$('#res_se').mouseout(function(){
	$('#res_se').css("background-color","");
});
$('#doc_add').click(function(){
var did= $('#doc_add').val();
$('#doc_add').load('user_ajax/hstaff/adddoc.php?did3='+did);
$('#doc_add').attr('disabled','disabled');
$('#doc_add').css('background-color','gray');
});
</script>

<?php
require('../../site_functions.php');
require '../../js/jfuctions_user.php';
$id=$_SESSION['uid'];

if($_GET['did2']){
	$did=intval($_GET['did2']);
	$q="SELECT * from doc where id='$did'";	
	open();
	$doc=mysql_fetch_array(mysql_query($q));	
	close();

	if($doc){
	echo <<<a
		<br/>
		<div  id="res_se"  style="width:100%;">
		<table>
		<tr align="left"><td><img src="profile/$doc[prof]" style="height:60px;width:60px;"/><label style="font-family:Verdana;color:#00205e;"><b>$doc[first] $doc[last]</b></label></td></tr>
		<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">Field of Medicine:</label> $doc[field]</td></tr>
		<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">Contact:</label> $doc[email] $doc[phone]</td></tr>
a;
		open();
		$q="select * from user_docs where uid='$_SESSION[uid]' AND did='$doc[id]'";
		$r=mysql_fetch_array(mysql_query($q));
		close();
		if($r){
			echo "<tr align=\"left\"><td><button id=\"doc_add\" value=\"$doc[id]\" style=\"width:60px;background-color:gray;\" disabled=\"disabled\">Added!</button></td></tr>";
		}
		else{
			echo "<tr align=\"left\"><td><button id=\"doc_add\" value=\"$doc[id]\" style=\"width:60px;\">Add</button></td></tr>";
		}
echo <<<a
		</table>
		</div>
a;
	}else{
		echo "<br/><label style=\"font-family:verdana;color:#00205e;\"><b>No results :(</b></label><br/><label>Did you use the correct id?</label>";
	}
}
else{
echo "<label>You have to input an id</label>";
}
?>
