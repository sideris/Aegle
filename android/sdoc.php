<?php  
require 'db.php';
$doctor=array();
//if searching with both first name and last
if(isset($_POST['first'])&&isset($_POST['last'])){
	$db=open();
	$i=0;
	$first=clear($_POST['first']);
	$last=clear($_POST['last']);
	$q=$db->prepare('SELECT * from doc where first LIKE ? AND last LIKE ?');
	$q->setFetchMode(PDO::FETCH_ASSOC);  //associative array
	$q->execute(array('%'.$first.'%','%'.$last.'%'));
	
	while($r=$q->fetch(PDO::FETCH_ASSOC)){
			$query=$db->prepare('SELECT * FROM doc WHERE id=?');
			$query->setFetchMode(PDO::FETCH_ASSOC);  //associative array
			$query->execute(array($r['id']));
			
			$p[$i]=$query->fetch(PDO::FETCH_ASSOC);
			$doctor['doctor'][$i]['id']=$p[$i]['id'];
			$doctor['doctor'][$i]['first']=$p[$i]['first'];
			$doctor['doctor'][$i]['last']=$p[$i]['last'];
			$doctor['doctor'][$i]['email']=$p[$i]['email'];
			$doctor['doctor'][$i]['field']=$p[$i]['field'];
			$doctor['doctor'][$i]['place']=$p[$i]['place'];
			$doctor['doctor'][$i]['phone']=$p[$i]['phone'];
			$i++;				
	}
	$doctor['success']=1;
	echo json_encode($doctor);
	$db=null;
//if searching with  first name
}elseif(isset($_POST['first'])){
	$i=0;
	$first=clear($_POST['first']);
	
	$db=open();
	$q=$db->prepare('SELECT * from doc where first LIKE ?');
	$q->setFetchMode(PDO::FETCH_ASSOC);  //associative array
	$q->execute(array('%'.$first.'%'));
	
	while($r=$q->fetch(PDO::FETCH_ASSOC)){
			$query=$db->prepare('SELECT * FROM doc WHERE id=?');
			$query->setFetchMode(PDO::FETCH_ASSOC);  //associative array
			$query->execute(array($r['id']));
			
			$p[$i]=$query->fetch(PDO::FETCH_ASSOC);
			$doctor['doctor'][$i]['id']=$p[$i]['id'];
			$doctor['doctor'][$i]['first']=$p[$i]['first'];
			$doctor['doctor'][$i]['last']=$p[$i]['last'];
			$doctor['doctor'][$i]['email']=$p[$i]['email'];
			$doctor['doctor'][$i]['field']=$p[$i]['field'];
			$doctor['doctor'][$i]['place']=$p[$i]['place'];
			$doctor['doctor'][$i]['phone']=$p[$i]['phone'];
			$i++;				
	}
	$doctor['success']=1;
	echo json_encode($doctor);
	$db=null;
//if searching with  last name
}elseif(isset($_POST['last'])){
	$i=0;
	$last=clear($_POST['last']);
	
	$db=open();
	$q=$db->prepare('SELECT * from doc where last LIKE ?');
	$q->setFetchMode(PDO::FETCH_ASSOC);  //associative array
	$q->execute(array('%'.$last.'%'));

while($r=$q->fetch(PDO::FETCH_ASSOC)){
			$query=$db->prepare('SELECT * FROM doc WHERE id=?');
			$query->setFetchMode(PDO::FETCH_ASSOC);  //associative array
			$query->execute(array($r['id']));
			
			$p[$i]=$query->fetch(PDO::FETCH_ASSOC);
			$doctor['doctor'][$i]['id']=$p[$i]['id'];
			$doctor['doctor'][$i]['first']=$p[$i]['first'];
			$doctor['doctor'][$i]['last']=$p[$i]['last'];
			$doctor['doctor'][$i]['email']=$p[$i]['email'];
			$doctor['doctor'][$i]['field']=$p[$i]['field'];
			$doctor['doctor'][$i]['place']=$p[$i]['place'];
			$doctor['doctor'][$i]['phone']=$p[$i]['phone'];
			$i++;				
	}
	$doctor['success']=1;
	echo json_encode($doctor);
	$db=null;
//if searching with id
}elseif(isset($_POST['did'])){
	$i=0;
	$did=intval($_POST['did']);
	$db=open();
	$q=$db->prepare('SELECT * from doc where id=?');
	$q->setFetchMode(PDO::FETCH_ASSOC);  //associative array
	$q->execute(array($did));
	while($result=$q->fetch(PDO::FETCH_ASSOC)){
		$doctor['doctor'][$i]['first']=$result['first'];
		$doctor['doctor'][$i]['last']=$result['last'];
		$doctor['doctor'][$i]['email']=$result['email'];
		$doctor['doctor'][$i]['id']=$result['id'];
		$doctor['doctor'][$i]['field']=$result['field'];
		$doctor['doctor'][$i]['phone']=$result['phone'];
		$doctor['doctor'][$i]['place']=$result['place'];
		$i++;
	}
	$doctor['success']=1;
	echo json_encode($doctor);
	$db=null;
}
?>
