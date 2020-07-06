<?php

include 'core/init.php';
logged_in_redirect();

if (empty($_POST) === false) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username) === true || empty($password) === true) {
		$errors[] = 'Please Fill In Both Fields.';
	} elseif (user_exists($username) == false) {
		$errors[] = 'Username DOES NOT Exist Have you registered?';
	} elseif (user_active($username) == false) {
		$errors[] = 'Your Account Is <strong>InActive</strong> Contact Site Admin For Info.';
	} elseif (login($username, $password) == false) {
		$errors[] = 'Username Password Combination Is Wrong';
	} else {
		$_SESSION['user_id'] = login($username, $password);
        if (header('Location:index.php')) {
        	exit();
        }else{
        	echo '<script type="text/javascript">';
	        echo 'window.location.href="index.php";';
	        echo '</script>';
	        echo '<noscript>';
	        echo '<meta http-equiv="refresh" content="0;url=index.php" />';
	        echo '</noscript>'; 
	        exit;	
        }
	}
} else {
	$errors[] = 'No Data Received';
}
include 'includes/layout/header.php';
include 'includes/layout/clientnavmenu.php';

if (empty($errors)=== false) {
	echo "<h2 align='center'>Failed login...</h2>";
	echo "<div class=\"alert alert-danger\" role=\"alert\">".output_errors($errors)."</div>";
}

?>

<?php
include 'includes/layout/footer.php';
?>