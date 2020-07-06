<?php

require 'connect.php';

?>

<div class="page-header">
  <h1>Add Store Information</h1>
</div>

<?php

#============================================================#
#*******************Inserts Data Into Table******************#

$records = array();

if (!empty($_POST)) {
	if (isset($_POST['store-name'],$_POST['hq'],$_POST['contact'],$_POST['email'])) {
		$name = sanitize(trim($_POST['store-name']));
		$hq = sanitize(trim($_POST['hq']));
		$contact = sanitize(trim($_POST['contact']));
		$email = sanitize(trim($_POST['email']));


		if (!empty($name) && !empty($hq) && !empty($contact) && !empty($email)) {
			$insert = $db->prepare("INSERT INTO `store` (`storeName`,`address`,`logo`,`contact`,`email`,`user_id`) VALUES(?,?,?,?,?,?)");
				if (isset($_FILES['profile'])=== true) {
					if (empty($_FILES['profile']['name'])=== true) {
						echo "<br/>";
						echo "<div class='alert alert-info' role='alert'><p><i class='glyphicon glyphicon-alert'> </i> Please Select a File For Upload! </p></div>";
					}else{
						$allowed = array('jpg','jpeg','gif','png');
						$file_name = $_FILES['profile']['name'];
						$file_extn = strtolower(end(explode('.', $file_name)));
						$file_temp = $_FILES['profile']['tmp_name'];
						$size =  $_FILES['profile']['size'];
						$max_size =  5797152;
						if ($size <= $max_size) {
							if (in_array($file_extn, $allowed)=== true) {
								$file_path = 'uploads/logos/'.$name.'.'.$file_extn;
								move_uploaded_file($file_temp, $file_path);
								$insert->bind_param('sssssi',$name,$hq,mysqli_real_escape_string($db,$file_path),$contact,$email,$user_data['user_id']);
								if ($insert->execute()) {
									if (header('Location:index.php?astore')) {
								        exit();
							        }else{
							        	echo '<script type="text/javascript">';
								        echo 'window.location.href="index.php?astore";';
								        echo '</script>';
								        echo '<noscript>';
								        echo '<meta http-equiv="refresh" content="0;url=index.php?astore" />';
								        echo '</noscript>'; 
								        exit;	
							        }
								}
							}else{
								echo "<br/>";
								echo "<div class='alert alert-info' role='alert'><p><i class='glyphicon glyphicon-alert'> </i> Incorrect file extension.</p></div>";
								echo "<br/>";
								echo "<div class='alert alert-info' role='alert'><p><i class='glyphicon glyphicon-alert'> </i> Correct extensions are: ".implode (', ',$allowed)."</p></div>";
							}
						}else{
							echo "<div class=\"alert alert-danger\" role=\"alert\" ><i class='glyphicon glyphicon-alert'></i>  File exceeds Maximum Upload size allowed File must be less than <strong>5 MB</strong></div>";
						}
					}
				}

		} else {
			echo "<br/>";
			echo "<div class='alert alert-info' role='alert'><p><i class='glyphicon glyphicon-alert'> </i> No Input Sent </p></div>";
		}
	}
}
#============================================================#
#****************Displays Inserted Data**********************#

$records = array();
$id = $user_data['user_id'];
if ($results = $db->query("SELECT * FROM store WHERE `user_id` = $id")) {
	if ($results->num_rows) {
		while ($row = $results->fetch_object()) {
			$records[] = $row;
		}
		$results->free();
	}
}

if (!count($records)) {
	echo "<br/>";
	echo "<div class='alert alert-info' role='alert'><p><i class='glyphicon glyphicon-info-sign'></i> No Records</p></div>";
?>

	<form class="navbar-form navbar-left" action="" enctype="multipart/form-data" method="POST">
	    <div class="form-group">
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><strong><i class="glyphicon glyphicon-home"></i> *</strong></span>
	        <input type="text" class="form-control" name="store-name" placeholder="Store Name" ariadescribedby="basic-addon1" autofocus="autofocus">
	        <br/>
	      </div>
	    </div>
	    <br/>
	    <br/>
	    <div class="form-group">
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><strong><i class="glyphicon glyphicon-map-marker"></i> *</strong></span>
	        <input type="text" class="form-control" name="hq" placeholder="HQ Address" ariadescribedby="basic-addon1" autofocus="autofocus">
	        <br/>
	      </div>
	    </div>
	    <br/>
	    <br/>
	    <div class="form-group">
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><strong><i class="glyphicon glyphicon-earphone"></i> *</strong></span>
	        <input type="tel" class="form-control" name="contact" placeholder="Contact Number" ariadescribedby="basic-addon1" autofocus="autofocus">
	        <br/>
	      </div>
	    </div>
	    <br/>
	    <br/>
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
	      <label for="profile">Store Logo  <span><i class="glyphicon glyphicon-cloud-upload"></i></span> : <span class="label label-warning"><i class='glyphicon glyphicon-info-sign'></i> File Size Must not Exceed 5 MB</span></label>
	    </div>
	    <br/>
	    <div class="form-group">
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-picture"></i> *</span>
	        <input type="file" class="form-control" name="profile" ariadescribedby="basic-addon1" autofocus="autofocus">
	        <br/>
	      </div>
	    </div>
	    <br/>
	    <br/>
	    <div class="form-group">
	      <input type="submit" class="btn btn-primary" value="Add Details">
	    </div>
	</form>

<?php

} else {
?>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr class="info">
					<th>Logo <i class="glyphicon glyphicon-picture"></i></th>
					<th>Store Name <i class="glyphicon glyphicon-home"></th>
					<th>HQ Address <i class="glyphicon glyphicon-map-marker"></i></th>
					<th>Contact No. <i class="glyphicon glyphicon-earphone"></i></th>
					<th>Email Address <i class="glyphicon glyphicon-envelope"></i></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($records as $r) { ?>
				<tr class="success">
					<td><?php echo '<img class=\'img-responsive\' width=\' 70px\' height=\' 70px\'src="'.escape($r->logo).'"alt="'.escape($r->storeName).'"\'s Profile Image>';?></td>
					<td><?php echo escape($r->storeName);?></td>
					<td><?php echo escape($r->address);?></td>
					<td><?php echo escape($r->contact);?></td>
					<td><?php echo escape($r->email);?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>	
<?php

}
#============================================================#

?>
