<?php
require("../inc/config.php");
header('Content-Type: text/html;charset=utf-8');  
ob_start();
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$url_phim = $_GET['url_phim'];
require("../inc/info_meta.php");
require("../inc/header.php");
echo '<div class="wrapper home container"><div class="main">';
require("../inc/info.php");
echo '</div>';
require("../inc/sidebar.php");
?>
<?php
require("../inc/footer.php");
?>