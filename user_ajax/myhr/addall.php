<script type='text/javascript' src='js/jquery.autocomplete.js'></script>

<script type="text/javascript">
$(function() {
$("#ac2").autocomplete({
	url:'user_ajax/myhr/searchall.php',	
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
if($_GET["al"]){
	$pid=$_GET["al"];
	$sql="SELECT * from us_allergy where id='$pid'";
	open();
	$all=mysql_fetch_array(mysql_query($sql));
	close();
	echo <<< A
	<br/><h2 style="font-family:verdana;color:#00205e;">Edit Allergy</h2><br><br>
	<form method="post" name="allcine" class="form" action="user.php?uid=$id" enctype="multipart/form-data">
	<p style="font-family:Verdana;color:#00205e;margin-left:-8px;">*<b>Name:</b><input type="text" id="ac2" style="width:130px;" name="edit_all_name" value="$all[name]" autocomplete="off"/></p>
	<label class="formsmall"><u>delete</u></label><input type="checkbox" name="ade" value="1"/><br><br>
	<input type="hidden" name="hiddenallid" value="$all[id]"/>
	<br/><br/><button type="submit">Update</button></form>
A;
}else{
	echo <<< B
	<br/><h2 style="font-family:verdana;color:#00205e;">Add Allergy</h2><br><br>
	<form method="post" name="newallcine" class="form" action="user.php?uid=$id" enctype="multipart/form-data">
	<p style="font-family:Verdana;color:#00205e;margin-left:-8px;">*<b>Name:</b><input type="text" style="width:130px;" id="ac2" name="add_all_name" autocomplete="off"/></p>
	<input type="hidden" name="hiddenallid2"/>
	<br/><button type="submit">Add</button></form>
B;
}
?>
