<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$DatabaseName = 'storecatalogsystem';
#*********Creating A Connection To Server*********#
$DBconnection = mysqli_connect($servername, $username, $password);
#****Checks If Connection To Server Succeeded*****#
if (!$DBconnection) {
	die("Connection Failed: " . mysqli_connect_error());
}
#=================================================#
#********Creating Database************************#
$sql = "CREATE DATABASE `$DatabaseName`";
if (mysqli_query($DBconnection, $sql)) {
	echo "Database $DatabaseName Created Successfully";
} else {
	echo "Error Creating $DatabaseName Database: " . mysqli_error($DBconnection);
}
#=================================================#
#***Creating A Connection To Server And Database**#
$DBconnection = new mysqli($servername, $username, $password, $DatabaseName);
#**Checks If Connection To Server & Database Succeeded**#
if ($DBconnection->connect_error) {
	die("<br/>Connection Failed: ". $DBconnection->connect_error);
}
#================================================#
#************Creating Users TABLE****************#
	$sql = "CREATE TABLE `$DatabaseName`.`users` (
				 `user_id` int(11) NOT NULL AUTO_INCREMENT,
				  PRIMARY KEY (`user_id`),
				 `username` varchar(32) NOT NULL,
				 `password` varchar(40) NOT NULL,
				 `first_name` varchar(32) NOT NULL,
				 `last_name` varchar(32) NOT NULL,
				 `email` varchar(1024) NOT NULL,
				 `prev` int(1) NOT NULL DEFAULT '0',
				 `active` int(1) NOT NULL DEFAULT '1',
				 `password_recover` int(11) NOT NULL DEFAULT '0',
				 `profile` varchar(100) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	
	if ($DBconnection->query($sql) === TRUE) {
		echo "<br/>Users Table Created Successfully";
#*********Inserts Data Into Users Table********#
		$sql = "INSERT INTO `$DatabaseName`.`users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `email`, `prev`, `active`, `password_recover`, `profile`) 
				VALUES (NULL, 'Admin', SHA1(md5(SHA1('password'))), 'Admin', 'Admin', 'iuihg@uu.com', '1', '1', '0', '');";
		if ($DBconnection->query($sql) === TRUE) {
			echo "<br/>Insertion Of User Data Was Successfull.";
		} else {
			echo "<br/>Error Occured During Insertion Of Data: ". $DBconnection->error;
		}
	} else {
		echo "<br/>Error Occured During table Creation: ". $DBconnection->error;
	}
#===============================================#
#************Creating Users store****************#
	$sql = "CREATE TABLE `$DatabaseName`.`store` 
( `store_id` INT NOT NULL AUTO_INCREMENT , 
`storeName` VARCHAR(500) NOT NULL , 
`address` TEXT NOT NULL , 
`logo` VARCHAR(100) NOT NULL , 
`contact` VARCHAR(30) NOT NULL , 
`email` VARCHAR(1024) NOT NULL , 
`user_id` INT NOT NULL , 
PRIMARY KEY (`store_id`), 
UNIQUE `storeName` (`storeName`)) ENGINE = InnoDB";
	
	if ($DBconnection->query($sql) === TRUE) {
		echo "<br/>store Table Created Successfully";
	} else {
		echo "<br/>Error Occured During table Creation: ". $DBconnection->error;
	}
#===============================================#
#************Creating Users store****************#
	$sql = "CREATE TABLE `$DatabaseName`.`product`
( `prod_id` INT NOT NULL AUTO_INCREMENT ,  
`prodName` VARCHAR(100) NOT NULL ,
 `image` VARCHAR(100) NOT NULL ,
 `price`   INT NOT NULL , 
 `user_id` INT NOT NULL ,
 PRIMARY KEY  (`prod_id`),
KEY `user_id` (`user_id`)
) ENGINE = InnoDB";
	
	if ($DBconnection->query($sql) === TRUE) {
		echo "<br/>Product Table Created Successfully";
	} else {
		echo "<br/>Error Occured During table Creation: ". $DBconnection->error;
	}
#===============================================#
#************Creating Users Price History*******#
	$sql = "CREATE TABLE `$DatabaseName`.`pricehist` 
( `prod_id` INT NOT NULL ,  
`date` DATE NOT NULL ,
  `user_id` INT NOT NULL ,  
  `oldPrice` INT NOT NULL ,   
   PRIMARY KEY  (`prod_id`, `date`, `user_id`)) ENGINE = InnoDB";
	
	if ($DBconnection->query($sql) === TRUE) {
		echo "<br/>Price History Table Created Successfully";
	} else {
		echo "<br/>Error Occured During table Creation: ". $DBconnection->error;
	}
#===============================================#
#******************#
?>