<?php  
require 'db.php';

if(isset($_POST['session_id'])){
	$sessid=clear($_POST['session_id']);
	$uid=intval($_POST['uid']);
	
	$db=open();
	$check = $db->prepare('SELECT * FROM us_session WHERE uid=? and hex=?');
	$check->setFetchMode(PDO::FETCH_ASSOC);  //associative array
	$check->execute(array($uid,$sessid));
	$count=count($check->fetchAll(PDO::FETCH_ASSOC));

	if($count==1){	
		if(isset($_POST['uid'])){
			$uid=$_POST['uid'];
			
			$q1=$db->prepare('SELECT * FROM us_allergy WHERE uid=?');
			$q1->setFetchMode(PDO::FETCH_ASSOC);  //associative array
			$q1->execute(array($uid));
			
			$q2=$db->prepare('SELECT * FROM us_condition WHERE uid=?');
			$q2->setFetchMode(PDO::FETCH_ASSOC);  //associative array
			$q2->execute(array($uid));

			$q3=$db->prepare('SELECT * FROM us_medication WHERE uid=?');
			$q3->setFetchMode(PDO::FETCH_ASSOC);  //associative array
			$q3->execute(array($uid));

			$q4=$db->prepare('SELECT * FROM us_procedure WHERE uid=?');
			$q4->setFetchMode(PDO::FETCH_ASSOC);  //associative array
			$q4->execute(array($uid));

			$q5=$db->prepare('SELECT * FROM us_test WHERE uid=?');
			$q5->setFetchMode(PDO::FETCH_ASSOC);  //associative array
			$q5->execute(array($uid));

			$q6=$db->prepare('SELECT * FROM us_vaccine WHERE uid=?');
			$q6->setFetchMode(PDO::FETCH_ASSOC);  //associative array
			$q6->execute(array($uid));
			
			//save returning data
			$record=array();
			
			$i=0;
			while($all=$q1->fetch(PDO::FETCH_ASSOC)){
				$record["allergy"][$i]=$all;
				$i++;
			}
			$i=0;
			while($cond=$q2->fetch(PDO::FETCH_ASSOC)){
				$record["condition"][$i]=$cond;
				$i++;
			}
			$i=0;
			while($med=$q3->fetch(PDO::FETCH_ASSOC)){
				$record["medication"][$i]=$med;
				$i++;
			}
			$i=0;
			while($proc=$q4->fetch(PDO::FETCH_ASSOC)){
				$record["procedure"][$i]=$proc;
				$i++;
			}
			$i=0;
			while($test=$q5->fetch(PDO::FETCH_ASSOC)){
				$record["test"][$i]=$test;
				$i++;
			}
			$i=0;
			while($vac=$q6->fetch(PDO::FETCH_ASSOC)){
				$record["vaccine"][$i]=$vac;
				$i++;
			}
			$record["success"]=1;
			echo json_encode($record);
		 }
	}
	$db=null;
 }
?>
