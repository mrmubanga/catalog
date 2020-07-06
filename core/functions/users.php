<?php

#================================================#
#*******Gets The UserID From The User Email*******#
function user_id_from_email ($email){
	include 'connect.php';
	$email = sanitize($email);
	if ($result = $db->query("SELECT * FROM `users` WHERE `email` = '$email'")) {
		if ($count = $result->num_rows) {
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			foreach ($rows as $row) {
				$res = $row['user_id'];
				return $res;
			}
			$result->free();
		}
	};
};
#===========================================#
#*******Recovers user password or username*******#
function recover($mode, $email){
	$mode = sanitize($mode);
	$email = sanitize($email);

	$user_data = user_data(user_id_from_email($email), 'user_id','first_name','username');
	if ($mode == 'username'){
		email($email, 'Your username',"Hello ".$user_data['first_name'].",\n\n-Your username is: ".$user_data['username']."\n\n-Dras Academy");
	}elseif ($mode == 'password'){
		$generated_password = substr(sha1(md5(sha1(rand(999, 999999)))),0,8);
		change_password($user_data['user_id'], $generated_password);

		update_user($user_data['user_id'], array('password_recover'=> '1'));

		email($email, 'Your password recovery',"Hello ".$user_data['first_name'].",\n\n-Your new password is: ".$generated_password."\n\n-Dras Academy");
	}
}
#=========================================#
#*******uploads profile image*******#
function change_profile_image($user_id, $file_temp, $file_extn){
	$file_path = 'uploads/profile/'.substr(sha1(md5(time())), 0, 15).'.'.$file_extn;
	move_uploaded_file($file_temp, $file_path);
	include 'connect.php';
	$db->query("UPDATE `users` SET `profile` = '".mysqli_real_escape_string($db,$file_path)."' WHERE `user_id` = ".(int)$user_id);
}
#=========================================#
#*******Updates User Info In Website*******#
function update_user ($user_id,$update_data) {
	require 'connect.php';
	$update = array();
	array_walk($update_data, 'array_sanitize');
	foreach ($update_data as $fields => $data) {
		$update[] = '`'.$fields.'`=\''.$data.'\'';
	}
	$db->query("UPDATE users SET " .implode(', ', $update) ." WHERE `user_id` = $user_id ");
}
#=========================================#
#*******Counts The Number Of Registered Website Users*******#
function user_count(){
	require 'connect.php';
	if ($result = $db->query("SELECT * FROM `users` WHERE `user_id` != 1")) {
	if ($count = $result->num_rows) {
		echo $count;
		$result->free();
	}
};
}
#===========================================================#
#*******Counts The Number Of Active Website Users*******#
function active_user_count(){
	include 'connect.php';
	if ($result = $db->query("SELECT * FROM `users` WHERE `user_id` != 1 AND `active` = 1")) {
	if ($count = $result->num_rows) {
		echo $count;
		$result->free();
	}
};
}
#======================================================#
#*******Gets User ID To Be Used To Get User Data*******#
function user_data($user_id){
	require 'connect.php';
	$data = array();
	$user_id = (int)$user_id;
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();

	if ($func_num_args > 1) {
		unset($func_get_args[0]);
		$fields = '`'.implode('`,`', $func_get_args).'`';
		if ($result = $db->query("SELECT $fields FROM `users` WHERE `user_id` = $user_id")) {
			$data = $result->fetch_assoc();
			return $data;
			$result->free();
		};
	}
}
#=========================================#
#*******Checks If User Is Logged In*******#
function logged_in(){
	return (isset($_SESSION['user_id'])) ? true : false;
};
#=======================================#
#*******Checks If Username Exists*******#
function user_exists($username){
	require 'connect.php';
	$username = sanitize($username);
	$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
	if ($result = $db->query($sql)) {
	if ($count = $result->num_rows) {
			if ($count == 1) {
				return true;
			}else{
				return false;
			}
			$result->free();
		}
	};
};
#====================================#
#*******Checks If User IS Active*****#
function user_active($username){
	require 'connect.php';
	$username = sanitize($username);
	$sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `active` = 1";
	if ($result = $db->query($sql)) {
	if ($count = $result->num_rows) {
			if ($count == 1) {
				return true;
			}else{
				return false;
			}
			$result->free();
		}
	};
};
#====================================#
#*******Gets The USerID From The Username*****#
function user_id_from_username($username){
	require 'connect.php';
	$username = sanitize($username);
	if ($result = $db->query("SELECT * FROM `users` WHERE `username` = '$username'")) {
		if ($count = $result->num_rows) {
			$rows = $result->fetch_all(MYSQLI_ASSOC);
			foreach ($rows as $row) {
				$res = $row['user_id'];
				return $res;
			}
			$result->free();
		}
	};
};
#====================================#
#*******Logs user Into Website*****#
function login($username, $password){
	require 'connect.php';
	$user_id = user_id_from_username($username);
 	$username = sanitize($username);
 	$password = sha1(md5(sha1($password)));
	if ($result = $db->query("SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'")) {
		if ($count = $result->num_rows) {
			if ($count == 1) {
				return $user_id;
			}else{
				return false;
			}
			$result->free();
		}
	};

};
#====================================#
#*******Checks If Email Exists*******#
function email_exists($email) {
	require 'connect.php';
	$email = sanitize($email);
	if ($result = $db->query("SELECT * FROM `users` WHERE `email` = '$email'")) {
		if ($count = $result->num_rows) {
			if ($count == 1) {
				return true;
			}else{
				return false;
			}
			$result->free();
		}
	};
};
#===========================================#
#*******Registers User Into Website*******#
function register_user ($register_data) {
	require 'connect.php';
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = sha1(md5(sha1($register_data['password'])));
	$fields = '`'.implode('`,`', array_keys($register_data)).'`';
	$data = '\''.implode('\',\'', $register_data).'\'';
	$db->query("INSERT INTO `users` ($fields) VALUES ($data)");
}
#===========================================================#
#*******Changes User Password*******#
function change_password ($user_id, $password){
	require 'connect.php';
	$user_id = (int) $user_id;
	$password = sha1(md5((sha1($password))));
	$db->query("UPDATE `users` SET `password` = '$password', `password_recover` = 0 WHERE `user_id` = $user_id");
}
#=========================================#

?>