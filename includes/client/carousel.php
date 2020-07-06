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
?>


<div class="page-header">
<!-- <h1>Store Available In Catalgue</h1> -->
</div>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
<ol class="carousel-indicators">
<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
<?php 
if (!count($records)) {
?>
<li data-target="#carousel-example-generic" data-slide-to="1"></li>
	</ol>
<div class="carousel-inner" role="listbox">
<div class="item active">
<img src="holder.js/1140x500/auto/#777:#555/text:First slide" alt="First slide">
</div>
<div class="item">
<img src="holder.js/1140x500/auto/#666:#444/text:Second slide" alt="Second slide">
</div>
</div>
?>
<?php
} else {
$cno=0;
$cnom=1;
foreach ($records as $r) { 
$cno=$cno+1;
?>
<li data-target="#carousel-example-generic" data-slide-to="<?php echo $cno;?>"></li>
<?php } ?>
</ol>
<div class="carousel-inner" role="listbox">
<div class="item active">
<img src="assets/logo.jpg" alt="Slide 1">
<div class="carousel-caption">
<a href="index.php?stores"><button class="btn btn-primary">View All Stores</button></a>
</div>
</div>
<?php foreach ($records as $r) { $cnom=$cnom+1;?>
<div class="item">
<img src="<?php echo escape($r->logo);?>"  height="20px" alt="Slide <?php echo $cnom;?>">
<div class="carousel-caption">
<a href="index.php?<?php echo escape($r->storeName);?>"><button class="btn btn-primary">View <?php echo escape($r->storeName);?> Store</button></a>
</div>
</div>
<?php }
}; ?>
<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>