<?php
include 'core/init.php';
include 'includes/layout/header.php';

if (logged_in() == true) {
include 'includes/addons/loggedin.php';
} else {
include 'includes/layout/clientnavmenu.php';
}
?>
<?php
$cn="";
$en="";
if (!isset($_POST['captch'])) {
  $_SESSION['secure'] = rand(1000,9999);
}else{
	if (!empty($_POST['captch'])){
		if ($_SESSION['secure']== $_POST['captch']) {
	    	if (isset($_POST['cname'])&& isset($_POST['email'])&& isset($_POST['msg'])){
			 	$contact_name = htmlentities($_POST['cname']);

			  	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
					$errors[] = 'Valid email required';
					$contact_email = "";
				}else{
					$contact_email = htmlentities($_POST['email']);
				}
			  	$contact_text = htmlentities($_POST['msg']);

			  if (!empty($contact_name)&& !empty($contact_email)&& !empty($contact_text)) {

			    if (strlen($contact_name)>35) {
			      $errors[] = "Sorry the max Name length is 35 Characters";
			    }else if (strlen($contact_email)>50) {
			      $errors[] = "sorry the max Email length is 50 Characters";
			    }else if (strlen($contact_text)>1000) {
			      $errors[] = "sorry the max Message length is 50 Characters";
			    }else{
			      $to = 'drasacademyltd@gmail.com';
			      $subject = 'Contact Form submited';
			      $body =$contact_name.' '."\n\n".$contact_text;
			      $headers = "From: ".$contact_email;

			      if (mail($to, $subject, $body, $headers)) {
			        $to = $contact_email;
			        $subject = 'Enquiry notification';
			        $body ='Thank you for your message we will get back to you soon';
			        $headers ='From: carry-catalog <carry@gmail.com>';
			        mail($to, $subject, $body, $headers);
			        if (header('Location:contact.php?success')) {
			        exit();
			        }else{
			        	echo '<script type="text/javascript">';
				        echo 'window.location.href="contact.php?success";';
				        echo '</script>';
				        echo '<noscript>';
				        echo '<meta http-equiv="refresh" content="0;url=contact.php?success" />';
				        echo '</noscript>'; 
				        exit;	
			        }
			      }else{
			        $errors[] = "Failed to send email.";
			      }
			    }
			  }else{
					$errors[] = "All Fields are required.";
					$cn = $contact_name;
					$en = $contact_email;
			  }
			}
	    	#*******************************************************************************************************#
	  	}else{
	    	$errors[] = 'Captcha Mismatch';
	    	$_SESSION['secure'] = rand(1000,9999);
	  	}
	}else{
		$errors[] = "Fill in all form fields";
	}
}

?>
	<div align="center">
		<h2>Contact Us</h2>	
	</div>
<?php
if (isset($_GET['success'])&& empty($_GET['success'])) {
	echo "<div class=\"alert alert-success\" role=\"alert\"><i class=\"glyphicon glyphicon-ok-sign\"></i> Email Sent...</div>" ;
}else if (empty($errors) === false){
		echo "<div class=\"alert alert-danger\" role=\"alert\">".output_errors($errors)."</div>";
		$_SESSION['secure'] = rand(1000,9999);
	}
?>

		<form class="navbar-form navbar-left" action="contact.php" method="POST">
		    <div class="form-group">
		      <div class="input-group">
		        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-user"></i> *</span>
		        <input type="text" class="form-control" name="cname" placeholder="Contact Name" ariadescribedby="basic-addon1" autofocus="autofocus" value="<?php echo $cn;?>">
		        <br/>
		      </div>
		    </div>
		    <br/>
		    <br/>
		    <div class="form-group">
		      <div class="input-group">
		        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-envelope"></i> *</span>
		        <input type="email" class="form-control" name="email" placeholder="Email Address" ariadescribedby="basic-addon1" autofocus="autofocus"value="<?php echo $en;?>">
		        <br/>
		      </div>
		    </div>
		    <br/>
		    <br/>
		    <div class="form-group">
		      <div class="input-group">
		        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-pencil"></i> *</span>
		        <textarea class="form-control" name="msg" rows="8" cols="50" placeholder="Message....." ariadescribedby="basic-addon1" autofocus="autofocus"></textarea>
		        <br/>
		      </div>
		    </div>
		    <br/>
		    <br/>
		    <!--Captcha-->
		    <div class="form-group">
		      <label for="captch">Are you Human * :</label>
		      <img src="captcha.php" alt="Captcha Image" /><br/>
		    </div>
		    <br/>
		    <br/>
		    <!---->
		    <div class="form-group">
		      <div class="input-group">
		        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-picture"></i> *</span>
		        <input type="text" class="form-control" name="captch" placeholder="Captcha Value" ariadescribedby="basic-addon1" autofocus="autofocus" autocomplete="off">
		        <br/>
		      </div>
		    </div>
		    <br/>
		    <br/>
		    <div class="form-group">
		      <input type="submit" class="btn btn-primary" value="Send">
		    </div>
		</form>

<?php
 include 'includes/layout/footer.php';
?>