<?php
require '../../js/hide1.js';
require('../../site_functions.php');
require ('../../js/jq_funs.php');
require '../../js/jfuctions_user.php';
$user=findUser(intval($_SESSION['uid']));
$id=$user['id'];
?>
<?php
echo <<<a
<form action="user.php?uid=$id" method="post" enctype="multipart/form-data">

<label id="hid_doc2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
<h3 style="font-family:verdana;color:#00205e;">Select Physician</h3></label>
<div id="hid_doc" style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
a;
$b="SELECT * FROM user_docs where uid='$id'";
open();
$a=mysql_query($b);
while($docs=mysql_fetch_array($a)){
	$q2="SELECT * from doc where id='$docs[did]'";
	$doc=mysql_fetch_array(mysql_query($q2));
	echo "<table id=\"$doc[id]\" style=\"width:100%;\">";
	echo <<<a
	<tr align="left"><td><img src="profile/$doc[prof]" style="height:40px;width:40px;"/><label style="font-family:Verdana;color:#00205e;"><b>$doc[first] $doc[last]</b></label></td></tr>
	<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">Field of Medicine:</label> $doc[field]</td>
	<td align="right"><button type="button" onclick="$('table').css('background-color','');$('#$doc[id]').css('background-color','gray');$('#s_doc').val($doc[id])">Select</button></td></tr>
	<tr align="left"><td><label style="font-family:Verdana;color:#00205e;">Contact:</label> $doc[email] $doc[phone]</td></tr>
	</table>
a;
}
close();
echo <<<a
</div>
<input name="s_doc" id="s_doc"  type="hidden"/>
<input name="secret_perm" type="hidden"/>
<br/><H3>Select the files you want to share</H3><br/>
Give <b>ALL</b> rights <input type="checkbox" id="p_all"/>
<button type="submit" >Save</button>
a;
//start file history
echo <<<a
<label id="hid_test2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
<h3 style="font-family:verdana;color:#00205e;">Medical Tests</h3></label>
<div id="hid_test" style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
<label>Select All</label><input type="checkbox" id="te"/>
a;
$a=history($id,"test");
while($test=mysql_fetch_array($a)){
	echo "<table>";
	if($test['uptake']&&$test['month']&&$test['day']){
		echo "<tr align=\"left\"><td>".$test['name']." ".$test['uptake']." ".$test['day']."/".$test['month']."/".$test['year']."</td><td><input type=\"checkbox\" name=\"sh_tes[]\" value=\"$test[id]\"/></td></tr>";
	}
	if($test['uptake']&&!$test['month']&&!$test['day']){
		echo "<tr align=\"left\"><td>".$test['name']." ".$test['uptake']."</td><td><input type=\"checkbox\" name=\"sh_tes[]\" value=\"$test[id]\" /></td></tr>";
	}
	if(!$test['uptake']&&$test['month']&&$test['day']){
		echo "<tr align=\"left\"><td>".$test['name']." "." ".$test['day']."/".$test['month']."/".$test['year']."</td><td><input type=\"checkbox\" name=\"sh_tes[]\" value=\"$test[id]\"/></td></tr>";
	}
	echo "</table>";
}
echo "</div>";
echo <<<a
<label id="hid_proc2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
<h3 style="font-family:verdana;color:#00205e;">Medical Procedures</h3></label>
<div id="hid_proc"style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
<label>Select All</label><input type="checkbox" id="pr" />
a;
$a=history($id,"procedure");
while($proc=mysql_fetch_array($a)){
	echo "<table>";
	if($proc['year']!=0){
		echo "<tr align=\"left\"><td>".$proc['name']." ".$proc['year']."</td><td><input type=\"checkbox\"name=\"sh_proc[]\" value=\"$proc[id]\"/></td></tr>";
	}else{
		echo "<tr align=\"left\"><td>".$proc['name']."</td><td><input type=\"checkbox\" name=\"sh_proc[]\" value=\"$proc[id]\"/></td></tr>";}
		echo "</table>";
}
echo "</div>";
echo <<<a
<label id="hid_med2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
<h3 style="font-family:verdana;color:#00205e;">Medications</h3></label>
<div id="hid_med"style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
<label>Select All</label><input type="checkbox" id="me" />
a;
$a=history($id,"medication");
while($med=mysql_fetch_array($a)){
	echo "<table>";
	echo "<tr align=\"left\"><td>".$med['name']."<input type=\"checkbox\" name=\"sh_med[]\" value=\"$med[id]\"/></td></tr> <tr align=\"left\"><td><label size=\"0.5em\" style=\"color:#555\">";if($med['uptake']){echo "uptake:".$med['uptake'];}
	echo "</label></td></tr>
	</table>";
}
echo "</div>";
echo <<<a
<label id="hid_vac2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
<h3 style="font-family:verdana;color:#00205e;">Vaccinations</h3></label>
<div id="hid_vac"style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
<label>Select All</label><input type="checkbox" id="va" />
a;
$a=history($id,"vaccine");
while($vac=mysql_fetch_array($a)){
	echo "<table>";
	echo "<tr align=\"left\"><td>".$vac['name']."</td><td><input type=\"checkbox\" name=\"sh_vac[]\" value=\"$vac[id]\"/></td></tr>
	</table>";
}
echo "</div>";
echo <<<a
<label id="hid_cond2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
<h3 style="font-family:verdana;color:#00205e;">Medical Conditions</h3></label>
<div id="hid_cond"style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
<label>Select All</label><input type="checkbox" id="co" />
a;
$a=history($id,"condition");
while($cond=mysql_fetch_array($a)){
	echo "<table>";
	echo "<tr align=\"left\"><td>".$cond['name']."</td><td><input type=\"checkbox\" name=\"sh_cond[]\" value=\"$cond[id]\"/></td></tr>";
	echo "</table>";
}
echo "</div>";
echo <<<a
<label id="hid_all2" style="border-radius:4px;background-color:#bbb;cursor: pointer;display: block;height:40px;">
<h3 style="font-family:verdana;color:#00205e;">Allergies</h3></label>
<div id="hid_all"style="border-radius:6px;box-shadow: 5px 5px 5px #888;border: 1px solid WindowFrame;background-color: Window;">
<label>Select All</label><input type="checkbox" id="al" />
a;
$a=history($id,"allergy");
while($all=mysql_fetch_array($a)){
	echo "<table>";
	echo "<tr align=\"left\"><td>".$all['name']."</td><td><input type=\"checkbox\" name=\"sh_all[]\" value=\"$all[id]\"/></td></tr>
	</table>";
}
echo "</div>";
echo "</form>";
?>
