<?php
require "core/database/connect.php";
$id = trim($_POST['id']);
echo "sss".$id;

if (trim($_POST['active']) == 0) {
	$active = 1;
}elseif (trim($_POST['active']) == 1) {
	$active = 0;
}

$insert = $db->query("UPDATE `users` SET `active` = $active WHERE `user_id`= $id");
			if ($insert) {
				header('Location: index.php?users');
				die();
			}
?>