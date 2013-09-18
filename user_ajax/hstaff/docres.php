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

if($_GET['fi']&&$_GET['la']){
	$first=$_GET['fi'];$last=$_GET['la'];
	$q="SELECT * from doc where first LIKE '%$first%' AND last LIKE '%$last%'";
	open();
	$docs=mysql_query($q);
	if($docs && mysql_numrows($docs)>0){
		while($doc=mysql_fetch_array($docs)){
		echo <<<a
		<div id="res_se" style="width:100%;">
		<table style="width:100%;">
		<tr align="left"><td><img src="profile/$doc[prof]" style="height:60px;width:60px;"/><label style="font-family:Verdana;color:#00205e;"><b>$doc[first] $doc[last]</b></label></td></tr>
		<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">Field of Medicine:</label> $doc[field]</td></tr>
		<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">Contact:</label> $doc[email] $doc[phone]</td></tr>
a;
		$q="SELECT * FROM user_docs WHERE uid='$_SESSION[uid]' AND did='$doc[id]'";
		$r=mysql_fetch_array(mysql_query($q));
		if($r){
			echo "<tr align=\"left\"><td><button value=\"$doc[id]\" style=\"background-color:gray;\" disabled=\"disabled\">Added!</button></td></tr></table></div>";
		}else{
			echo "<tr align=\"left\"><td><button value=\"$doc[id]\"onclick=\"$(this).load('user_ajax/hstaff/adddoc.php?did3=".$doc['id']."');$(this).css('background-color','gray');\">Add</button></td></tr>";}
			echo "</table></div>";
		}
		close();
	}
}elseif($_GET['fi']){
	$first=$_GET['fi'];
	$q="SELECT * from doc where first LIKE '%$first%'";
	open();
	$docs=mysql_query($q);
	if($docs && mysql_numrows($docs)>0){
	while($doc=mysql_fetch_array($docs)){
	$count++;$count2=$count2+1000;
	echo <<<a
	<div id="res_se" style="width:100%;">
	<table style="width:100%;">
	<tr align="left"><td><img src="profile/$doc[prof]" style="height:60px;width:60px;"/><label style="font-family:Verdana;color:#00205e;"><b>$doc[first] $doc[last]</b></label></td></tr>
	<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">Field of Medicine:</label> $doc[field]</td></tr>
	<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">Contact:</label> $doc[email] $doc[phone]</td></tr>
a;
	$q="select * from user_docs where uid='$_SESSION[uid]' AND did='$doc[id]'";
	$r=mysql_fetch_array(mysql_query($q));
	if($r){
		echo "<tr align=\"left\"><td><button value=\"$doc[id]\" style=\"background-color:gray;\" disabled=\"disabled\">Added!</button></td></tr></table></div>";
	}else{
		echo "<tr align=\"left\"><td><button value=\"$doc[id]\"onclick=\"$(this).load('user_ajax/hstaff/adddoc.php?did3=".$doc['id']."');$(this).css('background-color','gray');\">Add</button></td></tr>";}
		echo "</table></div>";
	}
	close();
	}else{
		echo "<b>No results :(</b><br/>Are you sure you typed the correct name?";
	}
}elseif($_GET['la']){
	$last=$_GET['la'];
	$q="SELECT * from doc where last LIKE '%$last%'";
	open();
	$docs=mysql_query($q);
	if($docs && mysql_numrows($docs)>0){
		while($doc=mysql_fetch_array($docs)){
			$count++;$count2=$count2+1000;
			echo <<<a
			<div id="res_se" style="width:100%;">
			<table style="width:100%;">
			<tr align="left"><td><img src="profile/$doc[prof]" style="height:60px;width:60px;"/><label style="font-family:Verdana;color:#00205e;"><b>$doc[first] $doc[last]</b></label></td></tr>
			<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">Field of Medicine:</label> $doc[field]</td></tr>
			<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">Contact:</label> $doc[email] $doc[phone]</td></tr>
a;

			$q="select * from user_docs where uid='$_SESSION[uid]' AND did='$doc[id]'";
			$r=mysql_fetch_array(mysql_query($q));
			if($r){
				echo "<tr align=\"left\"><td><button value=\"$doc[id]\" style=\"background-color:gray;\" disabled=\"disabled\">Added!</button></td></tr></table></div>";
			}else{
				echo "<tr align=\"left\"><td><button value=\"$doc[id]\"onclick=\"$(this).load('user_ajax/hstaff/adddoc.php?did3=".$doc['id']."');$(this).css('background-color','gray');\">Add</button></td></tr>";}
				echo "</table></div>";
		}
		close();
	}else{
		echo "<b>No results :(</b><br/>Are you sure you typed the correct name?";
	}
}
?>
