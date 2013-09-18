<?php
require '../../js/jfuctions_user.php';
echo <<<a
<img onclick="$('#cont1').load('user_ajax/hstaff/hstaff_search.php')" src="images/searchdoc.jpg" style="width:200px;height:200px;"></img>
<button onclick="$('#cont1').load('user_ajax/hstaff/my_hstaff.php')" style="width:200px;height:200px;">Connected Health Specialists</button>
a;
?>
