<?php

require 'connect.php';

?>

<div class="page-header">
  <h1>Add Product Information</h1>
</div>

<?php

#============================================================#
#*******************Inserts Data Into Table******************#

$records = array();

if (!empty($_POST)) {
	if (isset($_POST['product-name'],$_POST['price'],$_POST['id'])) {
		$name = sanitize(trim($_POST['product-name']));
		$price = sanitize(trim($_POST['price']));
		$pid = (sanitize(trim($_POST['id'])));

$pricerecords = array();
if ($r444 = $db->query("SELECT * FROM product WHERE `prod_id`=$pid")) {
	if ($r444->num_rows) {
		while ($ro = $r444->fetch_object()) {
			$pricerecords[] = $ro;
		}
		$r444->free();
	}
}
foreach ($pricerecords as $rj) {
	$currentprice = $rj->price;
}

		if (!empty($name) && !empty($price) && !empty($pid) ) {
				if (isset($_FILES['profile'])=== true) {
					if (empty($_FILES['profile']['name'])=== true) {

						$insert = $db->query("UPDATE `product` SET `prodName`='$name',`price` = '$price' WHERE `prod_id`=$pid");
								if ($insert) {
									
									if ((int)$currentprice !== $price) {
										$uid = $user_data['user_id'];
										$ins = $db->query("INSERT INTO `pricehist` (`prod_id`,`date`,`oldPrice`,`user_id`) VALUES($pid,NOW(),$currentprice,$uid)");
										if ($ins) {
											if (header('Location:index.php?uprod')) {
										        exit();
									        }else{
									        	echo '<script type="text/javascript">';
										        echo 'window.location.href="index.php?uprod";';
										        echo '</script>';
										        echo '<noscript>';
										        echo '<meta http-equiv="refresh" content="0;url=index.php?uprod" />';
										        echo '</noscript>'; 
										        exit;	
									        }
										}
									} else {
										if (header('Location:index.php?uprod')) {
									        exit();
								        }else{
								        	echo '<script type="text/javascript">';
									        echo 'window.location.href="index.php?uprod";';
									        echo '</script>';
									        echo '<noscript>';
									        echo '<meta http-equiv="refresh" content="0;url=index.php?uprod" />';
									        echo '</noscript>'; 
									        exit;	
								        }
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
								$file_path = 'uploads/products/'.$name.$user_data['user_id'].'.'.$file_extn;
								move_uploaded_file($file_temp, $file_path);
								$image = mysqli_real_escape_string($db,$file_path);
								$insert = $db->query("UPDATE `product` SET `prodName`='$name',`image` = '$image',`price` = '$price' WHERE `prod_id`=$pid");
								if ($insert) {
									if ((int)$currentprice !== $price) {
										$uid = $user_data['user_id'];
										$ins = $db->query("INSERT INTO `pricehist` (`prod_id`,`date`,`oldPrice`,`user_id`) VALUES($pid,NOW(),$currentprice,$uid)");
										if ($ins) {
											if (header('Location:index.php?uprod')) {
										        exit();
									        }else{
									        	echo '<script type="text/javascript">';
										        echo 'window.location.href="index.php?uprod";';
										        echo '</script>';
										        echo '<noscript>';
										        echo '<meta http-equiv="refresh" content="0;url=index.php?uprod" />';
										        echo '</noscript>'; 
										        exit;	
									        }
										}
									} else {
										if (header('Location:index.php?uprod')) {
									        exit();
								        }else{
								        	echo '<script type="text/javascript">';
									        echo 'window.location.href="index.php?uprod";';
									        echo '</script>';
									        echo '<noscript>';
									        echo '<meta http-equiv="refresh" content="0;url=index.php?uprod" />';
									        echo '</noscript>'; 
									        exit;	
								        }
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
if ($results = $db->query("SELECT * FROM product WHERE `user_id` = $id")) {
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
					<th>Product Image <i class="glyphicon glyphicon-picture"></i></th>
					<th>Product ID <i class="glyphicon glyphicon-tag"></i></th>
					<th>Product Name <i class="glyphicon glyphicon-shopping-cart"></i></th>
					<th>Price <i class="glyphicon glyphicon-shopping-cart"></i></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($records as $r) { ?>
				<tr class="success">
					<td><?php echo '<img class=\'img-responsive\' width=\' 100px\' height=\' 100px\'src="'.escape($r->image).'"alt="'.escape($r->prodName).'"\'s Profile Image>';?></td>
					<td><?php echo escape($r->prod_id);?></td>
					<td><?php echo escape($r->prodName);?></td>
					<td><?php echo escape($r->price);?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>	
<?php

}
?>

	<form class="navbar-form navbar-left" action="" enctype="multipart/form-data" method="POST">
	    <div class="form-group">
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><strong><i class="glyphicon glyphicon-tag"></i> *</strong></span>
	        <input type="number" class="form-control" name="id" placeholder="Product ID" ariadescribedby="basic-addon1" autofocus="autofocus">
	        <br/>
	      </div>
	    </div>
	    <br/>
	    <br/>
	    <div class="form-group">
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><strong><i class="glyphicon glyphicon-shopping-cart"></i> *</strong></span>
	        <input type="text" class="form-control" name="product-name" placeholder="Product Name" ariadescribedby="basic-addon1" autofocus="autofocus">
	        <br/>
	      </div>
	    </div>
	    <br/>
	    <br/>
	    <div class="form-group">
	      <div class="input-group">
	        <span class="input-group-addon" id="basic-addon1"><strong><i class="glyphicon glyphicon-shopping-cart"></i> *</strong></span>
	        <input type="number" class="form-control" name="price" placeholder="Price" ariadescribedby="basic-addon1" autofocus="autofocus">
	        <br/>
	      </div>
	    </div>
	    <br/>
	    <br/>
	    <div class="form-group">
	      <label for="profile">Product Image  <span><i class="glyphicon glyphicon-cloud-upload"></i></span> : <span class="label label-warning"><i class='glyphicon glyphicon-info-sign'></i> File Size Must not Exceed 5 MB</span></label>
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
	      <input type="submit" class="btn btn-primary" value="Add Product">
	    </div>
	</form>