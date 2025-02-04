<?php
require("../inc/config.php");
?>
<?php
$sql = "SELECT * FROM phim WHERE link = '$url_phim'";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) {
?>
<html>
<head>
<title>Xem phim <?php echo $row['tenphim']?> Tập <?php echo $taphientai ?></title>
<meta name="description" content="<?php echo $row['mota']?>" />
<link rel="canonical" href="<?php echo $hientai ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta charset="utf-8">
<meta property="og:type" content="website" />
<meta property="og:title" content="Xem phim <?php echo $row['tenphim']?> Tập <?php echo $taphientai ?>" />
<meta property="og:description" content="<?php echo $row['mota']?>" />
<meta property="og:image" content="<?php echo $row['thumbnail']?>" />
<meta property="og:site_name" content="anivsub.net" />
<meta property="og:url" content="<?php echo $hientai ?>" />
<meta property="og:locale" content="vi_VN" />
<meta property="fb:app_id" content="<?php echo $appid ?>" />
<meta property="fb:admins" content="<?php echo $facebook ?>" />
<meta name="robots" content="index, follow">
<?php require("meta.php"); ?>
</head>
<?php }} ?>
<body>
<div id="fptplay-container" style="position: relative;"> 