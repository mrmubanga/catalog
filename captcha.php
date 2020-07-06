<?php
session_start();

header('Content-type: image/jpeg');

$text = $_SESSION['secure'];

$font_size = 15;

$image_width = 90;
$image_height = 35;

$image = imagecreate($image_width, $image_height);
imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);

for ($x=1; $x<=30; $x++) { 
	$x1 = rand(1, 100);
	$y1 = rand(1, 100);
	$x2 = rand(1, 100);
	$y2 = rand(1, 100);

	imageline($image, $x1, $y1, $x2, $y2, $text_color);
}

$version = phpversion();

if ($version > 6){
    $font = __DIR__."/fonts/LucidaBrightItalic.ttf";
    imagettftext($image, $font_size, 0, 15, 30, $text_color, $font, $text);
    imagejpeg($image);
} else {
    imagettftext($image, $font_size, 0, 15, 30, $text_color, 'fonts/LucidaBrightItalic.ttf', $text);
    imagejpeg($image);
}