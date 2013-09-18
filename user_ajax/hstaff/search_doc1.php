<?php
	$db = new mysqli('localhost', 'root' ,'', 'eagle');
	if(!$db) {
		echo 'ERROR: Could not connect to the database.';
	} else {
		// Is there a posted query string?
		if($_GET['q']) {
			$queryString = $db->real_escape_string($_GET['q']);
			if(strlen($queryString) >0) {
				$query = $db->query("SELECT last FROM doc WHERE last LIKE '$queryString%'");
				if($query) {
					// While there are results loop through them - fetching an Object (i like PHP5 btw!).
					while ($result = $query ->fetch_object()) {
	         			echo "$result->last\n";	
	         		}
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
			} else {
				// Dont do anything.
			} // There is a queryString.
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>
