<?php
$trangchu = 'https://dinhtlong.com';
?>
<head>
    <title>Player video</title>
</head>
<?php
$jw_css='<style type="text/css">
body,html{margin:0;padding:0}
#VoHuuNhan {width:100% !important;height:100% !important;border:none;overflow:hidden;}</style>'
?>
<body>
<div id="VoHuuNhan"></div></body>
<?php
$JW7H = '<link href="./skins/thin.min.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
body,html{margin:0;padding:0}
#VoHuuNhan {width:100% !important;height:100% !important;border:none;overflow:hidden;}</style>';
$JW7 = '<script type="text/javascript" src="./jwplayer-7.3.6/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="Ywok59g9j93GtuSU7+axNzjIp/TBfiK4s0vvYg==";</script>';
$JW8 = '<script type="text/javascript" src="'.$trangchu.'/assets/js/jwplayer.js"></script>';
?>
<?php
$url= $_GET['url'];
$players = explode("/",parse_url($url)['path'])[3];
$html = file_get_contents("$url");
$dom = new domDocument;
libxml_use_internal_errors (true);
$dom->loadHTML($html);
?>
<?php
$drive = "<script>var playerInstance = jwplayer('VoHuuNhan');
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
{file: 'https://www.googleapis.com/drive/v3/files/$players?alt=media&key=AIzaSyDdoetN4aDmDBc6Y11CUGK4nhZ0pvZbXOw',type: 'mp4',label: '1080'}
],
        abouttext: 'Developer Võ Hữu Nhân',
        aboutlink: 'https://www.facebook.com/SPT.Nhan'
    
    });</script>";
$mp4 = "
<script>var playerInstance = jwplayer('VoHuuNhan');
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
{file: '$url',type: 'mp4',label: '1080'}
],
        abouttext: 'Developer Võ Hữu Nhân',
        aboutlink: 'https://www.facebook.com/SPT.Nhan'
});</script>";
$youtube = "
<script type='text/javascript'>
	jwplayer('VoHuuNhan').setup({
		file: '$url',
		image:'https://i.imgur.com/kjPIYa1.png',
		autostart: false,
		skin: {
			name: 'thin'
		},
		abouttext: 'Võ Hữu Nhân',
		aboutlink: 'https://www.facebook.com/SPT.Nhan',
	});
</script>";
?>
<?php
$nhan = $_GET['url'];
if (strpos($nhan, 'https://drive.google.com') !== false) {
echo $JW8;
echo $jw_css;
echo $drive;}

if (strpos($nhan, '.mp4') !== false) {
echo $JW8;
echo $jw_css;
echo $mp4;}

if (strpos($nhan, 'https://drivedata.yansuogaming.workers.dev') !== false) {
    echo $JW8;
    echo $jw_css;
    echo $mp4;
}

if (strpos($nhan, 'youtube.com') !== false) {
echo $JW7H;
echo $JW7;
echo $youtube;
}
if (strpos($nhan, 'animehay.ink') !== false) {
$animehay = $dom->getElementsByTagName('iframe');
foreach($animehay as $animehay){
        $video = $animehay->getAttribute('src');
        echo "<iframe style='position: absolute;top: 0;left: 0;width: 100%;height: 100%;' frameborder='0' src='".$video."' allowfullscreen></iframe>";
}
}

if (strpos($url, 'ok.ru/videoembed') !== false) {
    echo "<iframe style='position: absolute; top: 0; left: 0; width: 100%; height: 100%;' 
          frameborder='0' 
          src='$url' 
          allowfullscreen></iframe>";
}

if (strpos($url, 'mega.nz/embed') !== false) {
    $url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); // Bảo vệ chống lỗi XSS
    echo "<iframe style='position: absolute; top: 0; left: 0; width: 100%; height: 100%;' 
          frameborder='0' 
          src='$url' 
          allowfullscreen></iframe>";
}




// Xử lý Dailymotion Embed URL
if (strpos($url, 'dailymotion.com/player') !== false) {
    echo "<iframe style='position: absolute; top: 0; left: 0; width: 100%; height: 100%;' 
          frameborder='0' 
          src='$url' 
          allowfullscreen></iframe>";
}

// Check if the URL is from Vimeo
if (strpos($url, 'vimeo.com') !== false) {
    // Extract video ID from the Vimeo URL (assuming the format is https://vimeo.com/123456789)
    preg_match('/vimeo.com\/(\d+)/', $url, $matches);
    if (isset($matches[1])) {
        $video_id = $matches[1];
        echo "<div style='padding:56.69% 0 0 0; position:relative;'>
                  <iframe src='https://player.vimeo.com/video/$video_id?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479' 
                          frameborder='0' 
                          allow='autoplay; fullscreen; picture-in-picture; clipboard-write' 
                          style='position:absolute; top:0; left:0; width:100%; height:100%;' 
                          title='Vimeo Video'></iframe>
              </div>
              <script src='https://player.vimeo.com/api/player.js'></script>";
    }
}


?>