<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css">

<script type="text/javascript">
$(function() {
$("#ac2").autocomplete({
	url:'user_ajax/myhr/searchtes.php',	
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
		maxItemsToShow: 15
	});$("#ac2").flushCache();
	});
</script>
<?php
require('../../site_functions.php');
require '../../js/jfuctions_user.php';
$months=array("","January","February","March","April","May","June","July","August","September","October","November","December");
$id=$_SESSION['uid'];

if($_GET["tes"]){
	$tid=$_GET["tes"];
	$sql="SELECT * from us_test where id='$tid'";
	open();
	$tes=mysql_fetch_array(mysql_query($sql));
	if($tes['year']==0){
		$tes['year']="";
	}
	$q="SELECT * FROM file_test WHERE uid='$id' AND tid='$tes[id]'";
	$files=mysql_query($q);
	close();
echo <<< A
	<br/>
	<h2 style="font-family:verdana;color:#00205e;">Edit Test</h2>
	<br/><br/>

	<form method="post" name="test" class="form" action="user.php?uid=$id" enctype="multipart/form-data">
	<table align="center">
	<tr>
		<td align="right"><p style="font-family:Verdana;color:#00205e;">*<b>Name:</b></td>
		<td align="left"><input type="text" id="ac2" name="edit_tes_name"  style="width:200px;" value="$tes[name]" autocomplete="off"/></p></td>
	</tr>
	<tr>
		<td align="right"><p style="font-family:Verdana;color:#00205e;">*<b>Value:</b></td>
		<td align="left"><input type="text"  name="edit_tes_value"  style="width:50px;"  value="$tes[value]"/><input type="text"  name="edit_tes_unit" value="$tes[unit]" style="width:30px;"/><label class="formsmall"> (unit)</label></p></td>
	</tr>
		</tr>
	<tr>
		<td align="right"><p style="font-family:Verdana;color:#00205e;"><b>Date:</b></td>
		<td  align="left">
			<select name="edit_tes_month">
				<option value="0"></option>
A;
	for ($i=1;$i<13;$i++){	
		if ($tes['month']==$months[$i]){
			echo "<option  value=\"$months[$i]\" selected=\"selected\">$months[$i]</option>";
		}else{
			echo "<option  value=\"$months[$i]\">$months[$i]</option>";
		}
	}
	echo "</select>";
	echo "<select name=\"edit_tes_day\" ><option value=\"\"></option>";
	for($j=1;$j<31;$j++){
		if ($tes['day']==$j){
		echo "<option value=\"$j\"  selected=\"selected\">$j</option>";
		}else {
			echo "<option  value=\"$j\">$j</option>";
		}
	}
	echo "</select>";
	echo "<select name=\"edit_tes_year\"><option value=\"\"></option>";
	for($j=2012;$j>1960;$j--){
		if ($tes['year']==$j){
			echo "<option value=\"$j\"  selected=\"selected\">$j</option>";
		}else{
			echo "<option  value=\"$j\">$j</option>";
		}
	}
echo <<< A
	</select></td>
	</tr>
	<tr>
		<td align="right"><br><p style="font-family:Verdana;color:#00205e;">&nbsp;<b>Comments</b></td>
		<td align="left"><textarea type="text" cols="25"  rows="2" name="edit_tes_desc">$tes[comments]</textarea></p></td>
	</tr>
	<tr>

A;
open();
$i=0;//		<td align="right"><p style="font-family:Verdana;color:#00205e;"><b>File:</b></td>	
	while($file=mysql_fetch_array($files)){
		$i++;
		echo "<td><br\>
		<a href=\"users/tests/$file[fname]\" rel=\"lightbox\"><img src=\"users/tests/$file[fname]\" style=\"height:150px;width:150px;\" /></a>
		<br/><label class=\"formsmall\">delete</label><input type=\"checkbox\" name=\"delimg_tes[]\" value=\"$file[id]\"/>
		</td>";
	}
	echo "</tr>";
close();
	for($j=0;$j<(3-$i);$j++){
		echo <<<b
		<tr>
			<td></td>
			<td align="left"><input type="file" name="edit_test_file[]" size="5" style="border:1px solid gray;width:170px;" /></td>
		</tr>
b;
	}
echo <<<A

</table>
<br/>
	<input type="hidden" name="hiddentesid" value="$tid"/>
	<label class="formsmall"><u>delete</u></label><input type="checkbox" name="tede" value="1"/><br\>
	<button type="submit">Update</button></form>
A;
}else{
echo <<< A
	<br/><h2 style="font-family:verdana;color:#00205e;">Add Test</h2><br><br>
	
	<form method="post" name="test" class="form" action="user.php?uid=$id" enctype="multipart/form-data">
	<table align="center">
	<tr>
		<td align="right"><p style="font-family:Verdana;color:#00205e;">*<b>Name:</b></td>
		<td align="left"><input type="text" id="ac2" name="add_tes_name"  style="width:200px;"  autocomplete="off"/></p></td></tr>
	<tr>
		<td align="right"><p style="font-family:Verdana;color:#00205e;">*<b>Value:</b></td>
		<td align="left"><input type="text"  name="add_tes_value"  style="width:50px;"  autocomplete="off"/><input type="text"  name="add_tes_unit"  style="width:30px;"/><label class="formsmall"> (unit)</label></p></td>
	</tr>
	<tr>
		<td align="right"><p style="font-family:Verdana;color:#00205e;"><b>File:</b></td>
		<td align="left"><input type="file" name="add_tes_file[]" size="5" style="border:1px solid gray;width:170px;" "/></p></td>
	</tr>
	<tr>
		<td></td>
		<td align="left"><input type="file" name="add_tes_file[]" size="5" style="border:1px solid gray;width:170px;" /></td></tr>
	<tr>
		<td></td>
		<td align="left"><input type="file" name="add_tes_file[]" size="5" style="border:1px solid gray;width:170px;" /></td>
	</tr>
		<td align="right"><p style="font-family:Verdana;color:#00205e;"><b>Date:</b></td>
		<td  align="left">
			<select name="add_tes_month">
				<option value="0"></option>
A;
	for ($i=1;$i<13;$i++){	
		echo "<option  value=\"$months[$i]\">$months[$i]</option>";
	}
	echo "</select>";
	echo "<select name=\"add_tes_day\" ><option value=\"\"></option>";
	for($j=1;$j<31;$j++){
		echo "<option  value=\"$j\">$j</option>";
	}
	echo "</select>";
	echo "<select name=\"add_tes_year\"><option value=\"\"></option>";
	for($j=2012;$j>1960;$j--){
		echo "<option  value=\"$j\">$j</option>";
	}
	echo <<< A
	</select></td>
	</tr>
	<tr>
		<td align="right"><br/><p style="font-family:Verdana;color:#00205e;">&nbsp;<b>Comments</b></td>
		<td><textarea type="text" cols="25"  rows="2" name="add_tes_desc"></textarea></p></td>
	</tr>
</table>
<br/>
<input type="hidden" name="hiddentesid2" value="$tes[id]"/>
<button type="submit">Add</button></form>
A;

}
