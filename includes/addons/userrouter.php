<?php

if (isset($_GET['astore'])&& empty($_GET['astore'])) {
	include 'includes/app/storeadd.php';
} elseif (isset($_GET['dstore'])&& empty($_GET['dstore'])) {
	include 'includes/app/storedel.php';
} elseif (isset($_GET['ustore'])&& empty($_GET['ustore'])) {
	include 'includes/app/storeup.php';
} elseif (isset($_GET['aprod'])&& empty($_GET['aprod'])) {
	include 'includes/app/productadd.php';
} elseif (isset($_GET['uprod'])&& empty($_GET['uprod'])) {
	include 'includes/app/productup.php';
} elseif (isset($_GET['dprod'])&& empty($_GET['dprod'])) {
	include 'includes/app/productdel.php';
} else {
?>

<!-- <div class="page-header">
  <h1>Sr</h1>
</div> -->
<!-- <p class="lead">Pin a fixed-height footer to the bottom of the viewport in desktop browsers with this custom HTML and CSS. A fixed navbar has been added with <code>padding-top: 60px;</code> on the <code>body > .container</code>.</p>
<p>Back to <a href="../sticky-footer">the default sticky footer</a> minus the navbar.</p> -->

<?php
}
?>