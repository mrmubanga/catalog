<?php
$db = new mysqli ('localhost', 'root', '', 'storecatalogsystem');
if ($db->connect_errno) {
	#die('Sorry connection Error !!!');
	include'setup.php';
}
?>