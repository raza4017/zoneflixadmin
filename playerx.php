<?php
 
$slug = $_GET['slug'];
$api = "Fg06b3IXNwmMEKlS";
$browser = urlencode($_SERVER['HTTP_USER_AGENT']);
$country = "PK";
 
$process = file_get_contents('https://www.playerx.stream/api.php?slug='.$slug.'&api_key='.$api.'&action=direct_m3u8&browser='.$browser.'&country='.$country);
$data = json_decode($process, true);
echo $data['hls_m3u8'];
 
?>