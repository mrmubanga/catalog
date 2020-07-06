<?php
include 'core/init.php';
include 'includes/layout/header.php';

if (logged_in() == true) {
include 'includes/addons/loggedin.php';
} else {
include 'includes/layout/clientnavmenu.php';
}

?>
<section align = "center">
<h1>Sorry You Need To Be Logged In</h1>
<p>Please Ensure You Have the <strong>RIGHT Permissions</strong></p>
<p><a href="index.php" title="Home"><span><i class="glyphicon glyphicon-home"></i>  </span> Go To Home Page</a></p>
</section>
<?php include 'includes/layout/footer.php';?>