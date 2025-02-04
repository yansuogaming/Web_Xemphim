<?php
require("../inc/config.php");
?>
<?php
$sql = "SELECT * FROM phim WHERE link = '$url_phim'";
function mota($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) {
?>
<html>
<head>
<title><?php echo $row['tenphim']?> (<?php echo $row['namphim']?>)</title>
<meta name="description" content="<?php echo $row['mota']?>" />
<link rel="canonical" href="<?php echo $hientai ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta charset="utf-8">
<meta property="og:type" content="website" />
<meta property="og:title" content="<?php echo $row['tenphim']?> (<?php echo $row['namphim']?>)" />
<meta property="og:description" content="<?php echo $row['mota']?>"/>
<meta name="keywords" content="<?php echo $row['tag']?>"/>
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