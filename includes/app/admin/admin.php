<?php

include 'includes/addons/user_count.php';
#==================================================================================================================================#
#****************************************************Displays Inserted Data In A Table*********************************************#
$records = array();
if ($results = $db->query("SELECT * FROM `users` WHERE `user_id` != 1")) {
	if($results->num_rows){
		while ($row = $results->fetch_object()) {
			$records[] = $row;
		}
		$results->free();
	}
}

?>
<h3 align="center">Website Accounts</h3>
<?php
if (!count($records)) {
	echo "<br/>";
    echo "<div class='alert alert-info' role='alert'><p><i class='glyphicon glyphicon-info-sign'></i> No User Records</p></div>";
}else{
?>
	<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr class="info">
				<th>User ID</th>
				<th>Profile Picture</th>
				<th>Username</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Acc Status</th>
				<th>Acc Type</th>
				<th>Set Acc Status</th>
				<th>Delete Acc</th>
			</tr>
		</thead>
		<tbody>
		<?php
			foreach ($records as $r) {
		?>
			<tr class="warning">
				<td><?php echo escape($r->user_id);?></td>
				<td><?php echo '<img class=\'img-circle\' width=\' 40px\' height=\' 40px\'src="'.escape($r->profile).'"alt="'.escape($r->first_name).'"\'s Profile Image>';?></td>
				<td><?php echo escape($r->username);?></td>
				<td><?php echo escape($r->first_name);?></td>
				<td><?php echo escape($r->last_name);?></td>
				<td><?php if ((escape($r->active))== 1) {echo "<span class=\"label label-success\">Active</span>";}else{echo "<span class=\"label label-danger\">Inactive</span>";}?></td>
				<td><?php if ((escape($r->prev))== 0) {echo "<span class=\"label label-warning\">Moderator</span>";}elseif ((escape($r->prev))== 1){echo "<span class=\"label label-info\">Admin</span>";}?></td>
				<td><form action="setuser.php" method="POST">
					<input type="number" name="id" class="hidden" value="<?php echo escape($r->user_id);?>">
					<input type="number" name="active" class="hidden" value="<?php echo escape($r->active);?>">
					<button type="submit "class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i></button></form>
				</td>
				<td><form action="deleteusers.php" method="POST">
					<input type="number" name="id" class="hidden" value="<?php echo escape($r->user_id);?>">
					<button type="submit "class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></button></form>
				</td>
			</tr>

		<?php
		}
		?>
		</tbody>
	</table>
	</div>
<?php
}
?>
<hr>
