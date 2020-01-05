<?php
/*

    Author : Shafiq Mustapa
    Email : sicksand@gmail.com
    File : randwallpaper.php
    Version : 0.2
    Date : 05/01/2020 (that is 5th of January)
    Changes :
    0.2 - Rewrite code
    0.1 - First release


*/
$url = "https://www.reddit.com/r/wallpaper/hot.json";

$string = file_get_contents($url);
if ($string === false) {
    echo "Cannot contact url";
}

$json_a = json_decode($string, true);
if ($json_a === null) {
    // deal with error...
}
$children = $json_a['data']['children'];
foreach ($children as $child){
	$id = $child['data']['id'];
    $title = $child['data']['title'];
    $rurl = $child['data']['url'];
    downloadImage($rurl);
    
}

function downloadImage($durl) {
	
	$subdirectory = "wallpaper";
	$contents = file_get_contents($durl);
	$name = substr($durl, strrpos($durl, '/') + 1);
	file_put_contents($subdirectory ."/".$name, $contents);
	
}
?>