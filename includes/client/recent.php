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
				<div class="row">
				<div class="col-sm-4">
    
    <!--Card image-->
    <div class="view overlay panel panel-default">
	<?php echo '<img class=\'img-responsive\' width=\' 100%\' height=\' 200px\'src="'.escape($r->image).'"alt="'.escape($r->prodName).'"\'s Profile Image>';?>      
	<a href="#!">
      <a href="#!">
        <div class="mask rgba-white-slight"></div>
      </a>
    </div>
    <!--Card content-->
    <div class="card-body">
      <!--Title-->
					<br>
					<strong>Store Name <i class="glyphicon glyphicon-home"></i><i class="glyphicon glyphicon-option-vertical"></i></strong><?php echo escape($r->storeName);?><br>
					<strong> HQ Address    <i class="glyphicon glyphicon-map-marker"></i><i class="glyphicon glyphicon-option-vertical"></i></strong><?php echo "  ".escape($r->address);?><br>
					<strong> Contact No.   <i class="glyphicon glyphicon-earphone"></i><i class="glyphicon glyphicon-option-vertical"></i></strong><?php echo escape($r->contact);?></p>
					<p><strong>Product Name <i class="glyphicon glyphicon-shopping-cart"></i><i class="glyphicon glyphicon-option-vertical"></i></strong><?php echo escape($r->prodName);?><br>
					<strong>Price <i class="glyphicon glyphicon-tag"></i><i class="glyphicon glyphicon-option-vertical"></i></strong> <?php echo "K".escape($r->price);?></p>
					<!-- <p><a href="index.php?<?php  echo escape($r->prodName);?>"><button class="btn btn-info">Compair <?php echo escape($r->prodName);?> Prices</button></a></p> -->
					<p><a href="https://www.google.co.zm/maps/search/nearest+<?php echo escape($r->storeName);?>+store/@-15.4137265,28.2851624,13z/data=!3m1!4b1"  target="blank"><button class="btn btn-info">View <?php echo escape($r->storeName);?> Stores Near You</button></button></a></p>

    </div>

  </div>
  </div>
				<hr/>
			<?php } 
}/*<del><?php echo escape($r->price);?></del>*/
#============================================================#
?>