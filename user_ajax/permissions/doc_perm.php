<?php
require '../../js/hide1.js';
require '../../site_functions.php';
require ('../../js/jq_funs.php');
if($_GET['did9']&&isset($_SESSION['uid'])){
	$did=intval($_GET['did9']);
	$uid=intval($_SESSION['uid']);
	$sql1="SELECT * FROM doc_perm WHERE uid='$uid' AND did='$did' ORDER BY type DESC";
	open();
	$result=mysql_query($sql1);
	$doc=findDoc($did);
echo <<<a
<a onclick="$('#cont1').load('user_ajax/permissions/my_perms.php');" style="cursor:pointer;float:left;color:blue"><--Back</a>
	<table align="center">
	<tr align="left"><td><img src="profile/$doc[prof]" style="height:80px;width:80px;"/><label style="font-family:Verdana;color:#00205e;"><b>$doc[first] $doc[last]</b></label></td></tr>
	<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">Field of Medicine:</label> $doc[field]</td></tr>
	<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">Contact:</label> $doc[email] $doc[phone]</td></tr>
	<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">Aeglea ID: </label>$doc[id]</td></tr>
	</table>
a;
$me=$al=$co=$pr=$te=$va=array();
	while($q=mysql_fetch_array($result)){
		$a=history2($q['fileid'],$q['type']);
		if($q['type']=="medication"){
			$b=mysql_fetch_array($a);
			array_push($me,$b);
		}
		if($q['type']=="allergy"){
			$b=mysql_fetch_array($a);
			array_push($al,$b);
		}
		if($q['type']=="condition"){
			$b=mysql_fetch_array($a);
			array_push($co,$b);
		}
		if($q['type']=="procedure"){
			$b=mysql_fetch_array($a);
			array_push($pr,$b);
		}
		if($q['type']=="test"){
			$b=mysql_fetch_array($a);
			array_push($te,$b);
		}
		if($q['type']=="vaccine"){
			$b=mysql_fetch_array($a);
			array_push($va,$b);
		}
	}

echo <<<a
<label id="hid_test2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
<h3 style="font-family:verdana;color:#00205e;">Medical Tests</h3></label>
<div id="hid_test" style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
a;
foreach($te as $test){
echo "<table>";
if($test['uptake']&&$test['month']&&$test['day']){
echo "<tr align=\"left\"><td>".$test['name']." ".$test['uptake']." ".$test['day']."/".$test['month']."/".$test['year']."</td><td></td></tr>";}

if($test['uptake']&&!$test['month']&&!$test['day']){
echo "<tr align=\"left\"><td>".$test['name']." ".$test['uptake']."</td><td><</td></tr>";}

if(!$test['uptake']&&$test['month']&&$test['day']){
echo "<tr align=\"left\"><td>".$test['name']." "." ".$test['day']."/".$test['month']."/".$test['year']."</td><td></td></tr>";}
echo "</table>";
}
echo "</div>";
		echo <<<a
		<label id="hid_proc2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
		<h3 style="font-family:verdana;color:#00205e;">Medical Procedures</h3></label>
		<div id="hid_proc"style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
a;
		foreach($pr as $proc){
		echo "<table>";
		if($proc['year']!=0){
		echo "<tr align=\"left\"><td>".$proc['name']." ".$proc['year']."</td><td></td></tr>";}
		else{
		echo "<tr align=\"left\"><td>".$proc['name']."</td><td></td></tr>";}
		echo "</table>";
		}
		echo <<<a
		</div>
		<label id="hid_med2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
		<h3 style="font-family:verdana;color:#00205e;">Medications</h3></label>
		<div id="hid_med" style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
a;
		foreach($me as $med){
		echo "<table>";
		echo "<tr align=\"left\"><td>".$med['name']."</td><td></td></tr><tr align=\"left\"><td><label size=\"0.5em\" style=\"color:#555\">";if($med['uptake']){echo "uptake:".$med['uptake'];}
		echo "</label></td></tr>
		</table>";
		}
		echo "</div>";
	echo <<<a
	<label id="hid_vac2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
	<h3 style="font-family:verdana;color:#00205e;">Vaccinations</h3></label>
	<div id="hid_vac"style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
a;
	foreach($va as $vac){
		echo "<table>";
		echo "<tr align=\"left\"><td>".$vac['name']."</td><td></td></tr>
		</table>";
	}
	echo "</div>";
	echo <<<a
	<label id="hid_cond2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
	<h3 style="font-family:verdana;color:#00205e;">Medical Conditions</h3></label>
	<div id="hid_cond"style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
a;
	foreach($co as $cond){
		echo "<table>";
		echo "<tr align=\"left\"><td>".$cond['name']."</td><td></td></tr>";
		echo "</table>";
	}
	echo "</div>";
	echo <<<a
	<label id="hid_all2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
	<h3 style="font-family:verdana;color:#00205e;">Allergies</h3></label>
	<div id="hid_all"style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
a;
	foreach($al as $all){
		echo "<table>";
		echo "<tr align=\"left\"><td>".$all['name']."</td><td></td></tr>
		</table>";
	}
	echo "</div>";
	close();
}else{
	echo "Illegal access";
}
?>
