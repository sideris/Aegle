<?php 
require 'site_functions.php';
require("header.php");
require ('js/jq_funs.php');

if(!isset($_SESSION['uid'])){		
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=signin.php\">";
}else{
	$user=findUser(intval($_GET['uid']));
}

if($_GET['uid']==$_SESSION['uid']){
	include 'js/jfuctions_user.php';
	$id=$_SESSION['uid'];

//add/change medical tests
if (isset($_POST['hiddentesid'])){
	open();
	$idd=intval($_POST['hiddentesid']);
	$a=mysql_real_escape_string($_POST['edit_tes_name']);
	$b=mysql_real_escape_string($_POST['edit_tes_month']);
	$c=mysql_real_escape_string($_POST['edit_tes_year']);
	$d=mysql_real_escape_string($_POST['edit_tes_day']);
	$e=mysql_real_escape_string($_POST['edit_tes_value']);
	$f=mysql_real_escape_string($_POST['edit_tes_unit']);
	$g=mysql_real_escape_string($_POST['edit_tes_desc']);
	
	close();
	$sql="update us_test set name='$a' where id='$idd'";
	$sql2="update us_test set month='$b' where id='$idd'";
	$sql3="update us_test set year='$c' where id='$idd'";
	$sql4="update us_test set day='$d' where id='$idd'";
	$sql5="update us_test set value='$e' where id='$idd'";
	$sql6="update us_test set unit='$f' where id='$idd'";
	$sql7="update us_test set comments='$g' where id='$idd'";
	open();
	$result=mysql_query($sql);
	$result2=mysql_query($sql2);
	$result3=mysql_query($sql3);
	$result4=mysql_query($sql4);
	$result5=mysql_query($sql5);
	$result6=mysql_query($sql6);
	$result7=mysql_query($sql7);
	
	if($_FILES['edit_test_file']){
		$procimages=$_SERVER['DOCUMENT_ROOT']."/aeglea/users/tests";
		foreach($_FILES['edit_test_file']['error'] as $file=>$err){
			if($err== UPLOAD_ERR_OK){
				$tmp=$_FILES['edit_test_file']['tmp_name'][$file];
				$name=$_FILES['edit_test_file']['name'][$file];
				$name_prepend=0;
				$destination_file_name=$name_prepend."_".$name;
				while (file_exists("$procimages/$destination_file_name")) {
					$name_prepend+=rand();
					$destination_file_name=$name_prepend."_".$filename;
				}
				$filename=$destination_file_name;
				move_uploaded_file($tmp, "$procimages/$filename");
				$q="INSERT INTO file_test VALUES ('','$id','$idd','$filename')";
				$result2=mysql_query($q);
			}
		}
	}
	
	
	if($_POST['delimg_tes']){
		foreach($_POST['delimg_tes'] as $f){
			$sq1="SELECT * FROM file_test WHERE id='$f'";
			$sq="DELETE FROM file_test WHERE id='$f'";
			$file=mysql_fetch_array(mysql_query($sq1));
			$res=mysql_query($sq);
			unlink($_SERVER['DOCUMENT_ROOT'].'/aeglea/users/tests/'.$file['fname']);
		}
	}
	close();
	if($_POST['tede']==1){
		$sql8="DELETE from us_test where id='$idd'";
		$pe="DELETE FROM doc_perm WHERE fileid='$idd' AND type='test'";
		$fs="SELECT * FROM file_test WHERE tid='$idd'";
		$ds="DELETE FROM file_test WHERE tid='$idd' AND id='$id'";
		open();
		$asd=mysql_query($sql8);
		$r=mysql_query($pe);
		$del_file_proc=mysql_query($ds);
		$del_files=mysql_query($fs);
		while($file=mysql_fetch_array($del_files)){
			unlink($_SERVER['DOCUMENT_ROOT'].'/aeglea/users/tests/'.$file['fname']);
		}
		close();
	}
?>
	<script type="text/javascript">$(function(){$(window).load(function () {$('#cont1').load('user_ajax/myhr/myhr_tes.php');});});</script>
<?php
}
if (isset($_POST['hiddentesid2'])){
	open();
	$idd=intval($_POST['hiddentesid2']);
	$a=mysql_real_escape_string($_POST['add_tes_name']);
	$b=mysql_real_escape_string($_POST['add_tes_month']);
	$c=mysql_real_escape_string($_POST['add_tes_year']);
	$d=mysql_real_escape_string($_POST['add_tes_day']);
	$e=mysql_real_escape_string($_POST['add_tes_value']);
	$f=mysql_real_escape_string($_POST['add_tes_unit']);
	$g=mysql_real_escape_string($_POST['add_tes_desc']);
	close();
	$sql="insert into us_test values ('','$id','$a','$e','$f',null,null,null,'$b','$d','$c','$g')";
	open();
	$result=mysql_query($sql);
	$fid=mysql_insert_id();

	$procimages=$_SERVER['DOCUMENT_ROOT']."/aeglea/users/tests";

	foreach($_FILES['add_tes_file']['error'] as $file=>$err){
		if($err== UPLOAD_ERR_OK){
			$tmp=$_FILES['add_tes_file']['tmp_name'][$file];
			$name=$_FILES['add_tes_file']['name'][$file];
			$name_prepend=0;
			$destination_file_name=$name_prepend."_".$name;
			while (file_exists("$procimages/$destination_file_name")) {
				$name_prepend+=rand();
				$destination_file_name=$name_prepend."_".$filename;
			}
			$filename=$destination_file_name;
			move_uploaded_file($tmp, "$procimages/$filename");
			$q="INSERT INTO file_test VALUES ('','$id','$fid','$filename')";
			$result2=mysql_query($q);
		}
	}
	close();

?>
	<script type="text/javascript">$(function(){$(window).load(function () {$('#cont1').load('user_ajax/myhr/myhr_tes.php');});});</script>
<?php
}
//end medical tests

//add/change medication
if (isset($_POST['hiddenmedid'])){
	open();
	$idd=intval($_POST['hiddenmedid']);
	$a=mysql_real_escape_string($_POST['edit_med_name']);
	$b=mysql_real_escape_string($_POST['edit_med_take']);
	$c=mysql_real_escape_string($_POST['edit_med_month']);
	$e=mysql_real_escape_string($_POST['edit_med_year']);
	$f=mysql_real_escape_string($_POST['edit_med_day']);
	close();
	$d=intval($_POST['cur']);
	$sql="update us_medication set name='$a' where id='$idd'";
	$sql2="update us_medication set uptake='$b' where id='$idd'";
	$sql3="update us_medication set month='$c' where id='$idd'";
	$sql4="update us_medication set current='$d' where id='$idd'";
	$sql5="update us_medication set day='$f' where id='$idd'";
	$sql6="update us_medication set year='$e' where id='$idd'";
	open();
	$result=mysql_query($sql);
	$result2=mysql_query($sql2);
	$result3=mysql_query($sql3);
	$result4=mysql_query($sql4);
	$result5=mysql_query($sql5);
	$result6=mysql_query($sql6);
	close();
	if($_POST['mede']==1){
		$sql7="DELETE from us_medication where id='$idd'";
		$pe="DELETE FROM doc_perm WHERE fileid='$idd' AND type='medication'";
		open();
		$asd=mysql_query($sql7);
		$r=mysql_query($pe);
		close();
	}
?>
	<script type="text/javascript">$(function(){$(window).load(function () {$('#cont1').load('user_ajax/myhr/myhr_med.php');});});</script>
<?php
}
if (isset($_POST['hiddenmedid2'])){
	open();
	$mname=mysql_real_escape_string($_POST['add_med_name']);
	$b=mysql_real_escape_string($_POST['add_med_take']);
	$c=mysql_real_escape_string($_POST['add_med_month']);
	$d=intval($_POST['cur2']);
	$e=mysql_real_escape_string($_POST['add_med_year']);
	$f=mysql_real_escape_string($_POST['add_med_day']);
	close();
	if($mname!=""&&$mname!=null){
	$sql="insert into us_medication values (NULL,'$id','$mname','$b','$e','$f','$c','$d')";
	}
	open();
	$result=mysql_query($sql);
	close();
?>
	<script type="text/javascript">$(function(){$(window).load(function () {$('#cont1').load('user_ajax/myhr/myhr_med.php');});});</script>
<?php
}
//end add/change medication

//add/change allergies
if (isset($_POST['hiddenallid'])){
	open();
	$idd=intval($_POST['hiddenallid']);
	$a=mysql_real_escape_string($_POST['edit_all_name']);
	$sql="update us_allergy set name='$a' where id='$idd'";
	$result=mysql_query($sql);
	close();
	if($_POST['ade']==1){
		$sql4="DELETE from us_allergy where id='$idd'";
		$pe="DELETE FROM doc_perm WHERE fileid='$idd' AND type='allergy'";
		open();
		$asd=mysql_query($sql4);
		close();
	}	
?>
	<script type="text/javascript">$(function(){$(window).load(function () {$('#cont1').load('user_ajax/myhr/myhr_all.php');});});</script>
<?php
}
if (isset($_POST['hiddenallid2'])){
	open();
	$aname=mysql_real_escape_string($_POST['add_all_name']);
	if($aname!=""&&$aname!=null){
	$sql="insert into us_allergy values (NULL,'$id','$aname')";
	}
	$result=mysql_query($sql);
	close();
	?>
	<script type="text/javascript">$(function(){$(window).load(function () {$('#cont1').load('user_ajax/myhr/myhr_all.php');});});</script>
<?php
}
//end add/change allergies

//add/change vaccines
if (isset($_POST['hiddenvacid'])){
	open();
	$idd=intval($_POST['hiddenvacid']);
	$a=mysql_real_escape_string($_POST['edit_vac_name']);
	$b=intval($_POST['edit_vac_year']);
	$sql="update us_vaccine set name='$a' where id='$idd'";
	$sql2="update us_vaccine set year='$b' where id='$idd'";

	$result=mysql_query($sql);
	$result2=mysql_query($sql2);
	close();
	if($_POST['vde']==1){
		$sql4="DELETE from us_vaccine where id='$idd'";
		$pe="DELETE FROM doc_perm WHERE fileid='$idd' AND type='vaccine'";
		open();
		$asd=mysql_query($sql4);
		$q=mysql_query($pe);
		close();
	}
	?>
	<script type="text/javascript">$(function(){$(window).load(function () {$('#cont1').load('user_ajax/myhr/myhr_vac.php');});});</script>
	<?php
}
if (isset($_POST['hiddenvacid2'])){
	open();
	$vname=mysql_real_escape_string($_POST['add_vac_name']);
	$vyear=intval($_POST['add_vac_year']);
	if($vname!=""&&$vname!=null){
			$sql="insert into us_vaccine values (NULL,'$id','$vname','$vyear')";
	}
	$result=mysql_query($sql);
	close();
?>
	<script type="text/javascript">$(function(){$(window).load(function () {$('#cont1').load('user_ajax/myhr/myhr_vac.php');});});</script>
<?php
}
//end add/change vaccines

//add/change conditions
if (isset($_POST['hiddencondid'])){
	open();
	$idd=intval($_POST['hiddencondid']);
	$a=mysql_real_escape_string($_POST['edit_cond_name']);
	$b=intval($_POST['edit_cond_year']);
	$sql="UPDATE us_condition SET name='$a' WHERE id='$idd'";
	$sql2="UPDATE us_condition SET year='$b' WHERE id='$idd'";
	$sql3="UPDATE us_condition SET current='$_POST[currr]' WHERE id='$idd'";
	$result=mysql_query($sql);
	$result2=mysql_query($sql2);
	$result3=mysql_query($sql3);
	close();
	if($_POST['pde']==1){
		$sql4="DELETE FROM us_condition WHERE id='$idd'";
		$pe="DELETE FROM doc_perm WHERE fileid='$idd' AND type='condition'";
		open();
		$asd=mysql_query($sql4);
		$r=mysql_query($pe);
		close();
	}
?>
	<script type="text/javascript">$(function(){$(window).load(function () {$('#cont1').load('user_ajax/myhr/myhr_cond.php');});});</script>
<?php
}
if (isset($_POST['hiddencondid2'])){
	open();
	$cname=mysql_real_escape_string($_POST['add_cond_name']);
	$cyear=intval($_POST['add_cond_year']);
	$ccur=$_POST['currr2'];
	if($cname!=""&&$cname!=null){
		$sql="INSERT INTO us_condition VALUES (NULL,'$id','$cname','$cyear','$ccur')";
	}
	$result=mysql_query($sql);
	close();
?>
	<script type="text/javascript">$(function(){$(window).load(function () {$('#cont1').load('user_ajax/myhr/myhr_cond.php');});});</script>
<?php
}
//end add/change conditions

//add/change procedures
if (isset($_POST['hiddenid'])){
	open();
	$idd=intval($_POST['hiddenid']);
	$a=mysql_real_escape_string($_POST['edit_proc_name']);
	$b=intval($_POST['edit_proc_year']);
	$c=mysql_real_escape_string($_POST['edit_proc_desc']);

	$sql="UPDATE us_procedure set name='$a' where id='$idd'";
	$sql2="UPDATE us_procedure set year='$b' where id='$idd'";
	$sql3="UPDATE us_procedure set comments='$c' where id='$idd'";

	$result=mysql_query($sql);
	$result2=mysql_query($sql2);
	$result3=mysql_query($sql3);
	if($_FILES['edit_proc_file']){
		$procimages=$_SERVER['DOCUMENT_ROOT']."/aeglea/users/procedures";
		foreach($_FILES['edit_proc_file']['error'] as $file=>$err){
			if($err== UPLOAD_ERR_OK){
				$tmp=$_FILES['edit_proc_file']['tmp_name'][$file];
				$name=$_FILES['edit_proc_file']['name'][$file];
				$name_prepend=0;
				$destination_file_name=$name_prepend."_".$name;
				while (file_exists("$procimages/$destination_file_name")) {
					$name_prepend+=rand();
					$destination_file_name=$name_prepend."_".$filename;
				}
				$filename=$destination_file_name;
				move_uploaded_file($tmp, "$procimages/$filename");
				$q="INSERT INTO file_proc VALUES ('','$id','$idd','$filename')";
				$result2=mysql_query($q);
			}
		}
	}
	
	if($_POST['delimg']){
		foreach($_POST['delimg'] as $f){
			$sq1="SELECT * FROM file_proc WHERE id='$f'";
			$sq="DELETE FROM file_proc WHERE id='$f'";
			$file=mysql_fetch_array(mysql_query($sq1));
			$res=mysql_query($sq);
			unlink($_SERVER['DOCUMENT_ROOT'].'/aeglea/users/procedures/'.$file['fname']);
		}
	}
	close();
	if($_POST['de']==1){
		$sql4="DELETE from us_procedure where id='$idd'";
		$pe="DELETE FROM doc_perm WHERE fileid='$idd' AND type='procedure'";
		$fs="SELECT * FROM file_proc WHERE prid='$idd'";
		$ds="DELETE FROM file_proc WHERE prid='$idd' AND id='$id'";
		open();
		$asd=mysql_query($sql4);
		$qw=mysql_query($pe);
		$del_file_proc=mysql_query($ds);
		$del_files=mysql_query($fs);
		while($file=mysql_fetch_array($del_files)){
			unlink($_SERVER['DOCUMENT_ROOT'].'/aeglea/users/procedures/'.$file['fname']);
		}
		close();	
	}
?>
	<script type="text/javascript">$(function(){$(window).load(function () {$('#cont1').load('user_ajax/myhr/myhr_procs.php');});});</script>
<?php
}
if (isset($_POST['hiddenid2'])){
	open();
	$pname=mysql_real_escape_string($_POST['add_proc_name']);
	$pyear=intval($_POST['add_proc_year']);
	$pcom=mysql_real_escape_string($_POST['add_proc_desc']);
	if($pname!=""&&$pname!=null){
		$sql="insert into us_procedure values (NULL,'$id','$pname','$pyear','$pcom')";
	}
	$result=mysql_query($sql);
	//start files	
	$fid=mysql_insert_id();
	$procimages=$_SERVER['DOCUMENT_ROOT']."/aeglea/users/procedures";
	foreach($_FILES['add_proc_file']['error'] as $file=>$err){
		if($err== UPLOAD_ERR_OK){
			$tmp=$_FILES['add_proc_file']['tmp_name'][$file];
			$name=$_FILES['add_proc_file']['name'][$file];
			$name_prepend=0;
			$destination_file_name=$name_prepend."_".$name;
			while (file_exists("$procimages/$destination_file_name")) {
				$name_prepend+=rand();
				$destination_file_name=$name_prepend."_".$filename;
			}
			$filename=$destination_file_name;
			move_uploaded_file($tmp, "$procimages/$filename");
			$q="INSERT INTO file_proc VALUES ('','$id','$fid','$filename')";
			$result2=mysql_query($q);
		}
	}
	close();
?>
	<script type="text/javascript">$(function(){$(window).load(function () {$('#cont1').load('user_ajax/myhr/myhr_procs.php');});});</script>
<?php
}
//end add/change procedures

//start posting settings
	$oldfile=$user['prof'];
	$first=$user['name'];
	$last=$user['last'];
	$email=$user['email'];
	$gender=$user['gender'];
	$day=$user['day'];
	$month=$user['month'];
	$year=$user['year'];
	$btype=$user['btype'];
	$ins=$user['insurance'];
if (isset($_POST['hidden']) && $err==0){
	open();
		$t_btype=mysql_real_escape_string(trim($_POST['btype']));
		$t_first=mysql_real_escape_string(trim($_POST['name']));
		$t_last=mysql_real_escape_string(trim($_POST['last']));
		$t_email=mysql_real_escape_string(trim($_POST['email']));
		$password=mysql_real_escape_string(trim($_POST['password']));
		$password2=mysql_real_escape_string(trim($_POST['password2']));
		$t_gender=mysql_real_escape_string(trim($_POST['gender']));
		$t_day=mysql_real_escape_string(trim($_POST['day']));
		$t_month=mysql_real_escape_string(trim($_POST['month']));
		$t_year=mysql_real_escape_string(trim($_POST['year']));
		$t_ins=mysql_real_escape_string(trim($_POST['insure']));
		$filename=$_FILES['pic']['name'];
		$tmpfilename=$_FILES['pic']['tmp_name'];
	close();
	$change=0;
		if ((!($first==$t_first))&&$t_first!=""){
			$change=1;
			$sql="update user set name='$t_first' where id='$id'";
			open();
			@ $result = mysql_query($sql);
			close();
			if(!$result) echo "<p>Error during Name Change</p>";
		}
		if ((!($last==$t_last))&&$t_last!=""){
			$change=1;
			$sql="update user set last='$t_last' where id='$id'";
			open();
			@ $result = mysql_query($sql);
			close();
				if(!$result) echo "<p>Error during last name Change</p>";
		}
		if (!($email==$t_email)){
			$change=1;
			if(validEmail($t_email)){
				if(emailTaken($t_email)||emailTaken2($t_email)){
				echo "<p>Email already exists</p>";
				}else{
					$sql="update user set email='$t_email' where id='$id'";
					open();
					@ $result = mysql_query($sql);
					close();
					if(!$result){
					echo "<p>Error during email Change</p>";
					}
					}
			}else{ 
		echo "<p>Invalid email</p>";
		}
		}
		
		if (!empty($password) || !empty($password)){
			$change=1;
			if (!empty($password) && !empty($password)){
				$password=md5(sha1($password));
				$password2=md5(sha1($password2));
				if ($password==$password2){
					$sql="update user set password='$password' where id='$id'";
					open();
					@ $result = mysql_query($sql);
					close();		
					if(!$result) echo "<p>Error during email Change</p>";
				}
				else echo"<script>alert(\"Passwords do not match\");</script>";
			}
			else echo"<script>alert(\"Please fill both password fields\");</script>";
		}
			if (!($ins==$t_ins)){
			$change=1;
			$sql="update user set insurance='$t_ins' where id='$id'";
			open();
			@ $result = mysql_query($sql);
			close();
			if(!$result) echo "<p>Error during Name Change</p>";
		}
		if (!(empty($filename))){
			$change=1;
			$err1=0; $err2=0; $err3=0;
			if(isset($filename) & is_uploaded_file($tmfilename)) $err1=1;
			if (!preg_match('/\.(jpg|jpeg|png|bmp)$/i', $filename)) $err2=1;
				
			if ($err1==0 && $err2==0 && $err3==0){
				$userimages=$_SERVER['DOCUMENT_ROOT']."/aeglea/profile";
				$name_prepend=0;
				$destination_file_name=$name_prepend."_".$filename;
				while (file_exists("$userimages/$destination_file_name")) {
					$name_prepend+=rand();
					$destination_file_name=$name_prepend."_".$filename;
				}
				$filename=$destination_file_name;
				createthumb("$filename","$tmpfilename","$userimages/$filename",155,155);
				unlink($tmpfilename);
				$sql="UPDATE user SET prof='$filename' WHERE id='$id'";
				open();
				@ $result = mysql_query($sql);
				close();
				if($oldfile!="default.jpg"){
				unlink($_SERVER['DOCUMENT_ROOT'].'/aeglea/profile/'.$oldfile);}
				if(!$result) echo "<p>Error uploading profile picture</p>";
			}
			if ($err1==1) { echo"<script>alert(\"Error Uploading images\");</script>";}
			if ($err2==1){ echo"<script>alert(\"Upload only png,bmp or jpg\");</script>";}
			echo"<script type=\"text/javascript\">window.onload=home();</script>";
		}
		if (!($gender==$t_gender)){
			$change=1;
			$sql="update user set gender='$t_gender' where id='$id'";
			open();
			@ $result = mysql_query($sql);
			close();
			if(!$result) echo "<p>Error in changing gender</p>";
		}
		if (!($btype==$t_btype)){
			$change=1;
			$sql="update user set btype='$t_btype' where id='$id'";
			open();
			@ $result = mysql_query($sql);
			close();
			if(!$result) echo "<p>Error in changing Blood Type</p>";
		}
		if (!($day==$t_day) || !($month==$t_month) || !($year==$t_year)){
			$change=1;		
			$sql="update user set day='$t_day', month='$t_month', year='$t_year' where id='$id'";
			open();
			@ $result = mysql_query($sql);
			close();
			if(!$result) echo "<p>Error in changing birthdate</p>";
		}
	}
//end posting settings

//start posting permissions
if(isset($_POST["secret_perm"])){
	
	if($_POST['s_doc']==""){
		?><script type="text/javascript">alert("You have to select a physician");$('#cont1').load('user_ajax/permissions/give_perm.php');</script><?php
	}
	else{
		$did=$_POST['s_doc'];
		$procs=$_POST['sh_proc'];
		$tests=$_POST['sh_tes'];
		$meds=$_POST['sh_med'];
		$vacs=$_POST['sh_vac'];
		$conds=$_POST['sh_cond'];
		$alls=$_POST['sh_all'];
	open();	
		foreach($procs as $proc){
			$q="INSERT INTO doc_perm values ('$id','$did','procedure','$proc')";
			$result=mysql_query($q);
		}
		foreach($tests as $test){
			$q="INSERT INTO doc_perm values ('$id','$did','test','$test')";
			$result=mysql_query($q);
		}
		foreach($meds as $med){
			$q="INSERT INTO doc_perm values ('$id','$did','medication','$med')";
			$result=mysql_query($q);
		}
		foreach($vacs as $vac){
			$q="INSERT INTO doc_perm values ('$id','$did','vaccine','$vac')";
			$result=mysql_query($q);
		}
		foreach($conds as $cond){
			$q="INSERT INTO doc_perm values ('$id','$did','condition','$cond')";
			$result=mysql_query($q);
		}
		foreach($alls as $all){
			$q="INSERT INTO doc_perm values ('$id','$did','allergy','$all')";
			$result=mysql_query($q);
		}
	close();
	}
}
//end posting permissions

//start posting relations
if(isset($_POST['hidden2'])){
	$id=$_SESSION['uid'];
	open();
	$othername=mysql_real_escape_string(trim($_POST['othername']));
	$otherid=mysql_real_escape_string(trim($_POST['otherid']));
	$relation=mysql_real_escape_string(trim($_POST['relation']));
	close();
	$accept=intval($_POST['confirm']);
	$sql="SELECT * FROM user WHERE id=$otherid";
	open();
	$result=mysql_query($sql);
	$result=mysql_fetch_array($result);
	close();
		if($result['username']==$othername&&$accept==1&&($othername!=null||$otherid!=null)){
			$sql="insert into relation values ('$id','$otherid','$relation','0')";
			$sql2="insert into relation values ('$otherid','$id','$relation','0')";
			$perm="INSERT INTO `eagle`.`permission` (`id`, `uid`, `pid`) VALUES ('','$id','$otherid')";
			$perm2="INSERT INTO `eagle`.`permission` (`id`, `uid`, `pid`) VALUES ('','$otherid','$id')";
			open();
			$r1=mysql_query($sql);
			$r1_2=mysql_query($sql2);
			$r2=mysql_query($perm);
			$r2_2=mysql_query($perm2);
			close();
		}
?>
	<script type="text/javascript">$(function(){$(window).load(function () {$('#cont1').load('user_ajax/permissions/rel1.php');});});</script>
<?php
}
//end posting relations

//start posting weight-height
if(isset($_POST['weight'])){
	open();
	$w=mysql_real_escape_string($_POST['weight']);
	$sql="update user set weight='$w' where id='$user[id]'";
	$result=mysql_query($sql);
	close();
	}
if(isset($_POST['height'])){
	open();
	$w=mysql_real_escape_string($_POST['height']);
	$sql="update user set height='$w' where id='$user[id]'";
	$result=mysql_query($sql);
	close();
}
//end posting weight-height
?>	
<div id="loading">
		<img id="loading-image" src="images/ajax_loader.gif" alt="Loading..." />
</div>
<table align="center"><td>
	<div id="left">
	
<?php 
$pic=$user['prof'];
echo <<<a
		<div id="pic"><img src="profile/$pic" style="cursor:auto;border:2px solid #0d2342;"/></div>
		<div id="info"> 
		<table align="left" cellpadding="3">
			<tr align="left"><label style="font-size:120%;cursor: text;">$user[name]  $user[last]</tr>
			<tr>
				<td align="left"><label style="color:#202020;"><u>Username</u>:  </label><label style="font-style:italic;">$user[username]</label></td>
			</tr><br/>
			<tr align="left">
				<td><label style="color:#202020;"><u>ID</u>: </label><label style="font-style:italic;">$user[id]</label></td>
			</tr>
a;
		 if($user['gender']){
			echo "<tr align=\"left\"><td>".$user['gender']."</td></tr>";
		}
		 if($user['year']){
			echo "<tr align=\"left\"><td>"." <label style=\"color:#202020;\"><u>Age</u>:</label>".findAge($user)."</td></tr>";
		}
		 if($user['email']){
			echo"<tr><td><br/><font size=\"2\" style=\"float:left;\">".$user['email']."</font></td></tr>";
		}
?>
		  <p>&nbsp;</p>
		  </table>
		</div>
		<div id="info2">
		<?php 
if($_GET['uid']==$user['id']){
		$sql="select * from relation where uid='$user[id]'";
		$sql2="select * from relation where rid='$user[id]'";
		open();
		$result=mysql_query($sql);
		$result2=mysql_query($sql2);
		close();
		$i=mysql_numrows($result); $j=mysql_numrows($result2);
		
		if(($result && $i>0)||($result2 && $j>0)){
			echo "<table align=\"center\">";
			if($i>0&&$j>0){
				while(($relation=mysql_fetch_array($result))&&($relation2=mysql_fetch_array($result2))){
					open();
					$a=mysql_fetch_array(mysql_query("SELECT name from user where id='$relation[rid]'"));
					$b=mysql_fetch_array(mysql_query("SELECT last from user where id='$relation[rid]'"));
					$c=mysql_fetch_array(mysql_query("SELECT name from user where id='$relation2[uid]'"));
					$d=mysql_fetch_array(mysql_query("SELECT last from user where id='$relation2[uid]'"));
					$t1=mysql_query("SELECT id from user where id='$relation[rid]'");
					$t2=mysql_query("SELECT id from user where id='$relation2[uid]'");
					close();
echo <<<b
				<tr>
					<td><font size="em" style="float:left;"><b>$relation[kind]:</b> $a[0]  $b[0]</font><font size="0.1em"color="blue" style="cursor: pointer;float:left;margin-top:5px;margin-left:5px;"><u ><a href="user.php?uid=$_SESSION[uid]&delrel=$relation[rid]">delete</a></u></font></td>
				</tr><br/>
b;
				if(!$t1===$t2){
echo <<<b
				<tr>
					<td><font size="em" style="float:left;"><b>$relation[kind]:</b> $c[0]  $d[0]</font><font size="0.1em"color="blue" style="cursor: pointer;float:left;margin-top:5px;margin-left:5px;"><u ><a href="user.php?uid=$_SESSION[uid]&delrel2=$relation2[uid]&&delrel3=$relation2[rid]">delete</a></u></font></td>
				</tr><br/>
b;
				}
				}
			}elseif($j==0){
				while(($relation=mysql_fetch_array($result))){
					open();
					$a=mysql_fetch_array(mysql_query("SELECT name from user where id='$relation[rid]'"));
					$b=mysql_fetch_array(mysql_query("SELECT last from user where id='$relation[rid]'"));
				close();
echo <<<c
				<tr>
					<td><font size="em" style="float:left;"><b>$relation[kind]:</b> $a[0]  $b[0]</font><font size="0.1em" color="blue" style="cursor: pointer;float:left;margin-top:5px;margin-left:5px;"><u ><a href="user.php?uid=$_SESSION[uid]&delrel=$relation[rid]">delete</a></u></font></td></tr><br/>
c;
				}
			}elseif($i==0){
				while(($relation2=mysql_fetch_array($result2))){
					open();
					$c=mysql_fetch_array(mysql_query("SELECT name from user where id='$relation2[uid]'"));
					$d=mysql_fetch_array(mysql_query("SELECT last from user where id='$relation2[uid]'"));
					close();
echo <<<d
				<tr>
					<td>
						<font size="em" style="float:left;"><b>$relation2[kind]:</b> $c[0]  $d[0]</font>
						<font size="0.1em"color="blue" style="cursor: pointer;float:left;margin-top:5px;margin-left:5px;">
							<u><a href="user.php?uid=$_SESSION[uid]&delrel2=$relation2[uid]&&delrel3=$relation2[rid]">delete</a></u>
						</font></td>
				</tr><br/>
d;
				}
		}
		echo "</table>";
	}
}
?>
		</div>
		<div id="l_content">content(adverts etc)</div>
	</div>
</td><td>
<?php
echo <<< A
	<div id="center_div">
		<div id="au">
		<div id="preview"></div>
		</div>
		<div id="navigation">
			<table class="nav">
				<tr class="nav">
				<th class="Home" ><div id="home"><a><button>Home</button></a></div></th>
				<th class="Myhr"><div id="myhr"><a><button>My Health Records</button></a></div></th>
				<th class="hstaff"><div id="hstaff"><a><button>My Health Specialists</button></a></div></th>
				<th class="perms"><div id="perms"><a><button>Permissions</button></a></div></th>
				<th class="settings"><div id="sets"><a><button>Settings</button></a></div></th>
				</tr>
			</table>
		</div>
		<div id="center_cont">
			<div id="cont1"></div>
			<div id="cont2"></div>
			<div id="cont3"></div>
			<div id="cont4"></div>
			<div id="cont5"></div>
		</div>
	</div>
</td></table>
A;
}
elseif($_SESSION['uid']!=$_GET['uid']){
echo<<<e
	<b color="red">Illegal Access, Sending Report</b>
	<meta http-equiv="refresh" content="2; URL=signin.php?logout">
e;
}
require 'footer.php';?>
