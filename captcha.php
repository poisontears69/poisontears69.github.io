<?php

session_start();

function generateCaptcha() {
    $captcha = rand(1000,9999);
    $_SESSION['captcha'] = $captcha;
    return $captcha;
}

$captcha = generateCaptcha();

// Set the content type
header('Content-Type: image/jpeg');

// Create the image
$image = imagecreatetruecolor(100, 30);

// Set white background color
$bgColor = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $bgColor);

// Set black text color
$textColor = imagecolorallocate($image, 0, 0, 0);

// Write the captcha text on the image
imagestring($image, 5, 10, 5, $captcha, $textColor);

// Output the image
imagejpeg($image);

// Free up memory
imagedestroy($image);
?>
