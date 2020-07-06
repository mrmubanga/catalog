<?php
require 'connect.php';

if (!empty($_POST)) {
	if (isset($_POST['id'])) {
		$id = trim($_POST['id']);
		$logo = $_POST['logo'];

		if (!empty($id)) {
			$db->query("DELETE FROM `product` WHERE `prod_id` = $id");
			unlink("$logo");

			if (header('Location:index.php?dprod')) {
	        	exit();
	        }else{
	        	echo '<script type="text/javascript">';
		        echo 'window.location.href="index.php?dprod";';
		        echo '</script>';
		        echo '<noscript>';
		        echo '<meta http-equiv="refresh" content="0;url=index.php?dprod" />';
		        echo '</noscript>'; 
		        exit;	
	        }

		}
	}
}

#==================================================================================================================================#
#****************************************************Displays Inserted Data In A Table*********************************************#
$records = array();
$id = $user_data['user_id'];
if ($results = $db->query("SELECT * FROM product WHERE `user_id` = $id")) {
	if($results->num_rows){
		while ($row = $results->fetch_object()) {
			$records[] = $row;
		}
		$results->free();
	}
}

?>
<div class="page-header">
  <h1>Delete Product Information</h1>
</div>

<?php
if (!count($records)) {
	echo "<br/>";
    echo "<div class='alert alert-info' role='alert'><p><i class='glyphicon glyphicon-info-sign'></i> No Records</p></div>";
}else{
?>
	<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr class="info">
				<th>Product Image <i class="glyphicon glyphicon-picture"></i></th>
				<th>Product Name <i class="glyphicon glyphicon-shopping-cart"></i></th>
				<th>Price <i class="glyphicon glyphicon-shopping-cart"></i></th>
				<th>Delete Product <i class="glyphicon glyphicon-trash"></i></th>
			</tr>
		</thead>
		<tbody>
		<?php
			foreach ($records as $r) {
		?>
			<tr class="warning">
				<td><?php echo '<img class=\'img-circle\' width=\' 80px\' height=\' 80px\'src="'.escape($r->image).'"alt="'.escape($r->prodName).'"\'s Profile Image>';?></td>
				<td><?php echo escape($r->prodName);?></td>
				<td><?php echo escape($r->price);?></td>
				<td><form action="" method="POST">
					<input type="number" name="id" class="hidden" value="<?php echo escape($r->prod_id);?>">
					<input type="number" name="logo" class="hidden" value="<?php echo escape($r->image);?>">
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
