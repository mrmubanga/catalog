<?php
#**************************************************************************************************************#
require 'core/database/connect.php';
$records = array();
if ($results = $db->query("SELECT * FROM `product`,`store` WHERE `product`.`user_id`=`store`.`user_id` ORDER BY `prodName`")) {
	if ($results->num_rows) {
		while ($row = $results->fetch_object()) {
			$records[] = $row;
		}
		$results->free();
	}
}
	$re = "";
	$storeFilter = "";
	$coo= 0;
	foreach ($records as $r) {
		$rre = $r->storeName;
		if ( $ree = $_SERVER["QUERY_STRING"] ) {
			$storeFilter = $ree ;
		}
		$coo = $coo + 1;

	};
#**************************************************************************************************************#

if (isset($_GET['stores'])&& empty($_GET['stores'])) {
		include 'includes/client/store.php';
} elseif (isset($_GET['products'])&& empty($_GET['products'])) {
		include 'includes/client/products.php';
} elseif (isset($_GET['recent'] )&& empty($_GET['recent'])) {
		include 'includes/client/recent.php';
} elseif (isset($_GET['compair'])&& empty($_GET['compair'])) {
		include 'includes/client/compair.php';
} elseif (isset($_GET[$storeFilter])&& empty($_GET[$storeFilter])) {
		include 'includes/client/filter.php';
} else {
	include 'includes/client/carousel.php';
?>

<!-- <div class="page-header">
  <h1>Sr <del>eee</del> </h1>
</div> -->
<!-- <p class="lead">Pin a fixed-height footer to the bottom of the viewport in desktop browsers with this custom HTML and CSS. A fixed navbar has been added with <code>padding-top: 60px;</code> on the <code>body > .container</code>.</p>
<p>Back to <a href="../sticky-footer">the default sticky footer</a> minus the navbar.</p> -->

<?php
}
?>