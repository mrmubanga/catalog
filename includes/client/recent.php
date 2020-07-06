<?php

require 'connect.php';

?>

<div class="page-header">
  <h1>Recent Added Products</h1>
</div>
<?php
#============================================================#
#****************Displays Inserted Data**********************#

$records = array();
if ($results = $db->query("SELECT * FROM `product`,`store` WHERE `product`.`user_id`=`store`.`user_id` ORDER BY `prod_id` DESC")) {
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
			<?php foreach ($records as $r) { ?>
				<div class="row" id="prc">
				<div class="col-xs-6 col-md-3">
				<a href="index.php?<?php echo escape($r->storeName);?>" class="thumbnail">
				<?php echo '<img class=\'img-responsive\' width=\' 190px\' height=\' 190px\'src="'.escape($r->image).'"alt="'.escape($r->prodName).'"\'s Profile Image>';?>
				</a>
				</div>
					<p><?php echo '<img class=\'img-circle\' width=\' 50px\' height=\' 50px\'src="'.escape($r->logo).'"alt="'.escape($r->storeName).'"\'s Profile Image>';?>
					<strong>Store Name<i class="glyphicon glyphicon-home"></i><i class="glyphicon glyphicon-option-vertical"></i></strong><?php echo escape($r->storeName);?>
					<strong><i class="glyphicon glyphicon-menu-hamburger"></i> HQ Address <i class="glyphicon glyphicon-map-marker"></i><i class="glyphicon glyphicon-option-vertical"></i></strong><?php echo "  ".escape($r->address);?>
					<strong><i class="glyphicon glyphicon-menu-hamburger"></i> Contact No. <i class="glyphicon glyphicon-earphone"></i><i class="glyphicon glyphicon-option-vertical"></i></strong><?php echo escape($r->contact);?></p>
					<p><strong>Product Name <i class="glyphicon glyphicon-shopping-cart"></i><i class="glyphicon glyphicon-option-vertical"></i></strong><?php echo escape($r->prodName);?>
					<strong><i class="glyphicon glyphicon-menu-hamburger"></i> Price <i class="glyphicon glyphicon-tag"></i><i class="glyphicon glyphicon-option-vertical"></i></strong> <?php echo "K".escape($r->price);?></p>
					<p><a href="index.php?<?php  echo escape($r->prodName);?>"><button class="btn btn-info">Compair <?php echo escape($r->prodName);?> Prices</button></a></p>
				</div>
				<hr/>
			<?php } 
}/*<del><?php echo escape($r->price);?></del>*/
#============================================================#
?>