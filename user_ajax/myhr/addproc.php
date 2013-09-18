<script type="text/javascript">
$(function() {
$("#ac2").autocomplete({
	url:'user_ajax/myhr/searchproc.php',	
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
		maxItemsToShow: 20
	});
	$("#ac2").flushCache();
	});
</script>
<link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css">
 
<?php
require('../../site_functions.php');
require '../../js/jfuctions_user.php';
$id=$_SESSION['uid'];
if($_GET["a"]){
	$pid=intval($_GET["a"]);
	$sql="SELECT * FROM us_procedure WHERE id='$pid'";
	open();
	$proced=mysql_fetch_array(mysql_query($sql));
	if($proced['year']==0){$proced['year']="";}
	$q="SELECT * FROM file_proc WHERE uid='$id' AND prid='$pid'";
	$files=mysql_query($q);	
	close();
echo <<< A
<br/>
<h2 style="font-family:verdana;color:#00205e;">Edit procedure</h2>
<br/>
<br/>
<form method="post" name="procedure" class="form" action="user.php?uid=$id" enctype="multipart/form-data">

<table align="center">
<tr>
	<td align="right"><p style="font-family:Verdana;color:#00205e;">*<b>Name:</b></td>
	<td align="left"><input type="text" id="ac2" name="edit_proc_name"  style="width:200px;" value="$proced[name]" autocomplete="off"/></p></td>
</tr>
<tr>
	<td align="right"><p style="font-family:Verdana;color:#00205e;"><b>Year:</b></td>
	<td align="left"><input type="text" size="5" name="edit_proc_year"  autocomplete="off" value="$proced[year]"/></p></td>
</tr>
<tr>
	<td align="right"><br><p style="font-family:Verdana;color:#00205e;">&nbsp;<b>Description</b></td align="left">
	<td><textarea type="text" cols="25"  rows="2" name="edit_proc_desc">$proced[comments]</textarea></p></td>
</tr>
<tr>
A;
open();
$i=0;
	while($file=mysql_fetch_array($files)){
		$i++;
		echo "<td><br\>
		<a href=\"users/procedures/$file[fname]\" rel=\"lightbox\"><img src=\"users/procedures/$file[fname]\" style=\"height:150px;width:150px;\" /></a>
		<br/><label class=\"formsmall\">delete</label><input type=\"checkbox\" name=\"delimg[]\" value=\"$file[id]\"/>
		</td>";
	}
	echo "</tr>";
close();
	for($j=0;$j<(3-$i);$j++){
		echo <<<b
		<tr>
			<td></td>
			<td align="left"><input type="file" name="edit_proc_file[]" size="5" style="border:1px solid gray;width:170px;" /></td>
		</tr>
b;
	}
echo <<<A
</table>
<input type="hidden" name="hiddenid" value="$proced[id]"/>
<br/>
<label class="formsmall"><u>delete</u></label><input type="checkbox" name="de" value="1"/><br\>
<button type="submit">Update</button></form>
A;
}else{
echo <<< B
<br/><h2 style="font-family:verdana;color:#00205e;">Add new procedure</h2><br><br>

<form method="post" name="newprocedure" class="form" action="user.php?uid=$id" enctype="multipart/form-data">
<table align="center">
<tr>
	<td align="right"><p style="font-family:Verdana;color:#00205e;">*<b>Name:</b></td>
	<td align="left"><input type="text"  style="width:200px;" id="ac2" name="add_proc_name" autocomplete="off"/></p></td>
</tr>
<tr>
	<td align="right"><p style="font-family:Verdana;color:#00205e;"><b>Year:</b></td>
	<td align="left"><input type="text" size="5" name="add_proc_year"  autocomplete="off"/></p></td>
</tr>
<tr>
	<td align="right"><p style="font-family:Verdana;color:#00205e;">&nbsp;<b>Description</b></td>
	<td align="left"><textarea type="text" cols="25"  rows="5" name="add_proc_desc"  autocomplete="off" ></textarea></p></td>
</tr>
<tr>
	<td align="right"><p style="font-family:Verdana;color:#00205e;"><b>File:</b></td>
	<td align="left"><input type="file" name="add_proc_file[]" size="5" style="border:1px solid gray;width:170px;" /></p></td>
</tr>
<tr>
	<td></td>
	<td align="left"><input type="file" name="add_proc_file[]" size="5" style="border:1px solid gray;width:170px;" /></td>
</tr>
<tr>
	<td></td>
	<td align="left"><input type="file" name="add_proc_file[]" size="5" style="border:1px solid gray;width:170px;" /></td>
</tr>
</table>
<input type="hidden" name="hiddenid2"/>
<button type="submit">Add</button></form>
B;
}
?>
