<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
session_start();
require_once dirname(__FILE__)."/../pluginConfig.php";
$string = '';
for ($i = 0; $i < 5; $i++) {
    $string .= chr(rand(97, 122));
}
 
$_SESSION['captcha'] = $string; //store the captcha
 
$dir = $pluginPath.'/helpers/fonts/';
$image = imagecreatetruecolor(165, 50); //custom image size
$font = "PlAGuEdEaTH.ttf"; // custom font style
$color = imagecolorallocate($image, 113, 193, 217); // custom color
$white = imagecolorallocate($image, 255, 255, 255); // custom background color
imagefilledrectangle($image,0,0,399,99,$white);
imagettftext ($image, 30, 0, 10, 40, $color, $dir.$font, $_SESSION['captcha']);
 
header("Content-type: image/png");
imagepng($image);
?>