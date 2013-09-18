<?php
require 'site_functions.php'; 
 require 'header.php';
if(isset($_SESSION['uid'])){
	$id=trim($_SESSION['uid']);
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=user.php?uid=$id\">";
}elseif(isset($_SESSION['did'])){
	$id=trim($_SESSION['did']);
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=doctor.php?did=$id\">";
}else{
?>
<script type="text/javascript" src="js/load1.js"></script>
<script type="text/javascript">
 $(function(){
	$('#docbut button').click(function(){
				$('#ind_cont').load('user_ajax/index/register.php #index2');
 });
 });
 $(function(){
	$('#usbut button').click(function(){
				$('#ind_cont').load('user_ajax/index/register.php #index1');
 });
 });
</script>
<?php
	echo <<< A
	<div id="message">
		<h1 style="font-family:verdana;color:#142a55;">Welcome to AeGlea!</h1>
		<h3 style="font-family:verdana;color:#e2e9f8;">Safe and Healthy</h2>
	</div>

	<div id="ind_cont" style="height:850px;" >
	<button onclick="$('#ind_cont').load('user_ajax/index/register.php #index1');">Register</button>
	</div>
A;
}
require 'footer.php';
?>
