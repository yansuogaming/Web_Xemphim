<?php
require("../inc/config.php");
$theloai = $_GET['theloai'];
require("../inc/meta_theloai.php");
require("../inc/header.php");
echo '<div class="wrapper home container"><div class="main">';
require("../inc/main_theloai.php");
echo '</div>';
require("../inc/sidebar.php");
?>
<?php
require("../inc/footer.php");
?>