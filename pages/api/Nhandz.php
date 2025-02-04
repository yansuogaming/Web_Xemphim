<?php
//Code By Võ Hữu Nhân
$Nhandz=$_GET["url"];
$GoogleDrive = explode("/",parse_url($Nhandz)['path'])[3];
?>
<div id="VoHuuNhan"></div>
<script type="text/javascript" src="https://anivsub.net/assets/js/jwplayer.js"></script><style type="text/css">
<style type="text/css">
body,html{margin:0;padding:0}
#VoHuuNhan {width:100% !important;height:100% !important;border:none;overflow:hidden;}</style><script>var playerInstance = jwplayer('VoHuuNhan');
playerInstance.setup({
width: '100%',
height: '100%',
title: '',
controls: true,
displaytitle: false,
aspectratio: '16:9',
fullscreen: 'true',
primary: 'html5',
mute: false,
provider: 'http',
sources: [
{file: 'https://www.googleapis.com/drive/v3/files/<?php echo $GoogleDrive ?>?alt=media&key=AIzaSyDdoetN4aDmDBc6Y11CUGK4nhZ0pvZbXOw',type: 'mp4',label: '1080'}
],
        abouttext: 'Developer Võ Hữu Nhân',
        aboutlink: 'https://www.facebook.com/SPT.Nhan'
    
    });</script>