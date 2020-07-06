<?php

require 'connect.php';

$records = array();

if (!empty($_POST)) {
	if (isset($_POST['id'])) {
		$id = trim($_POST['id']);
		$logo = $_POST['logo'];

		if (!empty($id)) {
			$db->query("DELETE FROM `store` WHERE `store_id` = $id");
			unlink("$logo");
		}
	}
}

?>

<div class="page-header">
  <h1>Delete Store</h1>
</div>

<?php
#==============================================================#
#*****************Dispalys Table Data**************************#

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
<hr/>
	<form class="navbar-form navbar-left" action="" enctype="multipart/form-data" method="POST">
	    <div class="form-group">
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><strong><i class="glyphicon glyphicon-trash"></i> *</strong></span>
	        <input type="text" readonly="readonly" class="form-control" name="store-name" placeholder="<?php echo escape($r->storeName);?>" ariadescribedby="basic-addon1">
	        <br/>
	      </div>
	    </div>
	    <input type="text" readonly="readonly" class="hidden" name="id" value="<?php echo escape($r->store_id);?>">
	    <input type="text" readonly="readonly" class="hidden" name="logo" value="<?php echo escape($r->logo);?>">
	    <div class="form-group">
	      <input type="submit" class="btn btn-danger" value="Delete Store">
	    </div>
	</form>

<?php
}
?>