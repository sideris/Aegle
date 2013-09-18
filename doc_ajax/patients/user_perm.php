<script type="text/javascript">
$('#highlight tr').mouseover(function(){
$(this).css('background-color','gray');
});
$('#highlight tr').mouseout(function(){
$(this).css('background-color','');
});
</script>
<?php
require '../../js/hide1.js';
require '../../site_functions.php';
if($_GET['uid9']&&isset($_SESSION['did'])){
	$did=$_SESSION['did'];
	$uid=intval($_GET['uid9']);
	$q="SELECT * FROM doc_perm WHERE uid='$uid' AND did='$did' ORDER BY type DESC";
	open();
	$result=mysql_query($q);
	$user=findUser($uid);

echo <<<a
	<a style="float:left;color:blue;cursor:pointer;" onclick="$('#cont1').load('doc_ajax/patients/patients.php')"><--Back</a>
	<br/>
	<table align="center">
	<tr align="left"><td><img src="profile/$user[prof]" style="height:70px;width:60px;"/><label style="font-family:Verdana;color:#00205e;"><b>$user[name] $user[last]</b></label></td></tr>
	<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">email:</label> $user[email]</td></tr>
	<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">Aeglea ID: </label>$user[id]</td></tr>
	</table>
a;
if(mysql_num_rows($result)>0){
$me=$al=$co=$pr=$te=$va=array();
	while($q=mysql_fetch_array($result)){
		//echo $q['fileid']." ".$q['type']."<br/>";
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
<div id="highlight">
<label id="hid_test2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
<h3 style="font-family:verdana;color:#00205e;">Medical Tests</h3></label>
<div id="hid_test" style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
a;

foreach($te as $test){
echo "<table style=\"width:100%\">";
if($test['uptake']&&$test['month']&&$test['day']){
echo "<tr align=\"left\"><td>".$test['name']." ".$test['uptake']." ".$test['day']."/".$test['month']."/".$test['year']."</td><td align=\"right\"><button onclick=\"$('#cont1').load('doc_ajax/patients/file.php?fid2='+$test[id]+'&type2=test');\">View</button></td></tr>";}

if($test['uptake']&&!$test['month']&&!$test['day']){
echo "<tr align=\"left\"><td>".$test['name']." ".$test['uptake']."</td><td align=\"right\"><button onclick=\"$('#cont1').load('doc_ajax/patients/file.php?fid2='+$test[id]+'&type2=test');\">View</button></td></tr>";}

if(!$test['uptake']&&$test['month']&&$test['day']){
echo "<tr align=\"left\"><td>".$test['name']." "." ".$test['day']."/".$test['month']."/".$test['year']."</td><td align=\"right\"><button onclick=\"$('#cont1').load('doc_ajax/patients/file.php?fid2='+$test[id]+'&type2=test');\">View</button></td></tr>";}
echo "</table>";
}
echo "</div>";


		echo <<<a
		<label id="hid_proc2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
		<h3 style="font-family:verdana;color:#00205e;">Medical Procedures</h3></label>
		<div id="hid_proc"style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
a;
		foreach($pr as $proc){
		echo "<table style=\"width:100%\">";
		if($proc['year']!=0){
		echo "<tr align=\"left\"><td>".$proc['name']." ".$proc['year']."</td><td align=\"right\"><button onclick=\"$('#cont1').load('doc_ajax/patients/file.php?fid2='+$proc[id]+'&type2=procedure');\">View</button></td></tr>";}
		else{
		echo "<tr align=\"left\"><td>".$proc['name']."</td><td align=\"right\"><button onclick=\"$('#cont1').load('doc_ajax/patients/file.php?fid2='+$proc[id]+'&type2=procedure');\">View</button></td></tr>";}
		echo "</table>";
		}
		echo "</div>";


		echo <<<a
		<label id="hid_med2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
		<h3 style="font-family:verdana;color:#00205e;">Medications</h3></label>
		<div id="hid_med"style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
a;
		foreach($me as $med){
		echo "<table style=\"width:100%\">";
		echo "<tr align=\"left\"><td>".$med['name']."</td><td align=\"right\"><button onclick=\"$('#cont1').load('doc_ajax/patients/file.php?fid2='+$med[id]+'&type2=medication');\">View</button></td></tr><tr align=\"left\"><td><label size=\"0.5em\" style=\"color:#555\">";if($med['uptake']){echo "uptake:".$med['uptake'];}
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
echo "<table style=\"width:100%\">";
echo "<tr align=\"left\"><td>".$vac['name']."</td><td align=\"right\"><button onclick=\"$('#cont1').load('doc_ajax/patients/file.php?fid2='+$vac[id]+'&type2=vaccine');\">View</button></td></tr>
</table>";
}
echo "</div>";

echo <<<a
<label id="hid_cond2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
<h3 style="font-family:verdana;color:#00205e;">Medical Conditions</h3></label>
<div id="hid_cond"style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
a;
foreach($co as $cond){
echo "<table style=\"width:100%;\">";
echo "<tr align=\"left\"><td>".$cond['name']."</td><td align=\"right\"><button onclick=\"$('#cont1').load('doc_ajax/patients/file.php?fid2='+$cond[id]+'&type2=condition');\">View</button></td></tr>";
echo "</table>";
}
echo "</div>";

echo <<<a
<label id="hid_all2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
<h3 style="font-family:verdana;color:#00205e;">Allergies</h3></label>
<div id="hid_all"style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
a;
foreach($al as $all){
echo "<table style=\"width:100%\">";
echo "<tr align=\"left\"><td>".$all['name']."</td><td align=\"right\"><button onclick=\"$('#cont1').load('doc_ajax/patients/file.php?fid2='+$all[id]+'&type2=allergy');\">View</button></td></tr>
</table>";
}
echo "</div></div>";

	close();
}else{echo "<br/><br/><b>No permissions given :(</b>";}
}
else{
echo "Illegal Access";}
?>
