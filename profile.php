<?php
include 'core/init.php';
protect_page();
include 'includes/layout/header.php';

if (logged_in() == true) {
include 'includes/addons/loggedin.php';
} else {
include 'includes/layout/clientnavmenu.php';
}

if (isset($_GET['username']) === true && empty($_GET['username']) === false) {
	$username = $_GET['username'];
	if (user_exists($username) === true) {
		$user_id  = user_id_from_username($username);
		$profile_data = user_data($user_id, 'first_name','last_name','email');
?>
	<h2><?php echo $profimg;?>	<?php echo $profile_data['first_name'];?>'s Profile</h2>
	<p><strong>Email: </strong><?php echo $profile_data['email'];?></p>
	<hr/>
<?php

if ($user_data['prev'] == 1) {
	include 'includes/addons/user_count.php';
};
?>


<?php
	}else{
		echo "<div class=\"alert alert-danger\" role=\"alert\">Sorry, that user doesn\'t exist</div>";
	}
}else{
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
?>
<?php
include 'includes/layout/footer.php';?>