<?php
$basedir = basename(__DIR__);
$subdirectory = "wallpaper";
$url = "https://www.reddit.com/r/wallpaper/hot.json";

$string = file_get_contents($url);
if ($string === false) {
    // deal with error...
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
    $source = $child['data']['preview']['images'];
    /*foreach ($source as $subchild) {
    	$sub = $subchild['source']['url'];
    	//copy file to subdirectory
    	copy($sub, $basedir ."/" .$subdirectory ."/". $sub);
    }*/
    //$source = $child['data']['preview']['images']['source']['url'];
    $img = $basedir ."/" .$subdirectory ."/". $id.".jpg";
    downloadImage($rurl);
    //downloadImage("http://i.stack.imgur.com/pwMiA.jpg");
    //copy($rurl, $basedir ."/" .$subdirectory ."/". $id.".jpg");
    //echo $title."-". $rurl."<br>";
}

function downloadImage($durl) {
	$basedir = basename(__DIR__);
	$subdirectory = "wallpaper";
	$contents = file_get_contents($durl);
	$name = substr($durl, strrpos($durl, '/') + 1);
	file_put_contents($subdirectory ."/".$name, $contents);
	//file_put_contents($fpath, file_get_contents($durl)); 
	//echo "File downloaded!" . $name;

}

  


?>