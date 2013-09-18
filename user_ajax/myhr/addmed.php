<script type="text/javascript">
$(function() {
$("#ac2").autocomplete({
	url:'user_ajax/myhr/searchmed.php',	
	 select: function(event, ui) {
        console.dir(ui);
        event.preventDefault();
        $("#ac2").text(ui.item.label);},
	sortFunction: function(a, b, filter) {
			var f = filter.toLowerCase();
			var fl = f.length;
			var a1 = a.value.toLowerCase().substring(0, fl) == f ? '0' : '1';
			var a1 = a1 + String(a.data[0]).toLowerCase();
			var b1 = b.value.toLowerCase().substring(0, fl) == f ? '0' : '1';
			var b1 = b1 + String(b.data[0]).toLowerCase();
			if (a1 > b1) {
				return 1;
			}
			if (a1 < b1) {
				return -1;
			}
			return 0;
		},
		showResult: function(value, data) {
			return '<span>' + value + '</span>';
		},
		maxItemsToShow: 10
	});$("#ac2").flushCache();
	});
</script>
<link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css">
<?php
require('../../site_functions.php');
require '../../js/jfuctions_user.php';
$id=$_SESSION['uid'];
$months=array("","January","February","March","April","May","June","July","August","September","October","November","December");
$a=array("","2+ per day","Daily","Every 2 days","On occasions");

if($_GET["me"]){
	$pid=$_GET["me"];
	$sql="SELECT * FROM us_medication where id='$pid'";
	open();
	$med=mysql_fetch_array(mysql_query($sql));
	close();
	echo <<< A
	<br/><h2 style="font-family:verdana;color:#00205e;">Edit Medication</h2><br/><br/>
	<form method="post" name="procedure" class="form" action="user.php?uid=$id" enctype="multipart/form-data">
	<table align="center">
	<tr>
		<td align="right"><p style="font-family:Verdana;color:#00205e;">*<b>Name:</b></td>
		<td align="left"><input type="text" id="ac2" style="width:130px;" name="edit_med_name" value="$med[name]" autocomplete="off"/></p></td>
	</tr>
	<tr>
		<td align="right"><p style="font-family:Verdana;color:#00205e;"><b>Uptake:</b></td>
		<td align="left"><select name="edit_med_take">
A;
	for($i=0;$i<5;$i++){
		if($med['uptake']==$a[$i]){
			echo "<option value=\"$a[$i]\" selected=\"selected\">$a[$i]</option>";
		}else{
			echo "<option value=\"$a[$i]\">$a[$i]</option>";
		}
	}
	echo <<< A
	</select></p></td>
	</tr>
	<tr>
		<td align="right"><p style="font-family:Verdana;color:#00205e;"><b>Last Received:</b></td>
A;
	echo "<td  align=\"left\"><select name=\"edit_med_month\">";
		echo "<option value=\"0\"></option>";
		for ($i=1;$i<13;$i++){	
		if ($med['month']==$months[$i]){
			echo "<option  value=\"$months[$i]\" selected=\"selected\">$months[$i]</option>";}
		else {
			echo "<option  value=\"$months[$i]\">$months[$i]</option>";}
		}
		echo "</select>";
		echo "<select name=\"edit_med_day\" ><option value=\"\"></option>";

		for($j=1;$j<31;$j++){
			if ($med['day']==$j){
				echo "<option value=\"$j\"  selected=\"selected\">$j</option>";
			}else{
				echo "<option  value=\"$j\">$j</option>";
			}
		}
		echo "</select>";

		echo "<select name=\"edit_med_year\"><option value=\"\"></option>";
		for($j=2012;$j>1990;$j--){
			if ($med['year']==$j){
				echo "<option value=\"$j\"  selected=\"selected\">$j</option>";
			}else{
				echo "<option  value=\"$j\">$j</option>";
			}
		}
		echo "</select></td>";
	
		echo "</tr></table>";
	if($med['current']=='1'){
		 echo "<p><label class=\"formsmall\">I am currently under that medication</label><input type=\"checkbox\" name=\"cur\" value=\"1\"  checked=\"yes\"/></p><br\>
		 <label class=\"formsmall\"><u>delete</u></label><input type=\"checkbox\" name=\"mede\" value=\"1\"/><br\><br\>";	
	 }
	else{ 
		echo"<p><label class=\"formsmall\">I am currently under that medication</label><input type=\"checkbox\" name=\"cur\" value=\"1\"/></p><br\>
		<label class=\"formsmall\"><u>delete</u></label><input type=\"checkbox\" name=\"mede\" value=\"1\"/><br\><br\>";	
	}
	echo <<< A
	<input type="hidden" name="hiddenmedid" value="$med[id]"/>
	<br/><br/><button type="submit">Update</button></form>
A;
}else{
	echo <<< B
	<br/><h2 style="font-family:verdana;color:#00205e;">Add Medication</h2><br/><br/>
	<form method="post" name="newprocedure" class="form" action="user.php?uid=$id" enctype="multipart/form-data">

	<table align="center">
	<tr>
		<td  align="right"><p style="font-family:Verdana;color:#00205e;">*<b>Name:</b></td>
		<td  align="left"><input type="text" style="width:130px;"  id="ac2" name="add_med_name" autocomplete="off"/></p></td>
	</tr>
	<tr>
		<p><span id="last_selected"></span></p>
		<td align="right"><p style="font-family:Verdana;color:#00205e;"><b>Uptake:</b></td>
		<td align="left">
		<select name="add_med_take">
			<option value=""></option>
			<option value="2+ per day">2+ per day</option>
			<option value="Daily">Daily</option>
			<option value="Every 2 days">Every 2 days</option>
			<option value="On occasions">On occasions</option>
			<option value="Only when needed">Only when needed</option>
		</select></p>
		</td>
	</tr>
	<tr>
		<td><p style="font-family:Verdana;color:#00205e;"><b>Last Taken:</b></td>
B;

	echo "<td  align=\"left\"><select name=\"add_med_month\">";
	echo "<option value=\"0\"></option>";
	for ($i=1;$i<13;$i++){	
		echo "<option  value=\"$months[$i]\">$months[$i]</option>";
	}
	echo "</select>";
	echo "<select name=\"add_med_day\" ><option value=\"\"></option>";
	for($j=1;$j<31;$j++){
		echo "<option  value=\"$j\">$j</option>";
	}
	echo "</select>";
	echo "<select name=\"add_med_year\"><option value=\"\"></option>";
	for($j=2012;$j>1990;$j--){
		echo "<option  value=\"$j\">$j</option>";
	}
	echo "</select></td>";
	echo "</tr></table>";
echo <<< B
<p><label class="formsmall">I am currently under that medication</label><input type="checkbox" name="cur2" value="1"/></p><br\><br\>
<input type="hidden" name="hiddenmedid2"/>
<br/><button type="submit">Add</button></form>
B;
}
?>
