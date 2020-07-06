<?php
include 'core/init.php';
protect_page();
include 'includes/layout/header.php';
include 'includes/addons/loggedin.php';

if (empty($_POST) === false) {
	$required_fields = array('first_name','email');
	foreach ($_POST as $key => $value) {
		if (empty($value) && in_array($key, $required_fields) ===true) {
			$errors[] = 'Fields marked with * are required';
			break;
		}
	}
	if (empty($errors)=== true) {
		if (filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)=== false) {
			$errors[]= 'A Valid Email is Required';
		}elseif (email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']) {
			$errors[]= 'Email \''.$_POST['email'].'\' already in use';
		}
	}
	#*******************************************************#
	if (isset($_FILES['profile'])=== true) {
		if (empty($_FILES['profile']['name'])=== true) {
			$errors[] = "Please Select a File For Upload";
		}else{
			$allowed = array('jpg','jpeg','gif','png');
			$file_name = $_FILES['profile']['name']/*['size']*/;
			$file_extn = strtolower(end(explode('.', $file_name)));
			$file_temp = $_FILES['profile']['tmp_name'];
			$size =  $_FILES['profile']['size'];
			$max_size =  5797152;
			if ($size <= $max_size) {
				if (in_array($file_extn, $allowed)=== true) {
					change_profile_image($session_user_id, $file_temp, $file_extn);
				}else{
					$errors[]= "Incorrect file extension.<br/>Correct extensions are: ";
					$errors[]= implode (', ',$allowed);
				}
			}else{
				echo "<div class=\"alert alert-danger\" role=\"alert\" ><i class='glyphicon glyphicon-alert'></i>  File exceeds Maximum Upload size allowed File must be less than <strong>5 MB</strong></div>";
			}
		}
	}
	#*******************************************************#
}
?>
<h1>Update Personal Details</h1>
<?php
if (isset($_GET['success'])&& empty($_GET['success'])) {
	echo "<div class=\"alert alert-success\" role=\"alert\"><i class=\"glyphicon glyphicon-ok-sign\"></i> Details have been updated. 
	<a href='index.php'  class=\"alert-link\">Return To Home Page</a>
	</div>";

}else{
	if (empty($_POST) === false && empty($errors)=== true) {
		$update_data = array('first_name' => $_POST['first_name'],
						'last_name' => $_POST['last_name'],
						'email' => $_POST['email'],);
	update_user($session_user_id,$update_data);

	if (header('Location:settings.php?success')) {
        exit();
    }else{
    	echo '<script type="text/javascript">';
        echo 'window.location.href="settings.php?success";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=settings.php?success" />';
        echo '</noscript>'; 
        exit;	
    }

	}else if (empty($errors) === false){
			echo "<div class=\"alert alert-danger\" role=\"alert\">".output_errors($errors)."</div>";
		}


	?>
	<form class="navbar-form navbar-left" action="" enctype="multipart/form-data" method="POST">
	    <div class="form-group">
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><strong>First Name *</strong></span>
	        <input type="text" class="form-control" name="first_name" placeholder="First Name" ariadescribedby="basic-addon1" autofocus="autofocus" value="<?php echo $user_data['first_name'];?>" >
	        <br/>
	      </div>
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><strong>Last Name </strong></i></span>
	        <input type="text" class="form-control" name="last_name" placeholder="Last Name" ariadescribedby="basic-addon1" autofocus="autofocus" value="<?php echo $user_data['last_name'];?>">
	      </div>
	    </div>
	    <br/>
	    <br/>
	    <div class="form-group">
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-envelope"></i> *</span>
	        <input type="email" class="form-control" name="email" placeholder="Email" ariadescribedby="basic-addon1" autofocus="autofocus" value="<?php echo $user_data['email'];?>">
	        <br/>
	      </div>
	    </div>
	    <br/>
	    <br/>
	    <div class="form-group">
	      <label for="profile">Profile Picture   <span><i class="glyphicon glyphicon-cloud-upload"></i></span> : <span class="label label-warning"><i class='glyphicon glyphicon-info-sign'></i> File Size Must not Exceed 5 MB</span></label>
	    </div>
	    <br/>
	    <div class="form-group">
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-user"></i><i class="glyphicon glyphicon-picture"></i> *</span>
	        <input type="file" class="form-control" name="profile" ariadescribedby="basic-addon1" autofocus="autofocus">
	        <br/>
	      </div>
	    </div>
	    <br/>
	    <br/>
	    <div class="form-group">
	      <input type="submit" class="btn btn-primary" value="Update Details">
	    </div>
	</form>
<?php
}
include 'includes/layout/footer.php';?>