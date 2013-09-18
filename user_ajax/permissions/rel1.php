<?php
require('../../site_functions.php');
require '../../js/jfuctions_user.php';
$user=findUser(intval($_SESSION['uid']));

$sql="select * from relation where uid='$user[id]'";
$sql2="select * from relation where rid='$user[id]'";
open();
$result=mysql_query($sql);
$result2=mysql_query($sql2);
close();
$i=mysql_numrows($result);
 $j=mysql_numrows($result2);
echo "<u><b><h2 style=\"font-family:verdana;color:#00205e;\">Manage Personal Relations</h2></b></u></label>";
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
			echo "
			<tr>
				<td><font size=\"em\" style=\"float:left;\">"."<b>".$relation['kind'].":</b> ".$a[0]."  ".$b[0]."</font><font size=\"0.1em\"color=\"blue\" style=\"cursor: pointer;float:left;margin-top:5px;margin-left:5px;\"><u><a href=\"user.php?uid=$_SESSION[uid]&delrel=$relation[rid]\">delete</a></u></font></td>
			</tr><br/>";
			if(!$t1===$t2){
				echo "
				<tr>
					<td><font size=\"em\" style=\"float:left;\">"."<b>".$relation['kind'].":</b> ".$c[0]."  ".$d[0]."</font><font size=\"0.1em\"color=\"blue\" style=\"cursor: pointer;float:left;margin-top:5px;margin-left:5px;\"><u ><a href=\"user.php?uid=$_SESSION[uid]&delrel2=$relation2[uid]&&delrel3=$relation2[rid]\">delete</a></u></font></td>
				</tr><br/>";
			}
		}
	}elseif($j==0){
		while(($relation=mysql_fetch_array($result))){
		open();
		$a=mysql_fetch_array(mysql_query("SELECT name from user where id='$relation[rid]'"));
		$b=mysql_fetch_array(mysql_query("SELECT last from user where id='$relation[rid]'"));
		close();
		echo "<tr><td><font size=\"em\" style=\"float:left;\">"."<b>".$relation['kind'].":</b> ".$a[0]."  ".$b[0]."</font><font size=\"0.1em\"color=\"blue\" style=\"cursor: pointer;float:left;margin-top:5px;margin-left:5px;\"><u ><a href=\"user.php?uid=$_SESSION[uid]&delrel=$relation[rid]\">delete</a></u></font></td></tr><br/>";
		}
	}elseif($i==0){
		while(($relation2=mysql_fetch_array($result2))){
		open();
		$c=mysql_fetch_array(mysql_query("SELECT name from user where id='$relation2[uid]'"));
		$d=mysql_fetch_array(mysql_query("SELECT last from user where id='$relation2[uid]'"));
		close();
		echo "<tr><td><font size=\"em\" style=\"float:left;\">"."<b>".$relation2['kind'].":</b> ".$c[0]."  ".$d[0]."</font><font size=\"0.1em\"color=\"blue\" style=\"cursor: pointer;float:left;margin-top:5px;margin-left:5px;\"><u ><a href=\"user.php?uid=$_SESSION[uid]&delrel2=$relation2[uid]&&delrel3=$relation2[rid]\">delete</a></u></font></td></tr><br/>";
		}
	}
}else{
	echo "<label style=\"color:#00205e;\">You have not added any related members</label>";
}
echo "</table>";
?>
<br/><br/><button onclick="$('#cont1').load('user_ajax/permissions/rel2.php');">Add Relations</button>
