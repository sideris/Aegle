<script type="text/javascript">
$(function() {
$("#ac2").autocomplete({
	url:'user_ajax/hstaff/search_doc.php',	
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

<script type="text/javascript">
$(function() {
$("#ac1").autocomplete({
	url:'user_ajax/hstaff/search_doc1.php',	
	 select: function(event, ui) {
        console.dir(ui);
        event.preventDefault();
        $("#ac1").text(ui.item.label);},
    
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
	});$("#ac1").flushCache();
	});
</script>
<link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css">

<script type="text/javascript">
$('#names_s').click(function(){
var fi=$('#ac2').val();
var la=$('#ac1').val();
$('#resultbox').load('user_ajax/hstaff/docres.php?fi='+fi+'&&la='+la);
});

$('#id_s').click(function(){
var did=$('#did2').val();
$('#resultbox').load('user_ajax/hstaff/docres2.php?did2='+did);
});
</script>

<?php
require('../../site_functions.php');
require '../../js/jfuctions_user.php';
$id=$_SESSION['uid'];

echo <<<A
<div id="sbox" style="font-family:Verdana;color:#00205e;">
<table align="center">
<tr>
	<td><b>Doctor's first name:</b></td>
	<td><input type="text" id="ac2" style="width:130px;" name="search_first_doc" autocomplete="off"/></td>
</tr>
<tr>
	<td><b>Doctor's last name:</b></td>
	<td><input type="text" id="ac1" style="width:130px;" name="search_last_doc" autocomplete="off"/></td>
</tr>
<tr>
	<td></td>
	<td><button id="names_s">Search</button></td>
</tr>
<tr><td><br/></td></tr>
<tr>
	<td>or Search Doctor by Aeglea id:</td>
	<td><input type="text" id="did2" style="width:130px;" name="search_id_doc" autocomplete="off"/></td>
</tr>
<tr>
	<td></td>
	<td><button id="id_s">Search</button></td>
</tr>
</table>
</div>
<div id="resultbox"></div>
A;
?>
