<script type="text/javascript">
$('#res_se table').mouseover(function(){
	$(this).css("background-color","#C0C0D4");
});
$('#res_se table').mouseout(function(){
	$(this).css("background-color","");
});
</script>

<?php
require('../../site_functions.php');
require '../../js/jfuctions_user.php';
$id=$_SESSION['uid'];
$q1="SELECT * FROM user_docs WHERE uid='$id'";
open();
$docs=mysql_query($q1);
while($doc1=mysql_fetch_array($docs)){
	$q2="SELECT * from doc where id='$doc1[did]'";
	$doc=mysql_fetch_array(mysql_query($q2));
	echo <<<a
	<div id="res_se" style="width:100%;">
	<table style="width:100%;">
		<tr align="left">
			<td><img src="profile/$doc[prof]" style="height:60px;width:60px;"/><label style="font-family:Verdana;color:#00205e;"><b>$doc[first] $doc[last]</b></label></td>
		</tr>
		<tr align="left">
			<td><label style="font-family:Verdana;color:#00205e;">Field of Medicine:</label> $doc[field]</td>
		</tr>
		<tr align="left">
			<td><label style="font-family:Verdana;color:#00205e;">Contact:</label> $doc[email] $doc[phone]</td>
		</tr>
a;
echo"
	<tr align=\"left\">
		<td><button value=\"$doc[id]\" onclick=\"$(this).load('user_ajax/hstaff/deldoc.php?did3=".$doc['id']."');$('#cont1').load('user_ajax/hstaff/my_hstaff.php');\">Delete</button></td>
	</tr>
</table>
</div>";
}
close();
?>
