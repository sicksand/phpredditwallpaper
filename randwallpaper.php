<?php
/*

    Author : Shafiq Mustapa
    Email : sicksand@gmail.com
    File : randwallpaper.php
    Version : 0.2
    Date : 05/01/2020 (that is 5th of January)
    Changes :
    0.4 - check width and height of image
    0.3 - delete wallpaper first, randomize wallpaper 
    0.2 - Rewrite code
    0.1 - First release


*/

// Delete all files from wallpaper directory. Don't want to fill up space.
$files = glob('wallpaper/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}

// This is the array of best wallpaper subreddit in reddit. You can find it on your own and add to it.
$wallpapers = array("EarthPorn", "CityPorn","SkyPorn","WeatherPorn","BotanicalPorn","LakePorn","VillagePorn","BeachPorn","WaterPorn","SpacePorn","multiwall","wallpapers","wallpaper");
// Randomize it
$randwallpaper = array_rand($wallpapers);

$url = "https://www.reddit.com/r/".$wallpapers[$randwallpaper]."/hot.json";

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
// delete file
delete();
function downloadImage($durl) {
	
	$subdirectory = "wallpaper";
	$contents = file_get_contents($durl);
    // get the name
	$name = substr($durl, strrpos($durl, '/') + 1);
    file_put_contents($subdirectory ."/".$name, $contents);
    //check image size to get wodth and height, if height > width delete it cause it for portrait
    //
}

function delete() {
    // check image size to get wodth and height, if height > width delete it cause it for portrait
    $files = glob('wallpaper/*'); // get all file names
    foreach($files as $file){ // iterate files
    $data = getimagesize($file);
    $width = $data[0];
    $height = $data[1];    
      if($height > $width)
        unlink($file); // delete file
    }
    
}


?>