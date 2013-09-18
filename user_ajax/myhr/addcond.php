<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">
$(function() {
$("#ac2").autocomplete({
	url:'user_ajax/myhr/searchcond.php',	
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
if($_GET["a"]){
	$pid=$_GET["a"];
	$sql="SELECT * from us_condition where id='$pid'";
	open();
	$cond=mysql_fetch_array(mysql_query($sql));
	close();
	if($cond['year']==0){$cond['year']="";}
		echo <<< A
		<br/><h2 style="font-family:verdana;color:#00205e;">Edit Medical Condition</h2><br\><br\>
		<form method="post" name="procedure" class="form" action="user.php?uid=$id" enctype="multipart/form-data">
		<table align="center">
		<tr>
			<td><p style="font-family:Verdana;color:#00205e;">*<b>Name:</b></td>
			<td><input type="text" id="ac2" style="width:130px;" name="edit_cond_name" value="$cond[name]" autocomplete="off"/></p></td>
		</tr>
		<tr>
			<td  align="right"><p style="font-family:Verdana;color:#00205e;"><b>Year:</b></td>
			<td align="left"><input type="text" size="5" name="edit_cond_year" value="$cond[year]"/></p></td>
		</tr>
		</table>
A;
	if($cond['current']=='1'){
	 echo "<p><label class=\"formsmall\">I am currently under that condition</label>
	 <input type=\"checkbox\" name=\"currr\" value=\"1\"  checked=\"yes\"/></p><br\>
	 <label class=\"formsmall\"><u>delete</u></label><input type=\"checkbox\" name=\"pde\" value=\"1\"/><br\><br\>";	
	 }else{ 
	 	echo"<p><label class=\"formsmall\">I am currently under that condition</label>
	 	<input type=\"checkbox\" name=\"currr\" value=\"1\"/></p><br\>
	 	<label class=\"formsmall\"><u>delete</u></label><input type=\"checkbox\" name=\"pde\" value=\"1\"/><br\><br\>";	
	 }
	echo <<< A
	<input type="hidden" name="hiddencondid" value="$cond[id]"/>
	<br/><br/><button type="submit">Update</button></form>
A;
}else{
	echo <<< B
	<br/><h2 style="font-family:verdana;color:#00205e;">Add Medical Condition</h2><br><br>
	<form method="post" name="newprocedure" class="form" action="user.php?uid=$id" enctype="multipart/form-data">
	<table align="center">
		<tr>
			<td><p style="font-family:Verdana;color:#00205e;">*<b>Name:</b></td>
			<td><input type="text" style="width:130px;"  id="ac2" name="add_cond_name" autocomplete="off"/></p></td>
		</tr>
		<p><span id="last_selected"></span></p>
		<tr>
			<td  align="right"><p style="font-family:Verdana;color:#00205e;"><b>Year:</b></td>
			<td  align="left"><input type="text" size="5" name="add_cond_year"/></p></td>
		</tr>
		</table>
		
		<p><label class="formsmall">I am currently under that condition</label><input type="checkbox" name="currr2" value="1"/></p><br\><br\>
		<input type="hidden" name="hiddencondid2"/>
		<br/><button type="submit">Add</button></form>
B;
}
?>
