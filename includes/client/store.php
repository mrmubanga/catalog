
<div class="page-header">
  <h1>Stores</h1>
</div>

<?php
#============================================================#
#****************Displays Inserted Data**********************#

$records = array();
if ($results = $db->query("SELECT * FROM store ORDER BY `storeName` ASC")) {
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
				<tr class="success">
					<th>Logo <i class="glyphicon glyphicon-picture"></i></th>
					<th>Store Name <i class="glyphicon glyphicon-home"></th>
					<th>HQ Address <i class="glyphicon glyphicon-map-marker"></i></th>
					<th>Contact No. <i class="glyphicon glyphicon-earphone"></i></th>
					<th>Email Address <i class="glyphicon glyphicon-envelope"></i></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($records as $r) { ?>
				<tr class="info">
					<td><a href="index.php?<?php echo escape($r->storeName);?>" class="thumbnail">
					<?php echo '<img class=\'img-responsive\' width=\' 120px\' height=\' 120px\'src="'.escape($r->logo).'"alt="'.escape($r->storeName).'"\'s Profile Image>';?></a></td>
					<td><?php echo escape($r->storeName);?></td>
					<td><p><?php echo escape($r->address);?></p>
					<p><a href="https://www.google.co.zm/maps/search/nearest+<?php echo escape($r->storeName);?>+store/@-15.4137265,28.2851624,13z/data=!3m1!4b1"  target="blank"><button class="btn btn-primary">View <?php echo escape($r->storeName);?> Stores Near You</button></button></a></p></td>
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
#  https://www.google.co.zm/maps/search/nearest+melissa+store/@-15.4137265,28.2851624,13z/data=!3m1!4b1
?>