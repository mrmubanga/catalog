<?php

include 'core/init.php';
logged_in_redirect();
include 'includes/layout/header.php';
include 'includes/layout/clientnavmenu.php';

?>
<section>
<div align="center">
<h1>Recover Log In Details</h1>
<br/>
<br/>
<?php
if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
?>
<div class="alert alert-success" role="alert"><p><i class="glyphicon glyphicon-ok-sign"></i>  Thanks, we've emailed you the information.</p></div>
<?php
}else{
	$mode_allowed = array('username', 'password');
	if (isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed)=== true) {
		if (isset($_POST['email']) === true && empty($_POST['email'])=== false){
			if (email_exists($_POST['email']) === true) {
				recover($_GET['mode'], $_POST['email']);
                               if (header('Location:recover.php?success')) {
			        exit();
			        }else{
			        	echo '<script type="text/javascript">';
				        echo 'window.location.href="recover.php?success";';
				        echo '</script>';
				        echo '<noscript>';
				        echo '<meta http-equiv="refresh" content="0;url=recover.php?success" />';
				        echo '</noscript>'; 
				        exit;	
			        }
			}else{
				echo '<div class="alert alert-danger" role="alert"><p class=\'error\' ><i class="glyphicon glyphicon-alert"></i>  Oops, we couldn\'t find that email address !!</p></div>';
			}
		}
	?>

		<form class="navbar-form" action="" method="POST">
			<div class="form-group">
		      <div class="input-group">
		        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-envelope"></i> *</span>
		        <input type="email" class="form-control" name="email" placeholder="Email Address" ariadescribedby="basic-addon1" autofocus="autofocus">
		        <br/>
		      </div>
		    </div>
		    <br/>
		    <br/>
		    <div class="form-group">
		      <input type="submit" class="btn btn-primary" value="Recover">
		    </div>
		</form>
	<?php
	} else {
?>
<p>
	Recover your <strong><a href="recover.php?mode=username">username</a> OR <a href="recover.php?mode=password">password</a></strong>?
</p>
<?php
	}
}
?>
</div>
<?php include 'includes/layout/footer.php';?>