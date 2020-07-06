<?php

#=========================================================#
#*****************Sends Email**************************#
function email($to, $subject, $body){
	mail($to, $subject, $body, 'From:Dras@gmail.com');
}
#=================================================#
#*******Redirects User If Logged In To profile Page*******#
function logged_in_redirect(){
	if (logged_in() === true) {
		header('Location: index.php');
		exit();
	}
}
#=================================================#
#*******Sanitizes SQL Injection In An Array*******#
function array_sanitize(&$item){
	require 'connect.php';
	$item = htmlentities(strip_tags(mysqli_real_escape_string($db,$item)));
}
#==============================================================#
#*******Sanitizes SQL Injection In An Attribute(Variable)*******#
function sanitize($data){
	require 'connect.php';
	return htmlentities(strip_tags(mysqli_real_escape_string($db,$data)));
}
#======================================#
#*******Outputs Errors In A list*******#
function output_errors($errors){
	return '<ul><li><i class="glyphicon glyphicon-alert"></i>  '.implode('</li><li><i class="glyphicon glyphicon-alert"></i>   ', $errors).'</li></ul>';
}
#======================================#
#*******Protects Pages That Are Only To Be Used By Logged In Users*******#
function protect_page(){
	if (logged_in()=== false) {
		header('Location: protect.php');
		exit();
	}
}
#========================================================================#
#*******Protects Pages That Are Only To Be Used By Admin Users*******#
function admin_protect(){
	global $user_data;
	if (($user_data['prev']== 1)=== false) {
		header('Location: protect.php');
		exit();
	}
}
#=================================================#
#*******Gets Rid Of Html Code In Input*******#
function escape($string){
	return htmlentities(strip_tags(trim($string)), ENT_QUOTES, 'UTF-8');
}
#======================================#


?>