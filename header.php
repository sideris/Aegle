<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noodp,noydir" /><meta name="description" content="Aeglea is a health info ultility that helps people keep track of their medical records. They can access them anywhere without having to move them everywhere they go. People can also 
	give access to their loved one and their doctors for more acurate diagnosis" />
	<link href="style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
	<script src="js/lightbox.js"></script>
	<link href="js/lightbox.css" rel="stylesheet" />
	<title>Aegle: Your Health in your hands</title>
</head>
<body>
<?php
if(isset($_SESSION['uid'])){
	?><script type="text/javascript">$(function(){$(window).load(function () {$('#cont1').load('user_ajax/home/home1.php');});});</script><?php
}
elseif(isset($_SESSION['did'])){
	?><script type="text/javascript">$(function(){$(window).load(function () {$('#cont1').load('doc_ajax/home/home.php');});});</script><?php
}
?>
<style type="text/css">
#loading {
  width: 100%;
  height: 100%;
  
  position: fixed;
  display: block;
  opacity: 0.7;
  background-color: #fff;
  z-index: 99;
  text-align: center;
}

#loading-image {
  position: absolute;
  margin:0 auto;
}
</style>

<script language="javascript" type="text/javascript">
  $(window).load(function() {
    $('#loading').hide();
  });
</script>
<script type="text/javascript">
$(document).ready(function(){ 
	$('#pic2').live('change', function(){ 
		$("#preview").html('');
		$("#preview").html('<img src="images/loader.gif" alt="Uploading...."/>');
		$("#setform").ajaxForm({target: '#preview'}).submit();
	});
}); 
</script>
<div id="header">
<?php 
if(isset($_SESSION['uid'])||isset($_SESSION['did'])){
	if($_SESSION['level']==1){
		$id=$_SESSION['uid'];
		echo "<div id=\"logo\"><a href=\"user.php?uid=$id\"><img src=\"logo2.jpg\"/></a></div>";
	}
	if($_SESSION['level']==2){
		$id=$_SESSION['did'];
		echo "<div id=\"logo\"><a href=\"doctor.php?did=$id\"><img src=\"logo2.jpg\"/></a></div>";
	}
}
if(!isset($_SESSION['uid'])&&!isset($_SESSION['did'])){
	echo "<div id=\"logo\"><a href=\"index.php\"><img src=\"logo2.jpg\"/></a></div>";
}
?>
<div id="sign">
<?php
if (isset($_SESSION['uid'])){
	$user=findUser($_SESSION['uid']);
	echo <<<a
	<table style="text-align:center;margin-top:30px;">
	<tr>
		<td><label><b><font color="#25567b" size="4.5" style="Verdana" >$user[last] $user[name]</font></b></td>
		<td><a href="user.php?uid=$user[id]"><img src="profile/$user[prof]" style="height:40px;width:40px;margin-top:-20px;margin-left:15px;"></img></a></td>
		<td align="center"><img style="margin-right:5px;margin-left:2px;" id="not" src="images/not1.jpg"></img></td>
	</tr>
	<tr>
		<td align="left"><a href="index.php?logout"><font size="-2" color="#0e0602">Logout</font></a></label></td>
	</tr>
	</table>
a;
	if ($_SESSION['level']==9) echo "<a href=\"admin.php\">[admin]</a>";
}elseif(isset($_SESSION['did'])){
		$doc=findDoc($_SESSION['did']);
		echo<<<b
		 <table style="text-align:center;margin-top:30px;">
		 <tr>
			<td><label><b><font color="#25567b" size="4.5" style="Verdana" >$doc[last] $doc[first]</font></b></td>
			<td><a href="doctor.php?did=$doc[id]"><img src="profile/$doc[prof]" style="height:40px;width:40px;margin-top:-20px;margin-left:15px;"></img></a></td>
			<td align="center"><img style="margin-right:5px;margin-left:2px;" id="not" src="images/not1.jpg"></img></td></tr>
		<tr>
			<td align="left"><a href="index.php?logout"><font size="-2" color="#0e0602">Logout</font></a></label></td>
		</tr>
		</table>
b;
}else{
	echo <<< A
		<form method="post" action="signin.php">
		<table style="margin-left:10px;margin-top:30px;">
		<tr>
			<td><label><font color="white" size="4">Username</font> </label></td><td><input type="text" name="usermail"size="13" tabindex=6/></td>
			<td><label><font color="white" size="4">password</font><p><span class="formsmall" style="margin-left:-30px;"><a href="reset.php"tabindex=9><font size="-4">Recover</font></a></span></p></label></td>
			<td><input type="password" name="password"size="13" tabindex=7/></td>
			<td><button  type="submit" tabindex=8>Sign In</button></td>
		</tr>
		</table>
		<div class="spacer"></div>
		</form>
A;
}
		  ?>
	  </div>
	</div>
