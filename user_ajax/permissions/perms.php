<?php
echo <<< a
<table align="center">
<tr><td><img src="images/22.jpg" onclick="$('#cont1').load('user_ajax/permissions/rel1.php');"></img></td></tr>
<tr><td><button onclick="$('#cont1').load('user_ajax/permissions/my_perms.php');">Bestowed Permissions(me)</button></td></tr>
<tr><td><button onclick="$('#cont1').load('user_ajax/permissions/others_perms.php');">Bestowed Permissions(others)</button></td></tr></table>
a;
?>