<?php

if ($user_data['prev'] == 1) {
	include 'includes/layout/adminnavmenu.php';
	include 'includes/addons/adminrouter.php';

} else {
	include 'includes/layout/usernavmenu.php';
	include 'includes/addons/userrouter.php';
}
?>