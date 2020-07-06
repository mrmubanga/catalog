<?php
require "core/database/connect.php";
$id = trim($_POST['id']);

$del = $db->query("DELETE FROM `users` WHERE `user_id`= $id");
			if ($del) {
				header('Location: index.php?users');
				die();
			}
?>