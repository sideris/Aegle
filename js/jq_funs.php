<script type="text/javascript">
//user
$(function(){
	$('#home a').click(function(){
				$('#cont1').load('user_ajax/home/home1.php');
 });
 });
 $(function(){
	$('#perms a').click(function(){
				$('#cont1').load('user_ajax/permissions/perms.php');
 });
 });
$(function(){
	$('#myhr a').click(function(){
				$('#cont1').load('user_ajax/myhr/myhr.php');
 });
 });
 
$(function(){
	$('#sets a').click(function(){
				$('#cont1').load('user_ajax/settings/set.php');
 });
 });
 $(function(){
	$('#hstaff a').click(function(){
				$('#cont1').load('user_ajax/hstaff/hstaff.php');
 });
 });
 //lawl
$(function(){
	$('#not').hover(function(){$('#not').attr('src','images/not2.jpg');},function(){$('#not').attr('src','images/not1.jpg');});

 });
 
$(function(){
	$('#not').click(function(){$('#not').attr('src','images/not3.jpg');});

 });

//doctor
$(function(){
	$('#home2 a').click(function(){
				$('#cont1').load('doc_ajax/home/home.php');
 });
 });
$(function(){
	$('#sett2 a').click(function(){
				$('#cont1').load('doc_ajax/settings/set.php');
 });
 });
$(function(){
	$('#patients a').click(function(){
		$('#cont1').load('doc_ajax/patients/patients.php');
	});
});
</script>
