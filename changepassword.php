<?php
include 'core/init.php';
protect_page();

if (empty($_POST) === false) {
	$required_fields = array('current_password','password','password_again');
	foreach ($_POST as $key => $value) {
		if (empty($value) && in_array($key, $required_fields) ===true) {
			$errors[] = 'Fields marked with * are required';
			break;
		}
	}
	if (sha1(md5(sha1($_POST['current_password']))) === $user_data['password']) {
		if (trim($_POST['password']) !== trim($_POST['password_again'])) {
			$errors[] = 'Your new passwords do not match';
		}else if (strlen($_POST['password'])< 6) {
			$errors[] = 'Password must be atleast 6 characters';
		}
	}else{
		$errors[] = 'Your password is incorrect';
	}
}
include 'includes/layout/header.php';
include 'includes/addons/loggedin.php';
?>

<h1>Change Password</h1>

<?php
if (isset($_GET['success']) === true && empty($_GET['success']) === true ) {
	echo "<div class=\"alert alert-success\" role=\"alert\"><i class=\"glyphicon glyphicon-ok-sign\"></i> Details have been updated. 
	<a href='index.php'  class=\"alert-link\">Return To Home Page</a>
	</div>";
}else{
	if(isset($_GET['force']) === true && empty($_GET['force']) === true ){
?>
		<div class="alert alert-info" role="alert"><p><i class='glyphicon glyphicon-info-sign'></i> Please Change your password now that it has been recovered</p></div>
<?php
	}	
	if (empty($_POST) === false && empty($errors) === true) {
			change_password($session_user_id, $_POST['password']);
			 		if (header('Location:changepassword.php?success')) {
			        exit();
			        }else{
			        	echo '<script type="text/javascript">';
				        echo 'window.location.href="changepassword.php?success";';
				        echo '</script>';
				        echo '<noscript>';
				        echo '<meta http-equiv="refresh" content="0;url=changepassword.php?success" />';
				        echo '</noscript>'; 
				        exit;	
			        }
	}else if (empty($errors) === false){
			echo "<div class=\"alert alert-danger\" role=\"alert\">".output_errors($errors)."</div>";
			}
	}
?>

	<form class="navbar-form navbar-left" action="" method="POST">
	    <div class="form-group">
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-lock"></i> *</span>
	        <input type="password" class="form-control" name="current_password" placeholder="Current Password" ariadescribedby="basic-addon1" autofocus="autofocus">
	        <br/>
	      </div>
	    </div>
	    <br/>
	    <br/>
	    <div class="form-group">
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-lock"></i> *</span>
	        <input type="password" class="form-control" name="password" placeholder="Password" ariadescribedby="basic-addon1" autofocus="autofocus">
	        <br/>
	      </div>
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-lock"></i> *</span>
	        <input type="password" class="form-control" name="password_again" placeholder="Confirm New Password" ariadescribedby="basic-addon1" autofocus="autofocus">
	      </div>
	    </div>
	    <br/>
	    <br/>
	    <div class="form-group">
	      <input type="submit" class="btn btn-primary" value="Register">
	    </div>
	</form>

<?php
include 'includes/layout/footer.php';?>