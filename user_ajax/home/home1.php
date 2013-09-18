<?php
require ('../../site_functions.php');
$user=findUser($_SESSION['uid']);
$id=$user['id'];

function selweight2($weight){
echo <<<a
	<select name="weight" onChange="document.home1.submit()">
	<option value="0"
a;
	if ($weight==0) echo "selected=\"selected\"";
	echo "></option>";
	for ($i=1;$i<251;$i++){	
		echo "<option value=\"$i\"";
		if ($weight==$i) echo "selected=\"selected\"";
		echo ">$i</option>";
	}
	echo "</select>";	
}

function selheight2($height){
echo <<<b
<select name="height" onChange="document.home2.submit();">";
<option value="0"
b;
if ($height==0) echo "selected=\"selected\"";
echo "></option>";
for ($i=120;$i<250;$i++){	
	echo "<option value=\"$i\"";
	if ($height==$i) echo "selected=\"selected\"";
	echo ">$i</option>";
}
echo "</select>";	
}
?>

<div id="hom1" style="text-align:left;margin-top:20px;margin-left:50px;float:left;color:#00205e;">
<?php
	if($user['btype']){
		echo "<label style=\"cursor: text;\"><b>My Blood Type </b>: </label>"."<label style=\"color:#FF3030;\">".$user['btype']."</label><br/><br/>";
	}else{ 
		echo "<label><b>My Blood Type </b>: <br/>None.</label><br/>";
	}
echo "<br/>";

if(!isset($_POST['weight'])){
	echo "<form name=\"home1\" action=\"user.php?uid=$id\" method=\"POST\" >";

	if($user['weight']){
		echo "<p><label style=\"cursor: text;\"><b>My Weight</b>: $user[weight] kg</label>";
	}else{ 
		echo "<p><label><b>My Weight </b>: No Weight</label>";
	}
		echo "<br/><br/><label  style=\"cursor: text;\">change weight: </label>";
		selweight2($user['weight']);
		echo "</p></form>";
}

if(!isset($_POST['height'])){
echo "<form name=\"home2\" action=\"user.php?uid=$id\" method=\"POST\">";

	if($user['height']&&$user['height']%100>=10){
		echo "<br/><br/><p><label style=\"cursor: text;\"><b >My Height</b>: ".(($user['height']-$user['height']%100)/100).".".($user['height']%100)." m</label>";
	}elseif($user['height']&&$user['height']%100<10){
		echo "<br/><br/><p><label style=\"cursor: text;\"><b >My Height</b>: ".(($user['height']-$user['height']%100)/100).".0".($user['height']%100)." m</label>";
	}else{
		echo "<br/><br/><p><label><b>My Height </b>:  No Height</label>";}
		echo "<br/><br/><label  style=\"cursor: text;\">change height: </label>";
		selheight2($user['height']);echo "</p></form>";
	}

	echo "<br/><br/>My Body to Mass Index(BMI): ";
	$bmi=round($user['weight']/(($user['height']/100)*($user['height']/100)),1);
	if($bmi<16)$status="<b>Severely Underweight</b>";
	if($bmi>=16&&$bmi<18.5)$status="Underweight";
	if($bmi>=18.5&&$bmi<25)$status="Normal";
	if($bmi>=25&&$bmi<30)$status="Overweight";
	if($bmi>=30&&$bmi<35)$status="Obese Class I";
	if($bmi>=35&&$bmi<40)$status="<b>Obese Class II</b>";
	if($bmi>=40)$status="<b>Obese Class III</b>"." <u>Please find help</u>";
	if($user['weight']&&$user['height']){echo $bmi;echo "<br/><br/> Result: ".$status;}else{ echo "None.";}
	echo "</div>";
	echo "<div id=\"hom2\" style=\"text-align:left;margin-left:50px;float:left;margin-left:150px;margin-top:20px;color:#00205e;\">";
	$flag=0;
	$flag2=0;
	$sql="SELECT * from us_medication WHERE uid='$id'";
	$sql2="SELECT * from us_condition WHERE uid='$id'";
	$sql3="SELECT * from us_allergy WHERE uid='$id'";
	open();
	$result=mysql_query($sql);
	$result2=mysql_query($sql2);
	$result3=mysql_query($sql3);
	close();
	echo "  "."<b style=\"margin-left:5px;\"><u>My Current Medical Conditions</u></b><br/>";
	echo"<table>";

	if($result2 && mysql_numrows($result2)>0){
		while($cond=mysql_fetch_array($result2)){
			if($cond['current']==1){
			$flag2=1;
			echo "<tr><td>
			<label style=\"margin-left:30px;cursor:text;\">".$cond['name']."</label></td><td>
			<font size=\"0.3em\"color=\"blue\" style=\"text-align:middle;cursor:pointer;margin-left:5px;\">
			<u><b id=\"stopcond\" onclick=\"$('#cont2').load('user_ajax/home/passed_cond.php?m=$cond[id]');$('#cont1').load('user_ajax/home/home1.php');\">delete</b></u></font></td></tr>";
			}
		} 
	}

	if($flag2==0){
		echo "<tr><br/><td><label style=\"margin-left:30px;margin-bottom:15px;cursor:text;\">No Medical Conditions!</td></tr></label>";
	}
	echo "</table>";
	echo "  "."<br/><br/><b style=\"margin-left:5px;\"><u>My Current Medication</u></b><br/>";
	echo"<table>";
	if($result && mysql_numrows($result)>0){
		while($meds=mysql_fetch_array($result)){
			if($meds['current']==1){
				$flag=1;
				echo "<tr><td><label style=\"margin-left:30px;cursor:text;\">".$meds['name']."</label></td>
				<td><font size=\"0.3em\"color=\"blue\" style=\"text-align:middle;cursor: pointer;margin-left:10px;\">
				<u><b id=\"delmed\" onclick=\"$('#cont2').load('user_ajax/home/delmed.php?q=$meds[id]');$('#cont1').load('user_ajax/home/home1.php');\">stop</b></u></font></td></tr>";
			}
		} 
	}
	if($flag==0){
		echo "<tr><br/><td><label style=\"margin-left:30px;margin-bottom:15px;cursor:text;\">Under no medication!</label></td></tr>";
	}
	echo "</table>";

	echo "  "."<br/><br/><b style=\"margin-left:5px;\"><u>My Allergies</u></b><br/>";
	echo"<table>";
	if($result3 && mysql_numrows($result3)>0){
		while($all=mysql_fetch_array($result3)){
			echo "<tr><td><label style=\"margin-left:30px;cursor:text;\">".$all['name']."</label></td></tr>";
			}
	}else{
		echo "<tr><br/><td><label style=\"margin-left:30px;margin-bottom:15px;cursor:text;\">No allergies!</td></tr></label>";
	}
	echo "</table>";

	echo "  "."<br/><br/><b style=\"margin-left:5px;\"><u>My Insurance</u></b>";
	if($user['insurance']){
		echo "<br/><br/><label style=\"margin-left:30px;cursor:text;\">".$user['insurance']."</label>";
	}
	else{ 
		echo "<br/><label style=\"margin-left:30px;cursor:text;\">No Insurance. Signup with one of our partners!</label>";
	}
	echo "</div>";
?>
