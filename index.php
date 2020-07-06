<?php
include 'core/init.php';
include 'includes/layout/header.php';
?>

<?php
if (logged_in() == true) {
include 'includes/addons/loggedin.php';
} else {
include 'includes/layout/clientnavmenu.php';
include 'includes/addons/clientrouter.php';
}
?>
<?php
include 'includes/layout/footer.php';
?>