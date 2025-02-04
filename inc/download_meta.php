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
<title>Download phim <?php echo $row['tenphim']?> (<?php echo $row['namphim']?>)</title>
 <meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="title" content="<?php echo $row['tenphim']?>"/>
    <meta name="description" content="Download phim <?php echo $row['tenphim']?> | <?php echo $row['mota']?>"/>
    <meta name="keywords" content="<?php echo $row['tag']?>"/>
    <meta name="robots" content="index,follow"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="<?php echo $row['tenphim']?> (<?php echo $row['namphim']?>)"/>
    <meta property="og:description" content="<?php echo $row['tenphim']?> (<?php echo $row['namphim']?>) | <?php echo $row['mota']?>"/>
    <meta property="og:image" content="<?php echo $row['thumbnail']?>"/>
        <meta property="og:site_name" content="ANIVSUB.NET"/>
    <meta property="og:url" content="<?php echo $hientai ?>"/>
    <meta property="fb:app_id" content="<?php echo $appid ?>"/>
<?php require("meta.php"); ?>
</head>
<?php }} ?>
<body>
<div id="fptplay-container" style="position: relative;"> 