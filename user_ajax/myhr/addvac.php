<script type="text/javascript">
$(function() {
$("#ac2").autocomplete({
	url:'user_ajax/myhr/searchvac.php',	
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
if($_GET["v"]){
	$pid=$_GET["v"];
	$sql="SELECT * from us_vaccine where id='$pid'";
	open();
	$vac=mysql_fetch_array(mysql_query($sql));
	close();
	if($vac['year']==0){
		$vac['year']="";
	}
	echo <<< A
	<br/><h2 style="font-family:verdana;color:#00205e;">Edit Vaccine</h2><br\><br\>
	
	<form method="post" name="vaccine" class="form" action="user.php?uid=$id" enctype="multipart/form-data">
	<table align="center">
	<tr>
		<td align="right"><p style="font-family:Verdana;color:#00205e;">*<b>Name:</b></td>
		<td align="left"><input type="text" id="ac2" style="width:130px;" name="edit_vac_name" value="$vac[name]" autocomplete="off"/></p></td>
	</tr>
	<tr>
		<td align="right"><p style="font-family:Verdana;color:#00205e;"><b>Year:</b></td>
		<td align="left"><input type="text" size="5" name="edit_vac_year" value="$vac[year]" autocomplete="off"/></p></td>
	</tr>
	</table>
	 
	 <label class="formsmall"><u>delete</u></label><input type="checkbox" name="vde" value="1"/><br\><br\>
	<input type="hidden" name="hiddenvacid" value="$vac[id]"/>
	<br/><br/><button type="submit">Update</button></form>
A;
}
else{
	echo <<< B
	<br/><h2 style="font-family:verdana;color:#00205e;">Add Vaccine</h2><br\><br\>
	<form method="post" name="newvaccine" class="form" action="user.php?uid=$id" enctype="multipart/form-data">
	<table align="center">
	<tr>
		<td align="right"><p style="font-family:Verdana;color:#00205e;">*<b>Name:</b></td>
		<td align="left"><input type="text" style="width:130px;" id="ac2" name="add_vac_name" autocomplete="off"/></p></td>
	</tr>
	<tr>
		<td align="right"><p style="font-family:Verdana;color:#00205e;"><b>Year:</b></td>
		<td align="left"><input type="text" size="5" name="add_vac_year" autocomplete="off"/></p></td>
	</tr>
	</table>
	
	<input type="hidden" name="hiddenvacid2"/>
	<br/><button type="submit">Add</button></form>
B;
}
?>
