<?php

require 'connect.php';

?>

<div class="page-header">
  <h1>Update Store Information</h1>
</div>

<?php

#============================================================#
#*******************Inserts Data Into Table******************#
$u1 = "";
$u2 = "";
$u3 = "";
$u4 = "";
$records = array();

if (!empty($_POST)) {
	if (isset($_POST['store-name'],$_POST['hq'],$_POST['contact'],$_POST['email'])) {
		$name = sanitize(trim($_POST['store-name']));
		$hq = sanitize(trim($_POST['hq']));
		$contact = sanitize(trim($_POST['contact']));
		$email = sanitize(trim($_POST['email']));
		$id = $_POST['id'];


		if (!empty($name) && !empty($hq) && !empty($contact) && !empty($email)) {
				if (isset($_FILES['profile'])=== true) {
					if (empty($_FILES['profile']['name'])=== true) {
								$insert = $db->query("UPDATE `store` SET `storeName`='$name',`address` = '$hq', `contact`='$contact' , `email`='$email' WHERE `store_id`=$id");
								if ($insert) {
									if (header('Location:index.php?ustore')) {
								        exit();
							        }else{
							        	echo '<script type="text/javascript">';
								        echo 'window.location.href="index.php?ustore";';
								        echo '</script>';
								        echo '<noscript>';
								        echo '<meta http-equiv="refresh" content="0;url=index.php?ustore" />';
								        echo '</noscript>'; 
								        exit;	
							        }
								}
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
								$logo = mysqli_real_escape_string($db,$file_path);
								$insert = $db->query("UPDATE `store` SET `storeName`='$name',`address` = '$hq',`logo` = '$logo' , `contact`='$contact' , `email`='$email' WHERE `store_id`='$id'");
								if ($insert) {
									if (header('Location:index.php?ustore')) {
								        exit();
							        }else{
							        	echo '<script type="text/javascript">';
								        echo 'window.location.href="index.php?ustore";';
								        echo '</script>';
								        echo '<noscript>';
								        echo '<meta http-equiv="refresh" content="0;url=index.php?ustore" />';
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
$u1 = $r->storeName;
$u2 = $r->address;
$u3 = $r->contact;
$u4 = $r->email;
}
#============================================================#
?>
<hr/>
	<form class="navbar-form navbar-left" action="" enctype="multipart/form-data" method="POST">
		<input type="text" readonly="readonly" class="hidden" name="id" value="<?php echo escape($r->store_id);?>">
	    <div class="form-group">
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><strong><i class="glyphicon glyphicon-home"></i> *</strong></span>
	        <input type="text" class="form-control" name="store-name" placeholder="Store Name" ariadescribedby="basic-addon1" value="<?php echo $u1;?>" autofocus="autofocus">
	        <br/>
	      </div>
	    </div>
	    <br/>
	    <br/>
	    <div class="form-group">
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><strong><i class="glyphicon glyphicon-map-marker"></i> *</strong></span>
	        <input type="text" class="form-control" name="hq" placeholder="HQ Address" ariadescribedby="basic-addon1" value="<?php echo $u2;?>" autofocus="autofocus">
	        <br/>
	      </div>
	    </div>
	    <br/>
	    <br/>
	    <div class="form-group">
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><strong><i class="glyphicon glyphicon-earphone"></i> *</strong></span>
	        <input type="tel" class="form-control" name="contact" placeholder="Contact Number" ariadescribedby="basic-addon1" value="<?php echo $u3;?>" autofocus="autofocus">
	        <br/>
	      </div>
	    </div>
	    <br/>
	    <br/>
	    <div class="form-group">
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-envelope"></i> *</span>
	        <input type="email" class="form-control" name="email" placeholder="Email Address" ariadescribedby="basic-addon1" value="<?php echo $u4;?>" autofocus="autofocus">
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
	      <input type="submit" class="btn btn-primary" value="Update Details">
	    </div>
	</form>
