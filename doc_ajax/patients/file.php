<?php
require '../../site_functions.php';

if($_GET['fid2']&&isset($_SESSION['did'])){
//need check to see if he is a doctor with rights
	$fid=intval($_GET['fid2']);$type=$_GET['type2'];
	$q="SELECT * FROM us_".$type." WHERE id='$fid'";
	open();
	$file=mysql_query($q);
	$file=mysql_fetch_array($file);
	close();
	echo <<<a
	<a style="float:left;color:blue;cursor:pointer;" onclick="$('#cont1').load('doc_ajax/patients/user_perm.php?uid9=$file[uid]')"><--Back</a>
a;
	if($type=="medication"){
		$med=$file;
		echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$med['name']."</b>";
		if($med['current']==1){
			$str="<br/><label style=\"font-size:0.8em;color:#a10a00a00;\">Currently Taking</label>";echo $str;
		}
		if($med['uptake']){
			echo "<br/><br/>Dosage Intervals: ".$med['uptake'];
		}
		if($med['started']){
			echo "<br/><br/><label style=\"font-size:0.9em;color:gray;\">Started taking medicine: ".$med['started']."</label>";
		}
	}
	if($type=="procedure"){
		$qq="SELECT * FROM file_proc WHERE prid='$fid'";
		open();
		$files=mysql_query($qq);
		close();
		$proced=$file;
		$year=$proced['year'];		
		if($year==0){
			echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$proced['name']."</b><br/><br/>".$proced['comments']."</p>";
		}else{
				echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$proced['name']."</b><br/><br/><font size=\"em\">Year:"." "."$year</font><br/><br/>".$proced['comments'];
		}
		echo "<br/>";
		open();
		while($file=mysql_fetch_array($files)){
			echo "<a href=\"users/procedures/$file[fname]\" rel=\"lightbox\"><img src=\"users/procedures/$file[fname]\" style=\"height:80px;width:80px;\" /></a>";
		}
		close();
	}
	if($type=="vaccine"){
		$vac=$file;
		$year=$vac['year'];	
		if($year==0){
			echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$vac['name']."</b><br/></p>";
		}else{
			echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$vac['name']."</b><br/><font size=\"em\">Year:"." "."$year</font></p>";
		}
	}
	if($type=="condition"){
		$cond=$file;
		$year=$cond['year'];
		$curr=$cond['current'];
		if($curr==1){
			$str="<br/><label style=\"font-size:0.8em;color:#a10a00a00;\">Current Condition</label>";
		}else{
			$str="<br/><label style=\"font-size:0.8em;color:#a10a00a00;\">Past Condition</label>";
		}
		if($year==0){
			echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$cond['name']."</b><br/>".$str."</p>";
		}else{
			echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$cond['name']."</b><br/>".$str."<br/><font size=\"em\">Year:"." "."$year</font><br/><br/></p>";
		}
	}
	if($type=="allergy"){
		$all=$file;
		echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$all['name']."</b></p>";
	}
	if($type=="test"){
		$qq="SELECT * FROM file_test WHERE tid='$fid'";
		open();
		$files=mysql_query($qq);
		close();
		$tes=$file;
		echo "<br/><p style=\"border-top:solid 1px #aacfe4;\"><b>".$tes['name']."</b><br/><label class=\"formsmall\">$tes[day]/$tes[month]/$tes[year]</label>";
		if($tes['value']!=0){
			echo "<br/><br/>$tes[value]";
			if($tes['unit']){
				echo "<label style=\"font-size:0.8em;\"> ($tes[unit])</label>";
			}
		}
		if($tes['comments']){
			echo "<br/><br/>$tes[comments]";
		}
		echo "</p>";
		echo "<br/>";
		open();
		while($file=mysql_fetch_array($files)){
				echo "<a href=\"users/tests/$file[fname]\" rel=\"lightbox\"><img src=\"users/tests/$file[fname]\" style=\"height:80px;width:80px;\" /></a>";
		}
		close();
	}
}else{
	echo "Illegal Access";
}
?>
